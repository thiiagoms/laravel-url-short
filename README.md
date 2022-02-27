<p align="center">
  <a href="https://github.com/thiiagoms/urlshort">
    <img src="assets/logo.png" alt="Logo" width="80" height="80">
  </a>
     <h3 align="center">Short your favorite urls :gloves:</h3>
</p>
<br>

You can short your favorites urls with this application! Only for **education purposes**!

- [Dependencies](#Dependencies)
- [Usage](#Usage)


### Dependencies

* PHP ^8.1
* Composer
* Database (MySQL, Postgres, etc)

### Usage

- First, clone this repository:

```bash
$ git clone https://github.com/thiiagoms/urlshort
```

- Second, install dependencies:

```bash
$ cd urlshort
$ composer install
```
- Third, copy `.env.example` to  `.env` and put your **database credentials** in `.env` file:

```bash
$ cp .env.example .env
DB_CONNECTION=mysql
DB_HOST=[YOUR_DATABASE_HOST]
DB_PORT=[YOUR_DATABASE_PORT]
DB_DATABASE=[YOUR_DATABASE_NAME]
DB_USERNAME=[YOUR_DATABASE_USERNAME]
DB_PASSWORD=P[YOUR_DATABASE_PASSWORD]

```

- Fourth, run migrations:

```php
$ php artisan migrate
```

- Fifth, stand up the server and go to `http://localhost:8000`
```php
$ php artisan serve
```