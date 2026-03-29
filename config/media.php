<?php

declare(strict_types=1);

return [
    'route_prefix' => 'api/erp-media',
    'disk' => env('ERP_MEDIA_DISK', 'public'),
    'directory' => env('ERP_MEDIA_DIRECTORY', 'erp-media'),
    'visibility' => env('ERP_MEDIA_VISIBILITY', 'private'),
    'middleware' => ['api'],
];
