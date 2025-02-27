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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'master'])->group(function () {
    Route::get('/masters', 'MasterController@index')->name('masters.index');
    Route::resource('/schools', 'SchoolController')->only(['index', 'edit', 'store', 'update']);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('messages', 'MessageController@index');
    Route::get('transportation', 'TransportationController@index');
    Route::post('transportation/create', 'TransportationController@create');
    Route::delete('transportation/delete/{transportation_id}', 'TransportationController@destroy');

    Route::get('hostel', 'HostelsController@index');
    Route::get('/syllabus/{teacherSubjectId}/{SubjectId}',"SyllabusController@show");
    Route::post('/syllabus_status/create',"SyllabusStatusController@create");

    Route::post('hostel/create', 'HostelsController@create');
    Route::delete('hostel/delete/{hostel_id}', 'HostelsController@destroy');
    // Route::get('/view-attendance/section/{section_id}',function($section_id){
    //   if($section_id > 0){
    //     $attendances = App\Attendance::with(['student'])->where('section_id', $section_id)->get();
    //   }
    // });
    Route::get('attendance/daily-attendance/{class}/{section}', 'DailyAttendanceController@classSection')->middleware(['teacher']);
    Route::get('attendance/daily-attendance', 'DailyAttendanceController@index')->middleware(['teacher']);
    Route::post('attendance/daily-attendance/submit', 'DailyAttendanceController@takeAttendance')->middleware(['teacher']);
    Route::get('api/attendance/daily-attendance/checkAttendance', 'DailyAttendanceController@checkAttendance')->middleware(['teacher']);
    Route::get('/attendance/daily-attendance/calender', 'DailyAttendanceController@student');
    Route::get('attendances/students/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'AttendanceController@addStudentsToCourseBeforeAtt')->middleware(['teacher']);
    Route::get('attendances/{section_id}/{student_id}/{exam_id}', 'AttendanceController@index');
    Route::get('attendances/{section_id}', 'AttendanceController@sectionIndex')->middleware(['teacher']);
    Route::post('attendance/take-attendance', 'AttendanceController@store')->middleware(['teacher']);
    Route::get('attendance/adjust/{student_id}', 'AttendanceController@adjust')->middleware(['teacher']);
    Route::post('attendance/adjust', 'AttendanceController@adjustPost')->middleware(['teacher']);
});

Route::middleware(['auth', 'teacher'])->prefix('grades')->group(function () {

    Route::get('all-exams-grade', 'GradeController@allExamsGrade');
    Route::get('all-grades', 'ExamMarksController@allGrades');
    Route::get('section/{section_id}', 'GradeController@gradesOfSection');
    Route::get('t/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@tindex')->name('teacher-grade');
    Route::get('c/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@cindex');
    Route::post('calculate-marks', 'GradeController@calculateMarks');
    Route::post('save-grade', 'GradeController@update');
});

Route::get('grades/{student_id}', 'GradeController@index')->middleware(['auth', 'teacher.student']);

Route::middleware(['auth', 'accountant'])->prefix('fees/fee_groups')->group(function(){
    Route::get('/','FeeGroupsController@index');
    Route::post('create','FeeGroupsController@create');
    Route::get('api/fee_structures/{fee_group_id}','FeeGroupsController@getFeeStructures');
    Route::post('delete', 'FeeGroupsController@destroy');
    Route::post('fee_structure/create', 'FeeStructureController@store');
    Route::post('fee_structure/delete', 'FeeStructureController@destroy');
   // Route::any( '(.*)', 'FeeGroupsConroller@index');
});

Route::middleware(['auth', 'accountant'])->prefix('fees')->name('fees.')->group(function () {
    Route::get('all', 'FeeController@index');
    Route::get('analytics','AnalyticsController@index');
    Route::get('create', 'FeeController@create');
    Route::get("student/{student_id}","StudentInstalmentsController@index");
    Route::post("student/add","StudentInstalmentsController@addFees");
    Route::post("student/collect","StudentInstalmentsController@collectFees");
    Route::post("student/delete","StudentInstalmentsController@deleteFees");
    Route::get('fee_structures', 'FeeStructureController@index');
    Route::get('/api/sections/{class_id}', 'FeeStructureController@sections');
    Route::get('/api/students/{class_id}/{section_id}', 'FeeStructureController@getClassStudents');
    Route::get('collect', 'FeeCollect@index');
    Route::post('collect/invoice', 'FeeCollect@print');
    Route::delete('fee_structures', 'FeeStructureController@destroy')->name("FeeStructureDelete");
    Route::get('fee_structures/create', 'FeeStructureController@create');
    Route::post('fee_structures/store', 'FeeStructureController@store');
    Route::post('fee_structures/duplicate', 'FeeStructureController@duplicate');
    Route::post('create', 'FeeController@store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard/setting', 'HomeController@sliderSetting');
    Route::get('/settings', 'SettingController@index')->name('settings.index');
    Route::get('gpa/create-gpa', 'GradesystemController@create');
    Route::post('create-gpa', 'GradesystemController@store');
    Route::post('gpa/delete', 'GradesystemController@destroy');
    Route::post('/dashboard/setting/upload-image','HomeController@uploadImage');
    Route::get('/leave/requests','LeaveController@requests');
    Route::post('/leave/approve-request','LeaveController@approveRequests');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('gpa/all-gpa', 'GradesystemController@index');
});

Route::middleware(['auth'])->group(function () {

    if ('production' != config('app.env')) {
        Route::get('user/config/impersonate', 'UserController@impersonateGet');
        Route::post('user/config/impersonate', 'UserController@impersonate');
    }
    Route::get('/lists/students', 'UserController@studentList');
    Route::get('users/{school_code}/{student_code}/{teacher_code}', 'UserController@index');
    Route::get('users/{school_code}/{role}', 'UserController@indexOther');
    Route::get('user/{user_code}', 'UserController@show');
    Route::get('user/config/change_password', 'UserController@changePasswordGet');
    Route::post('user/config/change_password', 'UserController@changePasswordPost');
    Route::get('section/students/{section_id}', 'UserController@sectionStudents');

    Route::get('courses/{teacher_id}/{section_id}', 'CourseController@index');
    Route::get('communicate', 'CommunicationController@index');

});

Route::get('user/{id}/notifications', 'NotificationController@index')->middleware(['auth', 'student']);

Route::middleware(['auth', 'teacher'])->group(function () {

    Route::get('teacher_subjects', 'TeacherSubjectController@index');
    Route::get('course/students/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'CourseController@course');
    Route::post('courses/create', 'CourseController@create');
    // Route::post('courses/save-under-exam', 'CourseController@update');
    Route::post('courses/store', 'CourseController@store');
    Route::post('courses/save-configuration', 'CourseController@saveConfiguration');
});

Route::middleware(['auth', 'admin'])->prefix('academic')->name('academic.')->group(function () {


    Route::get('notice', 'NoticeController@create');
    Route::get('event', 'EventController@create');
    Route::get('routine', 'RoutineController@index');
    Route::get('routine/{section_id}', 'RoutineController@create');
    Route::prefix('remove')->name('remove.')->group(function () {

        Route::get('notice/{id}', 'NoticeController@update');
        Route::get('event/{id}', 'EventController@update');
        Route::get('routine/{id}', 'RoutineController@update');
    });
});

Route::middleware(['auth', 'admin'])->prefix('exams')->name('exams.')->group(function () {
   // Route::get('/', 'ExamController@index');
    Route::get('/', 'ExamController@manage');
    Route::get('/grade-system', 'GradesystemController@index');
    Route::post('/grade-system/submit', 'GradesystemController@submit');
    Route::get('create', 'ExamController@create');
    Route::post('create', 'ExamController@store');
    Route::post('activate-exam', 'ExamController@update');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('exams/active', 'ExamController@indexActive');
    Route::get('school/classes', 'SectionController@classes');
    Route::get('school/sections', 'SectionController@index');
    Route::get('delete-expense/{id}', 'AccountController@deleteExpense');
});

Route::middleware(['auth', 'librarian'])->namespace('Library')->group(function () {
    Route::prefix('library')->name('library.')->group(function () {
        Route::resource('books', 'BookController');
    });
});

Route::middleware(['auth', 'librarian'])->prefix('library')->name('library.issued-books.')->group(function () {
    Route::get('issue-books', 'IssuedbookController@create')->name('create');
    Route::post('issue-books', 'IssuedbookController@store')->name('store');
    Route::get('issued-books', 'IssuedbookController@index')->name('index');
    Route::post('save_as_returned', 'IssuedbookController@update');
});

Route::middleware(['auth', 'accountant'])->prefix('accounts')->name('accounts.')->group(function () {
    Route::get('sectors', 'AccountController@sectors')->name('sectors.index');
    Route::post('create-sector', 'AccountController@storeSector')->name('sectors.create');
    Route::get('edit-sector/{sector}', 'AccountController@editSector')->name('sectors.edit');
    Route::patch('update-sector/{sector}', 'AccountController@updateSector')->name('sectors.update');
    //Route::get('delete-sector/{sector}','AccountController@deleteSector')->name('sectors.delete');

    Route::get('income', 'AccountController@income');
    Route::post('create-income', 'AccountController@storeIncome');
    Route::get('income-list', 'AccountController@listIncome');
    Route::post('list-income', 'AccountController@postIncome');
    Route::get('edit-income/{id}', 'AccountController@editIncome');
    Route::post('update-income', 'AccountController@updateIncome');
    Route::get('delete-income/{id}', 'AccountController@deleteIncome');

    Route::get('expense', 'AccountController@expense');
    Route::post('create-expense', 'AccountController@storeExpense');
    Route::get('expense-list', 'AccountController@listExpense');
    Route::post('list-expense', 'AccountController@postExpense');
    Route::get('edit-expense/{id}', 'AccountController@editExpense');
    Route::post('update-expense', 'AccountController@updateExpense');
    Route::get('delete-expense/{id}', 'AccountController@deleteExpense');
});

Route::middleware(['auth', 'master'])->group(function () {
    Route::get('register/admin/{id}/{code}', function ($id, $code) {
        session([
        'register_role' => 'admin',
        'register_school_id' => $id,
        'register_school_code' => $code,
        ]);

        return redirect()->route('register');
    });
    Route::post('register/admin', 'UserController@storeAdmin');
    Route::get('master/activate-admin/{id}', 'UserController@activateAdmin');
    Route::get('master/deactivate-admin/{id}', 'UserController@deactivateAdmin');
    Route::get('school/admin-list/{school_id}', 'SchoolController@show');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::prefix('school')->name('school.')->group(function () {
        Route::post('add-class', 'MyclassController@store');
        Route::post('add-section', 'SectionController@store');
        Route::post('add-department', 'SchoolController@addDepartment');
        Route::get('promote-students/{section_id}', 'UserController@promoteSectionStudents');
        Route::post('promote-students', 'UserController@promoteSectionStudentsPost');
        Route::post('theme', 'SchoolController@changeTheme');
        Route::post('set-ignore-sessions', 'SchoolController@setIgnoreSessions');

    });

    Route::prefix('register')->name('register.')->group(function () {

        Route::get('student', 'UserController@redirectToRegisterStudent');

                Route::get('teacher', function () {
                    $departments = \App\Department::where('school_id', \Auth::user()->school_id)->get();
                    $classes = \App\Myclass::where('school_id', \Auth::user()->school->id)->pluck('id');
                    $sections = \App\Section::with('class')->whereIn('class_id', $classes)->get();
                    session([
                'register_role' => 'teacher',
                'departments' => $departments,
                'register_sections' => $sections,
              ]);

            return redirect()->route('register');
        });
        Route::get('accountant', function () {
            session(['register_role' => 'accountant']);

            return redirect()->route('register');
        });

        Route::get('librarian', function () {
            session(['register_role' => 'librarian']);
            return redirect()->route('register');
        });


        Route::post('student', 'UserController@store');
        Route::post('teacher', 'UserController@storeTeacher');
        Route::post('accountant', 'UserController@storeAccountant');
        Route::post('librarian', 'UserController@storeLibrarian');
    });
    Route::get('edit/course/{id}', 'CourseController@edit');
    Route::post('edit/course/{id}', 'CourseController@updateNameAndTime');
    Route::post("/attendance/daily-attendance/teachers/submit",'StaffAttendanceController@takeTeacherAttendance');
    Route::get('time_table','TimeTableController@create');
    Route::get('school_event','SchoolEventController@create');

});

//use PDF;
Route::middleware(['auth', 'master.admin'])->group(function () {

    Route::get('edit/user/{id}', 'UserController@edit');
    Route::post('edit/user', 'UserController@update');
    Route::post('upload/file', 'UploadController@upload');
    Route::post('users/import/user-xlsx', 'UploadController@import');
    Route::get('users/export/students-xlsx', 'UploadController@export');
    //   Route::get('pdf/profile/{user_id}',function($user_id){
//     $data = App\User::find($user_id);
//     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
//     $pdf = PDF::loadView('pdf.profile-pdf', ['user' => $data]);
// 		return $pdf->stream('profile.pdf');
//   });
//   Route::get('pdf/result/{user_id}/{exam_id}',function($user_id, $exam_id){
//     $data = App\User::find($user_id);
//     $grades = App\Grade::with('exam')->where('student_id', $user_id)->where('exam_id',$exam_id)->latest()->get();
//     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
//     $pdf = PDF::loadView('pdf.result-pdf', ['grades' => $grades, 'user'=>$data]);
// 		return $pdf->stream('result.pdf');
//   });
    });

Route::middleware(['auth', 'staff'])->group(function () {
    Route::get('attendance/daily-attendance/teachers', 'StaffAttendanceController@teacherAttendance');
    Route::get('attendance/daily-attendance/staff', 'StaffAttendanceController@staffAttendance');
    Route::post("/attendance/daily-attendance/staff/submit",'StaffAttendanceController@takeStaffAttendance');

});

Route::middleware(['auth', 'teacher'])->group(function () {

    Route::post('calculate-marks', 'GradeController@calculateMarks');
    Route::get('/leave/teacher', "LeaveController@index");
    Route::get('/leave/teacher/requests', "LeaveController@requests");
    Route::post('/leave/teacher/create', "LeaveController@create");
    Route::post('/leave/teacher/approve-request','LeaveController@approveRequests');
    Route::get('assignment/{teacher_subject_id}','AssignmentsController@index');
    Route::post('assignment/submit','AssignmentsController@create');
    Route::get('/assignment/submissions/{assignment_id}','AssignmentSubmissionController@submissions');
    Route::get('/syllabus/create' , "SyllabusController@index");

   // Route::post('message/students', 'NotificationController@store');

});
// Route::middleware(['auth'])->group(function (){
//   Route::get('download/pdf', function(){
//     $pathToFile = public_path('storage/Bano-EducationandAspiration.pdf');
//     return response()->download($pathToFile);
//   });
// });

// View Emails - in browser

Route::prefix('emails')->group(function () {
    // Welcome Email
    Route::get('/welcome', function () {
        $user = App\User::find(1);
        $password = 'ABCXYZ';

        return new App\Mail\SendWelcomeEmailToUser($user, $password);
    });
});






Route::middleware(['auth', 'student'])->prefix('stripe')->group(function () {
    Route::get('charge', 'CashierController@index');
    Route::post('charge', 'CashierController@store');

});

Route::middleware(['auth', 'student'])->group(function () {
    Route::get('subjects/student','SubjectsController@studentSubjects');
    Route::get('marks/student','ExamMarksController@studentMarks');
    Route::get('payment', 'PaymentsController@index');
    Route::post('charge', 'CashierController@store');
    Route::get('/leave/student', "LeaveController@index");
    Route::post('/leave/student/create', "LeaveController@create");
    Route::get('/assignment/student/{teacher_subject_id}','AssignmentsController@studentList');
    Route::get('assignment/student/submit/{assignment_id}','AssignmentsController@studentSubmit');
    Route::post('assignment/student/submit/{assignment_id}','AssignmentSubmissionController@submitAssignment');

});

Route::impersonate();
