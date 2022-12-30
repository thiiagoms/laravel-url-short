<?php

namespace App\Http\Controllers;

use App\Services\UrlService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\{RedirectResponse, Request};

/**
 * URL Controller package
 *
 * @package App\Http\Controllers
 * @author  Thiago Silva <thiagom.devsec@gmail.com>
 * @version 1.1
 */
final class UrlController extends Controller
{
    public function __construct(private UrlService $urlService)
    {
    }

    /**
     * List all urls
     *
     * @return View
     */
    public function index(): View
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
        if (is_null($request->urlOrigin) || empty($request->urlOrigin)) {
            return back()->with('error', "URL can't be empty or null");
        }

        $this->urlService->createUrlShort($request->urlOrigin);

        return redirect()->route('url.index');
    }

    /**
     * Redirect user to original url
     *
     * @param Request $request
     * @return void
     */
    public function clickCount(Request $request): void
    {
        $this->urlService->addClickCount($request->short);
    }
}
