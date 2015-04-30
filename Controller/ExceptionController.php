<?php

namespace SumoCoders\FrameworkErrorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController extends Controller
{
    /**
     * @param Request              $request
     * @param FlattenException     $exception
     * @param DebugLoggerInterface $logger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showExceptionAction(
        Request $request,
        FlattenException $exception,
        DebugLoggerInterface $logger = null
    ) {
        $message = 'Something went wrong.';
        if ('Symfony\Component\HttpKernel\Exception\NotFoundHttpException' == $exception->getClass()) {
            $message = $exception->getMessage();
        }

        return $this->render(
            '::error.html.twig',
            array(
                'status_code' => $exception->getStatusCode(),
                'status_text' => $message
            )
        );
    }
}
