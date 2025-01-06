<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('error_log', 'logs/error.log');

header('Content-Type: application/json');
header('Cache-Control: no-cache');

require_once 'DatabaseHandler.php';
require_once 'chat_parser.php';

try {
    $db = new DatabaseHandler();
    $parser = new ChatParser(__DIR__ . '/input', $db);

    $action = $_GET['action'] ?? '';
    $response = ['success' => true];

    switch ($action) {
        case 'list':
            $response['data'] = $parser->getChatList();
            break;

        case 'chat':
            $chatId = $_GET['id'] ?? '';
            if (!$chatId) throw new Exception('Chat ID required');

            $messages = $parser->parseChat($chatId);
            if ($messages === null) throw new Exception('Chat not found');

            $response['messages'] = $messages;
            break;

        case 'togglePin':
            $id = $_GET['id'] ?? '';
            if (!$id) throw new Exception('ID required');
            $db->togglePin($id);
            break;

        case 'toggleFolder':
            $id = $_GET['id'] ?? '';
            if (!$id) throw new Exception('ID required');
            $db->toggleFolder($id);
            break;
        case 'setTags':
            $id = $_GET['id'] ?? '';
            if (!$id) throw new Exception('ID required');

            $input = json_decode(file_get_contents('php://input'), true);
            $tags = $input['tags'] ?? [];

            $db->setTags($id, $tags);
            break;
        default:
            throw new Exception('Invalid action');
    }

    echo json_encode($response);
} catch (Exception $e) {
    error_log($e->getMessage());
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
