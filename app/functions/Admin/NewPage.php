<?php
namespace Functions\Admin;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Header;
use Vendor\Validator;

class NewPage {
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
     * Run index
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
            $cat_id = (int) \App::post('cat_id');
            $name   = (string) \App::post('name');
            $slug   = (string) \App::post('slug');
            $text   = (string) \App::post('text', false);
            $getCat = $this->page->getCategory($cat_id);
            
            if (!\App::validateCSRF()) {
                $message = ['status' => 'danger', 'text' => 'Invalid CSRF token'];
            } else if (!Validator::isFilled([$name, $slug, $text, $cat_id])) {
                $message = ['status' => 'danger', 'text' => 'Missing fields'];
            } else if (!empty($this->page->getBySlug($slug))) {
                $message = ['status' => 'danger', 'text' => 'This page already exists'];
            } else if (empty($getCat) || $getCat === 'Unknown') {
                $message = ['status' => 'danger', 'text' => 'Category not found'];
            } else {
                $this->page->addPage($name, $slug, $text, $cat_id);
                Header::location('/docs/' . $slug);
            }
        }
            
        return View::render('layout/main', [
            'title'       => 'New page',
            'page'        => $this->page,
            'user'        => $this->user,
            'html'        => View::get('admin/newpage', [
                'user'    => $this->user,
                'page'    => $this->page,
                'message' => $message,
            ]),
            'nohero'      => true,
            'breadcrumb'  => $breadcrumb,
        ]);        
    }
}
