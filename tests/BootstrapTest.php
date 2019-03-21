<?php

declare(strict_types=1);

namespace Horat1us\Yii\Chain\Tests;

use PHPUnit\Framework\TestCase;
use Horat1us\Yii\Chain;
use yii\base;

/**
 * Class BootstrapTest
 * @package Horat1us\Yii\Chain\Tests
 */
class BootstrapTest extends TestCase
{
    /** @var base\Application */
    protected $app;

    protected function setUp(): void
    {
        parent::setUp();

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->app = $this->getMockBuilder(base\Application::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
    }

    public function testInvalidChain(): void
    {
        $bootstrap = new Chain\Bootstrap([
            'chain' => [new \stdClass,],
        ]);

        $this->expectException(base\InvalidConfigException::class);
        $this->expectExceptionMessage('Invalid data type: stdClass. yii\base\BootstrapInterface is expected');

        $bootstrap->bootstrap($this->app);
    }

    public function testBootstrap(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $element = $this->getMockBuilder(base\BootstrapInterface::class)
            ->getMockForAbstractClass();

        $element
            ->expects($this->exactly(2))
            ->method('bootstrap')
            ->with($this->app);

        $bootstrap = new Chain\Bootstrap([
            'chain' => [
                $element,
                $element,
            ]
        ]);

        $bootstrap->bootstrap($this->app);
    }
}
