<?php

define( 'INCLUDE_DIR', dirname( __FILE__ ) . '/controller/' );

$rules = array(
    'backoffice' => "/backoffice/(?'page'users|faq|cards|devices)",
    'php'   => "/php/(?'page'[\w\-]+)",
    'default'      => "/(?'page'[\w\-]+)",
    'main'      => "/"
);

$uri = rtrim( dirname($_SERVER["SCRIPT_NAME"]), '/' );
$uri = '/' . trim( str_replace( $uri, '', $_SERVER['REQUEST_URI'] ), '/' );
$uri = urldecode( $uri );

foreach ( $rules as $action => $rule ) {
    if ( preg_match( '~^'.$rule.'~', $uri, $params ) ) {
        if($action === 'php'){
            if(file_exists(INCLUDE_DIR . '/php/' . $params['page'] . '.php')){
                include( INCLUDE_DIR . '/php/' . $params['page'] . '.php' );
            } else {
                break;
            }
        } else if($action === 'default'){
            if(file_exists(INCLUDE_DIR . $params['page'] . '.php')){
                include( INCLUDE_DIR . $params['page'] . '.php' );
            } else {
                break;
            }
        } else {
            include( INCLUDE_DIR . $action . '.php' );
        }

        exit();
    }
}

include( INCLUDE_DIR . '404.php' );
?>