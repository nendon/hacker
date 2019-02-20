<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Validator;

use App\Models\Page;

use Session;
class PagesController extends Controller
{
  public function index($page)
  {
    $pages = Page::where('enable','=',1)->where('url','=',$page)->first();
    if (count($pages) > 0) {
      return view('web.pages',[
        'pages' => $pages
      ]);
    }else {
      return view('errors.404');
    }
  }
}
