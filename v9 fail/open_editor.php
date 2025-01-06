<?php
// open_editor.php
header('Content-Type: application/json');

class Editor {
    private static function isWindows() {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    private static function getDefaultEditor() {
        if (self::isWindows()) {
            return 'notepad.exe';
        } else {
            $editors = ['xdg-open', 'gedit', 'kate', 'nano', 'vim'];
            foreach ($editors as $editor) {
                exec("which $editor 2>/dev/null", $output, $returnVar);
                if ($returnVar === 0) {
                    return $editor;
                }
            }
            return 'xdg-open'; // fallback
        }
    }

    public static function openFile($filePath) {
        error_log("Attempting to open file: " . $filePath);
        
        if (!file_exists($filePath)) {
            throw new Exception("File does not exist: " . $filePath);
        }

        $editor = self::getDefaultEditor();
        error_log("Using editor: " . $editor);

        if (self::isWindows()) {
            $command = "start \"\" \"$editor\" \"$filePath\"";
        } else {
            $command = "$editor \"$filePath\" > /dev/null 2>&1 & echo $!";
        }

        error_log("Executing command: " . $command);
        
        exec($command, $output, $returnVar);
        error_log("Command output: " . print_r($output, true));
        error_log("Return value: " . $returnVar);

        if ($returnVar !== 0) {
            throw new Exception("Failed to open editor (return code: $returnVar)");
        }

        return true;
    }
}

try {
    // Accept POST JSON data
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($input['path'])) {
        throw new Exception('File path is required');
    }

    $filePath = $input['path'];
    error_log("Received file path: " . $filePath);
    
    // Get absolute path
    $absolutePath = realpath($filePath);
    if (!$absolutePath) {
        $absolutePath = realpath(__DIR__ . DIRECTORY_SEPARATOR . $filePath);
    }
    
    if (!$absolutePath) {
        throw new Exception("Could not resolve path: " . $filePath);
    }
    
    error_log("Resolved absolute path: " . $absolutePath);
    
    // Security check
    $basePath = realpath(__DIR__);
    if (strpos($absolutePath, $basePath) !== 0) {
        throw new Exception('Invalid file path: Access denied');
    }

    $result = Editor::openFile($absolutePath);
    
    echo json_encode([
        'success' => true,
        'data' => [
            'path' => $absolutePath,
            'os' => PHP_OS
        ]
    ]);

} catch (Exception $e) {
    error_log("Editor error: " . $e->getMessage());
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}