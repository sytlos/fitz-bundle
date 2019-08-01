FitzBundle
=

Browse and install all the bundles you need in your [Symfony](https://symfony.com) application
in a few seconds.

Installation
=
Open a terminal and type
```bash
$ composer require --dev hugosoltys/fitz-bundle
```

Enabling the bundle
= 
Add the following line in your `bundles.php` file

```php
<?php

return [
    // ...
    HugoSoltys\FitzBundle\FitzBundle::class => ['dev' => true],
];
```

Configuration
=
Allow the automation of Composer packages configuration via Symfony Flex with the following command.
```bash
composer config extra.symfony.allow-contrib true
```

Import the bundle routing
```yaml
# config/routes/dev/fitz.yaml
fitz:
  resource: "@FitzBundle/Resources/config/routing.xml"
```

Configuring the bundle
```yaml
# config/packages/dev/fitz.yaml
fitz:
  composer_path: '/path/to/composer'
  queue_file_path: '%kernel.project_dir%/vendor/hugosoltys/fitz-bundle'
```

Usage
=
Go to this page `http://localhost/fitz/install`

- Choose the bundles you want to install then press the `Install` button.
- Open a terminal and run the following command `bin/console fitz:install`

Contributing
= 
If you want to add a bundle to the catalog, feel free to submit a [pull request](https://github.com/hugosoltys/fitz-bundle/pulls).  