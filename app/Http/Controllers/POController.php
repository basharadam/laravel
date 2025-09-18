<?php
namespace App\Http\Controllers;


use App\Models\PO;
use Illuminate\Http\Request;

class POController extends Controller
{
    public function store(Request $request)
    {
        $po = PO::create([
            'rfq_id' => $request->rfq_id,
            'bid_id' => $request->bid_id,
            'vendor_name' => $request->vendor_name,
            'price' => $request->price,
        ]);

        return response()->json(['message' => 'PO Created', 'po' => $po]);
    }

    public function vendorPOs($vendor_name)
{
    return PO::where('vendor_name', $vendor_name)->orderByDesc('id')->get();
}


public function updateStatus(Request $request)
{
    $po = PO::findOrFail($request->id);
    $po->status = $request->status; // accepted or rejected
    $po->save();

    return response()->json(['message' => 'Status updated']);
}
public function allPOs()
{
    return PO::all();
}

public function confirmPayment(Request $request)
{
    $po = PO::findOrFail($request->id);

    // Optional: Only allow if vendor has accepted
    if ($po->status !== 'accepted') {
        return response()->json(['error' => 'Vendor has not accepted this PO'], 400);
    }

    $po->payment_confirmed = true;
    $po->save();

    return response()->json(['message' => 'Payment confirmed']);
}

}
