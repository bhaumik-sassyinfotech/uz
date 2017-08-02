<!DOCTYPE html>
<html lang="en">
<?php include('head.php'); ?>

    <body class="sticky-header">

        <section>
            <!-- left side <start--></start -->
            <?php include('nav.php');?>
                <!-- left side end-->
                <!-- main content start-->
                <div class="main-content">

                    <!-- header section start-->
                    <?php include('header.php');?>
                        <!-- header section end-->

                        <!-- page heading start-->
                        <div class="page-heading">
                            <h3>
                ORDER DETAIL
            </h3>
                            <ul class="breadcrumb">
                                <li>
                                    <a href="index.php">Dashboard</a>
                                </li>
                                <li class="active"> Add Order</li>
                            </ul>

                        </div>
                        <!-- page heading end-->

                        <!--body wrapper start-->
                        <div class="wrapper">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <section class="panel">
                                        <header class="panel-heading">
                                            Add Order Data

                                        </header>
                                        <div class="panel-body">
                                            <form id="cmsadd" role="form" class="cmxform form-horizontal adminex-form" method="get" action="">

                                                <div class="repeatingSection">

                                                    <a href="#" class="buttonGray buttonRight deletesection">Delete</a>

                                                    <div class="form-group clearfix">

                                                        <div class="col-md-4 col-sm-4">
                                                            <label for="Item">Product : </label>
                                                            <input type="text" class="form-control" name="subtitle" id="Item" placeholder="Product" required />
                                                        </div>

                                                        <div class="col-md-2 col-sm-2">
                                                            <label for="SubTitle">SKU : </label>
                                                            <input type="text" class="form-control" name="subtitle" id="SubTitle" placeholder="SKU" required />
                                                        </div>

                                                        <div class="col-md-2 col-sm-2">
                                                            <label for="Price">Price: </label>
                                                            <input type="text" class="form-control" name="pro-Price" id="Price" placeholder="Price" required />

                                                        </div>


                                                        <div class="col-md-1 col-sm-4 qty-p">
                                                            <label for="SubTitle">Qty : </label>
                                                            <input type="number" class="form-control" name="subtitle" id="SubTitle" placeholder="Qty" required />
                                                        </div>

                                                        <div class="col-md-1 col-sm-2">
                                                            <label for="Price">Discount: </label>
                                                            <input type="text" class="form-control" name="discount" id="Discount" placeholder="%" />

                                                        </div>


                                                    </div>





                                                </div>
                                                <div class=".col-md-12">
                                                    <a href="#" class="buttonGray buttonRight addProduct ">More  Products</a> </div>
                                                <div class="form-group clearfix">



                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="CouponStatus">Payment Status : </label>
                                                        <select class="form-control m-bot15">
                                                            <option></option>
                                                            <option>Paid</option>
                                                            <option>Due</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="CouponStatus">Payment Method : </label>
                                                        <select class="form-control m-bot15">
                                                            <option></option>
                                                            <option>Cheque</option>
                                                            <option>Net Banking</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="SubTitle">Payment Date: </label>
                                                        <input class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" value="" placeholder="Select Date" />

                                                    </div>
                                                    <div class="col-md-3 col-sm-3">
                                                        <label for="CouponStatus">Shipping Status : </label>
                                                        <select class="form-control m-bot15">
                                                            <option></option>
                                                            <option>Free Shipping</option>
                                                            <option>Paid shipping</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                   <div class="form-group  clearfix">
                                                   <div class="form-gapping  clearfix">
                                                    <div class="col-md-6 col-sm-4 flt-left">
                                                    <p class="cart-head">cart Total</p>
                                                    </div></div>
                                                <div class="form-gapping  clearfix">

                                                    <div class="col-md-6 col-sm-4 flt-left">

                                                        <div class="col-md-3 lable-txt">
                                                            <label for="CouponCode">Coupon Code: </label>
                                                        </div>

                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="couponcode" id="CouponCode" placeholder="" required />
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-gapping  clearfix">
                                                    <div class="col-md-6 col-sm-4 flt-left">
                                                        <div class="col-md-3 lable-txt">

                                                            <label for="CartSubtotal">Cart Subtotal : </label></div>
                                                             <div class="col-md-8">
                                                                 <input type="text" class="form-control" name="cartsubtotal" id="CartSubtotal" placeholder="" required /></div>
                                                    </div>
                                                </div>

                                                <div class="form-gapping  clearfix">
                                                    <div class="col-md-6 col-sm-4 flt-left">
                                                       <div class="col-md-3">
                                                           <label for="OrderTotal">Order Total : </label></div>
                                                         <div class="col-md-8">
                                                             <input type="text" class="form-control" name="subtitle" id="OrderTotal" placeholder="" required /></div>
                                                    </div>
                                                </div>
                                                </div>



                                                <div class="form-group clearfix">
                                                    <div class="col-md-6 col-sm-6 billing-address">

                                                        <div class="form-group clearfix">
                                                            <div class="col-md-12 ">
                                                                <label for="BillingAddress">Billing Address: </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-gapping clearfix">
                                                            <div class="col-md-6 col-sm-6">
                                                                <label for="FirstName">First Name : </label>
                                                                <input type="text" class="form-control" name="firstname" id="FirstName" placeholder="First Name" required />
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <label for="LastName">Last Name : </label>
                                                                <input type="text" class="form-control" name="lastname" id="LastName" placeholder="Last Name" required />
                                                            </div>

                                                        </div>

                                                        <div class="form-gapping clearfix">
                                                            <div class="col-md-6 col-sm-6">
                                                                <label for="Email">Email : </label>
                                                                <input type="text" class="form-control" name="email" id="Email" placeholder="Email" required />
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <label for="PhoneNumber">Phone Number : </label>
                                                                <input type="text" class="form-control" name="phonenumber" id="PhoneNumber" placeholder="Phone Number" required />
                                                            </div>

                                                        </div>

                                                        <div class="form-gapping clearfix">
                                                            <div class="col-md-12 ">
                                                                <label for="BillingAddress">Address: </label>
                                                                <textarea class="form-control" name="billingaddress" rows="4" id="BillingAddress"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-gapping clearfix">
                                                            <div class="col-md-12 ">
                                                                <label for="StreetAddress">Street: </label>
                                                                <textarea class="form-control" name="streetaddress" rows="1" id="StreetAddress"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-gapping clearfix">
                                                            <div class="col-md-6 col-sm-6">
                                                                <label for="City">City : </label>
                                                                <input type="text" class="form-control" name="city" id="City" placeholder="City" required />
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <label for="PhoneNumber">State : </label>
                                                                <input type="text" class="form-control" name="state" id="State" placeholder="State" required />
                                                            </div>

                                                        </div>
                                                        <div class="form-gapping clearfix">
                                                            <div class="col-md-6 col-sm-6">
                                                                <label for="Zipcode">Zipcode : </label>
                                                                <input type="text" class="form-control" name="zipcode" id="Zipcode" placeholder="Zipcode" required />
                                                            </div>
                                                            <div class="col-md-6 col-sm-6">
                                                                <label for="Country">Country : </label>
                                                                <input type="text" class="form-control" name="country" id="Country" placeholder="Country" required />
                                                            </div>

                                                        </div>


                                                    </div>










                                                    <div class="col-md-6 col-sm-6 ">
                                                        <div class="form-group clearfix">
                                                            <div class="col-md-12">
                                                                <label for="BillingAddress">Shipping Address: </label>


                                                            </div>



                                                        </div>
                                                        <div class="form-gapping clearfix">


                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="chk-box-bill">
                                                                <input id="enable" name="enable" type="checkbox" /> Same As Billing Address
                                                            </label>
                                                        </div>


                                                        <div id="shipping-address">


                                                            <div class="form-gapping clearfix">
                                                                <div class="col-md-12 ">
                                                                    <label for="ShippingAddress">Address: </label>
                                                                    <textarea class="form-control " name="shippingaddress" rows="4" id="ShippingAddress"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-gapping clearfix">
                                                                <div class="col-md-12 ">
                                                                    <label for="StreetAddress ">Street: </label>
                                                                    <textarea class="form-control " name="streetaddress" rows="1" id="StreetAddress"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-gapping clearfix">
                                                                <div class="col-md-6 col-sm-6">
                                                                    <label for="City">City : </label>
                                                                    <input type="text" class="form-control " name="city" id="City" placeholder="City" required />
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <label for="PhoneNumber">State : </label>
                                                                    <input type="text" class="form-control " name="state" id="State" placeholder="State" required />
                                                                </div>

                                                            </div>
                                                            <div class="form-gapping clearfix">
                                                                <div class="col-md-6 col-sm-6">
                                                                    <label for="Zipcode">Zipcode : </label>
                                                                    <input type="text" class="form-control " name="zipcode" id="Zipcode" placeholder="Zipcode" required />
                                                                </div>
                                                                <div class="col-md-6 col-sm-6">
                                                                    <label for="Country">Country : </label>
                                                                    <input type="text" class="form-control " name="country" id="Country" placeholder="Country" required />
                                                                </div>

                                                            </div>



                                                        </div>
                                                    </div>

                                                </div>




                                                <div class="col-md-12 pd0">
                                                    <button type="submit" class="btn btn-primary">save</button>
                                                    <button class="btn btn-default" type="button">Cancel</button>
                                                </div>



                                            </form>
                                            <!-- Modal -->

                                            <!-- modal -->
                                        </div>
                                    </section>
                                </div>

                            </div>


                        </div>
                        <!--body wrapper end-->

                        <!--footer section start-->
                        <footer>
                            2016 &copy; Sassy infotech
                        </footer>
                        <!--footer section end-->


                </div>
                <!-- main content end-->



        </section>

        <?php include('footer.php'); ?>
            <script type="text/javascript">
                jQuery(document).ready(function () {
                    $('#industrytokenfield, #clientstokenfield').tokenfield({
                        autocomplete: {
                            source: ['red', 'blue', 'green', 'yellow', 'violet', 'brown', 'purple', 'black', 'white'],
                            delay: 100
                        },
                        showAutocompleteOnFocus: true
                    })
                });
            </script>
            <!--tokenfield -->
            <script src="js/bootstrap-tokenfield.js"></script>
            <!--tokenfield -->

    </body>

</html>