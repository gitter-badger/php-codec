<?php

declare(strict_types=1);

namespace TypeAssertions\Facile\PhpCodec;

use Facile\PhpCodec\Internal\Arrays\MapRefiner;
use Facile\PhpCodec\Internal\Combinators\LiteralRefiner;
use Facile\PhpCodec\Internal\Primitives\InstanceOfRefiner;

class RefineTypeAssertions extends TypeAssertion
{
    public function assertInstanceOf(): void
    {
        $refiner = new InstanceOfRefiner(\DateTimeInterface::class);

        $assert = function (\DateTimeInterface $_): void {
        };

        /** @var mixed $x */
        $x = self::mixed();
        if ($refiner->is($x)) {
            $assert($x);
        }
    }

    public function testRefineAssociativeArray(): void
    {
        $refiner = new MapRefiner();

        /**
         * @psalm-suppress UnusedParam
         *
         * @var callable(array<array-key,mixed>):void
         */
        $assert = static function (array $x): void {
        };

        /** @var mixed $x */
        $x = self::mixed();
        if ($refiner->is($x)) {
            $assert($x);
        }
    }

    public function testRefineLiterals(): void
    {
        /** @var mixed $x */
        $x = self::mixed();

        if ((new LiteralRefiner('a'))->is($x)) {
            self::assertString($x);
        }

        if ((new LiteralRefiner(true))->is($x)) {
            self::assertBool($x);
            self::assertTrue($x);
        }

        if ((new LiteralRefiner(false))->is($x)) {
            self::assertFalse($x);
            self::assertTrue($x); // Why?
            self::assertBool($x);
        }

        if ((new LiteralRefiner(123))->is($x)) {
            self::assertInt($x);
        }
    }
}
