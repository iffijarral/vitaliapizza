<h1>Users</h1>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $a = 1;
            foreach ($orders as $order) {

                echo '<tr>';

                echo '<td>' . $a . '</td>';

                echo '<td><a href="user/viewOrders">' . $order['orderdate'] . '</a></td>';

                echo '<td>' . $order['amount'] . '</td>';

                echo '<td>' . $order['type'] . '</td>';

                $a++;
            }

            ?>
        </tbody>
    </table>
</div>


