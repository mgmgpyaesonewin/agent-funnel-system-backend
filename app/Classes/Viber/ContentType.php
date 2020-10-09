<?php

namespace App\Classes\Viber;

class ContentType
{
    private $text;
    private $image;
    private $meta_key;
    private $action; // link

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setMetaKey($meta_key)
    {
        $this->meta_key = $meta_key;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getImage(): string
    {
        return asset("storage/{$this->image}");
    }

    public function getMetaKey(): string
    {
        return $this->meta_key;
    }

    public function getAction(): string
    {
        return $this->action;
    }
}
