<?php

use App\Features\Checks\Check;
use App\Features\Checks\ResumeScanner\ResumeScanner;

Enum CheckRegistery: string
{
    case ResumeScanner = 'resume_scanner';

    function getName(): string
    {
        return match ($this) {
            self::ResumeScanner => 'Resume Scanner',
        };
    }

    function getDescription(): string
    {
        return match ($this) {
            self::ResumeScanner => 'Scan resumes for keywords and phrases',
        };
    }

    function getIcon(): string
    {
        return match ($this) {
            self::ResumeScanner => 'heroicon-o-document-text',
        };
    }

    function getClass(): Check
    {
        return match ($this) {
            self::ResumeScanner => new ResumeScanner(),
        };
    }

    function getController(): string
    {
        return match ($this) {
            self::ResumeScanner => 'App\Http\Controllers\ResumeScannerController',
        };
    }
}