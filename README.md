# Product Scraping

## Descrição

Este projeto tem como objetivo a criação de um sistema de scraping de produtos de um site de api
aberta (https://world.openfoodfacts.org/)
para armazenar os produtos em um banco de dados não relacional (MongoDB), para servir os dados para uma aplicação web
por meio de uma API REST.

### Linguagem, framework e/ou tecnologias usadas

- **Laravel Framework**
- **PHP**
- **MongoDB (Atlas)**
- **Docker**
- **Docker Compose**
- **PHPUnit (test)**

### Instalação

- Clone o repositório
- Crie um arquivo .env na raiz do projeto com as variáveis de ambiente e copie o conteúdo do arquivo .env.example
- Execute o comando `docker-compose up -d` para subir os containers
- Execute o comando `docker-compose exec laravel.test composer install` para instalar as dependências
- Acesse a aplicação em `http://localhost:8080`

### Instalação WSL2

- Clone o repositório
- Crie um arquivo .env na raiz do projeto com as variáveis de ambiente e copie o conteúdo do arquivo .env.example
- Execute o comando `sail up -d` para subir os containers
- Execute o comando `sail composer install` para instalar as dependências
- Acesse a aplicação em `http://localhost:8080`

### Ultilização

- Para executar o comando de scraping, execute o comando `docker-compose exec laravel.test php artisan schedule:run`
- Para executar o comando de iniciar jobs de scraping, execute o
  comando `docker-compose exec laravel.test php artisan schedule:work`
- Para executar os testes, execute o comando `docker-compose exec laravel.test php artisan test`

### Ultilização WSL2

- Para executar o comando de scraping, execute o comando `sail artisan schedule:run`
- Para executar o comando de iniciar jobs de scraping, execute o
  comando `sail artisan schedule:work`
- Para executar os testes, execute o comando `sail artisan test`

### Endponits

- **GET** `/api` - Retorna mensagem (Retornar um Status: 200 e uma Mensagem "Fullstack Challenge 20201026") 
- **GET** `/api/products` - Retorna todos os produtos
- **GET** `/api/products/{id}` - Retorna um produto pelo id

# This is a challenge by Coodesh

