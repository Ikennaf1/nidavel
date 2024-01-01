<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\ImageController;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        return view('dashboard.media.index');
    }

    public function all(Request $request)
    {
        $filter = $request->filter;

        if (!isset($filter) || $filter === '') {
            $media = getContents(public_path("my_exports/uploads/images"));
            $subtitle = 'Images';
        }

        else if ($filter === 'audios') {
            $media = getContents(public_path("my_exports/uploads/audios"));
            $subtitle = 'Audios';
        }

        else if ($filter === 'videos') {
            $media = getContents(public_path("my_exports/uploads/videos"));
            $subtitle = 'videos';
        }

        else {
            $media = getContents(public_path("my_exports/uploads/images"));
            $subtitle = 'Images';
        }

        return view('dashboard.media.index', [
            'media'     => $media,
            'subtitle'  => $subtitle
        ]);
    }

    /**
     * Adds media to storage
     */
    public function add(Request $request)
    {
        if (!empty($request->file('files'))) {
            $i = 0;
            foreach ($request->file('files') as $key => $file) {
                $file->store("/$request->media_type");
            }
        }
        
        return redirect()->back();
    }

    /**
     * Deletes a resource
     */
    public function delete(Request $request)
    {
        $body = $request->getContent();
        unlink(public_path("$body"));
        return response()->json([
            'status' => 'success'
        ]);
    }
}
