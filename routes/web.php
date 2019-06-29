<?php

$router->get('/ip/latest', function () use ($router) {
    return response(['address' => \App\Ip::latest()->first()->address]);
});

$router->get('/ip/register', function () use ($router) {
    $ip = \App\Ip::create(['address' => \Illuminate\Support\Facades\Request::ip()]);
    return response($ip->toArray(), 201);
    // return response(['address' => \App\Ip::latest()->first()->address]);
});
