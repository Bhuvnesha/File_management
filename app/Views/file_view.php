<?php 

$session = \Config\Services::session();	
if($session->getFlashdata()){ ?>
	<?php echo $session->getFlashdata('message'); ?>
<?php } ?>

<h2>Files List</h2>

<form action="<?= site_url('filemanager/upload') ?>" method="post" enctype="multipart/form-data">
    <input type="file" name="userfile" required>
    <button type="submit">Upload</button>
</form>
<a href="<?php echo site_url('filemanager/zipBackup'); ?>">create zip file</a> |
<a href="<?php echo site_url('filemanager/analytics'); ?>">Analytics</a>
<hr>

<table border="1">
	<thead>
		<tr>
			<th>sl no</th>
			<th>File Name</th>
			<th>File Size</th>
			<th>Created Date</th>
			<th>Action</th>
		</tr>
	</thead>	
	<tbody>
		<?php foreach ($files as $file) { 
			$count = 1;
		?>
		<tr>
			<td><?php echo $count++;  ?></td>
			<td><?php echo $file['name']  ?></td>
			<td><?php echo $file['size'];  ?></td>
			<td><?php echo date("Y-M-d H:i:s",$file['date'])  ?></td>
			<td>
				<?php $file_name = $file['name']; ?>
				<a href = <?php echo base_url('filemanager/delete/'.$file_name) ?> >DELETE</a> |
				<a href = <?php echo base_url('filemanager/download/'.$file_name) ?> >Download</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>

	
</table>