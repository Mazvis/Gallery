<?php
class UserActionsController {

    public function showUserActions()
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
                $this->layout->content = View::make('useractions', ['userId'=>$user->id]);
            }
        }
        else
            return Redirect::to('404');
    }

} 