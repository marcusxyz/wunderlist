<?php

declare(strict_types=1);

// Can't get this to work
function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}
