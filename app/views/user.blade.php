<h1>User({{ $user->username }})</h1>

    <div class="">
        <div class="row">
            <div class="col-sm-3">
                <div class="profile-img">
                    <div class="profile-img-wrapper">
                        <img src="{{ URL::to('assets/img/user-blank.jpg') }}" alt="username">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="profile-info-row row">
                    <div class="info-label col-md-5">
                        Name
                    </div>
                    <div class="info-value col-md-7">
                        {{$user->name}} {{$user->last_name}}
                    </div>
                </div>
                <div class="profile-info-row row">
                    <div class="info-label col-md-5">
                        username
                    </div>
                    <div class="info-value col-md-7">
                        {{$user->username}}
                    </div>
                </div>
                <div class="profile-info-row row">
                    <div class="info-label col-md-5">
                        E-mail
                    </div>
                    <div class="info-value col-md-7">
                        {{$user->email}}
                    </div>
                </div>
            </div>
        </div>
    </div>

<hr>

<h3>User albums:</h3>
@if(sizeOf($userAlbums) < 1)
<p>User didn't have albums created</p>
@endif
<div class="row">
    @for ($i = 0; $i < sizeOf($userAlbums); $i++)
    <div class="col-sm-6 col-md-4">
        <h3>{{ $userAlbums[$i]->album_name }}</h3>
        <div class="thumbnail">
            <a href="{{ URL::to('albums/'.$userAlbums[$i]->album_id) }}">
                @if($userAlbums[$i]->album_title_photo_thumb_url && is_file($userAlbums[$i]->album_title_photo_thumb_url))
                {{ HTML::image($userAlbums[$i]->album_title_photo_thumb_url, $userAlbums[$i]->album_short_description) }}
                @else
                {{ HTML::image('assets/img/NoAlbumArt.jpg', $userAlbums[$i]->album_short_description, array('width' => '200', 'height' => '200')) }}
                @endif
            </a>
        </div>
        <div class="caption photo-link" data-id="{{ $userAlbums[$i]->album_id }}">
            <p>{{ $userAlbums[$i]->album_short_description }} </p>
            @if(Auth::check() && $isAlbumCreator[$i])
            <p id="delete-album-data" data-albumid="{{ $userAlbums[$i]->album_id }}">
                {{ HTML::link(URL::to('albums/'.$userAlbums[$i]->album_id), 'Edit', array('class' => 'btn btn-primary', 'role' => 'button')) }}
                {{ Form::submit('Delete album', array('id' => 'delete-album-in-user-page', 'class' => 'btn btn-danger')) }}
            </p>
            @endif
        </div>
    </div>
    @endfor
</div>