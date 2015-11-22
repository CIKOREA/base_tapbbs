<?php echo lang('admin_arrangefiles_msg'); ?>

<br />
<br />

<?php
	if(count($delete_files_result) > 0)
	{
		foreach($delete_files_result as $k=>$v)
		{
			?>
<?php echo $v['filename']; ?> (<?php echo byte_format($v['filesize']); ?>)<br />
		<?php
		}
	}
	else
	{
		echo lang('none');
	}
?>

<br />

Total : <?php echo byte_format($delete_filesize_sum); ?>