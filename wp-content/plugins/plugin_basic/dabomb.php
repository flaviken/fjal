<?php
	/**
	*	Plugin Name: Da Bomb
	*	Plugin URI: http://ondrejbelza.cz/subdom/xxx_honzik69_xxx/
	*	Description: Zobrazí statistiky stránky
	*	Version: 0.1a
	*	Author: Jan Valeš
	*	Author URI: http://ondrejbelza.cz/subdom/xxx_honzik69_xxx/
	* 	License: GPL
	*/

	//$myrows = $wpdb->get_results( 'SELECT id, name FROM mytable');

	include "db.php";
	global $db;
	global $wpdb;

	add_action('wp_dashboard_setup', 'zobrazit_widget');

	function zobrazit_widget() {
		wp_add_dashboard_widget("AuthorStats", "Statistika stránky", "zobrazit_obsah");
	}
	function zobrazit_obsah() {
		global $wpdb;
		global $db;
		$sql = $db->prepare('SELECT * FROM wp_users ORDER BY ID DESC');
		$sql->execute();

		$st = array();
		$st['prispevky'] = wp_count_posts('post')->publish;
		$st['uzivatele'] = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}users");
		echo "<p><b>Celkový příspěvků na stránce: ".$st['prispevky']."</b></p>";
		echo "<p><b>Počet registrovaných uživatelů: ".$st['uzivatele']."</b></p>";

		echo "<b>Registrovaní uživatelé:</b> <br><br>";
		while($data = $sql->fetch()) {
			echo $data['display_name']." | <i style='color: red;'> Registrovaný od: ".$data["user_registered"]."</i><br>";
			$user = $data['ID'];

			$sql1 = $db->prepare('SELECT * FROM wp_posts WHERE post_author = :post_author AND post_type = :post_type');
			$sql1->execute(array(':post_author' => $user, ':post_type' => "post"));
			//$info_bout_users = $sql1->fetchAll(PDO::FETCH_ASSOC);
			/*foreach ($info_bout_users as $key) {
				echo "<p>".$key["post_title"]."</p>";
			}*/
			echo "Publikované příspěvky:<br>";
			$info = $sql1->rowCount();
			echo "<p>".$info."</p>";
			/*while($data1 = $sql1->fetch()) {
				echo $data1['post_title'];
			}*/
		}
	}
?>