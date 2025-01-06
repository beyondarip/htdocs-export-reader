<?php
// chat_parser.php
class ChatParser {
    private $inputDir;

    public function __construct($inputDir) {
        $this->inputDir = $inputDir;
    }

    public function getChatList() {
        if (!is_dir($this->inputDir)) return [];

        $chats = [];
        $files = glob($this->inputDir . '/*.md');
        
        foreach ($files as $file) {
            if (!is_readable($file)) continue;
            
            $content = file_get_contents($file);
            if ($content === false) continue;
            
            $chats[] = [
                'id' => basename($file, '.md'),
                'title' => $this->extractTitle($content),
                'date' => date("M d, Y", filemtime($file))
            ];
        }
        
        usort($chats, fn($a, $b) => strtotime($b['date']) - strtotime($a['date']));
        return $chats;
    }

    private function extractTitle($content) {
        if (preg_match('/## Prompt:\s*(.+?)(?=##|$)/s', $content, $matches)) {
            $title = trim($matches[1]);
            return mb_strlen($title) > 50 ? mb_substr($title, 0, 47) . "..." : $title;
        }
        return "Untitled Chat";
    }

    public function parseChat($chatId) {
        $filePath = $this->inputDir . '/' . $chatId . '.md';
        if (!file_exists($filePath) || !is_readable($filePath)) return null;

        $content = file_get_contents($filePath);
        if ($content === false) return null;

        $messages = [];
        $sections = preg_split('/## (Prompt|Response):/', $content, -1, PREG_SPLIT_DELIM_CAPTURE);
        array_shift($sections);
        
        for ($i = 0; $i < count($sections); $i += 2) {
            $type = trim($sections[$i]);
            $content = trim($sections[$i + 1] ?? '');
            
            if (!empty($content)) {
                $messages[] = [
                    'isUser' => $type === 'Prompt',
                    'content' => $content
                ];
            }
        }

        return $messages;
    }
}
