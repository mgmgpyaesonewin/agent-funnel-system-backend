<?php


namespace App\Classes\Entity;


interface BaseEntityInterface
{
    public function generateFileName(string $entityType);
}
