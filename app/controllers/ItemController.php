<?php

class ItemController extends BaseController
{

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
        //grab all items
        $items_data = Item::orderBy('item_name', 'ASC')->paginate(10);

        //grab all categories
        $item_categories = Category::orderBy('id')->lists('category_name', 'id');

        return View::make('admin.items.items')->with(['items_data' => $items_data,
                                                    'item_categories' => $item_categories
        ]);
    }

    /**
     * add new item
     * @return mixed
     */
    public function addItem()
    {
        if(Auth::user()->group->id >= 2){
            //get input data
            $input_data = Input::all();
            $token = Input::get('_token');

            $form_data = ['item_name' => $input_data['item_name'],
                            'item_price' => $input_data['item_price'],
                            'item_availability' => $input_data['item_availability'],
                            'item_quantity' => $input_data['item_quantity'],
                            'category_id' => $input_data['category_id']
            ];

            //check if csrf token is valid
            if(Session::token() != $token){
                return Redirect::to('admin/korisnici')->withErrors('Nevažeći CSRF token!');
            }

            $validator = Validator::make($form_data, Item::$rules, Item::$messages);
            //check validation results and category if ok
            if($validator->fails()){
                return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
            }
            else{
                $item = new Item;
                $item->item_name = e($form_data['item_name']);
                $item->item_price = e($form_data['item_price']);
                $item->item_availability = e($form_data['item_availability']);
                $item->category_id = e($form_data['category_id']);
                if(e($form_data['item_availability']) == 1){
                    $item->item_quantity = e($form_data['item_quantity']);
                }
                else{
                    $item->item_quantity = 0;
                }
                $item->save();

                return Redirect::to('admin/proizvodi')->with(['success' => 'Proizvod je uspješno dodan!']);
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * edit selected item
     * @return mixed
     */
    public function editItem()
    {
        if(Auth::user()->group->id >= 2){
            //get input data
            $input_data = Input::all();
            $token = Input::get('_token');
            $item_id = Input::get('item_id');

            $form_data = ['item_name' => $input_data['item_name'],
                        'item_price' => $input_data['item_price'],
                        'item_availability' => $input_data['item_availability'],
                        'item_quantity' => $input_data['item_quantity'],
                        'category_id' => $input_data['category_id']
                    ];

            //check if csrf token is valid
            if(Session::token() != $token){
                return Redirect::to('admin/korisnici')->withErrors('Nevažeći CSRF token!');
            }

            //find if item exists
            $item = Item::find($item_id);

            if($item == NULL){
                return Redirect::to('admin/proizvodi')->withErrors('Proizvod sa zadanim ID-em ne postoji!');
            }
            else {
                $validator = Validator::make($form_data, Item::$rulesLessStrict, Item::$messages);
                //check validation results and category if ok
                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
                } else {
                    $item->item_name = e($form_data['item_name']);
                    $item->item_price = e($form_data['item_price']);
                    $item->item_availability = e($form_data['item_availability']);
                    $item->category_id = e($form_data['category_id']);
                    if(e($form_data['item_availability']) == 1){
                        $item->item_quantity = e($form_data['item_quantity']);
                    }
                    else{
                        $item->item_quantity = 0;
                    }
                    $item->save();

                    return Redirect::to('admin/proizvodi')->with(['success' => 'Proizvod je uspješno izmjenjen!']);
                }
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * shown item edit form
     * @param null $id
     * @return mixed
     */
    public function showItemEditForm($id = null)
    {
        if(Auth::user()->group->id >= 2){
            $item = Item::find($id);

            if($item == NULL){
                return Redirect::to('admin/proizvodi')->withError('Proizvod sa zadanim ID-em ne postoji!');
            }
            else{
                //grab all categories
                $item_categories = Category::orderBy('id')->lists('category_name', 'id');

                return View::make('admin.items.edit-item')->with(['item' => $item,
                                                                'item_categories' => $item_categories
                ]);
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * delete item
     * @param null $id
     * @return mixed
     */
    public function deleteItem($id = null)
    {
        if(Auth::user()->group->id >= 2){
            //find if item exists
            $item = Item::find($id);

            if($item == NULL){
                return Redirect::to('admin/proizvodi')->withErrors('Proizvod sa zadanim ID-em ne postoji!');
            }
            else{
                $item->delete();
                return Redirect::to('admin/proizvodi')->with(['success' => 'Proizvod je uspješno obrisan!']);
            }
        }
        else{
            App::abort(403);
        }
    }

}