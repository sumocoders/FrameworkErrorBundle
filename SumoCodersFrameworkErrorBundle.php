<?php

namespace SumoCoders\FrameworkErrorBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SumoCodersFrameworkErrorBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'TwigBundle';
    }
}
