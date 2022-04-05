<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script type="text/javascript" src="../js/sweetalert.min.js"></script>
    <style>*{font-family:Arial, Helvetica, sans-serif;}</style>
</head>
<body>
<?php
include '../php/connect.php';
if(isset($_GET['id'],$_GET['name']))
{
    $id=$_GET['id'];
    $name=$_GET['name'];
    $query="DELETE FROM `users` WHERE `uid`='".$id."'";
    if($run=mysqli_query($conn,$query))
    {
        ?>
        <script>
            swal("SUCCESS", "<?php echo $name;?> was successfully deleted", "success");
            setTimeout(function(){window.location='admin_list.php'},1000);
        </script>
        <?php
    }
    else
    {
        die(mysqli_error($conn));
    }
}

?>
</body>
</html>