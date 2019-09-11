<?php
    $host = "localhost";
    $dbname= "w95862lu_db";
    $dbuser= "w95862lu_db";
    $dbpasswd =  "myPASS123";
    $conn = new mysqli($host, $dbuser, $dbpasswd, $dbname);
    if ($conn->connect_error) {
        die('Ошибка подключения: (' . $conn->connect_errno . ') '. $conn->connect_error);
    }

    $customerName=$_POST['customerName'];
    $email=$_POST['email'];
    $mobNumber=$_POST['mobNumber'];
    $birthDate=$_POST['birthDate'];
    $carBrand=$_POST['carBrand'];
    $result = $conn->query("SELECT * FROM `Tickets` WHERE mobNumber = '$mobNumber'");
    $isExist = "not_exist"; 
    if (mysqli_num_rows($result) > 0){ 
        $isExist = "exist";
        echo $isExist;
    } 
    else{
        echo $isExist;
        $sql="INSERT INTO Tickets(id, customerName, email, mobNumber, birthDate, carBrand) VALUES (NULL, '$customerName', '$email', '$mobNumber', '$birthDate', '$carBrand')";
    }
    $conn->query($sql);
    $conn->close();
?>