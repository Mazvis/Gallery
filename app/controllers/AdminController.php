<?php

use Chumper\Datatable\Datatable;
use Chumper\Datatable\Engines\CollectionEngine;

class AdminController extends BaseController {


    public function showLogins()
    {
        if(Auth::check()){
            $this->layout->bodyclass = "home-page";
            $username = Input::get('username');
            $user = User::where('username', '=', $username)->first();
            if (!$user) {
                $this->layout->content = View::make('chooseuser', array(
                    'invalid' => !!$username
                ));
            } else {
                $this->layout->content = View::make('logins');
            }
        }
        else
            return Redirect::to('404');
    }

    public function getLoginsDatatable()
    {
        return (new CollectionEngine(Login::all()))
        ->showColumns('ip', 'success', 'created_at')

        ->addColumn('success',function($model)
            {
                return $model->success ? 'Valid attempt' : 'Invalid attempt';
            }
        )
        ->searchColumns(['ip', 'success'])
        ->make();
    }

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
        return (new CollectionEngine(Search::all(array('search_id','search','created_at'))))
        ->showColumns('search', 'created_at')
        ->searchColumns('search')
        ->make();
    }
}