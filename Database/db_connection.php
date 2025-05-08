<?php 
$host="localhost";
$dbname="perfume_store";
$username="root";
$password="";
$conn=mysqli_connect($host,$username,$password,$dbname,3307);
if(!$conn){
    die("فشل الاتصال بقاعدة البيانات".mysqli_connect_error());
}
?>
