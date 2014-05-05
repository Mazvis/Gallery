(function($){
    var done = true;
    function doAjaxValidation(){
        // set packman on each invalid input
        $('#registration input').each(function(){
            if( $(this).parent().hasClass('has-error') || $(this).hasClass('current-writing') )
                $(this).addClass('loading');
        });
        //------------------------------------------------------
        if(done == true){
            done = false;
            function restoreFields(){
                $('.help-block').text("");
                $('.has-error').removeClass('has-error');
                $('input#is_clicked').val('no');
                $('#submit-form').removeAttr('disabled');
            }
            setTimeout(function(){
                jQuery.ajax({
                    type: "POST",
                    url: 'validate-registration',
                    data: {
                        first_name: $('#registration #register-first-name').val(),
                        last_name:  $('#registration #register-last-name').val(),
                        email:      $('#registration #register-name').val(),
                        username:   $('#registration #register-username').val(),
                        password:   $('#registration #register-password').val(),
                        password_confirmation: $('#registration #register-repeat-password').val(),
                        is_clicked: $('#registration #is_clicked').val()
                    }
                }).done(function( msg ) {
                        if( msg == "OK" )
                            window.location.replace("/"); //goes to main page
                        else if( msg == "GOOD" ){
                            restoreFields();
                            $('#registration .alert-danger').hide("slow");
                            $('#registration .alert-success').slideDown("slow");
                        } else{
                            restoreFields();
                            $('#registration .alert-success').hide("slow");
                            $('#registration .alert-danger').slideDown("slow");
                            $.each( msg, function( key, value ) {
                                if( $('input[name="' + key + '"]').val() != "" ){
                                    jQuery('.message-' + key).text(value);
                                    jQuery('.message-' + key).parent().addClass('has-error');
                                }
                            });
                        }
                        done = true;
                        $('.loading').removeClass('loading');
                    });
            }, 700);
        }
    }
    $('html').keyup(function(){
        doAjaxValidation();
    });
    $('#submit-form').click(function(){
        $('input#is_clicked').val('yes');
        $('#submit-form').attr('disabled', 'disabled');
        doAjaxValidation();
    });
    $('#registration input').attr('autocomplete', 'off');
    $('#registration .alert-danger, #registration .alert-success').css('display', 'none');
    $('#registration input').focus(function(){
        $('.current-writing').removeClass('current-writing');
        $(this).addClass('current-writing');
    });
})(jQuery);