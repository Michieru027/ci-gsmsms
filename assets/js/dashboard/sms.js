/**
 * Created by EC_Jerome on 24/09/2018.
 */
$(document).ready(function(){

    $('tr.sms-text, tr.sms-sent-text').on('click', function(){
        var reply_to    =   $(this).attr('data-number');
        var state       =   $(this).attr('data-state');
        var sms_id      =   $(this).attr('id').split('-');
        var reply_html  =   '';
        $('#replyContainer').html(loader_html);
        $('#open_reply').trigger('click');
        $.ajax({
            type: 'POST',
            url: base_url()+'dashboard/SMS/fetch_sms_data',
            dataType: 'json',
            data: {sms_id:sms_id[1], sms_no:reply_to, state:state},
            success: function(response){
                $('.reply-loader').hide();

                var add_contact =   '';

                if(response.contact_name != ''){
                    add_contact +=   response.contact_name;
                }else{
                    add_contact +=   reply_to+' <a href="javascript:void(0)" data-toggle="modal" data-target="#add_contacts" onclick="resetfields(\'contact\')" id="add_contact" title="Add to Contacts" class="btn btn-default">+<i class="ti ti-user"></i></a>';
                }

                reply_html  +=  '<div class="card-body clas" style="padding-top:0px;">';
                reply_html  +=  '   <div class="card-title">';
                reply_html  +=  '       <h3 class="text-center reply-title" style="font-size:1.35rem;">Reply to '+add_contact+'</h3>';
                reply_html  +=  '   </div>';
                reply_html  +=  '   <hr>';
                reply_html  +=  '   <div class="thread-container">';
                reply_html  +=  '       <div class="reply-body reply-message-body">'+response.html_reply+'</div>';
                reply_html  +=  '           <input type="hidden" id="reply_sms_id" value="'+response.thread_id+'">';
                reply_html  +=  '           <input type="hidden" id="reply_recepient" value="'+reply_to+'">';
                reply_html  +=  '       </div>';
                reply_html  +=  '   </div>';
                reply_html  +=  '</div>';
                $('#sms-'+response.thread_id).find('.badge-new').remove();
                $('#port_'+response.port).prop('checked', true);
                $('#replyContainer').html(reply_html);
                $('#contacts_number').val(reply_to);
            }
        });
    });
    
    $('.btn-reply-message').on('click', function(){
        var reply_body  =   $('.reply-msg-body').val();
        var sms_id      =   $('#reply_sms_id').val();
        var recepient   =   $('#reply_recepient').val();
        var port        =   $('input[name="reply_port"]:checked').val();
        if(typeof port == 'undefined'){
            alert('Please choose a port');
        }else{
            if(reply_body == ''){
                $('.reply-msg-body').focus();
                alert('Please enter a message to reply');
            }else{
                $('.reply-functions-container').hide();
                $('#reply_loader').show();
                $.ajax({
                    type: 'POST',
                    url: base_url()+'dashboard/SMS/reply_sms_api',
                    data:{sms_id:sms_id,recepient:recepient,port:port,reply_body:reply_body},
                    dataType:'json',
                    success: function(response){

                        if(response.state == 'success'){
                            // $('#thread-'+response.thread_id).after(response.sent_body);
                            $('.thread-item').last().after(response.sent_body);
                        }else{
                            alert(response.state + ': '+ response.msg);
                        }
                        $('.reply-msg-body').val('');
                        $('.reply-functions-container').show();
                        $('#reply_loader').hide();
                    }
                })
            }
        }
    });

    $('.btn-send-message').on('click', function(){
        var sms_body    =   $('.send-msg-body').val();
        var recepient   =   $('#send_number').val();
        var port        =   $('input[name="sms_port"]:checked').val();
        var valid       =   true;
        var sent_html   =   '';
        if(recepient == ''){
            alert('Recepient cannot be empty');
            $('#send_number').focus();
            valid  =   false;
        }

        if(sms_body == ''){
            alert('Message to be sent cannot be empty');
            $('.send-msg-body').focus();
            valid  =   false;
        }

        if(typeof port == 'undefined'){
            alert('Please choose which port to use');
            valid  =   false;
        }

        if(valid){
            $('.send-functions-container').hide();
            $('#send_loader').show();
            $.ajax({
                type: 'POST',
                url: base_url()+'dashboard/SMS/send_new_sms_api',
                dataType: 'json',
                data:{recepient:recepient, sms_body:sms_body, port:port},
                success: function(response){
                    $('.send-functions-container').show();
                    $('#send_loader').hide();
                    sent_html  +=  '<div class="card-body clas" style="padding-top:0px;">';
                    sent_html  +=  '   <div class="card-title">';
                    sent_html  +=  '       <h3 class="text-center reply-title" style="font-size:1.35rem;">Sent to '+response.contact+'</h3>';
                    sent_html  +=  '   </div>';
                    sent_html  +=  '   <hr>';
                    sent_html  +=  '   <div class="thread-container">';
                    sent_html  +=  '       <div class="reply-body reply-message-body">'+response.sent_body+'</div>';
                    sent_html  +=  '           <input type="hidden" id="sent_sms_id" value="'+response.thread_id+'">';
                    sent_html  +=  '           <input type="hidden" id="sent_recepient" value="'+recepient+'">';
                    sent_html  +=  '       </div>';
                    sent_html  +=  '   </div>';
                    sent_html  +=  '</div>';

                    $('#send_message').val('');
                    $('#sendContainer').html(sent_html);
                }
            })
        }

    });

    $('#btn-save-contact').on('click', function(){
        $('#contact_succcess').hide();
        $('#contact_failed').hide();
        $('.form-loader').show();
        $('.form-content').hide();
        var contact_number  =   $('#contacts_number').val();
        var first_name      =   $('#contacts_firstname').val();
        var last_name       =   $('#contacts_lastname').val();
        var valid           =   true;
        if(contact_number == ''){
            valid   =   false;
            $('#contacts_number').focus();
        }

        if(first_name == ''){
            valid   =   false;
            $('#contacts_firstname').focus();
        }

        if(last_name == ''){
            valid   =   false;
            $('#contacts_lastname').focus();
        }

        if(valid){
            $.ajax({
                type: "POST",
                url: base_url()+'dashboard/contacts/add',
                data:{contact_number:contact_number,first_name:first_name,last_name:last_name},
                dataType: 'json',
                success:function(response){
                    if(response.state == 'success'){
                        $('.reply-title').html('Reply to '+response.contact_name);
                        $('#contact_succcess').show();
                        $('#contact_succcess').find('.notif_msg').html(response.message);
                        $('.add-contact-buttons').hide();
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    }else{
                        $('#contact_failed').show();
                        $('#contact_failed').find('.notif_msg').html(response.message);
                        $('.form-content').show();
                    }
                    $('.form-loader').hide();
                }
            })
        }else{
            alert('Please fill required fields');
        }
    })

    $('.import-btn').on('click', function(){
        $('#sms_data_import').click();
    });

    $('#sms_data_import').on('change', function(){
        $('#import-form').submit();
    })
});

function resetfields(module){
    $('#contact_succcess').hide();
    $('#contact_failed').hide();
    $('.form-content').show();
    $('.form-loader').hide();
}





