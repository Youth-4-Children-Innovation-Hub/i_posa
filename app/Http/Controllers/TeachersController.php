<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use PHPUnit\Event\Code\Test;

class TeachersController extends Controller
{
    public function GetTeachers()
    {
        $userData = Auth::user();
        $teachers = Teacher::orderBy('created_at', 'DESC')
            ->get();
        return view('centers.teachers', ['teachers' => $teachers, 'userData' => $userData]);
    }

    public function Create(Request $request)
    {
        try {
            $teacher = new Teacher();
            $teacher->name = $request->name;
            $teacher->email = $request->email;
            $teacher->phone_number = $request->phone_number;
            $teacher->created_by = Auth::user()->id;
            $teacher->save();
            return redirect('teachers');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    public function edit($id) {
        $teacher = Teacher::find($id);

        return response()->json(
            [
                'status' => 200,
                'teacher' => $teacher
            ]
        );
    }

    public function update(Request $request)
    {
        $teacher = Teacher::find($request->teacher_id);

        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->phone_number = $request->phone_number;

        if($teacher->save()) {
            return redirect('teachers')->with('success', 'Teacher Updated Successufil');
        }else {
            return redirect()->back()->with('error', 'Failed to Update Teacher');
        }
    }

    public function delete(Request $request)
    {
        $teacher = Teacher::find($request->id);

        if($teacher->delete()){
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);


    }
}
