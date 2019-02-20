<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectUser;
use App\Models\ProjectSection;
use Auth;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = Auth::guard('contributors')->user()->id;
        $project = ProjectSection::where('contributor_id', $uid)->paginate(5);
        return view('contrib.siswa.project', [
            'project' => $project
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
        $user_roject = ProjectUser::where('project_section_id', $id)->with('member')->get();
        return view('contrib.siswa.project_submit', [
            'user_project' => $user_roject,
        ]);
    }

    public function detail($sectionid, $id)
    {
        $list_project = ProjectUser::where('project_section_id', $sectionid)->with('member')->get();
        $user_roject = ProjectUser::where('id',$id)->where('project_section_id', $sectionid)->with('member')->first();
        $section_project = ProjectSection::where('section_id', $sectionid)->first();
        return view('contrib.siswa.project_detail', [
            'user' => $user_roject,
            'section' => $section_project,
            'list' => $list_project
        ]);
    }
    public function saveProject(Request $request){
        $response = array();
        if (empty(Auth::guard('members')->user()->id)) {
            $response['success'] = false;
        } else {
            
           
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();
            
            $input = ProjectUser::find($request->input('project_id'));
            $input['komentar_contributor'] = $request->input('body');
            $input['contributor_id'] = $uid;
                   $input->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }
    public function acc(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['status'] = 0;
        } else {
   
            $input = ProjectUser::find($request->input('id'));
            $input['status'] = $request->input('status');
            $input->save();
            $response['status'] = $request->input('status');
        }
        echo json_encode($response);
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
