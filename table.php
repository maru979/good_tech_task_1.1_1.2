<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
    <script src="assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#customTable').DataTable();
        });
    </script>
    <title>Таблица заказов</title>
</head>
<body>
<div class="topnav">
    <a class="active" href="index.html">Домашняя</a>
    <a href="table.php">Таблица заявок</a>
</div>

<div id="mainTable">
<?php
    $host = "localhost";
    $dbname= "w95862lu_db";
    $dbuser= "w95862lu_db";
    $dbpasswd =  "myPASS123";
    $mysqli = new mysqli($host, $dbuser, $dbpasswd, $dbname);
    if ($mysqli->connect_error) {
        die('Ошибка подключения: ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }
    mysql_set_charset("utf8");
    $results = $mysqli->query("SELECT customerName, email, mobNumber, birthDate, carBrand FROM Tickets");
    print '<table id="customTable">';
    print '<thead><tr><th>фамилия</th><th>email</th><th>номер телефона</th><th>дата рождения</th><th>марка авто</th></tr></thead>';
    print '<tbody>';
    while($row = $results->fetch_array()) {
        print '<tr>';
        print '<td>'.$row["customerName"].'</td>';
        print '<td>'.$row["email"].'</td>';
        print '<td>'.$row["mobNumber"].'</td>';
        print '<td>'.$row["birthDate"].'</td>';
        print '<td>'.$row["carBrand"].'</td>';
        print '</tr>';
    }
    $results->free();
    $mysqli->close();
?>
</tbody>
</table>
<button class = "sortBtn" id ="sortBtn1" onclick="tableSort(0)">Сортировка по фамилии</button>
<button class = "sortBtn" id ="sortBtn2" onclick="tableSort(2)">Сортировка по номеру телефона</button>
<button class = "sortBtn" id ="sortBtn3" onclick="tableSort(3)">Сортировка по дате рождения</button>
</div>
</body>
</html>