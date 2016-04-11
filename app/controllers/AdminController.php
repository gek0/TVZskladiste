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
     * show system status
     * @return mixed
     */
    public function showStatus()
    {
        if(Auth::user()->group_id >= 3) {
            $all_users = User::count();
            $regular_users = User::where('group_id', '=', 1)->count();
            $categories = Category::count();

            $items = Item::get();
            $unique_items = count($items);
            $total_num_of_items = 0;
            foreach ($items as $i) {
                $total_num_of_items += $i->item_quantity;
            }

            $orders = Order::where('order_status', '=', 1)->get();
            $orders_count = count($orders);
            $orders_price = 0;
            foreach ($orders as $ord) {
                $orders_price += $ord->order_price;
            }

            $items_cart = ItemCart::get();
            $unique_items_cart = count($items_cart);
            $total_num_of_items_cart = 0;
            foreach ($items_cart as $i) {
                $total_num_of_items_cart += $i->quantity;
            }


            return View::make('admin.status')->with(['all_users' => $all_users,
                                                    'regular_users' => $regular_users,
                                                    'categories' => $categories,
                                                    'unique_items' => $unique_items,
                                                    'total_num_of_items' => $total_num_of_items,
                                                    'orders_count' => $orders_count,
                                                    'orders_price' => $orders_price,
                                                    'unique_items_cart' => $unique_items_cart,
                                                    'total_num_of_items_cart' => $total_num_of_items_cart
            ]);
        }
        else{
            App::abort(403);
        }
    }
}