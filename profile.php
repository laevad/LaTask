<?php require_once 'initialize.php' ?>
<?php login(); ?>
<?php include 'shared/header.php' ?>
<?php $id = $_GET['id'];
if(is_post_request()) {
	$user = [];
	$user['id'] = $id;
	$user['username'] = $_POST['username'] ?? '';
	$user['contact'] = $_POST['contact'] ?? '';
	$user['address'] = $_POST['address'] ?? '';
	$user['password'] = $_POST['password'] ?? '';
	$user['confirm_password'] = $_POST['confirm_password'] ?? '';
	$result = update_user($user);
	if($result === true) {
    $_SESSION['message'] = 'User updated.';
    redirect_to(url_for('profile.php?id=' . $id));
  } else {
    $errors = $result;
  }
} else {
  $user = find_user_by_id($id);
}
?>
<div class=" container">
    <a class="btn btn-secondary btn-outline-warning mt-3 ml-3 mb-3" href="<?php echo url_for('index.php'); ?>" >&laquo; Back to Homepage</a>
    <h1 class="text-center text-secondary font-weight-bolder">Edit Profile</h1>
	 <?php echo display_errors($errors); ?>
	 <?php echo display_session_message() ?>
    <form class="mt-5" method="post" action="<?php echo url_for('profile.php?id=' . h(u($id))); ?>" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <!--<label for="username">Username</label>-->
                <input type="text" required class="form-control" id="username" name="username" value="<?php echo h($user['username']); ?>"  placeholder="Enter Username">
            </div>
            <div class="form-group">
                <!--<label for="contact">Contact</label>-->
                <input type="number" required class="form-control" id="contact" name="contact" value="<?php echo h($user['contact']); ?>"  placeholder="Enter Contact">
            </div>
            <div class="form-group">
                <!--<label for="address">Address</label>-->
                <input type="text" required class="form-control" id="address" name="address" value="<?php echo h($user['address']); ?>"  placeholder="Enter Address">
            </div>
			 <div class="form-group">
                <!--<label for="password">Password</label>-->
                <input type="password" class="form-control" id="password" name="password"  placeholder="Enter New Password">
            </div>
			 <div class="form-group">
                <!--<label for="confirm_password">Confirm Password</label>-->
                <input type="password" class="form-control" id="confirm_password" name="confirm_password"  placeholder="Confirm New Password">
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success w-50" name="submit" style="font-size: 16px; font-weight: bold">SUBMIT</button>
        </div>
    </form>
</div>
<?php include 'shared/footer.php' ?>
