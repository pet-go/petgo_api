# PetGo - Api

## Descrição
PetGo - Api é um software desenvolvido para Petshops com possibilidade de atender demandas para clínica e serviços em geral(Banho, tosa...).

## Critérios
- [Docker](https://docs.docker.com/engine/install/)
- PHP 8.3(Opcional)
- Composer(Opcional)

## Subindo o ambiente
O ambiente será montado em Docker, utilizando pacotes do Laravel [Sail](https://laravel.com/docs/10.x/sail). Para isso, após baixar o projeto e acessar seu diretório, basta utilizar o comando:
```
docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php83-composer:latest \
    composer install
```
Também é possível baixar via composer direto, mas será necessário possuir o PHP versão 8.3, além do composer instalado.
Após instalar as dependências do projeto, basta subir o ambiente utilizando o Laravel Sail:
```
cp -r .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan jwt:secret
./vendor/bin/sail artisan migrate
```
Esses comandos irão instalar as dependências do Docker, gerar as chaves do projeto e rodar as migrações necessárias.

# Acessando o ambiente
Para verificar se o ambiente está funcionando, basta acessar o [localhost](http://localhost:81/)