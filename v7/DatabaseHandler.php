<?php
class DatabaseHandler {
    private $dbFile;
    private $data;

    public function __construct($dbFile = 'db.txt') {
        $this->dbFile = $dbFile;
        $this->loadData();
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