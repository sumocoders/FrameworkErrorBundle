<?php

namespace SumoCoders\FrameworkErrorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class SumoCodersFrameworkErrorExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $showMessagesFor = array();

        if (isset($mergedConfig['show_messages_for'])) {
            $showMessagesFor = array_unique($mergedConfig['show_messages_for']);
        }

        // store the configuration in the messages
        $container->setParameter(
            'sumo_coders_framework_error.show_messages_for',
            $showMessagesFor
        );
    }
}
