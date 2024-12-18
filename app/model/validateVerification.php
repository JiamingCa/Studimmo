<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

if ($data['code_email'] != $_SESSION['email_verification_code'] || 
    $data['code_telephone'] != $_SESSION['phone_verification_code']) {
    echo json_encode(['success' => false, 'error' => 'Code de vérification incorrect.']);
    exit;
}

echo json_encode(['success' => true]);
?>
