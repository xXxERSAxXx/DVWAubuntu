<?php
header ("X-XSS-Protection: 0");
if( array_key_exists( "name", $_GET ) && $_GET[ 'name' ] != NULL ) {
    
    // Parche: Escapar entradas con htmlspecialchars según guía
    $name = htmlspecialchars($_GET[ 'name' ], ENT_QUOTES, 'UTF-8');
    echo '<pre>Hello ' . $name . '</pre>';
}
?>
