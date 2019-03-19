<div class="modal fade" id="modal_create_sms" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">Create new SMS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="sendContainer">
                    <div class="col-12">
                        <div class="form-group">
                            <input required id="send_number" name="send_number" type="text" class="form-control autocomplete-contact-list" placeholder="To:">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="display:block;">
                <span id="send_loader" style="display:none;">Sending...</span>
                <div class="send-functions-container">
                    <div class="input-group">
                        <textarea name="textarea-input" title="Message must not be more than 250 characters" rows="1" id="send_message" maxlength="250" placeholder="Text to send" class="form-control send-msg-body"></textarea>
                        <button class="btn btn-primary btn-send-message" title="Send message"><i class="fa fa-reply"></i></button>
                    </div>
                </div>
                <div class="port-container">
                    <h6>Choose port</h6>
                    <input type="radio" name="sms_port" value="0" class="sms-ports" id="send_port_0"><label for="send_port_0">0</label>
                    <input type="radio" name="sms_port" value="1" class="sms-ports" id="send_port_1"><label for="send_port_1">1</label>
                    <input type="radio" name="sms_port" value="2" class="sms-ports" id="send_port_2"><label for="send_port_2">2</label>
                    <input type="radio" name="sms_port" value="3" class="sms-ports" id="send_port_3"><label for="send_port_3">3</label>
                    <input type="radio" name="sms_port" value="4" class="sms-ports" id="send_port_4"><label for="send_port_4">4</label>
                    <input type="radio" name="sms_port" value="5" class="sms-ports" id="send_port_5"><label for="send_port_5">5</label>
                    <input type="radio" name="sms_port" value="6" class="sms-ports" id="send_port_6"><label for="send_port_6">6</label>
                    <input type="radio" name="sms_port" value="7" class="sms-ports" id="send_port_7"><label for="send_port_7">7</label>
                </div>
            </div>
        </div>
    </div>
</div>
<button id="open_reply" data-toggle="modal" data-target="#reply_modal" style="display:none;"></button>

<script>
    $(document).ready(function(){
        $.get(base_url()+'dashboard/contacts/get_contacts_data', function(data){
            $(".autocomplete-contact-list").typeahead({ source:data });
        },'json');
    });
</script>