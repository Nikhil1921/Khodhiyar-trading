<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('my_crypt'))
{
    function my_crypt($string, $action = 'e' )
    {
        $secret_key = 'groccery_app_key';
        $secret_iv = 'groccery_app_iv';

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	    if( $action == 'e' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }

	    return $output;
    }   
}

if ( ! function_exists('re'))
{
    function re($array='')
    {
        echo "<pre>";
        print_r($array);
        exit;
    }
}

if ( ! function_exists('e_id'))
{
    function e_id($id)
    {
        return $id * 44545;
    }
}

if ( ! function_exists('d_id'))
{
    function d_id($id)
    {
        return $id / 44545;
    }
}

if ( ! function_exists('admin'))
{
    function admin($url='')
    {
        return ADMIN.'/'.$url;
    }
}

if ( ! function_exists('b_asset'))
{
    function b_asset($url='')
    {
        return base_url('assets/back/'.$url);
    }
}

if ( ! function_exists('flashMsg'))
{
    function flashMsg($success, $succmsg, $failmsg, $redirect)
    {
        $CI =& get_instance();
        
        if ($success)
            $CI->session->set_flashdata(['title' => 'Success | ','notify' => 'success', 'message' => $succmsg]);
        else
            $CI->session->set_flashdata(['title' => 'Error ! ', 'notify' => 'danger', 'message' => $failmsg]);
        
        return redirect($redirect);
    }
}