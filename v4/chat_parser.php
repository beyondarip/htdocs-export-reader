<?php

require_once 'DatabaseHandler.php';

class ChatParser {
    private $inputDir;
    private $db;

    public function __construct($inputDir) {
        $this->inputDir = $inputDir;
        $this->db = new DatabaseHandler();
    }

    
    public function getDb() {
        return $this->db;
    }


    public function getChatList() {
        $items = $this->scanDirectory($this->inputDir);
        // Sort items to put pinned ones first
        usort($items, function($a, $b) {
            $aPinned = $this->db->isPinned($a['id']);
            $bPinned = $this->db->isPinned($b['id']);
            if ($aPinned && !$bPinned) return -1;
            if (!$aPinned && $bPinned) return 1;
            return strcmp($a['title'], $b['title']);
        });
        return $items;
    }

    private function scanDirectory($dir, $prefix = '') {
        $items = [];
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            
            $path = $dir . '/' . $file;
            $id = $prefix . pathinfo($file, PATHINFO_FILENAME);
            
            if (is_dir($path)) {
                $folderItems = $this->scanDirectory($path, $prefix . $file . '/');
                $items[] = [
                    'type' => 'folder',
                    'id' => $id,
                    'title' => $file,
                    'items' => $folderItems,
                    'pinned' => $this->db->isPinned($id),
                    'collapsed' => $this->db->isCollapsed($id)
                ];
            } else if (pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                $items[] = [
                    'type' => 'file',
                    'id' => $id,
                    'title' => pathinfo($file, PATHINFO_FILENAME),
                    'date' => date("M d, Y", filemtime($path)),
                    'path' => $path,
                    'pinned' => $this->db->isPinned($id),
                    'tags' => $this->db->getTags($id)
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