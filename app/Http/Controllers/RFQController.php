<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RFQ;

class RFQController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'notes' => 'nullable|string',
            'deadline' => 'required|date',
        ]);

        $rfq = RFQ::create($request->only('title', 'notes', 'deadline'));

        return response()->json([
            'message' => 'RFQ created successfully!',
            'data' => $rfq
        ], 201);
    }
}
