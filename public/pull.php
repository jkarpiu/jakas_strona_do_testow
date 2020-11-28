<?php

if ( $_POST['payload'] ) {
    shell_exec( "cd /var/www/jakas_strona_do_testow && sudo git reset --hard origin/master && sudo git pull" );
}
// git nowy nowy test
?>