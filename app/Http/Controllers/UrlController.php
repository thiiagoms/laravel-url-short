<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('urls.index', [
            'urls' => Url::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('urls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (filter_var($request->url, FILTER_VALIDATE_URL)) {

            $short = $this->generateRandomUuid();

            Url::create([
                'original' => $request->url,
                'short' => $short
            ]);

            return redirect()->route('urls.index');
        }

        return redirect()->back()
            ->withErrors("Url {$request->url} is invalid");
    }


    /**
     * Return "uuid" message
     * 
     * @return string
     */
    private function generateRandomUuid(): string
    {
        $specialCharacters = str_split(
            'abcdefghijklmnopqrstuvwxyz'.
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.
            '0123456789!@#$%^&*()'
        );

        $rand = '';

        foreach(array_rand($specialCharacters, 5) as $seed) {
            $rand .= $specialCharacters[$seed];
        }

        return $rand;
    }
    
    
    public function redirect(string $shortUrl)
    {
        $url = Url::where('short', $shortUrl)
            ->get(['original', 'clicks'])->first();

        $url->clicks += 1;

        Url::where('short', $shortUrl)
            ->update(['clicks' => $url->clicks]);
        
        return redirect($url->original);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
