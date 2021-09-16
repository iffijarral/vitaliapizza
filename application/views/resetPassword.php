
<main class="container content">
    
    <div class="row justify-content-center">
        <?php 
        
            if($error && $error !='') {
                echo '<p>'. $error . '</p>';
            } else {

        ?>
        <div class="col-70">
            <div class="card">

                <div class="card-header">
                    <a style="color: black !important;">
                        Reset Adgangskode
                    </a>                    
                </div>
                <form id="formResetPassword" action="<?php echo base_url(); ?>user/saveResetPassword" method="POST" style="padding: 2rem;">
                    
                    <div class="form-group">
                        <label for="newPassword">Ny adgangskode:</label>
                        <input type="password" class="form-control" placeholder="Ny kode" name="newPassword" id="newPassword" oninvalid="this.setCustomValidity('Indtast venligst dit nykode')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label for="reNewPassword">Gentage adgangskode:</label>
                        <input type="password" class="form-control" placeholder="Gentage Nykode" name="reNewPassword" id="reNewPassword" oninvalid="this.setCustomValidity('Indtast venligst dit nykode igen')" oninput="setCustomValidity('')" required>
                    </div>                                                           

                    <button id="btnResetPassword" type="submit" class="btn btn-block btn-success">Send</button>
                    <label id = "lblResetPassword" class="text-danger" style="padding-top: 1rem; width: 100%; text-align: center; display: none;"></label>    
                </form>
                 
            </div>
        </div>
        <?php 
            }
        ?>
        <div class="col-30">
            <?= $this->load->view('cart', null, TRUE); ?>
        </div>
    </div>
</main>

