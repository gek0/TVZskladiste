<?php

class CategoryController extends BaseController{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show all item categories
     * @return mixed
     */
    public function showCategories()
    {
        //grab all categories
        $categories_data = Category::orderBy('category_name', 'ASC')->get();

        return View::make('admin.categories.categories')->with(['categories_data' => $categories_data]);
    }

    /**
     * add new item category
     * @return mixed
     */
    public function addCategory()
    {
        if(Auth::user()->group->id >= 2){
            //get input data
            $input_data = Input::all();
            $token = Input::get('_token');

            $form_data = ['category_name' => $input_data['category_name']];

            //check if csrf token is valid
            if(Session::token() != $token){
                return Redirect::to('admin/kategorije')->withErrors('Nevažeći CSRF token!');
            }

            $validator = Validator::make($form_data, Category::$rules, Category::$messages);
            //check validation results and category if ok
            if($validator->fails()){
                return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
            }
            else{
                $category = new Category;
                $category->category_name = e($form_data['category_name']);
                $category->save();

                return Redirect::to('admin/kategorije')->with(['success' => 'Kategorija je uspješno dodana!']);
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * show category edit form
     * @param null $id
     * @return mixed
     */
    public function showCategoryEditForm($id = null)
    {
        if(Auth::user()->group->id >= 2){
            //find if category exists
            $category = Category::find($id);

            if($category == NULL){
                return Redirect::to('admin/kategorije')->withErrors('Kategorija sa zadanim ID-em ne postoji!');
            }
            else{
                return View::make('admin.categories.edit-category')->with(['category' => $category]);
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * update category data
     * @return mixed
     */
    public function editCategory()
    {
        if(Auth::user()->group->id >= 2){
            //get input data
            $input_data = Input::all();
            $token = Input::get('_token');
            $category_id = $input_data['category_id'];

            $category_data = ['category_name' => $input_data['category_name']];

            //check if csrf token is valid
            if(Session::token() != $token){
                return Redirect::to('admin/kategorije')->withErrors('Nevažeći CSRF token!');
            }

            //find if category exists
            $category = Category::find($category_id);

            if($category == NULL){
                return Redirect::to('admin/kategorije')->withErrors('Kategorija sa zadanim ID-em ne postoji!');
            }
            else{
                $validator = Validator::make($category_data, Category::$rulesLessStrict, Category::$messages);

                //check validation results and save user if ok
                if($validator->fails()){
                    return Redirect::back()->withErrors($validator->getMessageBag()->toArray())->withInput();
                }
                else{
                    $category->category_name = e($category_data['category_name']);
                    $category->save();

                    return Redirect::to('admin/kategorije')->with(['success' => 'Kategorija je uspješno izmjenjena!']);
                }
            }
        }
        else{
            App::abort(403);
        }
    }

    /**
     * delete item category
     * @param null $id
     * @return mixed
     */
    public function deleteCategory($id = null)
    {
        if(Auth::user()->group->id >= 2){
            //find if category exists
            $category = Category::find($id);

            if($category == NULL){
                return Redirect::to('admin/kategorije')->withErrors('Kategorija sa zadanim ID-em ne postoji!');
            }
            else{
                $category->delete();
                return Redirect::to('admin/kategorije')->with(['success' => 'Kategorija je uspješno obrisana!']);
            }
        }
        else{
            App::abort(403);
        }
    }

}