<?php
include '../spl_autoload_register.php';

$obj = BCNL\extra\KeyGenerator::getInstance();

$string = $obj->makeString();

var_dump($string);
