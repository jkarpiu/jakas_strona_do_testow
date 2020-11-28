<?php

if ( $_POST['payload'] ) {
    shell_exec( "cd /var/www/jakas_strona_do_testow && git reset --hard origin/master && git pull" );
}
// git nowy test
?>