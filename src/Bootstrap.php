<?php declare(strict_types=1);

namespace Horat1us\Yii\Chain;

use yii\base;
use yii\di;

class Bootstrap extends base\BaseObject implements base\BootstrapInterface
{
    /** @var array<int, string|array|base\BootstrapInterface> references */
    public array $chain = [];

    public function bootstrap($app): void
    {
        foreach ($this->chain as &$element) {
            /** @var base\BootstrapInterface $element */
            $element = di\Instance::ensure($element, base\BootstrapInterface::class);
            $element->bootstrap($app);
        }
    }
}
