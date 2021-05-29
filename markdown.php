<?php

require __DIR__ . '/vendor/autoload.php';

use cebe\markdown\GithubMarkdown;
use HTMLPurifier;

if (isset($_GET['md'])) {
  $markdown = $_GET['md'];
}

$parser = new GithubMarkdown();
$parser->enableNewlines = true;
$html = $parser->parse($markdown);

$purifier = new HTMLPurifier();
$html = $purifier->purify($html);

echo $html;