@extends('admin.layouts.main')

@section('content')
@php
// If audit_year is in format "YYYY-YYYY", show as "01/04/YYYY - 31/03/YYYY+1"
$auditPeriod = '';
if (preg_match('/^(\d{4})-(\d{4})$/', $client->audit_year, $m)) {
$start = $m[1];
$end = $m[2];
$auditPeriod = "01/04/$start - 31/03/$end";
} else {
$auditPeriod = $client->audit_year;
}
@endphp
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet Four</h4>
                <div>
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
            <form action="{{ route('admin.client.saveInputs', $client->id) }}" method="POST">
                @csrf
                <!-- Parisheshta "a" -->
                <div class="text-center mb-3">
                    <h5 class="fw-bold" style="text-decoration: underline;">परिशिष्ट – "ब"</h5>
                </div>

                <!-- 1) संस्थेचे उद्देश -->
                <div>
                    <div class="fw-bold mb-2">1) संस्थेचे उद्देश ः—</div>
                    <div class="ps-3">
                        <div>
                            संस्थेच्या उपविधीत पोटनियम क्रमांक ब 1.1 अन्वये संस्थेचे विविध उद्देश
                            नमुद करण्यात आलेले असून यामध्ये
                        </div>
                        <ol class="mb-2" style="padding-left: 20px;">
                            <li>सभासदांमध्ये काटकसर, स्वावलंबन व सहकाराचा प्रसार करण्यास प्रोत्साहन देणे</li>
                            <li>संस्थेच्या व सभासदांच्या गरजा भागविण्यासाठी भांडवल स्विकारणे व सभासदांकडून
                                ठेवी स्विकारणे</li>
                            <li>सभासदांच्या आर्थिक गरजा पूर्ण करण्यासाठी कर्ज पुरवठा करणे यांचा
                                प्रामुख्याने समावेश आहे</li>
                            <li>बाहेरील कर्ज काढणे किंवा निधी उभारणे</li>
                            <li>संस्थेच्या उपयोगासाठी मालकी हक्काने किंवा भाडयाने जागा किंवा इमारत खरेदी करणे</li>
                            <li>सहकारी कायदा कलम 20 व 20 अ अंतर्गत संस्थाची भागीदारी व संस्थाकडून सहयोग
                                करता येइल</li>
                            <li>सभासदांचा आर्थीक व सामाजीक उन्नतीसाठी विविध उपक्रम हाती घेणे उपरोक्त सर्व
                                किंवा एखादा उददेश साधण्यासाठी लागणारी अनुषगीक सर्व कामे करणे.</li>
                        </ol>
                    </div>
                </div>

                <!-- 2) हिशोब पद्धती व अंतर्गत नियंत्रण -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">2) हिशोब पध्दती व अंतर्गत नियंत्रण :-</div>
                    <div class="ps-3">
                        संस्थेच्या तपासणी कालावधीत संस्थेकडे नियमित कर्मचारी वर्ग नेमल्याचे दिसून येत
                        आहे. संस्थेचा संपूर्ण हिशोब हे संस्थेचे सचिव {{$client->vice_chairman}} यांनी संस्थेचे दैनंदिन हिशोब
                        चांगल्या प्रकारे लिहिले आहेत. त्यांना दरमहा रु. <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="mandanadhan" value="{{ isset($clientInputs['mandanadhan']) ? $clientInputs['mandanadhan'] : '' }}"></span> मानधन देण्यात येत आहे. संस्थेला
                        संपूर्ण सभासंदानी केलेल्या सहकार्याने संस्था नियमीत प्रगतीपथाकडे वाटचाल करीत आहे. हे
                        संस्थेच्या आर्थिक परिस्थितीवरून दिसून येते याकडे संचालक मंडळाने विशेष लक्ष देणे गरजेचे
                        आहे.
                    </div>
                </div>

                <!-- 3) संस्थेचे कार्यालय :- -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">3) संस्थेचे कार्यालय :-</div>
                    <div class="ps-3">
                        संस्थेचे कार्यालय <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="office_address" value="{{ $clientInputs['office_address'] ?? '' }}"></span> येथे कार्यरत आहे.
                    </div>
                </div>

                <!-- 4) संस्थेचे कार्यक्षेत्र :- -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">4) संस्थेचे कार्यक्षेत्र :-</div>
                    <div class="ps-3">
                        संस्था उपविधी क्र. 1)(3) अन्वये संस्थेचे कार्यक्षेत्र <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="work_area" value="{{ $clientInputs['work_area'] ?? '' }}"></span> पुरते मर्यादित आहे.
                    </div>
                </div>

                <!-- 5) सभासद संख्या :- -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">5) सभासद संख्या :-</div>
                    <div class="ps-3">
                        @php
                        // If audit_year is in format "YYYY-YYYY", show as "01/04/YYYY - 31/03/YYYY+1"
                        $auditPeriod = '';
                        $start = '';
                        $end = '';
                        if (preg_match('/^(\d{4})-(\d{4})$/', $client->audit_year, $m)) {
                        $start = $m[1];
                        $end = $m[2];
                        $auditPeriod = "01/04/$start - 31/03/$end";
                        } else {
                        $auditPeriod = $client->audit_year;
                        }
                        @endphp
                        संस्थेची सभासद संख्या दिनांक <span>31.03.{{$start}}</span> ला अखेर <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="members_end" value="{{ $clientInputs['members_end'] ?? '' }}"></span> होती व सन {{$start}}-{{$end}} मध्ये <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="members_change" value="{{ $clientInputs['members_change'] ?? '' }}"></span> वाढ/घट झाली आहे. दिनांक 31.03.{{$end}} ला अखेर <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="members_final" value="{{ $clientInputs['members_final'] ?? '' }}"></span> आहेत.<br>
                        संस्थेत आय नमुना रजिस्टर ठेवण्यात आले
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="register_kept">
                            <option value="">Select</option>
                            <option value="आहे" {{ (isset($clientInputs['register_kept']) && $clientInputs['register_kept'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['register_kept']) && $clientInputs['register_kept'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        . वारसदाराचे नामनिर्देशित करण्यात आले
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="nominee_named">
                            <option value="">Select</option>
                            <option value="आहे" {{ (isset($clientInputs['nominee_named']) && $clientInputs['nominee_named'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['nominee_named']) && $clientInputs['nominee_named'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        सर्व सभासदांना भाग दाखले देण्यात आले
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="share_certificates_given">
                            <option value="">Select</option>
                            <option value="आहे" {{ (isset($clientInputs['share_certificates_given']) && $clientInputs['share_certificates_given'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['share_certificates_given']) && $clientInputs['share_certificates_given'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        .
                    </div>
                </div>

                <!-- 6) कर्मचारी वर्ग :- -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">6) कर्मचारी वर्ग :-</div>
                    <div class="ps-3">
                        संस्थेत एकूण <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="total_employees" value="{{ $clientInputs['total_employees'] ?? '' }}"></span> कर्मचारी आहे. सर्व कर्मचारी प्रशिक्षीत
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="employees_trained">
                            <option value="">Select</option>
                            <option value="आहे" {{ (isset($clientInputs['employees_trained']) && $clientInputs['employees_trained'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['employees_trained']) && $clientInputs['employees_trained'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        . व्यवस्थापक पदावर श्री. <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="manager_name" value="{{ $clientInputs['manager_name'] ?? '' }}"></span> कार्यरत आहेत.
                    </div>
                </div>

                <!-- 7) निवडणूक :- -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">7) निवडणूक :-</div>
                    <div class="ps-3">
                        संस्थेच्या संचालक मंडळाची निवडणूक दिनांक <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="election_date" value="{{ $clientInputs['election_date'] ?? '' }}"></span> ला झालेली असून अध्यक्षांची व कमेठी निवड दिनांक <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="committee_election_date" value="{{ $clientInputs['committee_election_date'] ?? '' }}"></span> ला झाली आहे. संचालक संख्या <span><input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="directors_count" value="{{ $clientInputs['directors_count'] ?? '' }}"></span> असून संचालक मंडळाचा कार्यकाल पाच वर्षांचा दिनांक <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="term_start" value="{{ $clientInputs['term_start'] ?? '' }}"></span> ते <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="term_end" value="{{ $clientInputs['term_end'] ?? '' }}"></span> पर्यंत आहे.
                    </div>
                </div>

                <!-- 8) सभा व कार्यवाही :- -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">8) सभा व कार्यवाही :-</div>
                    <div class="ps-3">
                        अ) आमसभा :- <br>
                        संस्थेची सन <span>01/04/{{$start}} ते 31/03/{{$end}}</span> ची आमसभा दिनांक <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="general_meeting_date" value="{{ $clientInputs['general_meeting_date'] ?? '' }}"></span> ला संस्थेचे कार्यालय, <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="meeting_office" value="{{ $clientInputs['meeting_office'] ?? '' }}"></span> येथे संस्थेच्या अध्यक्षतेखाली घेण्यात आली असून सभेला एकूण <span><input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="meeting_attendance" value="{{ $clientInputs['meeting_attendance'] ?? '' }}"></span> सभासद हजर होते.
                        <br>
                        सभेमध्ये एकूण <span><input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="tarav_ratio" value="{{ $clientInputs['tarav_ratio'] ?? '' }}"></span> ठरारावर चर्चा करण्यात आली असून योग्य ते निर्णय घेण्यात आले. सर्व ठराव सभासदांनी एकमताने मंजूर दिल्याचे इतिवृत्त पुस्तकावरून दिसून येते.
                        <br>
                        ब) संचालक मंडळ सभा :-
                        <br>
                        आर्थिक वर्षात संचालक मंडळाच्या एकूण <span><input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="board_meeting_count" value="{{ $clientInputs['board_meeting_count'] ?? '' }}"></span> सभा घेण्यात आलेल्या असून संस्थेने दर माहा एक सभा घेन्यात यावे. यात नवीन सभासदांना सामाविष्ट करणे, कर्जवाटप मंजूर करणे, जमाकर्ज मंजूर करणे इत्यादी व इतर विषयावर चर्चा करण्यात आले
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="board_meeting_held">
                            <option value="">Select</option>
                            <option value="आहेत" {{ (isset($clientInputs['board_meeting_held']) && $clientInputs['board_meeting_held'] == 'आहेत') ? 'selected' : '' }}>आहेत</option>
                            <option value="नाहीत" {{ (isset($clientInputs['board_meeting_held']) && $clientInputs['board_meeting_held'] == 'नाहीत') ? 'selected' : '' }}>नाहीत</option>
                        </select>
                        .
                    </div>
                </div>

                <!-- 9) संस्थेची आर्थिक स्थिती :- -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">9) संस्थेची आर्थिक स्थिती :-</div>
                    <div class="ps-3">
                        संस्थेने सादर केलेल्या व्यवहारांबाबत दोन वर्षांची तुलनात्मक माहिती खालील प्रमाणे आहे.
                        <table class="table table-bordered text-center align-middle mt-3" style="min-width:700px;">
                            <thead>
                                <tr>
                                    <th>अ. क्र.</th>
                                    <th>तपशील</th>
                                    <th>गत वर्ष</th>
                                    <th>चालू वर्ष</th>
                                    <th>शेरा व टक्के</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>सभासद संख्या</td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:70px;display:inline;" name="table_member_last" value="{{ $clientInputs['table_member_last'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:70px;display:inline;" name="table_member_current" value="{{ $clientInputs['table_member_current'] ?? '' }}"></td>
                                    <td>घट</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>भागभांडवल</td>
                                    <td>{{$client['वसुल भाग भागभांडवल_sum_lastYear']}}</td>
                                    <td>{{$client['वसुल भाग भागभांडवल_sum_currentYear']}}</td>
                                    <td>
                                        @php
                                        $diff = $client['वसुल भाग भागभांडवल_sum_currentYear'] - $client['वसुल भाग भागभांडवल_sum_lastYear'];
                                        $sign = $diff > 0 ? '+' : ($diff < 0 ? '-' : '' );
                                            @endphp
                                            {{$sign}}{{ abs($diff) }}
                                            </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>निधी</td>
                                    <td>{{$client['राखीव निधी_sum_lastYear']}}</td>
                                    <td>{{$client['राखीव निधी_sum_currentYear']}}</td>
                                    <td>@php
                                        $diff = $client['राखीव निधी_sum_currentYear'] - $client['राखीव निधी_sum_lastYear'];
                                        $sign = $diff > 0 ? '+' : ($diff < 0 ? '-' : '' );
                                            @endphp
                                            {{$sign}}{{ abs($diff) }}</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>ठेवी</td>
                                    <td>{{$client['ठेवी_sum_lastYear']}}</td>
                                    <td>{{$client['ठेवी_sum_currentYear']}}</td>
                                    <td>@php
                                        $diff = $client['ठेवी_sum_currentYear'] - $client['ठेवी_sum_lastYear'];
                                        $sign = $diff > 0 ? '+' : ($diff < 0 ? '-' : '' );
                                            @endphp
                                            {{$sign}}{{ abs($diff) }}</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>येणे कर्ज</td>
                                    <td>{{$client['येणे कर्ज_sum_lastYear']}}</td>
                                    <td>{{$client['येणे कर्ज_sum_currentYear']}}</td>
                                    <td>@php
                                        $diff = $client['येणे कर्ज_sum_currentYear'] - $client['येणे कर्ज_sum_lastYear'];
                                        $sign = $diff > 0 ? '+' : ($diff < 0 ? '-' : '' );
                                            @endphp
                                            {{$sign}}{{ abs($diff) }}</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>गुंतवणूक</td>
                                    <td>{{$client['गुंतवणूक_sum_lastYear']}}</td>
                                    <td>{{$client['गुंतवणूक_sum_currentYear']}}</td>
                                    <td>@php
                                        $diff = $client['गुंतवणूक_sum_currentYear'] - $client['गुंतवणूक_sum_lastYear'];
                                        $sign = $diff > 0 ? '+' : ($diff < 0 ? '-' : '' );
                                            @endphp
                                            {{$sign}}{{ abs($diff) }}</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>मालमत्ता</td>
                                    <td>{{$client['कायम मालमत्ता_sum_lastYear']}}</td>
                                    <td>{{$client['कायम मालमत्ता_sum_currentYear']}}</td>
                                    <td>@php
                                        $diff = $client['कायम मालमत्ता_sum_currentYear'] - $client['कायम मालमत्ता_sum_lastYear'];
                                        $sign = $diff > 0 ? '+' : ($diff < 0 ? '-' : '' );
                                            @endphp
                                            {{$sign}}{{ abs($diff) }}</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>नफा</td>
                                    @php
                                    $profit_last = $client['नफा_तोटा_sum_lastYear'];
                                    $profit_current = $client['नफा_तोटा_sum_currentYear'];
                                    @endphp
                                    <td>{{ $profit_last > 0 ? $profit_last : 0 }}</td>
                                    <td>{{ $profit_current > 0 ? $profit_current : 0 }}</td>
                                    @php
                                    $diff = $profit_current - $profit_last;
                                    $sign = $diff > 0 ? '+' : ($diff < 0 ? '-' : '' );
                                        @endphp
                                        @if($diff> 0)
                                        <td>{{$sign}} {{ abs($diff) }}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>तोटा</td>
                                    <td>{{ $profit_last < 0 ? abs($profit_last) : 0 }}</td>
                                    <td>{{ $profit_current < 0 ? abs($profit_current) : 0 }}</td>
                                    @if($diff < 0)
                                        <td>{{$sign}} {{ abs($diff) }}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>व्यवस्थापन खर्च</td>
                                    <td>{{$totalIncome2}}</td>
                                    <td>{{$totalExpense2}}</td>
                                    <td>@php
                                        $diff = $totalExpense2 - $totalIncome2;
                                        $sign = $diff > 0 ? '+' : ($diff < 0 ? '-' : '' );
                                            @endphp
                                            {{$sign}}{{ abs($diff) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-2">
                            वरील तपशील व संस्था प्रगती पथावर असून संस्थेची आर्थिक स्थिती समाधानकारक
                            <select class="form-control d-inline-block" style="width:100px;display:inline;" name="financial_status">
                                <option value="">Select</option>
                                <option value="आहे" {{ (isset($clientInputs['financial_status']) && $clientInputs['financial_status'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['financial_status']) && $clientInputs['financial_status'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            . वरील बाबीवरून संस्था कार्यक्षम असल्याचे दिसून येते
                            <select class="form-control d-inline-block" style="width:100px;display:inline;" name="efficient_status">
                                <option value="">Select</option>
                                <option value="आहे" {{ (isset($clientInputs['efficient_status']) && $clientInputs['efficient_status'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['efficient_status']) && $clientInputs['efficient_status'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            . परंतु कर्ज वसुली व कार्यवाही याकडे विशेष लक्ष द्यावे. व्यवस्थापन खर्चात काटकसर करून नफा वाढविण्याचा प्रयत्न करावा.
                        </div>
                    </div>
                </div>

                <!-- 10) लेखापरीक्षकाच्या निरीक्षणानुसार नमूद करावयाचे मुद्दे :- -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">1) लेखापरीक्षकाच्या निरीक्षणानुसार नमूद करावयाचे मुद्दे :-</div>
                    <div class="ps-3">
                        <table class="table table-bordered text-center align-middle" style="min-width:700px;">
                            <thead>
                                <tr>
                                    <th>अ. क्र.</th>
                                    <th>तपशील</th>
                                    <th>संस्थेचे आर्थिक पत्रकानुसार</th>
                                    <th>लेखापरीक्षकाच्या निरीक्षणानुसार</th>
                                    <th>फरक</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>स्वनिधी (नेटवर्थ)</td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="networth" value="{{ $clientInputs['networth'] ?? '10638256.99' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="networth_auditor" value="{{ $clientInputs['networth_auditor'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="networth_diff" value="{{ $clientInputs['networth_diff'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>भांडवल पर्याप्तता प्रमाण (CRAR)</td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="crar" value="{{ $clientInputs['crar'] ?? '16.08' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="crar_auditor" value="{{ $clientInputs['crar_auditor'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="crar_diff" value="{{ $clientInputs['crar_diff'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>कर्ज/ठेवी प्रमाण (CD Ratio)</td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="cd_ratio" value="{{ $clientInputs['cd_ratio'] ?? '88.19' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="cd_ratio_auditor" value="{{ $clientInputs['cd_ratio_auditor'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="cd_ratio_diff" value="{{ $clientInputs['cd_ratio_diff'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>थकीत कर्ज प्रमाण (%)</td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="overdue_loan_ratio" value="{{ $clientInputs['overdue_loan_ratio'] ?? '0-00' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="overdue_loan_ratio_auditor" value="{{ $clientInputs['overdue_loan_ratio_auditor'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="overdue_loan_ratio_diff" value="{{ $clientInputs['overdue_loan_ratio_diff'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>ढोबळ एन. पी. ए. (%)</td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="gross_npa" value="{{ $clientInputs['gross_npa'] ?? '61' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="gross_npa_auditor" value="{{ $clientInputs['gross_npa_auditor'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="gross_npa_diff" value="{{ $clientInputs['gross_npa_diff'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>निव्वळ एन. पी. ए. (%)</td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="net_npa" value="{{ $clientInputs['net_npa'] ?? '61' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="net_npa_auditor" value="{{ $clientInputs['net_npa_auditor'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="net_npa_diff" value="{{ $clientInputs['net_npa_diff'] ?? '' }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 10) विविध लेखापरीक्षण व अन्य तपासण्या -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">10) <span style="font-weight:bold;">विविध लेखापरीक्षण व अन्य तपासण्या</span></div>
                    <div class="ps-3">
                        <div class="fw-bold mb-2">1. गत वर्षांचे वैधानिक लेखापरीक्षण व दोष दुरुस्ती :</div>
                        <div>
                            गत वर्षांचे वैधानिक लेखापरीक्षण श्री <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="last_auditor_name" value="{{ $clientInputs['last_auditor_name'] ?? '' }}"></span> यांनी केले असून त्याचा लेखापरीक्षण अहवाल दि. <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="last_audit_report_date" value="{{ $clientInputs['last_audit_report_date'] ?? '' }}"></span> रोजी सादर केलेला आहे. सदर कालावधीसाठी लेखापरीक्षण वर्ग <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="last_audit_period" value="{{ $clientInputs['last_audit_period'] ?? '' }}"></span> दिलेला आहे. सदर लेखापरीक्षण अहवालाचा दोष दुरुस्ती अहवाल संस्थेने दि. <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="correction_report_date" value="{{ $clientInputs['correction_report_date'] ?? '' }}"></span> रोजी संबंधीत लेखापरीक्षकास सादर केलेला असून त्यांनी त्याचे शेरा नमूद करून दि. <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="correction_report_remark_date" value="{{ $clientInputs['correction_report_remark_date'] ?? '' }}"></span> रोजी सदरचा दोष दुरुस्ती अहवाल निबंधकास सादर केलेला आहे. सदर दोष दुरुस्ती अहवाल मुदतीत सादर केलेला
                            <select class="form-control d-inline-block" style="width:100px;display:inline;" name="internal_audit_done1">
                                <option value="">Select</option>
                                <option value="आहे" {{ (isset($clientInputs['internal_audit_done1']) && $clientInputs['internal_audit_done1'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['internal_audit_done1']) && $clientInputs['internal_audit_done1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            तसेच ज्या दोषांची पुर्तता झालेली नाही अशा दोषांचा तपशील खालीलप्रमाणे नमूद करावा.
                        </div>
                        <table class="table table-bordered text-center align-middle mt-3" style="min-width:700px;">
                            <thead>
                                <tr>
                                    <th>अ.क्र.</th>
                                    <th>लेप अहवाल पान क्र.</th>
                                    <th>मुददा क्र.</th>
                                    <th>मुद्द्यांचा संक्षिप्त तपशील</th>
                                    <th>अभिप्राय</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><input type="text" class="form-control" name="audit_table_1_page" value="{{ $clientInputs['audit_table_1_page'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="audit_table_1_point" value="{{ $clientInputs['audit_table_1_point'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="audit_table_1_detail" value="{{ $clientInputs['audit_table_1_detail'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="audit_table_1_remark" value="{{ $clientInputs['audit_table_1_remark'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><input type="text" class="form-control" name="audit_table_2_page" value="{{ $clientInputs['audit_table_2_page'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="audit_table_2_point" value="{{ $clientInputs['audit_table_2_point'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="audit_table_2_detail" value="{{ $clientInputs['audit_table_2_detail'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="audit_table_2_remark" value="{{ $clientInputs['audit_table_2_remark'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><input type="text" class="form-control" name="audit_table_3_page" value="{{ $clientInputs['audit_table_3_page'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="audit_table_3_point" value="{{ $clientInputs['audit_table_3_point'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="audit_table_3_detail" value="{{ $clientInputs['audit_table_3_detail'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="audit_table_3_remark" value="{{ $clientInputs['audit_table_3_remark'] ?? '' }}"></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="fw-bold mt-3 mb-2">2. अंतर्गत लेखापरीक्षण :</div>
                        <div>
                            सदर कालावधीचे अंतर्गत लेखापरीक्षण करण्यात आलेले
                            <span>
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="internal_audit_done">
                                    <option value="">Select</option>
                                    <option value="आहे" {{ (isset($clientInputs['internal_audit_done']) && $clientInputs['internal_audit_done'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                    <option value="नाही" {{ (isset($clientInputs['internal_audit_done']) && $clientInputs['internal_audit_done'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            </span>
                            .
                            <br>
                            दि. <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="internal_audit_from" value="{{ $clientInputs['internal_audit_from'] ?? '' }}"></span>
                            ते <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="internal_audit_to" value="{{ $clientInputs['internal_audit_to'] ?? '' }}"></span>
                            या कालावधीत अंतर्गत लेखापरीक्षण यांनी केले असून त्यांनी त्यांच्या अंतर्गत लेखापरीक्षण अहवाल दि. <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="internal_audit_report_date" value="{{ $clientInputs['internal_audit_report_date'] ?? '' }}"></span> रोजी संस्थेस सादर केलेला आहे. सदर लेखापरीक्षकास रु. <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="internal_audit_fee" value="{{ $clientInputs['internal_audit_fee'] ?? '' }}"></span> मानधन अदा केले आहे. अहवालातील दोषांचे पुर्तता संस्थेने केली?
                            <span>
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="internal_audit_issues_resolved">
                                    <option value="">Select</option>
                                    <option value="आहे" {{ (isset($clientInputs['internal_audit_issues_resolved']) && $clientInputs['internal_audit_issues_resolved'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                    <option value="नाही" {{ (isset($clientInputs['internal_audit_issues_resolved']) && $clientInputs['internal_audit_issues_resolved'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            </span>
                            .
                        </div>

                        <div class="fw-bold mt-3 mb-2">3. कर लेखापरीक्षण :</div>
                        <div>
                            सदर कालावधीचे कर लेखापरीक्षण करण्यात आलेले
                            <span>
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="tax_audit_done">
                                    <option value="">Select</option>
                                    <option value="आहे" {{ (isset($clientInputs['tax_audit_done']) && $clientInputs['tax_audit_done'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                    <option value="नाही" {{ (isset($clientInputs['tax_audit_done']) && $clientInputs['tax_audit_done'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            </span>
                            .
                        </div>
                    </div>
                </div>

                <!-- 11) कर लेखापरीक्षण -->
                <div class="mt-4">
                    <div class="ps-3">
                        सन <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="tax_audit_period" value="{{ $clientInputs['tax_audit_period'] ?? '' }}"></span>
                        या कालावधीचे कर लेखापरीक्षण श्री. <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="tax_auditor_name" value="{{ $clientInputs['tax_auditor_name'] ?? '' }}"></span>
                        यांनी केले आहे. त्यासाठी संस्थेचे रु. <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="tax_audit_fee" value="{{ $clientInputs['tax_audit_fee'] ?? '8000' }}"></span>
                        मानधन अदा केले आहे.
                    </div>
                </div>

                <!-- 12) चाचणी लेखापरीक्षण -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">4. <span style="font-weight:bold;">चाचणी लेखापरीक्षण</span> :</div>
                    <div class="ps-3">
                        सदर कालावधीत चाचणी लेखापरीक्षण करण्यात आलेले
                        <span>
                            <select class="form-control d-inline-block" style="width:100px;display:inline;" name="test_audit_done">
                                <option value="">Select</option>
                                <option value="आहे" {{ (isset($clientInputs['test_audit_done']) && $clientInputs['test_audit_done'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['test_audit_done']) && $clientInputs['test_audit_done'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </span>
                        .
                        <br>
                        संस्थेचे सन या कालावधीत चाचणी लेखापरीक्षण <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="test_auditor_name" value="{{ $clientInputs['test_auditor_name'] ?? '' }}"></span>
                        यांनी केले असून त्यांचा अहवाल दि. <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="test_audit_report_date" value="{{ $clientInputs['test_audit_report_date'] ?? '' }}"></span>
                        रोजी संस्थेस प्राप्त झाला आहे. अहवालातील पुर्तता न झालेल्या महत्त्वाचे दोष पुढीलप्रमाणे
                        <span>
                            <input type="textarea" class="form-control d-inline-block" style="width:600px;display:inline;" name="test_audit_unresolved_remarks" value="{{ $clientInputs['test_audit_unresolved_remarks'] ?? '' }}">
                        </span>
                        .
                    </div>
                </div>

                <!-- 13) कलम 89 (अ)(1) तपासणी -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">5. <span>कलम 89 (अ)(1) तपासणी</span> :</div>
                    <div class="ps-3">
                        सदर कालावधीत कलम 89 (अ)(1) तपासणी करण्यात आलेले
                        <span>
                            <select class="form-control d-inline-block" style="width:100px;display:inline;" name="section_89a1_done">
                                <option value="">Select</option>
                                <option value="आहे" {{ (isset($clientInputs['section_89a1_done']) && $clientInputs['section_89a1_done'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['section_89a1_done']) && $clientInputs['section_89a1_done'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </span>
                        .
                        <br>
                        अशी तपासणी झाली असल्यास, संस्थेने त्या कालावधीत सहकार खात्याची कलम 89 (अ)(1) अन्वये हुद्दा यांनी तपासणी केली असून त्यांनी संस्थेस दि. <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="section_89a1_report_date" value="{{ $clientInputs['section_89a1_report_date'] ?? '' }}"></span>
                        रोजी अहवाल सादर केला आहे. सदर अहवालाचा दोष दुरुस्ती अहवाल मुदतीत/ मुदतीनंतर सादर केलेबाबत तसेच अहवालातील पुर्तता न झालेल्या दोषांबाबत अभिप्राय नमूद करावेत. नाही
                        <!-- <span>
                            <select class="form-control d-inline-block" style="width:150px;display:inline;" name="section_89a1_correction_done">
                                <option value="">Select</option>
                                <option value="होय" {{ (isset($clientInputs['section_89a1_correction_done']) && $clientInputs['section_89a1_correction_done'] == 'होय') ? 'selected' : '' }}>होय</option>
                                <option value="नाही" {{ (isset($clientInputs['section_89a1_correction_done']) && $clientInputs['section_89a1_correction_done'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </span> -->
                        .
                    </div>
                </div>

                <!-- 14) कलम 83/88 चौकशी -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">6. <span>कलम 83/88 चौकशी</span> :</div>
                    <div class="ps-3">
                        अहवाल वर्षात कलम 83 / 88 चौकशीचे कोणतेच प्रकरण प्रलंबित
                        <span>
                            <select class="form-control d-inline-block" style="width:100px;display:inline;" name="section_83_88_pending">
                                <option value="">Select</option>
                                <option value="आहे" {{ (isset($clientInputs['section_83_88_pending']) && $clientInputs['section_83_88_pending'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['section_83_88_pending']) && $clientInputs['section_83_88_pending'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </span>
                        .
                    </div>
                </div>
                लेखापरीक्षण मुदतीत संस्थेची अधिनियमातील कलम 83/88 इ. चौकशी झाली असल्यास शेरे नमूद करावेत.
                <input type="textarea" class="form-control d-inline-block" style="width:600px;display:inline;" name="test_audit_unresolved_remarks1" value="{{ $clientInputs['test_audit_unresolved_remarks1'] ?? '' }}">

                <!-- 15) सहकार शिक्षण व प्रशिक्षण -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">11) <span style="font-weight:bold;">सहकार शिक्षण व प्रशिक्षण</span> :-</div>
                    <div class="ps-3">
                        महाराष्ट्र सहकारी संस्था अधिनियम 1960 च्या कलम 24 अ (1) व पोटनियम क्र. नुसार राजपत्रातील अधिसूचनेन्वये विनिर्दिष्ट करील अश्या प्रशिक्षण संस्थेमार्फत सभासद, संचालक सदस्य, अधिकारी व कर्मचारी यांच्या करिता सहकार शिक्षण व प्रशिक्षण आयोजित करीत. यानुसार संस्थेने आपले सभासद <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="training_members" value="{{ $clientInputs['training_members'] ?? '' }}"></span>, संचालक सदस्य, व अधिकारी व कर्मचारी यांना म. राज्य सहकारी संघ मर्या पुणे या मान्यताप्राप्त प्रशिक्षण संस्थेमार्फत दिनांक <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="training_from" value="{{ $clientInputs['training_from'] ?? '' }}"></span> ते दिनांक <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="training_to" value="{{ $clientInputs['training_to'] ?? '' }}"></span> या <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="training_days" value="{{ $clientInputs['training_days'] ?? '' }}"></span> दिवसांच्या कालावधीत प्रशिक्षण घेतले किंवा कसे? तसेच संबंधित संस्थेचा प्रशिक्षण दाखला संस्था दप्तरी आहे का?
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="training_certificate_available">
                            <option value="">Select</option>
                            <option value="होय" {{ (isset($clientInputs['training_certificate_available']) && $clientInputs['training_certificate_available'] == 'होय') ? 'selected' : '' }}>होय</option>

                            <option value="आहे" {{ (isset($clientInputs['training_certificate_available']) && $clientInputs['training_certificate_available'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['training_certificate_available']) && $clientInputs['training_certificate_available'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        <br>
                        अहवाल वर्षात कोणत्याही प्रकारचे प्रशिक्षण संस्थेने आयोजित केलेले
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="any_training_held">
                            <option value="">Select</option>
                            <option value="आहे" {{ (isset($clientInputs['any_training_held']) && $clientInputs['any_training_held'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['any_training_held']) && $clientInputs['any_training_held'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        .
                    </div>
                </div>

                <!-- 16) संगणक प्रणाली व ITDP ऑडिट -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">12) <span style="font-weight:bold;">संगणक प्रणाली व इडिपी ऑडिट</span> :-</div>
                    <div class="ps-3">
                        अहवाल वर्षात संस्थेने इडिपी ऑडिट केल्याची नोंद
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="itdp_audit_done">
                            <option value="">Select</option>
                            <option value="आहे" {{ (isset($clientInputs['itdp_audit_done']) && $clientInputs['itdp_audit_done'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['itdp_audit_done']) && $clientInputs['itdp_audit_done'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        .
                        <ol class="mb-2" style="padding-left: 20px;">
                            <li>
                                संस्था मुख्यालय व शाखा 100% संगणकीकृत असल्याबाबत तपशील विषद करा. -
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="fully_computerized">
                                    <option value="">Select</option>
                                    <option value="आहे" {{ (isset($clientInputs['fully_computerized']) && $clientInputs['fully_computerized'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                    <option value="नाही" {{ (isset($clientInputs['fully_computerized']) && $clientInputs['fully_computerized'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            </li>
                            <li>
                                संगणक डेटा सुरक्षितता आणि नियंत्रण योग्य राखणेसाठी घेतलेल्या दक्षतेबाबतचे अभिप्राय नोंदवा.
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="fully_computerized1">
                                    <option value="">Select</option>
                                    <option value="व्यवस्था पुरेशी आहे" {{ (isset($clientInputs['fully_computerized1']) && $clientInputs['fully_computerized1'] == 'व्यवस्था पुरेशी आहे') ? 'selected' : '' }}>व्यवस्था पुरेशी आहे</option>
                                    <option value="व्यवस्था पुरेशी नाही" {{ (isset($clientInputs['fully_computerized1']) && $clientInputs['fully_computerized1'] == 'व्यवस्था पुरेशी नाही') ? 'selected' : '' }}>व्यवस्था पुरेशी नाही</option>
                                </select>
                            </li>
                            <li>
                                संगणकीय खात्यांच्या माहितीचे वेळोवेळी बॅकअप घेतले जात असल्याचे अभिप्राय नोंदवा.
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="fully_computerized2">
                                    <option value="">Select</option>
                                    <option value="व्यवस्था पुरेशी आहे" {{ (isset($clientInputs['fully_computerized2']) && $clientInputs['fully_computerized2'] == 'व्यवस्था पुरेशी आहे') ? 'selected' : '' }}>व्यवस्था पुरेशी आहे</option>

                                    <option value="बॅकअप घेतले जाते" {{ (isset($clientInputs['fully_computerized2']) && $clientInputs['fully_computerized2'] == 'बॅकअप घेतले जाते') ? 'selected' : '' }}>बॅकअप घेतले जाते</option>
                                    <option value="बॅकअप घेतले जाते नाही" {{ (isset($clientInputs['fully_computerized2']) && $clientInputs['fully_computerized2'] == 'बॅकअप घेतले जाते नाही') ? 'selected' : '' }}>बॅकअप घेतले जाते नाही</option>

                                    <option value="व्यवस्था पुरेशी नाही" {{ (isset($clientInputs['fully_computerized2']) && $clientInputs['fully_computerized2'] == 'व्यवस्था पुरेशी नाही') ? 'selected' : '' }}>व्यवस्था पुरेशी नाही</option>
                                </select>
                            </li>
                            <li>
                                संगणक प्रणालीचे ईडीपी/सिस्टम ऑडिट नियमितपणे झाल्याबाबत कालावधी व अधिकृत फर्म यांचे नावासह तपशील नोंदवा
                                <span><input type="text" class="form-control d-inline-block" style="width:200px;display:inline;" name="itdp_audit_firm" value="{{ $clientInputs['itdp_audit_firm'] ?? '' }}"></span>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- 17) कायदा, नियम व पोटनियमाचे उल्लंघन -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">13) <span style="font-weight:bold;">कायदा, नियम व पोटनियमाचे उल्लंघन</span> :</div>
                    <div class="ps-3">
                        <table class="table table-bordered text-center align-middle" style="min-width:700px;">
                            <thead>
                                <tr>
                                    <th>अ. क्र.</th>
                                    <th>उल्लंघन</th>
                                    <th>कलम</th>
                                    <th>नियम</th>
                                    <th>पोटनियम</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>भागाचे दाखले देण्याबाबत</td>
                                    <td>22</td>
                                    <td>19</td>
                                    <td>20</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>संचालक मंडळाचे अधिकार कार्य व जबाबदाऱ्या</td>
                                    <td>73</td>
                                    <td>57, 58</td>
                                    <td>43 (12)</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>कर्जव्यवहार परिशिष्ट “क”</td>
                                    <td>49</td>
                                    <td>-</td>
                                    <td>53</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>गुतंवणुका</td>
                                    <td>70</td>
                                    <td>54,55</td>
                                    <td>59</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>अंतर्गत हिशोब तपासणीची नियुक्ती</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>43 (6)</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>सभासद, संचालक सदस्य, अधिकारी व कर्मचारी प्रशिक्षण</td>
                                    <td>24 अ (1)</td>
                                    <td>30</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>विवरणपत्रे सादर करणे</td>
                                    <td>79 (1 अ, 1 ब)</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>गतवर्षीचा दोष दुरुस्तीचा अहवाल</td>
                                    <td>82</td>
                                    <td>73</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>कर्मचारी भविष्य निवृत्ती निधी अंशदान</td>
                                    <td>79</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>नफा विभाजन निश्चीत करणे व त्याचे संविभाजन करणे</td>
                                    <td>65</td>
                                    <td>50,51</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>निव्वळ नफा पूर्वी करावयाचे वजावट</td>
                                    <td>49 अ</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- 18) स्वनिधी व भागाचे नकद मूल्य -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">14) <span style="font-weight:bold;">स्वनिधी व भागाचे नक्त मूल्य</span> :- संस्थेचा स्वनिधी खालील प्रमाणे आहे.</div>
                    <div class="ps-3">
                        <table class="table table-bordered text-center align-middle" style="min-width:700px;">
                            <thead>
                                <tr>
                                    <th>अ. क्र.</th>
                                    <th>तपशील</th>
                                    <th>गतवर्षी अखेर रु.</th>
                                    <th>चालूवर्षी अखेर रु.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>सभासद भांडवल</td>
                                    <td>{{$client['वसुल भाग भागभांडवल_sum_lastYear']}}</td>
                                    <td>{{$client['वसुल भाग भागभांडवल_sum_currentYear']}}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>राखीव निधी</td>
                                    <td>{{$client['राखीव निधी_sum_lastYear']}}</td>
                                    <td>{{$client['राखीव निधी_sum_currentYear']}}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>इमारत निधी</td>
                                    <td>{{$client['इमारत निधी_sum_lastYear']}}</td>
                                    <td>{{$client['इमारत निधी_sum_currentYear']}}</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>गुंतवणूक घट उतार निधी</td>
                                    <td>{{$client['गुंतवणूक चढ उतार निधी_sum_lastYear']}}</td>
                                    <td>{{$client['गुंतवणूक चढ उतार निधी_sum_currentYear']}}</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>लाभांश समीकरण निधी</td>
                                    <td>{{$client['लाभांश समीकरण_sum_lastYear']}}</td>
                                    <td>{{$client['लाभांश समीकरण_sum_currentYear']}}</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>चालू वर्षाचा नफा (लाभांश रकम वगळून)</td>
                                    <td>{{$client['नफा_तोटा_sum_lastYear']}}</td>
                                    <td>{{$client['नफा_तोटा_sum_currentYear']}}</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>वजा - संचीत तोटे</td>
                                    <td>{{$client['संचित तोटा_sum_lastYear']}}</td>
                                    <td>{{$client['संचित तोटा_sum_currentYear']}}</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>कमी केलेल्या तरतुदी</td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="networth_tax_last" value="{{ $clientInputs['networth_tax_last'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="networth_tax_current" value="{{ $clientInputs['networth_tax_current'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>एकूण स्वनिधी</td>
                                    <td>
                                        @php
                                        $sum_last =
                                        ($client['वसुल भाग भागभांडवल_sum_lastYear'] ?? 0) +
                                        ($client['राखीव निधी_sum_lastYear'] ?? 0) +
                                        ($client['इमारत निधी_sum_lastYear'] ?? 0) +
                                        ($client['गुंतवणूक चढ उतार निधी_sum_lastYear'] ?? 0) +
                                        ($client['लाभांश समीकरण_sum_lastYear'] ?? 0) +
                                        ($client['नफा_तोटा_sum_lastYear'] ?? 0);

                                        $minus_last =
                                        ($client['संचित तोटा_sum_lastYear'] ?? 0) +
                                        (is_numeric($clientInputs['networth_tax_last'] ?? null) ? $clientInputs['networth_tax_last'] : 0);

                                        $total_networth_last = $sum_last - $minus_last;
                                        @endphp
                                        {{ $total_networth_last }}
                                    </td>
                                    <td>
                                        @php
                                        $sum_current =
                                        ($client['वसुल भाग भागभांडवल_sum_currentYear'] ?? 0) +
                                        ($client['राखीव निधी_sum_currentYear'] ?? 0) +
                                        ($client['इमारत निधी_sum_currentYear'] ?? 0) +
                                        ($client['गुंतवणूक चढ उतार निधी_sum_currentYear'] ?? 0) +
                                        ($client['लाभांश समीकरण_sum_currentYear'] ?? 0) +
                                        ($client['नफा_तोटा_sum_currentYear'] ?? 0);

                                        $minus_current =
                                        ($client['संचित तोटा_sum_currentYear'] ?? 0) +
                                        (is_numeric($clientInputs['networth_tax_current'] ?? null) ? $clientInputs['networth_tax_current'] : 0);

                                        $total_networth_current = $sum_current - $minus_current;
                                        @endphp
                                        {{ $total_networth_current }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-2">
                            <span>दि. (गतवर्षी) अखेर स्वनिधी रु. <span>{{$total_networth_last}}</span> असून दि. <span>31/03/{{$end}}</span> (चालूवर्षी) अखेरचा स्वनिधी रु. <span>{{$total_networth_current}}</span> आहे. स्वनिधीत गतवर्षीपेक्षा रु. <span>{{ $total_networth_current - $total_networth_last }}</span> 
                            <select name="networth_diff" class="form-control d-inline-block" style="width:100px;display:inline;">
                                <option value="">Select</option>
                                <option value="वाढ" {{ (isset($clientInputs['networth_diff']) && $clientInputs['networth_diff'] == 'वाढ') ? 'selected' : '' }} >वाढ</option>
                                <option value="घट" {{ (isset($clientInputs['networth_diff']) && $clientInputs['networth_diff'] == 'घट') ? 'selected' : '' }}>घट</option>
                            </select>
                             झाली आहे.
                                @php
                                $networth_diff = $total_networth_current - $total_networth_last;
                                $networth_increase_percent = $total_networth_last != 0 ? round(($networth_diff / $total_networth_last) * 100, 2) : 0;
                                $working_capital_percent = (isset($client['totalIncome6']) && $client['totalIncome6'] != 0)
                                ? round(($total_networth_current / $client['totalIncome6']) * 100, 2)
                                : 0;
                                @endphp
                                स्वनिधी वाढीचे प्रमाण <span>{{ $networth_increase_percent }}</span>% आहे. स्वनिधीचे खेळत्या भांडवलाशी प्रमाण
                                <span>{{ $working_capital_percent }}</span>% आहे. स्वनिधीप्रमाणे सन <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="networth_year_for_loan" value="{{ $clientInputs['networth_year_for_loan'] ?? '' }}"></span> (पुढीलवर्षी) मध्ये कर्ज वाटपाचे धोरण निश्चित करावे.</span>
                        </div>
                        <div class="mt-2">
                            संस्थेच्या एका भागाची दर्शनी किंमत रु. <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="share_face_value" value="{{ $clientInputs['share_face_value'] ?? '' }}"></span> असून एकूण वस्तुम भागसंख्या <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="share_total_count" value="{{ $clientInputs['share_total_count'] ?? '' }}"></span> आहे. स्वनिधीनुसार एका भागाची किंमत रु. <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="share_value_by_networth" value="{{ $clientInputs['share_value_by_networth'] ?? '' }}"></span> आहे . महाराष्ट्र सहकारी संस्था नियम क्रमांक महाराष्ट्र . 23 अन्वये भाग रक्कम परत करतांना भागाचे मूल्यांपेक्षा दर्शनी किंमत यापैकी जी कमी असेल ती रक्कम <span>परत करावे</span> .
                            <input type="text" class="form-control d-inline-block" style="width:600px;display:inline;" name="share_return_remarks" value="{{ $clientInputs['share_return_remarks'] ?? '' }}">
                        </div>
                    </div>
                </div>

                <!-- 19) विमा -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">15) <span style="font-weight:bold;">विमा</span> :- <span>रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="insurance_amount" value="{{ $clientInputs['insurance_amount'] ?? '0.00' }}"></span></div>
                    <div class="ps-3">
                        संस्थेने या इन्शुरन्स कंपनीकडे <span><input type="text" class="form-control d-inline-block" style="width:150px;display:inline;" name="insurance_company" value="{{ $clientInputs['insurance_company'] ?? '' }}"></span> मुख्य कार्यालय व शाखांसाठी स्वतंत्रपणे विमा उतरविलेला आहे. यामध्ये इमारत, संगणक, फर्निचर, फिटिंग, वाहन, रोख रक्कम, मार्गस्थ रक्कमेसाठी, सोने कर्जातील तारण जिन्नस, स्टेशनरी तसेच संस्थेने कर्जापोटी जप्त केलेल्या मालमत्तेचा विमा, याव्यतिरिक्त सेवकांचा फॅडिलिटि व अपघात विम्याचा समावेश आहे. विम्याचा कालावधी दि. <span>{{$auditPeriod}}</span> अखेर आहे. याशिवाय कर्जदारांचा कर्जरक्कम संरक्षण विमा उतरविलेला
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="loan_insurance_done">
                            <option value="">Select</option>
                            <option value="आहे" {{ (isset($clientInputs['loan_insurance_done']) && $clientInputs['loan_insurance_done'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['loan_insurance_done']) && $clientInputs['loan_insurance_done'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        .
                        <div class="mt-2">
                            विमाचे विवरण खालील प्रमाणे
                            <table class="table table-bordered text-center align-middle mt-2" style="min-width:700px;">
                                <thead>
                                    <tr>
                                        <th>अ. क्र.</th>
                                        <th>विमा प्रकार</th>
                                        <th>कंपनीचे नाव</th>
                                        <th>रक्कम</th>
                                        <th>कालावधी</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" name="insurance_type_1" value="{{ $clientInputs['insurance_type_1'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control" name="insurance_company_1" value="{{ $clientInputs['insurance_company_1'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control" name="insurance_amount_1" value="{{ $clientInputs['insurance_amount_1'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control" name="insurance_period_1" value="{{ $clientInputs['insurance_period_1'] ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" name="insurance_type_2" value="{{ $clientInputs['insurance_type_2'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control" name="insurance_company_2" value="{{ $clientInputs['insurance_company_2'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control" name="insurance_amount_2" value="{{ $clientInputs['insurance_amount_2'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control" name="insurance_period_2" value="{{ $clientInputs['insurance_period_2'] ?? '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" name="insurance_type_3" value="{{ $clientInputs['insurance_type_3'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control" name="insurance_company_3" value="{{ $clientInputs['insurance_company_3'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control" name="insurance_amount_3" value="{{ $clientInputs['insurance_amount_3'] ?? '' }}"></td>
                                        <td><input type="text" class="form-control" name="insurance_period_3" value="{{ $clientInputs['insurance_period_3'] ?? '' }}"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- 20) व्यवसाय कर -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">16) <span style="font-weight:bold;">व्यवसाय कर</span> :-</div>
                    <div class="ps-3">
                        संस्थेने वित्तीय वर्षाचे व्यवसाय कर भरलेले
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="business_tax_paid">
                            <option value="">Select</option>
                            <option value="आहे" {{ (isset($clientInputs['business_tax_paid']) && $clientInputs['business_tax_paid'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['business_tax_paid']) && $clientInputs['business_tax_paid'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        वित्तीय वर्षाचे व्यवसाय कर भरल्याचे दिनांक <input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="business_tax_date" value="{{ $clientInputs['business_tax_date'] ?? '' }}">

                        संस्था व्यवसायकर रु. 750.00 ठराविक मुदतीत भरण्यात आले
                        <select class="form-control d-inline-block" style="width:100px;display:inline;" name="business_tax_paid_on_time">
                            <option value="">Select</option>
                            <option value="आहे" {{ (isset($clientInputs['business_tax_paid_on_time']) && $clientInputs['business_tax_paid_on_time'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['business_tax_paid_on_time']) && $clientInputs['business_tax_paid_on_time'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        .
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4> </h4>
                    <div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('admin/client/show', $client->id) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection