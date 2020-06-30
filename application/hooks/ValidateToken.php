<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ValidateToken
{
    function initialize() {
        $CI = &get_instance();
        $class = strtolower($CI->router->class);
        $method = strtolower($CI->router->method);

        $globalController = array('user');
        $globalMethod = array('authenticate');

        if (in_array($class,$globalController) && in_array($method,$globalMethod)) {
            return true;
        }

        $request_headers = $CI->input->request_headers();

        if (array_key_exists('Authorization', $request_headers) && !empty($request_headers['Authorization'])) {
            $bearer = $request_headers['Authorization'];
            $temp = explode(":", $bearer);
            $token = $temp[1];

            $CI->load->helper('authorization');
            $decodedToken = AUTHORIZATION::validateToken($token);
            if ($decodedToken != false) {
                return true;
            }
        }

        $CI->set_response(['status' => 401, 'error' => ['Unauthorised']], REST_Controller::HTTP_UNAUTHORIZED);
        exit;
    }
}