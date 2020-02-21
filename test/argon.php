<?php
/*------PASSWORD SECTION------*/
// argon2i
ini_set('display_errors', 'On');
$argon_password = 'yellow';
$argon_options = [
    'memory_cost' => 1<<17, // 128 Mb
    'time_cost'   => 4,
    'threads'     => 3,
];
$hash = password_hash($password, PASSWORD_ARGON2I, $options);
var_dump($hash);

 ?>
