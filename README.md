# Cadastro de Empresas

Este projeto é um formulário de cadastro de empresas, onde o usuário pode inserir informações como o nome da loja, CNPJ, e-mail, contato, endereço, e fazer o upload da logomarca. Os dados são validados no lado do cliente antes de serem enviados para o servidor, onde são armazenados em um banco de dados.

## Requisitos
Antes de rodar o projeto, você precisa ter as seguintes ferramentas instaladas:

- **PHP**: Para rodar o servidor.
- **MySQL**: Para armazenar os dados no banco de dados.
- **XAMPP**: Para configurar um ambiente local com PHP e MySQL.
- **Navegador web**: Para rodar o frontend.

## Configuração do Ambiente

### Baixar e instalar o XAMPP:

Se você não tem o XAMPP instalado, baixe e instale a versão adequada para seu sistema operacional:
- [XAMPP](https://www.apachefriends.org/index.html)

### Iniciar o Apache e MySQL:

Após a instalação, abra o XAMPP/WAMP e inicie os serviços **Apache** (servidor web) e **MySQL** (banco de dados).

### Criar o Banco de Dados:

1. Acesse o PHPMyAdmin [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/).
2. Crie um novo banco de dados chamado `cadastro_empresas`.
3. Crie uma tabela chamada `empresas` com a seguinte estrutura sql:

```sql
CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_loja VARCHAR(255) NOT NULL,
    cnpj VARCHAR(18) NOT NULL,
    email VARCHAR(255) NOT NULL,
    contato VARCHAR(15) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    rua VARCHAR(255) NOT NULL,
    numero VARCHAR(50) NOT NULL,
    complemento VARCHAR(255),
    bairro VARCHAR(255) NOT NULL,
    cidade VARCHAR(255) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    logomarca VARCHAR(255)
);

Estrutura do Projeto
/formulario-mistercheff
    /css
        style.css
    /uploads
    index.html
    process.php
    README.md
    scripts.js

Descrição dos Arquivos:
index.html: Arquivo HTML contendo o formulário de cadastro.
css/style.css: Estilos para o formulário.
scripts.js: JavaScript para validação de dados no lado do cliente.
process.php: Arquivo PHP que processa os dados do formulário e os insere no banco de dados.

Como Rodar o Projeto
Colocar os arquivos no diretório do servidor local:
Copie os arquivos do projeto para o diretório de sua instalação XAMPP. Por exemplo, o diretório seria htdocs/formulario-mistercheff.

Acessar a aplicação:
Abra seu navegador e acesse http://localhost/formulario-mistercheff/index.php

Preencher o Formulário:
Complete os campos do formulário e envie os dados. O servidor PHP processará os dados e os salvará no banco de dados.

Verificar o Cadastro:
Após o envio, uma mensagem será exibida com os dados cadastrados.

Validação dos Dados
CNPJ: Deve estar no formato 00.000.000/0000-00.
E-mail: O formato deve ser algo como nome@provedor.com.
Telefone/Celular: Deve estar no formato (00) 00000-0000.
CEP: Deve estar no formato 00000-000.

Essas validações acontecem no lado do cliente utilizando JavaScript. Se algum campo não estiver no formato correto, o formulário não será enviado.

