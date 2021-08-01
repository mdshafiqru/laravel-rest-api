<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $subject =  Subject::all();
      return response()->json($subject);
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
          'subject_name' => 'required|unique:subjects',
          'subject_code' => 'required',
        ]);

        // Query Builder methods
        // $data = array();
        // $data['subject_id'] = $request->subject_id;
        // $data['subject_name'] = $request->subject_name;
        // $data['subject_code'] = $request->subject_code;
        // $insert = DB::table('subjects')->insert($data);

        // Eloquent method
        $subject = Subject::create($request->all());
        return response('Subject inserted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::findorfail($id);
        return response()->json($subject);
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
          'subject_name' => 'required',
          'subject_code' => 'required',
        ]);

        // Eloquent method
        $subject = Subject::findorfail($id)->update($request->all());
        return response('Subject Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $delete = Subject::where('id', $id)->delete();
      return response('Deleted Successfully!'); 
    }
}
