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
     * get api details
     * @return string
     */
    public function showApi(){
        $api_array = [];
        $api_array[] = ['route' => 'api/users', 'description' => 'List all users'];
        $api_array[] = ['route' => 'api/categories', 'description' => 'List all items categories'];
        $api_array[] = ['route' => 'api/items', 'description' => 'List all items'];

        return json_encode($api_array, JSON_UNESCAPED_UNICODE);
    }

    /**
     * get list of all users
     * @return mixed
     */
    public function getUsers()
    {
        $data = User::orderBy('id', 'ASC')->get();

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * get list of all categories
     * @return string
     */
    public function getCategories()
    {
        $data = Category::orderBy('id', 'ASC')->get();

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * get list of all items
     * @return string
     */
    public function getItems()
    {
        $data = Item::orderBy('id', 'ASC')->get();

        foreach($data as $d){
            $d = ['category_name' => $d->category->category_name];
        }

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

}