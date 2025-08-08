@extends('report.layouts.iae_pdf')

@section('title', 'Regional Students Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($region->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($region->name) }} REGION STUDENTS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report outlines the current student enrollment and participation statistics under the IPOSA (Integrated Post-School Adult Education) Programme across the <strong>{{ strtoupper($region->name) }} Region</strong>. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Regional Coordinator for the IPOSA Programme in the aforementioned region.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the region has recorded a total of <strong>{{ $studentsCount }} enrolled students</strong>, comprising <strong>{{ $maleCount }} male</strong>, <strong>{{ $femaleCount }} female</strong>, and <strong>{{ $disabledCount }} students with disabilities</strong>. Additionally, the region has documented <strong>{{ $dropoutCount }} student dropouts</strong>, reflecting trends in retention and participation.</p>
            <p>The data presented herein provides a comprehensive overview of student demographics and educational access across the region. It serves as a key indicator of the IPOSA Programme’s regional reach and impact, supporting evidence-based planning and intervention to promote inclusive adult education.</p>
            <p>The following table summarizes student enrollment and participation across districts in the region, offering essential insights for monitoring progress and guiding strategic educational development.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Center </th>
                <th>Gender</th>
                <th>Disability</th>
                <th>District</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->center}}</td>
                <td>{{ ucfirst($student->gender) }}</td>
                <td>{{ $student->disability }}</td>
                <td>{{ $student->district }}</td>
                <td>{{ ucfirst($student->status) }}</td>
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

