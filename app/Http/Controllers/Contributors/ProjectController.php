<?php

namespace App\Http\Controllers\Contributors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectUser;
use App\Models\ProjectSection;
use App\Models\Section;
use App\Models\Bootcamp;
use App\Models\Member;
use App\Models\Contributor;
use App\Notifications\ContribProject;
use App\Notifications\ContribProjectTolak;
use Auth;
use DB;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        } else {
            
        $uid = Auth::guard('contributors')->user()->id;
        $project = ProjectSection::where('contributor_id', $uid)->paginate(5);
        $bcid = DB::table('bootcamp')->get();
        return view('contrib.siswa.project', [
            'project' => $project,
            'bcid' => $bcid
        ]);
        }
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
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        } 
        $user_roject = ProjectSection::join('project_user', 'project_section.id', 'project_user.project_section_id')
                        ->join('members', 'project_user.member_id', 'members.id')->where('project_section.section_id', $id)
                        ->select('project_user.*', 'project_section.section_id as section_id',  'members.avatar as avatar', 'members.username as username')->paginate(10);
        return view('contrib.siswa.project_submit', [
            'user_project' => $user_roject,
        ]);
    
    }

    public function detail($sectionid, $id)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        } 
        $list_project = ProjectSection::join('project_user', 'project_section.id', 'project_user.project_section_id')
                        ->join('members', 'project_user.member_id', 'members.id')->where('project_section.section_id', $sectionid)
                        ->select('project_user.*', 'project_section.section_id as section_id',  'members.avatar as avatar', 'members.username as username')->get();
        $user_roject = ProjectSection::join('project_user', 'project_section.id', 'project_user.project_section_id')
        ->join('members', 'project_user.member_id', 'members.id')->where('project_user.id', $id)
        ->select('project_user.*', 'project_section.section_id as section_id',  'members.avatar as avatar', 'members.username as username')->first();
        
        $section_project = ProjectSection::where('section_id', $sectionid)->first();
        return view('contrib.siswa.project_detail', [
            'user' => $user_roject,
            'section' => $section_project,
            'list' => $list_project
        ]);
       
    }
    public function saveProject(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        }
            
           
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();
            
            $input = ProjectUser::find($request->input('project_id'));
            $input['komentar_contributor'] = $request->input('body');
            $input['contributor_id'] = $uid;
                   $input->save();
            $response['success'] = true;

            
       
        echo json_encode($response);
    }
    public function acc(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['status'] = 0;
        } 
   
            $input = ProjectUser::find($request->input('id'));
            $input['status'] = $request->input('status');
            $input->save();
            
            $uid = Auth::guard('contributors')->user()->id;
            $lesson = ProjectUser::Find($request->input('id'));
            $mem = ProjectUser::where('id', $request->input('id'))->first();
            $section = ProjectSection::Find($lesson->project_section_id);

            $bc = Section::join('course', 'course.id', 'section.course_id')
                  ->join('bootcamp', 'bootcamp.id', 'course.bootcamp_id')
                  ->where('section.id', $section->section_id)->first();
            $member = Member::Find($lesson->member_id);
            $bootcamp = Bootcamp::Find($bc->bootcamp_id ); 
            $contrib = Contributor::find($uid);
            if($request->input('status') == 2){
            $member->notify(new ContribProject($member,$bootcamp,  $section, $contrib));
            }else{
                $member->notify(new ContribProjectTolak($member,$bootcamp,  $section, $contrib));
            }
            
            $response['status'] = $request->input('status');
       
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
