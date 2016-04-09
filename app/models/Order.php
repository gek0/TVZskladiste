<?php

class Order extends Eloquent{

    /**
     * Order Database Model
     *  -   id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   order_data DATETIME
     *  -   order_status INT UNSIGNED / DEFAULT = 0
     *  -   order_price INT UNSIGNED / DEFAULT = 0
     *  -   created_at TIMESTAMP
     *  -   updated_at TIMESTAMP
     */

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * define relationships
     */
    public function items_cart()
    {
        return $this->hasMany('ItemCart', 'order_id');
    }
}