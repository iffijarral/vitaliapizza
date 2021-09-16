<main class="container content">
    <div class="row justify-content-center">
        <div class="col-70">
            <table id="tableOrders" class="table table-bordered table-responsive-md table-striped text-center" style="margin-top: 0 !important;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%">No.</th>
                        <th class="text-center">Bestiling</th>
                        <th class="text-center">Belob</th>
                        <th class="text-center">Vis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($orders) {
                        $orderNo = 1;
                        foreach ($orders as $order) {


                    ?>
                            <tr>
                                <td>
                                    <?php echo $orderNo;
                                    $orderNo += 1; ?>
                                </td>
                                <td style="text-align: center">
                                    <?php echo $order['orderdate']; ?>
                                </td>
                                <td>
                                    <?php echo $order['amount'] . ' kr.'; ?>
                                </td>
                                <td>
                                    <button class="btn btn-success orderProcess" action='viewOrder' data-id="<?php echo $order['id']; ?>">Vis</button>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='4' style='text-align: center'> Der findes ingen bestilling </td>";
                        echo "</tr>";
                    }
                    ?>


                </tbody>
            </table>
        </div>
        <div class="col-30">
            <?= $this->load->view('cart', null, TRUE); ?>
        </div>                
    </div>
</main>
<div id="dvOrderDetail">

</div>