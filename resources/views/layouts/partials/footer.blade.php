<footer>
        <div class="container">
            <!-- TOP FOOTER -->
            <div class="top_footer d-flex flex-wrap">
                <div class="col-md-4 p-0">                                      
                    <ul>
                        <li>
                            <h2>Quick links</h2>
                        </li>                       
                        @foreach($links as $link)
                        <li> 
                            
                            <a href="">{{$link['text']}} <i class="fas fa-arrow-circle-right arrow"></i></a> 
                        </li>     
                        @endforeach
                        <li>
                            <a href="{{route('register')}}">Add Restaurant <i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>
                        <li>
                            <a href="{{route('login')}}">My Account<i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>   
                                            
                    </ul>
                </div>
                <div class="col-md-4 p-0">                   
                   <ul>        
                        <li>
                            <h2>Categories</h2>
                        </li>               
                        @foreach($categories as $category)
                        <li> 
                            <a href="{{-- {{ route($item['href'])}} --}}">{{$category['text']}} <i class="fas fa-arrow-circle-right arrow"></i></a>
                        </li>     
                        @endforeach                       
                    </ul>
                </div>
                <div class="col-md-4 p-0">
                    <ul>   
                        <li>
                            <h2>Contacts</h2>
                        </li>                    
                        @foreach($contacts as $contact)
                        <li> 
                            <a href="{{-- {{ route($contact['href'])}} --}}">{{$contact['text']}} <i class="fas fa-arrow-circle-right arrow"></i></a>
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
                    <ul class="d-flex flex-wrap">
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