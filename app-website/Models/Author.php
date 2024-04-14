<?php

namespace App\Models;

class Author extends Base {

    protected $tableName = APP_TABLE_PREFIX . 'author';

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