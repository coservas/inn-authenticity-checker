<?php

declare(strict_types=1);

namespace App\Tests\Action;

use App\Action\CheckAuthenticityAction;
use PHPUnit\Framework\TestCase;

class CheckAuthenticityActionTest extends TestCase
{
    public function testHandle(): void
    {
        $json = (new CheckAuthenticityAction())->handle();
        $actual = json_decode($json, true);
        $isSetMessageKey = isset($actual['message']);
        $this->assertTrue($isSetMessageKey);
    }
}
