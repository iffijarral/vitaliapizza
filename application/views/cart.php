<?php
$subTotal = 0;
$cartSize = 0;

if ($this->session->userdata('product')) {
    $cartSize = sizeof($this->session->userdata('product'));
}
?>


<div class="make-me-sticky">
    <div id="cart" class="card">
        <div class="card-header myCartHead">
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
                                <div id="<?php echo $product['productId']; ?>" class="px-2 cartRow mb-2 pb-2">
                                    <div class="d-flex justify-content-between">
                                       <p> <?php echo $product['productQty']; ?> x <?php echo $product['productName']; ?></p>
                                       
                                       <p><?php if($product['productQty'] > 1) echo $product['productGrossPrice'].',00'; else echo $product['productGrossPrice']; ?></p>
                                    </div>
                                    <div class="d-flex justify-content-end">                                        
                                        <a class="minusCart pr-2" href="#"><i class="fas fa-minus" style="color: #ff0000 !important"></i></a>
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
                        <div class="cartRow px-2">
                            <div class="d-flex justify-content-between">
                                <p>Product</p>
                                <p>Price</p>
                            </div>
                            <div class="d-flex justify-content-end">
                                
                                <i class="fas fa-minus pr-2" style='color: red !important;'></i>
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
                    <div class="cartRow px-2">
                        <div class="d-flex justify-content-between">
                            <p class="text-info"> I ALT </p>
                            <p class="text-info"><?php echo $subTotal; ?>,00 kr.</p>
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