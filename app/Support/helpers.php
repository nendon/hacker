<?php
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contributor;
use App\Models\ContributorNotif;
use App\Models\Income;
use App\Models\Lesson;
use App\Models\Member;
use App\Models\Page;
use App\Models\Service;
use App\Models\UserNotif;
use App\Models\Video;

/**
 *
 */
class Helper
{
    public static function getTotalVideo($lesson_id)
    {
        $data = Video::where('enable', 1)->where('lessons_id', $lesson_id)->count();
        return $data;
    }
    public static function member($field)
    {
        $mem_id = Auth::guard('members')->user()->id;
        if ($mem_id) {
            $members = Member::where('id', '=', $mem_id)->first();
            $result = $members->$field;
            return $result;
        }
    }
    public static function contrib($field)
    {
        $contribID = Auth::guard('contributors')->user()->id;
        if ($contribID) {
            $contrib = Contributor::where('id', '=', $contribID)->first();
            $result = $contrib->$field;
            return $result;
        }
    }
    public static function package($field)
    {
        $now = new DateTime();

        $mem_id = Auth::guard('members')->user()->id;
        if ($mem_id) {
            $services = Service::where('status', '=', 1)->where('members_id', '=', $mem_id)->where('expired', '>=', $now)->first();
            if (count($services) > 0) {
                if ($field == 'title') {
                    $result = $services->title;
                } elseif ($field == 'expired') {

                    $datetime1 = $now;
                    $datetime2 = new DateTime($services->expired);

                    // if($datetime2 > $datetime1 ){
                    $difference = $datetime1->diff($datetime2);
                    $result = $difference->days;
                    // }else {
                    //   $result = 0;
                    // }
                }
                return $result;
            } else {

                if ($field == 'title') {
                    return 'Belum langganan';
                } elseif ($field == 'expired') {
                    return 0;
                }

            }
        }

    }

    public static function pageMenu()
    {
        $pages = Page::where('enable', 1)->paginate(3);
        $html = '';
        $html .= '<ul class="nav-footer">';
        $html .= '<li>Cilsy</li>';
        foreach ($pages as $key => $row) {
            $html .= '<li><a href="' . url('pages/' . $row->url) . '">' . $row->title . '</a></li>';
        }
        $html .= '</ul>';

        return $html;
    }

    public static function searchForm()
    {
        $html = '';
        $html .= '<form class="navbar-form navbar-left form-search" action="" method="post">
        <div class="input-group">
          <input type="text" class="form-control" aria-label="Text input with dropdown button">
          <div class="input-group-btn">
            <button type="button" class="btn btn-secondary dropdown-toggle btn-category" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Kategori <i class="ion-android-arrow-dropdown"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
              <a class="dropdown-item" href="#">Lorem</a>
              <a class="dropdown-item" href="#">Lorem</a>
              <a class="dropdown-item" href="#">Lorem</a>
              <!-- <div role="separator" class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a> -->
            </div>
          </div>
          <span class="input-group-btn">
             <button class="btn btn-secondary btn-search" type="button"><i class="ion-android-search"></i></button>
           </span>
        </div>
      </form>';
        return $html;

    }
}
function cart(){
  $member_id = Auth::guard('members')->user()->id ?? null;
  $data = Cart::where('member_id', $member_id)->with('member', 'contributor', 'lesson', 'bootcamp')->take(3)->get();
  $html='';
  foreach ($data as $cart) {
    if ($cart->bootcamp_id != null){
      $html .='<li class="clearfix">
                <img style="max-width:70px;max-height:70px;" src="'.$cart->bootcamp->cover.'" alt="item1">
                <span class="item-name">'.$cart->bootcamp->title.'</span>
                <span class="item-price">Rp'.number_format($cart->bootcamp->price, 0, ",", ".") .'</span>
                </li>
                ';
    }
    else {
      # code...
      $html .='<li class="clearfix">
              <img style="max-width:70px;max-height:70px;" src="'.$cart->lesson->image.'" alt="item1">
              <span class="item-name">'.$cart->lesson->title.'</span>
              <span class="item-price">Rp'.number_format($cart->lesson->price, 0, ",", ".") .'</span>
              </li>
              ';
    }
  }
  return $html;
//  dd($data);

}
function profilcon()
{
    $contribID = Auth::guard('contributors')->user()->id;
    if (!empty($contribID)) {
        $profil = Contributor::Join('profile', DB::raw('left(contributors.username, 1)'), '=', 'profile.huruf')
            ->where('contributors.id', $contribID)->select('profile.slug as slug')->first();
    } else {
        $profil = 0;
    }

    return $profil->slug;
}
function profil()
{
    $member_id = Auth::guard('members')->user()->id ?? null;
    $profil = Member::Join('profile', DB::raw('left(members.username, 1)'), '=', 'profile.huruf')
        ->where('members.id', $member_id)->select('profile.slug as slug')->first();
    if ($profil) {
        return $profil->slug;
    } else {
        return null;
    }

}
function getCategory()
{
    $categories = Category::all();
    $html = '';

    foreach ($categories as $key => $category) {
        $html .= ' <a class="dropdown-item" name="category" value="' . $category->id . '" href="javascript:void(0)"  onclick="changeCategory(&apos;' . $category->title . '&apos;, ' . $category->id . ')">' . $category->title . '</a>';
    }

    return $html;
}
function getTotalCart()
{
    $member_id = Auth::guard('members')->user()->id ?? null;
    $data = Cart::where('member_id', $member_id)->count();
    return $data;
}

function namemember()
{
    $member_name = substr(Auth::guard('members')->user()->username, '0', 5);
    return $member_name;
}

function set_active($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'icon-active' : '';
        return in_array(Request::is($route . '/*'), $route) ? 'icon-active' : '';

    }
    return Request::path() == $route ? 'icon-active' : '';
    return Request::is($route . '/*') ? 'icon-active' : '';

}

function notif()
{

    $contribID = Auth::guard('contributors')->user()->id;
    $notif = ContributorNotif::where('contributor_id', $contribID)->where('status', 0)->latest()->take(5)->get();
    $html = '';
    foreach ($notif as $value) {
        $url = url('/contributor/comments/detail', $parameters = [$value->slug], $secure = null);
        $html .= '<li><a href="' . $url . '" onclick="contribnotif(' . $value->id . ')">' . $value->title . '</a></li>';

    }
    return $html;
}
function totalnotif()
{
    $mem_id = Auth::guard('contributors')->user()->id;
    $notif = ContributorNotif::where('contributor_id', $mem_id)->where('status', 0)->count();
    return $notif;
}
function notifuser()
{

    $mem_id = Auth::guard('members')->user()->id;
    $notif = UserNotif::where('id_user', $mem_id)->where('status', 0)->latest()->take(5)->get();
    $html = '';

    foreach ($notif as $value) {
        $url = url('kelas/v3', $parameters = [$value->slug], $secure = null);
        $html .= '<li><a href="' . $url . '" onclick="notifview(' . $value->id . ')">' . substr($value->title, '0', 40) . '</a></li>';

    }
    return $html;
}

function totalnotifuser()
{
    $mem_id = Auth::guard('members')->user()->id;
    $notif = UserNotif::where('id_user', $mem_id)->where('status', 0)->count();
    return $notif;
}

function coments()
{
    $contribID = Auth::guard('contributors')->user()->id;
    $html = '';
    if ($contribID !== null) {
        $cotrib = DB::table('comments')
            ->leftjoin('lessons', 'lessons.id', '=', 'comments.lesson_id')
            ->where('comments.contributor_id', $contribID)->where('comments.status', '0')
            ->where('desc', '<>', 1)
            ->select('comments.*')->get();

        $html .= '' . count($cotrib) . '';

    }
    return $html;
}
function badge()
{
    $contribID = Auth::guard('contributors')->user()->id;
    $cotrib = Contributor::where('id', $contribID)->first();

    $html = '';
    if ($cotrib !== null) {
        if ($cotrib->points >= 0 and $cotrib->points <= 99) {
            $html .= 'Kontributor';

        } elseif ($cotrib->points >= 100 and $cotrib->points <= 499) {
            $html .= 'Profesional';
        } elseif ($cotrib->points >= 500 and $cotrib->points <= 1499) {
            $html .= 'Expert';
        } elseif ($cotrib->points >= 1500 and $cotrib->points <= 4999) {
            $html .= 'Master';
        } elseif ($cotrib->points >= 5000) {
            $html .= 'Guru';
        }
    }
    return $html;
}
function points()
{
    $contribID = Auth::guard('contributors')->user()->id;
    $html = '';
    if ($contribID !== null) {
        $cotrib = Contributor::where('id', $contribID)->first();
        $html .= '' . $cotrib->points . '';

    }
    return $html;
}
function income()
{
    if (empty(Auth::guard('contributors')->user()->id)) {
        return redirect('contributor/login');
    }

    $contribID = Auth::guard('contributors')->user()->id;
    $html = '';
    if ($contribID !== null) {

        $row = Income::join('lessons', 'lessons.id', '=', 'invoice_details.lesson_id')
            ->where('lessons.contributor_id', $contribID)
            ->where('flag', '0')->sum('invoice_details.harga_lesson');

        if (count($row) == 0) {
            $row = Income::join('lessons', 'lessons.id', '=', 'invoice_details.lesson_id')
                ->where('contributor_id', $contribID)
                ->where('flag', '0');
        }

        if (count($row) > 0) {
            $html .= '' . number_format($row * 70 / 100, 0, ",", ".") . '';
        } else {
            $html .= '0';
        }
    }
    return $html;
}
function lessons_pending()
{
    $contribID = Auth::guard('contributors')->user()->id;
    $html = '';
    if ($contribID !== null) {
        $data = Lesson::where('contributor_id', $contribID)->where('lessons.status', 0)->count();
        $html .= '' . $data . '';

    }
    return $html;
}
function lessons_publish()
{
    $contribID = Auth::guard('contributors')->user()->id;
    $html = '';
    if ($contribID !== null) {
        $data = Lesson::where('contributor_id', $contribID)->where('lessons.status', 1)->count();
        $html .= '' . $data . '';

    }
    return $html;
}

function search_video_index($videos, $id)
{
    foreach ($videos as $key => $video) {
        if ($video['id'] == $id) {
            return $key;
        }
    }
}

function insert_array($array, $search_key, $insert_key, $insert_value, $insert_after_founded_key = true, $append_if_not_found = false)
{

    $new_array = array();

    foreach ($array as $key => $value) {

        // INSERT BEFORE THE CURRENT KEY?
        // ONLY IF CURRENT KEY IS THE KEY WE ARE SEARCHING FOR, AND WE WANT TO INSERT BEFORE THAT FOUNDED KEY
        if ($key === $search_key && !$insert_after_founded_key) {
            $new_array[$insert_key] = $insert_value;
        }

        // COPY THE CURRENT KEY/VALUE FROM OLD ARRAY TO A NEW ARRAY
        $new_array[$key] = $value;

        // INSERT AFTER THE CURRENT KEY?
        // ONLY IF CURRENT KEY IS THE KEY WE ARE SEARCHING FOR, AND WE WANT TO INSERT AFTER THAT FOUNDED KEY
        if ($key === $search_key && $insert_after_founded_key) {
            $new_array[$insert_key] = $insert_value;
        }

    }

    // APPEND IF KEY ISNT FOUNDED
    if ($append_if_not_found && count($array) == count($new_array)) {
        $new_array[$insert_key] = $insert_value;
    }

    return $new_array;

}

function generateDuration($seconds)
{
    $secondsInAMinute = 60;
    $secondsInAnHour = 60 * $secondsInAMinute;
    $secondsInADay = 24 * $secondsInAnHour;

    // extract days
    $days = floor($seconds / $secondsInADay);

    // extract hours
    $hourSeconds = $seconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    $d = ($days > 0) ? $days . ':' : '';
    $h = ($hours > 0) ? ($hours <= 9 ? '0' . $hours : $hours) . ':' : '00:';
    $m = ($minutes > 0) ? ($minutes <= 9 ? '0' . $minutes : $minutes) . ':' : '00:';
    $s = ($seconds > 0) ? ($seconds <= 9 ? '0' . $seconds : $seconds) : '00';

    return $d . $h . $m . $s;
}

function bool($bool)
{
    $bool = strtolower(trim($bool));
    if (($bool == 'true') || ($bool == 't') || ($bool == 'yes') || ($bool == 'y') || ($bool == '1') || ($bool == 'on')) {
        return true;
    }

    return false;
}

function getNumbers()
{
    $tax = config('cart.tax') / 100;
    $discount = session()->get('coupon')['discount'] ?? 0;
    $code = session()->get('coupon')['name'] ?? null;
    $newSubtotal = (session()->get('total') - $discount);
    if (session()->get('coupon')['type'] == 'fixed') {
        $newSubtotal = (session()->get('total') - $discount);
    } else if (session()->get('coupon')['type'] == 'percent') {
        $newSubtotal = (session()->get('total') - (session()->get('coupon')['percent_off'] / 100) * session()->get('total'));
    } else {
        return 0;
    }
    $newTax = $newSubtotal * $tax;
    $newTotal = $newSubtotal * (1 + $tax);
    return collect([
        'tax' => $tax,
        'discount' => $discount,
        'code' => $code,
        'newSubtotal' => $newSubtotal,
        'newTax' => $newTax,
        'newTotal' => $newTotal,
    ]);
}
