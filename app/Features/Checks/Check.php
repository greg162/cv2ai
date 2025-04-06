<?php

namespace App\Features\Checks;

class Check 
{
    public function getName(): string
    {
        return 'Check Name';
    }

    public function getDescription(): string
    {
        return 'Check Description';
    }

    public function getIcon(): string
    {
        return 'heroicon-o-check-circle';
    }

    public function getClass(): string
    {
        return self::class;
    }
}