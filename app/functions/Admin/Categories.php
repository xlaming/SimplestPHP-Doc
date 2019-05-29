<?php
namespace Functions\Admin;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Header;
use Vendor\Validator;

class Categories {
    /**
     * Cache var
     */
    protected $page;
    /**
     * Cache var
     */
    protected $user;

    /**
     * Constructor
     */
    public function __construct() {
        $this->page = new Page();    
        $this->user = new Admin();
    }

    /**
     * Run the index
     * 
     * @return void
     */
    public function index() {
        if (!$this->user->isAuth()) {
            return Header::location('/admin/login');
        }
        
        $breadcrumb = explode('/', \App::getUrl());
        
        return View::render('layout/main', [
            'title'       => 'Categories',
            'page'        => $this->page,
            'user'        => $this->user,
            'html'        => View::get('admin/categories', [
                'user'    => $this->user,
                'page'    => $this->page,
            ]),
            'nohero'      => true,
            'breadcrumb'  => $breadcrumb,
        ]);
    }
}
