<?php

declare(strict_types=1);

namespace Horat1us\Yii\Chain;

use yii\base;
use yii\di;

/**
 * Class Bootstrap
 * @package Horat1us\Yii\Chain
 */
class Bootstrap extends base\BaseObject implements base\BootstrapInterface
{
    /** @var string|array|base\BootstrapInterface reference */
    public $chain = [];

    public function bootstrap($app): void
    {
        foreach ($this->chain as &$element) {
            /** @var base\BootstrapInterface $element */
            $element = di\Instance::ensure($element, base\BootstrapInterface::class);
            $element->bootstrap($app);
        }
    }
}
