# Invoices API

A API REST de faturas (invoices) é um exemplo de solução para gerenciar e processar faturas em um sistema. Com o uso de middlewares e autenticação, a API oferece um alto nível de segurança e controle de acesso aos recursos. Ela permite a criação, atualização, exclusão e recuperação de faturas, fornecendo uma documentação simples e intuitiva para integração com outros sistemas. Com essa API, é possível ter uma noção de como automatizar o processo de geração e gerenciamento de faturas, trazendo eficiência e organização para qualquer aplicação.

## Requisitos

- PHP 8.2
- Composer (última versão de preferência)
- Git
- Git Bash (opcional)
- Docker

## Instalação

1. Clone o repositório:

   ```shell
   git clone https://github.com/rubensdimasjr/api-laravel.git && cd api-laravel/
   ```
2. Instale as dependências do projeto usando o Composer:

   ```shell
   composer install
   ```
3. Copie e renomeie o arquivo **.env.example** para **.env**:
   
   ⚠️ Caso você não esteja utilizando o **git bash** como terminal, terá que renomear manualmente o arquivo e executar o comando para gerar a key.
   ```shell
   cp .env.example .env && php artisan key:generate
   ```
5. Instalação via docker:
   
   ⚠️ Antes de executar o script, dê uma olhada no arquivo **docker-compose.yml** e garanta que nenhuma porta esteja sendo usada pelos serviços.
   ```shell
   docker compose build --no-cache && docker compose up -d
   ```
6. Após o container estar ativo, execute as migrações do banco de dados e alimente-o com dados iniciais:
   
   ℹ️ O script abaixo é utilizado para acessar o terminal de um determinado serviço e executar um comando.
   ```shell
   docker compose exec main php artisan migrate --seed
   ```
   O servidor estará pronto em http://localhost:8000.


