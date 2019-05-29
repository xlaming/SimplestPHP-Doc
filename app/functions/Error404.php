<?php
namespace Functions;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Security;

class Error404 {
    /**
     * Cache var
     */
    protected $page;
    /**
     * Cache var
     */
    protected $user;
    /**
     * Params allowed
     * @var array
     */
    protected $params = ['docs', 'crypt'];
    
    /**
     * Constructor
     * 
     * @param string $value [URL params]
     * @return  void
     */
    public function __construct(string $value) {
        $this->page = new Page();
        $this->user = new Admin();
        
        $path = pathinfo($value);
        $name = strtolower($path['dirname']);

        if (in_array($name, $this->params)) {
            $getParam = strip_tags($path['filename']);
            if ('docs' === $name) {
                return new ViewPage($getParam);
            } else if ('crypt' === $name) {
                return View::plain(Security::encrypt($getParam));
            }
        }
        
        return View::render('layout/main', [
            'title'      => 'Not Found', 
            'page'       => $this->page,
            'user'       => $this->user,
            'html'       => View::get('error'),
            'nohero'     => true,
            'breadcrumb' => ['', '404'],
        ]);
    }
}
