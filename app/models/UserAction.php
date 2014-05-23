<?php

class UserAction extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_actions';

    public $timestamps = false;

    public static function add($action) {
        if (!Auth::check()) {
            return false;
        }
        $model = new UserAction();
        $model->user_id = Auth::user()->id;
        $model->action = $action;
        $model->ip = Request::getClientIp();
        $model->save();
    }
} 