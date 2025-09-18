<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;

class BidController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rfq_id' => 'required|exists:rfqs,id',
            'vendor_name' => 'required|string',
            'price' => 'required|numeric',
            'comments' => 'nullable|string',
        ]);

        $bid = Bid::create($request->all());

        return response()->json(['message' => 'Bid submitted!', 'data' => $bid]);
    }

    public function listByRFQ($id)
    {
        return Bid::where('rfq_id', $id)->get();
    }

    public function approve($id)
    {
        $bid = Bid::findOrFail($id);
        $bid->comments = 'approved';
        $bid->save();

        return response()->json(['message' => 'Bid approved']);
    }

    public function reject($id)
    {
        $bid = Bid::findOrFail($id);
        $bid->comments = 'rejected';
        $bid->save();

        return response()->json(['message' => 'Bid rejected']);
    }
}

