# ProModule

### Description:

This system is designed to store modules (tasks) for the Professionals Championship (formerly WorldSkills Russia). There are 3
roles - Administrator, Expert and Competitor. Each role can view modules and filter. The administrator can CRUD users
and modules, activate users. The expert can create modules. 

DDD, Redis was used for caching.

### ER Diagram

![](https://i.imgur.com/koOULo2.png)

This project use the following ports:

| Tech  | Port |
|-------|-----:|
| Nginx | 1111 |
| MySQL | 1112 |
| Redis | 1113 |

### Usage:

The system has a default users 
- `email: admin@ya.ru password: password`
- `email: expert@ya.ru password: password`
- `email: competitor@ya.ru password: password`

### Installation:

**1- Clone:**

```bash
$ git clone https://github.com/Burashev/ProModule.git
```

2- **Open project folder:**

```bash
$ cd folder
```

3-  **Add your file** `.env` **:**

```bash
$ cp env.example .env
```

The .env.example file has the following basic configurations:

```bash
DB_CONNECTION=mysql
DB_HOST=project_db
DB_PORT=3306
DB_DATABASE=promodule
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis

REDIS_HOST=project_redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

4- **Install dependencies:**

```bash
$ docker-compose exec app composer install 
````

5- **Run this command to run it in docker:**

```bash
$ docker-compose build
$ docker-compose up -d
$ docker-compose exec app php artisan promodule:install # installation artisan command
```
