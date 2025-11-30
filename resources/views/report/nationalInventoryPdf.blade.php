@extends('report.layouts.iae_pdf')

@section('title', 'National Inventory Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/NAT/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME NATIONAL INVENTORY REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report presents a national overview of inventory resources managed under the IPOSA (Integrated Post-School Adult Education) Programme. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the National Coordinator for the IPOSA Programme.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $inventoryCount }} inventories</strong> have been recorded and are actively utilized across adult education centers nationwide. These inventories are essential for supporting teaching, learning, and operational efficiency within the IPOSA framework.</p>
            <p>The data presented in this report provides insights into the distribution and availability of educational resources, ensuring accountability and informed decision-making in the allocation and maintenance of inventories across regions.</p>
            <p>The following table summarizes the total number of inventories available throughout the country under the IPOSA Programme, serving as a key reference for national planning, resource management, and programme sustainability.</p>
        </div>
    </div>

    <table class="table-plain">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Center</th>
                <th>District</th>
                <th>Region</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $index => $inventory)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->course }}</td>
                <td>{{ $inventory->center }}</td>
                <td>{{ $inventory->district }}</td>
                <td>{{ $inventory->region }}</td>
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



