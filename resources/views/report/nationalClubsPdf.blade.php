@extends('report.layouts.iae_pdf')

@section('title', 'National Clubs Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/NAT/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME NATIONAL CLUBS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents a national overview of club establishment and engagement under the IPOSA (Integrated Post-School Adult Education) Programme. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the National Coordinator for the IPOSA Programme.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $clubsCount }} active clubs</strong> have been formed across various regions in the country. These clubs serve as vital platforms for peer interaction, social learning, skill development, and community empowerment among adult learners.</p>
            <p>The information contained in this report reflects the current landscape of club-based activities nationwide and highlights the importance of extracurricular initiatives in supporting the holistic goals of adult education. These clubs also play a critical role in strengthening community engagement and sustaining learner participation across IPOSA centers.</p>
            <p>The following table summarizes the total number of active clubs established under the IPOSA Programme across the country, offering valuable insights for strategic planning, programme evaluation, and national-level coordination.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Chairperson</th>
                <th>Contact</th>
                <th>Sponsor</th>
                <th>Center</th>
                <th>District</th>
                <th>Region</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clubs as $index => $club)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $club->name }}</td>
                <td>{{ $club->chairperson }}</td>
                <td>{{ $club->contact }}</td>
                <td>{{ $club->sponsor }}</td>
                <td>{{ $club->center }}</td>
                <td>{{ $club->district }}</td>
                <td>{{ $club->region }}</td>
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


