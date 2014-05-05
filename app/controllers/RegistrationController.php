<?php

/**
 * Class RegistrationController
 */
class RegistrationController extends BaseController {

    /**
     * Store registration form data to variable
     *
     * @return message
     */
    public function storeGet() {
        $user = new User;
        $input = Input::all();
        return $user->validateField($input);
    }

    /**
     * Sign in page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function tryLogin() {
        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
            //return Redirect::intended('/');
            return Redirect::back();
        }else{
            return Redirect::to('/login')->with('tried_login', Input::get('username'));
        }
    }

    /**
     * log
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userLogout() {
        Auth::logout();
        return Redirect::intended('/');
    }

}