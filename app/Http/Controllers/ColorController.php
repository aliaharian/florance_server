<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::paginate();
        return view('admin.colors.index', compact('colors'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'color_name' => 'required'
        ]);

        $colors = new Color();
        $colors->name = $request->color_name;
        $colors->save();
        $pm = 'رنگ با موفقیت اضافه شد';
        $colors = Color::simplePaginate(10);

        return view('admin.colors.index', compact('pm', 'colors'));
    }


    public function edit($id)
    {
        $selectedcolor = Color::find($id);
        $colors = Color::paginate(10);
        return view('admin.colors.edit', compact('selectedcolor', 'colors'));

    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'color_name' => 'required',
        ]);

        $colors = Color::find($id);
        $colors->name = $request->color_name;
        $colors->save();
        $pm = 'رنگ با موفقیت ویرایش شد';
        $colors = Color::simplePaginate(10);
        return view('admin.colors.index', compact('pm', 'colors'));
    }

    public function destroy($id)
    {
        Color::find($id)->delete();
        return redirect('/colors');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $colors = Color::where('name', 'LIKE', '%'.$search.'%')->simplePaginate(10);
        return view('admin.colors.index', compact('colors'));
    }
}
