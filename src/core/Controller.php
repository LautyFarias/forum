<?php

class Controller
{
    public static function render($view, $context = array())
    {
        require_once VIEWS_ROOT . '/' . $view;
    }

    protected static function json_response($response = null, int $code = 200)
    {
        header_remove();
        http_response_code($code);
        header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
        header('Content-Type: application/json');
        $status = array(
            200 => 'OK',
            400 => 'Bad Request',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method not Allowed',
            503 => 'Service Unavailable',
            500 => 'Internal Server Error'
        );
        header('Status: ' . $status[$code]);
        echo json_encode(array(
            'status' => $code,
            'response' => $response
        ), true);
    }

    protected static function resolve_request(array $allowed_methods = ['GET'])
    {
        $request_method = $_SERVER['REQUEST_METHOD'];

        if (in_array($request_method, $allowed_methods)) {
            $request_type = strtolower($request_method);
            $get_request_data = function () {
                $params = [];
                $data = fopen("php://input", "r");
                $str = urldecode(stream_get_contents($data));
                fclose($data);
                foreach (explode('&', $str) as $value) {
                    $param = explode('=', $value);
                    $params[$param[0]] = $param[1];
                }
                return $params;
            };
            $get_post_data = function () {
                $params = null;
                if (
                    isset($_SERVER['CONTENT_TYPE'])
                    && $_SERVER['CONTENT_TYPE'] == 'application/json'
                ) {
                    $requestDataJSON = file_get_contents('php://input');
                    $params = json_decode($requestDataJSON, TRUE);
                } else {
                    $params = $_POST;
                }
                return $params;
            };
            switch ($request_type) {
                case 'get':
                    return ["params" => $_GET, "method" => $request_type];
                    break;
                case 'post':
                    return ["params" => $get_post_data(), "method" => $request_type];
                    break;
                case 'put':
                    return ["params" => $get_request_data(), "method" => $request_type];
                    break;
                case 'delete':
                    return ["params" => $get_request_data(), "method" => $request_type];
                    break;
                default:
                    return http_response_code(405);
            }
        }
        return http_response_code(405);
    }
}
