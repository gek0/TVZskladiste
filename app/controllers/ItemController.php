<?php

class ItemController extends BaseController{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show items
     * @return mixed
     */
    public function showItems()
    {
        return View::make('admin.items.items');
    }

}