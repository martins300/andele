# RickMorty Infinite scroller

You can deploy with Docker (production) or run locally (for development)

```sh 
  git clone https://github.com/martins300/andele.git
  cd andele
```

## Setup using Docker

```sh
  docker-compose up
```

[http://localhost:3000](http://localhost:3000)


## Manual Setup for development 

```sh
  cd andele-backend
  composer install
  cp .env.example .env
  php artisan key:generate
  php artisan serve 
```

```sh
  cd andele-vue
  nvm use 20
  npm install
  npm run dev
```
[http://localhost:5173/](http://localhost:5173/)
* or other port depending on your node version