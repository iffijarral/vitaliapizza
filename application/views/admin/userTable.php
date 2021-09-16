<table class="table table-striped table-bordered table-responsive-md">
    <thead>
        <tr>
        <th class="text-center">No.</th>
            <th class="text-center">Name</th>
            <th class="text-center">Mobile</th>
            <th class="text-center">Address</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $a = 1;
        foreach ($users as $user) {

            echo '<tr>';

            echo '<td>' . $a . '</td>';

            echo '<td class="text-left"><a href="user/viewOrders/' . $user['id'] . '">' . $user['fname'].' '.$user['lname']. '</a></td>';

            echo '<td>' . $user['mobile'] . '</td>';

            echo '<td class="text-left">' . $user['email'] . '</td>';

            $a++;
        }

        ?>
    </tbody>
</table>