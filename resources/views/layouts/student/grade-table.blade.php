@if(count($exams) > 0)
@foreach($exams as $exam)

<div class="table-responsive">
  <table class="table table-bordered table-light table-sm table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">@lang('Course')</th>
      <th scope="col">@lang('Total Marks')</th>
      <th scope="col">@lang('Grade')</th>
      <!--<th scope="col">GPA</th>-->
      <th scope="col">@lang('Course Teacher')</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($grades as $grade)
    @if($grade->exam->id == $exam->id)
    <tr id="heading{{($loop->index + 1)}}">
      <th scope="row">{{($loop->index + 1)}}</th>
      <td>{{$grade->course->course_name}}</td>
      <td><b>{{$grade->marks}}</b>
        <a class="btn btn-sm btn-danger float-right" href="#collapse{{($loop->index + 1)}}" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse{{($loop->index + 1)}}"> @lang('View Details')</a>
      </td>
      <td>
        @foreach($gradesystems as $gs)
         @if($grade->marks >= $gs->from_mark && $grade->marks <= $gs->to_mark)
            <b>{{$gs->grade}}</b>
            @break
          @endif
        @endforeach
      </td>
      <td>
        <a href="{{url('user/'.$grade->teacher->student_code)}}">{{$grade->teacher->name}}</a>
      </td>
    </tr>
    <tr class="collapse" id="collapse{{($loop->index + 1)}}" aria-labelledby="heading{{($loop->index + 1)}}" aria-expanded="false">
      <td colspan="7">
        <div class="table-responsive">
        <table class="table  table-condensed table-hover">
          <thead>
            <tr>
              <th scope="col">@lang('Attendance')</th>
              @for($i=1;$i<=5;$i++)
                <th scope="col">@lang('Quiz') {{$i}}</th>
              @endfor
              @for($i=1;$i<=3;$i++)
                <th scope="col">@lang('Assignment') {{$i}}</th>
              @endfor
              @for($i=1;$i<=5;$i++)
                <th scope="col">@lang('CT') {{$i}}</th>
              @endfor
              @if($grade->course->final_exam_percent > 0)
                <th scope="col">@lang('Written')</th>
                <th scope="col">@lang('Mcq')</th>
              @endif
              @if($grade->course->practical_percent > 0)
                <th scope="col">@lang('Practical')</th>
              @endif
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{{$grade->attendance}}</td>
              @for($i=1;$i<=5;$i++)
                <td>{{$grade['quiz'.$i]}}</td>
              @endfor
              @for($i=1;$i<=3;$i++)
                <td>{{$grade['assignment'.$i]}}</td>
              @endfor
              @for($i=1;$i<=5;$i++)
                <td>{{$grade['ct'.$i]}}</td>
              @endfor
              @if($grade->course->final_exam_percent > 0)
                <td>{{$grade->written}}</td>
                <td>{{$grade->mcq}}</td>
              @endif
              @if($grade->course->practical_percent > 0)
                <td>{{$grade->practical}}</td>
              @endif
            </tr>
          </tbody>
        </table>
        </div>
      </td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
</div>

@endforeach
@else
  @lang('No related data')
@endif
