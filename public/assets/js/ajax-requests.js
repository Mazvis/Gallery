(function($){

/*--------------------------------------------------------------------------------------------------------------------*/
//Home page
/*--------------------------------------------------------------------------------------------------------------------*/
    //delete photo
    $('body').delegate("#delete-photo-in-home", "click",function () {
        var photoIdToDelete = $(this).parents('.photo-link').data('id');
        $.ajax({
            type: "POST",
            url: 'delete-photo',
            data: {
                photoId: photoIdToDelete
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
                //showPhotosInAlbumPage();
            });
    });

/*--------------------------------------------------------------------------------------------------------------------*/
//Albums page
/*--------------------------------------------------------------------------------------------------------------------*/

    //create album
    form('#create-album-form', 'create-album');

    //deletes album
    $('body').delegate("#delete-album-in-albums", "click",function (){
        var albumIdToDelete = $(this).parents('#delete-album-data').data('albumid');
        $.ajax({
            type: "POST",
            url: 'delete-album',
            data: {
                albumId: albumIdToDelete
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
                //showAlbumsInAlbumPage();
            });
    });

/*--------------------------------------------------------------------------------------------------------------------*/
//Single album page
/*--------------------------------------------------------------------------------------------------------------------*/

    //upload photos
    form('#upload-photos-to-album-form', '../upload-photos-to-album');

    //edit album
    form('#edit-album-data-form', '../edit-album-data');

    //delete album
    $('body').delegate("#delete-album-in-album-page", "click",function () {
        var albumIdToDelete = $(this).parents('#delete-album-data').data('albumid');
        $.ajax({
            type: "POST",
            url: '../delete-album',
            data: {
                albumId: albumIdToDelete
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
            });
    });

    //delete photo
    $('body').delegate("#delete-photo", "click",function () {
        var photoIdToDelete = $(this).parents('.photo-link').data('id');
        $.ajax({
            type: "POST",
            url: '../delete-photo',
            data: {
                photoId: photoIdToDelete
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
            });
    });

    //album comment
    $('body').delegate(".album-comment-button", "click",function () {
        $.ajax({
            type: "POST",
            url: '../comment-in-album',
            data: {
                albumId: $('input[name="albumId"]').val(),
                comment: $('textarea[name="comment"]').val()
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
            });
    });

    //album comment delete
    $('body').delegate("#album-comment-delete-button", "click",function () {
        var commentIdToDelete = $(this).data('commentid');
        //alert(commentIdToDelete);
        $.ajax({
            type: "POST",
            url: '../delete-comment',
            data: {
                commentIdToDelete: commentIdToDelete
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
            });
    });

    //like album
    $('body').delegate(".album-like-button", "click",function () {
        $.ajax({
            type: "POST",
            url: '../like-album',
            data: {
                albumId: $('input[name="albumId"]').val()
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
            });
    });

/*--------------------------------------------------------------------------------------------------------------------*/
//Single photo page
/*--------------------------------------------------------------------------------------------------------------------*/

    //edit photo
    form('#edit-photo-data-form', '../../../edit-photo-data');

    //delete photo from single photo page
    $('body').delegate("#delete-single-photo", "click",function () {
        var photoIdToDelete = $(this).parents('div').data('photoid');
        $.ajax({
            type: "POST",
            url: '../../../delete-photo-from-album',
            data: {
                albumId: $('input[name="albumId"]').val(),
                photoId: photoIdToDelete
            }
        }).done(function( msg ) {
                //console.log(msg);
                window.location = '..';
            });
    });

    //like photo
    $('body').delegate(".photo-like-button", "click",function () {
        //alert($('input[name="photoId"]').val());
        $.ajax({
            type: "POST",
            url: '../../../like-photo',
            data: {
                photoId: $('input[name="photoId"]').val()
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
            });
    });

    //photo comment make
    $('body').delegate(".photo-comment-button", "click",function () {
        if(($('textarea[name="comment"]').val() != "") && ($('textarea[name="comment"]').val().length <= 255)){
            $.ajax({
                type: "POST",
                url: '../../../comment-in-photo',
                data: {
                    photoId: $('input[name="photoId"]').val(),
                    comment: $('textarea[name="comment"]').val()
                }
            }).done(function( msg ){
                        window.location.reload();
            });
        }
    });

    //photo comment delete
    $('body').delegate("#photo-comment-delete-button", "click",function () {
        var commentIdToDelete = $(this).data('commentid');
        //alert(commentIdToDelete);
        $.ajax({
            type: "POST",
            url: '../../../delete-comment',
            data: {
                commentIdToDelete: commentIdToDelete
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
            });
    });

/*--------------------------------------------------------------------------------------------------------------------*/
//User profile page
/*--------------------------------------------------------------------------------------------------------------------*/

    //deltes album in user profile page
    $('body').delegate("#delete-album-in-user-page", "click",function () {
        var albumIdToDelete = $(this).parents('#delete-album-data').data('albumid');
        $.ajax({
            type: "POST",
            url: 'delete-album',
            data: {
                albumId: albumIdToDelete
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
            });
    });

/*--------------------------------------------------------------------------------------------------------------------*/
//Tag page
/*--------------------------------------------------------------------------------------------------------------------*/

    //deletes photo in tag page
    $('body').delegate("#delete-photo-in-tag-page", "click",function () {
        var photoIdToDelete = $(this).parents('#delete-photo-data').data('id');
        $.ajax({
            type: "POST",
            url: '../delete-photo',
            data: {
                photoId: photoIdToDelete
            }
        }).done(function( msg ) {
                //alert(msg);
                window.location.reload();
            });
    });

/*--------------------------------------------------------------------------------------------------------------------*/
// Functions
/*--------------------------------------------------------------------------------------------------------------------*/
    /**
     * Ajax query for page upload and editing forms
     *
     * @param formId submitted form id
     * @param routeUrl route url
     */
    function form(formId, routeUrl){
        $(formId).submit(function() {
            var form = new FormData($(this)[0]);
            $.ajax({
                url: routeUrl,
                type: 'POST',
                xhrFields: {
                    withCredentials: true
                },
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                data: form,
                beforeSend: function () {
                    $(".alert-process").removeClass("alert-process");
                    $("#output_process").html("Uploading, please wait....");
                },
                success: function () {
                    $(".alert-process").removeClass("alert-process");
                    $("#output_process").html("Upload success.");
                },
                complete: function () {
                    $(".alert-process").removeClass("alert-process");
                    $("#output_process").html("upload complete.");
                },
                error: function () {
                    $(".alert-process").removeClass("alert-process");
                    $("#output_process").html("ERROR in upload or editing");
                    //location.reload();
                }
            }).done(function(msg) {
                    $("#output_process").html(msg);
                    //alert(msg);
                    //alert('Event created successfully..');
                    window.location.reload();
                }).fail(function() {
                    //alert(msg);
                    //alert("fail!");
                    window.location.reload();
                });
            event.preventDefault();
        });
    }

})(jQuery);