### Movie-Quotes Back-end
---
api for the movie-quotes website

#
### Table of Contents
* [Prerequisites](#prerequisites)
* [Tech Stack](#tech-stack)
* [Getting Started](#getting-started)
* [Migrations](#migration)
#
### Prerequisites
* *PHP@8 and up*
* *MYSQL@8 and up*
* *npm@6 and up*
* *composer@2 and up*
* *spatie laravel-translatable-v6*

#
### Tech Stack
* [Laravel@8.x](https://laravel.com/docs/8.x) - back-end framework / MVC controller
* [Laravel-sanctum](https://laravel.com/docs/10.x/sanctum) - API Protection guard for SPA's
* [Spatie Translatable](https://github.com/spatie/laravel-translatable) - package for translation

#
### Getting Started
1. First of all you need to clone corona-time repository from gitHub:
```
https://github.com/RedberryInternship/giorgi-tarkhnishvili-movie-quotes-back.git
```

2. Next step requires you to run *composer install* in order to install all the dependencies.
```
composer install
```

3. after you have installed all the PHP dependencies, it's time to install all the JS dependencies:
```
npm install
```
and also:
```
npm run dev
```
in order to build your JS/SaaS resources.

4. Now we need to set our env file. Go to the root of your project and execute this command.
```
cp .env.example .env
```
And now you should provide **.env** file all the necessary environment variables:
#

**APP:**
APP_URL=
FRONTEND_URL=
BACKEND_URL=
SESSION_DOMAIN=

**PUSHER**
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=

**MYSQL:**
>DB_CONNECTION=mysql
>DB_HOST=
>DB_PORT=
>DB_DATABASE=
>DB_USERNAME=
>DB_PASSWORD=

**SESSION:**
>BROADCAST_DRIVER=
>CACHE_DRIVER=
>FILESYSTEM_DRIVER=
>QUEUE_CONNECTION=
>SESSION_DRIVER=file
>SESSION_LIFETIME=

** Google cloud API **
>GOOGLE_CLIENT_ID=
>GOOGLE_CLIENT_SECRET=


execute in the root of you project following:
```sh
  php artisan key:generate
```
Which generates auth key.

#
### Migration
if you've completed getting started section, then migrating database if fairly simple process, just execute:
```sh
php artisan migrate
```

### Start
if you want to start the application first make sure your database is active, then run:
```sh
php artisan serve
```

### DrawSQL
https://drawsql.app/teams/tarkhna/diagrams/corona-time
<div style="display:flex; align-items: center">
  <img src="https://i.ibb.co/qdWJnRg/image.png" alt="drawing" />
</div>
