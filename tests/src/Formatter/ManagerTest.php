<?php

namespace ByTIC\Money\Tests\Formatter;

use ByTIC\Money\Formatter\Manager;
use ByTIC\Money\Tests\AbstractTest;
use Mockery\Mock;

/**
 * Class ManagerTest
 * @package ByTIC\Money\Tests\Formatter
 */
class ManagerTest extends AbstractTest
{
    public function test_get_is_singleton()
    {
        /** @var Manager|Mock $manager */
        $manager = \Mockery::mock(Manager::class)->shouldAllowMockingProtectedMethods()->makePartial();
        $manager->shouldReceive('resolve')->with('html')->once()->andReturn('html');

        $formatter1 = $manager->get('html');
        self::assertSame('html', $formatter1);

        $formatter2 = $manager->get('html');
        self::assertSame($formatter1, $formatter2);
    }
}