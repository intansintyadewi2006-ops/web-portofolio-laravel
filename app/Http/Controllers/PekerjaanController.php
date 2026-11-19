<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class PekerjaanController extends Controller
{
    private function rules(): array
    {
        return [
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ];
    }

    private function owned(Experience $item): void
    {
        abort_unless($item->user_id === request()->user()->id, 403);
    }

    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $items = $user->experiences()->orderByDesc('start_date')->get();

        return view('pekerjaan.index', compact('items'));
    }

    public function create()
    {
        return view('pekerjaan.form', ['item' => new Experience()]);
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $user->experiences()->create($request->validate($this->rules()));

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan ditambahkan.');
    }

    public function edit(Experience $pekerjaan)
    {
        $this->owned($pekerjaan);

        return view('pekerjaan.form', ['item' => $pekerjaan]);
    }

    public function update(Request $request, Experience $pekerjaan)
    {
        $this->owned($pekerjaan);
        $pekerjaan->update($request->validate($this->rules()));

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan diperbarui.');
    }

    public function destroy(Experience $pekerjaan)
    {
        $this->owned($pekerjaan);
        $pekerjaan->delete();

        return redirect()->route('pekerjaan.index')->with('success', 'Data pekerjaan dihapus.');
    }
}