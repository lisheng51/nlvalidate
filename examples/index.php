<?php

include '../spl_autoload_register.php';

$obj = new BCNL\extra\KeyGenerator();

$string = $obj->makeString();

var_dump($string);

