<?php

namespace App\Core;

interface RouterInterface
{
    public function match(string $pathInfo);
}
