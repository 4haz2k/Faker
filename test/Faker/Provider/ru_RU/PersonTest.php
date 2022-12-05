<?php

namespace Faker\Test\Provider\ru_RU;

use Faker\Provider\ru_RU\Person;
use Faker\Test\TestCase;

/**
 * @group legacy
 */
final class PersonTest extends TestCase
{
    public function testLastNameFemale()
    {
        self::assertEquals('а', substr($this->faker->lastName('female'), -2, 2));
    }

    public function testLastNameMale()
    {
        self::assertNotEquals('а', substr($this->faker->lastName('male'), -2, 2));
    }

    public function testLastNameRandom()
    {
        self::assertNotNull($this->faker->lastName());
    }

    protected function getProviders(): iterable
    {
        yield new Person($this->faker);
    }

    public function testSnils()
    {
        $number = $this->faker->snils();
        $isSnils = true;
        $pattern = "|^\d{11}$|";

        if(!preg_match($pattern, $number))
            $isSnils = false;

        $control = substr($number, -2);
        $number = substr($number, 0, 9);

        if($number < "001001998")
            $isSnils = false;

        if($isSnils)
        {
            $result = 0;
            $total = strlen($number);

            for($i = 0; $i < $total; $i++)
                $result += ($total - $i) * $number[$i];

            if($result == 100 || $result == 101)
                $result = "00";

            if($result > 101)
                $result %= 101;

            if($result != $control)
                $isSnils = false;
        }

        self::assertEquals(true, $isSnils);
    }

    public function testPassportSeries()
    {
        self::assertNotNull($this->faker->passportSeries());
    }

    public function testPassportNumber()
    {
        self::assertNotNull($this->faker->passportNumber());
    }
}
