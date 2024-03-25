<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       $Sections = sections::all();

       return view("sections.sections", compact("Sections"));
    }


    public function store(StoreSectionRequest  $request)
    {

        $validated = $request->validated();

        sections::create($validated);

        session()->flash('Add', 'تم اضافة القسم بنجاح ');
        return redirect('/sections');

    }

    public function update(UpdateSectionRequest $request)
    {
        $validated = $request->validated();
    $section = sections::findOrFail($request->id);
    $section->update($validated);

    session()->flash('edit', 'تم تعديل القسم بنجاح');
    return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        sections::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}
