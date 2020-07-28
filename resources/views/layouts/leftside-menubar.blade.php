

<style>
  .nav-item.active {
    background-color: #fce8e6;
    font-weight: bold;
  }

  .nav-item.active a {
    color: #d93025;
  }

</style>
{{--@if(Auth::user()->role != 'master')
<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link" href="{{url('user/'.Auth::user()->student_code)}}"><i class="material-icons">face</i> <span
        class="nav-link-text p-2">@lang('Profile')</span></a>
  </li>
</ul>
@endif--}}
<ul class="nav flex-column p-2" id="side-navbar">
  <li class="nav-item active ">
    <a class="nav-link" href="{{ url('home') }}"><i class="material-icons">dashboard</i> <span class="nav-link-text p-2">@lang('Dashboard')</span></a>
  </li>
    <li class="nav-item">
        {{--    <a class="nav-link active" href="{{ url('attendances/0/'.Auth::user()->id.'/0') }}"><i class="material-icons">date_range</i>--}}
        <a class="nav-link active" href="{{ url('/attendance/daily-attendance/calender') }}"><i class="material-icons">table_view</i>
            <span class="nav-link-text p-2">@lang('My Calendar')</span>
        </a>
    </li>
  @if(Auth::user()->role == 'admin')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">date_range</i> <span class="nav-link-text p-2">@lang('Attendance')</span> <i class="material-icons float-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <li class="nav-item">
        <a class="dropdown-item" href="{{url('attendance/daily-attendance/teachers')}}"><i class="material-icons">contacts</i> <span class="nav-link-text p-2">@lang('Teacher Attendance')</span></a>
      </li>
      <li class="nav-item">
        <a class="dropdown-item" href="{{url('attendance/daily-attendance')}}"><i class="material-icons">contacts</i> <span
            class="nav-link-text p-2">@lang('Student Attendance')</span></a>
      </li>
      <li class="nav-item">
        <a class="dropdown-item" href="{{url('attendance/daily-attendance/staff')}}"><i class="material-icons">account_balance_wallet</i> <span class="nav-link-text p-2">@lang('Staff Attendance')</span></a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
{{--    <a class="nav-link" href="{{ url('school/sections?course=1') }}"><i class="material-icons">class</i> <span class="nav-link-text p-2">@lang('Classes &amp; Sections')</span></a>--}}
      <a class="nav-link" href="{{ url('school/classes') }}"><i class="material-icons">class</i> <span class="nav-link-text p-2">@lang('Classes &amp; Sections')</span></a>

  </li>
  @endif
  @if(Auth::user()->role != 'student')
  <li class="nav-item">
{{--    <a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/1/0')}}"><i class="material-icons">contacts</i>--}}
        <a class="nav-link" href="{{url('lists/students')}}"><i class="material-icons">contacts</i>
            <span class="nav-link-text p-2">@lang('Students')</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('users/'.Auth::user()->school->code.'/0/1')}}"><i class="material-icons">contacts</i>
      <span class="nav-link-text p-2">@lang('Teachers')</span></a>
  </li>
  @endif
  @if(Auth::user()->role == 'admin')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">line_style</i> <span class="nav-link-text p-2">@lang('Exams')</span> <i class="material-icons float-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
{{--      <li>--}}
{{--        <a class="dropdown-item" href="{{ url('exams/create') }}"><i class="material-icons">note_add</i> <span class="nav-link-text p-2">@lang('Add Examination')</span></a>--}}
{{--      </li>--}}
{{--      <li>--}}
{{--        <a class="dropdown-item" href="{{ url('exams/active') }}"><i class="material-icons">developer_board</i> <span--}}
{{--            class="nav-link-text p-2">@lang('Active Exams')</span></a>--}}
{{--      </li>--}}
      <li>
        <a class="dropdown-item" href="{{ url('exams') }}"><i class="material-icons">settings</i> <span class="nav-link-text p-2">@lang('Manage Examinations')</span></a>
      </li>
      <li>
            <a class="dropdown-item" href="{{ url('exams/grade-system') }}"><i class="material-icons">grade</i> <span class="nav-link-text p-2">@lang('Grade System')</span></a>
      </li>
    </ul>
  </li>
  <li class="nav-item">
{{--    <a class="nav-link" href="{{ url('grades/all-exams-grade') }}"><i class="material-icons">assignment</i> <span class="nav-link-text p-2">@lang('Grades')</span></a>--}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('grades/all-grades') }}"><i class="material-icons">assignment</i> <span class="nav-link-text p-2">@lang('Grades')</span></a>
        </li>
  </li>
  <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>
  <li class="nav-item">
{{--    <a class="nav-link" href="{{ url('academic/routine') }}"><i class="material-icons">calendar_today</i> <span class="nav-link-text p-2">@lang('Class Routine')</span></a>--}}
    <a class="nav-link" href="{{ url('time_table') }}"><i class="material-icons">calendar_today</i> <span class="nav-link-text p-2">@lang('Class Time Table')</span></a>

  </li>

{{--  <li class="nav-item">--}}
{{--    <a class="nav-link" href="{{ url('academic/syllabus') }}"><i class="material-icons">vertical_split</i> <span class="nav-link-text p-2">@lang('Syllabus')</span></a>--}}
{{--  </li>--}}

  <li class="nav-item">
{{--    <a class="nav-link" href="{{ url('academic/notice') }}"><i class="material-icons">announcement</i> <span class="nav-link-text p-2">@lang('Notice')</span></a>--}}
      <a class="nav-link" href="{{ url('communicate') }}"><i class="material-icons">send</i> <span class="nav-link-text p-2">@lang('Communicate')</span></a>

  </li>
  <li class="nav-item">
{{--    <a class="nav-link" href="{{ url('academic/event') }}"><i class="material-icons">event</i> <span class="nav-link-text p-2">@lang('Event')</span></a>--}}
          <a class="nav-link" href="{{ url('/school_event') }}"><i class="material-icons">event</i> <span class="nav-link-text p-2">@lang('Event')</span></a>

  </li>
  <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('settings.index') }}"><i class="material-icons">settings</i> <span class="nav-link-text p-2">@lang('Academic Settings')</span></a>
  </li>
{{--  <li class="nav-item dropdown">--}}
{{--    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i--}}
{{--        class="material-icons">chrome_reader_mode</i> <span class="nav-link-text p-2">@lang('Manage GPA')</span> <i class="material-icons float-right">keyboard_arrow_down</i></a>--}}
{{--    <ul class="dropdown-menu" style="width: 100%;">--}}
{{--      <!-- Dropdown menu links -->--}}
{{--      <li>--}}
{{--        <a class="dropdown-item" href="{{ url('gpa/all-gpa') }}"><i class="material-icons">developer_board</i> <span--}}
{{--            class="nav-link-text p-2">@lang('All GPA')</span></a>--}}
{{--      </li>--}}
{{--      <li>--}}
{{--        <a class="dropdown-item" href="{{ url('gpa/create-gpa') }}"><i class="material-icons">note_add</i> <span class="nav-link-text p-2">@lang('Add New GPA')</span></a>--}}
{{--      </li>--}}
{{--    </ul>--}}
{{--  </li>--}}
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard/setting') }}"><i class="material-icons">add_a_photo</i> <span class="nav-link-text p-2">@lang('Slider Settings')</span></a>
        </li>
  @endif
  @if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">monetization_on</i> <span class="nav-link-text p-2">@lang('Manage Fee')</span> <i class="material-icons float-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
        <li>
            <a class="dropdown-item" href="{{ url('fees/analytics') }}"><i class="material-icons">insert_chart</i> <span class="nav-link-text p-2">@lang('Analytics')</span></a>
        </li>
       <li>
         <a class="dropdown-item" href="{{ url('fees/fee_groups') }}"><i class="material-icons">view_list</i> <span class="nav-link-text p-2">@lang('Fee Structures')</span></a>
       </li>
        <li>
            <a class="dropdown-item" href="{{ url('fees/collect') }}"><i class="material-icons">money</i> <span class="nav-link-text p-2">@lang('Collect Fees')</span></a>
        </li>
      <li>
        <a class="dropdown-item" href="{{ url('fees/all') }}"><i class="material-icons">developer_board</i> <span class="nav-link-text p-2">@lang('Generate Form')</span></a>
      </li>
{{--      <li>--}}
{{--        <a class="dropdown-item" href="{{ url('fees/create') }}"><i class="material-icons">note_add</i> <span class="nav-link-text p-2">@lang('Add Fee Field')</span></a>--}}
{{--      </li>--}}
    </ul>
  </li>

  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">account_balance_wallet</i> <span class="nav-link-text p-2">@lang('Manage Accounts')</span> <i class="material-icons float-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
      <li>
        <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/accountant')}}"><i class="material-icons">account_balance_wallet</i>
          <span class="nav-link-text p-2">@lang('Accountant List')</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('accounts/sectors') }}"><i class="material-icons">developer_board</i>
		<span class="nav-link-text p-2">@lang('Add Account Sector')</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('accounts/expense') }}"><i class="material-icons">note_add</i> <span
            class="nav-link-text p-2">@lang('Add New Expense')</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('accounts/expense-list') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text p-2">@lang('Expense List')</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('accounts/income') }}"><i class="material-icons">note_add</i> <span class="nav-link-text p-2">@lang('Add New Income')</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('accounts/income-list') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text p-2">@lang('Income List')</span></a>
      </li>
    </ul>
  </li>
  @endif
  @if(Auth::user()->role == 'student')

  <li class="nav-item">
{{--    <a class="nav-link" href="{{ url('courses/0/'.Auth::user()->section_id) }}"><i class="material-icons">subject</i>--}}
        <a class="nav-link" href="{{ url('subjects/student') }}"><i class="material-icons">subject</i>
            <span class="nav-link-text p-2">@lang('My Subjects')</span></a>
  </li>

  <li class="nav-item">
{{--    <a class="nav-link" href="{{ url('grades/'.Auth::user()->id) }}">--}}
        <a class="nav-link" href="{{ url('marks/student') }}">

        <i class="material-icons">bubble_chart</i>
        <span
        class="nav-link-text p-2">@lang('My Marks')</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('payment')}}"><i class="material-icons">payment</i> <span class="nav-link-text p-2">@lang('Payment')</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('stripe/receipts')}}"><i class="material-icons">receipt</i> <span class="nav-link-text p-2">@lang('Receipt')</span></a>
  </li>
  @endif
  {{--<div style="text-align:center;">@lang('Student')</div>--}}
  {{--<div style="text-align:center;">@lang('Teacher')</div>--}}
  @if(Auth::user()->role == 'admin' || Auth::user()->role == 'librarian')
  <li class="nav-item dropdown">
    <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
        class="material-icons">local_library</i> <span class="nav-link-text p-2">@lang('Manage Library')</span> <i class="material-icons float-right">keyboard_arrow_down</i></a>
    <ul class="dropdown-menu" style="width: 100%;">
      <!-- Dropdown menu links -->
      <li>
        <a class="dropdown-item" href="{{url('users/'.Auth::user()->school->code.'/librarian')}}"><i class="material-icons">local_library</i>
          <span class="nav-link-text p-2">@lang('Librarian List')</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ route('library.books.index') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text p-2">@lang('All Books')</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('library/issued-books') }}"><i class="material-icons">developer_board</i>
          <span class="nav-link-text p-2">@lang('All Issued Books')</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ url('library/issue-books') }}"><i class="material-icons">receipt</i> <span
            class="nav-link-text p-2">@lang('Issue Book')</span></a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ route('library.books.create') }}"><i class="material-icons">note_add</i> <span
            class="nav-link-text p-2">@lang('Add New Book')</span></a>
      </li>
    </ul>
  </li>
  @endif
  @if(Auth::user()->role == 'teacher')
{{--  <li class="nav-item">--}}
{{--    <a class="nav-link" href="{{ url('courses/'.Auth::user()->id.'/0') }}"><i class="material-icons">import_contacts</i>--}}
{{--      <span class="nav-link-text p-2">@lang('My Courses')</span></a>--}}
{{--  </li>--}}

        <li class="nav-item">
            <a class="nav-link" href="{{ url('teacher_subjects/') }}"><i class="material-icons">import_contacts</i>
                <span class="nav-link-text p-2">@lang('My Subjects')</span></a>
        </li>


  @endif
</ul>
<script>

    $(document).ready(function () {



        $('.nav-item.active').removeClass('active');
        //console.log($('.nav-item.active'));

        $('.nav-link').each(function(){
                var alink = $(this).attr('href');
                //console.log($(location).attr('protocol') +$(this).attr('href') + " <- a");
                //console.log($(location).attr('href') + " <- location");

                if($(this).attr('href')  == $(location).attr('href')){
                    $(this).closest('li').closest('ul').closest('li').addClass('active');
                    $(this).closest('li').addClass('active');
                }

        }

        );

        $('.dropdown-item').each(function(){
                var alink = $(this).attr('href');
                //console.log($(this).attr('href') + " <- a");
                //console.log($(location).attr('href') + " <- location");

                if($(this).attr('href')  == $(location).attr('href')){
                    $(this).closest('li').closest('ul').closest('li').addClass('active');

                }

            }

        );

    });

</script>
