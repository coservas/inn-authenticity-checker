<?php

declare(strict_types=1);

namespace App\Tests\Action;

use App\Action\MainAction;
use PHPUnit\Framework\TestCase;

class MainActionTest extends TestCase
{
    public function testHandle(): void
    {
        $actual = (new MainAction())->handle();
        $this->assertStringContainsString('form', $actual);
    }
}
