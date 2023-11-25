## Installation

Download or clone this repo

```
cd Desktop
git clone https://github.com/bar00ng/monjiro.git
```

After done cloning the repo. cd into the directory

```
cd monjiro
composer install
npm install
```

run this command to create an `.env` file. Inside the `env` file you can cofigure your database

```
cp .env.example .env
```

After done configurin your database. You should generate the app key using

```
php artisan key:generate
```

Final step is to migrate and seed the tables.<br>
This command will generate a table for users and products. Then it will generate 120 dummy products data.<br>

```
php artisan migrate
php artisan db:seed
```

**That's great!!** you ready to go 🚀

## Running The Application

In order to run the application you need to run this 2 commands

```
php artisan serve
npm run dev
```

By default you will have 1 administrator account (📣 **REMEMBER TO MIGRATE THE TABLES FIRST!!** 📣)

```
email       : admin@gmail.com
password    : admin123
```
