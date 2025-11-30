@extends('report.layouts.iae_pdf')

@section('title', 'Center Courses Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($center->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($center->name) }} CENTER COURSES REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report outlines the course offerings under the IPOSA (Integrated Post-School Adult Education) Programme at <strong>{{ strtoupper($center->name) }} Center</strong>. It has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Head of Center.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $courseCount }} courses</strong> are being delivered at the center. These courses address a variety of learning needs, from basic literacy and numeracy to life skills and vocational training, aligning with the goals of community empowerment and adult education.</p>
            <p>The information presented in this report reflects the current academic landscape of the center, supporting planning, resource allocation, and continuous improvement in curriculum delivery under the IPOSA Programme.</p>
            <p>The following table summarizes the total number of active courses offered at the center, serving as a reference for educational oversight and programme development at the grassroots level.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Course</th>
                <th>Teacher</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $index => $course)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $course->course }}</td>
                <td>{{ $course->teacher }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-left">
            <p><strong>Sincerely,</strong></p>
            <div class="signature-line"></div>
            <p><strong>{{ strtoupper(Auth::user()->name) }}</strong><br>
            Head of Center<br>
            IPOSA Programme</p>
        </div>
    </div>
@endsection



