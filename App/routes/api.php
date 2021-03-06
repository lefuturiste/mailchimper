<?php
/*
|--------------------------------------------------------------------------
| Api routing
|--------------------------------------------------------------------------
|
| Register it all your api routes
|
*/
$app->get('/', [\App\Controllers\PagesController::class, 'getHome']);
$app->post('/subscribe', [\App\Controllers\NewsletterController::class, 'postSubscribe'])->add(new \App\Middlewares\CORSMiddleware($app->getContainer()));
$app->options('/subscribe', [\App\Controllers\NewsletterController::class, 'postSubscribe'])->add(new \App\Middlewares\CORSMiddleware($app->getContainer()));
$app->get('/event', [\App\Controllers\NewsletterController::class, 'getEvent']);
$app->post('/event', [\App\Controllers\NewsletterController::class, 'postEvent']);