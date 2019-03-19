function loader(state){
    switch(state){
        case    'show':
            $('.ajax-loader').show();
            break;
        case    'hide':
            $('.ajax-loader').hide();
            break;
    }
}

$(document).ready(function(){
    $('input[type="text"], textarea').on('paste', function(e){
        e.preventDefault();
    })

    $('.currency-field').on('keypress', function(event){
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57) && (event.which != 8)) {
            event.preventDefault();
        }
    });

    $('.number-field').on('keypress', function(event){
        if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });
});