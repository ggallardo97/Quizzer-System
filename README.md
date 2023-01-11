# Quizzer System

A simple web application which allows you to use a teacher account to create multiple choices tests and let students take them.
Its interface is very simple because I focused only on the backend code.

## Technologies involved
- PHP - CodeIgniter 4
- PostgreSQL
- HTML
- CSS / Bootstrap
- JavaScript / JQuery
- WAPP

## Installation

First of all, you need to have installed PHP and Apache server (such as WAPP or XAMPP), then clone this repo. Here are some commands that will help you:
```bash
  git clone Quizzer-System
  cd Quizzer-System
  php spark db:create yourdbname
  php spark migrate
  php spark db:seed UserSeeder
```

Second step, modify the .env file with the db connection data:
- database.default.hostname = localhost
- database.default.database = quizzer
- database.default.username = postgres
- database.default.password = yourpasswordhere
- database.default.DBDriver = postgre
- database.default.port     = 5432

Finally, create the db and seed it with a teacher account:
```bash
  php spark db:create yourdbname
  php spark migrate
  php spark db:seed UserSeeder
```

## Usage

With the teacher account you can:
- create, read, edit and delete multiple choices tests
- create, read, edit and delete choices for the tests
- get information of your students' scores and some addtional data

With the student account (you can create one through the register page) you can:
- get all available test
- take tests and get your scores (you have only one try)

