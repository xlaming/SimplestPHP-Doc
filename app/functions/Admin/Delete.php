<?php
namespace Functions\Admin;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Header;
use Vendor\Validator;

class Remove {
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
     * Delete pages by ID
     * 
     * @return void
     */
    public function pages() {
        if (!$this->user->isAuth()) {
            return Header::location('/admin/login');
        }
        
        $id  = (int) \App::get('id');
        $get = $this->page->getById($id);
        
        if (!empty($get)) {
            $this->page->deletePage($id);
        }
        
        return Header::location('/admin/pages');
    }
    
    /**
     * Delete categories by ID
     * 
     * @return void
     */
    public function categories() {
        if (!$this->user->isAuth()) {
            return Header::location('/admin/login');
        }
        
        $id  = (int) \App::get('id');
        $get = $this->page->getCategory($id);
        
        if (!empty($get) || $get === 'Unknown') {
            $this->page->deleteCategory($id);
        }
        
        return Header::location('/admin/categories');
    }
}
