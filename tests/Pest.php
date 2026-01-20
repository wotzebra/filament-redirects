<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Wotz\FilamentRedirects\Http\Middleware\Redirects;
use Wotz\FilamentRedirects\Tests\TestCase;

uses(TestCase::class)->in('Feature');
uses(RefreshDatabase::class)->in('Feature');

function createResponse(string $uri, string $method = 'GET')
{
    $request = Request::create($uri, $method);

    $middleware = new Redirects;

    return $middleware->handle($request, function () {});
}
