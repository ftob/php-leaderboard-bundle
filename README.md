# Leaderboard Client
========================
[![Build Status](https://secure.travis-ci.org/ftob/php-leaderboard-bundle.svg?branch=master)](http://travis-ci.org/ftob/php-leaderboard-bundle)

## Description
[SDK для API] (example.com/leaderboard).
Реализует взаимодействие с интерфейсом для получения списка лидеров игры.
В списке выводится до десяти лидеров.

## Getting started
Для установки Вам потребуется composer. Установить Вы можете при помощи команды `$ composer require ftob/php-leaderboard-bundle`.

### Bundle
Данная библиотека может выполнять функции Symfony bundle. Для этого включите его в Kernel своего приложения.
Пример:

    <?php
    
    // app/AppKernel.php
    
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Ftob\LeaderBoardBundle\LeaderBoardBundle(),
            // ...
        );
    }


### Configuration



#### Cache

#### Repository

#### Security

## Testing
Есть немного тестов. Тестирование основано на phpunit. Запустить тесты можно при помощи команды `$ phpunit` из корня проекта.

### Docker
В проекте есть docker образ. Он создан для тех, у кого нет желания или возможности установить окружение для тестирования.
Запустить контейнер можно при помощи команды `$ docker-compose up -d` и получить доступ командой `$ docker exec -i -t leaderboard_php bash`.

## Donate
В случае, если данная библиотека вам и не пригодилась, рекомендую войти в положение и задонатить монеток на ЯД: 410014159587237. Благодарствую.