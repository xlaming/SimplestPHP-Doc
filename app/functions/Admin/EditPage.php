<?php
namespace Functions\Admin;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Header;
use Vendor\Validator;

class EditPage {
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
        
        $id = (int) \App::get('id');
        $getPage = $this->page->getById($id);
        
        if (empty($getPage)) {
            return Header::location('/admin/pages');
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
            } else if (empty($getCat) || $getCat === 'Unknown') {
                $message = ['status' => 'danger', 'text' => 'Category not found'];
            } else {
                $this->page->updatePage($id, $name, $slug, $text, $cat_id);
                $message = ['status' => 'info', 'text' => 'Page has been updated, refreshing page...'];
                Header::refresh(3);
            }
        }
            
        return View::render('layout/main', [
            'title'       => 'Edit page',
            'page'        => $this->page,
            'user'        => $this->user,
            'html'        => View::get('admin/edit_page', [
                'user'    => $this->user,
                'page'    => $this->page,
                'message' => $message,
                'p'       => $getPage[0],
            ]),
            'nohero'      => true,
            'breadcrumb'  => $breadcrumb,
        ]);        
    }
}
