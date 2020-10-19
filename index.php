<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>KMIT ELMS</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
	<link href="img/favicon.png" rel="icon">
	<link href="img/apple-touch-icon.png" rel="apple-touch-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="headerfile.css"/>
	<style>
		
	</style>
 <script>
function myFunction() {
$("welcome").show();
});
</script>
</head>


<body onload="myFunction()">

  <!--==========================
  Header
  ============================-->
	<header>
		<?php
		require_once('header.php');
		?>
	</header>
	<!--==========================
      Employee Section
    ============================-->
	<div id="employee" class="container text-center">
		
		<h1 style="font-family:Constantia;font-weight:bold;color:#2F4F4F;">Employee Leave Management System </h1>
        <div class="card card-container">
		<?php
		if(isset($_SESSION['error']))
		{
			echo '<p id="profile-name" class="profile-name-card">'.$_SESSION["error"].'</p>';
			session_destroy();
		}
		        ?> 
		<img id="profile-img" class="profile-img-card" src="welcome.jpg" />
           
            <form class="form-signin" action="sample.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="username" name="username" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <input type="submit" name="signin" value="Sign in" class="btn btn-lg btn-primary btn-block btn-signin">
            </form><!-- /form -->
			<a href="addemployee.php" class="forgot-password"> New Employee ??</a>&nbsp;
			<a href="forgot-password.php" class="forgot-password"> Forgot Password</a>
        </div><!-- /card-container -->
    </div>


    <!--==========================
      AdminSection
    ============================-->
	
<div id="contact" class="container">
  <h2 class="text-center" style="font-family:Garamond;color:#2F4F4F;">CONTACT US</h2>
  <p class="text-center" style="font-family:Courier;color:#44617E;">we love to hear from you</p>
<br>
  <div class="row">
    <div class="col-md-4">
      <p><b>Address</b></p>
      <p><span class="glyphicon glyphicon-map-marker"></span>3-5-1026</p>
	  <p><span class="glyphicon glyphicon-map-marker"></span>Narayanaguda, Hyderbad-29</p>
      <p><span class="glyphicon glyphicon-phone"></span>Phone: 040-26261407 </p>
      <p><span class="glyphicon glyphicon-envelope"></span>Email: info@kmit.in</p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <button class="btn pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
	 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3807.3038821913665!2d78.48784931418767!3d17.397198307102848!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb99c44533324f%3A0x8aa5456a7d836bb5!2sKeshav%20Memorial%20Institute%20Of%20Technology!5e0!3m2!1sen!2sin!4v1593049485138!5m2!1sen!2sin" width="950" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
  <br>
  
  
<!-- Footer -->
		<?php
		require_once('footer.php');
		?>
</body>
</html>
