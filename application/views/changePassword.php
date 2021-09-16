<main class="container content">
    
    <div class="row justify-content-center">
        <div class="col-70">
            <div class="card">

                <div class="card-header">
                    <a style="color: black !important;">
                        Skift Adgangskode
                    </a>                    
                </div>
                <form id="formChangePassword" action="<?php echo base_url(); ?>profile/editPassword" method="POST" style="padding: 2rem;">
                    <div class="form-group">
                        <label for="oldPassword">Gamle adgangskode:</label>
                        <input type="password" class="form-control" placeholder="Indtast dit gamle kode" name="oldPassword" id="oldPassword" oninvalid="this.setCustomValidity('Indtast venligst dit gamle kode')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label for="newPassword">Ny adgangskode:</label>
                        <input type="password" class="form-control" placeholder="Ny kode" name="newPassword" id="newPassword" oninvalid="this.setCustomValidity('Indtast venligst dit nykode')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label for="reNewPassword">Gentage Ny adgangskode:</label>
                        <input type="password" class="form-control" placeholder="Gentage Nykode" name="reNewPassword" id="reNewPassword" oninvalid="this.setCustomValidity('Indtast venligst dit nykode igen')" oninput="setCustomValidity('')" required>
                    </div>                                                           

                    <button type="submit" class="btn btn-block btn-success">Send</button>
                    <label id = "lblChangePassword" class="text-danger" style="padding-top: 1rem; width: 100%; text-align: center; display: none;">abc</label>    
                </form>
                 
            </div>
        </div>
        <div class="col-30">
            <?= $this->load->view('cart', null, TRUE); ?>
        </div>
    </div>
</main>

