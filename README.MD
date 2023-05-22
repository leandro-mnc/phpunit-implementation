# Phpunit with Database

#### This repository has intent to show how to integrate unit tests with database without mocking data.

### Libraries

* Phpunit
* Phinx
* Docker

### Starting app

Execute the command below to start app

```
docker-compose up
```

### Running tests

```
docker exec -it phpunit-php-apache composer run tests
```
