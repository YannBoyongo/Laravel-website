<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

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
            'title_fr' => 'nullable',
            'title_en' => 'nullable',
            'description_fr' => 'nullable',
            'description_en' => 'nullable',
            'image' => 'required|image',
        ]);

        $requestedImage = $request->file('image');

        if ($requestedImage) {
            $image_name = time() . '.' . $requestedImage->getClientOriginalExtension();
            $imgFile = \Intervention\Image\Facades\Image::make($requestedImage->getRealPath())
                ->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();

            Storage::disk('public')->put($folder . '/' . '/' . $image_name, $imgFile, 'public');
        }

       

        $data['image'] = $image_name;
        Banner::create($data);

        return redirect()->back()->with("message", __('Données Enregistrées'));

    }

    public function deactivate(banner $banner)
    {
        $banner = Banner::find($banner->id);
        $banner->status = Banner::banner_INACTIVE;
        $banner->save();

        return redirect()->route('banners.index')->with("message", __('Bannière désactivée'));

    }

    public function activate(banner $banner)
    {
        $banner = Banner::find($banner->id);
        $banner->status = Banner::banner_ACTIVE;
        $banner->save();

        return redirect()->route('banners.index')->with("message", __('Bannière activée'));

    }

    public function add_image(Request $request, banner $banner)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:20480',
        ]);
        $image = $request->file('image');

        $image_name = uploadbannerImageFile($image, 'banners');

        $banner->image = $image_name;
        $banner->save();

        return redirect()->back()->with('message', __('Image enregistrée avec succès'));
    }

    public function delete_image(banner $banner)
    {
        delete_image('banners', $banner);
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
            'title_fr' => 'string|nullable',
            'title_en' => 'string|nullable',
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
