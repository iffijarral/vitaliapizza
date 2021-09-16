<main class="container content">
    <div class="row">
        <div class="col-70">
            <div class="container">
                <form id="chkOutForm">
                    <div class="row">

                        <div class="card">
                            <div class="card-header" style="cursor: auto !important;">
                                Kundens info
                            </div>

                            <div class="card-body">
                                <label for="chkFname"><i class="fa fa-user"></i>Fornavn</label>
                                <input type="text" id="chkFname" placeholder="Fornavn" required oninvalid="this.setCustomValidity('Indtast venligst dit fornavn')" oninput="setCustomValidity('')" <?php
                                                                                                                                                                                                    if (isset($customer) && !empty($customer))
                                                                                                                                                                                                        echo 'value = ' . $customer['fname'] . ' disabled="disabled"';
                                                                                                                                                                                                    ?>>
                                <label for="chkLname"><i class="fa fa-user"></i>Efternavn</label>
                                <input type="text" id="chkLname" placeholder="Efternavn" oninvalid="this.setCustomValidity('Indtast venligst dit efternavn')" oninput="setCustomValidity('')" <?php
                                                                                                                                                                                                if (isset($customer) && !empty($customer['lname']))
                                                                                                                                                                                                    echo 'value = ' . $customer['lname'] . ' disabled="disabled"';
                                                                                                                                                                                                ?>>
                                <label for="chkPhone"><i class="fa fa-address-card"></i> Telefon</label>
                                <input type="number" id="chkPhone" placeholder="Din telefonnummer" required oninvalid="this.setCustomValidity('Indtast venligst din telefonnummer')" oninput="setCustomValidity('')" <?php
                                                                                                                                                                                                                        if (isset($customer) && !empty($customer) &&  $customer['mobile'])
                                                                                                                                                                                                                            echo 'value = ' . $customer['mobile'] . ' disabled';
                                                                                                                                                                                                                        ?>>
                                <label for="chkEmail"><i class="fa fa-envelope"></i> Email</label>
                                <input type="text" id="chkEmail" name="chkEmail" placeholder="Din email" required oninvalid="this.setCustomValidity('Indtast venligst din email')" oninput="setCustomValidity('')" <?php
                                                                                                                                                                                                                    if (isset($customer) && !empty($customer))
                                                                                                                                                                                                                        echo 'value = ' . $customer['email'] . ' disabled';
                                                                                                                                                                                                                    ?>>


                                <div class="form-group">
                                    <label for="chkComments"><i class="fas fa-comment-alt"></i>Kommentar</label>
                                    <textarea class="form-control" id="chkComments"></textarea>
                                </div>
                            </div>
                            <div id="cart-footer" class="card-footer text-center">
                                <?php

                                if (!$this->session->userdata('userId')) {
                                    
                                    echo '<div id="dvPrivacy" class="form-check">';
                                    echo '<label class="text-info">';
                                    echo '<input type="checkbox" class="form-check-input chkPolicyCheckbox" value="">';                                    
                                    echo 'Accepterer du vitaliapizzas <a href="' . base_url() . 'privacypolicy" target="_blank">Privatlivspolitik</a> og <a href="' . base_url() . 'termsandconditions" target="_blank">Handelsbetingelser ?</a></label>';
                                    echo '</div>';
                                }
                                ?>
                                <input type="submit" id="order" value="Fortsat" class="btn btn-block btn-success">
                                <label class="chklblpolicy text-danger p-4" style="display: none"></label>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
        <div class="col-30 myCart">
            <?= $this->load->view('cart', array('checkOutButton' => 'disabled'), TRUE); ?>
        </div>

    </div>
</main>

