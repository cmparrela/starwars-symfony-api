## Tecnologias
- MySQL 8 (https://www.mysql.com/)
- PHP 7.4 (https://www.php.net/)
- Docker (https://www.docker.com/)
- Nginx (https://www.nginx.com/)
- Symfony Framework (https://symfony.com/)
## Instalação
Você pode rodar esse projeto usando o [Docker Compose](https://docs.docker.com/compose/install/).
```sh
$ docker-compose up  -d
```

Para instalar as dependências da aplicação será necessário executar o `composer install`, isso pode ser feito dentro do container PHP.
```sh
> $ docker exec -it desafio.php composer install
```

Em seguida crie o arquivo .env baseado no exemplo
```sh
> $ docker exec -it desafio.php cp .env.example .env
```

Por último rode os migration para criar a base inicial
```sh
> $ docker exec -it desafio.php ...
```

Agora você deve ser capaz de visitar a página da aplicação http://localhost/ e começar a usar o sistema