@extends('report.layouts.iae_pdf')

@section('title', 'IPOSA Centers Implementation Report')

@section('ref')
Our Ref: IPOSA/{{ now()->format('Y') }}/@isset($center){{ strtoupper(substr($center->name,0,3)) }}@else CTR @endisset/{{ date('His') }}
@endsection

@section('date')
Date: {{ now()->format('F d, Y') }}
@endsection

@section('subject')
RE: THREE MONTHS IMPLEMENTATION REPORT FOR IPOSA CENTERS
@endsection

@section('content')
    <div class="intro-section">
        <p><b>1.0Introduction</b></p>
        <p>{{ $challenge->introduction }}</p>
    </div>

    <p><b>IPOSA Ownership and Funders</b></p>
    <table class="table-plain">
        <thead>
            <tr>
                <th>NO.</th>
                <th>Name of the Center</th>
                <th>Ownership</th>
                <th>Funders</th>
            </tr>
        </thead>
        <tbody>
            @foreach($owner_funder as $owner_funder)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $owner_funder->name }}</td>
                <td>{{ $owner_funder->Ownership }}</td>
                <td>{{ $owner_funder->Funders }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><b>3:0 IPOSA Learners </b></p>
    <table class="table-plain">
        <thead>
            <tr>
                <th>No.</th>
                <th>Number Of Learners</th>
                <th>Males</th>
                <th>Females</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $learnersCount }}</td>
                <td>{{ $malesCount }}</td>
                <td>{{ $femalesCount }}</td>
            </tr>
        </tbody>
    </table>

    <p><b>3:1 IPOSA Learners and stages of Learning</b></p>
    <table class="table-plain">
        <thead>
            <tr>
                <th>NO.</th>
                <th>NO. of Learners stg 1</th>
                <th>NO. of Learners without 3Rs</th>
                <th>NO. of learners stage 11</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $stage1Students }}</td>
                <td>{{ $without3rs }}</td>
                <td>{{ $stage2Students }}</td>
            </tr>
        </tbody>
    </table>

    <p><b>3:2 IPOSA Learners and the type of training</b></p>
    <table class="table-plain">
        <thead>
            <tr>
                <th>NO</th>
                <th>No. of Learners</th>
                <th>No. of Learners on Long-term training</th>
                <th>No. of Learners on Short-term training</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $learnersCount }}</td>
                <td>{{ $longTerm }}</td>
                <td>{{ $shortTerm }}</td>
            </tr>
        </tbody>
    </table>

    <p><b>3:3 IPOSA Learners profile</b></p>
    <table class="table-plain">
        <thead>
            <tr>
                <th>NO</th>
                <th>Learners Name</th>
                <th>Learning stage</th>
                <th>Learners contact</th>
                <th>Name of Parent/ Guardian</th>
                <th>Parent contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allLearners as $key => $learner)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $learner->name }}</td>
                <td>{{ $learner->stage }}</td>
                <td>{{ $learner->phone_number }}</td>
                <td>{{ $learner->parent }}</td>
                <td>{{ $learner->gPhone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><b>4.0 IPOSA Facilitators</b></p>
    <table class="table-plain">
        <thead>
            <tr>
                <th>NO</th>
                <th>Name of facilitator</th>
                <th>Qualifications</th>
                <th>Current employer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facilitators as $key => $facilitator)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $facilitator->name }}</td>
                <td>{{ $facilitator->qualification }}</td>
                <td>{{ $facilitator->employer }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><b>5:0 IPOSA Centers and the IPOSA Empowerment Clubs (IECs)</b></p>
    <table class="table-plain">
        <thead>
            <tr>
                <th>NO</th>
                <th>Name of the Empowerment Club</th>
                <th>Funding Sources</th>
            </tr>
        </thead>
        <tbody>
            @foreach($club1 as $index => $club)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $club->club_name }}</td>
                <td>{{ $club->funding }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><b>5:1 IPOSA Empowerment Clubs Information(IECs)</b></p>
    <table class="table-plain">
        <thead>
            <tr>
                <th>NO</th>
                <th>Name of IEC</th>
                <th>Registration Status</th>
                <th>Chaiperson Name</th>
                <th>Chaiperson's Contact</th>
                <th>Asset at IECs</th>
                <th>Capital</th>
                <th>Contact with TBS, TIRDO or SIDO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clubInfo as $key => $clubInfo)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $clubInfo->club_name }}</td>
                <td>{{ $clubInfo->Registration_status }}</td>
                <td>{{ $clubInfo->Chairperson }}</td>
                <td>{{ $clubInfo->Contact }}</td>
                <td>{{ $clubInfo->Asset }}</td>
                <td>{{ $clubInfo->Capital }}</td>
                <td>{{ $clubInfo->QA_Contact }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><b>6.0 Challenges and the way to overcome those challenges</b></p>
    <p>
        {{ $challenge->challenges }}
    </p>
@endsection


