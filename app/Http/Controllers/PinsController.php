<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePinRequest;
use App\Http\Requests\UpdatePinRequest;
use App\Jobs\SaveImageFile;
use App\Pin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PinsController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['only' => 'create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pins = Pin::latest()->get();

        return view('pins.index', compact('pins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreatePinRequest $request)
    {
        $data = $request->all();

        $data['image'] = $this->saveImage($request->image);

        $pin = new Pin($data);

        Auth::user()->pins()->save($pin);

        flash()->success('Successfully created new pin.');

        return redirect()->route('pins.show', $pin->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  Pin  $pin
     * @return Response
     */
    public function show(Pin $pin)
    {
        return view('pins.show', compact('pin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Pin $pin
     * @return Response
     */
    public function edit(Pin $pin)
    {
        return view('pins.edit', compact('pin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Pin $pin
     * @return Response
     */
    public function update(Pin $pin, UpdatePinRequest $request)
    {
        $data = $request->all();

        $data['image'] = $this->saveImage($request->image);

        $this->deleteCurrentImagesForThis($pin);

        $pin->update($data);

        flash()->success('Your pin was updated successfully.');

        return redirect()->route('pins.show', $pin->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Pin $pin
     * @return Response
     */
    public function destroy(Pin $pin)
    {
        $pin->delete();

        $this->deleteCurrentImagesForThis($pin);

        flash()->success('Your pin was deleted successfully.');

        return redirect()->route('root_path');
    }

    private function saveImage($image){
        return $this->dispatch(
            new SaveImageFile($image)
        );
    }

    private function deleteCurrentImagesForThis(Pin $pin){
        File::delete(public_path() . config('uploads_paths.pins.original') . $pin->image);
        File::delete(public_path() . config('uploads_paths.pins.medium') . $pin->image);
    }
}
