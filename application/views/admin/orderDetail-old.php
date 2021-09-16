
<div class="modal" id="orderDetail">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3>Order Detail</h3>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?php
                foreach ($items as $item) {
                ?>
                    <div class="row" style="padding: 2rem;">
                        <div class="col-md-6">
                            <?php echo $item['quantity'] . ' x ' . $item['name']; ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo $item['price']; ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer justify-content-center">

            </div>

        </div>
    </div>
</div>