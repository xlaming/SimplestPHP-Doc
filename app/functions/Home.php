<?php
namespace Functions;

use Vendor\View;
use Classes\Page;
use Classes\Admin;

class Home {
    /**
     * Cache var
     */
    protected $page;
    
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
        $getPage = View::get('home');
        
        return View::render('layout/main', [
            'title'      => 'Simple thing, for creating big things', 
            'page'       => $this->page,
            'user'       => $this->user,
            'html'       => $getPage,
            'breadcrumb' => ['', ''],
        ]);
    }
}
