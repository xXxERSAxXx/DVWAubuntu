<?php

define( 'DVWA_WEB_PAGE_TO_ROOT', '../' );
require_once DVWA_WEB_PAGE_TO_ROOT . 'dvwa/includes/dvwaPage.inc.php';

dvwaPageStartup( array( 'authenticated' ) );

$page = dvwaPageNewGrab();
$page[ 'title' ] = 'Help' . $page[ 'title_separator' ].$page[ 'title' ];

if (array_key_exists ("id", $_GET) &&
        array_key_exists ("security", $_GET) &&
        array_key_exists ("locale", $_GET)) {
        
        // 1. Sanitización de entrada (Evita caracteres especiales)
        $id       = preg_replace( '/[^a-zA-Z0-9_-]/', '', $_GET[ 'id' ] );
        $security = preg_replace( '/[^a-zA-Z0-9_-]/', '', $_GET[ 'security' ] );
        $locale   = preg_replace( '/[^a-zA-Z0-9_-]/', '', $_GET[ 'locale' ] );

        ob_start();
        // 2. Reemplazo del peligroso eval() por include()
        if ($locale == 'en') {
                include( DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/{$id}/help/help.php" );
        } else {
                include( DVWA_WEB_PAGE_TO_ROOT . "vulnerabilities/{$id}/help/help.{$locale}.php" );
        }
        $help = ob_get_contents();
        ob_end_clean();
} else {
        $help = "<p>Not Found</p>";
}

$page[ 'body' ] .= "
<script src='/vulnerabilities/help.js'></script>
<link rel='stylesheet' type='text/css' href='/vulnerabilities/help.css' />

<div class=\"body_padded\">
        {$help}
</div>\n";

dvwaHelpHtmlEcho( $page );

