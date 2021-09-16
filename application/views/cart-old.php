<?php
$subTotal = 0;
$cartSize = 0;

if ($this->session->userdata('product')) {
    $cartSize = sizeof($this->session->userdata('product'));
}
?>
<div class="make-me-sticky">
    <div id="cart" class="card">
        <div class="card-header myCartHead" style="cursor: auto !important;">
            <i class="fas fa-shopping-cart minKurv" style="color: darkgreen"></i>
            Din Kurv
            <button type="button" class="close closeCart" data-dismiss="modal">&times;</button>
        </div>
        <div class="cart">
            <div id="cart-body" class="card-body">
                <!-- PRODUCT -->
                <?php
                $deliveryMethod = '';
    
                if ($this->session->userdata('deliverMethod')) {
    
                    $deliveryMethod = $this->session->userdata('deliverMethod');
                }
                ?>
                <div class="container-fluid" style="padding: 0 !important;">
                    <div class="row cartRow justify-content-center" style="margin-bottom: 1rem;">
                        <input type="hidden" name="loginStatus" id="loginStatus">
                    </div>
                    <?php
    
                    if ($this->session->userdata('product') && count($this->session->userdata('product')) >= 0) {
    
                        $products = array();
    
                        $products = $this->session->userdata('product');
    
                        foreach ($products as $product) {
                            if ($product['productQty'] > 0) {
                    ?>
                                <div id="<?php echo $product['productId']; ?>" class="row cartRow pb-2 mb-2">
                                    <div class="col-8 col-sm-8 col-md-8 col-lg-8" style="text-align: left;">
                                        <?php echo $product['productQty']; ?> x <?php echo $product['productName']; ?>
                                    </div>
                                    <div class="col-4 col-sm-4 col-md-4 col-lg-4" style="text-align: right;">
                                        <p><?php echo $product['productGrossPrice']; ?></p>
                                        <a class="minusCart" href="#"><i class="fas fa-minus" style='color: red !important;'></i></a>
                                        <a class="plusCart" href="#"><i class="fas fa-plus"></i></a>
                                    </div>
                                </div>
    
                        <?php
                                $subTotal += (int) $product['productGrossPrice'];
                            }
                        }
                    } else {
                        ?>
                        <!--<div class="container-fluid"> -->
                        <div class="row cartRow">
                            <div class="col-8 col-sm-8 col-md-8 col-lg-8 ">
                                <p>Product</p>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 " style="text-align: right">
                                <p>Price</p>
                                <i class="fas fa-minus " style='color: red !important;'></i>
                                <i class="fas fa-plus "></i>
                            </div>
                        </div>
                        <!--</div>-->
    
                    <?php
                    }
    
                    ?>
                </div>
                <hr>
                <div class="container-fluid">
                    <div class="row cartRow">
                        <div class="col-6 col-sm-6 col-md-8 col-lg-8 ">
                            <b> I ALT </b>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-4" style="text-align: right">
                            <?php echo $subTotal; ?> kr.</p>
                            <?php $this->session->set_userdata('amount', $subTotal); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cart-footer" class="card-footer">
                <button id="checkout" class="btn btn-block btn-success" <?php if ($subTotal < 1 || isset($checkOutButton)) echo 'disabled' ?>>Checkout</button>
            </div>
        </div>
    </div>
</div>