<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


## Initial setup

1. install dependencies `docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install --ignore-platform-reqs`
2. create `.env` and fill
3. run project `./vendor/bin/sail up`
4. run migrations: `./vendor/bin/sail artisan migrate`
5. run seeds `./vendor/bin/sail artisan db:seed`
6. run command `./vendor/bin/sail artisan app:generateDailyTasksSets`

