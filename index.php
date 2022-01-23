<?php require_once 'initialize.php' ?>
<?php include 'shared/header.php' ?>
<?php $get_data = display(); unset($_SESSION['message']); ?>

    <div class="container">
        <?php if(is_logged_in()) { ?>
            <a type="button" class="btn mt-3 mb-3 btn-secondary btn-outline-warning" href="<?php echo url_for('create.php'); ?>">Add Product</a>
        <?php } ?>
		<div class="container">
		  <div class="card-body">
		  <?php if(mysqli_num_rows($get_data) > 0){ ?>
			<div class="pBox">
			<?php while($data = mysqli_fetch_assoc($get_data)) { ?>
				<div class="content" style="background-color: #f8f9fa">
					<?php $filename = "uploads/". $data['image']; ?>
					<img src="<?php echo $filename; ?>">
					<h3><?php echo $data['name'] ?></h3>
					<p  class="light-b" style="margin-bottom: 0;"><?php echo $data['description'] ?></p>
					<h6>₱<?php echo $data['price'] ?></h6>
					<hr style="margin-top: 2px;margin-bottom: 4px;">
					<p class="light-c" style="margin-bottom: 1px;">Address: <span><?php echo $data['address'] ?></span></p>
					<p class="light-c">Contact: <span><?php echo $data['contact'] ?></span></p>
				  </div>
			<?php } ?>
			 </div>
		  <?php }else{ ?>
		  <img src="<?php echo url_for('assets/img/a.svg')?>" alt="No product added">
		   <p>No product added yet</p>
		  <?php } ?>
		  </div>
		</div>
        
    </div>
<?php include 'shared/footer.php' ?>
