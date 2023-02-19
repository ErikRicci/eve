<?php

use Game\Controllers\APIController;
use R2SSimpleRouter\Route;

return [
    Route::get('/api', [APIController::class, 'welcome']),
    Route::post('/api/users/register', \Game\Actions\User\RegisterAction::class),
    Route::post('/api/users/login', \Game\Actions\User\AuthenticateAction::class),
    Route::get('/api/users/my-account', \Game\Actions\User\MyAccountAction::class)
];