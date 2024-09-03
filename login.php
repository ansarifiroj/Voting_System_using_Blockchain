<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
  include "partials/_dbconnect.php";
  $userID = $_POST["userID"];
  $mobNumber = $_POST["mobNumber"];

  $sql = "Select * from voting_data where ID='$userID' AND mobile_number='$mobNumber' AND status='0'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if($num == 1){
      $showAlert = true;
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['userID'] = $userID;
      header("location: http://localhost/php_prog/voteCode/");
  }
  else{
    $showError = "You have already voted.";
  }
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      body {
        background-color: #f0f0f0; /* Set the background color */
      }
      .center {
        margin: 0 auto; /* Set left and right margins to auto */
        text-align: center; /* Center inline contents */
      }
      #alert{
        color : red;
      }
    </style>
  </head>
  <body>
    <?php require 'partials/_nav.php'?>
    <?php
    if($showAlert){
      echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success</strong> Logged in.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if($showError){
      echo '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container my-3">
      <h1 class="text-center">Login to Vote</h1>
      <form action="/php_prog/loginSystem/login.php" method="post">
        <div class="my-5 mb-4 col-md-5 center">
          <label for="userID" class="form-label">Enter Your ID</label>
          <input type="number" class="form-control" id="userID" name="userID">
        </div>
        <div class="mb-4 col-md-5 center">
          <label for="mobNumber" class="form-label">Enter Mobile Number</label>
          <input type="number" class="form-control" id="mobNumber" name="mobNumber">
        </div>
        <div class="mb-4 col-md-5 center">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
      <p id="alert">Alert : Once loged in make sure to vote in first attempt without failure.</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
</html>
</body>
</html>