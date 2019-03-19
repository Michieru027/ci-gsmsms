<div class="modal fade" id="add_contacts" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
<!--            <form method="post" action="--><?php //echo base_url(); ?><!--dashboard/contacts/add">-->
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Save to Contacts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="pay-invoice">
                        <div class="card-body">
                            <div id="contact_succcess" style="display:none;">
                                <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
                                    <span class="badge badge-pill badge-success">Success</span>
                                    <div class="notif_msg"></div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                            <div id="contact_failed" style="display:none;">
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error</span>
                                    <div class="notif_msg"></div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>

                            <div class="form-loader" style="display:none;"><img src="<?php echo $this->template->Images(); ?>logo-loader.gif" /></div>
                            <div class="form-content">
                                <div class="form-group">
                                    <label for="gsm_sms_username" class="control-label mb-1">Number<span class="req-field">*</span></label>
                                    <input id="contacts_number" name="contacts_number" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="gsm_sms_firstname" class="control-label mb-1">First Name<span class="req-field">*</span></label>
                                            <input required id="contacts_firstname" name="contacts_firstname" type="text" class="form-control cc-number identified visa" value="" data-val="true">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="gsm_sms_lastname" class="control-label mb-1">Last Name<span class="req-field">*</span></label>
                                        <input required id="contacts_lastname" name="contacts_lastname" type="text" class="form-control cc-number identified visa" value="" data-val="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer add-contact-buttons">
                    <button type="submit" id="btn-save-contact" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                </div>
<!--            </form>-->
        </div>
    </div>
</div>