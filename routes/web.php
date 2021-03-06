<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/register/page', function () {
    if (session()->has('user')){
        $user = session()->get('user');
        if ($user['status'] != 'wait') {
            return redirect()->route('Main');
        }
        else{
            return view('welcome');
        }
    }
    else{
        return view('welcome');
    }

})->name('Welcome');

Route::get('/register/','UserController@Register')->name('Register');
Route::get('/', 'UserController@LoginPage')->name('LoginPage');
Route::get('login/', 'UserController@Login')->name('Login');
Route::get('/player', function () {
    $user = session()->get('user');
    $video = '/free_videos/19413.mp4';
    $mime = "video/mp4";
    $title = "Os Simpsons";

    return view('player')->with(compact('video', 'mime', 'title','user'));
});
Route::get('forget/page/','UserController@ForgetPage')->name('ForgetPage');
Route::get('forget/password/','UserController@ForgetPassword')->name('ForgetPassword');
Route::get('password/set/{id?}','UserController@PasswordSet')->name('PasswordSet');
Route::get('new/password/','UserController@NewPassword')->name('NewPassword');
Route::get('/free_videos/{filename}', function ($filename) {
    // Pasta dos videos.
    $videosDir = public_path('/streams/');

    if (file_exists($filePath = $videosDir."/".$filename)) {
        $stream = new \App\Http\VideoStream($filePath);

        return response()->stream(function() use ($stream) {
            $stream->start();
        });
    }

    return response("File doesn't exists", 404);
});
Route::middleware(['userCheck'])->group(function () {

    Route::get('user/approve/{id}','UserController@ApproveUser')->name('ApproveUser');
    Route::get('edit/profile','UserController@EditProfile')->name('EditProfile');
    Route::get('my_course/{id?}','UserController@MyCourse')->name('MyCourse');
    Route::post('/course/category/add','UserController@CategoryCourseAdd')->name('CategoryCourseAdd');
    Route::get('add/', 'UserController@Add')->name('Add');
    Route::get('search/user','UserController@Search')->name('Search');
    Route::post('create/course/video','UserController@CourseVideo')->name('CourseVideo');
    Route::get('search/page','UserController@SearchPage')->name('SearchPage');
    Route::get('moderation', 'UserController@Moderation')->name('Moderation');
    Route::get('moderation/store', 'UserController@StoreModeration')->name('StoreModeration');
    Route::get('add/course/', 'UserController@AddCourse')->name('AddCourse');
    Route::post('/course/add/free', 'UserController@FreeCourse')->name('FreeCourse');
    Route::get('account/{id?}','UserController@AccountView')->name('AccountView');
    Route::get('user/{name?}','UserController@UserView')->name('UserView');
    Route::get('add/friend/{id?}','UserController@AddFriend')->name('AddFriend');
    Route::get('events/','UserController@Events')->name('Events');
    Route::get('delete/friend/{id?}','UserController@DeleteFriend')->name('DeleteFriend');
    Route::get('friend/prove/{id?}','UserController@FriendProve')->name('FriendProve');
    Route::get('/main/', 'UserController@Main')->name('Main');
    Route::get('buy/course/{id?}','UserController@BuyCourse')->name('BuyCourse');
    Route::get('/view/course/{id?}','UserController@ViewCourse')->name('ViewCourse');

    // Online stream
    Route::get('/stream/{id?}', 'StreamController@stream')->name('Streamer');
    Route::get('/view/stream/{id?}', 'StreamController@viewStream')->name('ViewStream');


     // Chat
    Route::get('/chat/{id?}', 'ChatController@chatList')->name('ChatList');
    Route::get('new/exp/chat','UserController@ExpChat')->name('ExpChat');
    Route::get('/conf/{id?}', 'ChatController@conf')->name('conf');
    Route::post('/chat_create', 'ChatController@chatCreate')->name('chatCreate');
    // Delete
    Route::get('delete/course/{id?}','UserController@DeleteCourse')->name('DeleteCourse');
    Route::get('delete/free_course/{id?}','UserController@DeleteFreeCourse')->name('DeleteFreeCourse');
    Route::get('delete/video/{id?}','UserController@DeleteVideo')->name('DeleteVideo');
    //Edit

    Route::post('edit/course/','UserController@EditCourse')->name('EditCourse');
    Route::post('edit/free_course','UserController@EditFreeCourse')->name('EditFreeCourse');
    Route::post('edit/course/video','UserController@EditCourseVideo')->name('EditCourseVideo');

    Route::get('profile/', 'UserController@Profile')->name('Profile');
    Route::post('edit/account/','UserController@EditAccount')->name('EditAccount');
    Route::post('add/course/private','UserController@PrivateCourse')->name('PrivateCourse');
    Route::get('create/withdraw','UserController@CreateWithdraw')->name('CreateWithdraw');
    Route::get('log/out','UserController@Logout')->name('Logout');
});



Route::get('admin/maccookz','AdminController@Admin')->name('Admin');
Route::get('admin/login','AdminController@AdminLogin')->name('AdminLogin');
Route::name('admin.')->prefix('admin')->middleware(['adminCheck'])->group(function () {
    Route::get('/main','AdminController@AdminMain')->name('AdminMain');
    Route::get('applications/','AdminController@Applications')->name('Applications');
    Route::get('moderation/','AdminController@Moderation')->name('Moderation');
    Route::get('users','AdminController@Users')->name('Users');
    Route::get('payments/','AdminController@Payments')->name('Payments');
    Route::get('business-accounts/','AdminController@BusinessAccounts')->name('BusinessAccounts');
    Route::get('speaker/approve/{id?}','AdminController@SpeakerApprove')->name('SpeakerApprove');
    Route::get('/withdraws/','AdminController@Withdraws')->name('Withdraws');
    Route::get('/approve/withdraw/{id?}','AdminController@ApproveWithdraw')->name('ApproveWithdraw');
});
