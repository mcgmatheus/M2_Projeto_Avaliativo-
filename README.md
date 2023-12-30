### Projeto Avaliativo do Módulo 2 :: DEVinHouse

# TrainsSys

#### Uma ferramenta de gerenciamento de alunos e treinos para preparadores físicos e instrutores de academia.

Com a crescente demanda por uma vida mais saudável, os profissionais dessa área veem-se cada vez mais ocupados. Com o intuito de facilitar a organização de suas aulas, criou-se o TrainSys, uma ferramenta de gerenciamento de alunos e treinos, de fácil acesso e usabilidade.

## Índice:

1. [Descrição do Projeto](#descrição)
2. [Como executar](#execução)
3. [Uso](#uso)
4. [Melhorias](#melhorias)

## Descrição do projeto

Esta aplicação permite o cadastro de usuários e seus alunos, cadastro de exercícios, montagem de treinos individuais e personalizados.
Através de um sistema de autenticação com login, as informações permanecem seguras enquanto são manipuladas por diferentes usuários.
Outras features do sistema são envio de e-mail para um novo usuário cadastrado, e a exportação de arquivos PDF, que contem a rotina de exercícios de cada aluno.
A aplicação foi desenvolvida com uso o framework Laravel 10 e utiliza um banco de dados PostgreSQL, e faz uso da biblioteca DOMPDF Wrapper for Laravel sendo essa a única dependência externa do projeto.

## Execução

1.  Clonar repositório através do link:
    > https://github.com/mcgmatheus/M2_Projeto_Avaliativo-.git
2.  Abrir a aplicação em sua IDE e executar o comando para instalar as dependências do projeto:
    > composer install
3.  Criar um banco de dados PostgreSQL com o nome:
    > academia_api
4.  Criar uma cópia do arquivo de configuração .env:
    > cp .env.example .env
5.  No arquivo de configuração, preencher os campos conforme banco de dados:
    > DB_CONNECTION=' '
        DB_HOST=' '
        DB_PORT=' '
        DB_DATABASE=' '
        DB_USERNAME=' '
        DB_PASSWORD=' '
6.  Instalar as dependências da biblioteca DOMPDF Wrapper:
    > composer require barryvdh/laravel-dompdf
7.  Ainda no arquivo de configuração, preencher os campos conforme servidor de envio de e-mails:
    > MAIL_MAILER=' '
    > MAIL_HOST=' '
    > MAIL_PORT=' '
    > MAIL_USERNAME=' '
    > MAIL_PASSWORD=' '
    > MAIL_ENCRYPTION=' '
    > MAIL_FROM_ADDRESS=' '
    > MAIL_FROM_NAME=' '
8.  Gerar tabelas no banco de dados:
    > php artisan migrate
9.  Iniciar o servidor de desenvolvimento do Laravel:
    > php artisan serve

## Uso

-   Cadastro de novo Usuário.
    Rota da requisição: post para `/api/users`
    Estrutura da tabela:
    | Parâmetro | Tipo |
    |--|--|
    | id | Chave primária |
    | name | string e obrigatório (nome do usuário) |
    | email | string, obrigatório e único (e-mail usuário) |
    | date_birth | data (yyyy-mm-dd) e obrigatório (data de nascimento) |
    | cpf | string, obrigatório e único (cpf do usuário) |
    | password | string e obrigatório (senha do usuário) |
    | plan_id | chave estrangeira (tabela: plans) e obrigatório (tipo de plano) |
    Exemplo da requisição:

         {
          "name": "Matheus Gonçalves",
          "email": "teste@teste.com",
          "password": "teste",
          "date_birth": "xxxx-xx-xx",
          "cpf": "xxx.xxx.xxx-xx",
          "plan_id": 1
        }

---

-   Login de usuário
    Para acessar o sistema, deve ser feita uma requisição post para `/api/login` tendo o corpo da solicitação como no exemplo:

          {
          "email": "teste@teste.com",
          "password": "teste"
          }

A resposta ira conter um campo chamado `"token"` exibindo um token.
**Esse token deve ser informado nas próximas solicitações.**
Para realizar o logout, enviar uma requisição post para `/api/logout`. Não deve haver corpo da solicitação e o token deve estar presente na requisição.

---

-   Dashboard
    Rota da requisição: get para `/api/dashboard`
    Serão retornados algumas informações como quantidade de alunos e exercícios registrados, tipo de plano do usuário logado e quantidade restante de alunos que podem ser cadastrados a depender do plano.

---

-   Cadastro de exercícios
    Rota da requisição: post para `/api/exercises`
    Estrutura da tabela:
    | Parâmetro | Tipo |
    |--|--|
    | id | Chave primária |
    | description | string e obrigatório (nome do exercício) |
    | user_id | chave estrangeira (tabela: users) e obrigatória (usuário que realizou o cadastro deste exercício) |
    Exemplo da requisição:
    {
    "description": "Supino"
    }

---

-   Listagem de exercícios
    Rota da requisição: get para `/api/exercises/`
    Serão retornados todos os exercícios cadastrados pelo usuário logado.
    Não deve haver corpo da solicitação.

---

-   Deleção de exercícios
    Rota da requisição: delete para `/api/exercises/{id}`
    Deve ser enviado via url o id do exercício a ser deletado.

---

-   Cadastro de aluno
    Rota da requisição: post para `/api/students`
    Estrutura da tabela:
    | Parâmetro | Tipo |
    |--|--|
    | id | Chave primária |
    | name | string e obrigatório (nome do aluno) |
    | email | string, obrigatório e único (e-mail aluno) |
    | date_birth | data (yyyy-mm-dd) e obrigatório (data de nascimento do aluno) |
    | cpf | string, obrigatório e único (cpf do aluno) |
    | contact | string e obrigatório (celular do aluno) |
    | user_id | chave estrangeira (tabela: users) e obrigatório (usuário que cadastrou esse aluno) |
    | city | string (cidade do aluno) |
    | neighborhood | string (bairro do aluno) |
    | number | string (numero residencial do aluno) |
    | street | string (rua do aluno) |
    | state | string (estado do aluno) |
    | cep | string (cep do aluno) |

    Exemplo da requisição:

         {
         "name": "Aluno Teste",
         "email": "alunoteste@teste.com",
         "date_birth": "xxxx-xx-xx",
         "cpf": "xxx.xxx.xx-xx",
         "contact": "(xx) xxxxx-xxxx
         }

---

-   Listagem de alunos
    Rota da requisição: get para `/api/students/`
    Serão retornados todos os alunos cadastrados pelo usuário logado, ordenados alfabeticamente.
    Uma feature da aplicação também permite filtros nessa busca, podendo ser retornado um aluno informando "name", "cpf" ou "email" via Query Parameters.
    Não deve haver corpo da solicitação.

---

-   Listagem de um aluno
    -Rota da requisição: get para `/api/students/{id}`
    Deve ser enviado via url o id do aluno a ser pesquisado.
    Não deve haver corpo da solicitação.

---

-   Deleção de aluno
    -Rota da requisição: delete para `/api/students/{id}`
    Deve ser enviado via url o id do aluno a ser pesquisado.
    Não deve haver corpo da solicitação.

---

-   Atualização de um aluno
    Rota da requisição: put para `/api/students/{id}`
    Deve ser enviado via url o id do aluno a ter os dados atualizados.
    No corpo da requisição devem ser informados os valores a serem alterados. Mesmo após a atuaização, os valores de email e cpf ainda devem ser únicos no banco de dados. Caso seja informado algum valor já existente, a aplicação retornará um erro 400.
    Exemplo da requisição:
    {
    "name": "Aluno Teste",
    "email": "alunoteste@teste.com",
    }

Nesse exemplo, estão sendo alterados os valores de "name" e "email" do aluno cujo id foi enviado via url.

---

-   Cadastro de treino
    Rota da requisição: post para `/api/workouts`
    Estrutura da tabela:
    | Parâmetro | Tipo |
    |--|--|
    | id | Chave primária |
    | student_id | chave estrangeira (tabela: students) e obrigatório (aluno pertencente ao treino) |
    | exercise_id | chave estrangeira (tabela: exercises) e obrigatório (exercício pertencente ao treino) |
    | repetitions | integer e obrigatório (repetições do exercício) |
    | weight | decimal, obrigatório (carga do exercício) |
    | break_time | integer e obrigatório (intervalo de descanso) |
    | day | enum contendo os valores: SEGUNDA,TERCA,QUARTA,QUINTA,SEXTA,SABADO,DOMINGO |
    | observations | text (observações gerais sobre o exercício) |
    | time | integer e obrigatório (tempo da atividade caso não possua repetições) |
    Exemplo da requisição:
    {
    "student_id": 1,
    "exercise_id": 1,
    "repetitions": 15,
    "weight": 30,
    "break_time": 60,
    "day": "SEGUNDA",
    "observations": "Realizar 3 séries",
    "time": 60
    }
    Dessa maneira, adicionar exercícios individualmente a cada dia da semana conforme necessidade.

---

-   Listagem de treinos de um aluno
    Rota da requisição: get para `/api/students/workouts`
    Serão retornados todos treinos cadastrados para aquele aluno. O id do aluno deve ser informado via Query Parameters.

---

-   Exportação de PDF com roteiro de treinos
    Rota da requisição: get para `/api/students/export/studentId`
    Será retornado um arquivo PDF contendo todos os dias de treino, e as informações dos exercícios cadastrados nos respectivos dias.

## Melhorias

Sugestões de melhorias futuras:

-   Implementar um método para deleção de treinos;
-   Recuperação de alunos deletados, pois já está implementado o soft delete.
