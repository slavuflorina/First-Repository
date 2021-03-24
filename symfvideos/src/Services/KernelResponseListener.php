<?php
namespace App\Services;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpFoundation\Response;

class KernelResponseListener {

    public function onKernelResponse( ControllerEvent $event)
    {
        $response = new Response('dupa');
        $event->setResponse($response);
    }
}
