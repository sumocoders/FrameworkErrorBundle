<?php

namespace SumoCoders\FrameworkErrorBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

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

        if (
            $container->hasParameter('errbit_api_key')
            && $container->getParameter('errbit_api_key') !== null
            && $container->getParameter('errbit_api_key') !== ''
        ) {
            $definition = new Definition(
                'SumoCoders\FrameworkErrorBundle\Listener\ConsoleExceptionListener',
                array(new Reference('eo_airbrake.client'))
            );
            $definition->addTag(
                'kernel.event_listener',
                array(
                    'event' => 'console.exception',
                    'method' => 'onConsoleException',
                )
            );
            $container->setDefinition(
                'sumocoders_console_error_handler',
                $definition
            );
        }
    }
}
