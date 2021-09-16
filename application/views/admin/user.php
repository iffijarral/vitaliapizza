<div id="cardUser" class="card">
    <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Users</h3>
    <div class="card-body">
        <div id="table" class="table-editable">            
            <?= $this->load->view('admin/userTable', $users, true); ?>
        </div>
    </div>
</div>