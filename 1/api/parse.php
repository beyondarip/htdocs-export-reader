<?php
require_once __DIR__ . '/../includes/functions.php';
header('Content-Type: application/json');

try {
    $files = getMarkdownFiles();
    $response = [];
    
    foreach ($files as $file) {
        $content = file_get_contents($file['path']);
        $sections = parseClaudeMarkdown($content);
        
        $response[] = [
            'filename' => $file['name'],
            'modified' => date('Y-m-d H:i:s', $file['modified']),
            'sections' => $sections
        ];
    }
    
    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}