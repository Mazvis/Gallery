@if(Auth::check())
{{ Form::open(array('route' => 'user.settings', 'id' => 'settings')) }}
<fieldset>
    <legend>Change background and font color</legend>
    @if (!Session::has('changeSettingsStatus'))
    <div class="form-group">
        <label class="control-label col-lg-4">Select color</label>
        <div class="col-lg-6">
            {{ Form::select('color', array(
                                    'default' => 'Default background',
                                    'green' => 'Green',
                                    'red' => 'Red',
                                    'black' => 'Black',
                                    'yellow' => 'Yellow'), 'default', array('class' => 'form-control')) }}
        </div>
        <div class="form-submit col-lg-2">
            <button type="submit" class="btn btn-sm btn-success">Update color</button>
        </div>
    </div>
    @else
    <p class="alert alert-success">{{Session::get('changeSettingsStatus') }}</p>
    @endif
    <div class="clear"></div>
</fieldset>
{{ Form::token() }}
{{ Form::close() }}

@if(Auth::user()->role_id == 1)

@endif

@endif

<article>
    <h1>Home page</h1>

    <p>Resent photos:</p>

    <div class="row">
        @for ($i = 0; $i < sizeOf($photo_data_array2); $i++)
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <a href="{{ URL::to('albums/'.$photo_data_array2[$i]->album_id.'/photo/'.$photo_data_array2[$i]->photo_id) }}">
                    @if($photo_data_array2[$i]->photo_thumbnail_destination_url && is_file($photo_data_array2[$i]->photo_thumbnail_destination_url))
                    {{ HTML::image($photo_data_array2[$i]->photo_thumbnail_destination_url, $photo_data_array2[$i]->photo_short_description) }}
                    @else
                    {{ HTML::image('assets/img/no-image-thumb.jpg', $photo_data_array2[$i]->photo_short_description, array('width' => '200', 'height' => '200')) }}
                    @endif
                </a>
                @if(Auth::check() && $isPhotoCreator[$i])
                <div class="caption photo-link" data-id="{{ $photo_data_array2[$i]->photo_id }}">
                    <p>Album: {{ HTML::link('albums/'.$photo_data_array2[$i]->album_id.'/photo/'.$photo_data_array2[$i]->photo_id, $photo_data_array2[$i]->album_name) }} </p>
                    <p>
                        {{ HTML::link(URL::to('albums/'.$photo_data_array2[$i]->album_id.'/photo/'.$photo_data_array2[$i]->photo_id), 'Edit', array('class' => 'btn btn-primary', 'role' => 'button')) }}
                        {{ Form::submit('Delete', array('id' => 'delete-photo-in-home', 'class' => 'btn btn-danger')) }}
                    </p>
                </div>
                @endif
            </div>
        </div>
        @endfor
    </div>

    <div class="clear"></div>

</article>