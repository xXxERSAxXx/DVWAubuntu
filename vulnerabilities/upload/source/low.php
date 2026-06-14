<?php
if( isset( $_POST[ 'Upload' ] ) ) {
    $target_path  = DVWA_WEB_PAGE_TO_ROOT . "hackable/uploads/" . basename( $_FILES[ 'uploaded' ][ 'name' ] );

    // Parche: Validar tipo MIME y extensión según guía
    $uploaded_type = $_FILES[ 'uploaded' ][ 'type' ];
    $uploaded_ext  = strtolower(pathinfo($_FILES[ 'uploaded' ][ 'name' ], PATHINFO_EXTENSION));

    if( ($uploaded_ext == "jpeg" || $uploaded_ext == "png") && 
        ($uploaded_type == "image/jpeg" || $uploaded_type == "image/png") ) {
        move_uploaded_file( $_FILES[ 'uploaded' ][ 'tmp_name' ], $target_path );
        echo "<pre>Successfully uploaded!</pre>";
    } else {
        echo '<pre>Invalid file type.</pre>';
    }
}
?>

