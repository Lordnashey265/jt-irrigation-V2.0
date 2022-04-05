<?php
include './php/core.php';

if(!loggedin()){
  header('location:login');
} else {
  header('location:dashboard/home');
}
?>