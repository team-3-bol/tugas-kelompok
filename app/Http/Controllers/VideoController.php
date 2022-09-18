<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'video' => 'required|file'
        ]);

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $file_name = $request->name . '.' . $file->getClientOriginalExtension();
            $upload_dir = 'videos';
            $file->move($upload_dir, $file_name);
        }

        $video = new Video();
        $video->name = $request->name;
        $video->file_name = $file_name;
        $video->save();

        session()->flash('success', 'The video created successfully.');
        return redirect()->route('video.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        return view('videos.edit', compact('video'));
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
        $request->validate([
            'name' => 'required',
            'video' => 'file'
        ]);

        $video = Video::find($id);
        $upload_dir = 'videos';
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $file_name = $request->name . '.' . $file->getClientOriginalExtension();
            $file->move($upload_dir, $file_name);
        } else {
            $ext = File::extension(public_path($upload_dir . '/' . $video->file_name));
            $file_name = $request->name . '.' . $ext;
            rename(
                public_path($upload_dir . '/' . $video->file_name),
                public_path($upload_dir . '/' . $file_name)
            );
        }

        $video->name = $request->name;
        $video->file_name = $file_name;
        $video->save();

        session()->flash('success', 'The video updated successfully.');
        return redirect()->route('video.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);
        $video_path = public_path('videos/' . $video->file_name);

        if (file_exists($video_path)) {
            unlink($video_path);
        }

        $video->delete();
        session()->flash('success', 'The video deleted successfully.');
        return redirect()->route('video.index');
    }
}
