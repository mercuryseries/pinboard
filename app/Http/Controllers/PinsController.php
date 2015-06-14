<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePinRequest;
use App\Http\Requests\UpdatePinRequest;
use App\Jobs\SaveImageFile;
use App\Pin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PinsController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('owner', ['only' => ['edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $pins = Pin::with('owner')->latest()->simplePaginate(10);

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

        flash('Successfully created new pin.');

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

        if(isset($data['image'])){
          $data['image'] = $this->saveImage($request->image);

          $this->deleteCurrentImagesForThis($pin);
        }


        $pin->update($data);

        flash('Your pin was updated successfully.');

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

        flash('Your pin was deleted successfully.');

        return redirect()->route('root_path');
    }

    /**
     * Upvote a pin.
     *
     * @param  int $id
     * @return Response
     */
    public function favorite($id)
    {
        Auth::user()->favorites()->attach($id);

        flash('This pin has been marked as favorited.');

        return redirect()->back();
    }

    /**
     * Downvote a pin.
     *
     * @param  int $id
     * @return Response
     */
    public function unfavorite($id)
    {
        Auth::user()->favorites()->detach($id);

        flash('This pin has been removed from your favorites.');

        return redirect()->back();
    }

    /**
     * List all user's voted pins.
     *
     * @param  int $userId
     * @return Response
     */
    public function favorites($userId)
    {
        $pins = User::findOrFail($userId)->favorites()->simplePaginate(10);

        return view('pins.index', compact('pins'));
    }

    private function saveImage($image)
    {
        return $this->dispatch(
            new SaveImageFile($image)
        );
    }

    private function deleteCurrentImagesForThis(Pin $pin)
    {
        File::delete(public_path() . config('uploads_paths.pins.original') . $pin->image);
        File::delete(public_path() . config('uploads_paths.pins.medium') . $pin->image);
    }
}
