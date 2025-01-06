<?php
class EditorHandler {
    private static function isWindows() {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }

    private static function getDefaultEditor() {
        if (self::isWindows()) {
            return 'notepad.exe'; // Default for Windows
        } 
        
        // For Linux/Unix systems
        $editors = ['xdg-open', 'gedit', 'kate', 'nano', 'vim'];
        foreach ($editors as $editor) {
            exec("which $editor 2>/dev/null", $output, $returnVar);
            if ($returnVar === 0) {
                return $editor;
            }
        }
        return 'xdg-open'; // Default fallback
    }

    public static function openFile($filePath) {
        if (!file_exists($filePath)) {
            return [
                'success' => false,
                'error' => 'File not found',
                'output' => []
            ];
        }

        $editor = self::getDefaultEditor();
        $output = [];
        $returnVar = -1;

        if (self::isWindows()) {
            $command = sprintf('start "" "%s" "%s"', $editor, $filePath);
            exec($command, $output, $returnVar);
        } else {
            $command = sprintf('%s "%s" > /dev/null 2>&1 & echo $!', $editor, $filePath);
            exec($command, $output, $returnVar);
        }

        return [
            'success' => $returnVar === 0,
            'editor' => $editor,
            'command' => $command,
            'output' => $output
        ];
    }
}