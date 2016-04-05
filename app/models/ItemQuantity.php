<?php

class ItemQuantity extends Eloquent{

    /**
     * ItemQuantity Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	item_id INT UNSIGNED / FOREIGN KEY@items
     *  -   item_quantity INT UNSIGNED
     */

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items_quantity';
    public $timestamps = false;

    /**
     * define relationships
     */
    public function item()
    {
        return $this->belongsTo('Item', 'item_id');
    }
}