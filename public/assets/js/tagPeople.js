/**
 * Created with JetBrains PhpStorm.
 * User: Elvinas
 * Date: 14.5.21
 * Time: 15.47
 * To change this template use File | Settings | File Templates.
 */
(function($){

    $('body').delegate('#add-user','click', addUser);
    $('body').delegate('#del-user','click', deleteUser);

    $('#users').delegate('#name', 'keyup',function(){
        var k = this;
        $.post('../getUserByStr',{string: $(k).val()},
        function(data){
            $(k).autocomplete({
                source: data
            });
        });
    });

    function addUser(){
        var k = this;
        var rod = $(k).children();
        console.log($(k).parent().children('#username').children('#name').val());
        $.post('../checkOrUserExists',{username: $(k).parent().children('#username').children('#name').val()},
            function(response){
                console.log(response);
                if(response == "OK"){
                    $(rod).attr('class', 'glyphicon glyphicon-minus-sign');
                    $(rod).parent().attr('id', 'del-user');
                    $('#users').append($("<div style='margin-top: 10px' class='row form-inline'>" +
                    "<div id='username' class='col-md-4 input-group-sm'>" +
                       "<input id='name' name='users[]' type='text' class='form-control' autocomplete='off' placeholder='Username'>" +
                        "</div>"
                        + "<button id='add-user' type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-plus-sign'></span></button>" +
                    "</div>"));
                }
            })
    }

    function deleteUser(){
        $(this).parent().remove();
    }

    $('body').delegate('#up-add-user','click', upAddUser);
    $('body').delegate('#up-del-user','click', deleteUser);

    $('#users').delegate('#up-name', 'keyup',function(){
        var k = this;
        $.post('../../../getUserByStr',{string: $(k).val()},
            function(data){
                $(k).autocomplete({
                    source: data
                });
            });
    });

    function upAddUser(){
        var k = this;
        var rod = $(k).children();
        console.log($(k).parent().children('#username').children('#name').val());
        $.post('../../../checkOrUserExists',{username: $(k).parent().children('#username').children('#up-name').val()},
            function(response){
                console.log(response);
                if(response == "OK"){
                    $(rod).attr('class', 'glyphicon glyphicon-minus-sign');
                    $(rod).parent().attr('id', 'up-del-user');
                    $('#users').append($("<div style='margin-top: 10px' class='row form-inline'>" +
                        "<div id='username' class='col-md-4 input-group-sm'>" +
                        "<input id='up-name' name='users[]' type='text' class='form-control' autocomplete='off' placeholder='Username'>" +
                        "</div>"
                        + "<button id='up-add-user' type='button' class='btn btn-default btn-sm'><span class='glyphicon glyphicon-plus-sign'></span></button>" +
                        "</div>"));
                }
            })
    }
})(jQuery);
