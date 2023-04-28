<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::orderByDesc('status')->paginate(25);

        return view('partners.index', compact('partners'));
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
            'url' => 'nullable|string|unique:partners,url',
            'logo' => 'required|image|unique:partners,logo',
        ]);

        $requestedImage = $request->file('logo');

        if ($requestedImage) {
            $image_name = time() . '.' . $requestedImage->getClientOriginalExtension();
            $imgFile = \Intervention\Image\Facades\Image::make($requestedImage->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();

            Storage::disk('public')->put('partners/' . '/' . $image_name, $imgFile, 'public');
        }

        $data['logo'] = $image_name;
        Partner::create($data);

        return redirect()->back()->with("message", __('Données Enregistrées'));

    }

    public function deactivate(Partner $partner)
    {
        $partner = Partner::find($partner->id);
        $partner->status = Partner::INACTIVE;
        $partner->save();

        return redirect()->route('partners.index')->with("message", __('Partenaire désactivé'));

    }

    public function activate(Partner $partner)
    {
        $partner = Partner::find($partner->id);
        $partner->status = Partner::ACTIVE;
        $partner->save();

        return redirect()->route('partners.index')->with("message", __('Partenaire activé'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        //
    }

    public function delete(Partner $partner)
    {
        if ($partner->logo) {
            if (is_file(public_path('storage/partners/' . $partner->logo))) {
                unlink(public_path('storage/partners/' . $partner->logo));
            }
        }
        $partner->delete();
        return redirect()->route('partners.index')->with("message", __('Logo supprimé avec succès'));
    }
}
