<?php
// get and update volunteer user data information
include('../headers.php');
header("Access-Control-Allow-Methods: GET,PUT");

include("../../db/connect.php");

$httpResponseCode;
$response = [];

$requestMethod = $_SERVER["REQUEST_METHOD"];
$userId = $_GET['id'] ?? null;

if ($requestMethod == 'GET') {
    if (!empty($userId)) {
        $userData = $user->getUserRelawanbyId($userId);

        if (!$userData) {
            $httpResponseCode = 404;

            $response = [
                'status' => $httpResponseCode,
                'message' => 'Not Found',
                'data' => []
            ];
        } else {
            $httpResponseCode = 200;

            $response = [
                'status' => $httpResponseCode,
                'message' => 'success',
                'data' => [
                    'id_pengguna' => $userData['id_pengguna'],
                    'nama' => $userData['nama'],
                    'alamat' => $userData['alamat'],
                    'nomor_telepon' => $userData['nomor_telepon'],
                    'jenis_kelamin' => $userData['jenis_kelamin'],
                    'tanggal_lahir' => $userData['tanggal_lahir'],
                ]
            ];
        }
    } else {
        $httpResponseCode = 400;

        $response = [
            'status' => $httpResponseCode,
            'message' => 'Please provide user id!'
        ];
    }
} elseif ($requestMethod == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (!empty($userId)) {
        if (
            !empty($data['nama']) && !empty($data['alamat']) && !empty($data['nomor_telepon'])
            && !empty($data['jenis_kelamin']) && !empty($data['tanggal_lahir'])
        ) {
            $result = $user->updateUserRelawan($userId, $data['nama'], $data['jenis_kelamin'], $data['alamat'], $data['nomor_telepon'], $data['tanggal_lahir']);

            if (!$result) {
                $httpResponseCode = 409;

                $response = [
                    'status' => $httpResponseCode,
                    'message' => 'Failed to update user data!'
                ];
            } else {
                $httpResponseCode = 200;

                $response = [
                    'status' => $httpResponseCode,
                    'message' => 'success',
                    'data' => [
                        'id_pengguna' => $userId,
                        'nama' => $data['nama'],
                        'alamat' => $data['alamat'],
                        'nomor_telepon' => $data['nomor_telepon'],
                        'jenis_kelamin' => $data['jenis_kelamin'],
                        'tanggal_lahir' => $data['tanggal_lahir'],
                    ]
                ];
            }
        } else {
            $httpResponseCode = 503;

            $response = [
                'status' => $httpResponseCode,
                'message' => 'Failed to update!'
            ];
        }
    } else {
        $httpResponseCode = 400;

        $response = [
            'status' => $httpResponseCode,
            'message' => 'Please provide user id!'
        ];
    }
} else {
    $httpResponseCode = 405;

    $response = [
        'status' => $httpResponseCode,
        'message' => 'Method Not Allowed'
    ];
}


http_response_code($httpResponseCode);
echo json_encode($response);
