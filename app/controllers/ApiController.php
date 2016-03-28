<?php

class ApiController extends BaseController{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * get list of all users
     * @return mixed
     */
    public function getUsers()
    {
        $users_data = User::orderBy('id', 'ASC')->get();

        return json_encode($users_data, JSON_UNESCAPED_UNICODE);
    }
}