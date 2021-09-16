<div id="cardCategory" class="card">
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Categories</h3>
    <div class="card-body">
        <div id="table" class="table-editable">
            <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i data-toggle="modal" data-target="#addCat" class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
            <?= $this->load->view('admin/categoryTable', $categories, true); ?>
        </div>

        <div class="modal" id="addCat">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- ADD Category Modal Header -->
                    <div class="modal-header">
                        <div class="row">
                            <p class="modal-title">NEW CATEGORY</p>
                        </div>

                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Login Modal body -->
                    <div class="modal-body">
                        <form action="<?php echo base_url() ?>admin/home/createCategory">
                            <div class="form-group">
                                <input type="text" class="form-control" required="true" placeholder="Indtast Category navn" id="catName" oninvalid="this.setCustomValidity('Indtast venligst Category navn')" oninput="setCustomValidity('')">
                            </div>
                            <button id="btnCatSave" type="button" class="btn btn-block btn-success">SAVE</button>
                        </form>
                    </div>

                    <!-- Login Modal footer -->
                    <div class="modal-footer">


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>