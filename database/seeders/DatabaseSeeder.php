<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Movie;
use App\Models\Notification;
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
        User::create([
            'name' => 'standing cat',
            'email' => 'cat@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => 'img/pfp/cat.png',
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ]);
        // Your name
        Movie::create([
            'user_id' => rand(1, 2),
            'title' => ['ka' => 'შენი სახელი', 'en' => 'Your name'],
            'poster' => 'img/movie/your_name.jpeg',
            'genre' => 'Romance',
            'description' => [
                'en' => "YOUR NAME follows two Japanese teens -- big-city boy Taki (Michael Sinterniklaas) and rural girl Mitsuha (Stephanie Sheh) -- who mysteriously wake up one morning in each other's bodies.",
                'ka' => 'თქვენი სახელი მიჰყვება ორ იაპონელ მოზარდს - დიდქალაქ ბიჭს ტაკის (მაიკლ სინტერნიკლაასი) და სოფლის გოგონას მიცუჰას (სტეფანი შეჰ) - რომლებიც იდუმალებით იღვიძებენ ერთ დილას ერთმანეთის სხეულებში.'
            ],
            'release_date' => 2016,
            'director' => [
                'en' => 'Makoto Shinkai',
                'ka' => 'მაკოტო შინკაი',
            ],
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 1,
            'image' => 'img/movie/your_name.jpeg',
            'quote' => ['en' => 'Hey hey hey! where are you going?', 'ka' => 'გამარჯობა, სად მიდიხარ?']
        ]);
        // Breaking bad
        Movie::create([
            'user_id' => rand(1, 2),
            'title' => ['ka' => 'მძიმე დანაშაული', 'en' => 'Breaking bad'],
            'poster' => 'img/movie/brba.jpg',
            'genre' => 'Drama',
            'description' => [
                'en' => 'the series follows the exploits of Walter White, a modest high school chemistry teacher, who discovers a new purpose in life when he learns he has terminal cancer and turns to a life of crime to providefor his family.',
                'ka' => 'სერიალი მოგვითხრობს უოლტერ უაიტის, მოკრძალებული საშუალო სკოლის ქიმიის მასწავლებლის ექსპლუატაციებს,რომელიც აღმოაჩენს ცხოვრების ახალ მიზანს, როდესაც გაიგებს, რომ მას აქვს ტერმინალური კიბო და გადადის დანაშაულებრივ ცხოვრებაზე, რათა უზრუნველყოს მისი ოჯახისთვის.'
            ],
            'release_date' => 2008,
            'director' => ['en' => 'Vince Gilligan', 'ka' => 'ვინს გილიგანი']
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 2,
            'image' => 'img/movie/brba.jpg',
            'quote' => ['en' => 'Are We In The Meth Business, Or The Money Business?', 'ka' => 'ჩვენ მეტამფეტამინის ბიზნესში ვართ, თუ ფულის ბიზნესში?']
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 2,
            'image' => 'img/movie/brba.jpg',
            'quote' => ['en' => 'I Did It For Me', 'ka' => 'მე ეს ჩემთვის გავაკეთე']
        ]);

        Movie::create([
            'user_id' => rand(1, 2),
            'title' => ['ka' => 'ფორს მაჟორი', 'en' => 'Suits'],
            'poster' => 'img/movie/suits.jpg',
            'genre' => 'Legal Drama',
            'description' => [
                'en' => "'Suits' is a legal drama series that centers on a New York law firm and the talented yet unorthodox associate, Mike Ross, who becomes a lawyer without going to law school.",
                'ka' => "'ფორს მაჟორი' არის იურიდიული დრამატული სერიალი, რომელიც ეხება ნიუ-იორკის იურიდიულ ფირმას და ნიჭიერ, მაგრამ არაორდინალურ თანამოაზრეს, მაიკ როსს, რომელიც ხდება იურისტი იურიდიულ სკოლაში წასვლის გარეშე."
            ],
            'release_date' => 2011,
            'director' => ['en' => 'Aaron Korsh', 'ka' => 'აარონ კორში'],
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 3,
            'image' => 'img/movie/suits.jpg',
            'quote' => [
                'en' => 'When You Are Backed Against The Wall, Break The Goddamn Thing Down.',
                'ka' => 'something something კედელი გეფარება.. something something R6..'
            ]
        ]);

        Quote::create([
            'user_id' => rand(1, 2),
            'movie_id' => 3,
            'image' => 'img/movie/suits.jpg',
            'quote' => [
                'en' => "You Don't Send A Puppy To Clean Up Its Own Mess.",
                'ka' => 'something something პრობლემები.. something something ლეკვები..'
            ]
        ]);
        Comment::factory(10)->create();
//        for ($i = 1; $i <= 5; $i++) {
//            Like::create([
//                'user_id' => 1,
//                'quote_id' => $i,
//            ]);
//            Notification::create([
//                'user_id' => 2,
//                'sender_id' => 1,
//                'notification_type' => 'like',
//                'quote_id' => $i,
//                'message' => 'Reacted to your quote',
//            ]);
//            Like::create([
//                'user_id' => 2,
//                'quote_id' => $i,
//            ]);
//            Notification::create([
//                'user_id' => 1,
//                'sender_id' => 2,
//                'notification_type' => 'like',
//                'quote_id' => $i,
//                'message' => 'Reacted to your quote',
//            ]);
//        }
    }
}
