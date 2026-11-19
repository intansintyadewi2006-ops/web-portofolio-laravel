<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class PendidikanController extends Controller
{
    private function rules(): array
    {
        return [
            'institution' => 'required|string|max:255',
            'major' => 'nullable|string|max:255',
            'start_year' => 'required|digits:4|integer|min:1950|max:2100',
            'end_year' => 'nullable|digits:4|integer|gte:start_year',
            'description' => 'nullable|string',
        ];
    }

    private function owned(Education $item): void
    {
        abort_unless($item->user_id === request()->user()->id, 403);
    }

    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $items = $user->educations()->orderByDesc('start_year')->get();

        return view('pendidikan.index', compact('items'));
    }

    public function create()
    {
        return view('pendidikan.form', ['item' => new Education()]);
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $user->educations()->create($request->validate($this->rules()));

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan ditambahkan.');
    }

    public function edit(Education $pendidikan)
    {
        $this->owned($pendidikan);

        return view('pendidikan.form', ['item' => $pendidikan]);
    }

    public function update(Request $request, Education $pendidikan)
    {
        $this->owned($pendidikan);
        $pendidikan->update($request->validate($this->rules()));

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan diperbarui.');
    }

    public function destroy(Education $pendidikan)
    {
        $this->owned($pendidikan);
        $pendidikan->delete();

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan dihapus.');
    }
}