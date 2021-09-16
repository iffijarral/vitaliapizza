<main class="container content">
    <div class="row justify-content-center">
        <div class="col-70">

            <?php
            foreach ($categories as $category) {
            ?>
                <div id="accordion<?php echo $category['id']; ?>" class="accordion mainAccordion">
                    <div class="card">
                        <div class="card-header collapsed" id="heading<?php echo $category['id']; ?>" data-toggle="collapse" data-target="#collapse<?php echo $category['id']; ?>" aria-controls="collapseOne" href="#collapse<?php echo $category['id']; ?>">
                            <a class="card-title">
                                <?php echo $category['name']; ?>
                            </a>
                            <span class="pl-4 catCount" style="display: none"></span>
                        </div>
                        <div id="collapse<?php echo $category['id']; ?>" class="card-body collapse" data-parent="#accordion<?php echo $category['id']; ?>">
                            <?php
                            
                            $myProducts = array();
                            $bg_color = '#ffffffff';
                            $qty = '';
                            if ($this->session->userdata('product')) {

                                $myProducts = $this->session->userdata('product');                                
                            }
                            foreach ($products as $product) {
                                if ($product['catid'] === $category['id']) { 
                                    if($myProducts) {                                        
                                        foreach($myProducts as $myproduct) {
                                            if($product['id'] === $myproduct['productId'] ) {
                                                $bg_color = '#b8edb840';
                                                $qty = $myproduct['productQty'].' x ';
                                                break;
                                            } else {
                                                $bg_color = '#ffffffff';
                                                $qty = '';
                                            }
                                        }
                                    }                                   
                                    echo '<div class="row productBlock" id=' . $product["id"] . ' style="background-color:'.$bg_color.'; ">'; // This id contains product id which will be fetched in jquery
                                    echo '  <div class="w-100 px-4">';
                                    echo '      <p class="prodName text-success"><span class="spanQty">'.$qty.'</span>'.$product['productNo'].'. ' . $product['name'] . '</p>';
                                    echo '      <p class="prodIngredients">' . $product['ingredients'] . '</p>';
                                    echo '      <div class="d-flex justify-content-between">';
                                    echo '          <p class="prodPrice text-info">' . $product['price'] . ',00 </p>';
                                    echo '          <span>';
                                    echo '              <span class="pr-4 text-info mobileOnly cartIcon">Til Kurven</span><i class="fas fa-plus-circle addToCart plusCircle" style="cursor: pointer;"></i>';
                                    echo '          </span>';                            
                                    echo '      </div>';                            
                                    
                                    echo '  </div>';
                                    echo '</div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>



        </div>
        <div class="col-30 myCart">

            <?= $this->load->view('cart', null, TRUE); ?>

        </div>
    </div>
</main>