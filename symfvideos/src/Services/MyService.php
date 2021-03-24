<?php

namespace App\Services;
use App\Services\MySecondService;
use Doctrine\ORM\Event\PostFlushEventArgs;

class MyService implements ServiceInterface {
    #fara implements ServiceInterface
    public $logger;
    public $my;

    #use OptionalServiceTrait;
    public function __construct()
    {
        #dump($service);
        dump('Hello');
        #$this->secService = $service;
        // Parametri: $param, $admin_email, $global_parameter, MySecondService $second_service
       # dump($param);
        //dump($admin_email);
        //dump($global_parameter);
        //dump($second_service);
    }
    public function postFlush(PostFlushEventArgs $args)
    {
        dump('hello postflush!');
        dump($args);
    }

    public function clear()
    {
        dump('clear ... ');
    }
    public function someAction()
    {
        dump($this->logger);
        dump($this->my);
        // Parametri: $param, $admin_email, $global_parameter, MySecondService $second_service
        // dump($param);
        //dump($admin_email);
        //dump($global_parameter);
        //dump($second_service);
    }
    /**
     * @required
     */
   /* public function setSecondService(MySecondService $second_service)
    {
        dump($second_service);
    } */

}