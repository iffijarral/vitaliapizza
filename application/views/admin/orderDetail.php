<div class="modal" id="orderDetailModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- orderDetail Modal Header -->
            <div class="modal-header">
                <div class="row">
                    <i class="fas fa-pizza"></i>
                    <p class="modal-title">Bestillingsdetaljer</p>
                </div>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- orderDetail Modal body -->
            <div class="modal-body">
                <?php
                $name = $orders[0]['userName'];
                $mobile = $orders[0]['mobile'];
                $email = $orders[0]['email'];
                $time = $orders[0]['orderdate'];
                ?>

                <?php
                $total = 0;

                foreach ($orders as $order) {
                ?>
                    <div class="row text-center pt-2">
                        <div class="col-50">
                            <?php echo $order['quantity'] . ' x ' . $order['productName']; ?>
                        </div>
                        <div class="col-50">
                            <?php echo $order['price'] . ' kr.'; ?>
                        </div>
                    </div>
                <?php
                    $total += (int) $order['price'];
                }
                ?>
                <div class="row text-center pt-4">
                    <div class="col-50">
                        <b>Total.</b>
                    </div>
                    <div class="col-50">
                        <b><?php echo $total . ' kr.'; ?></b>
                    </div>
                </div>
                <div class="alert alert-success text-center">
                    <strong>Note!</strong> <?php echo $order['comments']; ?>
                </div>
                <hr>

                
                    <div style="padding-left: 12%">
                        
                        <p style="text-align: left"><i class="fas fa-user"></i><?php echo $name; ?></p>

                        <p style="text-align: left"><i class="fa fa-phone" style="margin-right: 0.5rem"></i><?php echo $mobile; ?></p>

                        <p><i class="fa fa-envelope" style="margin-right: 0.5rem"></i><?php echo $email; ?></p>
                    </div>
                   
                </div>
            </div>

            <!-- orderDetail Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-info btnPrintOrder">Print</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>