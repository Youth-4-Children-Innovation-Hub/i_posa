@extends('report.layouts.iae_pdf')

@section('title', 'District Students Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($district->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($district->name) }} DISTRICT STUDENTS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents the comprehensive status of student enrollment and participation under the IPOSA (Integrated Post-School Adult Education) Programme within <strong>{{ strtoupper($district->name) }} District</strong>. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the District Coordinator for the IPOSA Programme in the aforementioned district.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the district has recorded a total of <strong>{{ $studentsCount }} enrolled students</strong>, consisting of <strong>{{ $maleCount }} males</strong>, <strong>{{ $femaleCount }} females</strong>, and <strong>{{ $disabledCount }} students with disabilities</strong>. Additionally, the district has documented <strong>{{ $dropoutCount }} student dropouts</strong> to date.</p>
            <p>The data presented herein reflects the current demographic and participation status of students across all active centers within the district. It includes detailed breakdowns of gender distribution, disability representation, and dropout rates—key indicators for assessing educational reach and programme impact at the community level.</p>
            <p>The following table provides a comprehensive overview of student enrollment figures for the district, serving as an essential reference for monitoring progress, identifying challenges, and guiding strategic planning for inclusive adult education delivery.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Center</th>
                <th>Gender</th>
                <th>Disability</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->course2 }}</td>
                <td>{{ $student->centerName2 }}</td>
                <td>{{ ucfirst($student->gender) }}</td>
                <td>{{ $student->disability }}</td>
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
            District Coordinator<br>
            IPOSA Programme</p>
        </div>
    </div>
@endsection


