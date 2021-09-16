<div id="cardCategory" class="card">
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Products</h3>
    <div class="card-body">
        <div id="table" class="table-editable">
            <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i data-toggle="modal" data-target="#modalProduct" class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
            <div style="width: 25%; text-align: left;">
                <label for="selCat">Select Category:</label>
                <select class="form-control" id="selCat">
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php
                    }
                    ?>

                </select>
            </div>
            <div id="products">
                <?= $this->load->view('admin/productTable', $products, TRUE); ?>
            </div>

        </div>

        <div class="modal" id="modalProduct">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Login Modal Header -->
                    <div class="modal-header">
                        <div class="row">
                            <p class="modal-title">NEW Product</p>
                        </div>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Login Modal body -->
                    <div class="modal-body">
                        <form action="/action_page.php">
                            <div class="form-group">

                                <select class="form-control" id="modalSelect" required>
                                    <option value='default'>Choose Category</option>
                                    <?php

                                    foreach ($categories as $category) {
                                    ?>
                                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Product Name" id="prodName" required>
                            </div>
                            <div class="form-group">
                                <input type="number" step=0.01 class="form-control" placeholder="Price" id="prodPrice" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" id="prodIngredients" placeholder="Ingredients" required></textarea>
                            </div>

                            <button type="submit" id="saveProduct" class="btn btn-block btn-success">SAVE</button>
                        </form>
                    </div>

                    <!-- Login Modal footer -->
                    <div class="modal-footer">
                        <label class="success" id='msg'></label>

                    </div>

                </div>
            </div>
        </div>