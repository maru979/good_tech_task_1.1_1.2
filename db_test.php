<?php
include("Database.php");

$host = "localhost";
$dbuser= "w95862lu_db";
$dbpasswd = "myPASS123";
$dbname= "w95862lu_db";
$table = 'Tickets';

$db = new Database($host,$dbuser,$dbpasswd, $dbname);

$data = ['customerName'=>'Rus', 'email'=>'dsf@ds.ru', 'mobNumber'=>'89467546623', 'birthDate'=>'1995-01-01', 'carBrand'=>'audi'];
echo $db->insert($table , $data);


$fields_data = ['email'=>'updated@email.com'];
$where_condition = ['id'=>'72'];
echo $db->update($table, $fields_data, $where_condition);

$where_condition = ['id'=>'48'];
echo $db->delete($table, $where_condition);
?>