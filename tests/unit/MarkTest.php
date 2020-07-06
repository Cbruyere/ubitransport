<?php

declare(strict_types=1);

namespace App\Tests\unit;

use App\Entity\Mark;
use DateTime;
use PHPUnit\Framework\TestCase;

class MarkTest extends TestCase
{
    private Mark $mark;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mark = new Mark();
    }

    public function testIsValidClass(): void {
        self::assertInstanceOf(Mark::class, $this->mark);
    }

    public function testGetSubject():void {
        $testValue = "Math";
        $this->mark->setSubject($testValue);

        self::assertEquals($testValue, $this->mark->getSubject());
    }

    public function testGetValue():void {
        $testValue = 10.1;
        $this->mark->setValue($testValue);

        self::assertEquals($testValue, $this->mark->getValue());
    }
}
