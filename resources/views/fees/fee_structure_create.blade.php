@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">

                <div class="panel panel-default">
                    <br>

                    <div class="page-panel-title">@lang(' Create Fee Structure ')</div>

                    <div class="panel-body">
                        <form class="form-horizontal" id="add-form" method="POST" id="registerForm" action="/fees/fee_structures/store">
                            {{ csrf_field() }}

                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">


                                <div class="col-md-4 mb-3">
                                    <label for="validationTooltip01">Fee Structure Name</label>
                                    <input id="name" type="text" class="form-control" name="name" placeholder="5th Class" value="{{  $fee_structure->name ?? ""}}" required>

                                    @isset($records)
                                        <input type="hidden" name="id" value="{{$fee_structure->id}}">
                                    @endisset

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div id="FeeNames">
                            <div class="form-group records">
                                <div class="col-md-4 mb-3">
                                    <label for="validationTooltip02">Fee name</label>
                                    <input name="FeeName[]" type="text" class="form-control" id="validationTooltip01" placeholder="Books" value="{{$records[0]->name ?? ""}}" required>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationTooltip03">Amount</label>
                                    <input name="Amount[]" type="number" class="form-control" id="validationTooltip02" placeholder="2000.50" step="0.0001" value="{{$records[0]->amount??""}}" required>
                                </div>



                            </div>

                            @isset($records)
                                @for ($i = 1; $i < count($records); $i++)

                                    <div class="form-group">
                                        <div class="col-md-4 mb-3">
                                            <label for="validationTooltip01">Fee name</label>
                                            <input type="text" name="FeeName[]" class="form-control" id="validationTooltip01" placeholder="Books" value="{{$records[$i]->name}}" required>

                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="validationTooltip02">Amount</label>
                                            <input name="Amount[]" type="number" class="form-control" id="validationTooltip02" placeholder="2000.50"  step="0.0001" value="{{$records[$i]->amount}}" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <br>
                                            <br>
                                            <button class="btn-sm btn-xs btn-danger" id="removeBtn" type="button">Delete</button>
                                        </div>


                                    </div>
                                @endfor
                            @endisset

                        </div>
                            <div class="form-group">

                                <div class="col-md-4 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">No.of instalments <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <div class="text-center " > <a href="#" class="list-group-item list-group-item-action instalments">{{$i}}</a> </div>
                                                @endfor
                                            </ul>
                                        </div><!-- /btn-group -->
                                        <input type="number" class="form-control input instalment-input"  value="1"  min="1" max="12" required disabled>
                                    </div><!-- /input-group -->
                                </div>

                            </div>

                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="ins1" >Installment 1 due date</label>
                                    <input  id="ins1" type="text" class="form-control" name="Instalment[]" value="{{$instalments[0]->due_date ?? ""}}" required>

                                </div>
                            </div>

                            <div id="InstalmentsList">
                                @isset($instalments)
                                    @for ($i = 1; $i < count($instalments); $i++)
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label for="ins{{$i+1}}" >Installment {{$i+1}} due date</label>
                                                <input  id="ins{{$i+1}}" type="text" class="form-control" name="Instalment[]" value="{{$instalments[$i]->due_date}}" required>
                                            </div>
                                        </div>
                                    @endfor
                                @endisset
                            </div>

                            <div class="form-group submit-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="submit"  class="btn btn-sm btn-warning" >
                                        @if(isset($records))
                                            Save
                                        @else
                                            Submit
                                        @endif
                                    </button>
                                </div>
                            </div>




                        </form>




                            <br>

                        <br>
                        <br>
                        <button type="button" id="addFieldBtn" class="btn btn-info pull-right btn-sm">Add New Field</button>


                        </div>

                    </div>

                </div>
            </div>
        </div>

    <script>
        $(document).ready(function() {

            $(function () {
                $(`#ins1`).datepicker({
                    format: "dd-mm-yyyy",
                });
                var total_installments = $("#InstalmentsList > div").length+1;
                for(i=2;i<=total_installments;i++){
                    $(`#ins${i}`).datepicker({
                        format: "dd-mm-yyyy",
                    });
                }
                $(".instalment-input").val(total_installments);
            });

            $("#addFieldBtn").click(function () {
                $("#FeeNames").append(`<div class="form-group">
                                <div class="col-md-4 mb-3">
                                    <label for="validationTooltip01">Fee name</label>
                                    <input type="text" name="FeeName[]" class="form-control" id="validationTooltip01" placeholder="Books" value="" required>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationTooltip02">Amount</label>
                                    <input name="Amount[]" type="number" class="form-control" id="validationTooltip02" placeholder="2000.50"  step="0.01" value="" >
                                </div>
                                <div class="col-md-4 mb-3">
                                    <br>
                                    <br>
                                    <button class="btn-sm btn-xs btn-danger" id="removeBtn" type="button">Delete</button>
                                </div>


                            </div>`);
            });

            $(".instalments").click(function () {
                let v = $(this)[0].innerText;
                let prev_length = $("#InstalmentsList > div").length+1;
                $(".instalment-input").val(v);
                //$("#InstalmentsList").empty();
                if(v > prev_length ){
                    for(i=prev_length+1;i<=parseInt(v);i++ ){
                        $("#InstalmentsList").append(
                            `<div class="form-group">
                                <div class="col-md-4">
                                    <label for="ins${i}"  >Installment ${i} due date</label>
                                    <input  id="ins${i}" type="text" class="form-control" name="Instalment[]" value="" required>
                                </div>
                        </div>`
                        );
                        $(`#ins${i}`).datepicker({
                            format: "dd-mm-yyyy",
                        });
                    }
                }
                else if(v < prev_length) {
                    for (i = prev_length; i > parseInt(v); i--) {
                        $(`#ins${i}`).parent().parent().remove();
                    }
                }

            });




            $(document).on('click', "#removeBtn" ,function () {
                $(this).parent().parent().remove();
            });

        });


    </script>




@endsection
