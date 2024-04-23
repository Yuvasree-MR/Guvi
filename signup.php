<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  include '../partials/_dbconnect.php';
  $userName = $_POST["userName"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirmPassword"];
  // $exists = false;

  // to check whether the emailid exists
  $existSql = "SELECT * FROM `users` WHERE email = '$email'";
  $result = mysqli_query($conn, $existSql);
  $numExistRows = mysqli_num_rows($result);
  if($numExistRows > 0)
  {
    // $exists = true;
    $showError = "Email Already Exists";

  }
  else{
    // $exists = false;

        if(($password == $confirmPassword) ){
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `users` (`userName`, `email`, `password`, `date`) VALUES ('$userName', '$email', '$hash', CURRENT_TIMESTAMP())";
          $result = mysqli_query($conn, $sql);
          if($result){
            $showAlert = true;
          }
      }
      else{
        $showError = "Password doesn't match";
      }
  }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <?php require '../partials/_nav.php'?>

<?php
if($showAlert){
echo '
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong>Your Account is now Created and you can Login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if($showError){
  echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error! </strong>'. $showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }

?>


  <div class="container">
    <h1 class="text-center">Signup to our website</h1>
  </div>


<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register Now !</p>

                <form action="/Guvi/php/signup.php" method = "post" class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <label class="form-label" for="userName">Name</label>
                      <input type="text" maxlength="50" id="userName" name="userName" placeholder="Enter your Name" class="form-control" />
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" maxlength="50" id="email" name="email" placeholder="Enter your Email"class="form-control" aria-describedby="emailHelp" placeholder="Enter email"/>

                      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                      
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                      <label class="form-label" for="password">Password</label>
                      <input type="password" maxlength="30" id="password" name="password" class="form-control" placeholder="Enter Your Password" aria-describedby="passwordPattern"/>

                      <small id="passwordPattern" class="form-text text-muted">Your password must contain 1 Uppercase, 1 Lowercase and a Special Chatracter.</small>

                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">

                      <label class="form-label" for="confirmPassword">Re-Enter Password</label>
                      <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" />
                      
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-left mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="agreeCheckbox" name="agreeCheckbox"/>
                    <label class="form-check-label" for="agreeCheckbox">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Register</button>
                  </div>
                </form>
              </div>

              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="/assets/home.jpeg"
                  class="img-fluid" alt="Image">

              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

  </body>
</html>