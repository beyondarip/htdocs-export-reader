<?php
class DbHandler {
    private $dbPath;
    private $cache = [];

    public function __construct($dbPath) {
        $this->dbPath = $dbPath;
        if (!is_dir($dbPath)) {
            mkdir($dbPath, 0777, true);
        }
    }

    private function getFilePath($type) {
        return $this->dbPath . '/' . $type . '.txt';
    }

    private function readFile($type) {
        if (isset($this->cache[$type])) {
            return $this->cache[$type];
        }
        
        $path = $this->getFilePath($type);
        if (!file_exists($path)) {
            return [];
        }
        
        $data = [];
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($key, $value) = explode('|', $line);
            $data[$key] = $value;
        }
        
        $this->cache[$type] = $data;
        return $data;
    }

    private function writeFile($type, $data) {
        $this->cache[$type] = $data;
        $lines = [];
        foreach ($data as $key => $value) {
            $lines[] = $key . '|' . $value;
        }
        file_put_contents($this->getFilePath($type), implode("\n", $lines));
    }

    public function togglePin($chatId) {
        $pins = $this->readFile('pins');
        if (isset($pins[$chatId])) {
            unset($pins[$chatId]);
        } else {
            $pins[$chatId] = time();
        }
        $this->writeFile('pins', $pins);
    }

    public function getPins() {
        return $this->readFile('pins');
    }

    public function setTags($chatId, $tags) {
        $allTags = $this->readFile('tags');
        $allTags[$chatId] = implode(',', $tags);
        $this->writeFile('tags', $allTags);
    }

    public function getTags($chatId = null) {
        $tags = $this->readFile('tags');
        return $chatId ? ($tags[$chatId] ?? '') : $tags;
    }

    public function toggleFolder($folderId) {
        $folders = $this->readFile('folders');
        $folders[$folderId] = isset($folders[$folderId]) ? !$folders[$folderId] : 0;
        $this->writeFile('folders', $folders);
    }

    public function getFolderState($folderId) {
        $folders = $this->readFile('folders');
        return $folders[$folderId] ?? 1;
    }
}