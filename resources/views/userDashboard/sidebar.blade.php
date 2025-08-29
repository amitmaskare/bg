 @if(Auth::user()->id)
 @php $user=DB::table('users')->where('id',Auth::user()->id)->first(['name','email']);@endphp
 @endif
 <div class="col-lg-3">
                    <div class="dashboard-sidebar">
                        <button class="btn back-btn">
                            <i class="ri-close-line"></i><span>Close</span>
                        </button>
                        <div class="profile-top">
                            <div class="profile-top-box">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        <div class="user-round">
                                            <h4>J</h4>
                                        </div>
                                        <div class="user-icon"><input type="file" accept="image/*"><i
                                                class="ri-image-edit-line d-lg-block d-none"></i><i
                                                class="ri-pencil-fill edit-icon d-lg-none"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-detail">
                                <h5>{{ucfirst($user->name)}}</h5>
                                <h6>{{ucfirst($user->email)}}</h6>
                            </div>
                        </div>
                        <div class="faq-tab">
                            <ul id="pills-tab" role="tablist" class="nav nav-tabs">
                                <li role="presentation" class="nav-item">
                                    <a class="nav-link" id="info-tab" href="{{route('userdashboard')}}" role="tab">
                                        <i class="ri-home-line"></i> dashboard
                                        </a>
                                </li>
                                <li role="presentation" class="nav-item">
                                   <a href="{{route('myBidInfo')}}" class="nav-link" id="notification-tab"  role="tab">
                                        <i class="ri-notification-line"></i>
                                        My Bids
                                </a>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <a href="{{route('userProfile')}}" class="nav-link"  role="tab">
                                        <i class="ri-bank-line"></i>Profile Info
                                </a>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <a href="{{route('userAddress')}}" class="nav-link"  role="tab">
                                        <i class="ri-map-pin-line"></i> Saved Address
                                </a>
                                </li>
                                <!-- <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="order-tab" data-bs-toggle="tab"
                                        data-bs-target="#order-tab-pane" role="tab">
                                        <i class="ri-file-text-line"></i>My Orders
                                    </button>
                                </li> -->
                                  <li role="presentation" class="nav-item">
                                    <a class="nav-link" href="{{route('purchaseOrder')}}" role="tab">
                                        <i class="ri-file-text-line"></i>My Purchase Orders
                                    </a>
                                </li>
                                 <li role="presentation" class="nav-item">
                                    <a class="nav-link" href="{{route('myOrderInfo')}}" role="tab">
                                        <i class="ri-file-text-line"></i>My Sales Orders
                                    </a>
                                </li>
                                
                                  <li role="presentation" class="nav-item">
                                    <a class="nav-link" href="{{route('mywishList')}}" role="tab">
                                        <i class="ri-heart-line"></i> My Wishlist
                                    </a>
                                </li>
                                 <li role="presentation" class="nav-item">
                                    <a class="nav-link" href="{{route('mywalletList')}}" role="tab">
                                        <i class="ri-wallet-line"></i> My Wallet
                                    </a>
                                </li>
                                 <li role="presentation" class="nav-item">
                                    <a class="nav-link" href="{{route('mytransactionList')}}" role="tab">
                                        <i class="ri-wallet-line"></i> Transactions
                                    </a>
                                </li>
                                  <li role="presentation" class="nav-item">
                                    <a class="nav-link" href="{{route('messageList')}}" role="tab">
                                        <i class="ri-wallet-line"></i> Message
                                    </a>
                                </li>
                                <li role="presentation" class="nav-item logout-cls">
                                    <a href="{{route('logout')}}" class="btn loagout-btn">
                                        <i class="ri-logout-box-r-line"></i> Logout
                                    </a>
                                </li>
                                 
                             
                               <!--  
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="earning" data-bs-toggle="tab"
                                        data-bs-target="#earning-tab-pane" role="tab">
                                        <i class="ri-coin-line"></i> Earning Points
                                    </button>
                                </li>
                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="order-tab" data-bs-toggle="tab"
                                        data-bs-target="#order-tab-pane" role="tab">
                                        <i class="ri-file-text-line"></i>My Orders
                                    </button>
                                </li>

                                <li role="presentation" class="nav-item">
                                    <button class="nav-link" id="refund-tab" data-bs-toggle="tab"
                                        data-bs-target="#refund-tab-pane" role="tab">
                                        <i class="ri-money-dollar-circle-line"></i> Refund History </button>
                                </li>
                              
                                -->
                            </ul>
                        </div>
                    </div>
                </div>