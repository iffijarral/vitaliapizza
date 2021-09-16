<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/styles.css" type="text/css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- FontAwsome CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <script src='https://kit.fontawesome.com/a076d05399.js'></script> -->
    <script src="https://kit.fontawesome.com/89828176fa.js" crossorigin="anonymous"></script>
    <link rel="icon" href="<?= base_url() ?>/assets/images/logo.png" type="image/png">

    <title>Vitalia Pizza</title>


    <script type="text/javascript">
        CI_ROOT = "<?php echo base_url(); ?>"; // this CI_ROOT is being used as a base_url() in jquery
    </script>
</head>

<body>
    <div class="container-fluid header">


        <header class="container">


            <?php
            $subTotal = 0;
            $cartSize = 0;

            if ($this->session->userdata('cartCount')) {
                $cartSize = $this->session->userdata('cartCount');
            } 
            
           
            function isStoreOpen()
            {
                $status = FALSE;
                $storeSchedule = [
                    'Mon' => ['11:00 AM' => '09:00 PM'],
                    'Tue' => ['11:00 AM' => '09:00 PM'],
                    'Wed' => ['11:00 AM' => '09:00 PM'],
                    'Thu' => ['11:00 AM' => '09:00 PM'],
                    'Fri' => ['11:00 AM' => '09:00 PM'],
                    'Sat' => ['02:00 PM' => '09:00 PM'],
                    'Sun' => ['02:00 PM' => '09:00 PM'],
                ];

                //get current East Coast US time
                $timeObject = new DateTime('Europe/Copenhagen');
                $timestamp = $timeObject->getTimeStamp();
                $currentTime = $timeObject->setTimestamp($timestamp)->format('H:i A');

                // loop through time ranges for current day
                foreach ($storeSchedule[date('D', $timestamp)] as $startTime => $endTime) {

                    // create time objects from start/end times and format as string (24hr AM/PM)
                    $startTime = DateTime::createFromFormat('h:i A', $startTime)->format('H:i A');
                    $endTime = DateTime::createFromFormat('h:i A', $endTime)->format('H:i A');


                    // check if current time is within the range
                    if (($startTime < $currentTime) && ($currentTime < $endTime)) {
                        $status = TRUE;
                        break;
                    }
                }
                return $status;
            }
            
            ?>
            <nav class="navbar navbar-expand-lg navbar-dark navbar-default">
                <!-- Brand -->

                <ul class="list-inline">
                    <li class="list-inline-item mr-0 pr-0 pl-0">
                        <a class="nav-link p-0" href="<?php echo base_url(); ?>"><img class="logo" src="<?php echo base_url(); ?>assets/images/logo.png" alt="" /></a>
                    </li>
                    <li class="list-inline-item align-middle pl-0">
                        <div class="mx-auto">
                            <h4 style="border-bottom: 1px solid red;"> Vitalia Pizzabar </h4>
                            <?php
                            if (isStoreOpen()) {
                                echo '<div class="mx-auto  open"><i class="far fa-clock"></i>Åbent</div>';
                            } else {
                                echo '<div class="mx-auto open"><i class="far fa-clock"></i>Lukket</div>';
                            }
                            ?>
                        </div>

                    </li>
                </ul>
                <!-- Toggler/collapsibe Button -->
                <div class="mobileOnly">
                    <i class="fa fa-shopping-cart fa-lg cartIcon" style="color: grey;"></i><span class='badge badge-warning lblCartCount' id='lblCartCount'> <?php echo $cartSize; ?> </span>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <i class="fas fa-bars navbar-toggler" style="color:red;"></i>
                    </button>
                </div>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>"><i class="fas fa-home"></i></a>
                        </li>
                        <?php
                        if ($this->session->userdata('userEmail') && $this->session->userdata('userId')) {
                        ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                    Personale
                                </a>
                                <div class="dropdown-menu" style="background-color: #b8edb8">
                                    <a class="dropdown-item btnProfile" href="<?php echo base_url(); ?>profile">Profil</a>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>profile/changepassword">Skift Adgangskode</a>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>info">Historie</a>
                                </div>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <?php
                            if ($this->session->userdata('userEmail') && $this->session->userdata('userId')) {
                                echo '<a id="btnLogOut" class="nav-link" href="#">Logud</a>';
                            } else {
                                echo '<a id="btnLogin" class="nav-link" href="#">Logind</a>';
                            }

                            ?>

                        </li>
                    </ul>
                </div>
            </nav>


        </header>
    </div>
    <!-- The Login Modal -->
    <?= $this->load->view('Modals/loginModal', null, TRUE); ?>
    <!-- The Signup Modal -->
    <?= $this->load->view('Modals/signupModal', null, TRUE); ?>
    <!-- The Forgot Password Modal -->
    <?= $this->load->view('Modals/forgotPasswordModal', null, TRUE); ?>

    <div id="page-container">
   