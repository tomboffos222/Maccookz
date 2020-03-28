<?php

namespace App\Http\Controllers;

use App\Course;
use App\Course_category;
use App\Course_video;
use App\Free_course;
use App\Speakers;
use App\User;
use App\User_friend_operations;
use App\User_purchase_operations;
use App\Withdraws;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPUnit\Framework\Constraint\Count;

class UserController extends Controller
{
    //
    public function FreeCourse(Request $request){
        $rules = [


            'title'  => 'required'
        ];
        $messages = [


            'title.required' => 'Введите название видео'
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            if ($request->hasFile('video')){
                if ($request->hasFile('img')){
                    $video = $request->file('video');
                    $name = rand(11111,99999).'.'.$video->getClientOriginalExtension();
                    $path = public_path('/free_videos/');
                    $video->move($path,$name);

                    $img = $request->file('img');
                    $imgName = rand(11111,99999).'.'.$img->getClientOriginalExtension();
                    $imgPath = public_path('/free_imgs/');
                    $img->move($imgPath,$imgName);



                    $free_video = new Free_course();
                    $user = session()->get('user');
                    $user = User::find($user['id']);
                    $data['user'] = User::find($user['id']);
                    $free_video['user_id'] = $user['id'];
                    $free_video['views'] = 0;
                    $free_video['title'] = $request['title'];
                    $free_video['video_path'] = '/free_videos/'.$name;
                    $free_video['img_path'] = '/free_imgs/'.$imgName;
                    $free_video->save();
                    return view('result',$data)->with('message','Добавлено');


                }
                return back()->withErrors('Загрузите фото');
            }
            return back()->withErrors('Загрузите видео');
        }
    }
    public  function CourseVideo(Request $request){
        $rules = [

        ];
        $messages = [

        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($request->errors());
        }else{
            if ($request->hasFile('img')){
                if($request->hasFile('video')){
                    $video =  $request->file('video');
                    $videoName = Str::random(20).'.'.$video->getClientOriginalExtension();
                    $videoPath = public_path('/course_image/course_video/video');
                    $video->move($videoPath,$videoName);


                    $image = $request->file('img');
                    $imageName =Str::random(20).'.'.$video->getClientOriginalExtension();
                    $imagePath = public_path('/course_image/course_video/course_image');
                    $image->move($imagePath,$imageName);



                    $videoCourse = new Course_video();
                    $videoCourse['course_id'] = $request['course_id'];
                    $videoCourse['category_id'] = $request['category_id'];
                    $videoCourse['views'] = 0;
                    $videoCourse['video_path'] = '/course_image/course_video/video/'.$videoName;
                    $videoCourse['image_path'] = '/course_image/course_video/course_image/'.$imageName;

                    $videoCourse->save();


                    return back()->with('message','Процесс прошел успешно');


                }
            }
        }

    }
    public function Register(Request $request){
        $rules = [
            'email' => 'required|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'name'  => 'required|max:255',
            'login' => 'required|unique:users,login',
            'password' => 'required|min:8|max:255'
        ];
        $messages = [
            "email.required" => "Введите почту",
            "email.unique" => "Почта должна быть уникальной",
            "name.required" => "Введите имя и фамилию",
            "login.required" => "Введите логин",
            "login.unique" => "Логин уже занят",
            "phone.required" => "Введите номер телефона",
            "phone.unique" => "Номер телефона уже занят",
            "password.required" => "Введите пароль",
            "password.min"  =>"В пароле должно быть минимум 8 символов",


        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $user = new User();
            $user['email'] = $request['email'];
            $user['phone'] = $request['phone'];
            $user['name'] = $request['name'];
            $user['status'] = 'registered';
            $user['login'] = $request['login'];
            $user['password'] = $request['password'];
            $user->save();

            session()->put('user',$user);

            $data['user'] = $user;
            return redirect()->route('Main')->with('message');
        }
    }
    public function  Add(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        $data['isAdd'] = true;
        return view('add' , $data);
    }
    public function AccountView($id){
        $user = session()->get('user');
        $account = User::find($id);
        $data['user'] = User::find($id);
        $data['free_courses'] = Free_course::where('user_id',$id)->get();
        $friendship= User_friend_operations::where('owner_id',$user['id'])->where('friend_id',$account['id'])->first();
        if (!isset($friendship)){
            $friendship= User_friend_operations::where('owner_id',$account['id'])->where('friend_id',$user['id'])->first();
            $data['friendship'] = $friendship;
        }else{
            $data['friendship'] = $friendship;
        }
        $counter = User_friend_operations::where('owner_id',$account['id'])->where('status','ok')->count();
        $counter1 = User_friend_operations::where('friend_id',$account['id'])->where('status','ok')->count();
        $data['friendship_counter'] = $counter + $counter1;
        $data['course_counter'] = Course::where('user_id',$account['id'])->count();

        $data['courses'] = Course::where('user_id',$id)->get();
        $courses = Course::where('user_id',$id)->get();

        $data['isSearch']  = true;

        return view('profile',$data);
    }
    public  function AddFriend($id){
        $user = session()->get('user');
        $user = User::find($user['id']);
        $friend = User::find($id);
        $friendship = new User_friend_operations();
        $friendship['owner_id'] = $user['id'];
        $friendship['friend_id'] = $friend['id'];
        $friendship['status'] = 'wait';

        $friendship->save();

        return back()->with('message','Заявка отправлена');


    }
    public function PrivateCourse(Request $request){
        $rules = [
            'course_type' => 'required',
            'title'  => 'required',
            'category' => 'required',
            'start_date'=> 'required',
            'end_date' => 'required',
            'description'=> 'required',
            'price' => 'required',
            'currency' => 'required',


        ];
        $messages = [
            'course_type.required' => 'Введите тип курса',
            'title.required' => 'Введите название курса',
            'category.required' => 'Выберите категорию курса',
            'start_date.required'  =>  'Введите дату начала курса',
            'end_date.required' => 'Введите дату окончания курса',
            'description.required' => 'Введите описания курса',
            'price.required' => 'Введите цену курса',
            'image_of_course.required' => 'Выберите фото курса',

        ];
        $validator = $this->validator($request->alL(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{

            $user = session()->get('user');
            $data['user'] = User::find($user['id']);
            $course = new Course();
            $course['user_id'] = $user['id'];

            $course['course_type'] =$request['course_type'];

            $course['title'] = $request['title'];
            $course['category'] = $request['category'];
            $course['start_date'] = $request['start_date'];
            $course['end_date'] = $request['end_date'];
            $course['description'] = $request['description'];
            $course['price'] = $request['price'];
            $course['currency'] = $request['currency'];
            $course['purchases'] = 0;
            $course['bill'] = 0;
            $course['views'] = 0;
            if ($request->has('address')){
                $course['address']=$request['address'];
            }else{
                $course['address'] = null;
            }
            if ($request->hasFile('image_of_course')){
                $image = $request->file('image_of_course');
                $imageName = rand(11111,99999).'.'.$image->getClientOriginalExtension();
                $imagePath = public_path('/course_image/');
                $image->move($imagePath,$imageName);
                $course['image_of_course'] = '/course_image/'.$imageName;

                $course->save();
                return view('result',$data)->with('message','Добавлено');

            }else{
                return back()->withErrors('Загрузите фото');
            }
        }

    }
    public function CategoryCourseAdd(Request $request){
        $rules = [
            'name' => 'required',
            'course_id' => 'required'
        ];
        $messages = [
            'name.required' => 'Введите имя категорий'
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $category = new Course_category();
            $category['course_id'] = $request['course_id'];
            $category['name'] = $request['name'];
            $category->save();


            return back()->with('message','Успешно добавлено');
        }
    }

    public function Moderation(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);

        return view('moderation' , $data);
    }
    public  function StoreModeration(Request $request){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        $rules = [
            'organization_type' => 'required',
            'organization_name' => 'required',
            'bill' => 'required|min:12|max:12',
            'id_company' => 'required|min:20|max:20',
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];
        $messages = [
            'bill.min' => 'В ИИН/БИН должно быть 12 символов',
            'id_company.min' => 'В БИК должно быть 20 символов',

            'bill.max' => 'В ИИН/БИН должно быть 12 символов',
            'id_company.max' => 'В БИК должно быть 20 символов',
            'phone.min' => 'В номере телефона должно быть 11 цифр',
            'phone.max' => 'В номере телефона должно быть 11 цифр',

        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            $user = session()->get('user');
            $speaker = new Speakers();
            $speaker['user_id'] = $user['id'];
            $speaker['status'] = 'wait';
            $speaker['organization_type'] = $request['organization_type'];
            $speaker['organization_name'] = $request['organization_name'];
            if ($request->has('instagram')) {
                $speaker['instagram'] = $request['instagram'];
            }else{
                $speaker['instagram'] = null;

            }
            $speaker['bill'] = $request['bill'];
            $speaker['id_company'] = $request['id_company'];
            $speaker['name'] = $request['name'];
            $speaker['last_name'] = $request['last_name'];
            $speaker['email'] = $request['email'];
            $speaker['phone'] = $request['phone'];
            $speaker->save();
            return back()->with('message','Вашу заявку одобрят в течение дня ');
        }
    }

    public function LoginPage(){
        if (session()->has('user')){
            return redirect()->route('Main');
        }else{
            return view('login');
        }

    }
    public function EditProfile(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);




        return view('editprofile',$data);
    }
    public function EditAccount(Request $request){
        $rules = [
            'avatar' => 'mimes:jpeg,bmp,png',

        ];
        $messages = [
            'avatar.mime' => 'Фото должно быть в формате jpg',
        ];
        $validator =$this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            $user = User::find($request['user_id']);
            if ($user['email'] != $request['email']){
                $user['email'] = $request['email'];
            }
            if ($user['phone'] != $request['phone']){
                $user['phone'] = $request['phone'];
            }
            $user['instagram'] = $request['instagram'];
            $user['about'] = $request['about'];
            if ($request['gender'] != null) {
                $user['gender'] = $request['gender'];
            }else{
                $user['gender'] = null;
            }
            if($request->hasFile('avatar')){
                $image = $request->file('avatar');
                $imageName = Str::random(10).'.'.$image->getClientOriginalExtension();
                $imagePath = public_path('/avatars/');
                $image->move($imagePath,$imageName);
                $user['avatar'] = '/avatars/'.$imageName;
            }
            $user->save();
            return back()->with('message','Успешно изменено');

        }
    }
    public function MyCourse($id){
        $user = session()->get('user');
        $data['user'] =  User::find($user['id']);
        $data['purchases'] = User_purchase_operations::where('course_id',$id)
            ->join('users','users.id','=','user_purchase_operations.user_id')
            ->select('user_purchase_operations.*','users.login','users.avatar')
            ->get();
        $data['withdraw_sum']  = Withdraws::where('user_id',$user['id'])->where('course_id',$id)->pluck('amount')->sum();
        $data['course'] = Course::where('user_id',$user['id'])->where('id',$id)->first();
        $data['categories'] = Course_category::where('course_id',$id)->get();
        $data['videos'] = Course_video::where('course_id',$id)->paginate(5);

        return view('my_course',$data);
    }
    public function CreateWithdraw(Request $request){
        $rules = [
                'amount' => 'required',
                'bill' => 'required',
        ];
        $messages = [
                'amount.required' => 'Введите сумму ',
                'bill.required' => 'Введите каспи номер или банковский счет',

        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());

        }else{
            $course = Course::find($request['course_id']);
            $sum = $course['bill'] - $request['amount'];

            if ($sum >= 0) {
                $withdraw = new Withdraws();

                $withdraw['course_id'] = $request['course_id'];
                $withdraw['user_id'] = $request['user_id'];
                $withdraw['status']  = 'wait';
                $withdraw['amount']  = $request['amount'];
                if ($request['type_of_withdraw'] == 'bill'){
                    $withdraw['bill'] = $request['bill'];
                    $withdraw['kaspy_number']= null;

                }else{
                    $withdraw['bill'] = null;
                    $withdraw['kaspy_number']= $request['bill'];
                }
                $withdraw->save();

                return back()->with('message','Ожидайте в течение нескольких дней');

            }else{
                return back()->withErrors('Недостаточно средств');
            }
        }
    }

    public function Main(){
        $data['videos'] = Free_course::orderBy('free_courses.created_at','desc')
            ->join('users','free_courses.user_id','=','users.id')
            ->select('free_courses.*','users.name','users.login','users.avatar')
            ->paginate(10);
        $data['isMenu'] = true;
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        return view('main' , $data);
    }
    public function Logout(){
        session()->forget('user');

        return redirect()->route('LoginPage')->withErrors('Вы вышли');
    }
    public function Login(Request $request){
        $rules = [
            'phone' => 'required',
            'password' => 'required',
        ];
        $messages = [
            'phone.required' => 'Введите номер телефона или почту',
            'password.required' => 'Введите пароль ',
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{

            $user = User::where('phone',$request['phone'])->orWhere('email',$request['phone'])->first();
            if ($user){
                if ($user['password'] == $request['password']){
                    session()->put('user',$user);
                    session()->save();
                    $data['user'] = User::find($user['id']);
                    return redirect()->route('Main')->with('message');
                }else{
                    return back()->withErrors('Неправильный логин или пароль');
                }
            }else{
                return back()->withErrors('Неправильный логин или пароль');
            }

        }
    }

    public function Profile(){

        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        $data['free_courses'] = Free_course::where('user_id',$user['id'])->join('users','users.id','=','free_courses.user_id')->select('free_courses.*','name','login','email')->get();
        $friendship= User_friend_operations::where('owner_id',$user['id'])->where('status','ok')->count();
        $friendship2 = User_friend_operations::where('friend_id',$user['id'])->where('status','ok')->count();
        $data['friend_counter'] = $friendship + $friendship2;
        $data['courses_counter'] = Course::where('user_id',$user['id'])->count();
        $data['courses'] = Course::where('user_id',$user['id'])->get();
        $data['isProfile'] = true;

        $data['course_counter'] = User_purchase_operations::where('user_id',$user['id'])->count();
        $data['purchased_courses'] = User_purchase_operations::where('user_purchase_operations.user_id',$user['id'])
            ->join('courses','user_purchase_operations.course_id','=','courses.id')
            ->select('courses.*','courses.user_id')
            ->paginate(12);

        return view('myprofile',$data);


    }
    public function ViewCourse($id){

        $data['course'] = Course::find($id);
        $course = Course::find($id);
        $data['user'] = User::find($course['user_id']);
        $data['categories'] = Course_category::where('course_id',$id)->get();
        $data['videos'] = Course_video::where('course_id',$id)->get();

        $course['views'] +=1;
        $course->save();
        return view('course',$data);


    }
    public function FriendProve($id){
        $friendship = User_friend_operations::find($id);

        $friendship['status'] = 'ok';

        $friendship->save();
        return back()->with('message','Одобрено!');
    }
    public function Events(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        $data['friendships'] = User_friend_operations::where('friend_id',$user['id'])
            ->join('users','users.id','=','user_friend_operations.owner_id')
            ->select('users.*','user_friend_operations.created_at')
            ->get();

        $courses = Course::where('user_id',$user['id'])->get();
        $data['payments'] = [];
        $data['purchases'] = Course::where('courses.user_id',$user['id'])
            ->join('user_purchase_operations','user_purchase_operations.course_id','=','courses.id')


            ->join('users','user_purchase_operations.user_id','=','users.id')
            ->select('users.*','user_purchase_operations.created_at','courses.title','courses.price')
            ->orderBy('user_purchase_operations.created_at','desc')
            ->get();


        $data['isEvent'] = true;
        return view('event',$data);
    }
    public function DeleteFriend($id){
        $friendship = User_friend_operations::find($id);
        $friendship->delete();

        return back()->with('message','Успешно');
    }
    public function BuyCourse($id){
        $user = session()->get('user');
        $user = User::find($user['id']);
        $course = Course::find($id);
        $courseIn = User_purchase_operations::where('user_id',$user['id'])
            ->where('course_id',$course['id'])->first();
        if ($courseIn){
            return redirect()->route('ViewCourse',$course['id'])->with('message','Вы уже купили этот курс');
        }else {
            $purchase = new User_purchase_operations();
            $purchase['user_id'] = $user['id'];
            $purchase['course_id'] = $id;

            $purchase['description'] = 'Покупка курса ' . $course->title;
            //$purchase['status'] = 'wait';
            $purchase['status'] = 'ok';
            $purchase->save();
            $course['purchases'] += 1;
            $course['bill'] += $course['price'];

            $course->save();
            return back()->with('message', 'Добавлено');
        }

        // $this->SmartPay($course['price'],$purchase['id']);







    }
    public function PaymentResult(Request $request){
        Storage::put('pay.log',$request->all());

        $payment = Payment::find($request['PAYMENT_ORDER_ID']);



        if ($request['PAYMENT_STATUS'] == 'paid') {


            $payment['status'] = 'ok';

            $payment->save();
            $course = Course::find($payment['course_id']);

            $course['purchases'] +=1;
            $course['bill'] += $course['price'];

            $course->save();

            return "RESULT=OK";

        }else{
            $payment['status'] = 'fail';
            $payment->save();

           return "RESULT=RETRY";
        }
    }
    public  function SmartPay($sum,$id){
        $data['MERCHANT_ID'] = 17274;
        $data['PAYMENT_AMOUNT'] = $sum;
        $data['PAYMENT_ORDER_ID'] = $id;
        $data['PAYMENT_INFO'] = 'Оплата за покупку курса'.$id;
        $data['PAYMENT_RETURN_URL'] = route('SuccessAcc');
        $data['PAYMENT_RETURN_FAIL_URL'] = route('FailPayment');
        $data['PAYMENT_CALLBACK_URL'] = route('PaymentResult');
        ksort($data);
        $str = '';
        foreach ($data as $d){
            $str .= $d;
        }
        $secret_key = 'f4f84866-5dd3-11ea-98a5-448a5bd44871';
        $signature = base64_encode(pack("H*", md5($str.$secret_key)));//
        $data['PAYMENT_HASH'] =$signature;


        $res = self::SendReq('https://spos.kz/merchant/api/create_invoice',$data);
        if ($res->status == 0){

            return redirect($res->data->url);
        }else{
            return redirect()->back();
        }

    }
    private static function SendReq($url,$params) {
        // Set POST variables

        $headers = array(

            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));

        // Execute post
        $result = curl_exec($ch);
        // echo "Result".$result;
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return json_decode($result);
    }
    public function SearchPage(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        $data['accounts'] = User::where('id','!=',$user['id'])->paginate(12);

        $data['isSearch'] = true;
        return view('search',$data);
    }
    public function Search(Request $request){
        $rules = [
            'search' => 'required'
        ];
        $messages= [
            'search.required' => 'Введите для поиска'
        ];
        $validator = $this->validator($request->all(),$rules,$messages);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else {
            $user = session()->get('user');
            $data['user'] = User::find($user['id']);
            $data['accounts'] = User::where('id', '!=', $user['id'])
                ->where('name', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('login', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('email', 'LIKE', '%' . $request['search'] . '%')
                ->orWhere('phone', 'LIKE', '%' . $request['search'] . '%')
                ->paginate(12);

            $data['isSearch'] = true;

            return view('search', $data);
        }
    }

    public function AddCourse(){
        $user = session()->get('user');
        $data['user'] = User::find($user['id']);
        $data['isAdd'] = true;
        return view('add_course',$data);
    }
}

