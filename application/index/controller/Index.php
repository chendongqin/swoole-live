<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return 1234565;
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
