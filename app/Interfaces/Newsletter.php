<?php

namespace App\Interfaces;

interface Newsletter
{
    public function subscribe(string $email, string $list = null);
}
