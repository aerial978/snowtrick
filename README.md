# SNOWTRICKS

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/3aef2ec9534441c1928021cd97c1dfae)](https://app.codacy.com/gh/aerial978/snowtrick/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

SnowTricks is a community website for snowboarders created with Symfony PHP framework.

Project 6 of the Openclassrooms training "PHP/Symfony Application Developer".

This collaborative website was built for the needs of a business owner passionate about snowboarding. The objective is to make known this sport and help its learning. It intends to use the content provided by Internet users to develop rich content that arouses the interest of users.

## Tech Stack

* Frontend : HTML5, CSS3, Bootstrap 5.3, Javascript, Jquery, Toastify 1.12
* Backend : PHP 8.1, Symfony 6.1


## Launch

*  Wampserver 64bit 3.2.6
*  MySQL 5.7.36
*  github/aerial978



## Set Up

*   Librairies Installation

```bash
    php bin/console composer install
```

Git clone the project

```bash
  https://github.com/aerial978/snowtrick.git
```

Database

*   Update .env file with your database configuration

```bash
  DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name
```

*   Create database

```bash
  php bin/console doctrine:database:create
```

*   Create database structure

```bash
  php bin/console make:migration
```

*   Database up-to-date

```bash
  php bin/console doctrine:migrations:migrate
```

*   Insert data fixtures

```bash
  php bin/console doctrine:fixtures:load
```

*   Update .env file for Mail server configuration

```bash
  MAILER_DSN=smtp://localhost
```

*   Command : add list of categories

```bash
  php bin/console app:list-category
```

*   Command : add trick category

```bash
  php bin/console app:create-category
```

## Usage

### Roles

#### Visitor

Visitor privileges

*   view tricks list
*   view trick details

#### User

User access :

login with following account : 

  *  username : john45*AC
  *  password : banan4$C

create your user account :

- use the sign in form
- activate your account by following the confirmation link send by email

User additional privileges :

*   add a trick
*   modify a trick
*   delete a trick
*   write a message
