<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Students Report</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            color: #222;
            background: #fff;
            font-size: 15px;
            margin: 15px 20px; /* Slimmer margins */
        }
        .letter-header {
            width: 100%;
            margin-bottom: 10px;
        }
        .header-center .gov {
            font-weight: bold;
            font-size: 16px;
            text-transform: uppercase;
        }
        .header-center .inst {
            font-weight: bold;
            font-size: 15px;
            text-transform: uppercase;
        }
        .header-center .est {
            font-size: 13px;
            font-style: italic;
            font-weight: normal;
        }
        .ref-date-row {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin: 20px 0 10px 0;
        }
        .ref-block {
            font-weight: bold;
            font-size: 13px;
        }
        .date-block {
            font-size: 13px;
            font-weight: bold;
            text-align: right;
            margin-top: -15px;
        }
        .recipient-block {
            margin-bottom: 18px;
            font-size: 14px;
        }
        .subject-block {
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 18px;
            font-size: 15px;
            text-decoration: underline;
            text-align: center;
        }
        .letter-body {
            margin-bottom: 25px;
            text-align: justify;
            font-size: 14px;
        }
        .students-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0 30px 0;
            font-size: 13px;
        }
        .students-table th, .students-table td {
            border: 1px solid #222;
            padding: 6px 8px;
            text-align: center;
        }
        .students-table th {
            background: #f2f2f2;
            font-weight: bold;
        }
        .signature-section {
            margin-top: 40px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }
        .signature-left {
            max-width: 65%;
        }
        .signature-line {
            border-bottom: 1px solid #222;
            width: 200px;
            margin: 20px 0 5px 0;
        }
        .signature-img {
            height: 50px;
            margin-bottom: 1px;
        }
        .stamp-img {
            height: 100px;
            width: auto;
            margin-top: 10px;
        }
        .footer-contact {
            font-size: 12px;
            color: #222;
            position: fixed; /* Always at bottom */
            bottom: 15px;
            left: 0;
            right: 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="letter-header">
        <table width="100%" style="border-collapse:collapse; margin-bottom:0;">
            <tr>
                <td style="width:20%; text-align:left; vertical-align:top;">
                    <img src="{{ public_path('assets/img/coatofarms.png') }}" alt="Coat of Arms" style="height:80px;">
                </td>
                <td style="width:60%; text-align:center; vertical-align:top;" class="header-center">
                    <div class="gov">THE UNITED REPUBLIC OF TANZANIA</div>
                    <div class="inst">INSTITUTE OF ADULT EDUCATION</div>
                    <div class="est">(ESTABLISHED IN 1960)</div>
                </td>
                <td style="width:20%; text-align:right; vertical-align:top;">
                    <img src="{{ public_path('assets/img/iae.png') }}" alt="IAE Logo" style="height:80px;">
                </td>
            </tr>
        </table>
        <!-- Decorative lines -->
        <div style="height:4px; background:#0a2a66; margin:0 0 2px 0; border-radius:2px;"></div>
        <div style="height:4px; background:#e6b800; margin:0 0 2px 0; border-radius:2px;"></div>
        <div style="height:4px; background:#3c8dbc; margin:0 0 18px 0; border-radius:2px;"></div>
    </div>

    <!-- Reference & Date -->
    <div class="ref-date-row">
        <div class="ref-block">
            Our Ref: IPOSA/{{ now()->format('Y') }}/{{ strtoupper(substr($center->name,0,3)) }}/{{ date('His') }}
        </div>
        <div class="date-block">
            Date: {{ now()->format('F d, Y') }}
        </div>
    </div>

    <!-- Recipient -->
    <div class="recipient-block">
        MANAGER.<br>
        {{ strtoupper($center->name) }} CENTER<br>
        {{ $center->address ?? 'P.O. Box ______,' }}<br>
        {{ $center->district ?? 'District' }}, TANZANIA.<br><br>
        Dear Sir/Madam,
    </div>

    <!-- Subject -->
    <div class="subject-block">
        RE: IPOSA PROGRAMME <strong> {{ strtoupper($center->name) }} </strong> CENTER STUDENTS REPORT
    </div>

    <!-- Letter Body -->
    <div class="letter-body">
        <p>
            The Institute of Adult Education requires regular reporting on student enrollment and participation to ensure effective monitoring and evaluation of the IPOSA (Integrated Post-School Adult Education) Programme. This report provides a summary of the current status at <strong>{{ strtoupper($center->name) }} Center</strong> as compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, Head of Center.
        </p>
        <p>
            As of <strong>{{ now()->format('F j, Y') }}</strong>, the center serves a total of <strong>{{ $studentsCount }} students</strong> ({{ $maleCount }} male, {{ $femaleCount }} female). The report also records <strong>{{ $dropoutCount }} dropouts</strong>, highlighting the need for continuous efforts in student retention and support.
        </p>
        <p>
            The following table summarizes the student statistics at the center, serving as an important reference for planning, monitoring, and evaluation of adult education initiatives at the community level.
        </p>
    </div>

    <!-- Students Table -->
    <table class="students-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Course</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Disability</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $index => $student)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->course }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ ucfirst($student->gender) }}</td>
                <td>{{ $student->disability }}</td>
                <td>{{ ucfirst($student->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Signature & Stamp -->
    <div class="signature-section">
        <div class="signature-left">
            <p><strong>Sincerely,</strong></p>
            <img src="{{ public_path('assets/img/signature.png') }}" alt="Signature" class="signature-img">
            <div class="signature-line"></div>
            <p><strong>{{ strtoupper(Auth::user()->name) }}</strong><br>
            Head of Center<br>
            IPOSA Programme</p>
        </div>
       

    <!-- Footer -->
    <div class="footer-contact">
        <hr style="border-color: #0a4d8c30; margin: 5px 0;">
        All correspondence should be addressed to the Rector<br>
        10 Bibi Titi Mohammed St, Postal Code: 11101, P. O. Box 20679, Dar es Salaam - Tanzania<br>
        Tel: +255 22 2150838, Fax: +255 22 2150836<br>
        Email: rector@iae.ac.tz, Website: www.iae.ac.tz
    </div>

    <!-- Page Numbers for DOMPDF -->
    <script type="text/php">
    if ( isset($pdf) ) {
        $pdf->page_text(520, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0,0,0));
    }
    </script>
</body>
</html>
