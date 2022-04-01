<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $types = getMaterialTypes();
        return view('admin.materials.index', compact('types'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'material_name' => 'required'
        ]);

        $materials = new Material();
        $materials->name = $request->material_name;
        $materials->type = $request->materialType;
        $materials->save();
        $pm = 'متریال با موفقیت اضافه شد';
        $types = getMaterialTypes();
        return view('admin.materials.index', compact('types'));
    }


    public function edit($id)
    {
        $selectedMaterial = Material::find($id);
        $types = getMaterialTypes();

        return view('admin.materials.edit', compact('selectedMaterial', 'types'));

    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'material_name' => 'required'
        ]);

        $materials = Material::findOrFail($id);
        $materials->name = $request->material_name;
        $materials->type = $request->materialType;
        $materials->save();
        $pm = 'متریال با موفقیت ویرایش شد';
        $types = getMaterialTypes();
        return view('admin.materials.index', compact('types'));
    }

    public function destroy($id)
    {
        Material::find($id)->delete();
        return redirect('/materials');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $colors = Color::where('name', 'LIKE', '%' . $search . '%')->simplePaginate(10);
        return view('admin.colors.index', compact('colors'));
    }
}
