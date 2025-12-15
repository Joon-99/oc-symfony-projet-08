<?php

namespace App\Form\DataTransformer;

use Decimal\Decimal;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

final class DecimalToStringTransformer implements DataTransformerInterface
{
    /**
     * Transforms a Decimal object to a string for the form.
     *
     * @param Decimal|null $value
     * @return string|null
     */
    public function transform(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof Decimal) {
            return (string) $value;
        }

        return (string) $value;
    }

    /**
     * Transforms a form value to a Decimal object.
     *
     * @param string|float|int|null $value
     * @return Decimal|null
     */
    public function reverseTransform(mixed $value): ?Decimal
    {
        if ($value === null || $value === '') {
            return null;
        }

        try {
            return new Decimal((string) $value);
        } catch (\Throwable $e) {
            throw new TransformationFailedException('Invalid decimal value.');
        }
    }
}
