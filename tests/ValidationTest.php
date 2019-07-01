<?php

declare(strict_types=1);
include '../spl_autoload_register.php';

use PHPUnit\Framework\TestCase;
use BCNL\Validation;
use BCNL\Algorithm;

class ValidationTest extends TestCase {

    public function testBtw() {
        $obj = new Validation();
        $value = "237689418";
        $result = $obj->btw($value);
        $this->assertIsBool($result);
    }

    public function testFibonacci() {
        $obj = new Algorithm();
        $n = 50;
        $result = $obj->fibonacci($n);
        $this->assertIsArray($result);
    }

    public function testDistance() {
        $obj = new Algorithm();
        $n = 50;
        $result = $obj->distance($n, 60);
        $this->assertIsFloat($result);
    }

}
