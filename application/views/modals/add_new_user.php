<div ng-app="" class="modal fade" id="modal_add_user" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <form method="post" name="userForm" action="<?php echo base_url(); ?>dashboard/users/add">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">O Shopping GSM SMS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center">Add New User</h3>
                            </div>
                            <hr>
                            <?php if($this->session->flashdata('validation_errors')){ ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error!</span>
                                    <?php echo $this->session->flashdata('validation_errors'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="gsm_sms_username" class="control-label mb-1">Username</label>
                                <input required id="gsm_sms_username" name="gsm_sms_username" type="text" class="form-control" aria-required="true" aria-invalid="false">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gsm_sms_password" class="control-label mb-1">Password</label>
                                        <input required id="gsm_sms_password" name="gsm_sms_password" type="password" class="form-control" data-val="true" aria-required="true" aria-invalid="false">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gsm_sms_cpassword" class="control-label mb-1">Confirm Password</label>
                                        <input required id="gsm_sms_cpassword" name="gsm_sms_cpassword" type="password" class="form-control" data-val="true" aria-required="true" aria-invalid="false">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gsm_sms_firstname" class="control-label mb-1">First Name</label>
                                        <input required id="gsm_sms_firstname" name="gsm_sms_firstname" type="text" class="form-control cc-number identified visa" value="" data-val="true">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="gsm_sms_lastname" class="control-label mb-1">Last Name</label>
                                    <input required id="gsm_sms_lastname" name="gsm_sms_lastname" type="text" class="form-control cc-number identified visa" value="" data-val="true">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gsm_sms_email" class="control-label mb-1">E-Mail Address</label>
                                        <input ng-model="email" required id="gsm_sms_email" name="gsm_sms_email" type="email" class="form-control" data-val="true" aria-required="true" aria-invalid="false">
                                        <span style="color:red" ng-show="userForm.gsm_sms_email.$dirty && userForm.gsm_sms_email.$invalid">
                                            <span ng-show="userForm.gsm_sms_email.$error.required">Email is required.</span>
                                            <span ng-show="userForm.gsm_sms_email.$error.email">Invalid email address.</span>
                                         </span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="gsm_sms_email" class="control-label mb-1">Level</label>
                                        <select required data-placeholder="Choose user level..." class="standardSelect" name="gsm_sms_level" tabindex="1">
                                            <option value=""></option>
                                            <option value="1">Admin</option>
                                            <option value="2">TS</option>
                                            <option value="3">Staff</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>