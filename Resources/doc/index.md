# Getting Started With FrameworkErrorBundle

## Installation

Add FrameworkErrorBundle as a requirement in your composer.json:

```
{
    "require": {
        "sumocoders/framework-error-bundle": "dev-master"
    }
}
```

**Warning**
> Replace `dev-master` with a sane thing

Run `composer update`:

Enable the bundle in the kernel, just add it in production mode, as this bundle
is intended to handle errors so our visitors don't freak out

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    // ...
    if (in_array($this->getEnvironment(), array('prod'))) {
        $bundles[] = new SumoCoders\FrameworkErrorBundle\SumoCodersFrameworkErrorBundle();
    }
}
```
