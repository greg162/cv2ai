<?php

namespace App\Features\Checks;

use Illuminate\Http\Request;

interface CheckControllerInterface
{
    public function create(Request $request);
    public function store(Request $request);
    public function edit(Request $request);
}