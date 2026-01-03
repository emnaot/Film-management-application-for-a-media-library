<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Film;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = [
            [
                'titre' => 'Inception',
                'realisateur' => 'Christopher Nolan',
                'pays' => 'États-Unis',
                'date_sortie' => '2010-07-16',
                'description' => 'Un voleur qui s\'infiltre dans les rêves des autres pour voler leurs secrets.',
                'poster' => 'inception.jpg',
                'duree' => 148,
                'langue' => 'Anglais'
            ],
            [
                'titre' => 'The Matrix',
                'realisateur' => 'Lana et Lilly Wachowski',
                'pays' => 'États-Unis',
                'date_sortie' => '1999-03-31',
                'description' => 'Un programmeur découvre que la réalité qu\'il connaît n\'est qu\'une simulation.',
                'poster' => 'matrix.jpg',
                'duree' => 136,
                'langue' => 'Anglais'
            ],
            [
                'titre' => 'Amélie',
                'realisateur' => 'Jean-Pierre Jeunet',
                'pays' => 'France',
                'date_sortie' => '2001-04-25',
                'description' => 'Une jeune femme décide d\'aider les autres à trouver le bonheur.',
                'poster' => 'amelie.jpg',
                'duree' => 122,
                'langue' => 'Français'
            ],
            [
                'titre' => 'Parasite',
                'realisateur' => 'Bong Joon-ho',
                'pays' => 'Corée du Sud',
                'date_sortie' => '2019-05-30',
                'description' => 'Une famille pauvre s\'infiltre dans la vie d\'une famille riche.',
                'poster' => 'parasite.jpg',
                'duree' => 132,
                'langue' => 'Coréen'
            ],
            [
                'titre' => 'Interstellar',
                'realisateur' => 'Christopher Nolan',
                'pays' => 'États-Unis',
                'date_sortie' => '2014-11-07',
                'description' => 'Un groupe d\'explorateurs voyage à travers un trou de ver dans l\'espace.',
                'poster' => 'interstellar.jpg',
                'duree' => 169,
                'langue' => 'Anglais'
            ]
        ];

        foreach ($films as $film) {
            Film::create($film);
        }
    }
}
