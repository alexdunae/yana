<?php

namespace YANA;

const CREATESEND_LIST_ID = 'dfaf2fd4e87bc41fc3609af100636875';
const CREATESEND_API_KEY = 'a4b93cf31ffdf97c55a3ef18713686b4';

add_action( 'wp_ajax_nopriv_yana_subscribe', 'YANA\subscribe_xhr' );
add_action( 'wp_ajax_yana_subscribe', 'YANA\subscribe_xhr' );

function subscribe( $email, $name = null ) {
  require_once( dirname( __FILE__ ) . '/createsend-php/csrest_subscribers.php' );
  $wrap = new \CS_REST_Subscribers( CREATESEND_LIST_ID, CREATESEND_API_KEY );
  $result = $wrap->add( array( 'EmailAddress' => $email, 'Name' => $name, 'Resubscribe' => true ) );
  return $result->was_successful();
}

function subscribe_xhr() {
  @ob_clean();
  $email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
  if ( subscribe( $email ) ) {
    header( 'HTTP/1.0 201 Created' );
    wp_send_json_success( array( 'message' => 'Success! We\'ll be in touch soon.' ) );
  } else {
    header( 'HTTP/1.0 200 OK' ); // not RESTful
    wp_send_json_error( array( 'message' => 'Something went wrong. Try again?' ) );
  }
  exit(0);
}
