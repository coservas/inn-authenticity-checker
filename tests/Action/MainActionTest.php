<?php

declare(strict_types=1);

namespace App\Tests\Action;

use App\Action\MainAction;
use PHPUnit\Framework\TestCase;

class MainActionTest extends TestCase
{
    public function testHandle(): void
    {
        ob_start();
        $actual = (new MainAction())->handle();
        ob_end_clean();
        $this->assertEquals(1, $actual);
    }
}
