<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IPOSA Report')</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            color: #222;
            background: #fff;
            font-size: 15px;
            margin: 15px 20px;
        }
        .letter-header { width: 100%; margin-bottom: 10px; }
        .header-center .gov { font-weight: bold; font-size: 16px; text-transform: uppercase; }
        .header-center .inst { font-weight: bold; font-size: 15px; text-transform: uppercase; }
        .header-center .est { font-size: 13px; font-style: italic; font-weight: normal; }
        .ref-date-row { width: 100%; display: flex; justify-content: space-between; margin: 20px 0 10px 0; }
        .ref-block { font-weight: bold; font-size: 13px; }
        .date-block { font-size: 13px; font-weight: bold; text-align: right; margin-top: -15px; }
        .recipient-block { margin-bottom: 18px; font-size: 14px; }
        .subject-block { font-weight: bold; text-transform: uppercase; margin-bottom: 18px; font-size: 15px; text-decoration: underline; text-align: center; }
        .letter-body { margin-bottom: 25px; text-align: justify; font-size: 14px; }
        .students-table { width: 100%; border-collapse: collapse; margin: 20px 0 30px 0; font-size: 13px; }
        .students-table th, .students-table td { border: 1px solid #222; padding: 6px 8px; text-align: center; }
        .students-table th { background: #f2f2f2; font-weight: bold; }
        .signature-section { margin-top: 40px; margin-bottom: 20px; display: flex; align-items: flex-start; justify-content: space-between; }
        .signature-left { max-width: 65%; }
        .signature-line { border-bottom: 1px solid #222; width: 200px; margin: 20px 0 5px 0; }
        .signature-img { height: 50px; margin-bottom: 1px; }
        .stamp-img { height: 100px; width: auto; margin-top: 10px; }
        .footer-contact { font-size: 12px; color: #222; position: fixed; bottom: 15px; left: 0; right: 0; text-align: center; }
        /* Map older templates' classes to unified table look */
        .table-plain { width: 100%; border-collapse: collapse; margin: 20px 0 30px 0; font-size: 13px; }
        .table-plain thead th { background: #f2f2f2; font-weight: bold; border: 1px solid #222; padding: 6px 8px; text-align: center; }
        .table-plain tbody td { border: 1px solid #222; padding: 6px 8px; text-align: center; }
        /* Optional content helpers preserved for existing files */
        .intro-section { margin: 10px 0 20px 0; }
        .report-title { font-weight: bold; text-transform: uppercase; text-align: center; margin: 15px 0; }
    </style>
</head>
<body>
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
        <div style="height:4px; background:#0a2a66; margin:0 0 2px 0; border-radius:2px;"></div>
        <div style="height:4px; background:#e6b800; margin:0 0 2px 0; border-radius:2px;"></div>
        <div style="height:4px; background:#3c8dbc; margin:0 0 18px 0; border-radius:2px;"></div>
    </div>

    <div class="ref-date-row">
        <div class="ref-block">@yield('ref')</div>
        <div class="date-block">@yield('date', 'Date: '.now()->format('F d, Y'))</div>
    </div>

    @hasSection('recipient')
    <div class="recipient-block">
        @yield('recipient')
    </div>
    @endif

    @hasSection('subject')
    <div class="subject-block">
        @yield('subject')
    </div>
    @endif

    <div class="letter-body">
        @yield('content')
    </div>

    <div class="footer-contact">
        <hr style="border-color: #0a4d8c30; margin: 5px 0;">
        All correspondence should be addressed to the Rector<br>
        10 Bibi Titi Mohammed St, Postal Code: 11101, P. O. Box 20679, Dar es Salaam - Tanzania<br>
        Tel: +255 22 2150838, Fax: +255 22 2150836<br>
        Email: rector@iae.ac.tz, Website: www.iae.ac.tz
    </div>

    <script type="text/php">
    if ( isset($pdf) ) {
        $pdf->page_text(520, 800, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0,0,0));
    }
    </script>
</body>
</html> 