@extends('report.layouts.iae_pdf')

@section('title', 'Center Teachers Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($center->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($center->name) }} CENTER TEACHERS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report provides a comprehensive summary of the teaching staff under the IPOSA (Integrated Post-School Adult Education) Programme at <strong>{{ strtoupper($center->name) }} Center</strong>. It has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Head of Center.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the center is staffed with a total of <strong>{{ $teacherCount }} teachers</strong> actively facilitating adult education. These educators are instrumental in delivering the IPOSA curriculum and fostering meaningful learning experiences for adult learners.</p>
            <p>The information in this report reflects the current instructional capacity of the center, offering key insights into workforce strength and enabling more effective planning and resource allocation.</p>
            <p>The following table presents a summary of the total number of teachers currently assigned to the center, serving as an essential reference for educational oversight and programme development at the local level.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Teacher</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachers as $index => $teacher)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->phone }}</td>
                <td>{{ $teacher->email }}</td>
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





