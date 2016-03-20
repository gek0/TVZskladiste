<?php

class PublicController extends BaseController
{

    /**
     * CSRF validation on requests
     */
    public function __construct()
    {
        $this->beforeFilter('crfs', ['on' => ['post', 'put', 'patch', 'delete']]);
    }

    /**
     * show homepage
     * @return mixed
     */
    public function showHome()
    {
        return View::make('public.index')->with(['page_title' => 'Dobrodošli']);
    }
}