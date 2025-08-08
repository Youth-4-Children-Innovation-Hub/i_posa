@extends('report.layouts.iae_pdf')

@section('title', 'Center Inventory Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($center->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($center->name) }} CENTER INVENTORY REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report provides a detailed overview of inventory resources managed under the IPOSA (Integrated Post-School Adult Education) Programme at <strong>{{ strtoupper($center->name) }} Center</strong>. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Head of Center.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the center manages a total of <strong>{{ $inventoryCount }} inventories</strong> supporting the delivery of adult education services. These inventories are essential for ensuring effective teaching, learning, and administration within the center.</p>
            <p>The data in this report reflects the center’s commitment to resource management and operational readiness, contributing to the overall goals of the IPOSA Programme. Proper maintenance and utilization of inventories enhance the quality of education and learner experience.</p>
            <p>The following table summarizes the total inventories currently in use at the center, serving as a critical reference for monitoring, planning, and improving resource allocation.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Use</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $index => $inventory)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->course }}</td>
                <td>{{ $inventory->use }}</td>
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



