<div class="modal fade" id="reply_modal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="largeModalLabel">O Shopping GSM SMS Reply</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="replyContainer">

                </div>
            </div>
            <div class="modal-footer" style="display:block;">
                <span id="reply_loader" style="display:none;">Sending...</span>
                <div class="reply-functions-container">
                    <div class="input-group">
                        <textarea name="textarea-input" title="Message must not be more than 250 characters" rows="1" id="text_reply_body" maxlength="250" placeholder="Text to reply" class="form-control reply-msg-body"></textarea>
                        <button class="btn btn-primary btn-reply-message" title="Send reply"><i class="fa fa-reply"></i></button>
                    </div>
                </div>
                <div class="port-container">
                    <h6>Choose port</h6>
                    <input type="radio" name="reply_port" value="0" class="reply-ports" id="port_0"><label for="port_0">0</label>
                    <input type="radio" name="reply_port" value="1" class="reply-ports" id="port_1"><label for="port_1">1</label>
                    <input type="radio" name="reply_port" value="2" class="reply-ports" id="port_2"><label for="port_2">2</label>
                    <input type="radio" name="reply_port" value="3" class="reply-ports" id="port_3"><label for="port_3">3</label>
                    <input type="radio" name="reply_port" value="4" class="reply-ports" id="port_4"><label for="port_4">4</label>
                    <input type="radio" name="reply_port" value="5" class="reply-ports" id="port_5"><label for="port_5">5</label>
                    <input type="radio" name="reply_port" value="6" class="reply-ports" id="port_6"><label for="port_6">6</label>
                    <input type="radio" name="reply_port" value="7" class="reply-ports" id="port_7"><label for="port_7">7</label>
                </div>
            </div>
        </div>
    </div>
</div>
<button id="open_reply" data-toggle="modal" data-target="#reply_modal" style="display:none;"></button>