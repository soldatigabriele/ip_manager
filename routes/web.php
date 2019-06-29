<?php

$router->get('/ip/latest', function () use ($router) {
    $ip = \App\Ip::latest('id')->first();
    return response([
        'address' => $ip->address,
        'date' => $ip->created_at,
    ]);
});

$router->get('/ip/all', function () use ($router) {
    $ips = \App\Ip::latest('id')->limit(15)->get();
    return response(
        $ips->toArray()
    );
});

$router->get('/ip/register', function () use ($router) {
    $ip = \App\Ip::create(['address' => \Illuminate\Support\Facades\Request::ip()]);
    return response($ip->toArray(), 201);
});
