<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Mail</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
    <div class="container">

        <h1>Ordine DeliveBooh App</h1>
        <div><strong>Ristorante: </strong>{{$restaurant}}</div>
       <span><strong>Cliente:</strong></span>
       <div class="cliente d-flex flex-column ">
            <div>
               <span> <strong> Nome: </strong>{{$data['name']}}</span> <span> Cognome: {{$data['surname']}}</span>
            </div>
            
                <span><strong>Indirizzo di consegna: </strong> {{$data['address']}}</span>
            
        
            <span><strong>Numero di Telefono: </strong> {{$data['phone']}}</span>
        
            <span> <strong>Email: </strong>{{$data['mail']}}</span>
            <div class="dettagli_ordine mb-4">
                <h4>Lista piatti ordinati</h4>
               @foreach($cart as $dish)
               <div class="piatto">
                   <span><strong>Piatto: </strong>{{$dish['item_name']}}</span>
                   <span><strong>Quantità: </strong> {{$dish['quantity']}}</span>
                   <span><strong>Totale: </strong> {{$dish['quantity'] * $dish['item_price']}}</span>                    
               </div>
               @endforeach
            </div>
            <span ><strong>Totale Ordine: </strong>{{$data['total']}}</span>
       </div>
           
         
          
       
        
    </div>
</body>
</html>