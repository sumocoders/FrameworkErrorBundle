<?php

namespace SumoCoders\FrameworkErrorBundle\Tests\DependencyInjection;

use SumoCoders\FrameworkErrorBundle\DependencyInjection\Configuration;
use SumoCoders\FrameworkErrorBundle\DependencyInjection\SumoCodersFrameworkErrorExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SumoCodersFrameworkErrorExtension
     */
    protected $extension;

    /**
     * @var Configuration
     */
    protected $configuration;

    public function setUp()
    {
        $this->extension = new SumoCodersFrameworkErrorExtension();
        $this->configuration = new Configuration();
    }

    public function tearDown()
    {
        $this->configuration = null;
    }

    public function testDefaultConfig()
    {
        $container = new ContainerBuilder();
        $this->extension->load(array(), $container);

        $this->assertTrue($container->hasParameter('sumo_coders_framework_error.show_messages_for'));
        $this->assertEmpty($container->getParameter('sumo_coders_framework_error.show_messages_for'));
    }
}
