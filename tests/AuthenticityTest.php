<?php

declare(strict_types=1);

namespace App\Tests;

use App\Authenticity;
use PHPUnit\Framework\TestCase;

class TranslatorTest extends TestCase
{
    /** @var Authenticity */
    private $authenticity;

    protected function setUp(): void
    {
        $this->authenticity = $this->createAuthenticityAndGet();
    }

    public function testGetAuthenticityInn(): void
    {
        $actual = $this->authenticity->get(Authenticity::AUTHENTICITY_INNS[0]);
        $this->assertTrue($actual['authenticity']);
    }

    public function testGetNonAuthenticityInn(): void
    {
        $actual = $this->authenticity->get(Authenticity::NON_AUTHENTICITY_INNS[0]);
        $this->assertFalse($actual['authenticity']);
    }

    public function testGetNonExistsInn(): void
    {
        $actual = $this->authenticity->get('123456789');
        $this->assertFalse($actual['authenticity']);
    }

    private function createAuthenticityAndGet(): Authenticity
    {
        return new Authenticity();
    }
}
