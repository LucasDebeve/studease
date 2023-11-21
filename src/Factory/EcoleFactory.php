<?php

namespace App\Factory;

use App\Entity\Ecole;
use App\Repository\EcoleRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Ecole>
 *
 * @method        Ecole|Proxy                     create(array|callable $attributes = [])
 * @method static Ecole|Proxy                     createOne(array $attributes = [])
 * @method static Ecole|Proxy                     find(object|array|mixed $criteria)
 * @method static Ecole|Proxy                     findOrCreate(array $attributes)
 * @method static Ecole|Proxy                     first(string $sortedField = 'id')
 * @method static Ecole|Proxy                     last(string $sortedField = 'id')
 * @method static Ecole|Proxy                     random(array $attributes = [])
 * @method static Ecole|Proxy                     randomOrCreate(array $attributes = [])
 * @method static EcoleRepository|RepositoryProxy repository()
 * @method static Ecole[]|Proxy[]                 all()
 * @method static Ecole[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Ecole[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Ecole[]|Proxy[]                 findBy(array $attributes)
 * @method static Ecole[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Ecole[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class EcoleFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'cp' => self::faker()->text(5),
            'pays' => self::faker()->text(250),
            'ville' => self::faker()->text(250),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Ecole $ecole): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Ecole::class;
    }
}
