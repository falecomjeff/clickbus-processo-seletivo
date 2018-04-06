# ClickBus — Consulta de tópicos recentes do github (teste de recrutamento)


## Considerações iniciais

1. Combinei com a recrutadora que o teste seria feito num período mais longo, apenas porque estive em retiro fechado no período de 39/03 a 01/04 e porque trabalho em dias da semana. O prazo estipulado por vocês, todavia, é perfeitamente aceitável e confortável para a execução do teste.

2. Foi utilizado o Symfony como framework principal.

3. Foi utilizado o Bootstrap como framework de estilos.

2. Os detalhes acerca do funcionamento de cada função estão descritos no próprio código, em forma de comentários.


## Objetivo do software

O software tem por objetivo comprovar o conhecimento no desenvolvimento de aplicações PHP utilizando o framework Symfony. A ferramenta foi desenvolvida de acordo com [o escopo](https://github.com/RocketBus/quero-ser-clickbus/tree/master/testes/fullstack-developer) passado pela equipe de recrutamento da ClickBus.

Em resumo, a aplicação deve permitir a consulta de repositórios do github, trazendo os resultados mais recentes primeiro e com paginação de 5 em 5 resultados. O bundle [php-github-api](https://github.com/KnpLabs/php-github-api) foi utilizado para comunicação com a API oficial do Github. Tal escolha foi feita para comprovar minha experiência com o uso de bundles escritos pela comunidade.


## Pré-requisitos para instalação

+ Servidor Apache 2.0 ou Nginx
+ PHP 7.1.3+
+ OpenSSL PHP Extension
+ PDO PHP Extension
+ Mbstring PHP Extension
+ Tokenizer PHP Extension
+ XML PHP Extension
+ Ctype PHP Extension
+ JSON PHP Extension


## Instalação

### 1. Clone o projeto

```sh
git clone git@gitlab.com:falecomjeff/clickbus-processo-seletivo.git
```

### 2. Instale as dependências do projeto

```sh
composer install
```

(caso o **composer** não esteja disponível, baixe-o pelo site [getcomposer.org](http://getcomposer.org))

### 3. Acerte as configurações do projeto (arquivo .env).

Verifique a documentação em [https://symfony.com](https://symfony.com)


## Informações que podem ajudar na execução dos testes

### 1. Rotas relevantes

+ /

### 2. Execução dos testes com phpunit
```sh
./vendor/bin/simple-phpunit
```


## Contato

- (11) 99635-5400
- falecomjeff@gmail.com
- LinkedIn: [http://linkedin.com/in/falecomjeff/](http://linkedin.com/in/falecomjeff/)
- Portfólio: [http://falecomjeff.com/](http://falecomjeff.com/)
