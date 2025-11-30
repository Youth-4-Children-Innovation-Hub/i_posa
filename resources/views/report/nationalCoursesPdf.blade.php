@extends('report.layouts.iae_pdf')

@section('title', 'National Courses Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/NAT/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME NATIONAL COURSES REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report provides a national-level summary of courses offered under the IPOSA (Integrated Post-School Adult Education) Programme. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the National Coordinator for the IPOSA Programme.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $courseCount }} courses</strong> have been implemented across adult education centers nationwide. These courses aim to enhance the knowledge, skills, and competencies of adult learners, contributing meaningfully to individual empowerment and national development.</p>
            <p>The data included in this report offers a comprehensive overview of the breadth of educational content delivered under the IPOSA framework. It underscores the programme’s commitment to delivering diverse and inclusive learning opportunities aligned with the evolving needs of adult learners across the country.</p>
            <p>The following table summarizes the total number of active courses offered across the IPOSA centers nationwide, providing essential insights for curriculum planning, national coordination, and strategic programme enhancement.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Course</th>
                <th>Teacher</th>
                <th>Center</th>
                <th>District</th>
                <th>Region</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $index => $course)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $course->course }}</td>
                <td>{{ $course->teacher }}</td>
                <td>{{ $course->center }}</td>
                <td>{{ $course->district }}</td>
                <td>{{ $course->region }}</td>
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


