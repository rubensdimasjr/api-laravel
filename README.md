# Invoices API

A API REST de faturas (invoices) é um exemplo de solução para gerenciar e processar faturas em um sistema. Com o uso de middlewares e autenticação, a API oferece um alto nível de segurança e controle de acesso aos recursos. Ela permite a criação, atualização, exclusão e recuperação de faturas, fornecendo uma documentação simples e intuitiva para integração com outros sistemas. Com essa API, é possível ter uma noção de como automatizar o processo de geração e gerenciamento de faturas, trazendo eficiência e organização para qualquer aplicação.

## Requisitos

- PHP versão 8.2
- Laravel versão 10
- Banco de dados (MySQL)
- Docker

## Instalação

1. Clone o repositório:

   ```shell
   git clone https://github.com/seu-usuario/nome-do-projeto.git
   cd api-laravel/
   ```
2. Dentro do diretório do projeto, copie e renomeie o arquivo .env.example:

   ```shell
   cp .env.example .env
   php artisan key:generate
   ```
3. Instalação via docker:
   
   ⚠️ Antes de executar o script, dê uma olhada no arquivo **docker-compose.yml** e garanta que nenhuma porta esteja sendo usada pelos serviços.
   ```shell
   docker compose build --no-cache && docker compose up -d
   ```
5. Após o container estar ativo:
   
   ℹ️ O script abaixo é utilizado para acessar o terminal de um determinado serviço.
   ```shell
   docker compose exec main sh
   ```
7. Utilizando o terminal do docker, execute as migrações do banco de dados e alimente-o com dados iniciais:

   ```shell
   php artisan migrate --seed
   ```
   O servidor estará pronto em http://localhost:8000.


