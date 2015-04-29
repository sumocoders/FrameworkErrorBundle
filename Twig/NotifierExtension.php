<?php

namespace SumoCoders\FrameworkErrorBundle\Twig;

/**
 * NotifierExtension
 */
class NotifierExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    protected $twig;

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
     * @param \Twig_Environment $twig
     * @param string            $host
     * @param string            $apiKey
     */
    public function __construct(\Twig_Environment $twig, $host, $apiKey)
    {
        $this->twig = $twig;
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
        return $this->twig->render(
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
