<?php
  require_once('/../laravel/app/Veritrans/Veritrans.php');
  Veritrans_Config::$isProduction = false;
  Veritrans_Config::$serverKey = 'VT-server-4O7hlRyievnwHHB5b0J-z-xf';
  $vt = new Veritrans;
  $status = $vt->status($order_id);
  var_dump($status);
   exit;

  //  print_r ($vt->status('INV542357') );


  $servername = "localhost";
  $username   = "prod";
  $password   = "cilsy2017";
  $dbname     = "cilsyproject";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "UPDATE invoice SET status='1'";

    // $sql = "UPDATE invoice SET status='1' WHERE `code` = '' ";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";
    // echo $sql;
  }
  catch(PDOException $e)
  {
    echo $sql . "<br>" . $e->getMessage();
  }

  $conn = null;



?>
