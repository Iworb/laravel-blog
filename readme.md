# Installation
1. Git Clone this repo
2. Run `composer install`
3. Create your `.env` file at root and insert the following lines
```
APP_ENV=local
APP_DEBUG=true
APP_KEY=

DB_HOST=localhost
DB_DATABASE=<your_db_name>
DB_USERNAME=<your_db_user>
DB_PASSWORD=<your_db_password>
```
4. Run `php artisan key:generate`
5. Edit Database infos in `.env` file
6. Create the specified database and run `php artisan migrate:refresh --seed`
7. Run `php artisan serv` or use Homestead to access your live dev environment

For those who want to edit frontend:
1. Run `yarn` or `npm i` to install dependencies
2. Run `yarn run watch` or `npm run watch`