# Leroy Merlin — Teste de código com Laravel


## Considerações iniciais

1. Combinei com a recrutadora que o teste seria feito apenas no final de semana. Todavia, fiz o que era possível em alguns intervalos durante a semana, para que fosse possível uma entrega mais rápida (e eu não precisasse comprometer meu final de semana).

2. Ao iniciar o teste, não me atentei que no corpo do e-mail tinha sido solicitado a criação de um repositório no GitLab, liberando o acesso para os e-mails rscafi@leroymerlin.com.br e gmachado@leroymerlin.com.br logo no inicio do projeto. Inicie-o numa conta do Bitbucket. Apesar de ter combinado de fazer o teste apenas no final de semana, eu consegui intervalos de tempo livre durante o horário comercial, só que acabei me focando apenas no material do escopo do projeto (pdf + excel). Todavia, como eu já vinha utilizando Git desde o início do desenvolvimento, todo o histórico (evolução) pode ser visto no log do Git.

3. Os métodos de leitura, atualização e remoção de conteúdos (CRUD, sem o método de inserção) estão de acordo com o que foi solicitado. Todavia, dado a simplicidade do escopo, existem diversos problemas críticos, como proteção das rotas (com Middlewares, por exemplo) ou validação de dados para usuários autenticados. Entendo que o escopo tenha sido propositalmente definido sem essas regras apenas para que alguns skills do candidato sejam comprovados. Assim, validações de autenticação não foram (propositalmente) aplicadas.

4. A planilha possui em sua primeira linha o que se supõe ser a categoria dos produtos em questão. Dessa forma, criei duas entidades (models) relacionadas entre si no modelo OneToMany para relacionar os produtos à sua categoria.

5. Os detalhes acerca do funcionamento de cada função estão detalhados no próprio código, em forma de comentários.

6. O escopo não cita quais campos da planilha são de chave única. De qualquer forma, assumi que a categoria deveria ser única.

7. A planilha Excel teve sua última linha modificada propositalmente para que pelo menos um erro pudesse ser evidenciado.


## Objetivo do software

O software tem por objetivo comprovar o conhecimento no desenvolvimento de aplicações PHP utilizando o framework Laravel. A ferramenta foi desenvolvida de acordo com [o escopo](./storage/escopo/backendDeveloper.pdf) passado pela equipe de recrutamento da Leroy Merlin.

Em resumo, a aplicação deve permitir a importação de dados de materiais e ferramentas de construção para uma base de dados. Posteoriomente, esses dados serão consumidos através de uma API, sendo possível, através dela, listar, editar e remover os produtos da base de dados. A inserção de informações na base de dados é feita única e exclusivamente através da importação da planilha.

A planilha, que encontra-se em **./storage/excel/**, deverá sempre ser colocada neste diretório e ter o nome de **products_teste_webdev_leroy.xlsx** para o pleno funcionamento da importação. A planilha é processada em background utilizando o sistema de filas (queue) do Laravel.


## Pré-requisitos

+ Servidor Apache 2.0 ou Nginx
+ PHP 7.1+
+ MySql 5.7+
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
git clone git@gitlab.com:falecomjeff/leroy-merlin-teste-api.git
```

### 2. Instale as dependências do projeto

```sh
composer install
```

(caso o **composer** não esteja disponível, baixe-o pelo site [getcomposer.org](http://getcomposer.org))

### 3. Acerte as configurações do projeto (arquivo .env). MySql foi a base de dados utilizada.

Verifique a documentação em [https://laravel.com](https://laravel.com)

### 4. Execute o Migrate

```sh
php artisan migrate
```


## Informações que podem ajudar na execução dos testes

### 1. Rotas relevantes

+ api/import (GET|HEAD)
+ api/jobsstatus (GET|HEAD)
+ api/products (GET|HEAD)
+ api/products/{product} (GET|HEAD)
+ api/products/{product} (PUT|PATCH)
+ api/products/{product} (DELETE)

### 2. Rota para solicitar a importação do arquivo Excel (já existente no diretório ./storage/excel/)
```sh
./api/import
```

### 3. Ativar a fila do Laravel em background (e permitir a importação do arquivo)
```sh
php artisan queue:work
```

### 4. Endpoint que retorna se as planilhas foram processadas
```sh
./api/jobsstatus
```

### 5. Execução dos testes com phpunit
```sh
./vendor/bin/phpunit
```


## Extra

### 1. Seeders foram criados, caso haja interesse em popular a base com dados fictícios.
```sh
php artisan db:seed
```


## Contato

- falecomjeff@gmail.com
- (11) 99635-5400
