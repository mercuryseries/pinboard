<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePinRequest;
use App\Http\Requests\UpdatePinRequest;
use App\Pin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinsController extends Controller
{

    function __construct() {
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
        $pin = new Pin($request->all());

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
        $pin->update($request->all());

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

        flash()->success('Your pin was deleted successfully.');

        return redirect()->route('root_path');
    }
}
