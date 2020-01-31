<?php

namespace App\Http\Controllers\Contributors;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Video;
use Auth;
use DateTime;
use FFMpeg;
use Illuminate\Support\Facades\Input;
use Validator;

class VideosController extends Controller
{
    public function create($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $lesson = Lesson::where('id', $lessonsid)->first();

        if ($lesson == null) {
            return redirect('not-found');
        }
        if ($lesson->status == 2) {
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('no-delete', 'Tutorial sedang / dalam verifikasi!');
        }
        $video = Video::where('lessons_id', $lessonsid)->orderBy('position', 'asc')->get();
        $count_video = count($video);

        # code...
        return view('contrib.videos.create', [
            'lesson' => $lesson,
            'count_video' => $count_video,
        ]);
    }
    
    public function doCreate($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        # code...
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'judul' => 'required',
            'video.*'  => 'mimes:mp4,mov,ogg,webm |required|max:500000',
            'image.*' => 'mimes:jpeg,jpg,png,gif|required|max:30000'
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $now = new DateTime();
            $cid = Auth::guard('contributors')->user()->id;
            $title = Input::get('judul');
            $image_video = Input::file('image');
            $lessons_video = Input::file('video');
            // dd($lessons_video);
            $description = Input::get('desc');
            $video = Video::where('lessons_id', $lessonsid)->orderBy('position', 'asc')->get();
            $count_video = count($video);
            // dd(!is_dir("assets/source/lessons/lessons-$lessonsid"));
            if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder = mkdir("assets/source/lessons/lessons-" . $lessonsid);
            }

            $i = $count_video + 1;
            foreach ($title as $key => $titles) {
                $type_video = $lessons_video[$key]->getMimeType();
                $DestinationPath = "assets/source/lessons/lessons-" . $lessonsid . "/video-" . $i;
                if (!is_dir($DestinationPath)) {
                    $newforder = mkdir($DestinationPath);
                }
                // dd($DestinationPath);
                //insert video
                $lessonsfilename = '';
                if (!empty($lessons_video[$key])) {
                    $lessonsfilename = $lessons_video[$key]->getClientOriginalName();
                    $lessons_video[$key]->move($DestinationPath, $lessonsfilename);
                }
                //insert image
                /* if (!empty($image_video[$key])) {
                    $imagefilename = $image_video[$key]->getClientOriginalName();
                    $image_video[$key]->move($DestinationPath, $imagefilename);
                } else {
                    $imagefilename = '';
                }
                if ($imagefilename == '') {
                    $url_image = $imagefilename;
                } else {
                    $url_image = $DestinationPath . '/' . $imagefilename;
                }
                //insert video
                if (!empty($lessons_video[$key])) {
                    $lessonsfilename = $lessons_video[$key]->getClientOriginalName();
                    $lessons_video[$key]->move($DestinationPath, $lessonsfilename);
                } else {
                    $lessonsfilename = '';
                }
                if ($lessonsfilename == '') { 
                    $url_video = $lessonsfilename;
                } else {
                    $url_video = $DestinationPath . '/' . $lessonsfilename;
                } */

                /* siapin video */
                $media = FFMpeg::fromDisk('local_public')->open($DestinationPath . '/' . $lessonsfilename);
                /* ambil durasi */
                $duration = $media->getDurationInSeconds();
                // dd($duration);
                /* generate thumbnail */
                $filename = pathinfo($lessonsfilename, PATHINFO_FILENAME);
                $thumbnailname = 'thumbnail-' . $filename . '.jpg';
                $thumnail = $media->getFrameFromSeconds(0)->export()->save($DestinationPath . '/' . $thumbnailname);
                // dd($thumnail);

                $store = new Video;
                $store->lessons_id = $lessonsid;
                $store->title = $titles;
                $store->image = '/' . $DestinationPath . '/' . $thumbnailname;
                $store->video = '/' . $DestinationPath . '/' . $lessonsfilename;
                $store->description = $description[$key];
                $store->type_video = $type_video;
                $store->durasi = $duration;
                $store->created_at = $now;
                $store->enable = 1;
                $store->save();
                // dd($store->video);
                /*if($store){
                dd($url_video);
                $media = FFMpeg::open($url_video);
                // $frame = FFMpeg::open($link)
                //         ->getFrameFromSeconds(10)
                //         ->export()
                //         ->toDisk('public')
                //         ->save($filename.'.png');
                dd($media);
                $durationInSeconds = $media->getDurationInSeconds();
                // dd($media);

                }*/
                $i++;
            }
            // Session::set('lessons_title',$title);
            // Session::set('lessons_category_id',$category_id);
            // Session::set('lessons_image',$image);
            // Session::set('lessons_description',$description);
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('success', 'Penambahan video berhasil');
        }
    }

    public function edit($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $lesson = Lesson::where('id', $lessonsid)->first();

        if ($lesson == null) {
            return redirect('not-found');
        }
        if ($lesson->status == 2) {
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('no-delete', 'Tutorial sedang / dalam verifikasi!');
        }
        $video = Video::where('lessons_id', $lessonsid)->orderBy('position', 'asc')->get();
        $count_video = count($video);

        # code...
        return view('contrib.videos.edit', [
            'lesson' => $lesson,
            'count_video' => $count_video,
            'video' => $video,
        ]);
    }

    public function doEdit($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        # code...
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'judul' => 'required',
            //   'video.*'  => 'mimes:mp4,mov,ogg,webm|max:100000',
            //   'image.*' => 'mimes:jpeg,jpg,png,gif|max:30000' // max 10000kb
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $now = new DateTime();
            $cid = Auth::guard('contributors')->user()->id;
            $title = Input::get('judul');
            $image_video = Input::file('image');
            $image_text = Input::get('image_text');
            $lessons_video = Input::file('video');
            $video_text = Input::get('video_text');
            $type_videos = Input::get('type_video');
            $description = Input::get('desc');

            $delete = Video::where('lessons_id', $lessonsid)->delete();
            $video = Video::where('lessons_id', $lessonsid)->orderBy('position', 'asc')->get();
            $count_video = count($video);

            if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
                $newforder = mkdir("assets/source/lessons/lessons-" . $lessonsid);
            }

            $i = $count_video + 1;

            foreach ($title as $key => $titles) {
                if (!empty($image_video[$key])) {
                    $type_video = $lessons_video[$key]->getMimeType();
                } else {
                    $type_video = $type_videos[$key];
                }

                if (!is_dir("assets/source/lessons/lessons-" . $lessonsid . "/video-" . $i)) {
                    $newforder = mkdir("assets/source/lessons/lessons-" . $lessonsid . "/video-" . $i);
                }
                $DestinationPath = 'assets/source/lessons/lessons-' . $lessonsid . '/video-' . $i;

                //insert image
                if (!empty($image_video[$key])) {
                    $imagefilename = $image_video[$key]->getClientOriginalName();
                    $image_video[$key]->move($DestinationPath, $imagefilename);
                } else {
                    $imagefilename = '';
                }
                if ($imagefilename == '') {
                    $url_image = $image_text[$key];
                } else {
                    $urls = url('');
                    $url_image = $urls . '/assets/source/lessons/video-' . $i . '/' . $imagefilename;
                }

                //insert video
                if (!empty($lessons_video[$key])) {
                    $lessonsfilename = $lessons_video[$key]->getClientOriginalName();
                    $lessons_video[$key]->move($DestinationPath, $lessonsfilename);
                } else {
                    $lessonsfilename = '';
                }
                if ($lessonsfilename == '') {
                    $url_video = $video_text[$key];
                } else {
                    $urls = url('');
                    $url_video = $urls . '/assets/source/lessons/video-' . $i . '/' . $lessonsfilename;
                }
                /* siapin video */
                // $media = FFMpeg::fromDisk('local_public')->open($DestinationPath . '/' . $lessonsfilename);
                // /* ambil durasi */
                // $duration = $media->getDurationInSeconds();
                // // dd($duration);
                // /* generate thumbnail */
                // $filename = pathinfo($lessonsfilename, PATHINFO_FILENAME);
                // $thumbnailname = 'thumbnail-' . $filename . '.jpg';
                // $thumnail = $media->getFrameFromSeconds(0)->export()->save($DestinationPath . '/' . $thumbnailname);
                // dd($thumnail);

                $store = new Video;
                $store->lessons_id = $lessonsid;
                $store->title = $titles;
                // $store->image = $thumbnailname;
                $store->video = $url_video;
                $store->description = $description[$key];
                $store->type_video = $type_video;
                // $store->durasi = $duration;
                $store->created_at = $now;
                $store->enable = 1;
                $store->save();
                $i++;
            }

            // Session::set('lessons_title',$title);
            // Session::set('lessons_category_id',$category_id);
            // Session::set('lessons_image',$image);
            // Session::set('lessons_description',$description);

            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('success', 'video berhasil update');

        }
    }
    public function destroy($id) {
		$delete = Video::where('id', $id)->delete();

		return redirect()->back()->with('success', 'Data successfully deleted');
    }
    
    public function createNew($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $lesson = Lesson::where('id', $lessonsid)->first();

        if ($lesson == null) {
            return redirect('not-found');
        }
        if ($lesson->status == 2) {
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('no-delete', 'Tutorial sedang / dalam verifikasi!');
        }

        /* delete draft video */
        $drafts = Video::where([
            'title' => 'draft',
            'enable' => 0,
            'lessons_id' => $lessonsid
        ])->get();
        foreach ($drafts as $draft) {
          if (file_exists(public_path($draft->image))) {
            unlink(public_path($draft->image));
          }
          if (file_exists(public_path($draft->video))) {
            unlink(public_path($draft->video));
          }
          $draft->delete();
        }

        $videos = Video::where('lessons_id', $lessonsid)->orderBy('position', 'asc')->get();
        $count_video = count($videos);

        # code...
        return view('contrib.videos.create_new', [
            'lesson' => $lesson,
            'count_video' => $count_video,
        ]);
    }
    
    public function doCreateNew($lessonsid)
    {
        // dd($lessonsid, Input::all());
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        # code...
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'videos.*.title' => 'required',
            // 'videos.*.description' => 'required',
            //   'video.*'  => 'mimes:mp4,mov,ogg,webm |required|max:100000',
            //   'image.*' => 'mimes:jpeg,jpg,png,gif|required|max:30000'
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $videos = array_values(Input::get('videos'));
            foreach ($videos as $position => $video) {
                Video::where([
                    'lessons_id' => $lessonsid,
                    'id' => $video['id'],
                ])->update([
                    // 'id' => $video['id'],
                    'lessons_id' => $lessonsid,
                    'title' => $video['title'],
                    'description' => $video['description'],
                    'durasi' => $video['duration'],
                    'image' => $video['image'],
                    'video' => $video['video'],
                    'enable' => 1,
                    'position' => $position + 1
                ]);
            }
            
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('success', 'Penambahan video berhasil');
        }
    }
    
    public function editNew($lessonsid)
    {
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        $lesson = Lesson::where('id', $lessonsid)->first();

        if ($lesson == null) {
            return redirect('not-found');
        }
        if ($lesson->status == 2) {
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('no-delete', 'Tutorial sedang / dalam verifikasi!');
        }

        /* delete draft video */
        $drafts = Video::where([
            'title' => 'draft',
            'enable' => 0,
            'lessons_id' => $lessonsid
        ])->get();
        foreach ($drafts as $draft) {
          if (file_exists(public_path($draft->image))) {
            unlink(public_path($draft->image));
          }
          if (file_exists(public_path($draft->video))) {
            unlink(public_path($draft->video));
          }
          $draft->delete();
        }

        $videos = Video::where('lessons_id', $lessonsid)->orderBy('position', 'asc')->get();
        $count_video = count($videos);

        # code...
        return view('contrib.videos.edit_new', [
            'lesson' => $lesson,
            'count_video' => $count_video,
            'videos' => $videos
        ]);
    }
    
    public function doEditNew($lessonsid)
    {
        // dd($lessonsid, Input::all());
        if (empty(Auth::guard('contributors')->user()->id)) {
            return redirect('contributor/login');
        }
        # code...
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'videos.*.title' => 'required',
            // 'videos.*.description' => 'required',
            //   'video.*'  => 'mimes:mp4,mov,ogg,webm |required|max:100000',
            //   'image.*' => 'mimes:jpeg,jpg,png,gif|required|max:30000'
        );
        $validator = Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $videos = array_values(Input::get('videos'));
            foreach ($videos as $position => $video) {
                if (bool($video['delete'])) {
                    $exist = Video::where([
                        'lessons_id' => $lessonsid,
                        'id' => $video['id'],
                    ])->first();

                    if (file_exists(public_path($exist->image))) {
                        unlink(public_path($exist->image));
                    }
                    if (file_exists(public_path($exist->video))) {
                        unlink(public_path($exist->video));
                    }

                    $exist->delete();
                } else {
                    Video::where([
                        'lessons_id' => $lessonsid,
                        'id' => $video['id'],
                    ])->update([
                        // 'id' => $video['id'],
                        'lessons_id' => $lessonsid,
                        'title' => $video['title'],
                        'description' => $video['description'],
                        'durasi' => $video['duration'],
                        'image' => $video['image'],
                        'video' => $video['video'],
                        'enable' => 1,
                        'position' => $position + 1
                    ]);
                } 
            }
            
            return redirect('contributor/lessons/' . $lessonsid . '/view')->with('success', 'Perubahan video berhasil');
        }
    }

    public function uploadVideo()
    {
        set_time_limit(0);
        
        $statusCode = 500;
        $response = [
            'status' => false,
            'message' => 'Upload video failed'
        ];
        $file = Input::file('video');
        $lessonsid = Input::get('lesson_id');
        $i = Input::get('position');

        if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
            $newforder = mkdir("assets/source/lessons/lessons-" . $lessonsid);
        }

        $type_video = $file->getMimeType();
        $DestinationPath = "assets/source/lessons/lessons-" . $lessonsid . "/video-" . $i;
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
        $store = new Video;
        $store->lessons_id = $lessonsid;
        $store->title = 'draft';
        $store->image = '/' . $DestinationPath . '/' . $thumbnailname;
        $store->video = '/' . $DestinationPath . '/' . $lessonsfilename;
        $store->description = '';
        $store->type_video = $type_video;
        $store->durasi = $duration;
        // $store->created_at = $now;
        $store->enable = 0;
        $store->position = $i;
        $store->save();

        if ($store) {
            $statusCode = 200;
            $response = [
                'status' => true,
                'message' => 'Upload video success',
                'data' => [
                    'id' => $store->id,
                    'title' => $store->title,
                    'description' => $store->description,
                    'duration' => $store->durasi,
                    'image' => $store->image,
                    'video' => $store->video,
                ]
            ];
        } else {

        }

        return response()->json($response, $statusCode);
    }

    public function uploadVideoChange()
    {
        set_time_limit(0);
        
        $statusCode = 500;
        $response = [
            'status' => false,
            'message' => 'Upload video failed'
        ];
        $file = Input::file('video');
        $lessonsid = Input::get('lesson_id');
        $i = Input::get('position');
        $id = Input::get('id');

        if (!is_dir("assets/source/lessons/lessons-$lessonsid")) {
            $newforder = mkdir("assets/source/lessons/lessons-" . $lessonsid);
        }

        $type_video = $file->getMimeType();
        $DestinationPath = "assets/source/lessons/lessons-" . $lessonsid . "/video-" . $i;
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
        $store = Video::find($id);
        $old_image = $store->image;
        $old_video = $store->video;
        // $store = new Video;
        // $store->lessons_id = $lessonsid;
        // $store->title = 'draft';
        $store->image = '/' . $DestinationPath . '/' . $thumbnailname;
        $store->video = '/' . $DestinationPath . '/' . $lessonsfilename;
        // $store->description = '';
        // $store->type_video = $type_video;
        $store->durasi = $duration;
        // $store->created_at = $now;
        // $store->enable = 0;
        $store->save();

        if ($store) {
            $statusCode = 200;
            $response = [
                'status' => true,
                'message' => 'Change video success',
                'data' => [
                    'id' => $store->id,
                    'title' => $store->title,
                    'description' => $store->description,
                    'duration' => $store->durasi,
                    'image' => $store->image,
                    'video' => $store->video,
                ]
            ];

            /* remove old files */
            if (file_exists(public_path($old_image))) {
                unlink(public_path($old_image));
            }
            if (file_exists(public_path($old_video))) {
                unlink(public_path($old_video));
            }
        } else {

        }

        return response()->json($response, $statusCode);
    }
}
