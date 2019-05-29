<?php
namespace Functions;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Header;

class ViewPage {
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
     * 
     * @param string $slug [Slug URL]
     * @return void
     */
    public function __construct(string $slug) {
        $this->page = new Page(); 
        $this->user = new Admin();

        $page = $this->page->getBySlug(strip_tags($slug));
        if (empty($page)) {
            return Header::location('/error404');
        }
        
        $breadcrumb = explode('/', \App::getUrl());
        $getPage = View::get('view', [
            'page' => $this->page->parseBBcodes($page[0]['content'])
        ]);
        
        return View::render('layout/main', [
            'page'       => $this->page,
            'user'       => $this->user,
            'title'      => $page[0]['name'],
            'html'       => $getPage,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
