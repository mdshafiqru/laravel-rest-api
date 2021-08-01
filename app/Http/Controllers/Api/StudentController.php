<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $student =  Student::all();
      return response()->json($student);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
          'class_id' => 'required',
          'section_id' => 'required',
          'roll' => 'required',
          'name' => 'required',
          'phone' => 'required',
          'email' => 'required',
          'password' => 'required',
        ]);

        $data = array();
        $data['class_id'] = $request->class_id;
        $data['section_id'] = $request->section_id;
        $data['roll'] = $request->roll;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['photo'] = $request->photo;
        $data['address'] = $request->address;
        $data['gender'] = $request->gender;


        // Eloquent method
        // $student = Student::create($request->all());
        DB::table('students')->insert($data);
        return response('Student added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findorfail($id);
        return response()->json($student);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
          'class_id' => 'required',
          'section_id' => 'required',
          'roll' => 'required',
          'name' => 'required',
          'phone' => 'required',
          'email' => 'required',
          'password' => 'required',
        ]);

        $data = array();
        $data['class_id'] = $request->class_id;
        $data['section_id'] = $request->section_id;
        $data['roll'] = $request->roll;
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['photo'] = $request->photo;
        $data['address'] = $request->address;
        $data['gender'] = $request->gender;

        // $student = Student::findorfail($id)->update($request->all());
        DB::table('students')->where('id', $id)->update($data);
        return response('Student Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $img = DB::table('students')-> where('id', $id)->first(); // Get the first matching data
      $image_path = $img->photo;
      
      unlink($image_path); // delete image from folder.

      $delete = DB::table('students')-> where('id', $id)->delete(); // Delete student
      return response('Deleted Successfully!'); 
    }
}
