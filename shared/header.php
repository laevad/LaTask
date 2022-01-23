<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo url_for('assets/bootstrap%20files/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo url_for('assets/css/pBox.css')?>">
    <script src="<?php echo url_for('assets/bootstrap%20files/js/jquery-3.3.1.min.js') ?>"></script>
    <title>Document</title>
</head>
<body>
<div class="container-fluid jumbotron-fluid ">
    <!--Header-->
    <nav class="navbar  navbar-dark bg-dark font-weight-bold ">
        <div class="container ">
            <span><a class="navbar-brand mx-auto" href="<?php echo url_for('index.php')?>">Product Page</a></span>
         <?php if(!is_logged_in()) { ?>
            <form class="form-inline">
            <a type="button" class=" btn btn-outline-warning text-center"  href="<?php echo url_for('register.php')?>">Register</a>
            <a type="button" class=" btn btn-outline-primary text-center ml-2"  href="<?php echo url_for('login.php')?>">Login</a>
         </form>
          <?php }else{ ?>
		 <div class="dropdown">
		  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			User: <?php echo $_SESSION['username'] ?>
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
			<a class="dropdown-item btn-secondary" type="button" href="<?php echo url_for('profile.php?id='.h(u($_SESSION['user_id'])))?>">Profile</a>
			 <a type="button" class="dropdown-item btn-secondary"  href="<?php echo url_for('logout.php')?>">Logout</a>
		  </div>
		</div>
            <?php  } ?>
        </div>
    </nav>
    <!--Header-->
