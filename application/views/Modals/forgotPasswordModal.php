<div class="modal" id="forgotPasswordModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- ForgotPassword Modal Header -->
            <div class="modal-header">
                <div class="row justify-content-center align-items-center">
                    <i class="fas fa-user fa-lg"></i>
                    <p class="modal-title">Nulstil adgangskode</p>
                </div>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- ForgotPassword Modal body -->
            <div class="modal-body justify-content-center">
                <form id="formForgotPassword" action="<?php echo base_url(); ?>user/">
                    <div class="form-group">
                        <label for="emailForgotPassword">Email adresse:</label>
                        <input type="email" class="form-control" required placeholder="Indtast din e-mail" id="emailForgotPassword" oninvalid="this.setCustomValidity('Indtast venligst din e-mail')" oninput="setCustomValidity('')">
                    </div>

                    <button id="btnForgotPassword" type="submit" class="btn btn-block btn-success">
                        Send
                    </button>
                    <p><span id="lblForgotPasswordError" class="text-danger" style="display: none; padding-top: 0.5rem; text-align:center;"></span></p>
                </form>
            </div>

            <!-- ForgotPassword Modal footer -->
            <div class="modal-footer justify-content-center">
                
                <button id="btnForgotPasswordConfirm" type="button" class="btn btn-block btn-success" style="display: none" data-dismiss="modal">
                    Luk
                </button>
            </div>

        </div>
    </div>
</div>