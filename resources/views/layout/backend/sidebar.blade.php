  <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                          <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>
                            <li class="active">
                                <a href="{{route('admin')}}" class="waves-effect">
                                    <i class="mdi mdi-home"></i><span class="badge badge-primary float-right"></span> <span> Dashboard </span>
                                </a>
                            </li>
                              <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-email"></i><span> Subscription <span class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="{{route('viewdays')}}">Subscription Day</a></li>
                                    <li><a href="{{route('viewdaysmenu')}}">Subscription Menu Item</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> Item Information <span class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span> </a>
                                <ul class="submenu">
                                    <li><a href="{{route('viewcatagory')}}">Item Catagory</a></li>
                                    <li><a href="{{route('viewmenuitem')}}">Item Information</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-buffer"></i> <span> Order <span class="float-right menu-arrow"><i class="mdi mdi-plus"></i></span> </span> </a>
                                <ul class="submenu">
                                    <li><a href="{{route('order')}}">Order Info</a></li>
                                    <li><a href="{{route('viewaddressvalue')}}">Order Address</a></li>
                                </ul>
                            </li>
                             <li class="active">
                                <a href="{{route('viewpaymentvalue')}}" class="waves-effect">
                                    <i class="mdi mdi-home"></i><span class="badge badge-primary float-right"></span> <span> Payments </span>
                                </a>
                            </li>


                          
                        </ul>


                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>