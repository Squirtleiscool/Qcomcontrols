<?php 
printf(
	'<script>window.location.replace("%1$s");window.location.href = "%1$s";</script>', 
	admin_url('post-new.php?post_type=robo_gallery_table&rsg_gallery_type='.ROBO_GALLERY_TYPE_GRID)
);

echo "";
exit;