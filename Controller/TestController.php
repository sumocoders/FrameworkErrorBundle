<?php

namespace SumoCoders\FrameworkErrorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function standardExceptionAction()
    {
        throw new \Exception('This is a standard exception.');
    }
}
