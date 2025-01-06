<?php
// test_editor.php

class TestEditor {
    public static function isWindows() {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }
    
    public static function getDefaultEditor() {
        if (self::isWindows()) {
            return 'notepad.exe';
        } else {
            $editors = ['xdg-open', 'gedit', 'kate', 'nano', 'vim'];
            foreach ($editors as $editor) {
                $output = [];
                $returnVar = -1;
                exec("which $editor 2>/dev/null", $output, $returnVar);
                if ($returnVar === 0) {
                    return $editor;
                }
            }
            return null;
        }
    }
    
    public static function test() {
        $results = [];
        
        // Test OS
        $results['os'] = PHP_OS;
        $results['is_windows'] = self::isWindows();
        
        // Test editor availability
        $editor = self::getDefaultEditor();
        $results['editor'] = $editor;
        
        // Create test file
        $testFile = __DIR__ . '/test.txt';
        file_put_contents($testFile, 'This is a test file');
        $results['test_file'] = $testFile;
        
        // Try to open file
        if (self::isWindows()) {
            $command = "start \"\" \"$editor\" \"$testFile\"";
        } else {
            $command = "$editor \"$testFile\" > /dev/null 2>&1 & echo $!";
        }
        
        $output = [];
        $returnVar = -1;
        exec($command, $output, $returnVar);
        
        $results['command'] = $command;
        $results['output'] = $output;
        $results['return_var'] = $returnVar;
        $results['exec_enabled'] = function_exists('exec');
        
        return $results;
    }
}

// Run test
$results = TestEditor::test();
header('Content-Type: application/json');
echo json_encode($results, JSON_PRETTY_PRINT);