<?php

namespace SumoCoders\FrameworkErrorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Exception\FlattenException;
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
        /** @var Translator $translator */
        $translator = $this->get('translator');
        $message = $translator->trans('error.messages.generic');

        // check if the error is whitelisted to overrule the message
        if (in_array(
            $exception->getClass(),
            $this->container->getParameter('sumo_coders_framework_error.show_messages_for')
        )) {
            $message = $exception->getMessage();
        }

        // translate page not found messages
        if ('Symfony\Component\HttpKernel\Exception\NotFoundHttpException' == $exception->getClass()) {
            $message = $translator->trans('error.messages.noRouteFound');
        }

        return $this->render(
            '::error.html.twig',
            array(
                'status_code' => $exception->getStatusCode(),
                'status_text' => $message,
            )
        );
    }
}
