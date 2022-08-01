### Demo admin area for Overclockers.ua
###

**Technologies stack:**
* PHP 7.4
* Laravel 8
* Docker & docker compose
* Vue.js, Vue-router, Vuex, Bootstrap
* Nginx, MariaDB, Redis

###
#### How to install
_____

```
git clone https://github.com/androidnetua/demo-area.git
```

Copy `.env.example` to `.env`:  
`cp .env.example .env`

Change `APP_URL` in `.env` if it differs from *localhost*

Make `storage` dir writable (just 777 for test purposes):  
`chmod 777 storage -R`

###
Up Docker containers

```
cd docker
docker compose up -d
```

and make some preparations then:

```
docker compose exec php composer install

docker compose exec php php artisan key:generate
docker compose exec php php artisan migrate --seed
```

Finally, some frontend:

```
npm install

npm run prod
```

###
Done! 😃

By default, it is available on http://localhost/area3

User is *Admin*  
Password is *123*

###

Docker compose also run containers with phpMyAdmin (available on port 8080) and
phpRedisAdmin (on port 8081).


###
#### Demo
_____

http://162.55.161.94/area3
