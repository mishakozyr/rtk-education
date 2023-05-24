<!DOCTYPE html>
<html lang="ru">
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Практическая №7</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // обработка отправки формы подсчета вхождений строки
            $('#occurrencesForm').submit(function(event) {
                event.preventDefault();

                let string1 = $('#string1').val();
                let string2 = $('#string2').val();

                $.post('count_occurrences.php', {string1: string1, string2: string2}, function(data) {
                    $('#occurrencesResult').text(data);
                });
            });

            // обработка отправки формы решения квадратного уравнения
            $('#quadraticForm').submit(function(event) {
                event.preventDefault();

                let a = $('#a').val();
                let b = $('#b').val();
                let c = $('#c').val();

                $.post('solve_quadratic.php', {a: a, b: b, c: c}, function(data) {
                    $('#quadraticResult').html(data);
                });
            });
        });
    </script>
</head>
<body>

    <div class="container">
        <h2>Решение квадратного уравнения</h2>

        <form id="quadraticForm">
            <label for="a">Коэффициент a:</label>
            <input class="custom-input" type="text" id="a" required>

            <label for="b">Коэффициент b:</label>
            <input class="custom-input" type="text" id="b" required>

            <label for="c">Коэффициент c:</label>
            <input class="custom-input" type="text" id="c" required>

            <input class="button" type="submit" value="Решить уравнение">
        </form>

        <div id="quadraticResult"></div>
    </div>

    <div class="container">
        <h2>Подсчет вхождений строки</h2>

        <form id="occurrencesForm">
            <label for="string1">Строка 1:</label>
            <input class="custom-input" type="text" id="string1" required>

            <label for="string2">Строка 2:</label>
            <input class="custom-input" type="text" id="string2" required>

            <input class="button" type="submit" value="Подсчитать вхождения">
        </form>

        <div id="occurrencesResult"></div>
    </div>

    <?php require_once "count.php"; ?>

</body>
</html>
