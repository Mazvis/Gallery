<?php

/**
 * Class UserController
 */
class UserController extends BaseController {

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
        $login = new Login();
        $login->ip = Request::getClientIp();
        $user = User::where('username', '=', Input::get('username'))->first();
        if ($user) {
            $login->user_id = $user->id;
        }
        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
            if ($user) {
                $login->success = true;
                $login->save();
            }
            //return Redirect::intended('/');
            return Redirect::back();
        }else{
            if ($user) {
                $login->success = false;
                $login->save();
            }
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
        $logout = new User;
        return $logout->logout();
    }
    
    /**
     * Change user settings
     *
     */
    public function changeSettings(){
        $user = new User;
        $input = Input::all();
        $msg = $user->validateSettings($input, Auth::user()->id);
        return Redirect::to('/')->with('changeSettingsStatus', $msg);
    }

    public function usersNamesByStr(){
        $user = new User;
        $uStr = Input::get('string');
        $users = $user->getUsersByStr($uStr);
        $use = array();
        foreach($users as $us){
            $use[] = $us->username;
        }


        return $use;
    }

    public function checkOrUserExists(){
        $user = new User;
        $username = Input::get('username');
        $users = $user->checkOrUserExists($username);

        if(count($users) > 0){
            return "OK";
        }
        return "false";
    }
}