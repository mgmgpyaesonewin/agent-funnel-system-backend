<?php


namespace App\Services\Interfaces;


interface EntityServiceInterface
{
    public function generateEntityFileName(string $type): string;
}
