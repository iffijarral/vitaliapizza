<div class="modal" id="myLoginModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Login Modal Header -->
            <div class="modal-header">
                <div class="row justify-content-center align-items-center">
                    <i class="fas fa-user fa-lg"></i>
                    <p class="modal-title">LOG IND</p>
                   
                    <a class="text-danger" id="lnkToCheckout" href="<?php echo base_url(); ?>checkout" style="padding-left: 1rem; text-decoration: underline;">Eller Fast Track</a>
                  
                </div>

                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Login Modal body -->
            <div class="modal-body">
                <form id="formLogin" action="<?php echo base_url(); ?>user/">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" required="true" placeholder="email" id="email" oninvalid="this.setCustomValidity('Indtast venligst din e-mail')" oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Adgangskode:</label>
                        <input type="password" class="form-control" placeholder="adgangskode" id="password" required="true" oninvalid="this.setCustomValidity('Indtast venligst din adgangskode')" oninput="setCustomValidity('')">
                    </div>

                    <button type="submit" class="btn btn-block btn-success">LOG IND</button>
                    <div class="action p-2">
                        <a id="lnkForgotPassword" href="#" style="color: grey">Glemt adgangskode?</a>
                        
                        <button type="button" class="btn btn-info" data-toggle="modal" data-dismiss="modal" data-target="#mySignupModal">
                            OPRET EN NY KONTO
                        </button>
                    </div>
                    <!--<button type="button" class="btn btn-block btn-info" data-toggle="modal" data-dismiss="modal" data-target="#mySignupModal">-->
                    <!--    OPRET EN NY KONTO-->
                    <!--</button>-->
                    <input type="hidden" id="isCheckout">
                    <span class="text-danger error"></span>
                </form>
            </div>

            <!-- Login Modal footer -->
            <!--<div class="modal-footer justify-content-center">-->
                
            <!--</div>-->

        </div>
    </div>
</div>