<style>
  body {
    font: 400 15px/1.8 Lato, sans-serif;
    color: #777;
	background: linear-gradient(0deg, rgba(202, 207, 210,0.8687850140056023) 0%, rgba(166, 172, 175 ,0.8211659663865546) 100%);
  }
  h3, h4 {
    margin: 10px 0 30px 0;   
    font-size: 20px;
    color: #111;
  }
  .container {
    padding: 80px 120px;
  }
  .person {
    border: 10px solid transparent;
    margin-bottom: 25px;
    width: 80%;
    height: 80%;
    opacity: 0.7;
  }
  .person:hover {
    border-color: #f1f1f1;
  }
  .carousel-inner img {
    -webkit-filter: grayscale(90%);
    filter: grayscale(90%); /* make all photos black and white */ 
    width: 100%; /* Set width to 100% */
    margin: auto;
  }
  .carousel-caption h3 {
    color: #fff !important;
  }
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; /* Hide the carousel text when the screen is less than 600 pixels wide */
    }
  }
  .bg-1 {
    background: #2d2d30;
    color: #bdbdbd;
  }
  .bg-1 h3 {color: #fff;}
  .bg-1 p {font-style: italic;}
  .list-group-item:first-child {
    border-top-right-radius: 0;
    border-top-left-radius: 0;
  }
  .list-group-item:last-child {
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }
  .thumbnail {
    padding: 0 0 15px 0;
    border: none;
    border-radius: 0;
  }
  .thumbnail p {
    margin-top: 15px;
    color: #555;
  }
  .btn {
    padding: 10px 20px;
    background-color: #333;
    color: #f1f1f1;
    border-radius: 0;
    transition: .2s;
  }
  .btn:hover, .btn:focus {
    border: 1px solid #333;
    background-color: #fff;
    color: #000;
  }
  .modal-header, h4, .close {
    background-color: #333;
    color: #fff !important;
    text-align: center;
    font-size: 30px;
  }
  .modal-header, .modal-body {
    padding: 40px 50px;
  }
  .nav-tabs li a {
    color: #777;
  }
  #googleMap {
    width: 100%;
    height: 400px;
    -webkit-filter: grayscale(100%);
    filter: grayscale(100%);
  }  
  .navbar {
    font-family: Montserrat, sans-serif;
    margin-bottom: 0;
    background-color: #2d2d30;
    border: 0;
    font-size: 11px !important;
    letter-spacing: 0px;
    opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand { 
    color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
    color: #fff !important;
  }
  .navbar-nav li.active a {
    color: #fff !important;
    background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
  }
  .open .dropdown-toggle {
    color: #fff;
    background-color: #555 !important;
  }
  .dropdown-menu li a {
    color: #000 !important;
  }
  .dropdown-menu li a:hover {
    background-color: #008080 !important;
  }
  footer {
    background-color: #2d2d30;
    color: #f5f5f5;
    padding: 32px;
  }
  footer a {
    color: #f5f5f5;
  }
  footer a:hover {
    color: #777;
    text-decoration: none;
  }  
  .form-control {
    border-radius: 0;
  }
  textarea {
    resize: none;
  }
 .profile-name-card {
    font-size: 16px;
    font-weight: bold;
	color:white;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}

.reauth-email {
    display: block;
    color: #404040;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #inputEmail,
.form-signin #inputPassword {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}

.btn.btn-signin {
    /*background-color: #4d90fe; */
    background-color: rgb(104, 145, 162);
    /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
    padding: 0px;
    font-weight: 700;
    font-size: 14px;
    height: 36px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    border: none;
    -o-transition: all 0.218s;
    -moz-transition: all 0.218s;
    -webkit-transition: all 0.218s;
    transition: all 0.218s;
}

.btn.btn-signin:hover,
.btn.btn-signin:active,
.btn.btn-signin:focus {
    background-color: rgb(12, 97, 33);
}

.forgot-password {
    color: rgb(104, 145, 162);
}

.forgot-password:hover,
.forgot-password:active,
.forgot-password:focus{
    color: rgb(12, 97, 33);
}
.card-container.card {
    max-width: 450px;
    padding: 40px 40px;
	background: linear-gradient(180deg, rgba(222,228,235,1) 0%, rgba(69,174,207,1) 100%);
}
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.profile-img-card {
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <img  src="logo.jpeg" style="padding: 2px;" height=50px align ="center"/>
    </div>
	<div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
          <li class="menu-active"><a href="changepassword.php">HOME</a></li>
          <li><a href="changepassword.php#about">CHANGE PASSWORD</a></li>
          <li ><a href="ViewEmployees.php">SEARCH</a></li>
		  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">LEAVE HISTORY 
		  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="viewclccl.php">VIEW CCL HISTORY</a></li>
			  <li><a href="viewcl.php">VIEW CL HISTORY</a></li>
              <li><a href="viewlates.php">VIEW LATES HISTORY</a></li>
			   <li><a href="viewlop.php">VIEW LOP HISTORY</a></li>
			   <li><a href="viewholidays.php">VIEW HOLIDAYS</a></li>
               <li><a href="daywiseleavehistory.php">VIEW  DAY-WISE LEAVES</a></li>
            </ul>
          </li>
		  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">ADD LEAVES
		  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li ><a href="changepassword.php#addemployeecclleaves">ADD CCL</a></li>
			  <li ><a href="addcl.php">ADD CL</a></li>
              <li ><a href="addlates.php">ADD LATES </a></li>
			   <li ><a href="addlop.php">ADD LOP</a></li>
			   <li ><a href="addholidays.php">ADD HOLIDAYS</a></li>
			   <li ><a href="changepassword.php#quarterwiseleaves">ADD LEAVES FOR YEAR</a></li>
			   <li ><a href="#updatemonthlyleaves">UPDATE MONTHLY LEAVES</a></li>
            </ul>
          </li>
		  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">DEPARTMENT
		  <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li ><a href="adddepartment.php">ADD DEPARTMENT</a></li>
              <li ><a href="managedepartments.php">MANAGE DEPARTMENT </a> </li>
			 <li ><a href="adminmanageemployee.php">MANAGE EMPLOYEE </a> </li>
            </ul>
          </li>
		 <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">LEAVE TYPE
		 <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li ><a href="addleavetype.php">ADD LEAVE TYPE</a></li>
              <li ><a href="manageleavetype.php">MANAGE LEAVE TYPE </a></li>
            </ul>
		</li>
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">DOWNLOADS
		<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="monthlyreport.php?month=january">MONTHLY STATEMENT</a></li>
              <li><a href="empreport.php">EMPLOYEE INFORMATION  </a></li>    
            </ul>
          </li>
		  <li ><a href="logout.php">SIGN OUT</a></li>
        </ul>		
	</div>
	</div>
</nav>