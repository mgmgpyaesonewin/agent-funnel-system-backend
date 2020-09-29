<?php

namespace App\Services\Interfaces;

use App\Classes\Viber\ContentType;

interface ViberServiceInterface
{
    public function getMetaValueByKey(string $meta_key);

    public function send(string $phone, int $contentType, ContentType $content);
}
