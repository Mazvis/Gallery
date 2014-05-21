<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * Class User
 */
class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');
    
    /**
     * The database table for user settings.
     *
     * @var string
     */
    protected $settingsTable = 'user_settings';

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    /**
     * Check fields for rules
     *
     * @return message about success or error messages
     */
    public function validateField($input) {

        $rules = array(
            'first_name' => 'required|min:3|max:80|alpha',
            'last_name' => 'required|min:3|max:80|alpha',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:3|max:80|unique:users,username',
            'password' => 'required|min:6|max:40|confirmed',
            'password_confirmation' => 'required|min:6|max:40',
        );

        $v = Validator::make($input, $rules);

        $messages = "";
        if ($v->fails())
            $messages = $v->messages();
        else
        if ($input['is_clicked'] == 'yes')
            return self::saveUserToDatabase($input);
        else
            return "GOOD";

        return $messages;
    }
    
    /**
     * Get user background and font color
     *
     * @return color or message about default background
     */
    public function getUserSettings($userID){        
        return DB::table($this->settingsTable)->where('user_id', $userID)->pluck('value');
    }

    /**
     * Check settings field
     *
     * @return message about success or error
     */
    public function validateSettings($input, $userID) {
        $settingsColor = $input['color'];
        $userSettings = DB::table($this->settingsTable)->where('user_id', $userID)->first();

        if ($settingsColor != "default") {
            if (!empty($userSettings))
                DB::table($this->settingsTable)
                        ->where('user_id', $userID)
                        ->update(array('key' => 'color', 'value' => $settingsColor));
            else
                DB::table($this->settingsTable)->insertGetId(
                        array('user_id' => $userID, 'key' => 'color', 'value' => $settingsColor));
        }else{
            DB::table($this->settingsTable)->where('user_id', '=', $userID)->delete();
        }

        return 'Settings changed successfully!';
    }

    /**
     * Register new user.
     *
     * @return OK on successful
     */
    public function saveUserToDatabase($input) {
        $user = new User();
        $user->username = $input['username'];
        $user->password = Hash::make($input['password']);
        $user->email = $input['email'];
        $user->name = ucfirst($input['first_name']);
        $user->last_name = ucfirst($input['last_name']);
        $user->role_id = 2;
        $user->save();
        Session::put('just_reg', 'yes');
        self::createUserSession($user);
        return 'OK';
    }

    /**
     * Create user session named 'members'
     *
     * @return string
     */
    public function createUserSession($user) {
        Session::put('members', $user);
    }

    /**
     * Returns user id
     *
     * @param $userId
     * @return mixed
     */
    public function getUserName($userId) {
        $users = DB::table('users')->where('id', $userId)->get();
        $user = 'Unknown';
        foreach ($users as $user)
            $username = $user->username;
        return $username;
    }

    /**
     * Gets user
     *
     * @param $username
     * @return mixed
     */
    public function getUserDataByUserName($username) {
        return $users = DB::select('select * from users where username = ?', array($username));
    }

    /**
     * checks user for signing in
     *
     * @param $username
     * @param $password
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth($username, $password) {
        // get POST data
        $userdata = array(
            'username' => $username,
            'password' => $password
        );

        if (Auth::attempt($userdata)) {
            return Redirect::back();
        } else {
            // auth failure, go back to the login
            return Redirect::to('login')->with('login_errors', true);
        }
    }

    public function logout() {
        Auth::logout();
        return Redirect::back();
    }

}
