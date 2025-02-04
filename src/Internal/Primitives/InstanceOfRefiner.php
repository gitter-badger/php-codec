<?php

declare(strict_types=1);

namespace Facile\PhpCodec\Internal\Primitives;

use Facile\PhpCodec\Refiner;

/**
 * @template T of object
 * @implements Refiner<T>
 */
class InstanceOfRefiner implements Refiner
{
    /** @var class-string<T> */
    private $fqcn;

    /**
     * @param class-string<T> $fqcn
     */
    public function __construct(string $fqcn)
    {
        $this->fqcn = $fqcn;
    }

    /**
     * @param mixed $u
     * @psalm-assert-if-true T $u
     */
    public function is($u): bool
    {
        return \is_a($u, $this->fqcn);
    }
}
