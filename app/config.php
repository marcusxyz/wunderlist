<?php

declare(strict_types=1);

// File contains a list of global configuration settings

return [
    'title' => 'Wunderlist',
    'database_path' => sprintf('sqlite:%s/database/database.db', __DIR__),
];
