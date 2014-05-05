<h1>{{ $photoData->photo_name }}</h1>

<div class="image-navigation" style="padding-left: 0; padding-top: 0;">

    <a href="{{ URL::to($photoData->photo_destination_url) }}" class="photo-link" style="float:left">
        <img id="album-or-photo-title" data-toggle = "modal" data-target = "#showPhotoModal" src="{{ URL::to($photoData->photo_destination_url) }}" alt="First">
    </a>
    <div class="clear"></div>
    <hr>
    <!-- Modal -->
    <div class="modal in" id="showPhotoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{{ $photoData->photo_name }}</h4>
                </div>
                <div class="modal-body" align="center">
                    <div><img src="@if($photoData->photo_destination_url) {{ URL::to($photoData->photo_destination_url) }} @else {{ URL::to('assets/img/no-image-thumb.jpg') }} @endif" alt="First"></div>
                    <div class="clear"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <p><strong>Photo Name:</strong>  {{ $photoData->photo_name }}</p>
        <p><strong>Album:</strong>  {{ HTML::link('albums/'.$photoData->album_id ,$photoData->album_name) }}</p>
        <p><strong>Category:</strong>  @for ($i = 0; $i < sizeOf($categories); $i++) {{ HTML::link('category/'.$categories[$i], $categories[$i]) }}@if($i < sizeOf($categories)-1), @endif @endfor</p>
        <p><strong>Place taken:</strong>  {{ $photoData->photo_taken_at }}</p>
        <p><strong>Created at:</strong>  {{ $photoData->photo_created_at }}</p>
        <p><strong>Photo description:</strong>  {{ $photoData->photo_short_description }}</p>
        <p><strong>Author:</strong>  {{ HTML::link('user/'.$photoData->username, $photoData->username) }}</p>
        <p><strong>Photo tags:</strong>  @for ($i = 0; $i < sizeOf($photoTagNames); $i++) {{ HTML::link('tag/'.$photoTagNames[$i], $photoTagNames[$i]) }}@if($i < sizeOf($photoTagNames)-2), @endif @endfor</p>
        <p><strong>Views:</strong>  {{ $photoData->views }}</p>

        @if(Auth::check() && $isPhotoCreator == 1)
        <div data-photoid="{{ $photoData->photo_id }}">
            <button id="delete-single-photo" class="btn btn-danger">
                <i class="glyphicon glyphicon-trash"></i>
                <span class="text">Delete photo</span>
            </button>
        </div>
        @endif
    </div>

    <div class="clear"></div>
    <hr>
</div>

<div class="panel-group" id="accordion2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                {{ Form::hidden('photoId', $photoId) }}
                @if(Auth::check())
                    @if($isLikeAlreadyExists == 1)
                    <button class="btn btn-warning photo-like-button">
                        <i class="glyphicon glyphicon-thumbs-down"></i>
                        <span class="text">Unlike</span>
                    </button>
                    @else
                    <button class="btn btn-success photo-like-button">
                        <i class="glyphicon glyphicon-thumbs-up"></i>
                        <span class="text">Like</span>
                    </button>
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
                {{ HTML::link('user/'.$likes[$i]->username, $likes[$i]->username) }}@if($i < sizeOf($likes)-1),
                @endif
                @endfor
            </div>
        </div>
    </div>
</div>

<div class="tabs">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#comment-in-album-tab" data-toggle="tab">Comment</a></li>
        @if(Auth::check() && $isPhotoCreator == 1)<li class=""><a href="#edit-album-tab" data-toggle="tab">Edit</a></li>@endif
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
                                <button id="photo-comment-delete-button" type="button" class="close" data-dismiss="modal" data-commentid="{{ $comments[$i]->comment_id }}" aria-hidden="true">×</button>
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
                        {{ Form::submit('Comment', array('class' => 'btn btn-primary btn-lg btn-block photo-comment-button')) }}
                    </div>
                </div>
            </div>

        </div>
        @if(Auth::check() && $isPhotoCreator == 1)
        <div class="tab-pane fade" id="edit-album-tab">
            {{ Form::open(array('files'=> true, 'method' => 'post', 'id' => 'edit-photo-data-form', 'class' => 'form-hidden')) }}

            {{ Form::hidden('albumId', $albumId)}}
            {{ Form::hidden('photoId', $photoId)}}

            <p>{{ Form::label('photoName', 'Photo name') }}</p>
            <p>{{ Form::text('photoName', $photoData->photo_name, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('shDescription', 'Photo short description') }}</p>
            <p>{{ Form::text('shDescription', $photoData->photo_short_description, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('placeTaken', 'Fotographed at') }}</p>
            <p>{{ Form::text('placeTaken', $photoData->photo_taken_at, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('categories', 'Choose category') }}</p>
            <p>{{ Form::select('categories[]', $allExistingCategories, null, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('photoTags', 'edit tags (separate tags by comma and space(", ") or just space(" "))') }}</p>
            <p>{{ Form::text('photoTags', $photoTags, array('class' => 'form-control')) }}</p>

            <p>{{ Form::label('albumTitlePhoto', 'Make this title album photo?') }}</p>
            <p>{{ Form::checkbox('albumTitlePhoto', true, array('class' => 'check', 'checked' => '')) }}</p>

            <p>{{ Form::submit('Edit', array('class' => 'btn btn-success')) }}</p>

            {{ Form::token() }}
            {{ Form::close() }}
        </div>
        @endif
    </div>
</div>

<hr>