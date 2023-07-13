<?php

use App\Models\Wishlist;  ?>
<!------   QUICK VIEW MODAL ---------------------------->
<!-- Begin Quick View | Modal Area -->
<div class="modal fade modal-wrapper" id="quickViewModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-inner-area row">
                    <div class="col-lg-5 col-md-6 col-sm-6">
                        <!-- Product Details Left -->
                        <div class="product-details-left">
                            <img src="" alt="product image" id="modal-product-image" style="width: 250px; margin:80px 50px;">
                            <div class="product-details-images slider-navigation-1">
                                <!-- <div class="lg-image">
                                    <img src="" alt="product image" id="modal-product-image" width="50">
                                </div> -->

                            </div>
                            <!-- <div class="product-details-thumbs slider-thumbs-1">
                                <div class="sm-image"><img src="images/product/small-size/1.jpg" alt="product image thumb"></div>
                                
                            </div> -->
                        </div>
                        <!--// Product Details Left -->
                    </div>

                    <div class="col-lg-7 col-md-6 col-sm-6">
                        <div class="product-details-view-content pt-60">
                            <div class="product-info">
                                <h2 id="modal-product-name">Today is a good day Framed poster</h2>
                                <span class="product-details-ref" id="modal-product-category">Reference: demo_15</span>
                                <div class="rating-box pt-20">
                                    <ul class="rating rating-with-review-item">
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                        <li class="no-star"><i class="fa fa-star-o"></i></li>

                                    </ul>
                                </div>
                                <div class="price-box pt-20">
                                    <span class="new-price new-price-2" id="modal-product-price">$57.98</span>
                                </div>
                                <div class="product-desc">
                                    <p>
                                        <span id="modal-product-description">100% cotton double printed dress. Black and white striped top and orange high waisted skater skirt bottom. Lorem ipsum dolor sit amet, consectetur adipisicing elit. quibusdam corporis, earum facilis et nostrum dolorum accusamus similique eveniet quia pariatur.
                                        </span>
                                    </p>
                                </div>

                                <div class="single-add-to-cart">
                                    <form action="#" class="cart-quantity">
                                        <div class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </div>
                                        <button class="add-to-cart" type="submit">Add to cart</button>
                                    </form>
                                </div>
                                <div class="product-additional-info pt-25">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Quick View | Modal Area End Here -->
<!------   QUICK VIEW MODAL ---------------------------->





<!--- Register Modal ------>

<div class="modal fade modal-wrapper" id="registerModal" class="login-open">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="m-auto text-white">Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="modal-inner-area row">

                    <form action="{{route('user-register')}}" method="post" class="user_register_form_operation">
                        @csrf
                        <div class="login-form">

                            <div class="success_message alert alert-success" style="display:none;"></div>
                            <div class="error_message alert alert-danger" style="display:none;"></div>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Full Name</label>
                                    <input class="mb-0" type="text" name="name" placeholder="Full Name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>

                                <div class="col-md-12 col-12 mb-20">
                                    <label>Phone</label>
                                    <input class="mb-0" type="text" name="phone" placeholder="Phone">
                                    <span class="text-danger error-text phone_error"></span>
                                </div>

                                <div class="col-md-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" name="password" placeholder="Password">
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>Confirm Password</label>
                                    <input class="mb-0" type="password" name="conpassword" placeholder="Confirm Password">
                                    <span class="text-danger error-text conpassword_error"></span>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="register-button mt-0 w-100">Register </button>





                                </div>
                            </div>
                        </div>








                    </form>
                </div>

            </div>



        </div>
    </div>



</div>


<!----- Register Modal End ------->



<!-- Begin Login | Modal Area -->

<div class="modal fade modal-wrapper" id="loginModal" class="login-open">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="m-auto text-white">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="modal-inner-area row">

                    <form action="{{route('check-user')}}" method="POST" class="user_login_form_operation">
                        @csrf
                        <div class="login-form">

                            <div class="success_message alert alert-success" style="display:none;"></div>
                            <div class="error_message alert alert-danger" style="display:none;"></div>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                    <span class="text-danger error-text email_error"></span>
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" name="password" placeholder="Password">
                                    <span class="text-danger error-text password_error"></span>
                                </div>
                                <div class="col-md-8">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me">Remember me</label>

                                    </div>
                                </div>
                                <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                    <a href="javascript:void;" id="forgotpassword"> Forgotten passward?</a>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="register-button mt-0 w-100">Login</button>
                                </div>

                            </div>
                        </div>



                    </form>
                </div>

            </div>



        </div>
    </div>
</div>


<!-- Login | Modal Area End Here -->

<!---- Forgot Password Modal------>

<div class="modal fade modal-wrapper" id="ForgotPasswordModal" class="login-open">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h4 class="m-auto text-white">Forgot Passwword</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="modal-inner-area row">

                    <form action="{{route('forgot-password')}}" method="POST" class="forgot-password-form" style="width: 870px;">
                        @csrf
                        <div class="login-form">

                            <div class="success_message alert alert-success" style="display:none;"></div>
                            <div class="error_message alert alert-danger" style="display:none;"></div>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <h3>Enter Your Email Address</h3>
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" name="email" placeholder="Email Address">
                                    <span class="text-danger error-text email_error"></span>
                                </div>



                                <div class="col-md-12">
                                    <button type="submit" class="register-button mt-0 w-100">Submit</button>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <a id="backtologin" class="register-button text-white text-center mt-0 w-100">Back To Login</a>
                                </div>

                            </div>
                        </div>



                    </form>
                </div>

            </div>



        </div>
    </div>
</div>

<!---- Forgot Password Modal End------>




<!-- Review Modal Area -->
<div class="modal fade modal-wrapper mymodal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="review-page-title">Write Your Review</h3>
                <div class="modal-inner-area row">
                    <div class="col-lg-6">
                        <div class="li-review-product">
                            <img src="images/product/large-size/3.jpg" alt="Li's Product">
                            <div class="li-review-product-desc">
                                <p class="li-product-name">Today is a good day Framed poster</p>
                                <p>
                                    <span>Beach Camera Exclusive Bundle - Includes Two Samsung Radiant 360 R3 Wi-Fi Bluetooth Speakers. Fill The Entire Room With Exquisite Sound via Ring Radiator Technology. Stream And Control R3 Speakers Wirelessly With Your Smartphone. Sophisticated, Modern Design </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="li-review-content">
                            <!-- Begin Feedback Area -->
                            <div class="feedback-area">
                                <div class="feedback">
                                    <h3 class="feedback-title">Our Feedback</h3>
                                    <form action="{{route('user.add-rating')}}" method="post">@csrf
                                        <input type="hidden" name="product_id" value="{{$productdetails->id}}">
                                        <p class="your-opinion">
                                            <label>Your Rating</label>
                                            <span>
                                                <select class="star-rating" name="rating">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </span>
                                        </p>
                                        <p class="feedback-form">
                                            <label for="feedback">Your Review</label>
                                            <textarea id="feedback" name="reviews" cols="45" rows="8" aria-required="true"></textarea>
                                        </p>
                                        <div class="feedback-input">
                                            <!-- <p class="feedback-form-author">
                                                                            <label for="author">Name<span class="required">*</span>
                                                                            </label>
                                                                            <input id="author" name="author" value="" size="30" aria-required="true" type="text">
                                                                        </p>
                                                                        <p class="feedback-form-author feedback-form-email">
                                                                            <label for="email">Email<span class="required">*</span>
                                                                            </label>
                                                                            <input id="email" name="email" value="" size="30" aria-required="true" type="text">
                                                                            <span class="required"><sub>*</sub> Required fields</span>
                                                                        </p> -->



                                            <button type="submit" class="btn btn-sm btn-info w-25 float-right" data-dismiss="modal" aria-label="Close">Close</button>
                                            <button type="submit" class="btn btn-sm btn-info w-25 float-left">Submit</button>



                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Feedback Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Review Modal Area End Here -->