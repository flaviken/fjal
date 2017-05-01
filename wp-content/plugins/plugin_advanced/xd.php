<?php
    $ip = $_SERVER['REMOTE_ADDR']; 
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($query && $query['status'] == 'success') {
    echo 'My IP: '.$query['query'].', '.$query['isp'].', '.$query['org'].', '.$query ['country'].', '.$query['regionName'].', '.$query['city'].'!';
    } else {
    echo 'Unable to get location';
    }
?>