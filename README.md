## Sample "All users"

A simple project with a database connection.

### The database schema

The project expects a database with 2 tables "users" and "status".
First you have to create a database on a mysql server.
The SQL script in the SQL folder is used to create the schema and to populate the database at the first launch of the db ontainer.


### To launch the application

```
$ docker compose up -d 
$ docker compose exec all_users composer update
```

Open your favorite browser and use this URL to test the web app:

`http://localhost:8080/all_users/`


### To access application logs :

```
$ docker logs yasmf_all_users_app --follow
```

### To stop and destroy containers

```
$ docker compose down
```

### To launch some actions

First, you have to open a terminal to access the container after it's launched.

`$ docker compose exec all_users bash`


- PHPStan 

    `$ php ./all_users/lib/vendor/bin/phpstan --xdebug analyse -c ./phpstan.neon`

- tests (without coverage)

    `$ php ./all_users/lib/vendor/bin/phpunit`

- tests with coverage

    `$ php -d xdebug.mode=coverage ./all_users/lib/vendor/bin/phpunit  --coverage-html='reports/coverage'`

### To connect to the DB from CLI

First, you have to open a terminal to access the container after it's launched.

`$ docker compose exec all_users_db bash`

Then you can connect with the mysql client

`$ mysql -u all_users -p`