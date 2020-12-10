<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;

class ShortUrlController extends Controller
{

    private $lengthUrl = 6;
    private $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function index()
    {
        $urls = ShortUrl::all();
        return view('welcome', compact('urls'));
    }

    public  function getUrl($short_url)
    {
        $url = ShortUrl::where('short_url', $short_url)->first();
        if ($url) {
            return redirect()->away($url->long_url);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'long_url' => 'required|url|unique:short_urls|max:255'
        ]);

        $shortUrl = $this->getShortUrl();

        if ($shortUrl) {
            ShortUrl::create([
                'long_url'  => $request->long_url,
                'short_url' => $shortUrl
            ]);

        }

        return redirect()->route('main_page');
    }

    public function getShortUrl()
    {
        while (true)  {
            $url =$this->generateUrl();
            if (!ShortUrl::where('short_url', $url)->first()) {
                return $url;
            }
        }
    }

    public function generateUrl()
    {
        $shortUrl = '';
        $charactersLen = strlen($this->characters);
        for ($i = 0; $i < $this->lengthUrl; $i++) {
            $shortUrl .= $this->characters[rand(0, ($charactersLen - 1))];
        }
        return $shortUrl;
    }

}
