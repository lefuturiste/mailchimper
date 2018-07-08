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
$app->map(['POST','OPTIONS'], '/subscribe', [\App\Controllers\NewsletterController::class, 'postSubscribe'])->add(new \App\Middlewares\CORSMiddleware($app->getContainer()));
$app->get('/event/subscribe', [\App\Controllers\NewsletterController::class, 'getEventSubscribe']);
$app->post('/event/subscribe', [\App\Controllers\NewsletterController::class, 'postEventSubscribe']);