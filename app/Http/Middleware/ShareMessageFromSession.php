<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\MessageBag;

class ShareMessageFromSession
{
    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $view;

    /**
     * Create a new error binder instance.
     *
     * @param  \Illuminate\Contracts\View\Factory  $view
     * @return void
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->has('infos')) {
            $this->view->share(
                'infos', $request->session()->get('infos')
            );
        } else {
            $this->view->share('infos', new MessageBag);
        }

        if ($request->session()->has('warnings')) {
            $this->view->share(
                'warnings', $request->session()->get('warnings')
            );
        } else {
            $this->view->share('warnings', new MessageBag);
        }

        return $next($request);
    }
}
