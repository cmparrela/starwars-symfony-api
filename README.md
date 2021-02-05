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

As dependências serão instaladas automaticamente ao subir o container, você pode acompanhar o status da instalação pelo log do container PHP.
```sh
> $ docker logs -f desafio.php
```

Por último rode os migration para criar a base inicial
```sh
> $ docker exec -it desafio.php php bin/console doctrine:migrations:migrate
```

Agora você deve ser capaz de visitar a página da aplicação http://localhost/ e começar a usar o sistema

## Endpoints
- `GET characters`, Lista todos os personagens
- `GET characters/{id}`, Mostra os detalhes de um personagem
- `GET favorites`, Lista todos os personagens favoritos
- `POST favorites`, Salva um personagem como favorito
- `DELETE favorites/{id}`, Delete um personagem favorito
 
Para mais detalhes sobre os endpoints visite a documentação completa https://documenter.getpostman.com/view/1472725/TW73FmHM
 