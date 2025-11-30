@extends('report.layouts.iae_pdf')

@section('title', 'Regional Courses Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($region->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($region->name) }} REGION COURSES REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents an overview of course offerings under the IPOSA (Integrated Post-School Adult Education) Programme across the <strong>{{ strtoupper($region->name) }} Region</strong>. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Regional Coordinator for the IPOSA Programme in the aforementioned region.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $coursesCount }} adult education courses</strong> have been implemented across learning centers within the region. These courses are designed to equip adult learners with essential skills, promote lifelong learning, and enhance socio-economic opportunities within communities.</p>
            <p>The data provided herein reflects the scope and distribution of educational programmes currently being delivered under the IPOSA framework. It highlights the region’s commitment to offering diverse and accessible learning pathways tailored to the needs of adult learners.</p>
            <p>The following table summarizes all active courses facilitated in the region, serving as a vital resource for planning, coordination, and evaluation of programme effectiveness at the regional level.</p>
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

