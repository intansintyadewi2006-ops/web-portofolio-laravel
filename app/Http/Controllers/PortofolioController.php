<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    private function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048',
        ];
    }

    private function owned(Portfolio $item): void
    {
        abort_unless($item->user_id === request()->user()->id, 403);
    }

    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $items = $user->portfolios()->latest()->get();

        return view('portofolio.index', compact('items'));
    }

    public function create()
    {
        return view('portofolio.form', ['item' => new Portfolio()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('portofolio', 'public');
        }

        /** @var \App\Models\User $user */
        $user = $request->user();
        $user->portfolios()->create($data);

        return redirect()->route('portofolio.index')->with('success', 'Portofolio ditambahkan.');
    }

    public function edit(Portfolio $portofolio)
    {
        $this->owned($portofolio);

        return view('portofolio.form', ['item' => $portofolio]);
    }

    public function update(Request $request, Portfolio $portofolio)
    {
        $this->owned($portofolio);
        $data = $request->validate($this->rules());

        if ($request->hasFile('image')) {
            if ($portofolio->image) {
                Storage::disk('public')->delete($portofolio->image);
            }
            $data['image'] = $request->file('image')->store('portofolio', 'public');
        } else {
            unset($data['image']);
        }

        $portofolio->update($data);

        return redirect()->route('portofolio.index')->with('success', 'Portofolio diperbarui.');
    }

    public function destroy(Portfolio $portofolio)
    {
        $this->owned($portofolio);

        if ($portofolio->image) {
            Storage::disk('public')->delete($portofolio->image);
        }
        $portofolio->delete();

        return redirect()->route('portofolio.index')->with('success', 'Portofolio dihapus.');
    }
}