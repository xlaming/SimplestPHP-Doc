<?php
namespace Classes;

use Vendor\Security;
use Vendor\Database;

class Admin {
    /**
     * Cache var
     */
    protected $sql;
    /**
     * Site ID
     * @var integer
     */
    protected $site = 1;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->sql = new Database;
    }
    
    /**
     * Verify if the user is logged in
     * 
     * @return boolean
     */
    public function isAuth(): bool {
        if (!array_key_exists('user', $_COOKIE) || !array_key_exists('pass', $_COOKIE)) {
            return false;
        }
        
        $user = strip_tags($_COOKIE['user']);
        $pass = strip_tags($_COOKIE['pass']);
        
        $getUser = $this->sql->fetch_array('SELECT * FROM admins WHERE user = \'' . $user . '\' AND usrtoken = \'' . $pass . '\' LIMIT 1;');
        
        return !empty($getUser[0]);
    }
    
    /**
     * User logout
     * 
     * @return boolean
     */
    public function doLogout(): bool {
        foreach ($_COOKIE as $k => $v) {
            setcookie($k, null, -1, "/");
        }
        
        return true;
    }

    /**
     * User login
     * @param  string $user [Username]
     * @param  string $pass [Password]
     * @return mixed
     */
    public function doLogin(string $user, string $pass) {
        $getUser = $this->sql->fetch_array('SELECT pass FROM admins WHERE user = \'' . $user . '\' LIMIT 1;');
     
        if (empty($getUser[0])) {
            return false;
        } else if (Security::encrypt($pass) === $getUser[0]['pass']) {
            $token = Security::random(85);
            $time  = strtotime('+3 months');
            
            setcookie("user", $user, $time, "/");
            setcookie("pass", $token, $time, "/");
            
            $this->sql->update('admins', ['usrtoken' => $token], ['user' => $user]);
            
            return (object) $getUser[0];
        }
        
        return false;
    }
    
    /**
     * Get total of fields based in ID
     * 
     * @param  string $field [Table name]
     * @return integer
     */
    public function getTotal(string $field): int {
        $total = $this->sql->fetch_array('SELECT id FROM ' . $field . ';');
        return count($total);
    }
    
    /**
     * Get configuration by name
     * 
     * @param  string $field [Field name]
     * @return string
     */
    public function getConfig(string $field): string {
        return $this->sql->fetch_array('SELECT ' . $field . ' FROM config WHERE id = \'' . $this->site . '\';')[0][$field];
    }
    
    /**
     * Update configuration
     * 
     * @param array $toUpdate [Array of values to be updated]
     * @return void
     */
    public function setConfig(array $toUpdate) {
        return $this->sql->update('config', $toUpdate, ['id' => $this->site]);
    }
    
}
