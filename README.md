
# Projeto Laravel com Vue.js e Docker (Teste Grupo Plan)

Este projeto utiliza Laravel como backend, Vue.js como frontend, ambos rodando em contêineres Docker.

## Pré-requisitos

Antes de começar, certifique-se de ter os seguintes softwares instalados:

- Docker
- Docker Compose


## Configuração do Ambiente

### 1. Clone o Repositório

```bash
git clone https://github.com/NannAlmeida/grupo_plan_test.git
cd grupo_plan_test
```

### 2. Configurar Variáveis de Ambiente

Crie um arquivo `.env` na raiz do projeto com as seguintes configurações:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=my_database
DB_USERNAME=user
DB_PASSWORD=user_password
APP_KEY=base64:YOUR_APP_KEY
```

### 3. Construir e Iniciar os Contêineres

Execute o comando para construir e iniciar os contêineres:

```bash
docker-compose up -d --build
```

### 4. Executar Migrations e Seeders

Após iniciar os contêineres, execute as migrations e seeders no contêiner do Laravel:

```bash
docker-compose exec api php artisan migrate
docker-compose exec api php artisan db:seed
```

## Acessar a Aplicação

- **Frontend e API**: Abra [http://localhost:8000](http://localhost:8000) no navegador para acessar a aplicação.

## Comandos Úteis

- Parar os contêineres:

```bash
docker-compose down
```

- Reconstruir os contêineres:

```bash
docker-compose build
```

- Verificar logs dos contêineres:

```bash
docker-compose logs api
docker-compose logs db
```
