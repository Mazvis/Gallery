<?php

class AdminController extends BaseController {

    /*
     * Show
     */
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

    public function getSearchesDatatable()
    {
        return Datatable::collection(Search::all(array('search_id','search','created_at')))
        ->showColumns('search', 'created_at')
        ->searchColumns('search')
        ->orderColumns('search_id')
        ->make();
    }
}