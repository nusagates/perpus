<?php
if (!function_exists('apiResponse')) {
    function apiResponse($code, $data = [], $message = 'OK')
    {
        return response()->json([
            'code' => $code,
            'data' => $data,
            'message' => $message
        ]);
    }
}
