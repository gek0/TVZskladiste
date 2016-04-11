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
        if(Auth::user()->group_id >= 2){
            // get all finished orders
            $orders_data = Order::where('order_status', 1)->orderBy('id', 'DESC')->get();

            // add user full name to data array
            foreach($orders_data as $order){
                //find user
                $user = User::find($order->user_id);
                $order['user_full_name'] = $user->full_name;
            }

            return View::make('admin.orders.orders')->with(['orders_data' => $orders_data]);
        }
        else{
            App::abort(403);
        }
    }

    /**
     * show all user orders
     * @return mixed
     */
    public function showMyOrders()
    {
        // get orders archive
        $archived_orders = Order::where('user_id', Auth::user()->id)->where('order_status', 1)->orderBy('id', 'DESC')->get();

        // get last order
        $last_order = Order::where('user_id', Auth::user()->id)->where('order_status', 0)->orderBy('id', 'DESC')->first();

        $items_data = [];
        $order_total_price = 0;
        if($last_order != NULL) {
            // get all items on last order
            $items_data = ItemCart::where('order_id', $last_order->id)->get();

            // count total price of items on cart list
            foreach ($items_data as $item) {
                $order_total_price += ($item->item['item_price'] * $item->quantity);
            }

            $last_order_id = $last_order->id;
        }
        else{
            $last_order_id = NULL;
        }

        return View::make('admin.orders.my-orders')->with(['items_data' => $items_data,
                                                            'order_total_price' => $order_total_price,
                                                            'last_order_id' => $last_order_id,
                                                            'archived_orders' => $archived_orders
        ]);

    }

    /**
     * add item to user cart
     * @param null $id
     * @return mixed
     */
    public function addToCart($id = null)
    {
        //get input data
        $input_data = Input::all();
        $token = Input::get('_token');

        if($input_data['quantity'] <= 0){
            $input_data['quantity'] = 1;
        }

        //check if item exists in database
        $item = Item::find(e($id));

        // update item quantity on storage
        if($input_data['quantity'] > $item->item_quantity){
            return Redirect::back()->withErrors('Nema dovoljno proizvoda u skladištu!');
        }
        else{
            $item->item_quantity -= $input_data['quantity'];
            $item->save();
            if($item->item_quantity == 0){
                $item->item_availability = 0;
                $item->save();
            }
        }

        // get order ID
        $order = Order::where('user_id', Auth::user()->id)->where('order_status', 0)->orderBy('id', 'DESC')->first();
        if($order == NULL) {
            $user_order = new Order;
            $user_order->order_date = Carbon\Carbon::now();
            $user_order->user_id = Auth::user()->id;
            $user_order->save();

            $id_order = $user_order->id; //ID of order
        }
        else{
            $id_order = $order->id; //ID of order
        }

        if($item){
            $item_cart = new ItemCart;
            $item_cart->item_id = e($id);
            $item_cart->quantity = e($input_data['quantity']);
            $item_cart->order_id = e($id_order);
            $item_cart->save();

            return Redirect::back()->with(['success' => 'Proizvod je uspješno dodan u košaricu!']);
        }
        else{
            return Redirect::back()->withErrors('Proizvod nije dodan u košaricu!');
        }
    }

    /**
     * delete item from order
     * @param null $id
     * @return mixed
     */
    public function deleteCartItem($id = null)
    {
        if(Auth::user()->group->id < 2) {
            $item = ItemCart::find($id);

            if ($item == NULL) {
                return Redirect::back()->withErrors('Proizvod sa zadanim ID-em ne postoji!');
            } else {
                // restore item storage quantity and availability
                $item_storage = Item::find($item->item_id);
                $item_storage->item_quantity += $item->quantity;
                $item_storage->item_availability = 1;
                $item_storage->save();

                // delete item from cart and order
                $item->delete();

                return Redirect::back()->with(['success' => 'Proizvod je uspješno obrisan s narudžbe!']);
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * delete item from order by admin
     * @param null $id
     * @return mixed
     */
    public function deleteCartItemAdmin($id = null)
    {
        if(Auth::user()->group_id >= 2) {
            $item = ItemCart::find($id);

            if($item == NULL){
                return Redirect::back()->withErrors('Proizvod sa zadanim ID-em ne postoji!');
            }
            else{
                // restore item storage quantity and availability
                $item_storage = Item::find($item->item_id);
                $item_storage->item_quantity += $item->quantity;
                $item_storage->item_availability = 1;
                $item_storage->save();

                // update new price on order
                $order = Order::find($item->order_id);
                $order->order_price -= ($item_storage->item_price * $item->quantity);
                $order->save();

                // delete item from cart and order
                $item->delete();

                return Redirect::back()->with(['success' => 'Proizvod je uspješno obrisan s narudžbe!']);
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * accept order and move to archive
     * @return mixed
     */
    public function acceptCartOrder()
    {
        //get input data
        $input_data = Input::all();
        $token = Input::get('_token');

        $order_price = e($input_data['order_price']);
        $order_id = e($input_data['order_id']);

        $order = Order::find($order_id);

        if($order == NULL){
            return Redirect::back()->withErrors('Narudžba nije mogla biti potvrđena!');
        }
        else{
            $order->order_price = $order_price;
            $order->order_status = 1;
            $order->save();

            return Redirect::back()->with(['success' => 'Narudžba je uspješno potvrđena!']);
        }
    }


    /**
     * show archived order to user
     * @param null $id
     * @return mixed
     */
    public function showArchivedOrder($id = null)
    {
        // check if order exists
        $order_data = Order::find($id);

        if($order_data == NULL){
            return Redirect::to('admin/moje-narudzbe')->withErrors('Narudžba ne postoji!');
        }
        else{
            // allow only users with enough privileges or owner of order
            if(Auth::user()->group->id >= 2 || ($order_data->user_id == Auth::user()->id)){
                // get all items in order
                $items_data = ItemCart::where('order_id', $order_data->id)->get();

                // define combined array
                $arrayObject1 = new RecursiveArrayObject($order_data);
                $arrayObject2 = new RecursiveArrayObject($items_data);

                $data = [];
                array_push($data, $arrayObject1->getArrayCopy(), $arrayObject2->getArrayCopy());

                return View::make('admin.orders.archived-order')->with(['order_data' => $order_data,
                                                                        'items_data' => $items_data
                ]);
            }
            else{
                App::abort(403);
            }
        }
    }

    /**
     * show archived order to admin
     * @param null $id
     * @return mixed
     */
    public function showArchivedOrderAdmin($id = null)
    {
        if(Auth::user()->group_id >= 2) {
            // check if order exists
            $order_data = Order::find($id);

            if ($order_data == NULL) {
                return Redirect::to('admin/moje-narudzbe')->withErrors('Narudžba ne postoji!');
            } else {
                // allow only users with enough privileges or owner of order
                if (Auth::user()->group->id >= 2) {
                    // get all items in order
                    $items_data = ItemCart::where('order_id', $order_data->id)->get();

                    // merge objects to array
                    $data = [];
                    //$data['order_data'] = $order_data;

                    // grab users full name for the order
                    $orders_full_data = [];
                    $user = User::find($order_data->user_id);
                    $orders_full_data = $order_data;
                    $orders_full_data['user_full_name'] = $user->full_name;
                    $data['order_data'] = $orders_full_data;

                    // grab item data to array for each item
                    $items_full_data = [];
                    foreach ($items_data as $item) {
                        $current_item = Item::find($item->item_id);

                        $items_full_data[$item->id]['item_cart_id'] = $item->id;
                        $items_full_data[$item->id]['item_name'] = $current_item->item_name;
                        $items_full_data[$item->id]['category_name'] = $current_item->category->category_name;
                        $items_full_data[$item->id]['item_price'] = $current_item->item_price;
                        $items_full_data[$item->id]['item_quantity'] = $item->quantity;
                    }
                    $data['items_data'] = $items_full_data;

                    return View::make('admin.orders.archived-order-admin')->with(['data' => $data]);
                } else {
                    App::abort(403);
                }
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * print archived order as pdf file
     * @param null $id
     * @return mixed
     */
    public function showMyOrderPrint($id = null)
    {
        // check if order exists
        $order_data = Order::find($id);

        if($order_data == NULL){
            return Redirect::to('admin/moje-narudzbe')->withErrors('Narudžba ne postoji!');
        }
        else{
            // allow only users with enough privileges or owner of order
            if(Auth::user()->group_id >= 2 || ($order_data->user_id == Auth::user()->id)){
                // get all items in order
                $items_data = ItemCart::where('order_id', $order_data->id)->get();

                // merge objects to array
                $data = [];
                $data['order_data'] = $order_data;

                // grab item data to array for each item
                $items_full_data = [];
                foreach($items_data as $item){
                    $current_item = Item::find($item->item_id);

                    $items_full_data[$item->id]['item_name'] = $current_item->item_name;
                    $items_full_data[$item->id]['category_name'] = $current_item->category->category_name;
                    $items_full_data[$item->id]['item_price'] = $current_item->item_price;
                    $items_full_data[$item->id]['item_quantity'] = $item->quantity;
                }
                $data['items_data'] = $items_full_data;

                $pdf = PDF::loadView('admin.orders.print-order', ['data' => $data]);
                return $pdf->download('Narudzba_ID_'.$data['order_data']['id'].'.pdf');
            }
            else{
                App::abort(403);
            }
        }
    }

    /**
     * delete user order
     * @param null $id
     * @return mixed
     */
    public function deleteOrder($id = null)
    {
        if(Auth::user()->group_id >= 2) {
            // check if order exists
            $order_data = Order::find($id);

            if($order_data == NULL){
                return Redirect::to('admin/narudzbe')->withErrors('Narudžba ne postoji!');
            }
            else{
                // restore all items quantity from cart to storage
                $items_cart_data = ItemCart::where('order_id', '=', $order_data->id)->get();
                foreach($items_cart_data as $item){
                    $current_item = Item::find($item->item_id);
                    $current_item->item_quantity += $item->quantity;
                    $current_item->item_availability = 1;
                    $current_item->save();
                }

                $order_data->delete();

                return Redirect::to('admin/narudzbe')->with(['success' => 'Narudžba je uspješno obrisana!']);
            }
        }
        else{
            App::abort(403);
        }
    }

}