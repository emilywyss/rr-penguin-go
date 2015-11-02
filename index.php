<?php
  if (isset($_POST["submit"])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = $_POST['addressLine2'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $telephone = ($_POST['telephone']);

    $from = 'Code Test Form';
    $to = 'emilywyss@gmail.com';
    $subject = 'New submission to code test';

    $body = 'From: $fullName\n E-mail: $email\n Address: $addressLine1 $addressLine2\n $city $state $postalCode\n Telephone: $telephone';

    if (!$fullName) {
      $errName = 'Oopsie Daisy, you did not enter your name!';
    }

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errEmail = 'Yoohoo, you did not enter a valid email. Give it another try.';
    }

    function validateCanadaPC($postalCode) {
     if(preg_match("/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i",$postalCode))
        return true;
     else
        return false;
    }

    if (($postalCode !== '') && (validateCanadaPC($postalCode) !== true)) {
      $errPostalCode = 'Please Reselect your country and enter a valid canadian postal code!';
    }

    if (!$errName && !$errEmail && !$errPostalCode) {
      if (mail ($to, $subject, $body, $from)) {
        $result='<div class="alert alert-success">Thanks for your registration. I will get back to you shortly</div>';
      } else {
        $result='<div class="alert alert-danger">Whoops, the computer gremlin ate your submission and it failed to make it to me. You should try again later.</div>';
      }
    }

  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Welcome To Emily's Page!</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/validetta.css" rel="stylesheet" >

  <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300,200,100' rel='stylesheet' type='text/css'>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="#menu-toggle" class="btn navbar-btn" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
        <img src="images/testing.png" alt="project logo" class="logo">
      </div>
    </div>
  </nav>


  <div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
      <ul class="sidebar-nav">
        <li class="sidebar-brand">
          <br>
        </li>
        <li>
          <a href="#">
            <span data-placement="right" data-toggle="tooltip" title="Home" class="glyphicon glyphicon-home"></span>
          </a>
        </li>
        <li>
          <a href="#"><span data-placement="right" data-toggle="tooltip" title="Dashboard" class="glyphicon glyphicon-dashboard"></span></a>
        </li>
        <li>
          <a href="#"><span data-placement="right" data-toggle="tooltip" title="Events" class="glyphicon glyphicon-calendar"></span></a>
        </li>
        <li>
          <a href="#"><span data-placement="right" data-toggle="tooltip" title="About" class="glyphicon glyphicon-info-sign"></span></a>
        </li>
        <li>
          <a href="#"><span data-placement="right" data-toggle="tooltip" title="Contact" class="glyphicon glyphicon-comment"></span></a>
        </li>
      </ul>
    </div>
      <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container-fluid hero-container ">
        <div class="row">
          <div class="col-md-12">
            <div class="hero">
              <div class="hero-inner">
                <h1>Welcome to an awesome adventure.</h1>
                <br>
                <h2>Register today for the time of your life.</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <form class="registration-form" role="form" method="post" action="index.php">
              <h3>Registration Form</h3>
              <p>Give us your information to sign up for this awesome event. We will get in touch with you shortly to approve your application.</p>
              <hr>
              <div class="form-group">
                <label for="fullName">Full name*</label>
                <input type="text" class="form-control" id="fullName" name="fullName" value="<?php echo htmlspecialchars($_POST['fullName']); ?>" placeholder="ie: John Smith">
                <?php echo "<p class='text-danger'>$errName</p>";?>
              </div>
              <div class="form-group">
                <label for="email">Email address*</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>" placeholder="ie: jsmith@example.com">
                <?php echo "<p class='text-danger'>$errEmail</p>";?>
              </div>
              <div class="form-group">
                <label for="addressLine1">Address Line 1</label>
                <input type="text" class="form-control" id="addressLine2" name="addressLine2" value="<?php echo htmlspecialchars($_POST['addressLine1']); ?>" placeholder="ie: 123 Some Street">
              </div>
              <div class="form-group">
                <label for="addressLine2">Address Line 2</label>
                <input type="text" class="form-control" id="addressLine2" name="addressLine2" value="<?php echo htmlspecialchars($_POST['addressLine2']); ?>" placeholder="ie: Unit 456">
              </div>
              <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($_POST['city']); ?>" placeholder="ie: Someville">
              </div>
              <div class="form-group">
                <label for="country">Country</label>
                <select name="country" id="country" value="" class="form-control">
                </select>
              </div>
              <div class="form-group">
                <label for="state">State/Province</label>
                <select name="state" id="state" value="" class="form-control">
                </select>
              </div>
              <div class="form-group" id="postalCodeBox">
                <label for="postalCode">Postal Code</label>
                <input type="text" class="form-control" id="postalCode" name="postalCode" value="<?php echo htmlspecialchars($_POST['postalCode']); ?>" placeholder="ie: A1B2C3 (NO SPACES)">
              </div>
              <div class="form-group">
                <label for="telephone">Phone Number</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($_POST['telephone']); ?>" placeholder="ie: (555) 555-5555">
              </div>
              <input id="submit" name="submit" type="submit" value="Send" class="btn btn-default">
              <br>
              <?php echo "<p class='text-danger'>$errPostalCode</p>";?>
              <?php echo $result; ?>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer>
    © Copyright Emily Wyss 2015
  </footer>


  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="js/country.js"></script>
  <script type="text/javascript" src="js/validetta.js"></script>

  <!-- Menu Toggle Script -->
  <script>
  populateCountries("country", "state");

  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
  </script>

</body>

</html>
