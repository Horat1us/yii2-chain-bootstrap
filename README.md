# Yii2 Chaining Bootstrap
[![Build Status](https://travis-ci.org/Horat1us/yii2-chain-bootstrap.svg?branch=master)](https://travis-ci.org/Horat1us/yii2-chain-bootstrap)
[![codecov](https://codecov.io/gh/Horat1us/yii2-chain-bootstrap/branch/master/graph/badge.svg)](https://codecov.io/gh/Horat1us/yii2-chain-bootstrap)

This package provides yii2 bootstrap interface implementation that allows chaining few bootstraps
into one. It may be useful when package includes few bootstraps.  

Previously it was included into horat1us/yii2-base package as 
[BootstrapGroup](https://github.com/Horat1us/yii2-base/blob/1.16.0/src/BootstrapGroup.php).

## Installation
Using [packagist.org](https://packagist.org/packages/horat1us/yii2-chain-bootstrap):
```bash
composer require horat1us/yii2-chain-bootstrap:^1.0
```

## Usage

### Implement DI Bootstrap in your package
```php
<?php

namespace Package;

use Horat1us\Yii\DI;

class Bootstrap extends DI\Bootstrap
{
    public function getDefinitions() : array{
        return [
            Package\ConfigInterface::class => Package\Config::class,
        ];
    }
}
```

### Append package Bootstrap to your application configuration
```php
<?php
// config.php

use Package;

return [
    'bootstrap' => [
        'package' => [
            'class' => Package\Bootstrap::class,
            'definitions' => [
                // here you can reconfigure config interface
                // note: another class names can not be configured here
            ],
        ],
    ],
    // ... another application configuration
];
```

## License
[MIT](./LICENSE)
