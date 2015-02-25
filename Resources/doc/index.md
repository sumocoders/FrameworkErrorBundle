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

Enable the bundle in the kernel.

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    // ...
    $bundles = array(
        // ...
        new Eo\AirbrakeBundle\EoAirbrakeBundle(),
        new SumoCoders\FrameworkErrorBundle\SumoCodersFrameworkErrorBundle(),
    );
}
```

Add the custom exception controller into `app/config/config_prod.yml`

```yaml
# Set our own exception controller so we can show nice pages
twig:
    exception_controller: SumoCodersFrameworkErrorBundle:Exception:showException
```
Fill in the `errbit_api_key` in your `parameters.yml`.
