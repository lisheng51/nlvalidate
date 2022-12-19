<?php

class User extends Controller
{

    #[PermissionAttribute('dfdfdfdf world', 'dfdfdfdf')]
    public function edit()
    {
        return "dfdfdf";
    }

    #[PermissionAttribute('rld', 42)]
    public function index()
    {
        return "dfdfdf";
    }
}
