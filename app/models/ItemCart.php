<?php

class ItemCart extends Eloquent{

    /**
     * ItemCart Database Model
     *  -   id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   item_id INT UNSIGNED / FOREIGN KEY@items
     *  -   quantity INT UNSIGNED / DEFAULT = 1
     *  -   order_id INT UNSIGNED / FOREIGN KEY@orders
     *  -   created_at TIMESTAMP
     *  -   updated_at TIMESTAMP
     */

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items_cart';

    /**
     * define relationships
     */
    public function order()
    {
        return $this->belongsTo('Order', 'order_id');
    }

    public function item()
    {
        return $this->hasOne('Item', 'id');
    }
}