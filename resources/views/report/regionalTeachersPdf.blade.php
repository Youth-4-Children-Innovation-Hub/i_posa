@extends('report.layouts.iae_pdf')

@section('title', 'Regional Teachers Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($region->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($region->name) }} REGION TEACHERS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report provides a regional overview of teacher deployment and participation under the IPOSA (Integrated Post-School Adult Education) Programme within the <strong>{{ strtoupper($region->name) }} Region</strong>. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Regional Coordinator for the IPOSA Programme in the aforementioned region.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the region is supported by a total of <strong>{{ $teachersCount }} teachers</strong> actively engaged in facilitating adult education across centers. These educators form the backbone of the programme’s implementation, playing a vital role in delivering accessible and impactful learning experiences to adult learners.</p>
            <p>The data outlined in this report reflects the current teaching capacity within the region and is crucial for assessing workforce distribution, identifying staffing needs, and planning for future training and support initiatives.</p>
            <p>The following table presents a summary of all teachers serving within the IPOSA Programme across the region, offering valuable insights for regional programme coordination and strategic educational planning.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Email</th>
                <th>Center</th>
                <th>District</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $index => $teacher)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->phone }}</td>
                <td>{{ $teacher->email }}</td>
                <td>{{ $teacher->center}}</td>
                <td>{{ $teacher->district}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-left">
            <p><strong>Sincerely,</strong></p>
            <div class="signature-line"></div>
            <p><strong>{{ strtoupper(Auth::user()->name) }}</strong><br>
            Region Coordinator<br>
            IPOSA Programme</p>
        </div>
    </div>
@endsection

