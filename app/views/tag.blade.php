<h1>Tag({{ $tagName }})</h1>

<div class="row">
    @for ($i = 0; $i < sizeOf($photos); $i++)
    <div class="col-sm-6 col-md-4">
        <h3>{{ $photos[$i]->photo_name }}</h3>
        <p>Album: {{ HTML::link('albums/'.$photos[$i]->album_id.'/photo/'.$photos[$i]->photo_id, $photos[$i]->album_name) }} </p>
        <div class="thumbnail">
            <a href="{{ URL::to('albums/'.$photos[$i]->album_id.'/photo/'.$photos[$i]->photo_id) }}">
                @if($photos[$i]->photo_thumbnail_destination_url && is_file($photos[$i]->photo_thumbnail_destination_url))
                {{ HTML::image($photos[$i]->photo_thumbnail_destination_url, $photos[$i]->photo_short_description) }}
                @else
                {{ HTML::image('assets/img/no-image-thumb.jpg', $photos[$i]->photo_short_description, array('width' => '200', 'height' => '200')) }}
                @endif
            </a>

            @if(Auth::check() && $isPhotoCreator[$i])
            <div id="delete-photo-data" class="caption photo-link" data-id="{{ $photos[$i]->photo_id }}">
                <p>
                    {{ HTML::link(URL::to('albums/'.$photos[$i]->album_id.'/photo/'.$photos[$i]->photo_id), 'Edit', array('class' => 'btn btn-primary', 'role' => 'button')) }}
                    {{ Form::submit('Delete', array('id' => 'delete-photo-in-tag-page', 'class' => 'btn btn-danger')) }}
                </p>
            </div>
            @endif
        </div>
    </div>
    @endfor
    @if(sizeOf($photos)< 1)
    <div class="col-sm-6 col-md-4">
        <p>There is no photos with this tag.</p>
    </div>
    @endif
</div>