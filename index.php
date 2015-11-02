<!--Could pull this into it's own php page to run functionality, but for 1 page, this suffices-->
<?php

  if (isset($_POST["submit"])) {
    /*-- Gather data entered into form and store it into variables --*/
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = $_POST['addressLine2'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $postalCode = $_POST['postalCode'];
    $telephone = ($_POST['telephone']);

    /*-- Stuff for emailing form --*/
    $from = 'Code Test Form';
    $to = 'emilywyss@gmail.com';
    $subject = 'New submission to code test';
    $body = 'From: $fullName\n E-mail: $email\n Address: $addressLine1 $addressLine2\n $city $state $postalCode\n Telephone: $telephone';

    /*-- Throw errors if required field are not present or valid --*/
    if (!$fullName) {
      $errName = 'Oopsie Daisy, you did not enter your name!';
    }

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errEmail = 'Yoohoo, you did not enter a valid email. Give it another try.';
    }

    /*-- Check for valid canadian postal code IF country selected is Canada --*/
    function validateCanadaPC($postalCode) {
     if(preg_match("/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[' ']{1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i",$postalCode))
        return true;
     else
        return false;
    }

    if (($country == 'Canada') && (validateCanadaPC($postalCode) !== true)) {
      $errPostalCode = 'Please enter a valid Canadian postal code!';
    }

    /*-- Send Mail and success message --*/
    if (!$errName && !$errEmail && !$errPostalCode) {
      if (mail ($to, $subject, $body, $from)) {
        $result='<div class="alert alert-success">Registration submitted. Thanks for your interest. I will be in touch shortly to confirm your spot!</div>';
      } else {
        $result='<div class="alert alert-danger">Whoops, the computer gremlin ate your submission and it failed to make it to me. You should try again later.</div>';
      }
    }

  }/*--End opening if--*/
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

    <link href='https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300,200,100' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

    <!--Navigation header-->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a href="#menu-toggle" class="btn navbar-btn" id="menu-toggle"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
          <img src="images/testing.png" alt="project logo" class="logo">
        </div>
      </div>
    </nav>

    <!-- Wrap sidebar and content in a wrapper -->
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
              <form class="registration-form" role="form" method="post" action="index.php" name="registrationForm">
                <h3>Registration Form</h3>
                <p>Give us your information to sign up for this awesome event. We will get in touch with you shortly to approve your application.</p>
                <p>Fields marked with an asterix (*) are mandatory</p>
                <hr>
                <?php echo $result; ?>
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
                  <select name="country" id="country" class="form-control">
                    <?php
                      $countries = array(
                      "blank" => "Select your Country",
                      "AF" => "Afghanistan",
                      "AX" => "Åland Islands",
                      "AL" => "Albania",
                      "DZ" => "Algeria",
                      "AS" => "American Samoa",
                      "AD" => "Andorra",
                      "AO" => "Angola",
                      "AI" => "Anguilla",
                      "AQ" => "Antarctica",
                      "AG" => "Antigua and Barbuda",
                      "AR" => "Argentina",
                      "AM" => "Armenia",
                      "AW" => "Aruba",
                      "AU" => "Australia",
                      "AT" => "Austria",
                      "AZ" => "Azerbaijan",
                      "BS" => "Bahamas",
                      "BH" => "Bahrain",
                      "BD" => "Bangladesh",
                      "BB" => "Barbados",
                      "BY" => "Belarus",
                      "BE" => "Belgium",
                      "BZ" => "Belize",
                      "BJ" => "Benin",
                      "BM" => "Bermuda",
                      "BT" => "Bhutan",
                      "BO" => "Bolivia",
                      "BA" => "Bosnia and Herzegovina",
                      "BW" => "Botswana",
                      "BV" => "Bouvet Island",
                      "BR" => "Brazil",
                      "IO" => "British Indian Ocean Territory",
                      "BN" => "Brunei Darussalam",
                      "BG" => "Bulgaria",
                      "BF" => "Burkina Faso",
                      "BI" => "Burundi",
                      "KH" => "Cambodia",
                      "CM" => "Cameroon",
                      "CA" => "Canada",
                      "CV" => "Cape Verde",
                      "KY" => "Cayman Islands",
                      "CF" => "Central African Republic",
                      "TD" => "Chad",
                      "CL" => "Chile",
                      "CN" => "China",
                      "CX" => "Christmas Island",
                      "CC" => "Cocos (Keeling) Islands",
                      "CO" => "Colombia",
                      "KM" => "Comoros",
                      "CG" => "Congo",
                      "CD" => "Congo, The Democratic Republic of The",
                      "CK" => "Cook Islands",
                      "CR" => "Costa Rica",
                      "CI" => "Cote D'ivoire",
                      "HR" => "Croatia",
                      "CU" => "Cuba",
                      "CY" => "Cyprus",
                      "CZ" => "Czech Republic",
                      "DK" => "Denmark",
                      "DJ" => "Djibouti",
                      "DM" => "Dominica",
                      "DO" => "Dominican Republic",
                      "EC" => "Ecuador",
                      "EG" => "Egypt",
                      "SV" => "El Salvador",
                      "GQ" => "Equatorial Guinea",
                      "ER" => "Eritrea",
                      "EE" => "Estonia",
                      "ET" => "Ethiopia",
                      "FK" => "Falkland Islands (Malvinas)",
                      "FO" => "Faroe Islands",
                      "FJ" => "Fiji",
                      "FI" => "Finland",
                      "FR" => "France",
                      "GF" => "French Guiana",
                      "PF" => "French Polynesia",
                      "TF" => "French Southern Territories",
                      "GA" => "Gabon",
                      "GM" => "Gambia",
                      "GE" => "Georgia",
                      "DE" => "Germany",
                      "GH" => "Ghana",
                      "GI" => "Gibraltar",
                      "GR" => "Greece",
                      "GL" => "Greenland",
                      "GD" => "Grenada",
                      "GP" => "Guadeloupe",
                      "GU" => "Guam",
                      "GT" => "Guatemala",
                      "GG" => "Guernsey",
                      "GN" => "Guinea",
                      "GW" => "Guinea-bissau",
                      "GY" => "Guyana",
                      "HT" => "Haiti",
                      "HM" => "Heard Island and Mcdonald Islands",
                      "VA" => "Holy See (Vatican City State)",
                      "HN" => "Honduras",
                      "HK" => "Hong Kong",
                      "HU" => "Hungary",
                      "IS" => "Iceland",
                      "IN" => "India",
                      "ID" => "Indonesia",
                      "IR" => "Iran, Islamic Republic of",
                      "IQ" => "Iraq",
                      "IE" => "Ireland",
                      "IM" => "Isle of Man",
                      "IL" => "Israel",
                      "IT" => "Italy",
                      "JM" => "Jamaica",
                      "JP" => "Japan",
                      "JE" => "Jersey",
                      "JO" => "Jordan",
                      "KZ" => "Kazakhstan",
                      "KE" => "Kenya",
                      "KI" => "Kiribati",
                      "KP" => "Korea, Democratic People's Republic of",
                      "KR" => "Korea, Republic of",
                      "KW" => "Kuwait",
                      "KG" => "Kyrgyzstan",
                      "LA" => "Lao People's Democratic Republic",
                      "LV" => "Latvia",
                      "LB" => "Lebanon",
                      "LS" => "Lesotho",
                      "LR" => "Liberia",
                      "LY" => "Libyan Arab Jamahiriya",
                      "LI" => "Liechtenstein",
                      "LT" => "Lithuania",
                      "LU" => "Luxembourg",
                      "MO" => "Macao",
                      "MK" => "Macedonia, The Former Yugoslav Republic of",
                      "MG" => "Madagascar",
                      "MW" => "Malawi",
                      "MY" => "Malaysia",
                      "MV" => "Maldives",
                      "ML" => "Mali",
                      "MT" => "Malta",
                      "MH" => "Marshall Islands",
                      "MQ" => "Martinique",
                      "MR" => "Mauritania",
                      "MU" => "Mauritius",
                      "YT" => "Mayotte",
                      "MX" => "Mexico",
                      "FM" => "Micronesia, Federated States of",
                      "MD" => "Moldova, Republic of",
                      "MC" => "Monaco",
                      "MN" => "Mongolia",
                      "ME" => "Montenegro",
                      "MS" => "Montserrat",
                      "MA" => "Morocco",
                      "MZ" => "Mozambique",
                      "MM" => "Myanmar",
                      "NA" => "Namibia",
                      "NR" => "Nauru",
                      "NP" => "Nepal",
                      "NL" => "Netherlands",
                      "AN" => "Netherlands Antilles",
                      "NC" => "New Caledonia",
                      "NZ" => "New Zealand",
                      "NI" => "Nicaragua",
                      "NE" => "Niger",
                      "NG" => "Nigeria",
                      "NU" => "Niue",
                      "NF" => "Norfolk Island",
                      "MP" => "Northern Mariana Islands",
                      "NO" => "Norway",
                      "OM" => "Oman",
                      "PK" => "Pakistan",
                      "PW" => "Palau",
                      "PS" => "Palestinian Territory, Occupied",
                      "PA" => "Panama",
                      "PG" => "Papua New Guinea",
                      "PY" => "Paraguay",
                      "PE" => "Peru",
                      "PH" => "Philippines",
                      "PN" => "Pitcairn",
                      "PL" => "Poland",
                      "PT" => "Portugal",
                      "PR" => "Puerto Rico",
                      "QA" => "Qatar",
                      "RE" => "Reunion",
                      "RO" => "Romania",
                      "RU" => "Russian Federation",
                      "RW" => "Rwanda",
                      "SH" => "Saint Helena",
                      "KN" => "Saint Kitts and Nevis",
                      "LC" => "Saint Lucia",
                      "PM" => "Saint Pierre and Miquelon",
                      "VC" => "Saint Vincent and The Grenadines",
                      "WS" => "Samoa",
                      "SM" => "San Marino",
                      "ST" => "Sao Tome and Principe",
                      "SA" => "Saudi Arabia",
                      "SN" => "Senegal",
                      "RS" => "Serbia",
                      "SC" => "Seychelles",
                      "SL" => "Sierra Leone",
                      "SG" => "Singapore",
                      "SK" => "Slovakia",
                      "SI" => "Slovenia",
                      "SB" => "Solomon Islands",
                      "SO" => "Somalia",
                      "ZA" => "South Africa",
                      "GS" => "South Georgia and The South Sandwich Islands",
                      "ES" => "Spain",
                      "LK" => "Sri Lanka",
                      "SD" => "Sudan",
                      "SR" => "Suriname",
                      "SJ" => "Svalbard and Jan Mayen",
                      "SZ" => "Swaziland",
                      "SE" => "Sweden",
                      "CH" => "Switzerland",
                      "SY" => "Syrian Arab Republic",
                      "TW" => "Taiwan, Province of China",
                      "TJ" => "Tajikistan",
                      "TZ" => "Tanzania, United Republic of",
                      "TH" => "Thailand",
                      "TL" => "Timor-leste",
                      "TG" => "Togo",
                      "TK" => "Tokelau",
                      "TO" => "Tonga",
                      "TT" => "Trinidad and Tobago",
                      "TN" => "Tunisia",
                      "TR" => "Turkey",
                      "TM" => "Turkmenistan",
                      "TC" => "Turks and Caicos Islands",
                      "TV" => "Tuvalu",
                      "UG" => "Uganda",
                      "UA" => "Ukraine",
                      "AE" => "United Arab Emirates",
                      "GB" => "United Kingdom",
                      "US" => "United States",
                      "UM" => "United States Minor Outlying Islands",
                      "UY" => "Uruguay",
                      "UZ" => "Uzbekistan",
                      "VU" => "Vanuatu",
                      "VE" => "Venezuela",
                      "VN" => "Viet Nam",
                      "VG" => "Virgin Islands, British",
                      "VI" => "Virgin Islands, U.S.",
                      "WF" => "Wallis and Futuna",
                      "EH" => "Western Sahara",
                      "YE" => "Yemen",
                      "ZM" => "Zambia",
                      "ZW" => "Zimbabwe"
                      );
                      foreach ($countries as $code => $label) {
                        echo '<option value="' . $label . '"';

                        if(isset($country) && $country=="$label"){ 
                          echo 'selected';
                        }
                        echo '>' . $label . '</option>';
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="state">Province or State</label>
                  <input type="text" class="form-control" id="state" name="state" value="<?php echo htmlspecialchars($_POST['state']); ?>" placeholder="ie: New York or Ontario">
                </div>
                <div class="form-group" id="postalCodeBox">
                  <label for="postalCode">Postal Code</label>
                  <input type="text" class="form-control" id="postalCode" name="postalCode" value="<?php echo htmlspecialchars($_POST['postalCode']); ?>" placeholder="ie: A1B 2C3">
                  <p>Only required for Canadian Addresses</p>
                  <?php echo "<p class='text-danger'>$errPostalCode</p>";?>
                </div>
                <div class="form-group">
                  <label for="telephone">Phone Number</label>
                  <input type="tel" class="form-control" id="telephone" name="telephone" value="<?php echo htmlspecialchars($_POST['telephone']); ?>" placeholder="ie: (555) 555-5555">
                </div>
                <input id="submit" name="submit" type="submit" value="Send" class="btn btn-default">
              </form>
            </div>
          </div>
        </div>
      </div>

    </div> <!--Close wrapper-->

    <footer>
      © Copyright Emily Wyss 2015
    </footer>

    <!-- include jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!--Custom Javascript-->
    <script src="js/custom.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    </script>

  </body>

</html>
