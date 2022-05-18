<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'contact' => 'required|unique:students|digits:10',
            'email' => 'required|email|unique:students',
            'gender' => 'required',
            'image' => 'required|mimes:png|max:2048'
        ]);

        $name = $request->file('image')->getClientOriginalName();
        $request->image->move(public_path('/images'), $name);

        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->contact = $request->contact;
        $student->image = $name;
        $student->save();
        // You can redirect using this response. using "redirect" and then route name
        // return response(['redirect' => route('home')], 200);
    }
}
