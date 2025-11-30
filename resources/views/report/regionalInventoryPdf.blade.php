@extends('report.layouts.iae_pdf')

@section('title', 'Regional Inventory Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($region->name,0,3)) }}/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: IPOSA PROGRAMME {{ strtoupper($region->name) }} REGION INVENTORY REPORT
@endsection

@section('content')
    <div class="intro-section">
        <div class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</div>
        <div class="intro-title">REPORT INTRODUCTION</div>
        <div class="paras">
            <p>This report provides a detailed account of inventory assets managed under the IPOSA (Integrated Post-School Adult Education) Programme within the <strong>{{ strtoupper($region->name) }} Region</strong>. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the Regional Coordinator for the IPOSA Programme in the aforementioned region.</p>
            <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the region oversees a total of <strong>{{ $inventoryCount }} inventories</strong> distributed across various learning centers. These inventories are essential for supporting teaching and learning activities, enhancing the functionality of adult education centers, and contributing to effective programme delivery.</p>
            <p>The information presented herein outlines the current inventory capacity within the region, offering insights into available educational resources and infrastructure. This data plays a critical role in strategic planning, resource management, and ensuring the sustainability of IPOSA’s educational initiatives.</p>
            <p>The following table presents a summary of all inventories currently accounted for across centers in the region, serving as an important reference for administrative tracking and regional programme oversight.</p>
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

