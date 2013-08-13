<?php

class MySQLManager {

    private static $instance;

    public function __construct() {
        if (!self::$instance) {
            self::$instance = $this;
            echo "New Instance\n";
            return self::$instance;
        } else {
            echo "Old Instance\n";
            return self::$instance;
        }
    }

    //keep other methods same
}

$a = new MySQLManager();
$b = new MySQLManager();
$c = new MySQLManager();
$d = new MySQLManager();
$e = new MySQLManager();