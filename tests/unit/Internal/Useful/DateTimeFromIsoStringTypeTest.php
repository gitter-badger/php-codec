<?php declare(strict_types=1);

namespace Tests\Facile\Codec\Internal\Useful;

use Eris\Generator as g;
use Eris\TestTrait;
use Facile\Codec\Internal\Useful\DateTimeFromIsoStringType;
use Tests\Facile\Codec\BaseTestCase;

class DateTimeFromIsoStringTypeTest extends BaseTestCase
{
    use TestTrait;

    public function test(): void {
        $codec = new DateTimeFromIsoStringType();
        self::asserSuccessInstanceOf(
            \DateTimeInterface::class,
            $codec->decode('2021-03-12T06:22:48+01:00')
        );

        $this
            ->forAll(
                g\date()
            )
            ->then(function (\DateTimeInterface $date) use ($codec) {
                self::asserSuccessInstanceOf(
                    \DateTimeInterface::class,
                    $codec->decode($date->format(DATE_ATOM))
                );
            });
    }
}
