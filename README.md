<p align="center">
    <h1 align="center">BASF API</h1>
    <br>
</p>

Yii 2 Basic Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
rapidly creating small projects.

The template contains the basic features including user login/logout and a contact page.
It includes all commonly used configurations that would allow you to focus on adding new
features to your application.

[![Latest Stable Version](https://img.shields.io/packagist/v/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Total Downloads](https://img.shields.io/packagist/dt/yiisoft/yii2-app-basic.svg)](https://packagist.org/packages/yiisoft/yii2-app-basic)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-basic.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-basic)

ESTRUTURA DE DIRETÓRIOS
-------------------

    assets/            a definição de ativos
    commands/     comandos do console (controladores)
    components/   comandos do console (controladores)
    config/            configurações de aplicativos
    controllers/      classes de controlador da Web
    mail/                arquivos de visualização para e-mails
    models/           classes de modelo
    runtime/          arquivos gerados durante o tempo de execução
    tests/              vários testes para o aplicativo básico
    vendor/           pacotes de terceiros dependentes
    views/             arquivos de visualização para o aplicativo da Web
    web/               script de entrada e os recursos da Web



REQUERIMENTOS
------------

O requisito mínimo: PHP 5.7.0.


INSTALAÇÃO
------------

    cd /diretório-servidor-web-root
    git clone https://github.com/edgarleite/teste-enext-api.git
    cd teste-enext-api
    composer install

Agora você deve poder acessar o aplicativo através do seguinte URL.

~~~
http://localhost/teste-enext-api/web/
~~~

CONFIGURAÇÃO
-------------

### Banco de dados

Edite o arquivo `config / db.php` com dados reais, por exemplo:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=teste-enext-api',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
```

**NOTA:**
- O Yii não criará o banco de dados para você, isso deve ser feito manualmente antes que você possa acessá-lo.


ENDPOINTS
-------

**Adicionar usuário:**

POST /users

    // Parâmetros de requisição
    {
        "username": "test1@test.com",
        "password": "123456"
    }
    
    // Resposta
    {
        "username": "user2@test.com",
        "password": "e10adc3949ba59abbe56e057f20f883e",
        "auth_key": "ruX8Y1PJnmK3SB_BcYFiCnt-nDhKsD1u",
        "id": 3
    }

**Listar usuários:**

GET /users

    // Resposta
    [
        {
            "id": 1,
            "username": "user1@test.com",
            "password": "e10adc3949ba59abbe56e057f20f883e",
            "auth_key": "xQ3u_PJn8DB5FWkm_QaGFeK0J7A80Sc_",
            "access_token": null
        },
        {
            "id": 2,
            "username": "user2@test.com",
            "password": "e10adc3949ba59abbe56e057f20f883e",
            "auth_key": "LcMoHVe0Kv5xHIizy3a9modu4MCWX79Z",
            "access_token": null
        }
    ]

**Autenticar usuário:**

POST /users/login


    // Parâmetros de requisição
    {
        "username": "test1@test.com",
        "password": "123456"
    }

    // Resposta
    {
        "status": true,
        "message": "Success",
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODg4OCIsImF1ZCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4ODg4IiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE1NTg2OTgzOTUsIm5iZiI6MTU1ODY5ODQ1NSwiZXhwIjoxNTU4NzAxOTk1LCJ1aWQiOjEsInVzZXJuYW1lIjoidXNlcjFAdGVzdC5jb20ifQ.YGiwLwUFuWcPLNybnnGhFn56RVgiU4HSZlP9aeoel4A"
}


> ** Todos os demais métodos devem enviar o token de autorização nas requisições:**

    {
        "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODg4OCIsImF1ZCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4ODg4IiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE1NTg2OTgzOTUsIm5iZiI6MTU1ODY5ODQ1NSwiZXhwIjoxNTU4NzAxOTk1LCJ1aWQiOjEsInVzZXJuYW1lIjoidXNlcjFAdGVzdC5jb20ifQ.YGiwLwUFuWcPLNybnnGhFn56RVgiU4HSZlP9aeoel4A"
    }
    
**Listar produtos:**

GET /products

    // Resposta
    [
        {
            "id": 1,
            "user_id": null,
            "inci_name": "BASF 1",
            "basf": 1,
            "brand": "BASF",
            "vegetalization": 70
        },
        {
            "id": 2,
            "user_id": null,
            "inci_name": "BASF 2",
            "basf": 1,
            "brand": "BASF",
            "vegetalization": 50
        },
        {
            "id": 3,
            "user_id": null,
            "inci_name": "BASF 3",
            "basf": 1,
            "brand": "BASF",
            "vegetalization": 20
        },
        {
            "id": 4,
            "user_id": null,
            "inci_name": "BASF TESTE 4",
            "basf": 1,
            "brand": "BASF",
            "vegetalization": 90
        },
        {
            "id": 5,
            "user_id": 1,
            "inci_name": "TESTE USER 1.1",
            "basf": 0,
            "brand": "Brand 1.1",
            "vegetalization": 20
        },
        {
            "id": 6,
            "user_id": 1,
            "inci_name": "TESTE USER 1.2",
            "basf": 0,
            "brand": "Brand 1.2",
            "vegetalization": 30
        }
    ]

**Inserir producto**

POST /products

    // Parâmetros de requisição
    {
        "inci_name": "TESTE USER 2.1", 
        "basf": "0", 
        "brand": "Brand 2.1", 
        "vegetalization": "20" 
    }
    
    // Resposta
    {
        "inci_name": "TESTE USER 2.1",
        "basf": "0",
        "brand": "Brand 2.1",
        "vegetalization": "20",
        "user_id": 1,
        "id": 9
    }

**Sugestão de produtos**

GET /products/suggest



    // Parâmetros de requisição
    {
        "query": "teste"
    }
    
    // Resposta
    [
        {
            "id": 4,
            "user_id": null,
            "inci_name": "BASF TESTE 4",
            "basf": 1,
            "brand": "BASF",
            "vegetalization": 90
        },
        {
            "id": 5,
            "user_id": 1,
            "inci_name": "TESTE USER 1.1",
            "basf": 0,
            "brand": "Brand 1.1",
            "vegetalization": 20
        },
        {
            "id": 6,
            "user_id": 1,
            "inci_name": "TESTE USER 1.2",
            "basf": 0,
            "brand": "Brand 1.2",
            "vegetalization": 30
        },
        {
            "id": 9,
            "user_id": 1,
            "inci_name": "TESTE USER 2.1",
            "basf": 0,
            "brand": "Brand 2.1",
            "vegetalization": 20
        }
    ]