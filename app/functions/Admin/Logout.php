<?php
namespace Functions\Admin;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Header;

class Logout {
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
            return Header::location('/admin');
        }
        
        $this->user->doLogout();
        
        $breadcrumb = explode('/', \App::getUrl());     
        $message    = ['status' => 'success', 'text' => 'You have been logged out, redirecting in 3 seconds'];
        Header::refresh(3);
            
        return View::render('layout/main', [
            'title'       => 'Admin Login',
            'page'        => $this->page,
            'user'        => $this->user,
            'html'        => View::get('admin/logout', [
                'user'    => $this->user,
                'message' => $message,
            ]),
            'nohero'      => true,
            'breadcrumb'  => $breadcrumb,
        ]);        
    }
}
