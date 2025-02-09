<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Timeline;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\DB;

class StatusPengaduanController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user_id = $request->input('user_id');

            if ($user_id) {
                $pengaduanList = Pengaduan::where('user_id', $user_id)->get();

                if ($pengaduanList->isEmpty()) {
                    return response()->json([], 404);
                }

                $timelines = Timeline::whereIn('pengaduan_id', $pengaduanList->pluck('id'))
                    ->orderBy('created_at', 'asc')
                    ->get();
            } else {
                return response()->json(['message' => 'User ID is required'], 400);
            }

            $formattedTimelines = $timelines->map(function ($timeline) {
                return [
                    'pengaduan_id' => $timeline->pengaduan_id,
                    'status' => $timeline->status,
                    'catatan' => $timeline->catatan,
                    'satgas_nama' => $timeline->satgas ? $timeline->satgas->name : null,
                ];
            });

            return response()->json($formattedTimelines, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



}
