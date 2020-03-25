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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register/','UserController@Register')->name('Register');
Route::get('/login/page', 'UserController@LoginPage')->name('LoginPage');
Route::get('login/', 'UserController@Login')->name('Login');

Route::middleware(['userCheck'])->group(function () {
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
    Route::get('add/friend/{id?}','UserController@AddFriend')->name('AddFriend');
    Route::get('events/','UserController@Events')->name('Events');
    Route::get('delete/friend/{id?}','UserController@DeleteFriend')->name('DeleteFriend');
    Route::get('friend/prove/{id?}','UserController@FriendProve')->name('FriendProve');
    Route::get('/main/', 'UserController@Main')->name('Main');
    Route::get('buy/course/{id?}','UserController@BuyCourse')->name('BuyCourse');
    Route::get('/view/course/{id?}','UserController@ViewCourse')->name('ViewCourse');

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
