<?php

namespace App\Features\Checks;

class CheckController
{
    protected $checkRegistry;

    public function __construct(CheckRegistery $checkRegistry)
    {
        $this->checkRegistry = $checkRegistry;
    }

    public function index()
    {
        // Get all checks from the registry
        $checks = $this->checkRegistry->getAllChecks();

        // Return a view with the checks
        return view('checks.index', compact('checks'));
    }

    public function show($checkName)
    {
        // Get the check class from the registry
        $checkClass = $this->checkRegistry->getCheckClass($checkName);

        // Create an instance of the check class
        $check = new $checkClass();

        // Return a view with the check details
        return view('checks.show', compact('check'));
    }
}