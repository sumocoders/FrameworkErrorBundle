<?php

namespace SumoCoders\FrameworkErrorBundle\Listener;

use Eo\AirbrakeBundle\Bridge\Client;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;

/**
 * Catches console exceptions and sends them to errbit
 */
class ConsoleExceptionListener
{
    /**
     * @var Airbrake\Client
     */
    protected $client;

    /**
     * Class constructor
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function onConsoleException(ConsoleExceptionEvent $event)
    {
        $exception = $event->getException();
        $this->client->notifyOnException($exception);
        error_log($exception->getMessage().' in: '.$exception->getFile().':'.$exception->getLine());
    }
}
