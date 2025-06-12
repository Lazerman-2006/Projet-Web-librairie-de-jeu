<?php

declare(strict_types=1);

namespace Entity;

use Html\WebPage;
use Html\StringEscaper;

class AppWebPage extends WebPage
{

    public function __construct(string $title = "")
    {
        parent::__construct($title);
        parent::appendCssUrl("/css/style.css");
    }

    public function toHTML(): string
    {
        $title = $this->getTitle();
        $head = $this->getHead();
        $content = $this->getBody();
        $date = $this->getLastModification();

        return <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{$title}</title>
    {$head}
</head>
<body>
    <div class="header">
        <h1>{$title}</h1>
    </div>
    <div class="content">
        <div class="list">
            <div class ="jeux">
                
                {$content} 
                
            </div>
        </div>
    </div>
    <div class="footer">
        Dernière modification : {$date}
    </div>
</body>
</html>
HTML;
    }
}
