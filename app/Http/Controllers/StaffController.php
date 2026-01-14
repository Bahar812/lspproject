<?php
namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('q');

        $staff = Staff::query()
            ->when($query, function ($q) use ($query) {
                $q->where('nama', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->orWhere('no_hp', 'like', "%{$query}%")
                    ->orWhere('posisi', 'like', "%{$query}%");
            })
            ->get();

        return view('staff.index', compact('staff', 'query'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:staff',
            'no_hp' => 'required',
            'posisi' => 'required',
        ]);

        Staff::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'posisi' => $request->posisi,
        ]);

        return redirect()->route('staff.index');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:staff,email,' . $id,
            'no_hp' => 'required',
            'posisi' => 'required',
        ]);

        $staff = Staff::findOrFail($id);
        $staff->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'posisi' => $request->posisi,
        ]);

        return redirect()->route('staff.index');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->route('staff.index');
    }
}
