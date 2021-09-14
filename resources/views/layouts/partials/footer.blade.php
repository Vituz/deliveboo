<footer>
        <div class="container">
            <!-- TOP FOOTER -->
            <div class="top_footer d-flex flex-wrap">
                <div class="col-md-4 p-0">                                      
                    <ul class="pl-0">
                        <li>
                            <h2>Scopri DeliveBooh</h2>
                        </li>                       
                        <li>
                            <a href="{{route('register')}}">Aggiungi un ristorante<i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>
                        <li>
                            <a href="{{route('login')}}">Il mio profilo<i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>   
                        @foreach($links as $link)
                        <li> 
                            
                            <a href="">{{$link['text']}} <i class="fas fa-arrow-circle-right arrow"></i></a> 
                        </li>     
                        @endforeach
                                            
                    </ul>
                </div>
                <div class="col-md-4 p-0">                   
                   <ul class="pl-0">        
                        <li>
                            <h2>Aiuto</h2>
                        </li>               
                        @foreach($helps as $help)
                        <li> 
                            <a href="">{{$help['text']}} <i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>     
                        @endforeach                       
                    </ul>
                </div>
                <div class="col-md-4 p-0">
                    <ul class="pl-0">   
                        <li>
                            <h2>Note legali</h2>
                        </li>                    
                        @foreach($legal_notices as $item)
                        <li> 
                            <a href="{{-- {{ route($contact['href'])}} --}}">{{$item['text']}} <i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>     
                        @endforeach                       
                    </ul>
                </div>

            </div>
            <!-- /TOP FOOTER -->

            <!-- BOTTOM FOOTER -->

            <div class="bottom_footer d-flex">
                <div class="col-md-7 pay_methods">
                   <div class="btn btn-light pay_card ">
                       <a href="#">
                           <span >Lingua </span> &nbsp;<i class="fas fa-globe"></i></i>
                       </a>
                    </div>
                    @foreach($pay_methods as $item)
                    <div class="btn p-0 btn-light logo_btn">
                        <a href="#">
                            <img src="{{$item['href']}}" alt="">
                        </a>
                    </div>
                    @endforeach
                    
                </div>
                <div class="col-md-5  socials">
                    <ul class="d-flex flex-wrap justify-content-end">
                        @foreach($socials as $item)
                        <li class="social_card">
                            <div class=" align-items-end">
                                <a href="#">
                                    <img src="{{$item['href']}}" alt="">
                                </a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <!--  @foreach($socials as $item)
                    <div class="social_card">
                        <a href="#">
                            <img src="{{$item['href']}}" alt="">
                        </a>
                    </div>
                    @endforeach -->
                </div>
            </div>
        </div>
            <!-- /BOTTOM FOOTER -->
        
</footer>