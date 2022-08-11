## Sistema de Gerenciamento de Escala de Serviço para o Quartel General do Exército - SGESQGEx

o presente codigo representa o projeto desenvolvido na disciplina de TCC, para a obtenção do grau de Tecnólogo em Sistemas para Internet.

### Componentes do Grupo

 - Daniel Evangelista Pereira
 - Muller Araújo do Vale

### Módulos do Sistema

 - Escala
 - MIlitar
 - Seção
 - Posto de Gradução 
 - Posto de Serviço
 - Indicar Graduação
 - Organização Militar
 - Tipo de Impedimento 
 - Impedimento
 
 ### Processo de build
 
 - Realizar o clone do repositório

```
    git clone https://github.com/daniboyBr/tcc-escala-permanencia-v2
```
 - Subir os serviços
```
     docker compose up -d --build
```
 - Executar os seguintes comandos:

```
    docker compose exec app composer install
    docker-compose exec app php artisan migrate:fresh --seed
    docker compose exec app npm install
    docker compose exec app npm run dev
```

* Endereço local
```
    localhost:8080
```
