<?php

declare(strict_types=1);

namespace Facile\PhpCodec\Validation;

/**
 * @template A
 * @extends Validation<A>
 */
class ValidationSuccess extends Validation
{
    /** @var A */
    private $value;

    /**
     * @param A $a
     */
    public function __construct($a)
    {
        $this->value = $a;
    }

    /**
     * @return A
     */
    public function getValue()
    {
        return $this->value;
    }
}
