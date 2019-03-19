<?php if($this->session->userdata('level') == 'Admin'){ ?>
<div class="content mt-3">
    <button id="btn_add_new_user" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#modal_add_user">Add New User</button>
</div>
<?php } ?>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">List of all users</strong>
                    </div>
                    <div class="card-body">
                        <table id="data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>E-Mail</th>
                                <th>Level</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php echo $user_data['table_html']; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<?php $this->load->view('modals/add_new_user'); ?>
<?php $this->load->view('modals/delete_user'); ?>
<?php if($this->session->flashdata('validation_errors')){ ?>
<script>
    $(document).ready(function(){
        $('#btn_add_new_user').click();
    })
</script>
<?php } ?>