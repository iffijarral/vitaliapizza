<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" />
    <!-- FontAwsome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="icon" href="<?= base_url() ?>/assets/images/logo.png" type="image/png">
    <script type="text/javascript">
        CI_ROOT = "<?php echo base_url(); ?>"; // this CI_ROOT is being used as a base_url() in jquery
    </script>

    <title>Vitalia Pizzabar</title>
</head>

<body>

    <div class="modal" id="adminLogin" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h3>Admin Login</h3>

                </div>

                <!-- Modal body -->
                <div id="orderDetailModalBody" class="modal-body">
                    <form id="formLogin" method="POST" action="<?php echo base_url(); ?>admin/home/login/">
                        <div class="form-group">
                            <label for="email">Email addresse:</label>
                            <input type="email" class="form-control" required="true" placeholder="Indtast din e-mail" name="email" id="email" oninvalid="this.setCustomValidity('Indtast venligst din e-mail')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Indtast adgangskode:</label>
                            <input type="password" class="form-control" placeholder="Indtast din adgangskode" name="password" id="password" required="true" oninvalid="this.setCustomValidity('Indtast venligst din adgangskode')" oninput="setCustomValidity('')">
                        </div>

                        <button type="submit" class="btn btn-block btn-success">LOG IND</button>
                        <div class="row justify-content-center">
                            <a href="#" style="padding: 1rem; color: #28a744">Glemt adgangskode?</a>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer justify-content-center">
                    <?php

                    if ($this->session->flashdata('Error')) {

                        echo '<label class="danger">'.$this->session->flashdata("Error").'</label>';
                    }

                    ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="<?php echo base_url() ?>assets/js/admin/functions.js"></script>
</body>

</html>