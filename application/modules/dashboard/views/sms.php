<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-received" role="tab" aria-controls="nav-home" aria-selected="true">Received</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-sent" role="tab" aria-controls="nav-profile" aria-selected="false">Sent</a>
                    </div>
                </nav>
                <div class="tab-content pl-3 pt-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-received" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List of Received SMS</strong>
                                <?php if($this->template->Vars('username') == 'admin'){ ?>
                                    <div class="sms-import-container">
                                        <input type="file" id="sms_data_export" name="sms_export_data" class="form-control-file" style="display:none;">
                                        <?php echo form_open_multipart('spreadsheet/import/received', array('id' => 'import-form'));?>
                                        <button type="button" class="btn btn-primary import-btn"><i class="ti ti-import"></i> Import Received Data</button>
                                        <input type="file" id="sms_data_import" name="sms_import_data" class="form-control-file" style="display:none;">
                                        </form>
                                        <a href="<?php echo base_url(); ?>spreadsheet/export/received" class="btn btn-primary export-btn"><i class="ti ti-export"></i> Export Received Data</a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <table id="sms-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Incoming SMS Id</th>
                                        <th>Port</th>
                                        <th>From</th>
                                        <th>Text</th>
                                        <th>Date Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php echo $received_sms['table_html']; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-sent" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">List of Sent SMS</strong>
                                <?php if($this->template->Vars('username') == 'admin'){ ?>
                                    <div class="sms-import-container">
                                        <input type="file" id="sms_data_export" name="sms_export_data" class="form-control-file" style="display:none;">
                                        <?php echo form_open_multipart('spreadsheet/import/sent', array('id' => 'import-form'));?>
                                        <button type="button" class="btn btn-primary import-btn"><i class="ti ti-import"></i> Import Sent Data</button>
                                        <input type="file" id="sms_data_import" name="sms_import_data" class="form-control-file" style="display:none;">
                                        <a href="<?php echo base_url(); ?>spreadsheet/export/sent" class="btn btn-primary export-btn"><i class="ti ti-export"></i> Export Sent Data</a>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <table id="sms-data-table" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>SMS Id</th>
                                        <th>Sent to</th>
                                        <th>Port</th>
                                        <th>Text</th>
                                        <th>Date Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php echo $sent_sms['table_html']; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<style>
    body.index{overflow-y:scroll !important;}
</style>
<?php $this->load->view('modals/reply'); ?>
<?php $this->load->view('modals/add_contacts'); ?>
<script>
    $(document).ready(function(){
        $('#contacts_number').attr('disabled', true);
    })
</script>
