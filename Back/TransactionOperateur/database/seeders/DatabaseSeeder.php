<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\Compte;
use COM;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
           $client = Client::factory()
                ->count(3)
                ->sequence(
                    [
                        "nom"=>"ndiaye",
                        "prenom"=>"fadal",
                        "numero"=>"772246127"
                    ],
                    [
                        "nom"=>"diop",
                        "prenom"=>"ami",
                        "numero"=>"775849545"
                    ],
                    [
                        "nom"=>"Seck",
                        "prenom"=>"Karim",
                        "numero"=>"771234567"
                    ],
                )->create();

                $compte = Compte::factory()->count(2)->sequence(
                    [
                        "numero_compte"=>'Om_772246127',
                        "solde"=>0,

                    ],
                    [
                        "numero_compte"=>'Wv_771234567',
                        "solde"=>0,

                    ],
                )->create();
    }
}
