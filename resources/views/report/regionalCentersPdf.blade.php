@extends('report.layouts.iae_pdf')

@section('title', 'Regional Centers Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($region->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($region->name) }} REGION CENTERS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents the consolidated status of IPOSA (Integrated Post-School Adult Education) Programme implementation at the <strong>{{ strtoupper($region->name) }} Regional</strong> level. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Regional Coordinator for the IPOSA Programme in the aforementioned region.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the region oversees a total of <strong>{{ $centersCount }} operational adult education centers</strong>. These centers serve as foundational platforms for delivering community-based learning, empowering adult learners, and advancing regional development through structured educational initiatives.</p>
            <p>The data presented herein reflects the current operational status of all centers registered under the IPOSA Programme across the region. It includes critical insights into the scale and distribution of educational infrastructure, which support strategic planning and policy implementation at the regional level.</p>
            <p>The following table provides a summarized overview of adult education centers across the region, offering a snapshot of the programme’s regional reach and capacity for adult learning service delivery.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Center</th>
                <th>Hoc</th>
                <th>District</th>
            </tr>
        </thead>
        <tbody>
            @foreach($centers as $index => $center)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $center->name }}</td>
                <td>{{ $center->hoc}}</td>
                <td>{{ $center->district}}</td>
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

