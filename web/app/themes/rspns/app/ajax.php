<?php

/**
 * Theme setup.
 */

namespace App;


add_action( 'wp_ajax_contact_callback', __NAMESPACE__ . '\\contact_callback' );
add_action( 'wp_ajax_nopriv_contact_callback', __NAMESPACE__ . '\\contact_callback' );

/**
 * Collect the data for sending
 *
 * @return wp_send_json:Object
 */
function contact_callback() 
{

    $email = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $type = $_POST['type'];
    $route = $_POST['route'];


    $contact = contact_process(
        $route,
        $email,
        $name,
        $phone,
        $message,
        $type
    );

    $return = array(
        'success' => $contact,
    );

    return wp_send_json( $return );
}

/**
 * Process data from a form and send it
 *
 * @return wp_mail:Object
 */
function contact_process($route, $email, $name, $phone, $message, $type)
{

    if(WP_ENV !== 'production') {
        $to = ['marc@response.agency'];
    } else {
        $to = [$route, 'marc@response.agency'];
    }

    $subject = "RSPNS Contact - " . $type;
    $body = "
    <b>Name</b>: $name
    <br>
    <b>Email</b>: $email
    <br>
    <b>Phone</b>: $phone
    <br>
    <b>Comments</b>: $message
    ";
    $headers = array('Content-Type: text/html; charset=UTF-8');

    return wp_mail( $to, $subject, $body, $headers );
  }
