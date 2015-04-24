<?php

namespace SumoCoders\FrameworkErrorBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

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
    public function __construct(ContainerInterface $container, $host, $apiKey)
    {
        $this->container = $container;
        $this->host = $host;
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
        return $this->container->get('templating')->render(
            'SumoCodersFrameworkErrorBundle:Extension:notifier.html.twig',
            array(
                'host' => $this->host,
                'api_key' => $this->apiKey,
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
