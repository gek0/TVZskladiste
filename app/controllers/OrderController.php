<?php

class OrderController extends BaseController{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show admin orders page
     * @return mixed
     */
    public function showAllUsersOrders()
    {
        if(Auth::user()->group->id >= 2){
            return View::make('admin.orders.orders');
        }
        else{
            App::abort(403);
        }
    }

    public function showMyOrders()
    {
        return View::make('admin.orders.my-orders');
    }

}