<?php
class SearchController {

    public function showSearches()
    {
        if(Auth::check()){
            $this->layout->bodyclass = "home-page";
            $value = Session::get('user.id', Auth::user()->id);
            $this->layout->content = View::make('searches', array('user' => User::find($value)));
        }
        else
            return Redirect::to('404');
    }
} 