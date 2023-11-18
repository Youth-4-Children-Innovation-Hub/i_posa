@extends('home')
@section('contente')

    <section class="section">
        <div class="card" id="dashboard-summary">
            <div class="summary-card">
                <div>
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <h4>Courses</h4>
                    <p>{{$coursesCount}}</p>
                </div>
            </div>
            <div class="summary-card">
                <div>
                    <i class="bi bi-house"></i>
                </div>
                <div>
                    <h4>Centers</h4>
                    <p>{{$centersCount}}</p>
                </div>
            </div>
            <div class="summary-card">
                <div>
                    <i class="bi bi-person"></i>
                </div>
                <div>
                    <h4>Students</h4>
                    <p>{{$studentsCount}}</p>
                </div>
            </div>
            <div class="summary-card">
                <div>
                    <i class="bi bi-person-fill-gear"></i>
                </div>
                <div>
                    <h4>Teachers</h4>
                    <p>{{$teachersCount}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Gender distribution across regions</h5>
                        <div id="lineChart" style="max-height: 700px; height: 700px"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('lineChart'));
                                var data = {{\Illuminate\Support\Js::from($regionDistribution)}};
                                var regions = []
                                var females = []
                                var males = []
                                for(const row of data){
                                    regions.push(row.region)
                                    females.push(row.female)
                                    males.push(row.male)
                                }

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {},
                                    legend: {
                                        data: ['female', 'male']
                                    },
                                    xAxis: [{
                                        data: regions
                                    }],
                                    yAxis: [{
                                        type: "value"
                                    }],
                                    series: [
                                        {
                                            name: 'female',
                                            type: 'bar',
                                            data: females
                                        },
                                        {
                                            name: 'male',
                                            type: 'bar',
                                            data: males
                                        }
                                    ]
                                };

                                // Display the chart using the configuration items and data just specified.
                                myChart.setOption(option);
                            })
                        </script>
                        <!-- End Line CHart -->

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Students' Age Distribution</h5>
                        <div id="studentAgeChart" style="max-height: 700px; height: 700px"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('studentAgeChart'));
                                var data = {{\Illuminate\Support\Js::from($ageDistribution)}};
                                var ages = []
                                var ageCount = []
                                for(const key in data){
                                    ages.push(key)
                                    ageCount.push(data[key])

                                }

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {},
                                    legend: {
                                        data: ['students count']
                                    },
                                    xAxis: [{
                                        data: ages
                                    }],
                                    yAxis: [{
                                        type: "value"
                                    }],
                                    series: [
                                        {
                                            name: 'students count',
                                            type: 'bar',
                                            data: ageCount
                                        }
                                    ]
                                };

                                // Display the chart using the configuration items and data just specified.
                                myChart.setOption(option);
                            })
                        </script>
                        <!-- End Line CHart -->

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Student attendance per course distribution</h5>
                        <div id="coursesChart" style="max-height: 700px; height: 700px"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('coursesChart'));
                                var data = {{\Illuminate\Support\Js::from($coursesDistribution)}};
                                var courses = []
                                var studentsCount = []
                                for(const row of data){
                                    courses.push(row.name)
                                    studentsCount.push(row.students_count)

                                }

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {},
                                    legend: {
                                        data: ['students count']
                                    },
                                    xAxis: [{
                                        data: courses
                                    }],
                                    yAxis: [{
                                        type: "value"
                                    }],
                                    series: [
                                        {
                                            name: 'students count',
                                            type: 'bar',
                                            data: studentsCount
                                        }
                                    ]
                                };

                                // Display the chart using the configuration items and data just specified.
                                myChart.setOption(option);
                            })
                        </script>
                        <!-- End Line CHart -->

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bold ">Centers Distribution  across regions</h5>
                        <div id="centersChart" style="max-height: 700px; height: 700px"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var myChart = echarts.init(document.getElementById('centersChart'));
                                var data = {{\Illuminate\Support\Js::from($centersDistribution)}};
                                var regions = []
                                for(region of data){
                                    regions.push({
                                        name: region.name,
                                        value: region.centers_count
                                    })
                                }
                                option = {
                                    title: {
                                        text: '',
                                        subtext: '',
                                        left: ''
                                    },
                                    tooltip: {
                                        trigger: 'item'
                                    },
                                    legend: {

                                    },
                                    series: [
                                        {
                                            name: 'Access From',
                                            type: 'pie',
                                            radius: '50%',
                                            data: regions,
                                            emphasis: {
                                                itemStyle: {
                                                    shadowBlur: 10,
                                                    shadowOffsetX: 0,
                                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                                }
                                            }
                                        }
                                    ]
                                };
                                myChart.setOption(option);

                            })
                            // Display the chart using the configuration items and data just specified.


                        </script>
                        <!-- End Pie CHart -->

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
