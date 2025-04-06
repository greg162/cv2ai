<?php

namespace App\Features\Checks\ResumeScanner;

use App\Features\Checks\Check;
use App\Features\Checks\CheckInterface;

class ResumeScanner extends Check implements CheckInterface
{
    public function getName(): string
    {
        return 'Resume Scanner';
    }

    public function getDescription(): string
    {
        return 'Scan resumes for keywords and phrases';
    }

    public function getIcon(): string
    {
        return 'heroicon-o-document-text';
    }

    public function getClass(): string
    {
        return self::class;
    }
}