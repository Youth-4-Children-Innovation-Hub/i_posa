@extends('report.layouts.iae_pdf')

@section('title', 'Center Clubs Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($center->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($center->name) }} CENTER CLUBS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents a detailed account of club activities established under the IPOSA (Integrated Post-School Adult Education) Programme within <strong>{{ strtoupper($center->name) }} Center</strong>. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Head of Center for the IPOSA Programme at this location.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $clubCount }} active clubs</strong> have been formed at the center. These clubs provide essential platforms for adult learners to engage in peer learning, life skills development, and community-driven initiatives beyond the classroom.</p>
            <p>The data presented in this report reflects the center’s efforts to foster a dynamic and inclusive learning environment through extracurricular activities. These clubs support holistic education, enhance learner participation, and contribute to the overall success of the IPOSA Programme.</p>
            <p>The following table outlines the total number of clubs currently active at the center, offering a foundation for monitoring learner engagement and planning future enrichment activities.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Club</th>
                <th>Chairperson</th>
                <th>Contact</th>
                <th>Funding</th>
                <th>Registration</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clubs as $index => $club)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $club->name }}</td>
                <td>{{ $club->chairperson }}</td>
                <td>{{ $club->contact }}</td>
                <td>{{ $club->funding }}</td>
                <td>{{ $club->status }}</td>
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



