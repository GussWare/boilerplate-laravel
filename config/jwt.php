<?php

return [
    'secret' => env('JWT_SECRET'),
    'access_expiration_minutes' => env('JWT_ACCESS_EXPIRATION_MINUTES'),
    'refresh_expiration_minutes' => env('JWT_REFRESH_EXPIRATION_MINUTES'),
    'reset_password_expiration_minutes' => env('JWT_RESET_PASSWORD_EXPIRATION_MINUTES'),
    'verify_email_expiration_minutes' => env('JWT_VERIFY_EMAIL_EXPIRATION_MINUTES'),
    'type_access' => "TOKEN_TYPE_ACCESS",
    'type_refresh' => "TOKEN_TYPE_ACCESS",
    'type_reset_password' => "TOKEN_TYPE_",
    'type_verify_email' => "TOKEN_TYPE_VERIFY_EMAIL",
];
