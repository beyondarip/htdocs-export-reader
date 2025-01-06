<?php
require_once __DIR__ . '/config.php';
require_once ROOT_PATH . '/lib/Parsedown.php';

function getMarkdownFiles(): array {
    $files = [];
    
    try {
        $directory = new DirectoryIterator(INPUT_DIR);
        foreach ($directory as $file) {
            if ($file->isFile() && in_array($file->getExtension(), ALLOWED_EXTENSIONS)) {
                $files[] = [
                    'name' => $file->getFilename(),
                    'path' => $file->getPathname(),
                    'modified' => $file->getMTime()
                ];
            }
        }
    } catch (Exception $e) {
        error_log("Error reading input directory: " . $e->getMessage());
        return [];
    }
    
    // Sort by modified date, newest first
    usort($files, function($a, $b) {
        return $b['modified'] - $a['modified'];
    });
    
    return $files;
}

function parseClaudeMarkdown(string $content): array {
    $sections = [];
    $lines = explode("\n", $content);
    $currentSection = null;
    $currentContent = '';
    
    foreach ($lines as $line) {
        if (preg_match('/^## (Prompt|Response):/', $line, $matches)) {
            if ($currentSection !== null) {
                $sections[] = [
                    'type' => $currentSection,
                    'content' => trim($currentContent)
                ];
                $currentContent = '';
            }
            $currentSection = strtolower($matches[1]);
        } else {
            $currentContent .= $line . "\n";
        }
    }
    
    // Add the last section
    if ($currentSection !== null) {
        $sections[] = [
            'type' => $currentSection,
            'content' => trim($currentContent)
        ];
    }
    
    return $sections;
}

function renderMarkdown(string $content): string {
    $parsedown = new Parsedown();
    $parsedown->setSafeMode(true);
    return $parsedown->text($content);
}