<?php

namespace App\Features\Checks;

Interface CheckInterface
{
    public function getName(): string;
    public function getDescription(): string;
}