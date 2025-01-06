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
            $filename = pathinfo($file, PATHINFO_FILENAME); // Get filename without extension
            $chats[] = [
                'id' => $filename,
                'title' => $filename,  // Use filename as title
                'date' => date("M d, Y", filemtime($file)),
                'path' => $file
            ];
        }
        
        // Sort by date
        usort($chats, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
        
        return $chats;
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