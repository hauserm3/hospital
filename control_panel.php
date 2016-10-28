<?php
//session_start();
//if(!isset($_SESSION['user_id']) || $_SESSION['user_id']==0){
//    header('Location: login.php');
//    exit();
//}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Control panel</title>
      <!--<base href="/hospital/">-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="libs/bootstrap.min.css">
      <link rel="stylesheet" href="libs/font-awesome.css">
      <link rel="stylesheet" href="styles.css">

    <!-- Polyfill(s) for older browsers -->
      <script src="libs/jquery-3.1.0.min.js"></script>
    <script src="node_modules/core-js/client/shim.min.js"></script>

    <script src="node_modules/zone.js/dist/zone.js"></script>
    <script src="node_modules/reflect-metadata/Reflect.js"></script>
    <script src="node_modules/systemjs/dist/system.src.js"></script>

    <script src="systemjs.config3.js"></script>
    <script>
      System.import('admin').catch(function(err){ console.error(err); });
    </script>
  </head>


  <body>
    <my-admin>Loading...</my-admin>
  </body>
</html>
