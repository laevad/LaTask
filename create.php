<?php require_once 'initialize.php' ?>
<?php login(); ?>
<?php 
if(is_post_request()){
	$item['name'] = $_POST['name'];
	$item['price'] = $_POST['price'];
	$item['description'] = $_POST['description'];
	$item['image'] = $_FILES['file'];
	$item['fileName'] = $_FILES['file']['name'];
    $item['fileTmpName'] = $_FILES['file']['tmp_name'];
    $item['fileSize'] = $_FILES['file']['size'];
    $item['fileError'] = $_FILES['file']['error'];
    $item['fileType'] = $_FILES['file']['type'];
	
	$result = add_product ($item);
	if($result === true) {
		$_SESSION['message'] = 'Successfully created.';
		redirect_to(url_for('index.php'));
	  } else {
		$errors = $result;
	  }
	
}
?>
<?php include 'shared/header.php' ?>
<div class=" container">
    <a class="btn btn-secondary btn-outline-warning mt-3 ml-3 mb-3" href="<?php echo url_for('index.php'); ?>" >&laquo; Back to Homepage</a>
    <h1 class="text-center text-secondary font-weight-bolder">Add Product</h1>
    <form method="post" action="#" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" required class="form-control" id="name" name="name"  placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" required class="form-control" id="price" name="price"  placeholder="Enter Price">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            <input type="file" name="file" class="file" accept="image/*">
            <div class="input-group form-group">
                <input type="text" class="form-control" readonly  placeholder="Upload Image" id="file" name="image">
                <div class="input-group-append">
                    <button type="button" class="browse btn btn-secondary">Browse...</button>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success w-50" name="submit" style="font-size: 16px; font-weight: bold">SUBMIT</button>
        </div>
    </form>
</div>
<?php include 'shared/footer.php' ?>
