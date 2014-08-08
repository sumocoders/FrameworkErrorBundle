<?php

namespace SumoCoders\FrameworkErrorBundle\Tests;

use SumoCoders\FrameworkErrorBundle\SumoCodersFrameworkErrorBundle;

class SumoCodersFrameworkErrorBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testGetParent()
    {
        $bundle = new SumoCodersFrameworkErrorBundle();
        $this->assertEquals('TwigBundle', $bundle->getParent());
    }
}
