<h1>Albums</h1>

@if(Auth::check())
<div class="image-navigation">
    <b>Create new:</b>
    {{ Form::open(array('method' => 'post', 'id' => 'create-album-form')) }}

    <p>{{ Form::label('name', 'Album name') }}</p>
    <p>{{ Form::text('name', null, array('class'=>'form-control')) }}</p>

    <p>{{ Form::label('shDescription', 'Album short description') }}</p>
    <p>{{ Form::text('shDescription', null, array('class'=>'form-control')) }}</p>

    <p>{{ Form::label('description', 'Album full description') }}</p>
    <p>{{ Form::text('description', null, array('class'=>'form-control')) }}</p>

    <p>{{ Form::label('place', 'Fotographet place') }}</p>
    <p>{{ Form::text('place', null, array('class'=>'form-control')) }}</p>

    <p>{{ Form::submit('Create', array('class' => 'btn btn-success')) }}</p>

    {{ Form::token() }}
    {{ Form::close() }}

</div>
@endif

</br></br>

<div class="row">
    @for ($i = 0; $i < sizeOf($allAlbums); $i++)
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <h3>{{ HTML::link('albums/'.$allAlbums[$i]->album_id, $allAlbums[$i]->album_name) }}</h3>
            <p>By: {{ HTML::link('user/'.$allAlbums[$i]->username, $allAlbums[$i]->username) }}</p>
            <a href="{{ URL::to('albums/'.$allAlbums[$i]->album_id) }}">
                @if($allAlbums[$i]->album_title_photo_thumb_url && is_file($allAlbums[$i]->album_title_photo_thumb_url))
                {{ HTML::image($allAlbums[$i]->album_title_photo_thumb_url, $allAlbums[$i]->album_short_description) }}
                @else
                {{ HTML::image('assets/img/NoAlbumArt.jpg', $allAlbums[$i]->album_short_description, array('width' => '200', 'height' => '200')) }}
                @endif
            </a>
            @if(Auth::check() && $isAlbumCreator[$i] == 1)
            <div class="caption photo-link" data-id="{{ $allAlbums[$i]->album_id }}">
                <p>{{ $allAlbums[$i]->album_short_description }} </p>
                <p id="delete-album-data" data-albumid="{{ $allAlbums[$i]->album_id }}">
                    {{ HTML::link('albums/'.$allAlbums[$i]->album_id, 'Edit', array('class' => 'btn btn-primary', 'role' => 'button')) }}
                    {{ Form::submit('Delete album', array('id' => 'delete-album-in-albums', 'class' => 'btn btn-danger')) }}
                </p>
            </div>
            @endif
        </div>
    </div>
    @endfor
</div>

<div class="clear"></div>
</div>