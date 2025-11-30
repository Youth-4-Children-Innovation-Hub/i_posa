@extends('report.layouts.iae_pdf')

@section('title', 'National Centers Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/NAT/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME NATIONAL CENTERS REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report provides a national-level summary of adult education centers operating under the IPOSA (Integrated Post-School Adult Education) Programme. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving in a national coordination capacity for the IPOSA Programme.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $centersCount }} adult education centers</strong> have been established and are operational across various regions in the country. These centers form the structural backbone of IPOSA’s mission to provide accessible, inclusive, and community-driven adult education opportunities.</p>
            <p>The data presented herein reflects the current distribution and extent of learning centers nationwide, serving as a critical resource for assessing programme reach, resource allocation, and national educational planning.</p>
            <p>The following table summarizes the total number of active adult education centers across the country, offering essential insights for national monitoring and decision-making in the ongoing implementation of the IPOSA Programme.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Center</th>
                <th>HoC</th>
                <th>Ownership</th>
                <th>Funder</th>
                <th>District</th>
                <th>Region</th>
            </tr>
        </thead>
        <tbody>
            @foreach($centers as $index => $center)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $center->name }}</td>
                <td>{{ $center->hoc}}</td>
                <td>{{ $center->Ownership}}</td>
                <td>{{ $center->Funders}}</td>
                <td>{{ $center->district}}</td>
                <td>{{ $center->region}}</td>
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


