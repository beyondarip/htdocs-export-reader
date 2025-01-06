<?php
header('Content-Type: application/json');

require_once 'ChatParser.php';
$parser = new ChatParser();

if (isset($_GET['chat'])) {
    echo json_encode($parser->parseChat($_GET['chat']));
} else {
    echo json_encode($parser->listChats());
}