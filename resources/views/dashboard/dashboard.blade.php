@extends('home')
@section('contente')

    <section class="section">
        
            
            @can('is_admin')
            <div class="card" id="dashboard-summary" style="grid-template-columns: repeat(3,1fr);">
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
                    <i class="bi bi-house"></i>
                </div>
                <div>
                    <h4>Centers</h4>
                    <p>{{$centersCount}}</p>
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
            @endcan

            @can('is_hoc')
            @cannot('is_admin')
            <div class="card" id="dashboard-summary" style="grid-template-columns: repeat(3,1fr);">
            <div class="summary-card">
                <div>
                <i class="bi bi-person"></i>
                </div>
                <div>
                    <h4>Students</h4>
                    <p>{{$studentsCount1}}</p>
                </div>
            </div>

            <div class="summary-card">
                <div>
                    <i class="bi bi-person-fill-gear"></i>
                </div>
                <div>
                    <h4>Teachers</h4>
                    <p>{{$teachersCount1}}</p>
                </div>
            </div>
        
            <div class="summary-card">
                <div>
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <h4>Courses</h4>
                    <p>{{$coursesCount1}}</p>
                </div>
            </div>
            </div>
            @endcannot
            @endcan
 
        
        <div class="row">
            
            @can('is_hoc')
            @cannot('is_admin')
                          
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Student attendance per course distribution</h5>
                        <div class="container">
                        <div id="coursesChart" style="max-height: 700px; height: 400px"></div>
                        </div>
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
                                    // legend: {
                                    //     data: ['students count']
                                    // },
                                    xAxis: [{
                                        type: 'category',
                                        axisLabel: {
                                            rotate: 90, // Rotate the labels by 90 degrees counterclockwise
                                            interval: 0  // Display all labels, you can adjust the interval as needed
                                        },
                                        data: courses // Assuming 'courses' contains your x-axis labels
                                    }],
                                    yAxis: [{
                                        type: "value",
                                        min: 0,    
                                        interval: 1 
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
            

            <!-- gender distribution -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Bar Chart -->
                        <h5 class="font-weight-bold">Gender Distribution in a Center</h5>
                        <div class="container">
                            <div id="genderChart" style="max-height: 700px; height: 400px"></div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('genderChart'));
                                var centerGender = @json($centerGender);

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                    },
                                    tooltip: {},
                                    xAxis: [{
                                        type: 'category',
                                        data: ['Male', 'Female']
                                    }],
                                    yAxis: [{
                                        type: "value",
                                        min: 0,
                                        interval: 1
                                    }],
                                    series: [{
                                        name: 'Student Count',
                                        type: 'bar',
                                        data: [
                                        { value: centerGender.male_count},
                                        { value: centerGender.female_count, itemStyle: { color: '#98FB98' } }
                                    ]
                                    }]
                                };

                                // Display the chart using the configuration items and data just specified.
                                myChart.setOption(option);
                            })
                        </script>
                        <!-- End Bar Chart -->
                    </div>
                </div>
            </div>
        
            <!-- end gender distribution -->
            @endcannot
            @endcan
            @can('is_admin')
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bold ">Centers Distribution  across regions</h5>
                        <div id="centersChart" style="max-height: 700px; height: 400px"></div>
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

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bold ">Centers Distribution  across districts</h5>
                        <div id="centersDistrict" style="max-height: 700px; height: 400px"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var myChart = echarts.init(document.getElementById('centersDistrict'));
                                var data = {{\Illuminate\Support\Js::from($centerDistrict)}};
                                var districts = []
                                for(district of data){
                                    districts.push({
                                        name: district.name,
                                        value: district.centers_count
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
                                            data: districts,
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Gender distribution across regions</h5>
                        <div id="lineChart" style="max-height: 700px; height: 400px"></div>
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
                                        data: ['male', 'female']
                                    },
                                    xAxis: [{
                                        data: regions
                                    }],
                                    yAxis: [{
                                        type: "value"
                                    }],
                                    series: [
                                        {
                                            name: 'male',
                                            type: 'bar',
                                            data: males
                                        },
                                        {
                                            name: 'female',
                                            type: 'bar',
                                            data: females
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
             <!-- student-region distribution                -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Student attendance per Region</h5>
                        <div class="container">
                        <div id="studentRegChart" style="max-height: 700px; height: 400px"></div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('studentRegChart'));
                                var data = {{\Illuminate\Support\Js::from($studentReg)}};
                                var regions = []
                                var studentsCount = []
                                for(const row of data){
                                    regions.push(row.name)
                                    studentsCount.push(row.students_count)

                                }

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {},
                                    // legend: {
                                    //     data: ['students count']
                                    // },
                                    xAxis: [{
                                        type: 'category',
                                        axisLabel: {
                                            rotate: 90, // Rotate the labels by 90 degrees counterclockwise
                                            interval: 0  // Display all labels, you can adjust the interval as needed
                                        },
                                        data: regions // Assuming 'courses' contains your x-axis labels
                                    }],
                                    yAxis: [{
                                        type: "value",
                                        min: 0,    
                                        interval: 1 
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

             <!-- student-center distribution                -->
             <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Student attendance per Center</h5>
                        <div class="container">
                        <div id="coursesChart" style="max-height: 700px; height: 400px"></div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('coursesChart'));
                                var data = {{\Illuminate\Support\Js::from($studentCent)}};
                                var centers = []
                                var studentsCount = []
                                for(const row of data){
                                    centers.push(row.name)
                                    studentsCount.push(row.students_count)

                                }

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {},
                                    // legend: {
                                    //     data: ['students count']
                                    // },
                                    xAxis: [{
                                        type: 'category',
                                        axisLabel: {
                                            rotate: 90, // Rotate the labels by 90 degrees counterclockwise
                                            interval: 0  // Display all labels, you can adjust the interval as needed
                                        },
                                        data: centers // Assuming 'courses' contains your x-axis labels
                                    }],
                                    yAxis: [{
                                        type: "value",
                                        min: 0,    
                                        interval: 1 
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
            @endcan

            @can('is_dist_cordinator')
            @cannot('is_admin')
            <div class="card" id="dashboard-summary" style="grid-template-columns: repeat(3,1fr);">
            <div class="summary-card">
                <div>
                <i class="bi bi-person"></i>
                </div>
                <div>
                    <h4>Students</h4>
                    <p>{{$studentsCount2}}</p>
                </div>
            </div>
            <div class="summary-card">
                <div>
                    <i class="bi bi-house"></i>
                </div>
                <div>
                    <h4>Centers</h4>
                    <p>{{$centersCount2}}</p>
                </div>
            </div>
           
           
            <div class="summary-card">
                <div>
                    <i class="bi bi-person-fill-gear"></i>
                </div>
                <div>
                    <h4>Courses</h4>
                    <p>{{$courseCount2}}</p>
                </div>
            </div>
            </div>
            <div class="row">
                 <!-- student-center distribution for district cordinator -->
             <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Student attendance per Center</h5>
                        <div class="container">
                        <div id="centerChart2" style="max-height: 700px; height: 400px"></div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('centerChart2'));
                                var data = {{\Illuminate\Support\Js::from($studentCent1)}};
                                var centers = []
                                var studentsCount = []
                                for(const row of data){
                                    centers.push(row.name)
                                    studentsCount.push(row.students_count)

                                }

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {},
                                    // legend: {
                                    //     data: ['students count']
                                    // },
                                    xAxis: [{
                                        type: 'category',
                                        axisLabel: {
                                            rotate: 90, // Rotate the labels by 90 degrees counterclockwise
                                            interval: 0  // Display all labels, you can adjust the interval as needed
                                        },
                                        data: centers // Assuming 'courses' contains your x-axis labels
                                    }],
                                    yAxis: [{
                                        type: "value",
                                        min: 0,    
                                        interval: 1 
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

             <!-- gender distribution -->
             <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Bar Chart -->
                        <h5 class="font-weight-bold">Gender Distribution across the District</h5>
                        <div class="container">
                            <div id="genderChart3" style="max-height: 700px; height: 400px"></div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('genderChart3'));
                                var centerGender = @json($centerGender1);

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                    },
                                    tooltip: {},
                                    xAxis: [{
                                        type: 'category',
                                        data: ['Male', 'Female']
                                    }],
                                    yAxis: [{
                                        type: "value",
                                        min: 0,
                                        interval: 1
                                    }],
                                    series: [{
                                        name: 'Student Count',
                                        type: 'bar',
                                        data: [
                                        { value: centerGender.male_count},
                                        { value: centerGender.female_count, itemStyle: { color: '#98FB98' } }
                                    ]
                                    }]
                                };

                                // Display the chart using the configuration items and data just specified.
                                myChart.setOption(option);
                            })
                        </script>
                        <!-- End Bar Chart -->
                    </div>
                </div>
            </div>
        
            <!-- end gender distribution -->
            </div>
            @endcannot        
            @endcan

            @can('is_reg_cordinator')
            @cannot('is_admin')
            <div class="card" id="dashboard-summary" style="grid-template-columns: repeat(3,1fr);">
            <div class="summary-card">
                <div>
                <i class="bi bi-person"></i>
                </div>
                <div>
                    <h4>Students</h4>
                    <p>{{$studentsCount3}}</p>
                </div>
            </div>
            <div class="summary-card">
                <div>
                    <i class="bi bi-house"></i>
                </div>
                <div>
                    <h4>Centers</h4>
                    <p>{{$centersCount3}}</p>
                </div>
            </div>
           
           
            <div class="summary-card">
                <div>
                    <i class="bi bi-person-fill-gear"></i>
                </div>
                <div>
                    <h4>Courses</h4>
                    <p>{{$courseCount3}}</p>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="font-weight-bold ">Centers Distribution  across districts</h5>
                        <div id="centersDistrict1" style="max-height: 700px; height: 400px"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var myChart = echarts.init(document.getElementById('centersDistrict1'));
                                var data = {{\Illuminate\Support\Js::from($centerDistrict1)}};
                                var districts = []
                                for(district of data){
                                    districts.push({
                                        name: district.name,
                                        value: district.centers_count
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
                                            data: districts,
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
                                 <!-- student-center distribution for district cordinator -->
             <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Student attendance per District</h5>
                        <div class="container">
                        <div id="centerChart4" style="max-height: 700px; height: 400px"></div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('centerChart4'));
                                var data = {{\Illuminate\Support\Js::from($studentDistrict2)}};
                                var districts = []
                                var studentsCount = []
                                for(const row of data){
                                    districts.push(row.name)
                                    studentsCount.push(row.students_count)

                                }

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {},
                                    // legend: {
                                    //     data: ['students count']
                                    // },
                                    xAxis: [{
                                        type: 'category',
                                        axisLabel: {
                                            rotate: 90, // Rotate the labels by 90 degrees counterclockwise
                                            interval: 0  // Display all labels, you can adjust the interval as needed
                                        },
                                        data: districts // Assuming 'courses' contains your x-axis labels
                                    }],
                                    yAxis: [{
                                        type: "value",
                                        min: 0,    
                                        interval: 1 
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
                 <!-- student-center distribution for district cordinator -->
             <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Line Chart -->
                        <h5 class="font-weight-bold ">Student attendance per Center</h5>
                        <div class="container">
                        <div id="centerChart3" style="max-height: 700px; height: 400px"></div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('centerChart3'));
                                var data = {{\Illuminate\Support\Js::from($studentCent2)}};
                                var centers = []
                                var studentsCount = []
                                for(const row of data){
                                    centers.push(row.name)
                                    studentsCount.push(row.students_count)

                                }

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                        text: ''
                                    },
                                    tooltip: {},
                                    // legend: {
                                    //     data: ['students count']
                                    // },
                                    xAxis: [{
                                        type: 'category',
                                        axisLabel: {
                                            rotate: 90, // Rotate the labels by 90 degrees counterclockwise
                                            interval: 0  // Display all labels, you can adjust the interval as needed
                                        },
                                        data: centers // Assuming 'courses' contains your x-axis labels
                                    }],
                                    yAxis: [{
                                        type: "value",
                                        min: 0,    
                                        interval: 1 
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

             <!-- gender distribution -->
             <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Bar Chart -->
                        <h5 class="font-weight-bold">Gender Distribution across the District</h5>
                        <div class="container">
                            <div id="genderChart4" style="max-height: 700px; height: 400px"></div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // Initialize the echarts instance based on the prepared dom
                                var myChart = echarts.init(document.getElementById('genderChart4'));
                                var centerGender = @json($centerGender2);

                                // Specify the configuration items and data for the chart
                                var option = {
                                    title: {
                                    },
                                    tooltip: {},
                                    xAxis: [{
                                        type: 'category',
                                        data: ['Male', 'Female']
                                    }],
                                    yAxis: [{
                                        type: "value",
                                        min: 0,
                                        interval: 1
                                    }],
                                    series: [{
                                        name: 'Student Count',
                                        type: 'bar',
                                        data: [
                                        { value: centerGender.male_count},
                                        { value: centerGender.female_count, itemStyle: { color: '#98FB98' } }
                                    ]
                                    }]
                                };

                                // Display the chart using the configuration items and data just specified.
                                myChart.setOption(option);
                            })
                        </script>
                        <!-- End Bar Chart -->
                    </div>
                </div>
            </div>
        
            <!-- end gender distribution -->
            </div>
            @endcannot
            @endcan

        </div>
    </section>

@endsection
