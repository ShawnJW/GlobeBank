<?php require_once('../../../private/initialize.php'); ?>

<?php 

require_login();

$admin_set = find_all_admins(); 

?>

<?php $admin_title = 'Admins'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

  	<div id="content">
	  <div class="admins listing">
  		<h1>Admins</h1>
  		<div class="actions">
  		<a class="action" href="<?php echo url_for('/staff/admin/new.php'); ?>">Create new admin</a>
	  	</div>

  		<table class="list">
  	  <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
  	    <th>Username</th>
  	    <th>&nbsp;</th>
  	    <th>&nbsp;</th>
        <th>&nbsp;</th>
  	  </tr>
  	  <tr><?php while($admin = mysqli_fetch_assoc($admin_set) ) { ?>
  	  	<td><?php echo h($admin['id']); ?></td>
  	  	<td><?php echo h($admin['first_name']); ?></td>
        <td><?php echo h($admin['last_name']); ?></td>
  	  	<td><?php echo h($admin['email']); ?></td>
  	  	<td><?php echo h($admin['username']); ?></td>
  	  	<td><a class="" href="<?php echo url_for( '/staff/admin/show.php?id=' . h(u($admin['id'])) ); ?>">View</a></td>
  	  	<td><a class="" href="<?php echo url_for('/staff/admin/edit.php?id=' . h(u($admin['id']))); ?>">Edit</a></td>
  	  	<td><a class="" href="<?php echo url_for('/staff/admin/delete.php?id=' . h(u($admin['id']))); ?>">Delete</a></td>
  	  </tr>
  	<?php } ?>
  	</table>
    <?php mysqli_free_result($admin_set);?>
	  	</div>
  	</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
