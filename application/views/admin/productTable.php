<table id="tableProduct" class="table table-bordered table-responsive-md table-striped text-center">
    <thead>
        <tr>
            <th class="text-center">Product Name</th>
            <th class="text-center">Ingredients</th>
            <th class="text-center">Price</th>
            <th class="text-center">Update</th>
            <th class="text-center danger">Remove</th>
        </tr>
    </thead>

    <tbody>
        <?php
        if (isset($products)) {

            foreach ($products as $product) {
                echo '<tr id =' . $product["id"] . ' >';
                echo '<td contenteditable = "true" class = "productName" prevValue="' . $product["name"] . '">' . $product["name"] . '</td>';
                echo '<td contenteditable = "true" class = "prodIngredients" prevValue="' . $product["ingredients"] . '">' . $product["ingredients"] . '</td>';
                echo '<td contenteditable = "true" class = "prodPrice" prevValue="' . $product["price"] . '">' . $product["price"] . '</td>';
                echo '<td><button class="btn btn-success prodUpdate">UPDATE</button></td>';
                echo '<td><button class="btn btn-danger prodDelete">REMOVE</button></td>';
                echo '</tr>';
            }
        } else {

            echo '<tr>';
            echo '<td colspan="5" style="text-align: center;">No product available for selected category.  </td>';
            echo '</tr>';
        }
        ?>

    </tbody>
</table>