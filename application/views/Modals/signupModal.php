<div class="modal" id="mySignupModal">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Signup Modal Header -->
                <div class="modal-header">
                    <div class="row justify-content-center align-items-center">
                        <i class="fas fa-user-plus fa-lg"></i>
                        <p class="modal-title">REGISTRER</p>
                    </div>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Signup Modal body -->
                <div class="modal-body">
                    <form id="formSignup" action="<?php echo base_url() ?>user/">
                        <div class="form-group">
                            <label for="name">Fornavn:</label>
                            <input type="text" class="form-control" required="true" placeholder="Indtast dit fornavn" id="fname" oninvalid="this.setCustomValidity('Indtast venligst dit navn')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="name">Efternavn:</label>
                            <input type="text" class="form-control" placeholder="Indtast dit efternavn" id="lname" oninvalid="this.setCustomValidity('Indtast venligst dit navn')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile no.:</label>
                            <input type="number" class="form-control" required="true" placeholder="Indtast dit mobile no." id="mobile" oninvalid="this.setCustomValidity('Indtast venligst dit mobile no.')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="emailSignup">Email addresse:</label>
                            <input type="email" class="form-control" required="true" placeholder="Indtast din e-mail" id="emailSignup" oninvalid="this.setCustomValidity('Indtast venligst din e-mail')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="passwordSignup">Adgangskode:</label>
                            <input type="password" class="form-control" placeholder="Indtast din adgangskode" id="passwordSignup" required="true" oninvalid="this.setCustomValidity('Indtast venligst din adgangskode')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group">
                            <label for="repPassword">Gentage adgangskode:</label>
                            <input type="password" class="form-control" placeholder="Gentag din adgangskode" id="repPassword" required="true" oninvalid="this.setCustomValidity('Gentag venligst din adgangskode')" oninput="setCustomValidity('')">
                        </div>
                        <div class="form-group text-center">
                            <label class="text-info">
                                <input type="checkbox" class="form-check-input chkPolicyCheckbox" value="">
                                Accepterer du vitaliapizzas <a href="<?php echo base_url(); ?>privacypolicy" target="_blank">Privatlivspolitik</a> og <a href="<?php echo base_url(); ?>termsandconditions" target="_blank">Handelsbetingelser?</a>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-block btn-success">REGISTRER</button>
                        <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-dismiss="modal" data-target="#myLoginModal">
                            LOG IND
                        </button>
                    </form>
                </div>

                <!-- Signup Modal footer -->
                <div class="modal-footer text-center">
                    <span id="spnError" class="text-danger"></span>
                </div>

            </div>
        </div>
    </div>
