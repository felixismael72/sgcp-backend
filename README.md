# SGCP - Backend

Este repositório guarda o código fonte do lado do servidor de uma aplicação que gerencia consultas, horários, anotações e publicações para o setor de Psicologia do IFAL, campus Arapiraca.

Seu desenvolvimento consiste nas seguintes tecnologias:

- PHP, expresso por meio do framework Laravel;
- Docker, como gerenciador de serviços para a aplicação, em desenvolvimento;
- MongoDB, como banco de dados para publicações e anotações;
- PostgreSQL, como banco de dados para a gestão de usuários, consultas e horários.

Para rodar o projeto localmente, siga os passos a seguir:

### Passo 1:

Verifique sua instalação do [docker](https://docs.docker.com/get-docker/) e do framework [laravel](https://laravel.com/docs/9.x/installation) antes de seguir os próximos passos.

### Passo 2:

Abra o terminal na raiz do projeto e rode:

```bash
cd docker
```

### Passo 3:

Suba os serviços configurados, rodando:

```bash
docker-compose up --build
```

ou:

```bash
docker-compose start
```

caso possua o container construído.

### Passo 4:

Crie o seu arquivo .env nos padrões do .env.example dentro da pasta `/src`

### Passo 5:

Em seu terminal, dirija-se à parte do código fonte da aplicação, rodando:

```bash
cd ../src
```

### Passo 6:

Inicie o servidor da aplicação, rodando:

```bash
php artisan serve
```

Você agora pode acessar todos os endpoints disponíveis, use com sabedoria! :)
