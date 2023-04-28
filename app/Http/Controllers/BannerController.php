<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderByDesc('status')->paginate(25);

        return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable',
            'image' => 'required|image',
        ]);

        $requestedImage = $request->file('image');

        if ($requestedImage) {
            $image_name = time() . '.' . $requestedImage->getClientOriginalExtension();
            $imgFile = \Intervention\Image\Facades\Image::make($requestedImage->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();

            Storage::disk('public')->put('banners/' . '/' . $image_name, $imgFile, 'public');
        }

        $data['image'] = $image_name;
        Banner::create($data);

        return redirect()->back()->with("message", __('Données Enregistrées'));

    }

    public function deactivate(banner $banner)
    {
        $banner = Banner::find($banner->id);
        $banner->status = Banner::INACTIVE;
        $banner->save();

        return redirect()->route('banners.index')->with("message", __('Bannière désactivée'));

    }

    public function activate(banner $banner)
    {
        $banner = Banner::find($banner->id);
        $banner->status = Banner::ACTIVE;
        $banner->save();

        return redirect()->route('banners.index')->with("message", __('Bannière activée'));

    }

    public function add_image(Request $request, banner $banner)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:20480',
        ]);
        $requestedImage = $request->file('image');

        if ($requestedImage) {
            $image_name = time() . '.' . $requestedImage->getClientOriginalExtension();
            $imgFile = \Intervention\Image\Facades\Image::make($requestedImage->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();

            Storage::disk('public')->put('banners/' . '/' . $image_name, $imgFile, 'public');
        }

        $banner->image = $image_name;
        $banner->save();

        return redirect()->back()->with('message', __('Image enregistrée avec succès'));
    }

    public function delete_image(banner $banner)
    {
        if (is_file(public_path('storage/banners/' . '' . $banner->image))) {
            unlink(public_path('storage/banners/' . '' . $banner->image));
        }

        Banner::where('id', $banner->id)->update(['image' => null]);

        return redirect()->back()->with('message', __('Image supprimée'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(banner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, banner $banner)
    {
        $data = $request->validate([
            'title' => 'string|nullable',
        ]);
        $banner_id = $request->bannerId;
        Banner::where('id', $banner_id)->update($data);

        return redirect()->back()->with("message", __('Bannière enregistreé'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(banner $banner)
    {
        if ($banner->image) {
            if (is_file($banner->image)) {
                unlink($banner->image);
            }
        }
        $banner->delete();
        return redirect()->route("banners.index")->with('success', __('Données supprimées avec succès'));

    }
}
