<?php
$ip_address = get_real_ip();
$is_admin = false;
if ($ip_address == '107.141.251.154') {
    $is_admin = true;
}
?>