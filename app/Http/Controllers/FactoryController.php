<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFactoryRequest;
use App\Http\Requests\UpdateFactoryRequest;
use App\Models\Factory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factories = Factory::paginate(10);
        return view('factory.index', compact('factories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('factory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFactoryRequest $request)
    {
        $insert = Factory::firstOrCreate(['factory_name' => $request->factory_name, 'location' => $request->location], $request->validated());

        if ($insert->wasRecentlyCreated) {
            return back()->with(['status' => 'success', 'alert-class' => 'border-green-700 text-green-600', 'message' => 'Factory sucessfully added!']);
        }

        return back()->with(['status' => 'error','alert-class' => 'border-red-700 text-red-600', 'message' => 'Duplicate entry, factory already exists!'])->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Factory $factory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factory $factory)
    {
        try {
            return view('factory.edit', compact('factory'));
            
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('factory.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFactoryRequest $request, Factory $factory)
    {
        $factory->update($request->validated());

        return back()->with(['status' => 'success', 'alert-class' => 'border-green-700 text-green-600', 'message' => 'Factory sucessfully updated!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factory $factory)
    {
        try {
           $factory->delete();

           return back()->with(['status' => 'success', 'alert-class' => 'border-green-700 text-green-600', 'message' => 'Factory sucessfully deleted!']);
            
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('factory.index');
        }
    }
}
