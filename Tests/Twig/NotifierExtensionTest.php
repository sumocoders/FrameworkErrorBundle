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
            $this->getTemplating(),
            'host',
            'api_key'
        );
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getTemplating()
    {
        $templating = $this->getMock('\Twig_Environment');
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
        $this->assertInstanceOf(
            '\Twig_SimpleFunction',
            $var[0]
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
