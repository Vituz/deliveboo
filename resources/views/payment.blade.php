<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DeliveBooh Payment</title>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    .hosted-field {
        height:calc(1.6em + 0.75rem + 2px);
        padding:0 1rem;
        border:1px solid #ced4da;
        border-radius: 5px; 
               
    }
    .braintree-hosted-fields-focused { 
        color: #495057;
    background-color: #fff;
    border-color: #a1cbef;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgb(52 144 220 / 25%);
}
</style>
</head>
    <body>
   
        <div class="container w-75 py-5 bt-drop-in-wrapper">
            @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
                <script>                   
                    sessionStorage.clear();
                    //console.log(window.sessionStorage);
                </script>
            @endif

            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('/checkout') }}" method="POST" id="payment-form" id="bt-dropin">
                    @csrf
                    

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="surname">Cognome</label>
                        <input type="text" class="form-control" id="surname" name="surname">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Indirizzo Email</label>
                        <input type="email" class="form-control" id="email" name="mail">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">Indirizzo</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="city">Città</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="province">Provincia</label>
                                <input type="text" class="form-control" id="province" name="province">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Numero di Telefono</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h3>Totale Ordine €:</h3><span id="prezzo"></span>
                                <input type="hidden" class="form-control" id="amount" name="amount" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="card-number">Numero Carta di Credito</label>
                            <div class="form-group hosted-field" id="card-number"></div>
                        </div>

                        <div class="col-md-3">                            
                            <label for="expiration-date">Data di Scadenza</label>
                            <div class="form-group hosted-field" id="expiration-date"></div>
                        </div>

                        <div class="col-md-3">
                            <label for="cvv">CVV</label>
                            <div class="form-group hosted-field" id="cvv"></div>
                        </div>

                    </div>
                    <input id="user_id" name="user_id" type="hidden" />
                    <input id="cart" name="cart" type="hidden" />
                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="btn btn-success" type="submit"><span>Procedi al pagamento</span></button>
                    <a class="btn btn-warning" id="back" href="{{url('/')}}">Indietro</a>
                </form>
                    
                    
                   
                         
        </div>
    <!-- <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script> -->
   
    <script src="https://js.braintreegateway.com/web/3.38.1/js/client.min.js"></script>
    <script src="https://js.braintreegateway.com/web/3.38.1/js/hosted-fields.min.js"></script>
    <script>
               
        if(window.sessionStorage.length !=0){
        //console.log(window.sessionStorage);
        const cart = JSON.parse(sessionStorage.getItem("cartStored"));
        var cartJson=JSON.stringify(cart)
        //console.log(cart,cartJson);
        
        carrelloForm = document.querySelector('#cart');
        backButton = document.querySelector('#back');
        backButton.href="/restaurant/" + cart[0].user_id;

        var user = document.querySelector('#user_id');
        //console.log(user, cart[0].user_id);
        user.value = cart[0].user_id;
       /*  if (JSON.parse(sessionStorage.getItem("sumStored"))) { */
            
            sommaArchiviata = JSON.parse(sessionStorage.getItem("sumStored"));
            var prezzo = document.querySelector('#prezzo')
            prezzo.innerHTML = sommaArchiviata
        /* } */
    }
        var form = document.querySelector('#payment-form');
      var submit = document.querySelector('input[type="submit"]');
      braintree.client.create({
        authorization: '{{ $token }}'
      }, function (clientErr, clientInstance) {
        if (clientErr) {
          console.error(clientErr);
          return;
        }
        // This example shows Hosted Fields, but you can also use this
        // client instance to create additional components here, such as
        // PayPal or Data Collector.
       
        braintree.hostedFields.create({
          client: clientInstance,
          styles: {
            'input': {
              'font-size': '14px'
            },
            'input.invalid': {
              'color': 'red'
            },
            'input.valid': {
              'color': 'green'
            }
          },
          fields: {
            number: {
              selector: '#card-number',
              placeholder: '4111 1111 1111 1111'
            },
            cvv: {
              selector: '#cvv',
              placeholder: '123'
            },
            expirationDate: {
              selector: '#expiration-date',
              placeholder: '10/2021'
            }
          }
        }, function (hostedFieldsErr, hostedFieldsInstance) {
          if (hostedFieldsErr) {
            console.error(hostedFieldsErr);
            return;
          }
          // submit.removeAttribute('disabled');
          form.addEventListener('submit', function (event) {
            event.preventDefault();
            hostedFieldsInstance.tokenize(function (tokenizeErr, payload) {
              if (tokenizeErr) {
                console.error(tokenizeErr);
                return;
              }
              // If this was a real integration, this is where you would
              // send the nonce to your server.
              // console.log('Got a nonce: ' + payload.nonce);            
           
              carrelloForm.value = cartJson;
              
              if (JSON.parse(sessionStorage.getItem("sumStored"))) {
                const totale = JSON.parse(sessionStorage.getItem("sumStored"));
                var amount = document.querySelector('#amount');
                amount.value = totale;
                
            }       
              document.querySelector('#nonce').value = payload.nonce;
              form.submit();
            });
          
        });
    });
});
    </script>
</body>
</html>