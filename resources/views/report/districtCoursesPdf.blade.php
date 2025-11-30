@extends('report.layouts.iae_pdf')

@section('title', 'District Courses Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($district->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($district->name) }} DISTRICT COURSES REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents the comprehensive implementation status of the IPOSA (Integrated Post-School Adult Education) Programme within <strong>{{strtoupper($district->name)}}</strong> District. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the District Coordinator for the IPOSA Programme in the aforementioned district.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the district has successfully established and is currently managing a total of <strong>{{ $coursesCount }} cousrses tought across centers</strong>. These courses serve as vital community learning sources, providing adult education opportunities and fostering community development through various educational initiatives.</p>
            <p>The data presented herein reflects the current operational status of all registered centera within the district, including detailed information about center leadership, contact details, sponsorship arrangements, and operational centers. This report serves as an official record of the programme's implementation progress and demonstrates our commitment to advancing adult education initiatives in accordance with the Institute of Adult Education's mandate.</p>
            <p>The following table provides a comprehensive overview of all active IPOSA courses currently taught within the district, presenting essential information for administrative oversight and programme coordination purposes.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Course</th>
                <th>Teacher</th>
                <th>Center</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $index => $course)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $course->course }}</td>
                <td>{{ $course->teacher }}</td>
                <td>{{ $course->center }}</td>
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

