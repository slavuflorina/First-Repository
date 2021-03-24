<?php

namespace App\Services;

class MySecondService implements ServiceInterface{
    #fara implements ServiceInterface
    public function __construct()
    {
        dump('My Second Service');
       // $this->doSomething2();
    }

    public function doSomething()
    {
        dump('Do Something');
    }
    public function doSomething2()
    {
        dump('Do Something 2');
    }
    public function someMethod()
    {
        return 'Lazy Service';
    }
}