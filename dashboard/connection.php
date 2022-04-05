<?php


$host = 'sql113.epizy.com';
$username='epiz_31086482';
$password ='FqhOmmVp0o5cj';
$database='epiz_31086482_XXX';

define('home','http://jtirrigation.freecluster.eu/home.php');


$conn=mysqli_connect($server,$username,$password,$dbname) or die(mysqli_error($conn));

if(!$conn)
{
    die("Connection failed:".mysqli_connect_error());

}
  

?>