FitzBundle
=

Browse and install all the bundles you need in your Symfony application
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
```

Usage
=
Go to this page `http://localhost/fitz/install`

- Choose the bundles you want to install then press the `Install` button.
- Open a terminal and run the following command `bin/console fitz:install`

Contributing
= 
If you want to add a bundle to the catalog, please open [an issue](https://github.com/hugosoltys/fitz-bundle/issues).  