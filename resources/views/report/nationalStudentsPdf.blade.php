@extends('report.layouts.iae_pdf')

@section('title', 'National Students Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/NAT/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME NATIONAL STUDENTS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report provides a comprehensive overview of student enrollment and participation under the IPOSA (Integrated Post-School Adult Education) Programme at the national level. It has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the National Coordinator for the IPOSA Programme.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $studentsCount }} students</strong> are enrolled in IPOSA centers across the country. This includes <strong>{{ $maleCount }} male</strong> and <strong>{{ $femaleCount }} female</strong> students, with <strong>{{ $disabledCount }} students identified as having disabilities</strong>. Additionally, the report records <strong>{{ $dropoutCount }} student dropouts</strong>, reflecting trends in retention and participation.</p>
            <p>The data presented herein provides valuable insights into national educational reach, inclusivity, and gender distribution within the adult education sector. It supports data-driven strategies aimed at improving access, equity, and learner retention across all regions.</p>
            <p>The following table summarizes the current national student statistics, offering essential data for programme monitoring, planning, and policy formulation at the highest level of IPOSA administration.</p>
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
                <th>Region</th>
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
                <td>{{ $student->region }}</td>
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
            National Coordinator<br>
            IPOSA Programme</p>
        </div>
    </div>
@endsection



