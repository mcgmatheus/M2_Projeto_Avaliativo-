<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo ao TrainSys</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: left;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }
    </style>
</head>
<body>
    <div>
        <h1>Olá, {{ $userName }}!</h1>
        <p>Bem-vindo ao TrainSys, uma ferramenta de gerenciamento de alunos e treinos para preparadores físicos e instrutores de academia.</p>
        <p>Segue alguns informações importantes:</p>
        <ul>
            <li><p>O login deve ser realizado utilizando o email e senha informados durante o seu cadastro.</p></li>
            <li><p>Tipo de plano contratado: <strong>{{ $planDescription }}</strong></p></li>
            <li><p>Limite de cadastro de alunos: <strong>{{ $planLimit }}</strong></p></li>
            <li><p>O upgrade para um plano com maior limite de alunos pode ser feito a qualquer momento.</p></li>
        </ul>
        <p>Obrigado por fazer parte da nossa plataforma!</p>
    </div>
</body>
</html>
