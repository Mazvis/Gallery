<h1>{{ $albumData->album_name }}</h1>

<div class="image-navigation" style="padding-left: 0; padding-top: 0;">

    <a href="@if($albumData->album_title_photo_url) {{ URL::to($albumData->album_title_photo_url) }} @else {{ URL::to('/albums/'.$albumData->album_id) }} @endif" class="photo-link" style="float:left">
        <img id="album-or-photo-title" data-toggle = "modal" data-target = "#showPhotoModal" src="@if($albumData->album_title_photo_url) {{ URL::to($albumData->album_title_photo_url) }} @else {{ URL::to('assets/img/NoAlbumArt.jpg') }} @endif" alt="First">
    </a>
    <div class="clear"></div>
    <hr>
    <!-- Modal -->
    <div class="modal fade" id="showPhotoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">TitlePhoto</h4>
                </div>
                <div class="modal-body" align="center">
                    <div><img src="@if($albumData->album_title_photo_url) {{ URL::to($albumData->album_title_photo_url) }} @else {{ URL::to('assets/img/NoAlbumArt.jpg') }} @endif" alt="First"></div>
                    <div class="clear"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <p><strong>Album name:</strong> {{ $albumData->album_name }}</p>
        <p><strong>Place:</strong> {{ $albumData->album_place }}</p>
        <p><strong>Created at:</strong> {{ $albumData->album_created_at }}</p>
        <p><strong>Album fool description:</strong> Album full description: {{ $albumData->album_full_description }}</p>
        <p><strong>Creator:</strong> {{ HTML::link('user/'.$albumData->username, $albumData->username) }}</p>
        <p><strong>Views:</strong> {{ $albumData->views }}</p>
        <p><strong>Album has photos:</strong> {{ $albumData->album_photos_count }}</p>

        @if($isUserHavingPrivilegies)
        {{ Form::submit('Delete album', array('class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#deleteAlbumModal')) }}

        <!-- Modal -->
        <div class="modal fade" id="deleteAlbumModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Detele album</h4>
                    </div>
                    <div class="modal-body">
                        You really want delete this album?
                    </div>
                    <div class="modal-footer" id="delete-album-data" data-albumid="{{ $albumData->album_id }}">
                        {{ Form::submit('Delete', array('id' => 'delete-album-in-album-page', 'class' => 'btn btn-danger')) }}
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        @endif

    </div>

    <div class="clear"></div>
    <hr>
</div>

<div class="panel-group" id="accordion2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                {{ Form::hidden('albumId', $albumId) }}
                @if(Auth::check())
                    @if($isLikeAlreadyExists == 1)
                    {{--Form::submit('Unlike', array('class' => 'btn btn-warning album-like-button'))--}}
                    <button class="btn btn-warning album-like-button">
                        <i class="glyphicon glyphicon-thumbs-down"></i>
                        <span class="text">Unlike</span>
                    </button>
                    @else
                    <button class="btn btn-success album-like-button">
                        <i class="glyphicon glyphicon-thumbs-up"></i>
                        <span class="text">Like</span>
                    </button>
                    {{--Form::submit('Like', array('class' => 'btn btn-success album-like-button'))--}}
                    @endif
                @else
                    <div>
                        {{ Form::submit('Like', array(
                        'class' => 'btn btn-success',
                        'disabled' => 'true',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'right',
                        'data-original-title' => 'Only register users can like'
                        )) }}
                    </div>
                @endif

                <a data-toggle="collapse" data-parent="#accordion2" href="#likers">
                    <p>
                        Likes: {{ sizeOf($likes) }}
                    </p>
                </a>
            </h4>
        </div>
        <div id="likers" class="panel-collapse collapse">
            <div class="panel-body">
                @for ($i = 0; $i < sizeOf($likes); $i++)
                    {{ HTML::link('user/'.$likes[$i]->username, $likes[$i]->username) }}
                    @if($i < sizeOf($likes)-1)
                    ,
                    @endif
                @endfor
            </div>
        </div>
    </div>
</div>


<div class="tabs">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#comment-in-album-tab" data-toggle="tab">Comment</a></li>
        @if($isUserAlbumCreator)
            <li class=""><a href="#edit-album-tab" data-toggle="tab">Edit</a></li>
        @endif
        @if($isUserAlbumCreator)
        <li class=""><a href="#upload-in-album-tab" data-toggle="tab">Upload</a></li>
        @endif
    </ul>
    <div id="myTabContent" class="tab-content">

        <div class="tab-pane fade active in" id="comment-in-album-tab">

            <div class="panel-group" id="accordion">
                @for ($i = 0; $i < sizeOf($comments); $i++)

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                @if(Auth::check())
                                    @if($comments[$i]->user_id == Auth::user()->id || Auth::user()->role_id == 1)
                                    <button id="album-comment-delete-button" type="button" class="close" data-dismiss="modal" data-commentid="{{ $comments[$i]->comment_id }}" aria-hidden="true">×</button>
                                    @endif
                                @endif
                                <a data-toggle="collapse" data-parent="#accordion" href="#comment{{ $comments[$i]->comment_id }}">
                                    <p>
                                        @if($comments[$i]->username)
                                            {{ $comments[$i]->username }}
                                        @else
                                            {{ $comments[$i]->commenter_ip }}
                                        @endif
                                        {{ $comments[$i]->created_at }}
                                    </p>
                                </a>
                            </h4>
                        </div>
                        <div id="comment{{ $comments[$i]->comment_id }}" class="panel-collapse collapse">
                            {{ Form::hidden('albumId', $albumId)}}
                            <div class="panel-body">
                                {{ $comments[$i]->comment }}
                            </div>
                        </div>
                    </div>

                @endfor
            </div>
            <div class="panel panel-default">

                <div id="likers" class="panel-heading panel-collapse collapse in">
                    <div class="panel-body">
                        {{ Form::textarea('comment', '', array('class' => 'form-control', 'rows' => '3', 'placeholder' => 'write here')) }}
                        {{ Form::submit('Comment', array('class' => 'btn btn-primary btn-lg btn-block album-comment-button')) }}
                    </div>
                </div>
            </div>

        </div>
        @if($isUserAlbumCreator)
        <div class="tab-pane fade" id="edit-album-tab">
            {{ Form::open(array('files'=> true, 'method' => 'post', 'id' => 'edit-album-data-form', 'class' => 'form-hidden')) }}

            {{ Form::hidden('albumId', $albumId)}}

            <p>{{ Form::label('albumName', 'Album name') }}</p>
            <p>{{ Form::text('albumName', $albumData->album_name, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('shDescription', 'Album short description') }}</p>
            <p>{{ Form::text('shDescription', $albumData->album_short_description, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('fullDescription', 'Album full description') }}</p>
            <p>{{ Form::text('fullDescription', $albumData->album_full_description, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('placeTaken', 'Fotographed at') }}</p>
            <p>{{ Form::text('placeTaken', $albumData->album_place, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('albumTitlePhoto', 'Title photo') }}</p>
            <p>{{ Form::file('albumTitlePhoto', array('class' => 'form-control')) }}</p>

            <p>{{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}</p>

            {{ Form::token() }}
            {{ Form::close() }}
        </div>
        @endif
        @if($isUserAlbumCreator)
        <div class="tab-pane fade" id="upload-in-album-tab">
            {{ Form::open(array('files'=> true, 'method' => 'post', 'id' => 'upload-photos-to-album-form', 'class' => 'form-hidden')) }}

            {{ Form::hidden('albumId', $albumId)}}

            <p>{{ Form::label('photoName', 'Photo name') }}</p>
            <p>{{ Form::text('photoName', '', array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('shDescription', 'Photo short description') }}</p>
            <p>{{ Form::text('shDescription', '', array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('placeTaken', 'Fotographed at') }}</p>
            <p>{{ Form::text('placeTaken', '', array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('category', 'select category') }}</p>
            <p>{{ Form::select('categories[]', $allExistingCategories, null, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('tagsToAdd', 'write tags to add to photo') }}</p>
            <p>{{ Form::text('tagsToAdd', '', array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('photos', 'upload photos') }}</p>
            <p>{{ Form::file('photos[]', array('multiple'=>true, 'id' => 'photos_id', 'class' => 'form-control')) }}</p>

            <div class="row alert-process">
                <div class="col-sm-12">
                    <div id="output_process" class="alert alert-success">

                    </div>
                </div>
            </div>

            <p>{{ Form::label('titlePhoto', 'Make album title photo?') }}</p>
            <p>{{ Form::checkbox('titlePhoto', true, array('class' => 'check')) }}</p>

            <p>{{ Form::submit('Upload', array('id' => 'upload-photo-button', 'class' => 'btn btn-success', 'data-loading-text' => 'Loading...')) }}</p>

            {{ Form::token() }}
            {{ Form::close() }}
        </div>
        @endif
    </div>
</div>
<hr>

</br>

<div class="row">
    @for ($i = 0; $i < sizeOf($albumPhotos); $i++)
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <h3>{{ $albumPhotos[$i]->photo_name }}</h3>
            <a href="{{ URL::to('albums/'.$albumPhotos[$i]->album_id.'/photo/'.$albumPhotos[$i]->photo_id) }}">
                @if($albumPhotos[$i]->photo_thumbnail_destination_url && is_file($albumPhotos[$i]->photo_thumbnail_destination_url))
                {{ HTML::image($albumPhotos[$i]->photo_thumbnail_destination_url, $albumPhotos[$i]->photo_short_description) }}
                @else
                {{ HTML::image('assets/img/no-image-thumb.jpg', $albumPhotos[$i]->photo_short_description, array('width' => '200', 'height' => '200')) }}
                @endif
            </a>
            <div class="caption photo-link" data-id="{{ $albumPhotos[$i]->photo_id }}">
                <p>{{ $albumPhotos[$i]->photo_short_description }} </p>
                <p>
                    @if($isUserAlbumCreator)
                    {{ HTML::link(URL::to('albums/'.$albumPhotos[$i]->album_id.'/photo/'.$albumPhotos[$i]->photo_id), 'Edit', array('class' => 'btn btn-primary', 'role' => 'button')) }}
                    @endif
                    @if($isUserHavingPrivilegies)
                    {{ Form::submit('Delete', array('id' => 'delete-photo', 'class' => 'btn btn-danger')) }}
                    @endif
                </p>
            </div>
        </div>
    </div>
    @endfor
</div>
<hr>