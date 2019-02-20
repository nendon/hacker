<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// SITEMAP

Route::get('generate-sitemap/', 'SitemapController@index');
Route::get('sitemap.xml', function () {
    $path = storage_path('sitemap.xml');

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

// HOME PAGE
Route::get('/', 'Web\HomeController@index');
// LESSONS PAGE
Route::get('lessons/{by}/{keyword}', 'Web\LessonsController@index');
Route::get('lessons/{lessons}', 'Web\LessonsController@preview');
Route::get('kelas/v3/{lessons}', 'Web\LessonsController@detail');
Route::get('lessons/{lessons}/{quiz}', 'Web\LessonsController@quiz');
Route::get('dashboard/{lessons}', 'Web\Members\LessonsMemberController@detail');
Route::post('lessons/getplaylist', 'Web\LessonsController@getplaylist');
Route::post('lessons/getquizlist', 'Web\LessonsController@getquizlist');
Route::get('lessons/coments/getComments/{lesson_id}', 'Web\LessonsController@getComments');
Route::post('lessons/coments/doComment', 'Web\LessonsController@doComment');
Route::post('lessons/videoTracking', 'Web\LessonsController@videoTracking');
Route::post('lessons/LessonsQuiz', 'Web\LessonsController@LessonsQuiz');

//attachment
// Route::post('attachment', 'AttachmentController@upload');
// Search
Route::get('search', 'Web\SearchController@index');
Route::get('search/autocomplete/', 'Web\SearchController@autocomplete');
Route::get('category/{id}', 'Web\LessonController@getSearchcategory');

// Point
Route::get('point', 'Web\PointController@index');

// Cart
Route::get('cart', 'Web\CartController@index')->name('cart');
Route::post('cart/add', 'Web\CartController@store');
Route::post('cart/add/bootcamp', 'Web\CartController@storeBootcamp');
Route::delete('cart/delete/{cart}', 'Web\CartController@destroy');

// Contributor Profile
Route::get('contributor/profile/{username}', 'Web\ContributorsController@getProfile');

// PAGES
Route::get('pages/{pages}', 'Web\PagesController@index');

// VERITRANS
Route::get('checkout', 'Veritrans\VtwebController@vtweb');
Route::post('notification/handling', 'Veritrans\VtwebController@notification');
// PAYMENT
Route::get('summary', 'Web\SummaryController@summary')->name('summary');
Route::post('member/checkout', 'Web\Members\PackageController@summary');
Route::get('payment/{response}', 'Web\PaymentController@index');
Route::post('coupon', 'Web\CouponsController@store')->name('coupon.store');
Route::delete('coupon/delete', 'Web\CouponsController@destroy')->name('coupon.destroy');
Route::delete('coupon/ganti', 'Web\CouponsController@ganti')->name('coupon.destroy');

//page
// Route::get('/harga', 'HargaController@index');
Route::get('/kontak', function () {
    return view('web.contact');
});
Route::get('/faq', function () {
    return view('web.faq');
});
Route::get('/carapesan', function () {
    return view('web.cara');
});
Route::get('/petunjuk', function () {
    return view('web.petunjuk');
});
Route::get('/kebijakan', function () {
    return view('web.kebijakan');
});
Route::get('/tentang', function () {
    return view('web.tentang');
});

//bootcamp


Route::get('/bootcamp/projectView', function () {
	return view('web.courses.ProjectView');
});

Route::get('/bootcamp/course', 'Web\BootcampController@member');
Route::get('bootcamp/{bootcamp}', 'Web\BootcampController@bootcamp');
Route::get('bootcamp/{bootcamp}/courseSylabus/', 'Web\CourseController@courseSylabus');
Route::post('bootcamp/coments/doComment', 'Web\BootcampController@doComment');
Route::get('bootcamp/coments/getComments/{bootcamp_id}', 'Web\BootcampController@getComments');

Route::get('bootcamp/{bootcamp}/courseLesson/{course}', 'Web\CourseController@courseLesson');
Route::get('bootcamp/{bootcamp}/videoPage/{section}', 'Web\CourseController@videoPage');
Route::get('bootcamp/{bootcamp}/projectSubmit/{section}', 'Web\CourseController@projectSubmit');
Route::post('bootcamp/submit', 'Web\CourseController@submit');
Route::post('bootcamp/upload/saveProject', 'Web\CourseController@saveProject');
Route::post('bootcamp/contrib/saveProject', 'Contributors\ProjectController@saveProject');



//Browse Bootcamp
Route::get('browse/bootcamp', 'Web\BrowseController@index');
Route::get('browse/bootcamp/{slug}', 'Web\BrowseController@detail');

/*
|--------------------------------------------------------------------------
| Cronjob Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('cron/mail/user/reminder/payment', 'Cron\ReminderController@index');

/*
|--------------------------------------------------------------------------
| Member Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
// Route::get('member', 'Web\Members\AuthController@index');

// Route::get('member/signin', 'Web\Members\AuthController@signin');
// Route::post('member/signin', 'Web\Members\AuthController@dosignin');
// Route::get('member/signout', 'Web\Members\AuthController@signout');
Route::post('member/change-password', 'Web\Members\PasswordController@doSubmit');
Route::get('member/change-password', 'Web\Members\PasswordController@index');
Route::post('member/reset/update', 'Web\Members\AuthController@doupdate');
Route::get('member/reset/update/{token}', 'Web\Members\AuthController@updatereset');

Route::get('member/signup', 'Web\Members\MemberAuth\RegisterController@showRegistrationForm');
Route::post('member/signup', 'Web\Members\MemberAuth\RegisterController@register');
Route::get('member/signin', 'Web\Members\MemberAuth\LoginController@showLoginForm');
Route::post('member/signin', 'Web\Members\MemberAuth\LoginController@login');
Route::get('member/signout', 'Web\Members\MemberAuth\LoginController@logout');
Route::post('member/email', 'Web\Members\MemberAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('member/reset', 'Web\Members\MemberAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('member/reset', 'Web\Members\MemberAuth\ResetPasswordController@reset');
Route::get('member/reset/{token}', 'Web\Members\MemberAuth\ResetPasswordController@showResetForm');
Route::get('member/profile/edit', 'Web\Members\ProfileController@index');
Route::post('member/profile/edit', 'Web\Members\ProfileController@doSubmit');
Route::get('member/subscriptions', 'Web\Members\SubscriptionsController@index');
Route::get('member/subscriptions/unsubscribe/{id}', 'Web\Members\SubscriptionsController@doUnsubscribe');
Route::get('member/point', 'Web\Members\PointController@index');
Route::get('member/dashboard', 'Web\Members\LessonsMemberController@index');
Route::get('member/profile/{username}', 'Web\Members\ProfileController@view');

//reward user
//reward
Route::get('member/reward', 'Contributors\PointController@index');
Route::get('member/reward/{id}/change', 'Contributors\PointController@change');
Route::post('member/reward/{id}/change', 'Contributors\PointController@doChange');
Route::get('member/reward/{id}/detail', 'Contributors\PointController@detail');
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::post('member/change-password', 'Web\Members\PasswordController@doSubmit');
Route::post('member/edit/akun', 'Web\Members\PasswordController@SaveAccount');
Route::get('member/change-password', 'Web\Members\PasswordController@index');
Route::get('member/signup', 'Web\Members\MemberAuth\RegisterController@showRegistrationForm');
Route::post('member/signup', 'Web\Members\MemberAuth\RegisterController@register');
Route::get('member/signin', 'Web\Members\MemberAuth\LoginController@showLoginForm');
Route::post('member/signin', 'Web\Members\MemberAuth\LoginController@login');
Route::get('member/signout', 'Web\Members\MemberAuth\LoginController@logout');
Route::post('member/email', 'Web\Members\MemberAuth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('member/reset', 'Web\Members\MemberAuth\ForgotPasswordController@showLinkRequestForm');
// Route::post('member/reset', 'Web\Members\MemberAuth\ResetPasswordController@reset');
// Route::get('member/reset/{token}', 'Web\Members\MemberAuth\ResetPasswordController@showResetForm');
// Route::get('member/profile', 'Web\Members\ProfileController@index');
// Route::post('member/profile', 'Web\Members\ProfileController@doSubmit');
Route::get('member/riwayat', 'Web\Members\ProfileController@riwayat');
Route::get('member/invoice/{inv}', 'Web\Members\ProfileController@download');
Route::get('member/tambah/{invoice}', 'Web\Members\ProfileController@tambah');
Route::post('member/tambah/{invoice}', 'Web\Members\ProfileController@tambah');

Route::get('member/subscriptions', 'Web\Members\SubscriptionsController@index');
Route::get('member/subscriptions/unsubscribe/{id}', 'Web\Members\SubscriptionsController@doUnsubscribe');
Route::get('member/point', 'Web\Members\PointController@index');
Route::get('member/dashboard', 'Web\Members\LessonsMemberController@index');
Route::get('member/generatepdf/{id}', 'Web\Members\LessonsMemberController@download');

Route::get('member/reward', 'Contributors\PointController@index');
Route::get('member/reward/{id}/change', 'Contributors\PointController@change');
Route::post('member/reward/{id}/change', 'Contributors\PointController@doChange');
Route::get('member/reward/{id}/detail', 'Contributors\PointController@detail');
//notifuser
Route::get('user/notif', 'Web\NotifController@index');
Route::get('user/notif/view', 'Web\NotifController@view');
Route::get('user/notif/read', 'Web\NotifController@read');
Route::post('user/notif/delete/{id}', 'Web\NotifController@delete');

Auth::routes();

Route::resource('/system/dashboard', 'DashboardController');
Route::resource('system/members', 'MembersController');

// Edit Member

// Route::get('system/login', 'Auth\LoginController@showLoginForm');
// Route::post('system/login', 'Auth\LoginController@Login');

Route::get('/system/login', function () {
    return view('admin.login');
});

Route::post('system/members/getServices', 'MembersController@getServices');
Route::post('system/members/addServices', 'MembersController@addServices');
Route::post('system/members/getEditServices', 'MembersController@getEditServices');
Route::post('system/members/editServices', 'MembersController@editServices');

Route::resource('system/cat', 'KategoriController');
Route::resource('system/bootcampcat', 'BootcampKategoriController');
Route::resource('system/bootcampsubcat', 'BootcampSubKategoriController');
Route::resource('system/reward', 'RewardController');
Route::resource('system/reward-category', 'RewardCategoryController');
Route::resource('system/pages', 'PagesController');
Route::resource('system/lessons', 'LessonController');
Route::resource('system/files', 'FilesController');
Route::resource('system/videos', 'VideosController');
Route::resource('system/income', 'IncomeController');
Route::resource('system/coupon', 'AdminCouponController');
Route::get('system/logout', 'Auth\LoginController@logout');

//rating

//  Route::get('cron/system/generate-income', 'GenerateIncomeController@generate');
/*
|--------------------------------------------------------------------------
| Contributor Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Authentication

Route::get('contributor/login', 'Contributors\ContribAuth\LoginController@showLoginForm');
Route::post('contributor/login', 'Contributors\ContribAuth\LoginController@Login');
// Route::post('contributor/logout', 'Contributors\ContribAuth\LogoutController@Logout');
Route::post('contributor/password/email', 'Contributors\ContribAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('contributor/password/reset', 'Contributors\ContribAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('contributor/password/reset', 'Contributors\ContribAuth\ResetPasswordController@reset');
Route::get('contributor/password/reset/{token}', 'Contributors\ContribAuth\ResetPasswordController@showResetForm');
Route::get('contributor/register', 'Contributors\ContribAuth\RegisterController@showRegistrationForm');
Route::post('contributor/register', 'Contributors\ContribAuth\RegisterController@register');

// Route::get('contributor/login', 'Contributors\AuthController@login');
// Route::post('contributor/login', 'Contributors\AuthController@doLogin');

// Route::get('contributor/register', 'Contributors\AuthController@register');
// Route::post('contributor/register', 'Contributors\AuthController@doRegister');
Route::get('contributor/aktivasi/{token}', 'Contributors\AuthController@aktivasi');
Route::get('contribauth/activate', 'Contributors\ContribAuth\ActivationController@active')->name('auth.activate');

Route::get('contributor/logout', 'Contributors\ContribAuth\LoginController@logout');

// Home
Route::get('contributor', 'Contributors\DashboardController@home');
Route::get('contributor/dashboard', 'Contributors\DashboardController@index');
// Lessons
Route::get('contributor/lessons', 'Contributors\LessonsController@redirect');
Route::get('contributor/lessons/{filter}/list', 'Contributors\LessonsController@index');
Route::get('contributor/lessons/create', 'Contributors\LessonsController@create');
Route::post('contributor/lessons/create', 'Contributors\LessonsController@doCreate');
Route::get('contributor/lessons/revision/{id}/proccess', 'Contributors\LessonsController@doProcess');

Route::get('contributor/lessons/{id}/view', 'Contributors\LessonsController@view');
Route::get('contributor/lessons/{id}/edit', 'Contributors\LessonsController@edit');
Route::post('contributor/lessons/{id}/edit', 'Contributors\LessonsController@doEdit');
Route::get('contributor/lessons/{id}/submit', 'Contributors\LessonsController@submit');
Route::post('contributor/lessons/{id}/submit', 'Contributors\LessonsController@doSubmit');
Route::get('contributor/lessons/{id}/delete', 'Contributors\LessonsController@doDelete');

// Videos
// Route::get('contributor/lessons/{lesson_id}/create/videos', 'Contributors\VideosController@create');
Route::get('contributor/lessons/{lesson_id}/create/videos', 'Contributors\VideosController@createNew');
// Route::post('contributor/lessons/{lesson_id}/create/videos', 'Contributors\VideosController@doCreate');
Route::post('contributor/lessons/{lesson_id}/create/videos', 'Contributors\VideosController@doCreateNew');
// Route::get('contributor/lessons/{lesson_id}/edit/videos', 'Contributors\VideosController@edit');
Route::get('contributor/lessons/{lesson_id}/edit/videos', 'Contributors\VideosController@editNew');
// Route::post('contributor/lessons/{lesson_id}/edit/videos', 'Contributors\VideosController@doEdit');
Route::post('contributor/lessons/{lesson_id}/edit/videos', 'Contributors\VideosController@doEditNew');
Route::delete('contributor/lessons/delete/videos/{id}', 'Contributors\VideosController@destroy');
Route::post('contributor/lessons/{lesson_id}/upload/videos', 'Contributors\VideosController@uploadVideo');
Route::post('contributor/lessons/{lesson_id}/upload/videos_change', 'Contributors\VideosController@uploadVideoChange');

// Attachment
Route::get('contributor/lessons/{lesson_id}/create/attachments', 'Contributors\AttachmentsController@create');
Route::post('contributor/lessons/{lesson_id}/create/attachments', 'Contributors\AttachmentsController@doCreate');
Route::get('contributor/lessons/{lesson_id}/edit/attachments', 'Contributors\AttachmentsController@edit');
Route::post('contributor/lessons/{lesson_id}/edit/attachments', 'Contributors\AttachmentsController@doEdit');
Route::get('contributor/lessons/{lesson_id}/delete/attachments/{id}', 'Contributors\AttachmentsController@delete');

// Quiz
Route::get('contributor/lessons/{id}/create/quiz', 'Contributors\QuizController@create');
Route::post('contributor/lessons/{id}/store_quiz', 'Contributors\QuizController@store_quiz');
Route::post('contributor/lessons/{id}/update_quiz', 'Contributors\QuizController@update_quiz');
Route::get('contributor/lessons/quiz/{quiz_id}/view', 'Contributors\QuizController@view');
Route::get('contributor/lessons/quiz/{quiz_id}/edit', 'Contributors\QuizController@edit');
Route::get('contributor/lessons/quiz/{quiz_id}/delete', 'Contributors\QuizController@delete_quiz');

// Question/
Route::get('contributor/lessons/quiz/{quiz_id}/create/questions', 'Contributors\QuestionQuizController@create');
Route::post('contributor/lessons/{quiz_id}/store_questions', 'Contributors\QuestionQuizController@store');

Route::get('contributor/lessons/quiz/{quiz_id}/edit/questions', 'Contributors\QuestionQuizController@edit');
Route::post('contributor/lessons/{quiz_id}/update_questions', 'Contributors\QuestionQuizController@update');

// pendapatan
Route::get('contributor/income', 'Contributors\IncomeController@index');
Route::get('contributor/income/account/create', 'Contributors\IncomeController@create');
Route::post('contributor/income/account/create', 'Contributors\IncomeController@doCreate');
Route::get('contributor/income/account/{id}/edit', 'Contributors\IncomeController@edit');
Route::get('contributor/income/account/{id}/delete', 'Contributors\IncomeController@dodelete');
Route::post('contributor/income/account/{id}/edit', 'Contributors\IncomeController@doEdit');
Route::get('contributor/income/view-all', 'Contributors\IncomeController@view');

//reward
Route::get('contributor/reward', 'Contributors\PointController@index');
Route::get('contributor/reward/{id}/change', 'Contributors\PointController@change');
Route::post('contributor/reward/{id}/change', 'Contributors\PointController@doChange');
Route::get('contributor/reward/{id}/detail', 'Contributors\PointController@detail');

// Route::get('contributor/info-point','Contributors\PointController@point');
//notif
Route::get('contributor/notif', 'Contributors\NotifController@index');
Route::get('contributor/notif/read', 'Contributors\NotifController@notifread');
Route::get('contributor/notif/all', 'Contributors\NotifController@all');

Route::get('ajax/notif/view', 'Contributors\NotifController@view');
Route::get('ajax/notif/read', 'Contributors\NotifController@read');
Route::post('contributor/notif/delete/{id}', 'Contributors\NotifController@delete');
// Coments
Route::get('contributor/comments', 'Contributors\ComentsController@index');
Route::get('contributor/comments/all', 'Contributors\ComentsController@all');
Route::get('contributor/comments/read', 'Contributors\ComentsController@read');
Route::get('contributor/comments/detail/{coment_id}', 'Contributors\ComentsController@detail');
Route::post('contributor/comments/postcomment', 'Contributors\ComentsController@postcomment');
Route::post('contributor/comments/deletecomment/{coment_id}', 'Contributors\ComentsController@deletecomment');
//bootcamp comments
Route::get('contributor/bootcamp/comments', 'Contributors\ComentsController@bootcamp');
Route::get('contributor/bootcamp/comments/all', 'Contributors\ComentsController@bootall');
Route::get('contributor/bootcamp/comments/read', 'Contributors\ComentsController@bootread');
Route::get('contributor/bootcamp/comments/detail/{coment_id}', 'Contributors\ComentsController@bootdetail');
Route::post('contributor/bootcamp/comments/postcomment', 'Contributors\ComentsController@bootpostcomment');
Route::post('contributor/bootcamp/comments/deletecomment/{coment_id}', 'Contributors\ComentsController@bootdeletecomment');

Route::prefix('contributor/account')->group(function () {
    Route::get('informasi', 'Contributors\AccountController@informasi');
    Route::get('informasi/{id}/edit', 'Contributors\AccountController@edit');
    Route::post('informasi/{id}/edit', 'Contributors\AccountController@update_informasi');
    Route::get('profile', 'Contributors\AccountController@halaman');
    Route::get('profile/{id}/edit', 'Contributors\AccountController@edit_halaman');
    Route::post('profile/{id}/edit', 'Contributors\AccountController@update_halaman');
});
//Akun Contributor dan Halaman Contributor

//rating
Route::post('system/rate', 'RateController@store');
//skema
Route::get('contributor/skema', 'Contributors\DashboardController@getSchema');

//Bootsamp
Route::post('contributor/bootcamp/save', 'Contributors\BootcampController@store');
Route::get('contributor/bootcamp/', 'Contributors\BootcampController@index');
Route::get('contributor/bootcamp/{slug}', 'Contributors\BootcampController@detail');
Route::get('contributor/bootcamp/{slug}/lampiran', 'Contributors\BootcampController@lampiran');
Route::get('contributor/bootcamp/{slug}/detail', 'Contributors\BootcampController@detailbootcamp');
Route::get('contributor/bootcamp/{slug}/harga', 'Contributors\BootcampController@harga');
Route::get('contributor/bootcamp/{slug}/publish', 'Contributors\BootcampController@publish');
Route::post('contributor/bootcamp/saveCourse', 'Contributors\BootcampController@saveCourse');

Route::post('contributor/bootcamp/saveLampiran', 'Contributors\BootcampController@saveLampiran');
Route::post('contributor/bootcamp/updateLampiran', 'Contributors\BootcampController@updateLampiran');

Route::post('contributor/bootcamp/updateCourse', 'Contributors\BootcampController@updateCourse');
Route::post('contributor/bootcamp/saveHarga', 'Contributors\BootcampController@saveHarga');
Route::post('contributor/bootcamp/confirmPublish', 'Contributors\BootcampController@confirmPublish');

Route::get('contributor/get/sub/{bootcamp}', 'Contributors\BootcampController@getSub');
Route::get('contributor/bootcamp/course/{id}', 'Contributors\SectionController@index');
Route::post('contributor/bootcamp/course/section-create', 'Contributors\SectionController@store');
Route::post('contributor/bootcamp/course/section-save-position', 'Contributors\SectionController@savePosition');
Route::post('contributor/bootcamp/course/project-create', 'Contributors\SectionController@storeProject');
Route::post('contributor/bootcamp/course/video-create', 'Contributors\SectionController@storeVideo');
Route::post('contributor/bootcamp/course/video-create-temp', 'Contributors\SectionController@storeVideoTemp');
Route::get('contributor/bootcamp/course/get/{id}/', 'Contributors\SectionController@getJsonSection');
Route::post('contributor/bootcamp/saveDetail', 'Contributors\BootcampController@saveDetail');
Route::post('contributor/bootcamp/saveAudience', 'Contributors\BootcampController@saveAudience');

//Kelola Siswa
Route::get('contributor/project', 'Contributors\ProjectController@index');
Route::get('contributor/project/submit/{id}', 'Contributors\ProjectController@show');
Route::get('contributor/project/submit/{sectionid}/detail/{id}', 'Contributors\ProjectController@detail');
Route::post('contributor/project/accproject/', 'Contributors\ProjectController@acc');
