<?php
class ChatParser {
    private $inputDir;
    private $db;

    public function __construct($inputDir) {
        $this->inputDir = rtrim($inputDir, '/');
        $this->db = new DatabaseHandler();
    }
    
    public function getDb() {
        return $this->db;
    }

    private function sortByPinned($items) {
        usort($items, function($a, $b) {
            $aPinned = $this->db->isPinned($a['id']);
            $bPinned = $this->db->isPinned($b['id']);
            if ($aPinned && !$bPinned) return -1;
            if (!$aPinned && $bPinned) return 1;
            return strcmp($a['title'], $b['title']);
        });
        return $items;
    }

    public function getChatList() {
        $items = $this->scanDirectory($this->inputDir);
        return $this->sortByPinned($items);
    }

    private function scanDirectory($dir, $prefix = '') {
        $items = [];
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            $id = $prefix . str_replace(' ', '_', $file);
            
            if (is_dir($path)) {
                $folderItems = $this->scanDirectory($path, $id . '/');
                $folderItems = $this->sortByPinned($folderItems);
                
                $items[] = [
                    'type' => 'folder',
                    'id' => $id,
                    'title' => $file,
                    'items' => $folderItems,
                    'pinned' => $this->db->isPinned($id),
                    'collapsed' => $this->db->isCollapsed($id)
                ];
            } else if (pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                $baseId = substr($id, 0, -3);
                $items[] = [
                    'type' => 'file',
                    'id' => $baseId,
                    'title' => pathinfo($file, PATHINFO_FILENAME),
                    'date' => date("M d, Y", filemtime($path)),
                    'path' => $path,
                    'pinned' => $this->db->isPinned($baseId),
                    'tags' => $this->db->getTags($baseId)
                ];
            }
        }

        return $items;
    }

    public function parseChat($chatId) {
        $realId = str_replace('_', ' ', $chatId);
        $filePath = $this->findFile($this->inputDir, $realId);
        if (!$filePath) return null;

        $content = file_get_contents($filePath);
        $messages = [];
        $sections = preg_split('/## (Prompt|Response):/', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
        
        array_shift($sections);
        
        for ($i = 0; $i < count($sections); $i += 2) {
            $messages[] = [
                'isUser' => trim($sections[$i]) === 'Prompt',
                'content' => trim($sections[$i + 1] ?? '')
            ];
        }
        
        return $messages;
    }

    private function findFile($dir, $chatId) {
        $parts = explode('/', $chatId);
        $filename = array_pop($parts);
        
        $currentDir = $dir;
        foreach ($parts as $part) {
            $currentDir .= DIRECTORY_SEPARATOR . $part;
            if (!is_dir($currentDir)) return null;
        }
        
        $path = $currentDir . DIRECTORY_SEPARATOR . $filename . '.md';
        return file_exists($path) ? $path : null;
    }
}