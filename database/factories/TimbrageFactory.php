<?php

namespace Database\Factories;

use App\Models\Timbrage;
use Illuminate\Database\Eloquent\Factories\Factory;


class TimbrageFactory extends Factory
{
    /**
     * Le nom du modèle correspondant.
     *
     * @var string
     */
    protected $model = Timbrage::class;

    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-4 week', 'now', null, 'Y-m-d'), // Phrase avec texte aléatoire
            'heure' => $this->faker->time('H:i'), // Paragraphe de textes aléatoires
        ];
    }
}
