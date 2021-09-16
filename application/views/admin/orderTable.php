<table id="tableOrders" class="table table-bordered table-responsive-md table-striped text-center">
    <thead>
        <tr>                        
            <th class="text-center" style="width: 90%;">Description</th>            
            <th class="text-center" style="width: 5%;">Status</th>
            <th class="text-center" style="width: 5%;">View</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($orders) {

            $orderNo = 1;
            foreach ($orders as $order) {

                $products = $this->adminModel->getOrderDetail($order['id']);

        ?>
                <tr>                    
                    <td class="text-left align-middle">
                        <?php                        
                        foreach ($products as $product) {
                            
                            echo '<span class="text-left pr-4">'. $product["quantity"].' x '.$product["name"]. '</span>';
                            
                        }
                        if($order['comments']) {
                            echo '<a href="#" class="text-info float-right align-middle orderProcess" action="viewOrder" data-id="'.$order['id'].'">comment</a>';
                        }
                        ?>

                    </td>
                    
                    <td><button class="btn btn-success orderProcess" action='updateOrderStatus' data-id="<?php echo $order['id']; ?>">Done</button></td>
                    <td><button class="btn btn-info orderProcess" action='viewOrder' data-id="<?php echo $order['id']; ?>">View</button></td>
                </tr>
        <?php
            $orderNo +=1;
            }
        } else {
            echo "<tr>";
            echo "<td colspan='4' style='text-align: center'> No order available </td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>
<audio id="myMelody">
    <source src="<?php echo base_url(); ?>assets/sounds/bell.ogg">
    <source src="<?php echo base_url(); ?>assets/sounds/melody.mp3">
  </audio>

</div>