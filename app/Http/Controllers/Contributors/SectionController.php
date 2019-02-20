<?php

namespace App\Http\Controllers\Contributors;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ProjectSection;
use App\Models\Section;
use App\Models\VideoSection;
use Auth;
use DateTime;
use FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SectionController extends Controller
{
    public function index($id)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $course = Course::where('id', $id)->first();
        $courses = Course::where('bootcamp_id', $course->bootcamp_id)->get();
        $sec = Section::where('course_id', $id)->get();
        return view('contrib.kurikulum.kurikulum', [
            'sec' => $sec,
            'course' => $course,
            'courses' => $courses,
            'bootcamp_id' => $course->bootcamp_id,
        ]);
    }

    public function getJsonSection($id)
    {
        $sec = Section::where('course_id', $id)->with('video_section', 'project_section')->orderBy('position', 'asc')->get();

        return response()->json($sec);
    }

    public function store(Request $request)
    {
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            $title = Input::get('title');
            $desk = Input::get('desk');
            $course_id = Input::get('course_id');
            $position = Input::get('position');
            $now = new DateTime();

            $section = new Section();
            $section->title = $title;
            $section->course_id = $course_id;
            $section->deskripsi = $desk;
            $section->position = $position;
            $section->created_at = $now;
            $section->save();
            $response['success'] = true;
        }

        return response()->json($response);
    }

    public function storeProject(Request $request)
    {
        $response = [];
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            $title = Input::get('title');
            $desk = Input::get('desk');
            $type = Input::get('type');
            $value = Input::get('value');
            $section_id = Input::get('section_id');

            // $now = new DateTime();

            $section = new ProjectSection();
            $section->title = $title;
            $section->contributor_id = Auth::guard('contributors')->user()->id;
            $section->section_id = $section_id;
            $section->deskripsi_project = $desk;
            $section->instruksi = $value;
            $section->type = $type;
            // $section->created_at = $now;
            $section->save();
            $response['success'] = true;
        }

        return response()->json($response);
    }

    public function storeVideo(Request $r)
    {
        $response = [];
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            $title = Input::get('title');
            $desk = Input::get('desk');
            $type = Input::get('type');
            $video_id = Input::get('video_id');
            $section_id = Input::get('section_id');
            $position = Input::get('position');

            $section = VideoSection::find($video_id);
            $section->title = $title;
            $section->deskripsi_video = $desk;
            // $section->position = $position;
            $section->save();
            $response['success'] = true;
        }

        return response()->json($response);
    }

    public function storeVideoTemp(Request $r)
    {
        $statusCode = 500;
        $response = [
            'status' => false,
            'message' => 'Upload video failed',
        ];
        $file = Input::file('file');
        $type_video = $file->getMimeType();
        $bootcampid = Input::get('bootcamp_id');
        $courseid = Input::get('course_id');
        $sectionid = Input::get('section_id');
        $position = Input::get('position');

        /* folder bootcamp id */
        if (!is_dir("assets/source/bootcamp/bootcamp-" . $bootcampid)) {
            $newfolder = mkdir("assets/source/bootcamp/bootcamp-" . $bootcampid);
        }

        /* folder course id */
        if (!is_dir("assets/source/bootcamp/bootcamp-" . $bootcampid . "/course-" . $courseid)) {
            $newfolder = mkdir("assets/source/bootcamp/bootcamp-" . $bootcampid . "/course-" . $courseid);
        }

        /* folder section id */
        $DestinationPath = "assets/source/bootcamp/bootcamp-" . $bootcampid . "/course-" . $courseid . "/section-" . $sectionid;
        if (!is_dir($DestinationPath)) {
            $newfolder = mkdir($DestinationPath);
        }

        //insert video
        $videofilename = '';
        if (!empty($file)) {
            $fullname = $file->getClientOriginalName();
            $filename = pathinfo($fullname, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $videofilename = md5($filename . time()) . '.' . strtolower($extension);
            $file->move($DestinationPath, $videofilename);
        }

        /* siapin video */
        $media = FFMpeg::fromDisk('local_public')->open($DestinationPath . '/' . $videofilename);

        /* ambil durasi */
        $duration = $media->getDurationInSeconds();

        /* generate thumbnail */
        $midsecs = round($duration / 2);
        $filename = pathinfo($videofilename, PATHINFO_FILENAME);
        $thumbnailname = 'thumbnail-' . $filename . '.jpg';
        $thumbnail = $media->getFrameFromSeconds($midsecs)->export()->save($DestinationPath . '/' . $thumbnailname);

        /* remove drafts */
        $drafts = VideoSection::where([
            'title' => 'draft',
            'section_id' => $sectionid,
        ])->get();
        foreach ($drafts as $draft) {
            if (file_exists(public_path($draft->image_video))) {
                unlink(public_path($draft->image_video));
            }
            if (file_exists(public_path($draft->file_video))) {
                unlink(public_path($draft->file_video));
            }
            $draft->delete();
        }

        /* save as draft */
        $store = new VideoSection;
        $store->section_id = $sectionid;
        $store->title = 'draft';
        $store->image_video = '/' . $DestinationPath . '/' . $thumbnailname;
        $store->file_video = '/' . $DestinationPath . '/' . $videofilename;
        $store->deskripsi_video = '';
        $store->type_video = $type_video;
        $store->durasi = $duration;
        // $store->created_at = $now;
        // $store->enable = 0;
        $store->position = $position;
        $store->save();

        if ($store) {
            $statusCode = 200;
            $response = [
                'status' => true,
                'message' => 'Upload video success',
                'data' => [
                    'id' => $store->id,
                    'title' => $store->title,
                    'description' => $store->deskripsi_video,
                    'duration' => $store->durasi,
                    'image' => $store->image_video,
                    'video' => $store->file_video,
                ],
            ];
        }

        return response()->json($response, $statusCode);
    }

    public function SaveVideo(){
        set_time_limit(0);
        
        $statusCode = 500;
        $response = [
            'status' => false,
            'message' => 'Upload video failed'
        ];
        $file = Input::file('video');
        $lessonsid = Input::get('lesson_id');
        $i = Input::get('position');

        // if (!is_dir("assets/source/lessons/video")) {
        //     $newforder = mkdir("assets/source/lessons/video");
        // }

        $type_video = $file->getMimeType();
        $DestinationPath = "assets/source/lessons" ;
        if (!is_dir($DestinationPath)) {
            $newforder = mkdir($DestinationPath);
        }

        //insert video
        $lessonsfilename = '';
        if (!empty($file)) {
            $fullname = $file->getClientOriginalName();
            $filename = pathinfo($fullname, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $lessonsfilename = md5($filename.time()). '.' . strtolower($extension);
            $file->move($DestinationPath, $lessonsfilename);
        }

        /* siapin video */
        $media = FFMpeg::fromDisk('local_public')->open($DestinationPath . '/' . $lessonsfilename);
        
        /* ambil durasi */
        $duration = $media->getDurationInSeconds();
        
        /* generate thumbnail */
        $midsecs = round($duration/2);
        $filename = pathinfo($lessonsfilename, PATHINFO_FILENAME);
        $thumbnailname = 'thumbnail-' . $filename . '.jpg';
        $thumbnail = $media->getFrameFromSeconds($midsecs)->export()->save($DestinationPath . '/' . $thumbnailname);

        /* save as draft */
        $store = new VideoSection;
        $store->image_video = '/' . $DestinationPath . '/' . $thumbnailname;
        $store->file_video = '/' . $DestinationPath . '/' . $lessonsfilename;
        $store->description = '';
        $store->type_video = $type_video;
        $store->durasi = $duration;
        // $store->created_at = $now;
        $store->save();

        if ($store) {
            $statusCode = 200;
            $response = [
                'status' => true,
                'message' => 'Upload video success',
            ];
        } else {

        }

        return response()->json($response, $statusCode);
    }
    public function savePosition(Request $r)
    {
        $positions = $r->input('positions');
        foreach ($positions as $position => $id) {
            Section::where([
                'id' => $id,
            ])->update([
                'position' => $position + 1,
            ]);
        }

        return response()->json([
            'success' => true,
        ]);
    }
    public function addLesson(Request $request){
        $response = array();
        if (empty(Auth::guard('contributors')->user()->id)) {
            $response['success'] = false;
        } else {
            
            $now = new DateTime();
            $uid = Auth::guard('contributors')->user()->id;
            // $member = DB::table('contributors')->where('id', $uid)->first();
            $input = Bootcamp::find($request->input('boot_id'));
            // $input = $request->all();  
            $input['status'] = $request->input('status');
            $input->save();
            $response['success'] = true;
        }
        echo json_encode($response);
    }
}
