<?php

if ( $_POST['payload'] ) {
    shell_exec( "cd /var/www/jakas_strona_do_testow && sudo git reset --hard origin/master && sudo git pull &&  cd .. && sudo chown -R www-data jakas_strona_do_testow" );
}
// git nowy nowy nowy test
?>