<?php
require_once "../funcs/functions.php";


$signup = new  signup;

if (($_SERVER['REQUEST_METHOD'] == "POST")) {
  $result = $signup->registration("user", $_POST["email"], $_POST["password"], $_POST["password2"],"The password is not the same","there is already account");

}
if (!isset($_SESSION['user_id'])) :
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Document</title>
</head>

<body>


  <form action="" method="post">
    <div class="container">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">ConfirmPassword</label>
        <input name="password2" type="password" class="form-control" id="exampleInputPassword1">
      </div>

      <input type="submit" class="btn btn-primary" value="submit">
    </div>
  </form>


</body>
</html>
<?php
else :
  header("Location: http://localhost/SecurityLoginAndRigestereSystem/core/router/index.php");
  exit();
endif;
?>
?>