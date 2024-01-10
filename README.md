# Laravel Test

## Description

- Create task (info to save: task name, priority, timestamps)
- Edit task
- Delete task
Reorder tasks with drag and drop in the browser. Priority should automatically be updated based on this. #1 priority goes at top, #2 next down and so on.
Tasks should be saved to a mysql table.

BONUS POINT: add project functionality to the tasks. User should be able to select a project from a dropdown and only view tasks associated with that project.

You will be graded on how well-written & readable your code is, if it works, and if you did it the Laravel way.

## Quick start
### Prerequisites

1. You must [download composer](https://getcomposer.org/download) if you don’t have one.
2. You must [download and install Node.js](https://nodejs.org/en/download/) if you don't already have it.

### Setup


Using composer:

```shell
composer install
```

Using npm:

```shell
npm install
```

Database & Env setup

```
mv .env.example .env
```

Migrations

```
php artisan migrate
```

### Local Development (Deployment)
Using concurrently

```
npm run serve
```


