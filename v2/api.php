<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
header('Cache-Control: no-cache');

require_once 'chat_parser.php';

$parser = new ChatParser(__DIR__ . '/input');

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'list':
        echo json_encode($parser->getChatList());
        break;
        
    case 'chat':
        $chatId = $_GET['id'] ?? '';
        if ($chatId) {
            $messages = $parser->parseChat($chatId);
            if ($messages !== null) {
                echo json_encode(['success' => true, 'messages' => $messages]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'error' => 'Chat not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Chat ID required']);
        }
        break;
        
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
}