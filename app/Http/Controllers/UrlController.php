<?php

namespace App\Http\Controllers;

use App\Services\UrlService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request, Response};

class UrlController extends Controller
{
    /**
     * Logical business
     *
     * @var UrlService
     */
    private UrlService $urlService;

    public function __construct(UrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request): View
    {
        return view('urls.index', [
            'urls' => $this->urlService->urlList()
        ]);
    }

    /**
     * Show the form for creating a new url.
     *
     * @return View
     */
    public function create(): View
    {
        return view('urls.create');
    }

    /**
     * Create new url resource
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {

        if (filter_var($request->url, FILTER_VALIDATE_URL)) {
            $short = $this->urlService->createUrlShort($request->url());

            if ($short) {
                return redirect()->route('urls.index');
            }
        }

        return redirect()->back()->withErrors("Url {$request->url} is invalid");
    }

    /**
     * Redirect user to original url
     *
     * @param string $shortUrl
     * @return RedirectResponse
     */
    public function redirectUser(string $shortUrl): RedirectResponse
    {

        return redirect($this->urlService->redirectTo($shortUrl));
    }
}
