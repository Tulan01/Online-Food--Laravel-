@extends('layout.frontend.master')
@section('contact')
  <div class="my-menu">
        <section class="page-banner-section menu">
          <div class="container animated zoomInUp">
            <h1>Our Menu</h1>
            <h3>The Premium Food Experience</h3>
          </div>
        </section>
        <!-- End page-banner section -->

        <!-- today-menu-section 
			================================================== -->
        <section class="today-menu-section">
          <div class="container">
            <div
              class="center-area wow slideInLeft"
              data-wow-duration="1s"
              data-wow-delay=".5s"
              data-wow-iteration="1"
            >
              <h2>Today's Special</h2>
            </div>

            <div class="menu-box">
              <div class="owl-wrapper">
                <div class="owl-carousel" data-num="3">
                  <div class="item">
                    <div class="menu-post">
                      <img src="frontend/myresources/home-filter-1.jpg" alt="" />
                      <div class="menu-post-content">
                        <div class="inner-menu">
                          <h2>Daily Cheese Sandwich</h2>
                          <span>500 BDT</span>
                          <div class="add-button">
                            <button>
                              <a href="#">ADD TO CART</a>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="item">
                    <div class="menu-post">
                      <img src="frontend/myresources/home-filter-2.jpg" alt="" />
                      <div class="menu-post-content">
                        <div class="inner-menu">
                          <h2>Linguini Carbonara</h2>
                          <span>500 BDT</span>
                          <div class="add-button">
                            <button>
                              <a href="#">ADD TO CART</a>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="item">
                    <div class="menu-post">
                      <img src="frontend/myresources/home-filter-3.jpg" alt="" />
                      <div class="menu-post-content">
                        <div class="inner-menu">
                          <h2>Avocado Shell Stuffed</h2>
                          <span>500 BDT</span>
                          <div class="add-button">
                            <button>
                              <a href="#">ADD TO CART</a>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="item">
                    <div class="menu-post">
                      <img src="frontend/myresources/home-filter-4.jpg" alt="" />
                      <div class="menu-post-content">
                        <div class="inner-menu">
                          <h2>Daily Cheese Sandwich</h2>
                          <span>500 BDT</span>
                          <div class="add-button">
                            <button>
                              <a href="#">ADD TO CART</a>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- End today-menu section -->

        <!-- menu-section 
			================================================== -->
      <?php
      $c=0;
       ?>
       @foreach($catagory as $row)
        <?php
        if($c%2==0){
         ?>
         <section class="menu-section left-content">
          <div class="background-items">
            <div class="table-back"></div>
            <div class="image-back">
              <img src="frontend/myresources/side-menu1.jpg" alt="" />
            </div>
          </div>
          <div class="menu-box">
            <div class="container">
              <div class="row">
                <div class="col-sm-8">
                  <div class="title-section white-style">
                    <h1>{{$row->catagory_name}}</h1>
                  </div>
                  <ul class="menu-list-items">
                    <?php
                    $data=DB::table('menu_items')
                                ->where('catagory_id',$row->id)
                                ->get();
                     ?>
                     @foreach($data as $row1)
                    <li>
                      <div class="list-content">
                        <h2>{{$row1->item_name}}</h2>
                        <p>
                         {!! html_entity_decode($row1->item_details) !!}
                        </p>
                      </div>
                      <span class="price">{{$row1->item_price}} BDT</span>
                    </li>
                     @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php
          } else{
         ?>
        <!-- End menu section -->

        <!-- menu-section 
			================================================== -->
         <section class="menu-section right-content">
          <div class="background-items">
            <div class="table-back"></div>
            <div class="image-back">
              <img src="frontend/myresources/side-menu2.jpg" alt="" />
            </div>
          </div>
          <div class="menu-box">
            <div class="container">
              <div class="row">
                <div class="col-sm-8 col-sm-offset-4">
                  <div class="title-section">
                    <h1>{{$row->catagory_name}}</h1>
                  </div>
                  <ul class="menu-list-items">
                   <?php
                    $data1=DB::table('menu_items')
                                ->where('catagory_id',$row->id)
                                ->get();
                     ?>
                     @foreach($data1 as $row2)
                    <li>
                      <div class="list-content">
                        <h2>{{$row2->item_name}}</h2>
                        <p>
                         {!! html_entity_decode($row2->item_details) !!}
                        </p>
                      </div>
                      <span class="price">{{$row2->item_price}} BDT</span>
                    </li>
                     @endforeach
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
         <?php }  $c=$c+1; ?>
        @endforeach
        <!-- End menu section -->

        <!-- menu-section 
			================================================== -->
        
      </div>


@endsection