@extends('report.layouts.iae_pdf')

@section('title', 'District Teachers Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($district->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($district->name) }} DISTRICT TEACHERS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents the comprehensive status of teacher deployment and involvement under the IPOSA (Integrated Post-School Adult Education) Programme within <strong>{{ strtoupper($district->name) }} District</strong>. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the District Coordinator for the IPOSA Programme in the aforementioned district.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the district is served by a total of <strong>{{ $teachersCount }} dedicated teachers</strong> who play a vital role in delivering adult education across various learning centers. Their contributions are instrumental in fostering lifelong learning and advancing community development through education.</p>
            <p>The data presented herein reflects the current teacher distribution across operational centers within the district. It includes critical information that supports workforce planning, resource allocation, and programme performance evaluation in alignment with the objectives of the IPOSA Programme.</p>
            <p>The following table provides a detailed overview of teacher deployment in the district, offering essential insights for administrative oversight and strategic educational coordination.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Center</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $index => $teacher)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->phone}}</td>
                <td>{{ $teacher->email}}</td>
                <td>{{ $teacher->center}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-left">
            <p><strong>Sincerely,</strong></p>
            <div class="signature-line"></div>
            <p><strong>{{ strtoupper(Auth::user()->name) }}</strong><br>
            District Coordinator<br>
            IPOSA Programme</p>
        </div>
    </div>
@endsection



