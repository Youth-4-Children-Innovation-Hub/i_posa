@extends('report.layouts.iae_pdf')

@section('title', 'Regional Clubs Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($region->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($region->name) }} REGION CLUBS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents the status of club formation and activities under the IPOSA (Integrated Post-School Adult Education) Programme within the <strong>{{ strtoupper($region->name) }} Region</strong>. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Regional Coordinator for the IPOSA Programme in the aforementioned region.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the region has successfully established a total of <strong>{{ $clubsCount }} functional clubs</strong>. These clubs play a crucial role in complementing formal adult education efforts by promoting peer learning, social engagement, skill development, and community participation among adult learners.</p>
            <p>The data presented herein captures the current scope of club activities within the region, contributing to a holistic understanding of learner engagement and extracurricular enrichment under the IPOSA Programme. The presence and performance of these clubs reflect the region's dedication to fostering inclusive and community-driven adult education environments.</p>
            <p>The following table provides a summary of all active clubs in the region, offering insights essential for administrative planning, resource coordination, and programme monitoring at the regional level.</p>
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

