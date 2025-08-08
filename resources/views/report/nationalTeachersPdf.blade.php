@extends('report.layouts.iae_pdf')

@section('title', 'National Teachers Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/NAT/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME NATIONAL TEACHERS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents a national summary of teacher engagement under the IPOSA (Integrated Post-School Adult Education) Programme. It has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the National Coordinator for the IPOSA Programme.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $teachersCount }} teachers</strong> are actively facilitating learning across adult education centers nationwide. These educators are central to the delivery of quality education and play a vital role in achieving the objectives of the IPOSA Programme.</p>
            <p>The information in this report reflects the current teaching capacity and distribution at the national level. It supports ongoing efforts to monitor human resource availability, plan targeted capacity building, and ensure effective educational delivery across all regions.</p>
            <p>The following table summarizes the total number of teachers currently serving in IPOSA centers across the country, offering critical insights for national-level planning, policy formulation, and programme management.</p>
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
                <th>Region</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $index => $teacher)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $teacher->name ?? 'n/a' }}</td>
                <td>{{ $teacher->phone ?? 'n/a' }}</td>
                <td>{{ $teacher->email ?? 'n/a'}}</td>
                <td>{{ $teacher->center ?? 'n/a'}}</td>
                <td>{{ $teacher->district ?? 'n/a'}}</td>
                <td>{{ $teacher->region ?? 'n/a'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-left">
            <p><strong>Sincerely,</strong></p>
            <div class="signature-line"></div>
            <p><strong>{{ strtoupper(Auth::user()->name) }}</strong><br>
            National Coordinator<br>
            IPOSA Programme</p>
        </div>
    </div>
@endsection



