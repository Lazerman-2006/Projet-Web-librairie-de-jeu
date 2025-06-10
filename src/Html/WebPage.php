<?php

namespace Html;
use Html\StringEscaper;
class WebPage
{
    use \Html\StringEscaper;
    private string $head = "";

    private string $title = "";

    private string $body = "";

    /**
     * Constructeur de la classe Webpage.php
     *
     * @param string $title
     */
    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    /**
     * Cette méthode permet la récupération de l'attribut head
     *
     * @return string
     */
    public function getHead(): string
    {
        return $this->head;
    }

    /**
     * Cette méthode permet la récépération de l'attribut title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Cette méthode permet de changer la valeur de l'attribut title
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Cette méthode permet la récupération de l'attribut body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Cette méthode permet d'ajouter du contenu dans l'attribut head de l'objet
     *
     * @param string $content
     * @return void
     */
    public function appendToHead(string $content): void
    {
        $this->head .= $content;
    }

    /**
     * Cette méthode permet d'ajouter du css dans l'attribut head de l'objet
     *
     * @param string $css
     * @return void
     */
    public function appendCss(string $css): void
    {
        $this->head .= "<style> $css </style>";
    }

    /**
     * Cette méthode permet d'ajouter l'url du css dans l'attribut head de l'objet
     *
     * @param string $url
     * @return void
     */
    public function appendCssUrl(string $url): void
    {
        $this->head .= "<link rel='stylesheet' href='{$url}'>";
    }

    /**
     * Cette méthode permet d'ajouter du JavaScript dans l'attribut head de l'objet
     *
     * @param string $js
     * @return void
     */
    public function appendJs(string $js): void
    {
        $this->head .= "<script> $js </script>";
    }

    /**
     * Cette méthode permet d'ajouter l'url d'un fichier JavaScript dans l'attribut head de l'objet
     *
     * @param string $url
     * @return void
     */
    public function appendJsUrl(string $url): void
    {
        $this->head .= " <script src='{$url}'></script> ";
    }


    /**
     * Cette méthode permet d'ajouter du contenu dans l'attribut body de l'objet
     *
     * @param string $content
     * @return void
     */
    public function appendContent(string $content): void
    {
        $this->body .= $content;
    }

    public function toHTML(): string
    {
        $html = <<<HTML
        <!doctype html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport">
            <title>{$this->title}</title>
            {$this->head}
        </head>
        <body>
            {$this->body}
        </body>
        HTML;
        return $html;
    }


    /**
     * Cette méthode permet d'avoir la date et l'heure de la dernière modification
     *
     * @return string
     */
    public function getLastModification(): string
    {
        $string = "Dernière modification : ".date("F d Y H:i:s.", getlastmod());
        return $string;
    }













}
