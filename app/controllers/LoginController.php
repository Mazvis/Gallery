<?php

/**
 * Class LoginController
 */
class LoginController extends BaseController {

    /**
     * Authentificates user with Auth::attempt command
     *
     * @return \Illuminate\Http\RedirectResponse if success redirects to main page else redirects with errors
     */
    public function authLogin() {
        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
            return Redirect::intended('/');
        }else{
            return Redirect::to('/')->with('tried_login', Input::get('username'));
        }
    }

    /**
     * Makes logout
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        $logout = new Login;
        return $logout->logout();
    }

}
