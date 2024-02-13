<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        
        return view('sections.add_section',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
        ],[

            'section_name.required' =>'Please Enter Section Name',
            'section_name.unique' =>'Section Name is Already Exist',


        ]);
            Section::create([
                'section_name' => $request->section_name,
                'notes' => $request->description,
                'created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'Section Added Successfully');
            return redirect('/sections');

        }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
      $id=$request->id;
         $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
           
        ],[

            'section_name.required' =>'Please Enter Section Name',
            'section_name.unique' =>'Section Name is Already Exist',
        
           


        ]);
        $up=Section::find($id);
            $up->update([
            'section_name' => $request->section_name,
            'notes' => $request->description,
            ]);

            session()->flash('Add', 'Edit Successfully');
            return redirect('/sections');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Section::find($id)->delete();
            session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/sections');
    }
}
