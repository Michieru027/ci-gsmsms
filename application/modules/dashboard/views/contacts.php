<div class="content mt-3">
    <button id="btn_add_new_contact" class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#add_contacts">Add New Contact</button>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">List of all contacts</strong>
                    </div>
                    <div class="card-body">
                        <table id="contacts-data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Date Added</th>
                                <?php if($this->session->userdata('level') != 'Staff'){ ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php echo $contacts_data['table_html']; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<?php $this->load->view('modals/add_contacts'); ?>
