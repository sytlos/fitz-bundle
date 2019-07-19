Fitz Bundle
=

Browse and install all the bundles you need in your Symfony application
in a few seconds.

Installation
=
Open a terminal and type
```bash
$ composer require --dev hugosoltys/fitz-bundle
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

- Choose the bundles you want to install then press the button.
- Open a terminal and run the following command `bin/console fitz:install`  