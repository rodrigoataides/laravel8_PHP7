
# Setup Docker Para Projetos Laravel 8 com PHP 7

### Passo a passo
Clone Repositório
```sh
git clone https://github.com/rodrigoataides/laravel8_PHP7.git my-project
cd my-project/
```


Remova o versionamento
```sh
rm -rf .git/
```


Crie o Arquivo .env
```sh
cd example-project/
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=Aplicação
APP_URL=http://localhost:8180

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec laravel_8 bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```

Habilitar o Bootstrap Auth para login
```sh
composer require laravel/ui
php artisan ui bootstrap
php artisan ui bootstrap --auth
npm install && npm run dev
```


Acesse o projeto
[http://localhost:8180](http://localhost:8180)
