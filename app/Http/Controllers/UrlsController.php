<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

use App\Models\ShortUrl;

use DataTables;

class UrlsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
	{
		if ($request->ajax()) {
			$urls = Auth::user()->shortUrls()
				->select(['id', 'original_url', 'short_url', 'is_active', 'created_at'])
				->orderBy('created_at', 'desc')
				->get();

			return DataTables::of($urls)
				->addIndexColumn()
				->editColumn('created_at', function($url) {
					return $url->created_at->format('Y-m-d H:i:s');
				})
				->editColumn('is_active', function($url) {
					return $url->is_active ? '<span class="badge badge-pill bg-primary me-1 my-2">Active</span>' : '<span class="badge badge-pill bg-secondary me-1">Deactivate</span>';
				})
				->addColumn('actions', function($url) {
					return View::make('urls.action', compact('url'))->render();
				})
				->rawColumns(['actions', 'is_active'])
				->make(true);
		}

		return view('urls.index');
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // --
        // Validate inputs
        $request->validate(['original_url' => 'required|url']);

        // --
        // Check if the user has already shortened 10 URLs
        $userUrlCount = Auth::user()->shortUrls()->count();
        if ($userUrlCount >= 10) {
            return response()->json(['error' => 'You have reached the limit of 10 shortened URLs.'], 403);
        }

        // --
        // Unique short URL
        do {
            $shortUrl = Str::random(6);
        } while (ShortUrl::where('short_url', $shortUrl)->exists());

        // --
        // Create URLs
        ShortUrl::create([
            'user_id' => Auth::id(),
            'original_url' => $request->original_url,
            'short_url' => $shortUrl
        ]);

        return response()->json(['short_url' => $shortUrl]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShortUrl $url)
    {
        return view('urls.edit', compact('url'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShortUrl $url)
    {   
        // --
        // Validate inputs
        $request->validate(['original_url' => 'required|url']);

        // --
        // Save URLs
        $url->original_url = $request->original_url;
        $url->save();

        return redirect()->route('urls.index')->with('success', 'URLs updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShortUrl $url)
    {
        // --
        // Delete URLs
        $url->delete();

        return redirect()->route('urls.index')->with('success', 'URLs deleted successfully.');
    }

    public function deactivate($id)
    {
        $url = ShortUrl::find($id);

        // --
        // Deactivate URLs
        if($url) {
            $url->is_active = false;
            $url->save();
        }
        
        return redirect()->route('urls.index')->with('success', 'URLs deactivated successfully.');
    }
}
