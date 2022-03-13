<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Course;
use App\Models\Course_Content;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Mail\welcomemail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CourseController extends Controller
{
    use ApiResponseTrait;


    public function searchCourse(Request $request)
    {
        $query = Course::query();
        $data = $request->input('search_course');
        if ($data) {
            $query->whereRaw("name LIKE '%" . $data . "%'");
        }
        //$query->get();
        return response()->json($query->get());
    }



    public function index()
    {
        //
        $Courses = Course::with('category', 'trainer')->get();
        // $Courses = Course::get();
        return response()->json($Courses, 200);
    }

    public function store(Request $request)
    {

        $validation = $this->validation($request);
        if ($validation instanceof Response) {
            return $validation;
        }

        // $img = $request->file('img');
        // $ext = $img->getClientOriginalExtension();
        // $image = "course -" . uniqid() . ".$ext";
        // $img->move(public_path("uploads/courses/"), $image);
        $image = cloudinary()->upload($request->file('img')->getRealPath())->getSecurePath();

        $course = Course::create([
            'name' => $request->name,
            'img' => $image,
            'category_id' => $request->category_id,
            'trainer_id' => $request->trainer_id,
            'price' => $request->price,
            'duration' => $request->duration,
            'preq' => $request->preq,
            'desc' => $request->desc,
        ]);

        if ($course) {
            return response()->json($course, 200);
        }

        return response()->json("Cannot add this course", 400);
    }


    public function show($id)
    {
        $course = Course::with(['category', 'trainer'])->find($id);
        if ($course) {

            return response()->json($course, 200);
        }
        return response()->json("Not Found", 404);
    }


    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        if ($course) {

            if ($request->isMethod('post')) {

                $validation = $this->apiValidation($request, [
                    'name' => 'required|min:3|max:30',
                    'img' => 'image|mimes:jpeg,png',
                    'price' => 'required',
                    'category_id' => 'exists:categories,id',
                    'trainer_id' => 'required|exists:App\Models\Trainer,id',
                    'duration' => 'required',
                    // 'preq' => '',
                    'desc' => 'required|min:3',
                ]);
                if ($validation instanceof Response) {
                    return $validation;
                }

                // $validation = $this->validation($request);
                // if ($validation instanceof Response) {
                //     return $validation;
                // }
            }

            $image = $course->img;
            if ($request->hasFile('img')) {
                if ($image !== null) {
                    // unlink(public_path('uploads/courses/' . $name));
                    $path_parts = pathinfo(basename($image));
                
                    Cloudinary::destroy($path_parts['filename']);
                }
                //move
                // $img = $request->file('img');             //bmsek el soura
                // $ext = $img->getClientOriginalExtension();   //bgeb extention
                // $name = "course -" . uniqid() . ".$ext";            // conncat ext +name elgded
                // $img->move(public_path("uploads/courses"), $name);   //elmkan , $name elgded
            $image = Cloudinary::upload($request->file('img')->getRealPath())->getSecurePath();

            }
            // }
            Log::alert($request->category_id);

            if ($request->category_id == 0)
                $category_id = $course->category_id;
            else
                $category_id = $request->category_id;

            $course->update([
                'name' => $request->name,
                'img' => $image,
                'category_id' => $category_id,
                'trainer_id' => $request->trainer_id,
                'price' => $request->price,
                'duration' => $request->duration,
                'preq' => $request->preq,
                'desc' => $request->desc,
            ]);
            return response()->json($course, 200);
        }
        // $this->unKnowError();
        return response()->json("Record not found", 404);
    }
    public function destroy($id)
    {
        $course = Course::find($id);
        if (is_null($course)) {
            return response()->json("Record not found", 404);
        }

        $course->delete();
        $img_name = $course->img;
        // if ($course->hasFile('img')) {
        if ($img_name !== null) {
            // unlink(public_path('uploads/courses/' . $img_name));
            $path_parts = pathinfo(basename($img_name));
                
            Cloudinary::destroy($path_parts['filename']);
        }
        return response()->json(null, 204);
        // }
    }
    public function showvideo($e_id)
    {


        $course = DB::select("select * from course__contents where course_id = $e_id");
        if ($course) {

            return response()->json($course, 200);
        }
        return response()->json("Not Found", 404);
    }




    public function Enrollment(Request $request)
    {
        $enrolle = DB::table('course_student')->insert([
            'student_id' => $request->student_id,
            'course_id' => $request->course_id,
        ]);
        
        $course=Course::find($request->course_id);
        $course_name=$course->name;
        if ($enrolle) {
            // $course= DB::select("select name from courses where id = $request->course_id");
            $details = [
                'title' => 'Congratulations',
                'body' => "You have enrolled successfully $course_name ",
            ];

            $email = DB::select("select email from students where id = $request->student_id");

            Mail::to($email)->send(new welcomemail($details));

            return response()->json($enrolle, 200);
        }

        return response()->json("Cannot add this course", 400);
    }






    public function showCourses($id)
    {
        $data = Student::with(['Courses'])->find($id);
        if ($data) {

            return response()->json($data, 200);
        }
        return response()->json("Not Found", 404);
    }

    public function showStudent($id)
    {
        $data = Course::with(['students'])->find($id);
        if ($data) {

            return response()->json($data, 200);
        }
        return response()->json("Not Found", 404);
    }

    public function studentCount($id)
    {

        $data = DB::table('course_student')->select('student_id')->where('course_id', '=', $id)->count('student_id');

        if ($data == 0)
            return response()->json($data, 200);
        if ($data) {
            return response()->json($data, 200);
        }
        return response()->json("Not Found", 404);
    }

    
     public function course_student_enroll(Request $request){

        $course_id=$request->course_id;
        $student_id=$request->student_id;

        $status=DB::select("select * from course_student where course_id = $course_id and student_id = $student_id");
        if ($status) {
            return response()->json($status, 200);
        }
        else{
        return response()->json("Not Found", 404);
        }
     }

    public function getCount()
    {
        $data = DB::table('courses')->select('id')->count('id');
        if ($data == 0)
            return response()->json($data, 200);
        if ($data) {
            return response()->json($data, 200);
        }
        return response()->json("Not Found", 404);
    }


    public function validation($request)
    {
        return $this->apiValidation($request, [
            'name' => 'required|min:3|max:50',
            // 'img' => 'required|image|mimes:jpeg,png',
            'price' => 'required',
            'category_id' => 'required|exists:App\Models\Category,id',
            'trainer_id' => 'required|exists:App\Models\Trainer,id',
            'duration' => 'required',
            // 'preq'
            'desc' => 'required|min:3'
        ]);
    }
}
