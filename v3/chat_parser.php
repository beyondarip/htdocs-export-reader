<?php
class ChatParser {
    private $inputDir;

    public function __construct($inputDir) {
        $this->inputDir = $inputDir;
    }

    public function getChatList() {
        return $this->scanDirectory($this->inputDir);
    }

    private function scanDirectory($dir, $prefix = '') {
        $items = [];
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                $folderName = basename($path);
                $items[] = [
                    'type' => 'folder',
                    'id' => $prefix . $folderName,
                    'title' => $folderName,
                    'items' => $this->scanDirectory($path, $prefix . $folderName . '/')
                ];
            } else if (pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $items[] = [
                    'type' => 'file',
                    'id' => $prefix . $filename,
                    'title' => $filename,
                    'date' => date("M d, Y", filemtime($path)),
                    'path' => $path
                ];
            }
        }

        return $items;
    }

    public function parseChat($chatId) {
        $filePath = $this->findFile($this->inputDir, $chatId);
        if (!$filePath) {
            return null;
        }

        $content = file_get_contents($filePath);
        $messages = [];
        $sections = preg_split('/## (Prompt|Response):/', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
        
        array_shift($sections);
        
        for ($i = 0; $i < count($sections); $i += 2) {
            $type = trim($sections[$i]);
            $content = trim($sections[$i + 1] ?? '');
            
            $messages[] = [
                'isUser' => $type === 'Prompt',
                'content' => $content
            ];
        }
        
        return $messages;
    }

    private function findFile($dir, $id) {
        // Handle nested paths by splitting on /
        $parts = explode('/', $id);
        $filename = array_pop($parts); // Get actual filename
        
        // Navigate through folders if present
        $currentDir = $dir;
        foreach ($parts as $folder) {
            $currentDir .= '/' . $folder;
            if (!is_dir($currentDir)) {
                return null;
            }
        }
        
        // Look for the file in final directory
        $path = $currentDir . '/' . $filename . '.md';
        return file_exists($path) ? $path : null;
    }
}