<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Cache-Control: no-cache');

require_once __DIR__ . '/chat_parser.php';

try {
    $parser = new ChatParser(__DIR__ . '/input');
    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'list':
            $chats = $parser->getChatList();
            echo json_encode([
                'success' => true,
                'chats' => $chats
            ]);
            break;
            
        case 'chat':
            $chatId = $_GET['id'] ?? '';
            if (empty($chatId)) {
                throw new Exception('Chat ID required');
            }
            
            $messages = $parser->parseChat($chatId);
            if ($messages === null) {
                throw new Exception('Chat not found or unreadable');
            }
            
            echo json_encode([
                'success' => true,
                'messages' => $messages
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}