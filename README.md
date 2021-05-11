<h1 align="center">
  <br>
  <img src="https://github.com/drobinetm/laravel-drobinetm-redis/blob/main/src/public/assets/2021-05-09_15-28.png?raw=true" alt="laravel-redis.png">
  <br>
</h1>

# Laravel Redis Information

<table>
  <tr>
    <td>  
      Laravel package to get information from a Redis server with json response.
    </td>
  </tr>
</table>

## How to Use

```php
composer require drobinetm/laravel-drobinetm-redis

php artisan laravel-redis:install
```

## In Your Project 

1. Modify `phpredis` by `predis` in database.php config.

2. Modify in database.php the connection config to your redis server.

`Note:` [Laravel Docs](https://laravel.com/docs/8.x/redis#predis)

## Then

1. Save the printed signature property in the console.

2. Send in the header of the links the value of the signature property: 
[Laravel-Redis-Signature] => signature value

## Endpoints

1. **[GET]** `/redis/info`

2. **[GET]** `/redis/keys`

3. **[GET]** `/redis/slow-log`
