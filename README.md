<p align="center">
    <h1 align="center">BASF API</h1>
</p>

REQUERIMENTOS
------------

- PHP 5.7.0
- MySQL 5.7.25

*Desenvolvido com Framework Yii 2  - Basic Project -  [Yii 2](http://www.yiiframework.com/)*

INSTALAÇÃO
------------

    cd /diretorio-servidor-web-root
    git clone https://github.com/edgarleite/teste-enext-api.git
    cd teste-enext-api
    composer install

Agora você deve poder acessar o aplicativo através do seguinte URL.

~~~
http://localhost/teste-enext-api/web/
~~~

ESTRUTURA DE DIRETÓRIOS
-------------------

    assets/       a definição de ativos
    commands/     comandos do console (controladores)
    components/   componentes  da aplicação
    config/       configurações da aplicação
    controllers/  classes dos controllers
    mail/         arquivos de visualização para e-mails
    models/       classes dos models
    runtime/      arquivos gerados durante o tempo de execução
    tests/        vários testes para o aplicativo básico
    vendor/       pacotes de terceiros dependentes
    views/        arquivos das views
    web/          script de entrada e os recursos da web

CONFIGURAÇÃO
-------------

### Banco de dados

Edite o arquivo `config/db.php` com dados reais, por exemplo:

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
- O Yii não criará o banco de dados para você, isso deve ser feito manualmente antes que você possa acessá-lo. Utilize o arquivo `database.sql` que está na raíz do projeto.

**TESTE POSTMAN:**
- Importe o arquivo `Enext.postman_collection.json` que se encontra na raíz do projeto.

ENDPOINTS
-------
#### ***Usuários***


- POST /users
- PUT /users/{id}
- POST /users/login
- POST /users/logout
- POST /users/recovery-password


#### ***Produtos***

- POST /products
- GET /products
- GET /products/{id}
- PUT /products/{id}
- DELETE /products/{id}


#### ***Fórmulas***

- POST /formulas
- GET /formulas
- GET /formulas/{id}
- PUT /formulas/{id}
- DELETE /formulas/{id}


ENDPOINTS IMPLEMENTADOS
-------

#### ***Usuários***

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

> Todos os demais métodos devem enviar o token de autorização nas requisições:

    {
        "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6IjRmMWcyM2ExMmFhIn0.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODg4OCIsImF1ZCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4ODg4IiwianRpIjoiNGYxZzIzYTEyYWEiLCJpYXQiOjE1NTg2OTgzOTUsIm5iZiI6MTU1ODY5ODQ1NSwiZXhwIjoxNTU4NzAxOTk1LCJ1aWQiOjEsInVzZXJuYW1lIjoidXNlcjFAdGVzdC5jb20ifQ.YGiwLwUFuWcPLNybnnGhFn56RVgiU4HSZlP9aeoel4A"
    }

#### ***Produtos***

**Listar produtos BASF e do usuário:**

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

**Inserir produto**

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

**Sugestão de produtos BASF e do usuário**

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

#### ***Fórmula***

**Criar fórmula**

POST /formulas


    // Parâmetros de requisição
    
    {
        "formula": {
            "name": "My Formula 100"
        }, 
        "formulaProducts": [
            {
                "product_id": "1", 
                "product_concentration": "100"
            }, 
            {
                "product_id": "2", 
                "product_concentration": "100"
            }, 
            {
                "product_id": "3", 
                "product_concentration": "100"
            }
        ]
    }
    
    // Resposta
    {
        "name": "My Formula 100",
        "user_id": 1,
        "id": 1,
        "vegetalization": "46.67",
        "formulaProducts": [
            {
                "formula_id": 55,
                "product_id": 1,
                "product_concentration": "100.00",
                "product": {
                    "id": 1,
                    "user_id": null,
                    "inci_name": "BASF 1",
                    "basf": 1,
                    "brand": "BASF",
                    "vegetalization": 70
                }
            },
            {
                "formula_id": 55,
                "product_id": 2,
                "product_concentration": "100.00",
                "product": {
                    "id": 2,
                    "user_id": null,
                    "inci_name": "BASF 2",
                    "basf": 1,
                    "brand": "BASF",
                    "vegetalization": 50
                }
            },
            {
                "formula_id": 55,
                "product_id": 3,
                "product_concentration": "100.00",
                "product": {
                    "id": 3,
                    "user_id": null,
                    "inci_name": "BASF 3",
                    "basf": 1,
                    "brand": "BASF",
                    "vegetalization": 20
                }
            }
        ]
    }

**Exibir fórmula**

GET /formulas/{id}

    // Reposta
    {
        "id": 1,
        "user_id": 1,
        "name": "My Formula 1",
        "vegetalization": "46.67",
        "formulaProducts": [
            {
                "formula_id": 1,
                "product_id": 1,
                "product_concentration": "100.00",
                "product": {
                    "id": 1,
                    "user_id": null,
                    "inci_name": "BASF 1",
                    "basf": 1,
                    "brand": "BASF",
                    "vegetalization": 70
                }
            },
            {
                "formula_id": 1,
                "product_id": 2,
                "product_concentration": "100.00",
                "product": {
                    "id": 2,
                    "user_id": null,
                    "inci_name": "BASF 2",
                    "basf": 1,
                    "brand": "BASF",
                    "vegetalization": 50
                }
            },
            {
                "formula_id": 1,
                "product_id": 3,
                "product_concentration": "100.00",
                "product": {
                    "id": 3,
                    "user_id": null,
                    "inci_name": "BASF 3",
                    "basf": 1,
                    "brand": "BASF",
                    "vegetalization": 20
                }
            }
        ]
    }