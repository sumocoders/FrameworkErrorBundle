<?php

namespace SumoCoders\FrameworkErrorBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Templating;

/**
 * NotifierExtension
 */
class NotifierExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * Class constructor
     *
     * @param ContainerInterface $container
     * @param string             $host
     * @param string             $apiKey
     */
    public function __construct($container, $host, $apiKey)
    {
        $this->setContainer($container);
        $this->setHost($host);
        $this->setApiKey($apiKey);
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'errbit_notifier' => new \Twig_Function_Method(
                $this,
                'getErrbitNotifier',
                array(
                    'is_safe' => array('html'),
                )
            )
        );
    }

    /**
     * Returns the HTML that will be inserted by rendering the template
     *
     * @return string
     */
    public function getErrbitNotifier()
    {
        return $this->getContainer()->get('templating')->render(
            'SumoCodersFrameworkErrorBundle:Extension:notifier.html.twig',
            array(
                'host' => $this->getHost(),
                'api_key' => $this->getApiKey()
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'errbit_notifier_extension';
    }
}
