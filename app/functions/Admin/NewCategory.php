<?php
namespace Functions\Admin;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Header;
use Vendor\Validator;

class NewCategory {
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
        $message = ['status' => null, 'text' => null];
            
        if (\App::method() === 'POST') {
            $name = (string) \App::post('name');
            $icon = (string) \App::post('icon');
        
            if (!\App::validateCSRF()) {
                $message = ['status' => 'danger', 'text' => 'Invalid CSRF token'];
            } else if (!Validator::isFilled([$name, $icon])) {
                $message = ['status' => 'danger', 'text' => 'Missing fields'];
            } else {
                $this->page->addCategory($name, $icon);
                $message = ['status' => 'info', 'text' => 'New category has been added'];
            }
        }
            
        return View::render('layout/main', [
            'title'       => 'New category',
            'page'        => $this->page,
            'user'        => $this->user,
            'html'        => View::get('admin/newcategory', [
                'user'    => $this->user,
                'message' => $message,
            ]),
            'nohero'      => true,
            'breadcrumb'  => $breadcrumb,
        ]);        
    }
}
