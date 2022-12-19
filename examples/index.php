<?php
//include '../spl_autoload_register.php';

// $obj = BCNL\extra\KeyGenerator::getInstance();

// $string = $obj->makeString();

// var_dump($string);
include './Controller.php';
include './PermissionAttribute.php';


$arrResult = permissionListBy("./api/User.php", 'User');

//$arrResult2 = permissionListBy("./back/User.php", 'User');

//var_dump($arrResult2);
var_dump($arrResult);

function permissionListBy(string $filename = '', string $objectClass = '')
{
    include_once $filename;
    $reflector = new \ReflectionClass($objectClass);
    $methods  = $reflector->getMethods(ReflectionMethod::IS_PUBLIC);
    $arrResult = [];
    if (count($methods) <= 0) {
        return $arrResult;
    }
    foreach ($methods as $method) {
        $methodNameReflecting = $method->getName();
        $attributes = $method->getAttributes(PermissionAttribute::class);
        if (count($attributes) > 0) {
            $item['object'] = $objectClass;
            $item['method'] = $methodNameReflecting;
            $attribute = end($attributes);
            $item['title'] = $attribute->newInstance()->title;
            $item['description'] = $attribute->newInstance()->description;
            $arrResult[] = $item;
        }
    }
    return $arrResult;
}
