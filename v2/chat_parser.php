<?php
// chat_parser.php
class ChatParser {
    private $inputDir;

    public function __construct($inputDir) {
        $this->inputDir = $inputDir;
    }

    public function getChatList() {
        $chats = [];
        $files = glob($this->inputDir . '/*.md');
        
        foreach ($files as $file) {
            $content = file_get_contents($file);
            $title = $this->extractTitle($content);
            $date = date("M d, Y", filemtime($file));
            
            $chats[] = [
                'id' => basename($file, '.md'),
                'title' => $title,
                'date' => $date,
                'path' => $file
            ];
        }
        
        usort($chats, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        return $chats;
    }

    private function extractTitle($content) {
        $lines = explode("\n", $content);
        foreach ($lines as $line) {
            if (strpos($line, "## Prompt:") === 0) {
                $prompt = trim(str_replace("## Prompt:", "", $line));
                return strlen($prompt) > 50 ? substr($prompt, 0, 47) . "..." : $prompt;
            }
        }
        return "Untitled Chat";
    }

    public function parseChat($chatId) {
        $filePath = $this->inputDir . '/' . $chatId . '.md';
        if (!file_exists($filePath)) {
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
}