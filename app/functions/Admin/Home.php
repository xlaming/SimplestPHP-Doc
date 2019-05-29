<?php
namespace Functions\Admin;

use Vendor\View;
use Classes\Page;
use Classes\Admin;
use Vendor\Header;
use Vendor\Validator;

class Home {
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
        
        $message    = ['status' => 'info', 'text' => 'Welcome to the SimplestPHP Administration Panel!'];
        $breadcrumb = explode('/', \App::getUrl());
        $current    = $this->user->getConfig('highlight') === '0' 
            ? ['Disabled', 'Enable', 1] 
            : ['Enabled', 'Disable', 0];        

        $highlight = \App::get('hl');
        if (isset($highlight)) {
            if (in_array(intval($highlight), [0, 1])) {
                $this->user->setConfig(['highlight' => strval($highlight)]);
                Header::location('/admin');
            }
        }
        
        if (\App::method() === 'POST') {
            $downlink = \App::post('down_link');
            $gitlink  = \App::post('git_link');
            $version  = \App::post('version');
            
            if (!\App::validateCSRF()) {
                $message = ['status' => 'danger', 'text' => 'Invalid CSRF token'];
            } else if (!Validator::isFilled([$downlink, $gitlink, $version])) {
                $message = ['status' => 'danger', 'text' => 'Missing fields'];
            } else if (!Validator::isValidURL($downlink) || !Validator::isValidURL($gitlink)) {
                $message = ['status' => 'danger', 'text' => 'Both fields should be valid URL'];
            } else {
                $this->user->setConfig([
                    'down_link' => $downlink,
                    'git_link'  => $gitlink,
                    'version'   => $version
                ]);
                $message = ['status' => 'success', 'text' => 'Fields updated successful'];
            }
        }
        
        return View::render('layout/main', [
            'title'       => 'Admin CP',
            'page'        => $this->page,
            'user'        => $this->user,
            'html'        => View::get('admin/home', [
                'user'    => $this->user,
                'message' => $message,
                'hl'      => $current,
            ]),
            'nohero'      => true,
            'breadcrumb'  => $breadcrumb,
        ]);
    }
}
