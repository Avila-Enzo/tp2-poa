<?php

namespace App\Models;

class Borrow extends Base {

    protected $tableName = APP_TABLE_PREFIX . 'borrows';

    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

?>