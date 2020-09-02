<?php require_once('../../../private/initialize.php'); ?>

<?php require_login();?>

<?php $admin_title = 'Create Admin'; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php 


	if(is_post_request()){

		$admin = [];
		$admin['first_name'] = $_POST['first_name'];
		$admin['last_name'] = $_POST['last_name'];
	    $admin['email'] = $_POST['email'] ?? '';
	    $admin['username'] = $_POST['username'] ?? '';
	    $admin['password'] = $_POST['password'] ?? '';
	    $admin['confirm_password'] = $_POST['confirm_password'] ?? '';


		$result = create_new_admin($admin);
		if($result === true) {
		$new_id = mysqli_insert_id($db);
		$admin_created = $admin['username'] ?? '';
		$_SESSION['admin_created'] = $admin_created;
		redirect_to(url_for('/staff/admin/show.php?id=' . $new_id));
	}else {
		$errors = $result;
	}


	}
	else {
	 //  // display the blank form
		$admin = [];
		$admin['first_name'] = '';
		$admin['last_name'] = '';
		$admin['email'] = '';
		$admin['username'] = '';
		$admin['password'] = '';
		$admin['confirm_password'] = '';
	}


	$admins_set = find_all_admins();
	$admins_count = mysqli_num_rows($admins_set) + 1;
	mysqli_free_result($admins_set);

	// $admin['position'] = $admins_count;

?>

<div id="content">
	<a href="<?php echo url_for('/staff/admin/index.php'); ?>">&laquo; Back to list</a>

	<h1>Create New Admin</h1>
	<?php echo display_errors($errors); ?>

	<form action="<?php echo url_for('/staff/admin/new.php'); ?>" method="post">
		<span>First Name</span>
		<dl>
		<dd><input type="text" name="first_name" value="<?php echo h($admin['first_name']); ?>" /></dd></dl>
		<span>Last Name</span>
		<dl>
		<dd><input type="text" name="last_name" value="<?php echo h($admin['last_name']); ?>" /></dd>
		</dl>
		<span>Email</span>
		<dl>
		  <dd><input type="text" name="email" value="<?php echo h($admin['email']); ?>" /></dd>
		</dl>
		<span>Username</span>
		<dl>
		<dd><input type="text" name="username" value="<?php echo h($admin['username']); ?>" /></dd>
		</dl>
		
		<span>Password</span>
		<dl>
		<dd><input type="password" name="password" value="" /></dd>
		</dl>
		<span>Confirm Password</span>
		<dl>
		<dd><input type="password" name="confirm_password" value="" /></dd>
		</dl>
		<p>Passwords should be at least 12 characters and include at least one uppercase letter, number, and symbol<p>
		<input type="submit" value="Create Admin">
	</form>
	
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>