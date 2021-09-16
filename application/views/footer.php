<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="<?php echo base_url() ?>assets/js/user.js"></script>
<script src="<?php echo base_url() ?>assets/js/cart.js"></script>
<script src="<?php echo base_url() ?>assets/js/functions.js"></script>

<footer class="container-fluid mt-4 footer" style="background-color: #b8edb8;">
    <div class="container font-small pt-4">

        <!-- Footer Links -->

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-4 text-center text-md-left">

                <!-- Content -->
                <h5 class="text-uppercase pb-0 mb-0">Vitalia Pizzabar</h5><small> (CVR#. 33 90 90 71)</small>   
                <div class="pt-2">

                    <p><i class="fa fa-home" style="margin-right: 0.5rem"></i>Ordrupvej 52, 2920 Charlottenlund.</p>
                    <p><i class="fa fa-phone" style="margin-right: 0.5rem"></i>39 64 23 49, 27 14 70 53</p>
                    <p><i class="fa fa-envelope" style="margin-right: 0.5rem"></i><a href="mailto:mira@vitaliapizza.dk">mira@vitaliapizza.dk</a></p>  
                    <p><i class="fas fa-balance-scale"></i><a href="<?php echo base_url(); ?>termsandconditions">Handelsbetingelser</a></p>
                    <p><i class="fas fa-user-secret"></i><a href="<?php echo base_url(); ?>privacypolicy">Privatlivspolitik</a></p>
                    
                </div>
            </div>
            <!-- Grid column -->


            <!-- Grid column -->
            <div class="col-md-4 text-center">
                <h5 class="text-uppercase">Åbningstider</h5>
                <div class='pt-2'>

                    <?php
                    
                    $myDays = array(
                        'Monday' => '11:00 - 21:00',
                        'Tuesday' => '11:00 - 21:00',
                        'Wednesday' => '11:00 - 21:00',
                        'Thursday' => '11:00 - 21:00',
                        'Friday' => '11:00 - 21:00',
                        'Saturday' => '14:00 - 21:00',
                        'Sunday' => '14:00 - 21:00'
                    );

                    $danskDays = array(
                        'Monday' => 'Mandag',
                        'Tuesday' => 'Tirsdag',
                        'Wednesday' => 'Onsdag',
                        'Thursday' => 'Torsdag',
                        'Friday' => 'Fredag',
                        'Saturday' => 'Lørdag',
                        'Sunday' => 'Søndag'
                    );
                    
                    date_default_timezone_set("Europe/Copenhagen");
                    
                    $today = date('l');
                   
                    foreach ($myDays as $day => $time) {
                        if($day == $today) {
                            echo '<p class="text-info">'.$danskDays[$day].':  '.$time.'</>';
                        } else 
                            echo '<p>'.$danskDays[$day].':  '.$time.'</p>';
                    }
                    ?>
                    

                </div>
            </div>

            <!-- Grid column -->
            <div class="col-md-4 text-center">

                <!-- Links -->
                <h5 class="text-uppercase">Accepterede kort</h5>

                <div class="icon-container pt-2">
                    <i class="fab fa-cc-visa" style="color:navy;"></i>
                    <i class="fab fa-cc-amex" style="color:blue;"></i>
                    <i class="fab fa-cc-mastercard" style="color:red;"></i>
                    <i class="fab fa-cc-discover" style="color:orange;"></i>
                </div>
                <h5 class="text-uppercase">Følg os</h5>

                <div class="icon-container">
                    <i class="fab fa-facebook-square"></i>
                    <i class="fab fa-twitter-square"></i>
                    <i class="fab fa-google-plus-square"></i>
                    <i class="fab fa-youtube-square"></i>
                </div>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->


        <!-- Footer Links -->

        <!-- Copyright -->
        <!-- <div class="footer-copyright text-center py-3">
            © 2020 Copyright: Vitalia Pizzabar
        </div> -->
        <!-- Copyright -->

</footer>
<!-- Footer -->
</div>
</body>

</html>