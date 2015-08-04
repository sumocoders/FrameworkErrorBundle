# Getting Started With FrameworkErrorBundle

The FrameworkErrorBundle will show a nicely styled error-page when an exception
occurs and send the real exception to Errbit.

## Installation

    composer require sumocoders/framework-error-bundle

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

## Show specific messages

By default a generic message will be shown. But if you want you can change this
 for some specific exceptions by white-listing them.

```yaml
# Allow some exceptions to expose their message
sumo_coders_framework_error:
  show_messages_for:
    - Your\Own\Exception
```

Once this is configured the message will be grabbed through `getMessage()` on 
your exception.
