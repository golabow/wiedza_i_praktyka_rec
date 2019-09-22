Wiedza i prakryka recruitment task.

Used software:
Symfony 4 & Vue.js & SQLite

Install guide:

1. Install dependencies:

  -> composer install
  
  -> cd src/Frontend && npm install

2. Run webpack
  -> cd src/Frontend && webpack --mode development --progress --colors

3. SetUp Database (ready SQLite database is included) 
  -> php bin/console make:migration
  -> php bin/console doctrine:migrations:migrate
  or just execute database.sql

4. Fill Database
  -> php bin/console doctrine:fixtures:load

5. Run symfony local web server
  -> https://symfony.com/doc/current/setup/symfony_server.html
