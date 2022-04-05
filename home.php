<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="./img/jt-logo.ico">
  <title>JT Irrigation - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet" href="./css/style.css">

  <script type="text/javascript">
    function dis()
    {
      if (window.XMLHttpRequest)
      {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      } 
      else 
      {   // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() 
      {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) 
        {
          document.getElementById("results").innerHTML=xmlhttp.responseText;
        }
      }
      xmlhttp.open("GET","data.php",false);
      xmlhttp.send(null);
    }
    dis();
    setInterval(function(){
      dis();
    },500);

</script>

</head>

<div id="results"></div>

</html>
