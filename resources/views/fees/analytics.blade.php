@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>

                    <div class="col-md-10" id="main-container">
                        <div class="row">


                                <div class="col-md-offset-1 col-md-4" >


                                         <canvas id="myChart" width="100px" height="100px"></canvas>

                                </div>




                            <div class=" col-md-offset-1 col-md-4" >


                                    <canvas id="doughnut" width="100px" height="100px"></canvas>

                            </div>

                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-offset-1 col-md-4" >
                                <canvas id="lineChart" width="100px" height="100px"></canvas>
                            </div>
                            <div class="col-md-offset-1 col-md-4" >
                                <canvas id="pie" width="100px" height="100px"></canvas>
                            </div>
                        </div>

                    </div>




        </div>
    </div>
    <script src="{{asset('js/chart.js')}}"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug','Sep', 'Oct','Nov', 'Dec'],
                datasets: [{
                    label: 'Income',
                    data: [12000,3000, 19000, 3000, 5000, 2000,12000,3000, 19000, 3000, 5000, 2000],
                    backgroundColor:
                        'rgba(54, 162, 235, 0.8)'
                    ,
                    borderColor:
                        'rgba(54, 162, 235, 1)'

                    ,
                    borderWidth: 1
                },
                    {
                        label: 'Expenses',
                        data: [8000,2000, 1000, 3000, 4000, 2000,8000,2000, 1000, 3000, 4000, 2000],
                        backgroundColor: 'rgba(255, 99, 132, 0.8)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
            },
            options: {
                title:{
                    display:true,
                    fontSize:18,
                    text:"Income vs Expenses for 2020"
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        var ctxDoughnut = document.getElementById('doughnut').getContext('2d');
        var doughnut = new Chart(ctxDoughnut, {
            type: 'doughnut',
            data: {
                labels: ['Donation', 'Rent', 'Miscellaneous', 'Books', 'Uniform'],
                datasets: [{
                    label: '# of Votes',
                    data: [2000, 7000, 3000, 5000, 2000],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',

                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                title:{display:true,
                    fontSize:18,
                    text:"Income June 2020"},
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });


        var ctxLine = document.getElementById('lineChart').getContext('2d');
        var myChart = new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug','Sep', 'Oct','Nov', 'Dec'],
                datasets: [

                    {
                    label: 'Income',
                    fill: false,
                    data: [12000,3000, 19000, 3000, 5000, 2000,12000,3000, 19000, 3000, 5000, 2000],
                    backgroundColor : '#0062ff',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 3
                },
                    {
                        label: 'Expenses',
                        fill: false,
                        data: [8000,2000, 1000, 3000, 4000, 2000,8000,2000, 1000, 3000, 4000, 2000],
                        backgroundColor: 'rgba(255, 99, 132, 0.8)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 3
                    }]
            },
            options: {
                title:{
                    display:true,
                    fontSize:18,
                    text:"Income vs Expenses for 2020"
                },

            }
        });

        var ctxPie = document.getElementById('pie').getContext('2d');
        var pie = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Electricity', 'Stationary', 'Miscellaneous', 'Cleaning', 'Telephone'],
                datasets: [{
                    label: '# of Votes',
                    data: [2000, 7000, 3000, 5000, 2000],
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 206, 86, 1)',


                    ],

                    borderWidth: 1
                }]
            },
            options: {
                title:{display:true,
                    fontSize:18,
                    text:"Expenses June 2020"},
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>




@endsection
