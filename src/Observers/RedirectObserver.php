<?php

namespace Wotz\FilamentRedirects\Observers;

use Illuminate\Support\Facades\Cache;
use Wotz\FilamentRedirects\Models\Redirect;

class RedirectObserver
{
    public function created(Redirect $redirect)
    {
        Cache::forget('redirects');
    }

    public function updated(Redirect $redirect)
    {
        Cache::forget('redirects');
    }

    public function deleted(Redirect $redirect)
    {
        Cache::forget('redirects');
    }
}
