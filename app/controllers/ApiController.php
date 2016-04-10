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
        $api_array[] = ['route' => 'api/orders', 'description' => 'List all orders'];
        $api_array[] = ['route' => 'api/status', 'description' => 'Show system status'];

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

    /**
     * get list of all orders
     * @return string
     */
    public function getOrders()
    {
        $data = Order::orderBy('id', 'ASC')->get();

        // add user full name to list
        foreach($data as $d){
            $user = User::find($d->user_id);

            $d['user_full_name'] = $user->full_name;
        }


        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * show system status
     * @return string
     */
    public function getStatus()
    {
        $all_users = User::count();
        $regular_users = User::where('group_id', '=', 1)->count();
        $categories = Category::count();

        $items = Item::get();
        $unique_items = count($items);
        $total_num_of_items = 0;
        foreach($items as $i){
            $total_num_of_items += $i->item_quantity;
        }

        $orders = Order::where('order_status', '=', 1)->get();
        $orders_count = count($orders);
        $orders_price = 0;
        foreach($orders as $ord){
            $orders_price += $ord->order_price;
        }

        $items_cart = ItemCart::get();
        $unique_items_cart = count($items_cart);
        $total_num_of_items_cart = 0;
        foreach($items_cart as $i){
            $total_num_of_items_cart += $i->quantity;
        }

        $data = [];
        $data[] = ['all_users' => $all_users];
        $data[] = ['regular_users' => $regular_users];
        $data[] = ['categories' => $categories];
        $data[] = ['unique_items' => $unique_items];
        $data[] = ['total_num_of_items' => $total_num_of_items];
        $data[] = ['orders_count' => $orders_count];
        $data[] = ['orders_price' => $orders_price];
        $data[] = ['unique_items_cart' => $unique_items_cart];
        $data[] = ['total_num_of_items_cart' => $total_num_of_items_cart];

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

}