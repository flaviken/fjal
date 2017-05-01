<?php 

	/**
	*	Plugin Name: echoStats
	*	Plugin URI: http://ondrejbelza.cz/subdom/xxx_honzik69_xxx/
	*	Description: Zobrazí statistiky stránky
	*	Version: 0.1a
	*	Author: Jan Valeš
	*	Author URI: http://ondrejbelza.cz/subdom/xxx_honzik69_xxx/
	* 	License: GPL
	*/

	ob_start(); 
    session_start();

	global $db;
	global $wpdb;

	function statsPage() {
    	add_menu_page('Statistics', 'Statistics', 'administrator', 'statistics', 'stats', 'dashicons-chart-bar');
	}

	function statsSubPage() {
		add_submenu_page( 'statistics', 'Trash Settings', 'Trash Settings', 'administrator', 'trash', 'trash');
	}
	
	register_activation_hook(__FILE__, 'activation');


	function activation() {
		$time= $wpdb->get_var( "SELECT day FROM wp_del" );
	    if (! wp_next_scheduled ( 'dailyDel' )) {
		wp_schedule_event(time(), $time, 'dailyDel');
	    }
	}

	add_action('dailyDel', 'doDaily');

	// Denní funkce
	function doDaily() {
		global $wpdb;
		$limit= $wpdb->get_var( "SELECT count FROM wp_del");
		$count = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}posts WHERE post_type = 'revision'");
		if($count > $limit) {
			$wpdb->query('DELETE FROM wp_posts WHERE post_type = "revision" LIMIT '.$limit.'');
		}
		$wpdb->query('DELETE FROM wp_posts WHERE post_status = "trash"');
	}

	add_action( 'admin_menu', 'statsPage');
	add_action( 'admin_menu', 'statsSubPage');

	function stats() {
        echo "<style>.users{min-height:200px;width:100%;margin:0 auto}
        .card{background:#fff;border-radius:2px;display:inline-block;height:100px;margin-right:1rem;position:relative;width:300px;float:left}
        .card-1{box-shadow:0 1px 3px rgba(0,0,0,0.12),0 1px 2px rgba(0,0,0,0.24);transition:all .3s cubic-bezier(.25,.8,.25,1)}
        .card-1:hover{box-shadow:0 14px 28px rgba(0,0,0,0.25),0 10px 10px rgba(0,0,0,0.22)}</style>";
		global $wpdb;
		global $db;
		$sql = $db->prepare('SELECT * FROM wp_users ORDER BY ID DESC');
		$sql->execute();

		$st = array();
		$st['prispevky'] = wp_count_posts('post')->publish;
		$st['uzivatele'] = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}users");
		echo "<p><b>Celkový příspěvků na stránce: <span style='color: red;'>".$st['prispevky']."</span></b></p>";
		echo "<p><b>Počet registrovaných uživatelů: <span style='color: red;'>".$st['uzivatele']."</span></b></p>";

		echo "<b>Registrovaní uživatelé:</b> <br><br>";
		echo "<div class='users'>";		
		while($data = $sql->fetch()) {
			echo "<div class='card card-1'>";
			echo $data['display_name']." | <i style='color: red;'> Registrovaný od: ".$data["user_registered"]."</i><br>";
			$user = $data['ID'];

			$sql1 = $db->prepare('SELECT * FROM wp_posts WHERE post_author = :post_author AND post_type = :post_type');
			$sql1->execute(array(':post_author' => $user, ':post_type' => "post"));
			echo "Publikované příspěvky:<br>";
			$info = $sql1->rowCount();
			echo "<p><b>".$info."</b></p><br>";
			echo "</div>";
		}
		echo "</div>";
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
        
        /*require_once('geoplugin.class.php');
        $geoplugin = new geoPlugin();
        $geoplugin->locate();

        echo "Geolocation results for {$geoplugin->ip}: <br />\n".
            "City: {$geoplugin->city} <br />\n".
            "Region: {$geoplugin->region} <br />\n".
            "Area Code: {$geoplugin->areaCode} <br />\n".
            "DMA Code: {$geoplugin->dmaCode} <br />\n".
            "Country Name: {$geoplugin->countryName} <br />\n".
            "Country Code: {$geoplugin->countryCode} <br />\n".
            "Longitude: {$geoplugin->longitude} <br />\n".
            "Latitude: {$geoplugin->latitude} <br />\n".
        "Currency Code: {$geoplugin->currencyCode} <br />\n".
        "Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
        "Exchange Rate: {$geoplugin->currencyConverter} <br />\n";*/
    }
?>