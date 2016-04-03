<?php

class AdminController extends BaseController{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show admin homepage
     * @return mixed
     */
    public function showHome()
    {
        return View::make('admin.index');
    }

    /**
     * @return mixed
     * show users list
     */
    public function showUsers()
    {
        if(Auth::user()->group->id >= 4){
            //get all users
            $users = User::orderBy('id', 'ASC')->get();

            return View::make('admin.users')->with(['users' => $users]);
        }
        else{
            App::abort(403);
        }
    }

    /**
     * @param null $id
     * @return mixed
     * show user edit form
     */
    public function showUserEditForm($id = null)
    {
        if(Auth::user()->group->id >= 4){
            //find if user exists
            $user = User::find($id);

            if($user == NULL){
                return Redirect::to('admin/korisnici')->withErrors('Korisnik sa zadanim ID-em ne postoji!');
            }
            else{
                return View::make('admin.edit-user')->with(['user' => $user]);
            }
        }
        else{
            App::abort(403);
        }
    }

    public function editUser()
    {
        if(Auth::user()->group->id >= 4){

        }
        else{
            App::abort(403);
        }
    }

    public function deleteUser($id = null)
    {
        if(Auth::user()->group->id >= 4){

        }
        else{
            App::abort(403);
        }
    }
}