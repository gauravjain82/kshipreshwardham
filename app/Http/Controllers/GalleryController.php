<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');

        $query = GalleryImage::query();

        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $images = $query->orderBy('order')->get();
        $categories = GalleryImage::distinct()->pluck('category');

        return view('pages.gallery', compact('images', 'categories', 'category'));
    }
}
