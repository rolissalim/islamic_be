<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Laravel CORS
      |--------------------------------------------------------------------------
      |
      | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
      | to accept any value.
      |
     */

    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['*'],
//    'allowedHeaders' => ['Content-Type', 'X-Requested-With'],//Accept, Authorization, Content-Type, x-event-id
    'allowedMethods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']  
    'exposedHeaders' => [],
    'maxAge' => 0,
];
