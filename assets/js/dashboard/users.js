/**
 * Created by EC_Jerome on 04/10/2018.
 */
$(document).ready(function(){
    $('.gsm_delete_user').on('click', function(){
        var elem_id =   $(this).attr('id');
        var user_id =   elem_id.split('-');

        if(typeof user_id[1] != 'undefined'){
            var del_link    =   base_url()+'dashboard/users/delete/'+user_id[1];
            $('.delete-user-confirm').prop('href', del_link);
        }
    })
})