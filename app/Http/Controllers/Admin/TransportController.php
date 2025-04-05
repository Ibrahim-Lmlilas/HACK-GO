<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transport;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransportController extends Controller
{

    public function index()
    {
        $transports = Transport::latest()->paginate(12);
        return view('admin.transports.index', compact('transports'));
    }


    public function create()
    {
        $destinations = Destination::all();
        return view('admin.transports.create', compact('destinations'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:car,bus,van,motorcycle,bicycle,boat,other',
            'capacity' => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination_id' => 'nullable|exists:destinations,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('transports', 'public');
        }

        Transport::create($validated);

        return redirect()->route('admin.transports.index')
            ->with('success', 'Transport created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {
        $destinations = Destination::all();
        return view('admin.transports.edit', compact('transport', 'destinations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transport $transport)
    {
        $validated = $request->validate([
            'type' => 'required|in:car,bus,van,motorcycle,bicycle,boat,other',
            'capacity' => 'required|integer|min:1',
            'price_per_day' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'destination_id' => 'nullable|exists:destinations,id',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($transport->image) {
                Storage::disk('public')->delete($transport->image);
            }
            $validated['image'] = $request->file('image')->store('transports', 'public');
        }

        $transport->update($validated);

        return redirect()->route('admin.transports.index')
            ->with('success', 'Transport updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transport)
    {
        // Delete image if exists
        if ($transport->image) {
            Storage::disk('public')->delete($transport->image);
        }

        $transport->delete();

        return redirect()->route('admin.transports.index')
            ->with('success', 'Transport deleted successfully.');
    }
}
