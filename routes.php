<?php

use Game\Controllers\APIController;

return [
    \R2SSimpleRouter\Route::get('/api', [APIController::class, 'welcome']),
    \R2SSimpleRouter\Route::post('/api/users/register', [\Game\Actions\User\RegisterAction::class, '__run']),
    \R2SSimpleRouter\Route::post('/api/users/authenticate', [\Game\Actions\User\AuthenticateAction::class, '__run']),
];