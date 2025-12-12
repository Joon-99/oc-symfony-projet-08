<?php

namespace App\Factory;

use App\Entity\Voiture;
use App\Enum\MotorEnum;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;
use Decimal\Decimal;

/**
 * @extends PersistentObjectFactory<Voiture>
 */
final class VoitureFactory extends PersistentObjectFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
    }

    #[\Override]
    public static function class(): string
    {
        return Voiture::class;
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'dailyPrice' => new Decimal(number_format(self::faker()->randomFloat(2, 10, 200), 2, '.', '')),
            'monthlyPrice' => new Decimal(number_format(self::faker()->randomFloat(2, 200, 9000), 2, '.', '')),
            'description' => self::faker()->paragraph(),
            'motor' => self::faker()->randomElement(MotorEnum::cases()),
            'name' => self::faker()->randomElement([
                'Renault Clio', 'Peugeot 208', 'Toyota Corolla', 'Volkswagen Golf',
                'Ford Focus', 'Opel Corsa', 'BMW 3 Series', 'Audi A4', 'Mercedes C-Class',
                'Seat Ibiza', 'Skoda Octavia', 'Hyundai i30', 'Kia Ceed', 'Nissan Qashqai',
                'Mazda CX-5', 'Honda Civic', 'Suzuki Swift', 'Mini Cooper', 'Lexus UX', 'Volvo XC40'
            ]),
            'places' => self::faker()->numberBetween(2, 9),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    #[\Override]
    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Voiture $voiture): void {})
        ;
    }
}
