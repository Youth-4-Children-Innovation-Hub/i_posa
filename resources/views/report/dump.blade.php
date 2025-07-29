<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPOSA Implementation Report</title>
    <style>
        /* PDF-optimized styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 100%;
            min-height: 297mm; /* A4 height */
            padding: 15mm 10mm 15mm 10mm; /* Reduced horizontal padding */
            box-sizing: border-box;
            position: relative;
        }

        /* Header using table layout for better PDF compatibility */
        .header-table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 15px;
        }

        .header-table td {
            vertical-align: middle;
            padding: 10px;
        }

        .logo-cell {
            width: 80px;
            text-align: center;
        }

        .header-cell {
            text-align: center;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            display: block;
            margin: 0 auto;
        }

        .header-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin: 3px 0;
            letter-spacing: 0.5px;
        }

        .header-subtitle {
            font-size: 11px;
            color: #7f8c8d;
            font-weight: normal;
            margin-top: 5px;
            font-style: italic;
        }

        /* Report Title */
        .report-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin: 25px 0 30px;
            text-decoration: underline;
            text-underline-offset: 5px;
        }

        /* Introduction Section */
        .intro-section {
            background-color: #fafbfc;
            padding: 20px;
            border-left: 4px solid #3498db;
            margin-bottom: 30px;
        }

        .intro-title {
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        .intro-paragraph {
            margin-bottom: 12px;
            text-align: justify;
            font-size: 11px;
            line-height: 1.5;
        }

        .intro-paragraph:last-child {
            margin-bottom: 0;
        }

        .intro-paragraph strong {
            color: #2c3e50;
            font-weight: bold;
        }

        /* Table Styles - Using simple table layout */
        .table-section {
            margin-bottom: 30px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            background-color: #fff;
            margin: 0;
        }

        .data-table thead th {
            background-color: #2c3e50;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            font-size: 9px;
            border: 1px solid #34495e;
        }

        .data-table tbody tr {
            border-bottom: 1px solid #e9ecef;
        }

        .data-table tbody tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        .data-table tbody td {
            padding: 8px 6px;
            vertical-align: top;
            color: #2c3e50;
            border: 1px solid #e9ecef;
            font-size: 10px;
        }

        .data-table tbody tr:first-child td {
            font-weight: 600;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 40px;
            margin-bottom: 30px;
        }

        .signature-section p {
            font-size: 12px;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .signature-line {
            width: 200px;
            height: 1px;
            background-color: #2c3e50;
            margin-bottom: 8px;
        }

        .signature-details {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .signature-details li {
            font-size: 11px;
            color: #2c3e50;
            margin-bottom: 2px;
            font-weight: 500;
        }

        .signature-details li:first-child {
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* Footer - Using absolute positioning */
        .footer {
            position: absolute;
            bottom: 10mm;
            left: 10mm;
            right: 10mm;
            background-color: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .footer-section {
            margin-bottom: 10px;
        }

        .footer-section:last-child {
            margin-bottom: 0;
        }

        .footer-divider {
            width: 80%;
            height: 1px;
            background-color: #c5c5c5;
            margin: 10px auto;
        }

        .footer ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .footer li {
            font-size: 9px;
            margin-bottom: 3px;
            line-height: 1.3;
        }

        .footer li:first-child {
            font-weight: bold;
            margin-bottom: 6px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Header Section using Table Layout -->
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ asset('/assets/img/coatofarms.png') }}" alt="Coat of Arms" class="logo-img" />
                </td>
                <td class="header-cell">
                    <h1 class="header-title">THE UNITED REPUBLIC OF TANZANIA</h1>
                    <h1 class="header-title">INSTITUTE OF ADULT EDUCATION</h1>
                    <h2 class="header-subtitle">(ESTABLISHED UNDER THE ACT No. 3 OF 1963)</h2>
                </td>
                <td class="logo-cell">
                    <img src="{{ public_path('assets/img/iae.png') }}" alt="IAE Logo" class="logo-img" />
                </td>
            </tr>
        </table>

        <!-- Report Title -->
        <h2 class="report-title">IMPLEMENTATION REPORT FOR IPOSA PROGRAMME</h2>

        <!-- Introduction Section -->
        <div class="intro-section">
            <h4 class="intro-title">REPORT INTRODUCTION</h4>
            <p class="intro-paragraph">
                This report presents the comprehensive implementation status of the
                IPOSA (Integrated Post-School Adult Education) Programme within
                <strong>{{ strtoupper($district->name) }} District</strong>. The
                report has been compiled by
                <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as
                the District Coordinator for the IPOSA Programme in the
                aforementioned district.
            </p>

            <p class="intro-paragraph">
                As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), the district has successfully established and is currently
                managing a total of
                <strong>{{ $clubsCount }} active IPOSA clubs</strong>. These clubs
                serve as vital community learning centers, providing adult education
                opportunities and fostering community development through various
                educational initiatives.
            </p>

            <p class="intro-paragraph">
                The data presented herein reflects the current operational status of
                all registered clubs within the district, including detailed
                information about club leadership, contact details, sponsorship
                arrangements, and operational centers. This report serves as an
                official record of the programme's implementation progress and
                demonstrates our commitment to advancing adult education initiatives
                in accordance with the Institute of Adult Education's mandate.
            </p>

            <p class="intro-paragraph">
                The following table provides a comprehensive overview of all active
                IPOSA clubs currently operating within the district, presenting
                essential information for administrative oversight and programme
                coordination purposes.
            </p>
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 8%;">No</th>
                        <th style="width: 25%;">Club Name</th>
                        <th style="width: 20%;">Chairperson</th>
                        <th style="width: 15%;">Contact</th>
                        <th style="width: 17%;">Sponsor</th>
                        <th style="width: 15%;">Center</th>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <p>Sincerely,</p>
            <div class="signature-line"></div>
            <ul class="signature-details">
                <li>{{ strtoupper(Auth::user()->name) }}</li>
                <li>District Coordinator</li>
                <li>IPOSA Programme</li>
            </ul>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <div class="footer-section">
                <ul>
                    <li>For more information please contact:</li>
                    <li>The Institute Clubs Coordinator</li>
                    <li>Mobile: +255783229535 or +255735016335</li>
                    <li>Email: clubs.coordinator@iae.ac.tz</li>
                </ul>
            </div>

            <div class="footer-divider"></div>

            <div class="footer-section">
                <ul>
                    <li>All correspondence should be addressed to the Rector</li>
                    <li>50, Bibi Titi Mohammed St, Postal Code: 11101, P. O. Box 20679, Dar es Salaam - Tanzania</li>
                    <li>Tel: +255 22 215 0838, Fax: +255 22 2150836</li>
                    <li>Email: rector@iae.ac.tz, Website: www.iae.ac.tz</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>