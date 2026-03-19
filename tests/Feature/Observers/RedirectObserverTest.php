<?php

use Illuminate\Support\Facades\Cache;
use Wotz\FilamentRedirects\Models\Redirect;

it('clears cache when creating a redirect', function () {
    Cache::shouldReceive('forget')
        ->with('redirects')
        ->once();

    Redirect::factory()->create();
});

it('clears cache when updating a redirect', function () {
    Cache::shouldReceive('forget')
        ->with('redirects')
        ->twice();

    $redirect = Redirect::factory()->create();

    $redirect->from = '/new';
    $redirect->save();
});

it('clears cache when deleting a redirect', function () {
    Cache::shouldReceive('forget')
        ->with('redirects')
        ->twice();

    $redirect = Redirect::factory()->create();

    $redirect->delete();
});
