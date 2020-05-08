<?php

class ViewResponse
{
    public $page;
    public $title;
    public $content;
    public $dir;

    function __construct($master, $page, $title, $content)
    {
        $this->page = $page;
        $this->title = $title;
        $this->content = $content;
        $this->dir = $master;
    }

    function getObject(): stdClass
    {
        $c = new stdClass();
        $c->page = $this->page;
        $c->title = $this->title;
        $c->content = $this->content;
        $c->dir = $this->dir;
        return $c;
    }
}