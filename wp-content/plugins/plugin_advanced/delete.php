<?php

		header('location: http://ondrejbelza.cz/subdom/xxx_honzik69_xxx/wp-admin/admin.php?page=statistics');
	    $path = "../../../wp-config.php";
	    include_once($path);

		global $wpdb;
		$delete = $_GET['del'];
		if($delete == 'rev') {
			$wpdb->query('DELETE FROM wp_posts WHERE post_type = "revision"');
		} elseif($delete = 'trash') {
			$wpdb->query('DELETE FROM wp_posts WHERE post_status = "trash"');
		}

?>