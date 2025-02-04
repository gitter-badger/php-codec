<?php

declare(strict_types=1);

namespace Tests\Facile\PhpCodec\Internal\Primitives;

use Eris\TestTrait;
use Facile\PhpCodec\Codecs;
use Facile\PhpCodec\Internal\Undefined;
use Tests\Facile\PhpCodec\BaseTestCase;
use Tests\Facile\PhpCodec\GeneratorUtils;

class UndefinedDecoderTest extends BaseTestCase
{
    use TestTrait;

    public function testDefault(): void
    {
        $this
            ->forAll(GeneratorUtils::scalar())
            ->then(function ($default): void {
                self::asserSuccessAnd(
                    Codecs::undefined($default)->decode(new Undefined()),
                    function ($x) use ($default): void {
                        self::assertSame($default, $x);
                    }
                );
            });
    }
}
