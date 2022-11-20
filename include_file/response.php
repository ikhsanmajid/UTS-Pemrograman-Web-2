<?php
function send200()
{
    http_response_code(200);
    header('Content-type: application/json');
    echo json_encode([
        'response' => '200',
        'message' => 'OK'
    ]);
}

function send403()
{
    http_response_code(403);
    header('Content-type: application/json');
    echo json_encode([
        'response' => '403',
        'message' => 'Anda tidak terauthentikasi'
    ]);
}

function send404($message = 'Halaman tidak ada')
{
    http_response_code(404);
    header('Content-type: application/json');
    echo json_encode([
        'response' => '404',
        'message' => $message
    ]);
}

function send500($message = 'Backend Error')
{
    http_response_code(505);
    header('Content-type: application/json');
    echo json_encode([
        'response' => '500',
        'message' => $message
    ]);
}