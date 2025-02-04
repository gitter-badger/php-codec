<?php

declare(strict_types=1);

namespace Facile\PhpCodec\Internal\Primitives;

use Facile\PhpCodec\Decoder;
use function Facile\PhpCodec\Internal\standardDecode;
use Facile\PhpCodec\Internal\Undefined;
use Facile\PhpCodec\Validation\Context;
use Facile\PhpCodec\Validation\Validation;

/**
 * @template U
 * @implements Decoder<mixed, U>
 */
class UndefinedDecoder implements Decoder
{
    /** @var U */
    private $default;

    /**
     * @param U $default
     */
    public function __construct($default)
    {
        $this->default = $default;
    }

    public function validate($i, Context $context): Validation
    {
        return $i instanceof Undefined
            ? Validation::success($this->default)
            : Validation::failure($i, $context);
    }

    public function decode($i): Validation
    {
        return standardDecode($this, $i);
    }

    public function getName(): string
    {
        return 'undefined';
    }
}
