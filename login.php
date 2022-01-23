<?php require_once 'initialize.php' ?>
<?php require_login(); ?>
<?php include 'shared/header.php' ?>
<?php
$errors = [];
$username = '';
$password = '';
if(is_post_request()) {
	$username = $_POST['username'] ?? '';
	$password = $_POST['password'] ?? '';

	// Validations
	if(is_blank($username)) {
		$errors[] = "Username cannot be blank.";
	}
	if(is_blank($password)) {
	$errors[] = "Password cannot be blank.";
	}
	if(empty($errors)) {
		// Using one variable ensures that msg is the same
		$login_failure_msg = "Log in was unsuccessful.";
	
		$user = find_user_by_username($username);
		if($user) {
	
		  if(password_verify($password, $user['password'])) {
			// password matches
			log_in_user($user);
			redirect_to(url_for('index.php'));
		  } else {
			// username found, but password does not match
			$errors[] = $login_failure_msg;
		  }
	
		} else {
		  // no username found
		  $errors[] = $login_failure_msg;
		}
	
	  }

}
?>
<div class="pt-5 container  custom-height">
<h1 class="text-center"> Login </h1>  
	<div class="container">
		<div class="row">
			<div class="col-md-5 mx-auto">
				
				<div class="card card-body">
				<?php echo display_errors($errors); ?>
					<form id="submitForm" action="#" method="post" >  
						<div class="form-group required">  
			              	<label for="username"> Username </label>  
			             	<input type="text" class="form-control text-lowercase" id="username" value="<?php echo h($username); ?>"  name="username" value="">  
		               </div>                      
				       <div class="form-group required">  
					    <label class="d-flex flex-row align-items-center" for="password"> Enter your Password</label>  
						<input type="password" class="form-control"  id="password" name="password" value="">  
				       </div>
				      
				        <div class="form-group pt-1">  
				      		<button class="btn btn-primary btn-block" type="submit"> Log In </button>  
				        </div>  
	               </form> 
	            </div>  
	        </div>  
	    </div>  
	</div>  
</div>  
<?php include 'shared/footer.php' ?>