<div id="order" class="card">
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Orders</h3>
    <div class="card-body">
        <div id="table" class="table-editable">   
            <div class="row float-right mb-3 mr-2">

                <div class="input-group">

                    <input type="text" class="form-control mr-1" required="true" placeholder="TransactionID" id="tid" oninvalid="this.setCustomValidity('Indtast venligst Transaction ID')" oninput="setCustomValidity('')">
                    <span class="input-group-btn">
                        <button id="btnTransaction" class="btn btn-success" type="button">Find</button>
                    </span>
                </div>
            </div>
            <div id="dvOrderTable">
                <?= $this->load->view('admin/orderTable', $orders, true); ?>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="orderStop" value="0" >
<div id="dvOrderDetail">

</div>