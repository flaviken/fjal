<?php
	function doDaily() {
		global $wpdb;
		$limit= $wpdb->get_var( "SELECT count FROM wp_del");
		$count = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}posts WHERE post_type = 'revision'");
		if($count > $limit) {
			$wpdb->query('DELETE FROM wp_posts WHERE post_type = "revision" LIMIT '.$limit.'');
		}
		$wpdb->query('DELETE FROM wp_posts WHERE post_status = "trash"');
	}

	function trash() {
		global $wpdb;
		global $db;

		echo 'How often do you want to clear revisions?.
		        <form action="" method="post">
		          <select name="tyden">
		            <option value="Hourly">Hourly</option>
		            <option value="Daily">Daily</option>
		            <option value="Monthly">Monthly</option>
		          </select>
		          <input type="submit" value="Save" name="submit_tyden">
		        </form>';

	    if(isset($_POST["tyden"])) {
	        $wpdb->update( 
	                'wp_del', 
	                array( 
	                    'day' => $_POST["tyden"]), 
	                array( 'id' => 1 ));
	    }

		echo "<br><div class='trash'>";
		echo '<form action="" method="post">
			<label>Revision delete limit</label>
			<input type="number" name="number">
			<input type="submit" value="Submit">
			</form>';
		

		if(isset($_POST["number"])) {
	        $wpdb->update( 
	                'wp_del', 
	                array( 
	                    'count' => $_POST["number"]), 
	                array( 'id' => 1 ));
	    }	

		echo "<a href='http://ondrejbelza.cz/subdom/xxx_honzik69_xxx/wp-content/plugins/plugin_advanced/delete.php?del=rev'>Smazat revize</a><br>";
		echo "<a href='http://ondrejbelza.cz/subdom/xxx_honzik69_xxx/wp-content/plugins/plugin_advanced/delete.php?del=trash'>Vysypat koš</a>";
		echo "</div>";
	}
?>