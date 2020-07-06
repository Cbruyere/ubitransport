<?php

declare(strict_types=1);

namespace App\Tests\unit;

use App\Entity\Student;
use DateTime;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    private Student $student;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = new Student();
    }

    public function testIsValidClass(): void {
        self::assertInstanceOf(Student::class, $this->student);
    }

    public function testGetFirstName():void {
        $testValue = "Doe";
        $this->student->setFirstname($testValue);

        self::assertEquals($testValue, $this->student->getFirstname());
    }

    public function testGetLastName():void {
        $testValue = "John";
        $this->student->setLastname($testValue);

        self::assertEquals($testValue, $this->student->getLastname());
    }

    public function testGeBirthday():void {
        $testValue = new DateTime("13-09-1974");
        $this->student->setBirthday($testValue);

        self::assertEquals($testValue, $this->student->getBirthday());
    }
}
