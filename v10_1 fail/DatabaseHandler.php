<?php
class DatabaseHandler {
    private $dbFile;
    private $data;

    public function __construct($dbFile = 'db.txt') {
        $this->dbFile = $dbFile;
        $this->loadData();
    }
 // DatabaseHandler.php
public function rename($id, $newName) {
    try {
        $oldPath = $this->findFilePath($id);
        if (!$oldPath) {
            error_log("File not found: $id");
            throw new Exception('File not found');
        }
        
        $dir = dirname($oldPath);
        $newPath = $dir . '/' . $newName . '.md';
        
        error_log("Old path: $oldPath");
        error_log("New path: $newPath");
        
        if (!is_writable($oldPath)) {
            error_log("File not writable: $oldPath");
            throw new Exception('File not writable');
        }
        
        if (file_exists($newPath)) {
            error_log("Target file already exists: $newPath");
            throw new Exception('File with that name already exists');
        }
        
        if (!rename($oldPath, $newPath)) {
            error_log("Rename failed from $oldPath to $newPath");
            throw new Exception('Rename operation failed');
        }
        
        $this->data['names'][$id] = $newName;
        $this->saveData();
        return true;
    } catch (Exception $e) {
        error_log("Rename error: " . $e->getMessage());
        throw $e;
    }
}

private function findFilePath($id) {
    $baseDir = __DIR__ . '/input'; // Sesuaikan dengan direktori input Anda
    
    // Remove .md if present
    $id = preg_replace('/\.md$/', '', $id);
    $parts = explode('/', $id);
    $filename = array_pop($parts);
    
    $currentDir = $baseDir;
    foreach ($parts as $part) {
        $currentDir .= '/' . $part;
    }
    
    $path = $currentDir . '/' . $filename . '.md';
    return file_exists($path) ? $path : null;
}
    
public function getName($id) {
    return $this->data['names'][$id] ?? null;
}
    private function loadData() {
        if (file_exists($this->dbFile)) {
            $content = file_get_contents($this->dbFile);
            $this->data = json_decode($content, true) ?? [
                'pinned' => [],
                'collapsed' => [],
                'tags' => []
            ];
        } else {
            $this->data = [
                'pinned' => [],
                'collapsed' => [],
                'tags' => []
            ];
            $this->saveData();
        }
    }

    private function saveData() {
        file_put_contents($this->dbFile, json_encode($this->data, JSON_PRETTY_PRINT));
    }

    public function togglePin($id) {
        if (!isset($this->data['pinned'])) {
            $this->data['pinned'] = [];
        }
        
        $index = array_search($id, $this->data['pinned']);
        if ($index !== false) {
            array_splice($this->data['pinned'], $index, 1);
        } else {
            $this->data['pinned'][] = $id;
        }
        
        $this->saveData();
        return true;
    }

    public function isPinned($id) {
        return in_array($id, $this->data['pinned'] ?? []);
    }

    public function toggleCollapsed($id) {
        if (!isset($this->data['collapsed'])) {
            $this->data['collapsed'] = [];
        }
        
        $index = array_search($id, $this->data['collapsed']);
        if ($index !== false) {
            array_splice($this->data['collapsed'], $index, 1);
        } else {
            $this->data['collapsed'][] = $id;
        }
        
        $this->saveData();
        return true;
    }

    public function isCollapsed($id) {
        return in_array($id, $this->data['collapsed'] ?? []);
    }

    public function setTags($chatId, $tags) {
        $this->data['tags'][$chatId] = $tags;
        $this->saveData();
    }

    public function getTags($chatId) {
        return $this->data['tags'][$chatId] ?? [];
    }
}