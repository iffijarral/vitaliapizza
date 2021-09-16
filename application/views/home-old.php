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
                        </div>
                        <div id="collapse<?php echo $category['id']; ?>" class="card-body collapse" data-parent="#accordion<?php echo $category['id']; ?>">
                            <?php

                            foreach ($products as $product) {
                                if ($product['catid'] === $category['id']) {
                                    echo '<div class="row productBlock " id=' . $product["id"] . '>'; // This id contains product id which will be fetched in jquery
                                    echo '  <div class="col-50">';
                                    echo '      <p class="prodName"><span class="spanQty">'.$qty.'</span>' . $product['name'] . '</p>';
                                    echo '      <p class="prodIngredients">' . $product['ingredients'] . '</p>';
                                    echo '  </div>';
                                    echo '  <div class="col-50" style="text-align: right;">';
                                    echo '      <p class="prodPrice">' . $product['price'] . ' </p>';
                                    echo '      <p><i class="fas fa-plus-circle addToCart" style="cursor: pointer;"></i></p>';
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