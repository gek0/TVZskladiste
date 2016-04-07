<?php

class Item extends Eloquent{

    /**
     * Item Database Model
     *  -   id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -   item_name VARCHAR(255) / UNIQUE
     *  -   item_price DOUBLE_UNSIGNED
     *  -   item_availability INT UNSIGNED / DEFAULT = 1
     *  -   item_quantity INT UNSIGNED / DEFAULT = 1
     *  -   category_id INT UNSIGNED / FOREIGN KEY@categories
     *  -   created_at TIMESTAMP
     *  -   updated_at TIMESTAMP
     */

    /**
     * validation rules for product entities
     *
     */
    public static $rules = ['item_name' => 'required|between:1,255|unique:items',
                            'item_price' => 'required',
                            'item_availability' => 'required',
                            'item_quantity' => 'integer',
                            'category_id' => 'integer',
    ];

    public static $rulesLessStrict = ['item_name' => 'required|between:1,255',
                                    'item_price' => 'required',
                                    'item_availability' => 'required',
                                    'category_id' => 'integer',
    ];

    public static $rulesCategorySort = ['category_id' => 'integer'];

    /**
     * validation error messages
     *
     */
    public static $messages = ['item_name.required' => 'Ime proizvoda je obavezno.',
                                'item_name.between' => 'Ime proizvoda mora biti kraće od 255 znakova.',
                                'item_name.unique' => 'Proizvod s istim imenom već postoji.',
                                'item_price.required' => 'Cijena proizvoda je obavezna.',
                                'item_availability.required' => 'Status proizvoda je obavezno polje.',
                                'item_quantity.integer' => 'Količina proizvoda mora biti cijeli broj',
                                'category_id.integer' => 'Kategorija proizvoda je obavezna.',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * define relationships
     */
    public function category()
    {
        return $this->belongsTo('Category', 'category_id');
    }
}