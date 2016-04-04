<?php

class Category extends Eloquent{

    /**
     * Category Database Model
     * 	-	id INT UNSIGNED / AUTO_INCREMENT PRIMARY KEY
     *  -	category_name VARCHAR(255) / UNIQUE
     *  -   created_at TIMESTAMP
     *  -   updated_at TIMESTAMP
     */

    /**
     * validation rules for category entities
     *
     */
    public static $rules = ['category_name' => 'required|between:1,255|unique:categories'];
    public static $rulesLessStrict = ['category_name' => 'required|between:1,255'];

    /**
     * validation error messages
     *
     */
    public static $messages = ['category_name.required' => 'Ime kategorije je obavezno.',
                                'category_name.between' => 'Ime kategorije mora biti kraće od 255 znakova.',
                                'category_name.unique' => 'Kategorija s istim imenom već postoji.',
                            ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * define relationships
     */
    public function items()
    {
        return $this->belongsToMany('Item');
    }

}