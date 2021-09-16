<div id="cardUser" class="card">
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Users</h3>
    <div class="card-body">
        <div id="table" class="table-editable">
            <table id="tableAdminUsers" class="table table-striped table-bordered table-responsive-md">
                <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i data-toggle="modal" data-target="#addAdminUser" class="fas fa-user-plus fa-2x" aria-hidden="true"></i></a></span>
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($users) {
                        $a = 1;
                        foreach ($users as $user) {

                            echo '<tr data-id="' . $user['id'] . '">';

                            echo '<td>' . $a . '</td>';

                            echo '<td><a href="#">' . $user['email'] . '</a></td>';

                            echo '<td><a class="deleteAdminUser" href="#"><i class="fas fa-trash-alt"></i></a></td>';

                            $a++;
                        }
                    } else {
                        echo '<tr>';
                        echo '<td colspan="4" style="text-align: center;">No product available.</td>';
                        echo '</tr>';
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="addAdminUser">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- ADD Category Modal Header -->
            <div class="modal-header">
                <div class="row">
                    <p class="modal-title"><i class="fas fa-user"></i>New Admin User</p>
                </div>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Login Modal body -->
            <div class="modal-body">
                <form id='formAdminUser' action="#">
                    
                    <div class="form-group">
                        <input type="email" class="form-control" required placeholder="Indtast Email" id="adminEmail" oninvalid="this.setCustomValidity('Indtast venligst din Email')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" required placeholder="Indtast Password" id="adminPassword" oninvalid="this.setCustomValidity('Indtast venligst din Password')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" required placeholder="Indtast Password Again" id="adminRePassword" oninvalid="this.setCustomValidity('Indtast venligst re Password')" oninput="setCustomValidity('')">
                    
                    </div>
                    <button id="btnNewAdmin" type="submit" class="btn btn-block btn-success">SAVE</button>
                </form>
            </div>

            <!-- Login Modal footer -->
            <div class="modal-footer">


            </div>
        </div>
    </div>
</div>