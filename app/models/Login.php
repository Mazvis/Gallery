<?php

/**
 * Class Login
 */
class Login{

    /**
     * checks user for signing in
     *
     * @param $username
     * @param $password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth($username, $password){
        // get POST data
        $userdata = array(
            'username'      => $username,
            'password'      => $password
        );

        if ( Auth::attempt($userdata) )
        {
            return Redirect::back();
        }
        else
        {
            // auth failure, go back to the login
            return Redirect::to('login')->with('login_errors', true);
        }
    }

    public function logout(){
        Auth::logout();
        return Redirect::back();
    }
}