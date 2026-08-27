<?php

namespace App\Http\Controllers;

use App\Models\AdminNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNoteController extends Controller
{
    /**
     * Save/update admin notes broadcast (admin only).
     */
    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|string|max:10000',
        ]);

        // Keep only one broadcast note (id=1), upsert style
        AdminNote::updateOrCreate(
            ['id' => 1],
            [
                'content'    => $request->content,
                'created_by' => Auth::id(),
            ]
        );

        return back()->with('success', 'Admin notes broadcast to all employees.');
    }

    /**
     * Return the latest admin note as JSON for employee dashboard AJAX.
     */
    public function show()
    {
        $note = AdminNote::find(1);
        return response()->json([
            'content'  => $note?->content ?? '',
            'updated'  => $note?->updated_at?->diffForHumans() ?? null,
        ]);
    }

    /**
     * Clear the broadcast note (admin only).
     */
    public function destroy()
    {
        if (!in_array(Auth::user()->role, ['admin', 'super_admin'])) {
            abort(403, 'Unauthorized action.');
        }

        AdminNote::where('id', 1)->delete();

        return back()->with('success', 'Admin notes cleared.');
    }
}
