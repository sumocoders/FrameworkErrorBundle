<?php

namespace SumoCoders\FrameworkErrorBundle\Test\Twig\NotifierExtension;


use SumoCoders\FrameworkErrorBundle\Twig\NotifierExtension;

class NotifierExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var NotifierExtension
     */
    protected $extension;

    public function setUp()
    {
        $this->extension = new NotifierExtension(
            $this->getContainer(),
            'host',
            'api_key'
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getContainer()
    {
        $container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
        $container->method('get')
            ->will(
                $this->returnValue(
                    array(
                        'template' => $this->getTemplating(),
                    )
                )
            );

        return $container;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getTemplating()
    {
        $templating = $this->getMock('Symfony\Component\Templating\EngineInterface');
        $templating->method('render');

        return $templating;
    }

    /**
     * Test the getters/setters
     */
    public function testGettersAndSetters()
    {
        $data = array(
            'api_key' => 'this.is.my.api.key',
            'host' => 'example.org',
            'container' => $this->getContainer(),
        );

        $this->extension->setApiKey($data['api_key']);
        $this->assertEquals($data['api_key'], $this->extension->getApiKey());

        $this->extension->setHost($data['host']);
        $this->assertEquals($data['host'], $this->extension->getHost());

        $this->extension->setContainer($data['container']);
        $this->assertEquals($data['container'], $this->extension->getContainer());
    }

    /**
     * Tests NotifierExtension::getFunctions()
     */
    public function testGetFunctions()
    {
        $var = $this->extension->getFunctions();

        $this->assertInternalType('array', $var);
        $this->assertArrayHasKey('errbit_notifier', $var);
        $this->assertInstanceOf(
            '\Twig_Function_Method',
            $var['errbit_notifier']
        );
    }

    /**
     * Tests NotifierExtension::getName()
     */
    public function testGetName()
    {
        $this->assertEquals(
            'errbit_notifier_extension',
            $this->extension->getName()
        );
    }
}
