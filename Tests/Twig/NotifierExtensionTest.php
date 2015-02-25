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
