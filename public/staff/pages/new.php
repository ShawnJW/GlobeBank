<?php require_once('../../../private/initialize.php'); ?>

<?php require_login();
?>
<?php $page_title = 'Create Subject'; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php 


	if(is_post_request()){

		$page = [];
		$page['menu_name'] = $_POST['menu_name'];
		$page['position'] = $_POST['position'];
		$page['visible'] = $_POST['visible'];
		$page['subject_id'] = $_POST['subject_id'];
		$page['content'] = $_POST['content'];


		$result = create_new_page($page);
		if($result === true) {
		$new_id = mysqli_insert_id($db);
		$page_created = $page['menu_name'] ?? '';
		$_SESSION['page_created'] = $page_created;
		redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
	}else {
		$errors = $result;
	}


	}else {
		$page = [];
		$page['subject_id'] = '';
		$page['menu_name'] = '';
		$page['position'] = '';
		$page['visible'] = '';
		$page['content'] = '';
	}

	$pages_set = find_all_pages();
	$pages_count = mysqli_num_rows($pages_set) + 1;
	mysqli_free_result($pages_set);

	$page['position'] = $pages_count;

?>

<div id="content">
	<a href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to list</a>

	<h1>Create New Page</h1>
	<?php echo display_errors($errors); ?>

	<form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
		<span>Subject ID</span>
		<select name="subject_id">
			<?php
			$subject_set = find_all_subjects();
			while($subject = mysqli_fetch_assoc($subject_set)){
				echo "<option value\"" . h($subject['id']) . "\"";
				if($page["subject_id"] == $subject['id']){
					echo " selected";
				}
				echo ">" . h($subject['menu_name']) . "</option>";
			}
			mysqli_free_result($subject_set);
			?>
		</select><br/>
		<span>Menu Name</span>
		<input type="text" name="menu_name" value="<?php echo h($menu_name); ?>"><br />
		<span>Postion</span>
		   <select name="position">
          <?php
            for($i=1; $i <= $pages_count; $i++) {
              echo "<option value=\"{$i}\"";
              if($page["position"] == $i) {
                echo " selected";
              }
              echo ">{$i}</option>";
            }
          ?>
        </select>
		<br />
		<span>Visible</span>
		<input type="hidden" name="visible" value="0">
		<input type="checkbox" name="visible" value="1"<?php if($visible == "1"){ echo " checked";}?>>
		<br />
		<span>Text Content</span>
		<input type="text" name="content" value="" />
		<br />
		<input type="submit" value="Create Page">
	</form>
	
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>