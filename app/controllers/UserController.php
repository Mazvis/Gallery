<?php
use Chumper\Datatable\Engines\CollectionEngine;

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
    
    public function getAllUsers($currUserId){
        $user = new User();
        return $user->getAllUsers($currUserId);
    }
    
    public function changeUserRole(){
        $user = new User;
        $userID = Input::get('user_id');
        $msg = $user->changeUserRole($userID, Auth::user()->id, Auth::user()->role_id);
        return Redirect::to('/')->with('changeRoleStatus', $msg);
    }

    public function subscribe(){
        $userID = Input::get('user_id');
        $subs = Subscribe::where('user_id','=',Auth::user()->id)->where('subscribed_user_id', '=', $userID)->get();
        if ($subs->isEmpty()) {
            $model = new Subscribe();
            $model->user_id =  Auth::user()->id;
            $model->subscribed_user_id = $userID;
            $model->save();
        }
        return Redirect::to('/')->with('subscribed', 'You have successfully subscribed.');
    }

    public function showMySubscribtions() {
        $subs = Subscribe::where('user_id','=',Auth::user()->id)->get();

        $this->layout->bodyclass = "home-page";
        $sUsers = array();
        foreach ($subs as $sub) {
            $users = DB::table('users')->where('id', $sub->subscribed_user_id)->get();
            $sUsers[$sub->subscribed_user_id] = $users[0]->name;
        }
        $this->layout->content = View::make('mysubscriptions', array('subs' => $sUsers));
    }

    public function showMySubscribtionsUser() {
        $this->layout->bodyclass = "home-page";
        $this->layout->content = View::make('mysubscriptionsuser', ['userId'=>Input::get('user_id')]);
    }

    public function getMySubscribtionsUserDatatable()
    {
        return (new CollectionEngine(UserAction::where('user_id', '=', Input::get('userId'))->get(array('action', 'ip', 'created_at'))))
        ->showColumns('action', 'ip', 'created_at')
        ->searchColumns('action')
        ->make();
    }


    public function showMyActions()
    {
        if(Auth::check()){
            $this->layout->bodyclass = "home-page";
            $value = Session::get('user.id', Auth::user()->id);
            $this->layout->content = View::make('myactions', array('user' => User::find($value)));
        }
        else
            return Redirect::to('404');
    }

    public function getMyActionsDatatable()
    {
        $value = Session::get('user.id', Auth::user()->id);
        return (new CollectionEngine(UserAction::where('user_id', '=', $value)->get(array('action', 'ip', 'created_at'))))
        ->showColumns('action', 'ip', 'created_at')
        ->searchColumns('action')
        ->make();
    }
}