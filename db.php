<?php


$server = "sql113.epizy.com ";
$username="epiz_31086482";
$password ="FqhOmmVp0o5cj";
$dbname="epiz_31086482_XXX"

$conn=mysqli_connect($server,username,$password,$dbname);
if(mysqli_connect_errno())
    echo "connection could not established ...".mysqli_connect_error();
else 
    echo "successfully connected ";
$query="select * from users ";
$result =mysqli_query($conn,$query);

?>