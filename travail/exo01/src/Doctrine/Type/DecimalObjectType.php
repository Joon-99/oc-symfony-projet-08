<?php

namespace App\Doctrine\Type;

use Decimal\Decimal;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

class DecimalObjectType extends Type
{
    public const NAME = 'decimal_object';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getDecimalTypeDeclarationSQL($column);
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value === null) {
            return null;
        }

        if (!($value instanceof Decimal)) {
            throw new ConversionException(sprintf(
                'Expected instance of %s or null, got %s',
                Decimal::class,
                is_object($value) ? get_class($value) : gettype($value)
            ));
        }

        return $value->toString();
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): mixed
    {
        if ($value === null || $value instanceof Decimal) {
            return $value;
        }

        try {
            return new Decimal((string) $value);
        } catch (\Throwable $e) {
            throw new ConversionException(sprintf(
                'Could not convert database value "%s" to %s',
                (string) $value,
                $this->getName()
            ));
        }
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
