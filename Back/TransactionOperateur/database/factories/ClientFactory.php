<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // $client = Client::factory()
            // ->count(3)
            // ->sequence(
            //     [
            //         "nom"=>"ndiaye",
            //         "prenom"=>"fadal",
            //         "numero"=>"772246127"
            //     ],
            //     [
            //         "nom"=>"diop",
            //         "prenom"=>"ami",
            //         "numero"=>"705849545"
            //     ],
            //     [
            //         "nom"=>"Seck",
            //         "prenom"=>"Karim",
            //         "numero"=>"761234567"
            //     ],
            // )->create()

        ];
    }
}
