<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Exercícios</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Rotina de exercícios de {{ $name }}</h2>
    <h3>Segunda-feira</h3>
    <table>
        <tr>
            <th>Exercício</th>
            <th>Repetições</th>
            <th>Peso</th>
            <th>Intervalo</th>
            <th>Observações</th>
            <th>Tempo</th>
        </tr>
        @foreach ($mondayWorkout as $exercise)
            <tr>
                <td>{{ $exercise['exercise_description'] }}</td>
                <td>{{ $exercise['repetitions'] }} vezes</td>
                <td>{{ $exercise['weight'] }} kg</td>
                <td>{{ $exercise['break_time'] }} segundos</td>
                <td>{{ $exercise['observations'] }}</td>
                <td>{{ $exercise['time'] }} minutos</td>
            </tr>
        @endforeach
    </table>
    <h3>Terça-Feira</h3>
    <table>
        <tr>
            <th>Exercício</th>
            <th>Repetições</th>
            <th>Peso</th>
            <th>Intervalo</th>
            <th>Observações</th>
            <th>Tempo</th>
        </tr>
        @foreach ($tuesdayWorkout as $exercise)
            <tr>
                <td>{{ $exercise['exercise_description'] }}</td>
                <td>{{ $exercise['repetitions'] }} vezes</td>
                <td>{{ $exercise['weight'] }} kg</td>
                <td>{{ $exercise['break_time'] }} segundos</td>
                <td>{{ $exercise['observations'] }}</td>
                <td>{{ $exercise['time'] }} minutos</td>
            </tr>
        @endforeach
    </table>
    <h3>Quarta-feira</h3>
    <table>
        <tr>
            <th>Exercício</th>
            <th>Repetições</th>
            <th>Peso</th>
            <th>Intervalo</th>
            <th>Observações</th>
            <th>Tempo</th>
        </tr>
        @foreach ($wednesdayWorkout as $exercise)
            <tr>
                <td>{{ $exercise['exercise_description'] }}</td>
                <td>{{ $exercise['repetitions'] }} vezes</td>
                <td>{{ $exercise['weight'] }} kg</td>
                <td>{{ $exercise['break_time'] }} segundos</td>
                <td>{{ $exercise['observations'] }}</td>
                <td>{{ $exercise['time'] }} minutos</td>
            </tr>
        @endforeach
    </table>
    <h3>Quinta-feira</h3>
    <table>
        <tr>
            <th>Exercício</th>
            <th>Repetições</th>
            <th>Peso</th>
            <th>Intervalo</th>
            <th>Observações</th>
            <th>Tempo</th>
        </tr>
        @foreach ($thursdayWorkout as $exercise)
            <tr>
                <td>{{ $exercise['exercise_description'] }}</td>
                <td>{{ $exercise['repetitions'] }} vezes</td>
                <td>{{ $exercise['weight'] }} kg</td>
                <td>{{ $exercise['break_time'] }} segundos</td>
                <td>{{ $exercise['observations'] }}</td>
                <td>{{ $exercise['time'] }} minutos</td>
            </tr>
        @endforeach
    </table>
    <h3>Sexta-feira</h3>
    <table>
        <tr>
            <th>Exercício</th>
            <th>Repetições</th>
            <th>Peso</th>
            <th>Intervalo</th>
            <th>Observações</th>
            <th>Tempo</th>
        </tr>
        @foreach ($fridayWorkout as $exercise)
            <tr>
                <td>{{ $exercise['exercise_description'] }}</td>
                <td>{{ $exercise['repetitions'] }} vezes</td>
                <td>{{ $exercise['weight'] }} kg</td>
                <td>{{ $exercise['break_time'] }} segundos</td>
                <td>{{ $exercise['observations'] }}</td>
                <td>{{ $exercise['time'] }} minutos</td>
            </tr>
        @endforeach
    </table>
    <h3>Sabádo</h3>
    <table>
        <tr>
            <th>Exercício</th>
            <th>Repetições</th>
            <th>Peso</th>
            <th>Intervalo</th>
            <th>Observações</th>
            <th>Tempo</th>
        </tr>
        @foreach ($saturdayWorkout as $exercise)
            <tr>
                <td>{{ $exercise['exercise_description'] }}</td>
                <td>{{ $exercise['repetitions'] }} vezes</td>
                <td>{{ $exercise['weight'] }} kg</td>
                <td>{{ $exercise['break_time'] }} segundos</td>
                <td>{{ $exercise['observations'] }}</td>
                <td>{{ $exercise['time'] }} minutos</td>
            </tr>
        @endforeach
    </table>
    <h3>Domingo</h3>
    <table>
        <tr>
            <th>Exercício</th>
            <th>Repetições</th>
            <th>Peso</th>
            <th>Intervalo</th>
            <th>Observações</th>
            <th>Tempo</th>
        </tr>
        @foreach ($sundayWorkout as $exercise)
            <tr>
                <td>{{ $exercise['exercise_description'] }}</td>
                <td>{{ $exercise['repetitions'] }} vezes</td>
                <td>{{ $exercise['weight'] }} kg</td>
                <td>{{ $exercise['break_time'] }} segundos</td>
                <td>{{ $exercise['observations'] }}</td>
                <td>{{ $exercise['time'] }} minutos</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
