<?php
namespace Functions\Admin;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Header;
use Vendor\Validator;

class Login {
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
        if ($this->user->isAuth()) {
            return Header::location('/admin');
        }
        
        $breadcrumb = explode('/', \App::getUrl());
        $message = ['status' => null, 'text' => null];
        
        $user = (string) \App::post('user');
        $pass = (string) \App::post('pass');
            
        if (\App::method() === 'POST') {
            if (!\App::validateCSRF()) {
                $message = ['status' => 'danger', 'text' => 'Invalid CSRF token'];
            } else if (!Validator::isFilled([$user, $pass])) {
                $message = ['status' => 'danger', 'text' => 'Missing fields'];
            } else {
                $login = $this->user->doLogin($user, $pass);
                if ($login) {
                    Header::refresh(3);
                    $message = ['status' => 'info', 'text' => 'You have been logged in, refreshing the page in 3 seconds'];
                } else {
                    $message = ['status' => 'danger', 'text' => 'Invalid username or password'];
                }
            }
        }
            
        return View::render('layout/main', [
            'title'       => 'Admin Login',
            'page'        => $this->page,
            'user'        => $this->user,
            'html'        => View::get('admin/login', [
                'user'    => $this->user,
                'message' => $message,
            ]),
            'nohero'      => true,
            'breadcrumb'  => $breadcrumb,
        ]);        
    }
}
