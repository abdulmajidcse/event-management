<?php

namespace App\Interfaces;

interface ApplicationInterface
{
    /**
     * Application instance
     *
     * @return self
     */
    public static function configure(): self;

    /**
     * Create a new application
     *
     * @return void
     */
    public function create(): void;
}
