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
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <script src="https://kit.fontawesome.com/89828176fa.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        CI_ROOT = "<?php echo base_url(); ?>"; // this CI_ROOT is being used as a base_url() in jquery
    </script>
    <link rel="icon" href="<?= base_url() ?>/assets/images/logo.png" type="image/png">
    <title>Vitalia Pizza</title>
</head>

<body>

    <header class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-dark navbar-default">
            <!-- Brand -->
            <a class="nav-link" href="<?php echo base_url(); ?>"><img class="logo" src="<?php echo base_url(); ?>assets/images/logo.png" alt="" /></a>

            <!-- Toggler/collapsibe Button -->
            <div class="mobileOnly">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <i class="fas fa-bars navbar-toggler" style="color:red;"></i>
                </button>
                
            </div>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Hjem</a>
                    </li>
                    <li class="nav-item">                    
                        <a class="nav-link" href='<?php echo base_url(); ?>admin/order'>Orders</a>
                    </li>
                    <li class="nav-item">                    
                        <a class="nav-link" href='<?php echo base_url(); ?>admin/category'>Categories</a>
                    </li>
                    <li class="nav-item">                    
                        <a class="nav-link" href='<?php echo base_url(); ?>admin/product'>Products</a>
                    </li>
                    <li class="nav-item">                    
                        <a class="nav-link" href='<?php echo base_url(); ?>admin/user'>Customers</a>
                    </li>
                    <li class="nav-item">                    
                        <a class="nav-link" href='<?php echo base_url(); ?>admin/adminuser'>Admin-User</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if ($this->session->userdata('userEmail') && $this->session->userdata('userName')) {
                            echo '<a id="adminLogOut" class="nav-link" href="#">Logud</a>';
                        } 

                        ?>

                    </li>
                </ul>
            </div>
        </nav>
       
    </header>
    