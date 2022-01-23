<?php require_once 'initialize.php' ?>
<?php require_login(); ?>
<?php 
if(is_post_request()){
	$subject = [];
	$user['username'] = $_POST['username'] ?? '';
	$user['contact'] = $_POST['contact'] ?? '';
	$user['address'] = $_POST['address'] ?? '';
	$user['password'] = $_POST['password'] ?? '';
	$user['confirm_password'] = $_POST['confirm_password'] ?? '';

	$result = insert_user($user);
	if($result === true) {
		$_SESSION['message'] = 'Successfully created.';
		redirect_to(url_for('register.php'));
	  } else {
		$errors = $result;
	  }
}else {
	$user = [];
	$user["username"] = '';
	$user["contact"] = '';
	$user["address"] = '';
	$user['password'] = '';
	$user['confirm_password'] = '';
  }

?>
<?php include 'shared/header.php' ?>

<div class="pt-5 container">
<h1 class="text-center"> Registration </h1>  
	<div class="container"> 
		<div class="row">
			<div class="col-md-5 mx-auto">
				<div class="card card-body">
				<?php echo display_errors($errors); ?>
				<?php echo display_session_message() ?>
					<form id="submitForm" action="#" method="post" >  
						<div class="form-group required">  
			              	<label for="username"> Username </label>  
			             	<input type="text" class="form-control text-lowercase" id="username"  name="username" value="<?php echo h($user['username']); ?>">  
		               </div>
					   <div class="form-group required">
					       	<label class="d-flex flex-row align-items-center" for="contact">Contact number</label>  
							<input type="number" class="form-control"  id="contact" name="contact" value="<?php echo h($user['contact']); ?>">  
				       </div>
				        <div class="form-group required">
					       	<label class="d-flex flex-row align-items-center" for="contact">Address</label>  
							<input type="text" class="form-control"  id="address" name="address" value="<?php echo h($user['address']); ?>">  
				       </div>				                        
				       <div class="form-group required">
					       	<label class="d-flex flex-row align-items-center" for="password">Password</label>  
							<input type="password" class="form-control"  id="password" name="password" value="">  
				       </div>
				       <div class="form-group required">
					       	<label class="d-flex flex-row align-items-center" for="confirm_password">Confirm Password</label>  
							<input type="password" class="form-control"  id="confirm_password" name="confirm_password" value="">  
				       </div>   
				        <div class="form-group pt-1">  
				      		<button class="btn btn-primary btn-block" type="submit"> Register </button>  
				        </div>  
	               </form> 
	            </div>  
	        </div>  
	    </div>  
	</div>  
</div>  
<?php include 'shared/footer.php' ?>