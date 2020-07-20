<?php

use Illuminate\Http\Request;

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/classes', 'SectionController@apiGetClasses');
    Route::get('/subjects', 'SubjectsController@apiGetSubjects');
    Route::get('/subjects/create', 'SubjectsController@apiCreateSubjects');
    Route::get('/subjects/delete', 'SubjectsController@apiDeleteSubjects');
    Route::get('/sections', 'SectionController@apiGetSections');
    Route::get('/teacher_subjects/my_subjects', 'TeacherSubjectController@getMySubjects');
    Route::get('/teacher_subjects/assign', 'TeacherSubjectController@assignTeacher');
    Route::get('/teacher_subjects/remove', 'TeacherSubjectController@removeTeacher');
    Route::get('/teacher_subjects', 'TeacherSubjectController@apiGetTeacherSubjects');
    Route::get('/teachers', 'UserController@apiGetTeachers');
    Route::get('/class_exams/create', 'ClassExamController@apiCreateClassExams');
    Route::get('/class_exams/delete', 'ClassExamController@apiDeleteClassExams');
    Route::get('/exam_marks/get_students', 'ExamMarksController@apiGetStudents');
    Route::get('/exam_marks/submit_marks', 'ExamMarksController@apiSubmitMarks');
    Route::get('/exam_marks/remove_marks', 'ExamMarksController@apiRemoveMarks');
    Route::get('/students/{section_id}', 'UserController@getClassStudents');
    Route::get('/class_exams', 'ClassExamController@apiGetClassExams');
    Route::get('/attendance/daily-attendance/teachers/departments', 'StaffAttendanceController@apiGetDepartments');
    Route::get('/attendance/daily-attendance/teachers/getTeachers', 'StaffAttendanceController@apiGetTeachers');
    Route::get('/exams/grade-system/get', 'GradesystemController@apiGetGradeSystems');

});


Route::middleware(['auth', 'staff'])->group(function () {

    Route::get('/attendance/daily-attendance/staff/getStaff', 'StaffAttendanceController@apiGetStaff');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/message/mark_read/{id}', 'MessageController@apiMarkRead');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/time_table/teacher', 'TimeTableController@apiGetTeacherTimeTable');
    Route::get('/time_table/class', 'TimeTableController@apiGetClassTimeTable');
    Route::get('/time_table/create', 'TimeTableController@apiCreateTimeTable');
    Route::get('/time_table/delete', 'TimeTableController@apiDeleteTimeTable');


    Route::get('/school_event/create', 'SchoolEventController@apiCreateEvent');

    Route::get('/school_event/get', 'SchoolEventController@apiGetEvents');
    Route::get('/school_event/delete', 'SchoolEventController@apiDeleteEvent');
    Route::get('/users/search/{string}', 'UserController@search');


    Route::get('/communicate/create', 'CommunicationController@apiCreateMessage');
    Route::get('/communicate/get', 'CommunicationController@apiGetCommunications');


     Route::get('/exams/grade-system/delete/{id}', 'GradesystemController@apiDeleteGradeSystems');





});
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('attendances/{section_id}/{student_id}', 'AttendanceController@index');
//   Route::post('attendance', 'AttendanceController@store');
//   Route::get('attendance/{id}', 'AttendanceController@show');
//   Route::put('attendance/{id}', 'AttendanceController@update');
//   //Route::delete('attendance/{id}', 'AttendanceController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('books/{class_id}', 'BookController@index');
//   Route::post('book', 'BookController@store');
//   Route::get('book/{id}', 'BookController@show');
//   Route::put('book/{id}', 'BookController@update');
//   //Route::delete('book/{id}', 'BookController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('courses/{teacher_id}', 'CourseController@index');
//   Route::post('course', 'CourseController@store');
//   Route::get('course/{id}', 'CourseController@show');
//   Route::put('course/{id}', 'CourseController@update');
//   //Route::delete('course/{id}', 'CourseController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('events/{class_id}', 'EventController@index');
//   Route::post('event', 'EventController@store');
//   Route::get('event/{id}', 'EventController@show');
//   Route::put('event/{id}', 'EventController@update');
//   //Route::delete('event/{id}', 'EventController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('faqs', 'FaqController@index');
//   Route::post('faq', 'FaqController@store');
//   Route::get('faq/{id}', 'FaqController@show');
//   Route::put('faq/{id}', 'FaqController@update');
//   //Route::delete('faq/{id}', 'FaqController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('feedbacks/{student_id}', 'FeedbackController@index');
//   Route::post('feedback', 'FeedbackController@store');
//   Route::get('feedback/{id}', 'FeedbackController@show');
//   Route::put('feedback/{id}', 'FeedbackController@update');
//   //Route::delete('feedback/{id}', 'FeedbackController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('forms/{school_id}', 'FormController@index');
//   Route::post('form', 'FormController@store');
//   Route::get('form/{id}', 'FormController@show');
//   Route::put('form/{id}', 'FormController@update');
//   //Route::delete('form/{id}', 'FormController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('grades/{student_id}/{teacher_id}/{course_id}', 'GradeController@index');
//   Route::post('grade', 'GradeController@store');
//   Route::get('grade/{id}', 'GradeController@show');
//   Route::put('grade/{id}', 'GradeController@update');
//   //Route::delete('grade/{id}', 'GradeController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('homeworks/{section_id}/{teacher_id}', 'HomeworkController@index');
//   Route::post('homework', 'HomeworkController@store');
//   Route::get('homework/{id}', 'HomeworkController@show');
//   Route::put('homework/{id}', 'HomeworkController@update');
//   //Route::delete('homework/{id}', 'HomeworkController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('messages/{school_id}', 'MessageController@index');
//   Route::post('message', 'MessageController@store');
//   Route::get('message/{id}', 'MessageController@show');
//   Route::put('message/{id}', 'MessageController@update');
//   //Route::delete('message/{id}', 'MessageController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('classes/{school_id}', 'MyclassController@index');
//   Route::post('class', 'MyclassController@store');
//   Route::get('class/{id}', 'MyclassController@show');
//   Route::put('class/{id}', 'MyclassController@update');
//   //Route::delete('class/{id}', 'MyclassController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('notices/{school_id}', 'NoticeController@index');
//   Route::post('notice', 'NoticeController@store');
//   Route::get('notice/{id}', 'NoticeController@show');
//   Route::put('notice/{id}', 'NoticeController@update');
//   //Route::delete('notice/{id}', 'NoticeController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('notifications/{student_id}', 'NotificationController@index');
//   Route::post('notification', 'NotificationController@store');
//   Route::get('notification/{id}', 'NotificationController@show');
//   Route::put('notification/{id}', 'NotificationController@update');
//   //Route::delete('notification/{id}', 'NotificationController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('routines/{class_id}', 'RoutineController@index');
//   Route::post('routine', 'RoutineController@store');
//   Route::get('routine/{id}', 'RoutineController@show');
//   Route::put('routine/{id}', 'RoutineController@update');
//   //Route::delete('routine/{id}', 'RoutineController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('schools/{code}', 'SchoolController@index');
//   Route::post('school', 'SchoolController@store');
//   Route::get('school/{id}', 'SchoolController@show');
//   Route::put('school/{id}', 'SchoolController@update');
//   //Route::delete('school/{id}', 'SchoolController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('sections/{class_id}', 'SectionController@index');
//   Route::post('section', 'SectionController@store');
//   Route::get('section/{id}', 'SectionController@show');
//   Route::put('section/{id}', 'SectionController@update');
//   //Route::delete('section/{id}', 'SectionController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('syllabuses/{class_id}', 'SyllabusController@index');
//   Route::post('syllabus', 'SyllabusController@store');
//   Route::get('syllabus/{id}', 'SyllabusController@show');
//   Route::put('syllabus/{id}', 'SyllabusController@update');
//   //Route::delete('syllabus/{id}', 'SyllabusController@destroy')
// });

// Route::group(['middleware' => 'auth:api'], function(){
//   Route::get('users/{code}', 'UserController@index');
//   Route::post('user', 'UserController@store');
//   Route::get('user/{id}', 'UserController@show');
//   Route::put('user/{id}', 'UserController@update');
//   //Route::delete('user/{id}', 'UserController@destroy')
// });

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
