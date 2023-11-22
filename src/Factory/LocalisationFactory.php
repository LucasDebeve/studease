<?php

namespace App\Factory;

use App\Entity\Localisation;
use App\Repository\LocalisationRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Localisation>
 *
 * @method        Localisation|Proxy                     create(array|callable $attributes = [])
 * @method static Localisation|Proxy                     createOne(array $attributes = [])
 * @method static Localisation|Proxy                     find(object|array|mixed $criteria)
 * @method static Localisation|Proxy                     findOrCreate(array $attributes)
 * @method static Localisation|Proxy                     first(string $sortedField = 'id')
 * @method static Localisation|Proxy                     last(string $sortedField = 'id')
 * @method static Localisation|Proxy                     random(array $attributes = [])
 * @method static Localisation|Proxy                     randomOrCreate(array $attributes = [])
 * @method static LocalisationRepository|RepositoryProxy repository()
 * @method static Localisation[]|Proxy[]                 all()
 * @method static Localisation[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Localisation[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Localisation[]|Proxy[]                 findBy(array $attributes)
 * @method static Localisation[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Localisation[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class LocalisationFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     */
    protected function getDefaults(): array
    {
        return [
            'adresse' => self::faker()->streetAddress(),
            'code_postal' => self::faker()->numerify('######'),
            'entreprise' => UserFactory::new([
                'email' => self::faker()->unique()->numerify('company-###').'@'.self::faker()->safeEmailDomain(),
                'firstname' => null,
                'name' => self::faker()->company(),
                'numEtud' => null,
                'numSiret' => self::faker()->unique()->numerify('##############'),
                'descriptionEntreprise' => self::faker()->text(),
                'roles' => ['ROLE_COMPANY'],
                'tpUser' => 2,
                'ecole' => null,
                'formation' => null,
            ]),
            'latitude' => self::faker()->latitude(),
            'longitude' => self::faker()->longitude(),
            'pays' => self::faker()->country(),
            'ville' => self::faker()->city(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Localisation $localisation): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Localisation::class;
    }
}
