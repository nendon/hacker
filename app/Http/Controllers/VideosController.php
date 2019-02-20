<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Video;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use Validator;

class VideosController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$videos = Video::leftJoin('lessons', 'videos.lessons_id', '=', 'lessons.id')
			->select('videos.*', 'lessons.title as lessons_title')
			->orderBy('videos.position', 'asc')
			->get();
		return view('admin.videos.index', [
			'videos' => $videos,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$lessons = DB::table('lessons')->get();
		return view('admin.videos.create', [
			'lessons' => $lessons,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$rules = array(
			'lesson_id' => 'required',
			'title' => 'required|unique:videos',
			'description' => 'required',
			'image' => 'required',
			'video' => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		} else {

			$videos = new Video;
			$videos->enable = 1;
			$videos->lessons_id = Input::get('lesson_id');
			$videos->title = Input::get('title');
			$videos->durasi = Input::get('durasi');
			$videos->type_video = Input::get('type');
			$videos->image = Input::get('image');
			$videos->video = Input::get('video');
			$videos->description = Input::get('description');
			$videos->created_at = new DateTime();
			$videos->updated_at = new DateTime();
			$videos->save();

			return Redirect('system/videos')->with('success', 'Successfully Created new Data');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$videos = Video::find($id);
		$lessons = Lesson::where('enable', '=', '1')->get();
		return view('admin.videos.edit', [
			'lessons' => $lessons,
			'videos' => $videos,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$rules = array(
			'lesson_id' => 'required',
			'title' => 'required|unique:videos,title,' . $id,
			'description' => 'required',
			'image' => 'required',
			'video' => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		} else {

			// store
			$store = Video::find($id);
			$store->enable = 1;
			$store->lessons_id = Input::get('lesson_id');
			$store->title = Input::get('title');
			$store->durasi = Input::get('durasi');
			$store->type_video = Input::get('type');
			$store->image = Input::get('image');
			$store->video = Input::get('video');
			$store->description = Input::get('description');
			$store->updated_at = new DateTime();
			$store->save();

			// redirect
			return redirect('system/videos')->with('success', 'Data successfully updated');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$delete = Video::find($id);
		$delete->delete();

		return redirect()->back()->with('success', 'Data successfully deleted');
	}
}
