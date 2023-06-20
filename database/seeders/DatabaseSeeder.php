<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Movie;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create();
        user::create([
            'name' => 'standing cat',
            'email' => 'cat@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => 'storage/img/pfp/cat.png',
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        // Your name
        Movie::create([
            'user_id' => rand(1, 2),
            'title' => 'Your name',
            'poster' => 'storage/img/movie/your_name.jpeg',
            'genre' => 'Romance',
            'description' => "YOUR NAME follows two Japanese teens -- big-city boy Taki (Michael Sinterniklaas) and rural girl Mitsuha (Stephanie Sheh) -- who mysteriously wake up one morning in each other's bodies.",
            'release_date' => 2016,
            'director' => 'Makoto Shinkai',
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 1,
            'image' => 'storage/img/movie/your_name.jpeg',
            'quote' => 'Hey hey hey! where are you going?'
        ]);
        // Breaking bad
        Movie::create([
            'user_id' => rand(1, 2),
            'title' => 'Breaking bad',
            'poster' => 'storage/img/movie/brba.jpg',
            'genre' => 'Drama',
            'description' => 'the series follows the exploits of Walter White, a modest high school chemistry teacher,
            who discovers a new purpose in life when he learns he has terminal cancer and turns to a life of crime to provide
            for his family.',
            'release_date' => 2008,
            'director' => 'Vince Gilligan',
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 2,
            'image' => 'storage/img/movie/brba.jpg',
            'quote' => 'Smoking Marijuana, Eating Cheetos, And Masturbating Do Not Constitute Plans In My Book'
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 2,
            'image' => 'storage/img/movie/brba.jpg',
            'quote' => 'I Did It For Me'
        ]);

        Movie::create([
            'user_id' => rand(1, 2),
            'title' => 'Suits',
            'poster' => 'storage/img/movie/suits.jpg',
            'genre' => 'Legal Drama',
            'description' => "'Suits' is a legal drama series that centers on a New York law firm and the talented yet unorthodox associate, Mike Ross, who becomes a lawyer without going to law school.",
            'release_date' => 2011,
            'director' => 'Aaron Korsh',
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 3,
            'image' => 'storage/img/movie/suits.jpg',
            'quote' => 'When You Are Backed Against The Wall, Break The Goddamn Thing Down.'
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 3,
            'image' => 'storage/img/movie/suits.jpg',
            'quote' => "You Don't Send A Puppy To Clean Up Its Own Mess."
        ]);
        Comment::factory(6);
    }
}
