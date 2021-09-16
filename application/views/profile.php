<main class="container content">
    <div class="row justify-content-center">
        <div class="col-70">
            <div class="card">

                <div class="card-header">
                    <a style="color: black !important;">
                        PROFILDETALJER
                    </a>
                </div>
                <form id="formProfile" action="<?php echo base_url(); ?>profile/editProfile" method="POST" style="padding: 2rem;">
                    <div class="form-group">
                        <label for="fname">Fornavn:</label>
                        <input type="text" class="form-control" placeholder="Indtast din fornavn" id="fnameProfile" value="<?php echo $user['fname']; ?>" oninvalid="this.setCustomValidity('Indtast venligst dit fornavn')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Efternavn:</label>
                        <input type="text" class="form-control" placeholder="Indtast din efternavn" id="lnameProfile" value="<?php echo $user['lname']; ?>" oninvalid="this.setCustomValidity('Indtast venligst dit efternavn')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="mobileno">Mobile no:</label>
                        <input type="number" class="form-control" placeholder="Mobile no." id="mobileno" value="<?php echo $user['mobile']; ?>" oninvalid="this.setCustomValidity('Indtast venligst din mobile no.')" oninput="setCustomValidity('')" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="email" id="emailProfile" value="<?php echo $user['email']; ?>" oninvalid="this.setCustomValidity('Indtast venligst din email')" oninput="setCustomValidity('')" required>
                    </div>
                     <div class="text-center pt-4">
                        <label id="lblProfile" class="text-danger" style="display: none"></label>
                    </div>
                    <button type="submit" id="btnUserProfile" class="btn btn-block btn-success">Gem</button>
                   

                </form>
            </div>
        </div>
        <div class="col-30">
            <?= $this->load->view('cart', null, TRUE); ?>
        </div>
    </div>
</main>