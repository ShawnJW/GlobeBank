<?php require_once('../../../private/initialize.php'); ?>

<?php require_login();?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : 1;
$id = $_GET['id'] ?? '1';

$page = find_page_by_id($id);

if(isset($_SESSION['page_created'])){
	echo $_SESSION['page_created'] . ' Was created';
	unset($_SESSION['page_created']);
}if(isset($_SESSION['page_updated'])){
	echo $_SESSION['page_updated'] . ' Was updated';
	unset($_SESSION['page_updated']);
}

?>

<?php $page_title = 'Show Page'; ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
	<a href="<?php echo url_for('/staff/pages/index.php'); ?>">&laquo; Back to List</a>

	<div class="subject show">

	
		<h1>Page: <?php echo h($page['menu_name']); ?></h1>

		<div class="attributes">
			<dl>
				<dt>Menu Name</dt>
				<dd><?php echo h($page['menu_name']); ?></dd>
			</dl>
			<dl>
				<dt>Position</dt>
				<dd><?php echo h($page['position']); ?></dd>
			</dl>
			<dl>
				<dt>Visible</dt>
				<dd><?php echo $page['visible'] == '1' ? 'true' : 'false'; ?></dd>
			</dl>
			<dl>
				<dt>Preview</dt>
				<dd><button><a href="<?php echo url_for('/index.php?id=' . h(u($page['id'])) . '&preview=true'); ?>" target="_blank">Preview</a></button> </dd>
			</dl>
		</div>
	
	</div>
</div>

<?php echo 'Page ID: ' . h($id);

 ?>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
