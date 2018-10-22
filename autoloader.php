<?php

spl_autoload_register( 'autoload' );

function autoload( $class, $dir = null )
{

  //Set directory path
  if ( is_null( $dir ) ) {
    $dir = $_SERVER[ 'DOCUMENT_ROOT' ] . '/root/'; //change root path to your directory root
  }

  foreach ( scandir( $dir ) as $file ) {

    //Full path to file
    $filePath = $dir . $file;

    //Is directory?
    if ( is_dir( $filePath ) && $file[ 0 ] !== '.' )  {
      autoload( $class, $filePath . '/' );
    }

    // File info
    $fileInfo = pathinfo( $filePath );

    //Include file if found
    if ( $fileInfo[ 'filename' ] == $class && $fileInfo[ 'extension' ] == 'php' ) {
      include $fileInfo[ 'dirname' ] . '/' . $fileInfo[ 'basename' ];
    }
  }
}

