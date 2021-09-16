<table id="tableCategory" class="table table-bordered table-responsive-md table-striped text-center">
    <thead>
        <tr>
            <th class="text-center" style="width: 80%;">Category Name</th>
            <th class="text-center" style="width: 20%;">Update</th>
            <th class="text-center" style="width: 20%;">Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($categories as $category) {

        ?>
            <tr class="category" id='<?php echo $category['id']; ?>'>
                <td class="catData text-left" contenteditable="true" colName="name" prevVal="<?php echo $category['name']; ?>"> <?php echo $category['name']; ?> </td>
                <td><button class="btn btn-success btnUpdateCategory">UPDATE</button></td>
                <td><button class="btn btn-danger btnDeleteCategory">DELETE</button></td>
            </tr>
        <?php
        }
        ?>


    </tbody>
</table>