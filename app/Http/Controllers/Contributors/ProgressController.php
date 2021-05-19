<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Models\BootcampMember;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menambahkan query untuk menampilkan tipe dan nama kelas bootcamp
        $uid = Auth::guard('contributors')->user()->id;
        $bootcamp = DB::table('contributors')
        ->leftJoin('bootcamp', 'bootcamp.contributor_id' ,'=', 'contributors.id')
        ->leftJoin('bootcamp_member', 'bootcamp.id', '=', 'bootcamp_member.bootcamp_id')
        // ->leftJoin('lessons', 'lessons.contributor_id', '=', 'contributors.id')
        // ->leftJoin('tutorial_member', 'lessons.id', '=', 'tutorial_member.lesson_id')
        ->select('bootcamp.title as nama', 'bootcamp_member.id as id')
        ->where('contributors.id',$uid)
        ->paginate(10);
        return view('contrib.siswa.progress', [
            'bootcamp' => $bootcamp,
        ]);
            }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user_roject = ProjectUser::where('project_section_id', $id)->with('member')->get();
        // return view('contrib.siswa.project_submit', [
        //     'user_project' => $user_roject,
        // ]);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}