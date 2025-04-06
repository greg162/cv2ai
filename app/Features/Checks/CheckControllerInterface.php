<?php

namespace App\Features\Checks;

interface CheckControllerInterface
{
    public function index(): array;
    public function show(string $checkName): array;
    public function getAllChecks(): array;
    public function getCheckClass(string $checkName): string;
}