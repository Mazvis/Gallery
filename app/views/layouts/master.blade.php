<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $title }}</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/bootstrap-3.0.0/dist/css/bootstrap.min.css') }}

    <!-- Style css-->
    {{ HTML::style('assets/css/style.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {{ HTML::script('assets/bootstrap-3.0.0/assets/js/html5shiv.js') }}
    {{ HTML::script('assets/bootstrap-3.0.0/assets/js/respond.min.js') }}
    <![endif]-->

</head>

<body class="{{ $bodyclass }}">
<div class="container">
    {{----------------------------------------------------------------------------}}
    @if (Session::get('just_reg') == "yes")

    <div class="col-sm-12">
        <div class="alert alert-success">
            <strong>@lang('registration.great')</strong>
            @lang('registration.success')
        </div>
    </div>

    {{ Session::forget('just_reg') }}
    @endif
    {{----------------------------------------------------------------------------}}
    <div class="container">

        <div class="nav-relative">
            <nav class="navbar navbar-default navbar-absolute" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button class="toggle-sidebar navbar-toggle" type="button" data-target=".main-sidebar" title="Toggle sidebar">
                        <span class="sr-only">Toggle sidebar</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" title="Toggle menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    {{ HTML::link('/', 'Photo Gallery', array('class' => 'navbar-brand')) }}
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="@if(Request::is('/'))active@endif">{{ HTML::link('/', 'Home') }}</li>
                        <li class="@if(Request::is('albums')){{'active'}}@else{{' '}}@endif">{{ HTML::link('/albums', 'Albums') }}</li>
                        @if(Auth::check())
                            <li class="dropdown @if(Request::is('panel')){{'active'}}@else{{' '}}@endif">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">user panel<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ URL::to('profile') }}">Profile</a></li>
                                    @if(Auth::user()->role_id == 1)<li class="admin-panel-li"><a href="{{ URL::to('panel') }}">Admin panel</a></li>@endif
                                </ul>
                            </li>
                        @else
                        <li class="@if(Request::is('registration')){{'active'}}@else{{' '}}@endif">{{ HTML::link('registration', 'Register') }}</li>
                        @endif
                    </ul>

                    @if(Auth::check())
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ URL::to('logout') }}">logout({{ Auth::user()->username }})&nbsp;<i class="glyphicon glyphicon-log-out"></i></a></li>
                    </ul>
                    @else
                    {{ Form::open(array('route' => 'login.try', 'method' => 'post', 'id' => 'login-form', 'class' => 'navbar-form navbar-right')) }}
                    <div class="form-group">
                        <input name="username" type="text" class="form-control" id="sign-in-name" value="@if (Session::get('tried_login')){{ Session::get('tried_login') }} @endif" required>
                    </div>
                    <div class="form-group">
                        {{ Form::password('password', array('class' => 'form-control', 'id' => 'sign-in-password', 'required' => true)) }}
                    </div>
                    <button type="submit" class="btn btn-outline-inverse">Login</button>
                    {{ Form::token() }}
                    {{ Form::close() }}
                    @endif

                </div>
            </nav>
        </div>
        <div class="page-content">

            <aside class="main-sidebar">

                <div class="photo-search">
                    {{ Form::open(array('route' => 'search.photo', 'method' => 'post', 'id' => 'search-form')) }}
                    <input type="search" placeholder="Search photos" class="form-control" name="photo-search-by-tag" id="search" autocomplete="off">
                    {{ Form::token() }}
                    {{ Form::close() }}
                </div>

                <hr>

                <div class="photo-search sidebar-elements">
                    <h5>Recent Albums</h5>
                    <div class="thumbnail">
                        @for($i = 0; $i < sizeOf($recentAlbums); $i++)
                        {{ HTML::link('albums/'.$recentAlbums[$i]->album_id, $recentAlbums[$i]->album_name) }}@if($i < sizeOf($recentAlbums)-1)<br> @endif
                        @endfor
                    </div>
                </div>

                <hr>
                @if($mostViewedPhoto)
                <div class="photo-search sidebar-elements">
                    <h5>Most viewed photo</h5>
                    <div class="thumbnail">
                        <a href="{{ URL::to('albums/'.$mostViewedPhoto->album_id.'/photo/'.$mostViewedPhoto->photo_id) }}">
                            @if($mostViewedPhoto->photo_thumbnail_destination_url && is_file($mostViewedPhoto->photo_thumbnail_destination_url))
                            {{ HTML::image($mostViewedPhoto->photo_thumbnail_destination_url, $mostViewedPhoto->photo_short_description) }}
                            @else
                            {{ HTML::image('assets/img/no-image-thumb.jpg', $mostViewedPhoto->photo_short_description, array('width' => '200', 'height' => '200')) }}
                            @endif
                        </a>
                    </div>
                </div>
                @endif

                <hr>

                @if($randomPhoto)
                <div class="photo-search sidebar-elements">
                    <h5>Random photo</h5>
                    <div class="thumbnail">
                        <a href="{{ URL::to('albums/'.$randomPhoto->album_id.'/photo/'.$randomPhoto->photo_id) }}">
                            @if($randomPhoto->photo_thumbnail_destination_url && is_file($randomPhoto->photo_thumbnail_destination_url))
                            {{ HTML::image($randomPhoto->photo_thumbnail_destination_url, $randomPhoto->photo_short_description) }}
                            @else
                            {{ HTML::image('assets/img/no-image-thumb.jpg', $randomPhoto->photo_short_description, array('width' => '200', 'height' => '200')) }}
                            @endif
                        </a>
                    </div>
                </div>
                @endif

                <div class="photo-search sidebar-elements">
                    <h5>All categories</h5>
                    <div class="thumbnail">
                        <?php $i = 0; ?>
                        @foreach($existingCategories as $existingCategory)
                        {{ HTML::link('category/'.$existingCategory, $existingCategory) }}@if($i++ < sizeOf($existingCategories)-1), @endif
                        @endforeach
                    </div>
                </div>

                <address class="copyright">
                    &copy; 2013 Mažvydas
                </address>

                <div class="clear"></div>

            </aside>

            <!-- main content -->
            <div class="main-content">
                {{ $content }}
            </div>
            <!-- main content end -->

        </div>

    </div>
</div>

<!-- Placed at the end of the document so the pages load faster -->
{{ HTML::script('assets/bootstrap-3.0.0/assets/js/jquery.js') }}
{{ HTML::script('assets/bootstrap-3.0.0/dist/js/bootstrap.min.js') }}
{{ HTML::script('assets/bootstrap-3.0.0/dist/js/bootstrap.js') }}
{{ HTML::script('assets/bootstrap-3.0.0/assets/js/holder.js') }}
{{ HTML::script('assets/bootstrap-3.0.0/assets/js/application.js') }}

<!-- Scripts -->
{{ HTML::script('assets/js/script.js') }}
{{ HTML::script('assets/js/ajax-requests.js') }}
{{ HTML::script('assets/js/validation.js') }}

</body>
</html>