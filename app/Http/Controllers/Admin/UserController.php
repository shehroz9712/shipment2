<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::all();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('users.show', ['user' => $row->id]) . '" class="edit btn btn-primary btn-sm mr-3">View</a>';
                    $btn2 = '<a href="' . route('users.edit', ['user' => $row->id]) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    return $btn . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.orders.index');
    }

    public function create()
    {
        return view('admin.orders.store');
    }

    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'shipment_address' => 'required|string',
            'contact' => 'required|string|max:20',
            'track_id' => 'required|string|max:255',
            'rate_charges' => 'required|numeric',
        ]);

        // Create a new shipment record
        $shipment = Order::create($validatedData);

        // Optionally, you can return a response or redirect
        return redirect()->route('users.index')
            ->with('success', 'Shipment created successfully.');
    }
    public function show($id)
    {
        $shipment = Order::findOrFail($id);
        return view('admin.orders.view', compact('shipment'));
    }
    public function edit($id)
    {
        $shipment = Order::findOrFail($id);
        return view('admin.orders.edit', compact('shipment'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'shipment_address' => 'required|string',
            'contact' => 'required|string|max:20',
            'track_id' => 'required|string|max:255',
            'rate_charges' => 'required|numeric',
        ]);


        // Update the order
        $order = Order::findOrFail($id);
        $order->update($validatedData);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('users.index');
    }
}
