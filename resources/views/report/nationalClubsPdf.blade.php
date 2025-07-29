<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPOSA Implementation Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Times New Roman', serif;
            line-height: 1.4;
            color: #333;
            background-color: #fafafa;
        }
        
        .official-header {
            padding: 20px;
            margin-bottom: 30px;
        }
        
        .logo-section {
            text-align: center;
            margin: 20px 0 30px 0;
        }
        
        .logo-placeholder {
            width: 90px;
            height: 85px;
            display: inline-block;
            color: #003366;
            font-weight: bold;
            font-size: 11px;
            text-align: center;
            background: #f8f9fa;
            padding-top: 32px;
            box-sizing: border-box;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
        }
        
        .header-text-center {
            text-align: center;
        }
        
        .header-title {
            color: #003366;
            font-weight: bold;
            font-size: 17px;
            text-align: center;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .header-subtitle {
            color: #666;
            font-size: 13px;
            text-align: center;
            font-style: italic;
            margin-bottom: 15px;
        }
        
        .report-title {
            color: #003366;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            margin: 25px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .intro-section {
            background: #ffffff;
            padding: 25px;
            margin: 30px 0;
            line-height: 1.6;
            font-size: 14px;
            text-align: justify;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            
            padding-left: 40px;
        }
        
        .intro-section p {
            margin-bottom: 18px;
            
        }

        .paras {
            
            border-left: 2px solid #003366;
            padding-left: 10px;
        }
        
        .intro-title {
            color: #003366;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .table-plain {
            background: white;
            margin: 20px 0;
        }
        
        .table-plain thead th {
            background: transparent;
            color: #003366;
            font-weight: bold;
            text-align: center;
            border: none;
            border-bottom: 1px solid #333;
            padding: 12px 8px;
            font-size: 13px;
        }
        
        .table-plain tbody td {
            padding: 10px 8px;
            font-size: 12px;
            border: none;
            text-align: center;
        }
        
        .table-plain tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .official-footer {
            margin-top: 50px;
            padding: 20px;
            /* background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); */
            border: 1px solid #dee2e6;
            border-radius: 8px;
            position: relative;
        }
        
        .signature-section {
            margin: 30px 0;
            text-align: left;
        }
        
        .signature-line {
            border-bottom: 1px solid #333;
            width: 200px;
            margin: 20px 0 5px 0;
        }
        
        .footer-contact {
            background: #003366;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 11px;
            line-height: 1.3;
        }
        
        .footer-address {
            text-align: center;
            margin-bottom: 10px;
        }
        
        .footer-slogan {
            text-align: center;
            font-weight: bold;
            color: #ffd700;
            margin-top: 10px;
        }
        
        .generation-info {
            position: absolute;
            bottom: -25px;
            right: 10px;
            font-size: 10px;
            color: #666;
            background: white;
            padding: 5px 10px;
            border-radius: 3px;
            border: 1px solid #ddd;
        }
        
        @media print {
            body { background-color: white; }
            .official-header, .report-title, .table-plain { box-shadow: none; }
        }
    </style>
</head>
<body>
    <!-- Official Header -->
    <div class="official-header">
        <div class="logo-section">
            
                <img src="{{ public_path('assets/img/iae.png') }}" width="125" height="120" style="display: block; border: 0px;">
            
            
            <div class="header-text-center">
                <div class="header-title">THE UNITED REPUBLIC OF TANZANIA</div>
                <div class="header-title">INSTITUTE OF ADULT EDUCATION</div>
                <div class="header-subtitle">(ESTABLISHED IN 1960)</div>
            </div>
        </div>
    </div>
    
    <!-- Report Title -->
    <div class="report-title">
        IMPLEMENTATION REPORT FOR IPOSA PROGRAMME
    </div>
    
    <!-- Introduction Section -->
    <div class="intro-section">
        <div class="intro-title">REPORT INTRODUCTION</div>
          <div class="paras">
              <p>This report presents a national overview of club establishment and engagement under the IPOSA (Integrated Post-School Adult Education) Programme. The report has been compiled by <strong>{{ strtoupper(Auth::user()->name) }}</strong>, serving as the National Coordinator for the IPOSA Programme.</p>
              
              <p>As of the date of this report generation (<strong>{{ now()->format('F j, Y') }}</strong>), a total of <strong>{{ $clubsCount }} active clubs</strong> have been formed across various regions in the country. These clubs serve as vital platforms for peer interaction, social learning, skill development, and community empowerment among adult learners.</p>
              
              <p>The information contained in this report reflects the current landscape of club-based activities nationwide and highlights the importance of extracurricular initiatives in supporting the holistic goals of adult education. These clubs also play a critical role in strengthening community engagement and sustaining learner participation across IPOSA centers.</p>
              
              <p>The following table summarizes the total number of active clubs established under the IPOSA Programme across the country, offering valuable insights for strategic planning, programme evaluation, and national-level coordination.</p>
          </div>
    </div>
    
    <!-- centers Details Table -->
    <div>
        <table class="table table-plain">
            <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Chairperson</th>
                <th>Contact</th>
                <th>Sponsor</th>
                <th>Center</th>
                <th>District</th>
                <th>Region</th>
                
                
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
                <td>{{ $club->region }}</td>    
            </tr>
            @endforeach   
        </tbody>
        </table>
    </div>
    
    <!-- Official Footer -->
    <div class="official-footer">
        <!-- Signature Section -->
        <div class="signature-section">
            <p><strong>Sincerely,</strong></p>
            <br>
            <div class="signature-line"></div>
            <p><strong>{{ strtoupper(Auth::user()->name) }}</strong><br>
            National Coordinator<br>
            IPOSA Programme</p>
        </div>
        
        <!-- Contact Information -->
        <div class="footer-contact">
            <div class="footer-address">
                <strong>For more information please contact:</strong><br>
                The Institute  Coordinator<br>
                Mobile: +255783229535 or +255735016335<br>
                Email: field.coordinator@iae.ac.tz
            </div>
            
            <hr style="border-color: #ffffff40; margin: 10px 0;">
            
            <div class="footer-address">
                All correspondence should be addressed to the Rector<br>
                10 Bibi Titi Mohammed St, Postal Code: 11101, P. O. Box 20679, Dar es Salaam - Tanzania<br>
                Tel: +255 22 2150838, Fax: +255 22 2150836<br>
                Email: rector@iae.ac.tz, Website: www.iae.ac.tz
            </div>
            
            <div class="footer-slogan">ELIMU KWA WOTE</div>
        </div>
        
        <!-- Generation Info 
        <div class="generation-info">
            <strong>Generated on:</strong> {{ now()->format('Y-m-d H:i:s') }} by {{ Auth::user()->name }}
        </div> -->
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


