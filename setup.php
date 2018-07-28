<?php
$ip_address = get_real_ip();
$is_admin = false;
if ($ip_address == '107.141.251.154' || $ip_address == '75.133.79.146' || $ip_address == "70.34.143.76") {
    $is_admin = true;
}
?>