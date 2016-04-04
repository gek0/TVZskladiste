<?php

class UserController extends BaseController{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show users list
     * @return mixed
     */
    public function showUsers()
    {
        if(Auth::user()->group->id >= 4){
            //get all users
            $users = User::orderBy('id', 'ASC')->get();

            return View::make('admin.users.users')->with(['users' => $users]);
        }
        else{
            App::abort(403);
        }
    }

    /**
     * show user edit form
     * @param null $id
     * @return mixed
     */
    public function showUserEditForm($id = null)
    {
        if(Auth::user()->group->id >= 4){
            //find if user exists
            $user = User::find($id);

            //get all user groups from DB to populate dropdown
            $user_groups = UsersGroup::orderBy('id')->lists('group_name', 'id');

            if($user == NULL){
                return Redirect::to('admin/korisnici')->withErrors('Korisnik sa zadanim ID-em ne postoji!');
            }
            else{
                return View::make('admin.users.edit-user')->with(['user' => $user,
                    'user_groups' => $user_groups
                ]);
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * update user data
     * @return mixed
     */
    public function editUser()
    {
        if(Auth::user()->group->id >= 4){
            //get input data
            $input_data = Input::all();
            $token = Input::get('_token');
            $user_id = $input_data['user_id'];
            $user_group = $input_data['user_groups'];

            $user_data = ['full_name' => $input_data['full_name'],
                'email' => $input_data['email'],
                'username' => $input_data['username'],
                'password' => $input_data['password'],
                'password_again' => $input_data['password_again']
            ];

            //check if csrf token is valid
            if(Session::token() != $token){
                return Redirect::to('admin/korisnici')->withErrors('Nevažeći CSRF token!');
            }

            //find if user exists
            $user = User::find($user_id);

            if($user == NULL){
                return Redirect::to('admin/korisnici')->withErrors('Korisnik sa zadanim ID-em ne postoji!');
            }
            else{
                $validator = Validator::make($user_data, User::$rulesLessStrict, User::$messages);

                //check validation results and save user if ok
                if($validator->fails()){
                    return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
                }
                else{
                    $user->full_name = e($user_data['full_name']);
                    $user->email = e($user_data['email']);
                    $user->username = e($user_data['username']);
                    $user->group_id = e($user_group);
                    if($user_data['password'] != ''){
                        $user->password = Hash::make($user_data['password']);
                    }
                    $user->save();

                    return Redirect::to('admin/korisnici')->with(['success' => 'Korisnik je uspješno izmjenjen!']);
                }
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * delete user
     * @param null $id
     * @return mixed
     */
    public function deleteUser($id = null)
    {
        if(Auth::user()->group->id >= 4){
            //find if user exists
            $user = User::find($id);

            if($user == NULL){
                return Redirect::to('admin/korisnici')->withErrors('Korisnik sa zadanim ID-em ne postoji!');
            }
            else{
                $user->delete();
                return Redirect::to('admin/korisnici')->withErrors('Korisnik je uspješno obrisan!');
            }
        }
        else{
            App::abort(403);
        }
    }
}