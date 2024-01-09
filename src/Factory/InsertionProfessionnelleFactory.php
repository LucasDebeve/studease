<?php

namespace App\Factory;

use App\Entity\InsertionProfessionnelle;
use App\Repository\InsertionProfessionnelleRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<InsertionProfessionnelle>
 *
 * @method        InsertionProfessionnelle|Proxy                     create(array|callable $attributes = [])
 * @method static InsertionProfessionnelle|Proxy                     createOne(array $attributes = [])
 * @method static InsertionProfessionnelle|Proxy                     find(object|array|mixed $criteria)
 * @method static InsertionProfessionnelle|Proxy                     findOrCreate(array $attributes)
 * @method static InsertionProfessionnelle|Proxy                     first(string $sortedField = 'id')
 * @method static InsertionProfessionnelle|Proxy                     last(string $sortedField = 'id')
 * @method static InsertionProfessionnelle|Proxy                     random(array $attributes = [])
 * @method static InsertionProfessionnelle|Proxy                     randomOrCreate(array $attributes = [])
 * @method static InsertionProfessionnelleRepository|RepositoryProxy repository()
 * @method static InsertionProfessionnelle[]|Proxy[]                 all()
 * @method static InsertionProfessionnelle[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static InsertionProfessionnelle[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static InsertionProfessionnelle[]|Proxy[]                 findBy(array $attributes)
 * @method static InsertionProfessionnelle[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static InsertionProfessionnelle[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class InsertionProfessionnelleFactory extends ModelFactory
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
            'localisation' => LocalisationFactory::random(),
            'dateDeb' => self::faker()->dateTime(),
            'descInsPro' => self::faker()->text(),
            'duree' => self::faker()->randomNumber(),
            'titre' => self::faker()->text(5000),
            'typePro' => self::faker()->numberBetween(1, 2),
            'revenus' => self::faker()->numberBetween(0, 63),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(InsertionProfessionnelle $insertionProfessionnelle): void {})
        ;
    }

    protected static function getClass(): string
    {
        return InsertionProfessionnelle::class;
    }
}
