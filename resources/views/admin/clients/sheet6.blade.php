@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet Six</h4>
                <div>
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
            <!-- content here -->
            <form action="{{ route('admin.client.saveInputs', $client->id) }}" method="POST">
                @csrf

                <!-- START: नफा-तोटा पत्रक Design as per pasted image -->
                <div class="mt-4 mb-2">
                    <span class="fw-bold" style="font-size: 1.1em;">2. नफा-तोटा पत्रक :</span>
                </div>
                <div class="mb-2">
                    @php
                    // If audit_year is in format "YYYY-YYYY", show as "01/04/YYYY - 31/03/YYYY+1"
                    $auditPeriod = '';
                    $start = '';
                    $end = '';
                    if (preg_match('/^(\d{4})-(\d{4})$/', $client->year->audit_year, $m)) {
                    $start = $m[1];
                    $end = $m[2];
                    $auditPeriod = "01/04/$start - 31/03/$end";
                    } else {
                    $auditPeriod = $client->year->audit_year;
                    }
                    @endphp
                    संस्थे सन दि. <span style="font-weight:bold;">01/04/{{$start}} ते 31/03/{{$end}}</span> या आर्थिक वर्षाचे नफा-तोटा पत्रक विवेचन खालीलप्रमाणे -
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:900px;">
                        <thead>
                            <tr>
                                <th>अ. क्र.</th>
                                <th>तपशील</th>
                                <th>गत वर्ष अखेर रु.</th>
                                <th>चालू वर्ष अखेर रु.</th>
                                <th>वाढ/घट</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold" rowspan="4" style="vertical-align: middle;">अ</td>
                                <td class="fw-bold" colspan="4" style="text-align:left;">उत्पन्न</td>
                            </tr>
                            <tr>
                                <td>1. कर्जावर मिळालेले व्याज</td>
                                <td>{{$client['कर्जावरील व्याज_sum_lastYear'] ?? ''}}</td>
                                <td>{{$client['कर्जावरील व्याज_sum_currentYear'] ?? ''}}</td>
                                <td>{{$client['कर्जावरील व्याज_sum_currentYear'] - $client['कर्जावरील व्याज_sum_lastYear']}}</td>
                            </tr>
                            <tr>
                                <td>2. गुंतवणुकीवर मिळालेले व्याज <br>
                                    <span style="font-size: 0.95em;">अ) ठेविवरिल व्याज <br> ब) शासकीय कर्ज रोख्यावरिल व्याज</span>
                                </td>
                                <td>{{$client['गुंतवणुकीवरील व्याज_sum_lastYear'] ?? ''}}</td>
                                <td>{{$client['गुंतवणुकीवरील व्याज_sum_currentYear'] ?? ''}}</td>
                                <td>{{$client['गुंतवणुकीवरील व्याज_sum_currentYear'] - $client['गुंतवणुकीवरील व्याज_sum_lastYear']}}</td>
                            </tr>
                            <tr>
                                <td>3. इतर उत्पन्न</td>
                                <td>{{$client['इतर उत्त्पन्न_sum_lastYear'] ?? ''}}</td>
                                <td>{{$client['इतर उत्त्पन्न_sum_currentYear'] ?? ''}}</td>
                                <td>{{$client['इतर उत्त्पन्न_sum_currentYear'] - $client['इतर उत्त्पन्न_sum_lastYear']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END: नफा-तोटा पत्रक Design -->

                <!-- START: नफा-तोटा पत्रक (खर्च, नफा/तोटा सारांश) Design as per pasted image -->
                <div class="mt-4 mb-2">
                    <table class="table table-bordered text-center align-middle" style="min-width:900px;">
                        <tbody>
                            <tr>
                                <td class="fw-bold" colspan="2" style="text-align:left;">एकूण उत्पन्न</td>
                                <td>{{$totalIncomeLastYear = $client['कर्जावरील व्याज_sum_lastYear'] + $client['गुंतवणुकीवरील व्याज_sum_lastYear']  +  $client['इतर उत्त्पन्न_sum_lastYear']}}</td>
                                <td>{{$totalIncomeCurrentYear = $client['कर्जावरील व्याज_sum_currentYear'] + $client['गुंतवणुकीवरील व्याज_sum_currentYear'] + $client['इतर उत्त्पन्न_sum_currentYear']  }}</td>
                                <td>{{$totalIncomeDiff =$totalIncomeLastYear - $totalIncomeCurrentYear }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold" rowspan="7" style="vertical-align: middle;">ब</td>
                                <td class="fw-bold" style="text-align:left;">खर्च</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td>1. ठेवीवरील व्याज</td>
                                <td>{{$client['ठेवीवरील व्याज_sum_lastYear'] ?? ''}}</td>
                                <td>{{$client['ठेवीवरील व्याज_sum_currentYear'] ?? ''}}</td>
                                <td>{{$client['ठेवीवरील व्याज_sum_currentYear'] - $client['ठेवीवरील व्याज_sum_lastYear']}}</td>
                            </tr>
                            <tr>
                                <td>2. आस्थापना खर्च</td>
                                <td>{{$client['आस्थापना खर्च_sum_lastYear'] ?? ''}}</td>
                                <td>{{$client['आस्थापना खर्च_sum_currentYear'] ?? '' }}</td>
                                <td>{{$client['आस्थापना खर्च_sum_currentYear'] - $client['आस्थापना खर्च_sum_lastYear']}}</td>
                            </tr>
                            <tr>
                                <td>3. प्रशासकीय खर्च</td>
                                <td>{{$client['प्रशासकीय खर्च_sum_lastYear'] ?? ''}}</td>
                                <td>{{$client['प्रशासकीय खर्च_sum_currentYear'] ?? ''}}</td>
                                <td>{{$client['प्रशासकीय खर्च_sum_currentYear'] - $client['प्रशासकीय खर्च_sum_lastYear']}}</td>
                            </tr>
                            <tr>
                                <td>4. तुरतुदी</td>
                                <td>{{$client['तरतूद खर्च_sum_lastYear'] ?? ''}}</td>
                                <td>{{$client['तरतूद खर्च_sum_currentYear'] ?? ''}}</td>
                                <td>{{$client['तरतूद खर्च_sum_currentYear'] - $client['तरतूद खर्च_sum_lastYear']}}</td>
                            </tr>
                            <tr>
                                <td>5. इतर खर्च</td>
                                <td>{{$client['इतर खर्च_sum_lastYear'] ?? ''}}</td>
                                <td>{{$client['इतर खर्च_sum_currentYear'] ?? ''}}</td>
                                <td>{{ $client['इतर खर्च_sum_currentYear'] - $client['इतर खर्च_sum_lastYear']}}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold" style="text-align:left;">एकूण खर्च</td>
                                <td>{{$totalExpLastYear = $client['ठेवीवरील व्याज_sum_lastYear'] + $client['आस्थापना खर्च_sum_lastYear'] +  $client['प्रशासकीय खर्च_sum_lastYear'] + $client['तरतूद खर्च_sum_lastYear'] + $client['इतर खर्च_sum_lastYear']}}</td>
                                <td>{{$totalExpCurrentYear = $client['ठेवीवरील व्याज_sum_currentYear'] + $client['आस्थापना खर्च_sum_currentYear'] + $client['प्रशासकीय खर्च_sum_currentYear'] + $client['तरतूद खर्च_sum_currentYear'] + $client['इतर खर्च_sum_currentYear'] }}</td>
                                <td>{{$totalExpDiff = $totalExpLastYear - $totalExpCurrentYear}}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold" style="text-align:left;">निव्वळ नफा</td>
                                <td>{{$client['नफा_तोटा_sum_lastYear']}}</td>
                                @if($totalIncomeLastYear - $totalExpLastYear > 0)
                                <td>{{ $totalIncomeLastYear - $totalExpLastYear}}</td>
                                @else
                                <td>0</td>
                                @endif
                                @if($totalIncomeLastYear - $totalExpLastYear > 0)

                                <td>{{$totalIncomeCurrentYear - $totalExpCurrentYear}}</td>
                                @else
                                <td>0</td>
                                @endif
                                @if($totalIncomeLastYear - $totalExpLastYear > 0)

                                <td>{{ ($totalIncomeCurrentYear - $totalExpCurrentYear) - ($totalIncomeLastYear - $totalExpLastYear)}}</td>
                                @else
                                <td>0</td>
                                @endif
                            </tr>
                            @php
                            $totalLoss = $totalExpCurrentYear - $totalIncomeCurrentYear
                            @endphp
                            <tr>
                                <td class="fw-bold" style="text-align:left;">निव्वळ तोटा</td>
                                @if($totalIncomeLastYear - $totalExpLastYear < 0)
                                    <td>{{$totalIncomeLastYear - $totalExpLastYear}}</td>
                                    @else
                                    <td>0</td>
                                    @endif
                                    @if($totalIncomeLastYear - $totalExpLastYear < 0)
                                        <td>{{ $totalIncomeCurrentYear - $totalExpCurrentYear}}</td>
                                        @else
                                        <td>0</td>
                                        @endif
                                        @if($totalIncomeLastYear - $totalExpLastYear < 0)
                                            <td>{{ ($totalIncomeCurrentYear - $totalExpCurrentYear) - ($totalIncomeLastYear - $totalExpLastYear)}}</td>
                                            @else
                                            <td>0</td>
                                            @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2" style="font-weight:bold;">
                    लेखापरीक्षण मुदतीत उत्पन्नात रु. <span>{{$totalIncomeDiff}}</span> वाढ/घट झाली आहे. एकूण खर्चात रु. <span>{{$totalExpDiff}}</span> वाढ/घट झाली आहे. निव्वळ नफा रु. <span>{{$totalProfit ?? 0}}</span> वाढ/घट झाली आहे. निव्वळ तोटा रु. <span>{{ $totalLoss > 0 ? $totalLoss : 0 }}</span> वाढ/घट झाली आहे. अहवाल कालावधीत निव्वळ नफ़्यापुर्वी खर्चाच्या तरतुदी केल्या आहेत.
                </div>
                <div class="mb-2">
                    <table class="table table-bordered text-center align-middle" style="min-width:900px;">
                        <thead>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>शाखेचे नाव</th>
                                <th>उत्पन्न</th>
                                <th>खर्च</th>
                                <th>नफा/तोटा</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=1;$i<=7;$i++)
                                <tr>
                                <td>{{ $i }}</td>
                                <td><input type="text" class="form-control" name="branch_{{ $i }}_name" value="{{ $clientInputs['branch_'.$i.'_name'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="branch_{{ $i }}_income" value="{{ $clientInputs['branch_'.$i.'_income'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="branch_{{ $i }}_exp" value="{{ $clientInputs['branch_'.$i.'_exp'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="branch_{{ $i }}_profit_loss" value="{{ $clientInputs['branch_'.$i.'_profit_loss'] ?? '' }}"></td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                    ज्या शाखा सातत्याने तोट्यात आहेत त्याबाबत स्वयंस्पष्ट अभिप्राय नमुद करावेत.
                </div>
                <div class="mb-2">
                    संस्थेने दर्शवलेला नफा/तोटा खालील कारणामुळे रास्त व योग्य स्थिती दर्शवत नसल्यास अभिप्राय द्यावेत.
                    उदा.
                </div>

                <!-- START: नफा/तोटा विश्लेषण व अभिप्राय (as per pasted image) -->
                <div class="mb-2">
                    <ol style="padding-left: 20px;">
                        <li>
                            खर्चाच्या रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_expense_diff" value="{{ $clientInputs['reason_expense_diff'] ?? '' }}"> तरतूद कमी जास्त केल्या.
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="reason_expense_diff1">
                                <option value="आहे" {{ (isset($clientInputs['reason_expense_diff1']) && $clientInputs['reason_expense_diff1'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['reason_expense_diff1']) && $clientInputs['reason_expense_diff1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>एनपीएची तरतूद रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_npa_diff" value="{{ $clientInputs['reason_npa_diff'] ?? '' }}"> कमी जास्त केल्या.
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="reason_expense_diff2">
                                <option value="आहे" {{ (isset($clientInputs['reason_expense_diff2']) && $clientInputs['reason_expense_diff2'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['reason_expense_diff2']) && $clientInputs['reason_expense_diff2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>भांडवली खर्च रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_capital_expense" value="{{ $clientInputs['reason_capital_expense'] ?? '' }}"> महसूल खर्चात नोंद केला
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="reason_expense_diff3">
                                <option value="आहे" {{ (isset($clientInputs['reason_expense_diff3']) && $clientInputs['reason_expense_diff3'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['reason_expense_diff3']) && $clientInputs['reason_expense_diff3'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            .
                        </li>
                        <li>महसूल रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_revenue" value="{{ $clientInputs['reason_revenue'] ?? '' }}"> भांडवली खर्चात नोंद केला
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="reason_expense_diff4">
                                <option value="आहे" {{ (isset($clientInputs['reason_expense_diff4']) && $clientInputs['reason_expense_diff4'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['reason_expense_diff4']) && $clientInputs['reason_expense_diff4'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            .
                        </li>
                        <li>गतवर्षीचा रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_gaothan" value="{{ $clientInputs['reason_gaothan'] ?? '' }}"> खर्च उत्पन्न अहवाल वर्षात/जमाखर्ची केला
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="reason_expense_diff5">
                                <option value="आहे" {{ (isset($clientInputs['reason_expense_diff5']) && $clientInputs['reason_expense_diff5'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['reason_expense_diff5']) && $clientInputs['reason_expense_diff5'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            .
                        </li>
                        <li>गुंतवणूकवरील येणे व्याज रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_investment_interest" value="{{ $clientInputs['reason_investment_interest'] ?? '' }}"> उत्पन्नात घेतले
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="reason_expense_diff6">
                                <option value="आहे" {{ (isset($clientInputs['reason_expense_diff6']) && $clientInputs['reason_expense_diff6'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['reason_expense_diff6']) && $clientInputs['reason_expense_diff6'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>.
                        </li>
                        <li>कर्जावरील वसूल न झालेले व्याज रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_unrealized_loan_interest" value="{{ $clientInputs['reason_unrealized_loan_interest'] ?? '' }}"> उत्पन्नात घेतले
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="reason_expense_diff7">
                                <option value="आहे" {{ (isset($clientInputs['reason_expense_diff7']) && $clientInputs['reason_expense_diff7'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['reason_expense_diff7']) && $clientInputs['reason_expense_diff7'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>.
                        </li>
                        <li>ठेवीवरील देय व्याज रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_misc_interest" value="{{ $clientInputs['reason_misc_interest'] ?? '' }}"> खर्चात घेतले
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="reason_expense_diff8">
                                <option value="आहे" {{ (isset($clientInputs['reason_expense_diff8']) && $clientInputs['reason_expense_diff8'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['reason_expense_diff8']) && $clientInputs['reason_expense_diff8'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>.
                        </li>
                    </ol>
                </div>
                <div class="mb-2">
                    याशिवाय खालीलप्रमाणे अभिप्राय नमुद करावेत.
                </div>
                <div class="mb-2">
                    <ol style="padding-left: 20px;">
                        <li>
                            संस्थेस सर्व कायदेशीर तरतुदी करण्या इतपत रक्कमेचा ढोबळ नफा झालेबाबतचे अभिप्राय नोंदवा -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="legal_provisions_profit_opinion">
                                <option value="आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion']) && $clientInputs['legal_provisions_profit_opinion'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion']) && $clientInputs['legal_provisions_profit_opinion'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            <br>
                            <input type="text" class="form-control d-inline-block" style="width:1000px;display:inline;" name="legal_provisions_profit_opinion_text" value="{{ $clientInputs['legal_provisions_profit_opinion_text'] ?? '' }}">
                        </li>
                        <li>
                            मागील आर्थिक वर्षातील निव्वळ नफयाची कलम ६५ नियम ४९ नुसार पोटनियमाप्रमाणे विविध निधीमध्ये विभागणी करुन लाभांश देण्या इतपत निव्वळ नफा झालेबाबतचा तपशील विषद करा
                            <span>
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="legal_provisions_profit_opinion1">
                                    <option value="">Select</option>
                                    <option value="आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion1']) && $clientInputs['legal_provisions_profit_opinion1'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                    <option value="नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion1']) && $clientInputs['legal_provisions_profit_opinion1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    <option value="लागू आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion1']) && $clientInputs['legal_provisions_profit_opinion1'] == 'लागू आहे') ? 'selected' : '' }}>लागू आहे</option>
                                    <option value="लागू नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion1']) && $clientInputs['legal_provisions_profit_opinion1'] == 'लागू नाही') ? 'selected' : '' }}>लागू नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control d-inline-block" style="width:1000px;display:inline;" name="legal_provisions_profit_opinion1_text" value="{{ $clientInputs['legal_provisions_profit_opinion1_text'] ?? '' }}">
                            </span>
                        </li>
                        <li>
                            संस्थेने लाभांश जर निव्वळ नफ्याच्या १५% पेक्षा जास्त दिलेला असल्यास, त्यास निबंधकाची परवानगी घेतले किंवा कसे याबाबत शेरे नमूद करा -
                            <span>
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="legal_provisions_profit_opinion2">
                                    <option value="">Select</option>

                                    <option value="आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion2']) && $clientInputs['legal_provisions_profit_opinion2'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                    <option value="नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion2']) && $clientInputs['legal_provisions_profit_opinion2'] == 'नाही') ? 'selected' : '' }}>नाही</option>

                                    <option value="लागू आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion2']) && $clientInputs['legal_provisions_profit_opinion2'] == 'लागू आहे') ? 'selected' : '' }}>लागू आहे</option>
                                    <option value="लागू आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion2']) && $clientInputs['legal_provisions_profit_opinion2'] == 'लागू आहे') ? 'selected' : '' }}>लागू आहे</option>

                                </select>
                                <br>
                                <input type="text" class="form-control d-inline-block" style="width:1000px;display:inline;" name="legal_provisions_profit_opinion2_text" value="{{ $clientInputs['legal_provisions_profit_opinion2_text'] ?? '' }}">
                            </span>
                        </li>
                        <li>
                            चुकीचा नफा दर्शवून अतिरिक्त लाभांश वाटप केलेबाबतचे अभिप्राय द्या. -
                            <span>
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="legal_provisions_profit_opinion3">
                                    <option value="">Select</option>

                                    <option value="आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion3']) && $clientInputs['legal_provisions_profit_opinion3'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                    <option value="नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion3']) && $clientInputs['legal_provisions_profit_opinion3'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    <option value="लागू आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion3']) && $clientInputs['legal_provisions_profit_opinion3'] == 'लागू आहे') ? 'selected' : '' }}>लागू आहे</option>
                                    <option value="लागू नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion3']) && $clientInputs['legal_provisions_profit_opinion3'] == 'लागू नाही') ? 'selected' : '' }}>लागू नाही</option>


                                </select>
                                <br>
                                <input type="text" class="form-control d-inline-block" style="width:1000px;display:inline;" name="legal_provisions_profit_opinion3_text" value="{{ $clientInputs['legal_provisions_profit_opinion3_text'] ?? '' }}">
                            </span>
                        </li>
                        <li>
                            संस्थेस तोटा झालेला आहे काय? असल्यास तोट्यांची कारणमिमांसा नमुद करा -
                            <span>
                                <select class="form-control d-inline-block" style="width:100px;display:inline;" name="legal_provisions_profit_opinion4">
                                    <option value="">Select</option>

                                    <option value="आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion4']) && $clientInputs['legal_provisions_profit_opinion4'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                    <option value="नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion4']) && $clientInputs['legal_provisions_profit_opinion4'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    <option value="लागू आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion4']) && $clientInputs['legal_provisions_profit_opinion4'] == 'लागू आहे') ? 'selected' : '' }}>लागू आहे</option>
                                    <option value="लागू नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion4']) && $clientInputs['legal_provisions_profit_opinion4'] == 'लागू नाही') ? 'selected' : '' }}>लागू नाही</option>


                                </select>
                                <br>
                                <input type="text" class="form-control d-inline-block" style="width:1000px;display:inline;" name="legal_provisions_profit_opinion4_text" value="{{ $clientInputs['legal_provisions_profit_opinion4_text'] ?? '' }}">
                            </span>
                        </li>
                        <li>
                            संस्थेने सभासदांना निबंधकाच्या परवानगीशिवाय भेट वस्तु दिल्यास त्याबाबत अभिप्राय नमूद करावेत -
                            <span> <select class="form-control d-inline-block" style="width:100px;display:inline;" name="legal_provisions_profit_opinion5">
                                    <option value="">Select</option>

                                    <option value="आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion5']) && $clientInputs['legal_provisions_profit_opinion5'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                    <option value="नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion5']) && $clientInputs['legal_provisions_profit_opinion5'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    <option value="लागू आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion5']) && $clientInputs['legal_provisions_profit_opinion5'] == 'लागू आहे') ? 'selected' : '' }}>लागू आहे</option>
                                    <option value="लागू नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion5']) && $clientInputs['legal_provisions_profit_opinion5'] == 'लागू नाही') ? 'selected' : '' }}>लागू नाही</option>


                                </select>
                                <br>
                                <input type="text" class="form-control d-inline-block" style="width:1000px;display:inline;" name="legal_provisions_profit_opinion5_text" value="{{ $clientInputs['legal_provisions_profit_opinion5_text'] ?? '' }}">
                            </span>
                        </li>
                    </ol>
                </div>
                <div class="mb-2">
                    क आर्थिक प्रमाणके:
                </div>
                <p>खालील आर्थिक प्रमाणकांबाबत तपशिलवार अभिप्राय नमूद करावेत.</p>
                <!-- END: नफा/तोटा विश्लेषण व अभिप्राय -->

                <!-- START: आर्थिक प्रमाणके Design as per pasted image -->
                <div class="mb-4">
                    <table class="table table-bordered text-center align-middle" style="min-width:950px;">
                        <thead>
                            <tr>
                                <th>अ. क्र.</th>
                                <th>तपशील</th>
                                <th>गणना सूत्र</th>
                                <th>आदर्श प्रमाण %</th>
                                <th>प्रत्यक्ष प्रमाण %</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold" colspan="5" style="text-align:left;">अ) खेळत्या भागभांडवलाशी प्रमाण</td>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>वसूल भागभांडवल</td>
                                <td>वसूल भाग भांडवल ÷ खेळते भांडवल x 100</td>
                                <td>2 ते 4</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                            ? number_format(($client['वसुल भाग भागभांडवल_sum_currentYear'] / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                            : '0.00' 
                                        }}
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>निधी</td>
                                <td>एकूण निधी ÷ खेळते भांडवल x 100</td>
                                <td>4 ते 6</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format((($client['राखीव निधी_sum_currentYear'] + $client['इतर सर्व निधी_sum_currentYear']) / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>

                            </tr>
                            <tr>
                                <td>3</td>
                                <td>ठेवी</td>
                                <td>एकूण ठेवी ÷ खेळते भांडवल x 100</td>
                                <td>80 ते 85</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format(($client['ठेवी_sum'] / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>इतर देणी</td>
                                <td>इतर देणी ÷ खेळते भांडवल x 100</td>
                                <td>2 ते 3</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format(($client['इतर देणी_sum_currentYear'] / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>निव्वळ नफा</td>
                                <td>निव्वळ नफा ÷ खेळते भांडवल x 100</td>
                                <td>1 ते 2</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format(($totalProfit / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>
                            </tr>

                            <tr>
                                <td>6</td>
                                <td>रोख व बँकेतील शिल्लक</td>
                                <td>रोख व बँकेतील शिल्लक ÷ खेळते भांडवल x 100</td>
                                <td>2 ते 4</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format((($client['रोख शिल्लक_sum'] + $client['बँक शिल्लक_sum']) / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>गुंतवणूक</td>
                                <td>गुंतवणूक ÷ खेळते भांडवल x 100</td>
                                <td>25</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                    ? number_format(($client['गुंतवणूक_sum'] / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                    : '0.00' 
                                }}
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>कर्ज</td>
                                <td>एकूण कर्ज ÷ खेळते भांडवल x 100</td>
                                <td>60 ते 65</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                    ? number_format(($client['येणे कर्ज_sum'] / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                    : '0.00' 
                                }}
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>इतर येणे</td>
                                <td>इतर येणे ÷ खेळते भांडवल x 100</td>
                                <td>6</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format(($client['इतर येणे_sum_currentYear'] / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>

                            </tr>
                            <tr>
                                <td>10</td>
                                <td>एकूण उत्पन्न</td>
                                <td>एकूण उत्पन्न ÷ खेळते भांडवल x 100</td>
                                <td>10 ते 12</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format(($client['एकूण उत्पन्न_sum_currentYear'] / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>व्यवस्थापन खर्च</td>
                                <td>व्यवस्थापन खर्च ÷ खेळते भांडवल x 100</td>
                                <td>2</td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format((($client['आस्थापना खर्च_sum_currentYear'] + $client['प्रशासकीय खर्च_sum_currentYear'] + $client['इतर खर्च_sum_currentYear']) / $client['खेळते भागभांडवल_sum']) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>
                            </tr>
                            <tr class="fw-bold">
                                <td colspan="5" style="text-align:left;">ब) एकूण उत्पन्नाशी प्रमाण</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>निव्वळ नफ्याचे</td>
                                <td>निव्वळ नफा ÷ एकूण उत्पन्न x 100</td>
                                <td>10</td>
                                <td> {{ $client['एकूण उत्पन्न_sum_currentYear'] != 0 ? number_format((($totalProfit ?? 0) / $client['एकूण उत्पन्न_sum_currentYear']) * 100, 2) : '0.00' }}
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>व्यवस्थापन खर्चाचे</td>
                                <td>व्यवस्थापन खर्च ÷ एकूण उत्पन्न x 100</td>
                                <td>30 ते 35</td>
                                <td>
                                    {{number_format(( $client['व्यवस्थापन खर्च_sum_currentYear'] / $totalIncomeCurrentYear) * 100, 2)}}
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>आस्थापना खर्च</td>
                                <td>आस्थापना खर्च ÷ एकूण उत्पन्न x 100</td>
                                <td>20 ते 25</td>
                                <td>{{number_format(( $client['आस्थापना खर्च_sum_currentYear']  / $totalIncomeCurrentYear) * 100, 2)}}</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>दिलेल्या व्याजाचे</td>
                                <td>दिलेल्या व्याज ÷ एकूण उत्पन्न x 100</td>
                                <td>50 ते 55</td>
                                <td>{{number_format(( $client['ठेवीवरील व्याज_sum_currentYear']  / $totalIncomeCurrentYear) * 100, 2)}}</td>
                            </tr>
                            <tr class="fw-bold">
                                <td colspan="5" style="text-align:left;">क) अन्य प्रमाणके</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>निधीच्या खर्चाचे प्रमाण</td>
                                <td>ठेवीवरील दिलेले व्याज ÷ कर्जावरील दिलेले व्याज x 100</td>
                                <td></td>
                                <td>{{number_format(($client['ठेवीवरील व्याज_sum_currentYear']  / $client['कर्जावरील व्याज_sum_currentYear']) * 100, 2)}}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>एकूण उत्पन्नातील प्रमाण</td>
                                <td>नफा ÷ उत्पन्न x 100</td>
                                <td></td>
                                <td>{{number_format(( $totalProfit  / $totalIncomeCurrentYear) * 100, 2)}}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>निव्वळ नफयाचे सरासरी खेळत्या भागभांडवलाशी प्रमाण</td>
                                <td>निव्वळ नफा ÷ सरासरी खेळते x 100</td>
                                <td></td>
                                <td>
                                    <?php
                                    $client['सरासरी खेळते_sum'] = $client['खेळते भागभांडवल_sum'] / 12;
                                    // Calculate the average working capital
                                    ?>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                    ? number_format((($totalProfit / $client['सरासरी खेळते_sum'])) * 100, 2) 
                                    : '0.00' 
                                }}
                                </td>

                            </tr>
                            <tr>
                                <td>4</td>
                                <td>व्यवसायातील नफयाचे सरासरी खेळत्या भांगभांडवलाचे प्रमाण</td>
                                <td>निव्वळ नफा ÷ सरासरी खेळते भांडवल x 100</td>
                                <td></td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format((($totalProfit / $client['सरासरी खेळते_sum'])) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>

                            </tr>
                            <!-- START: Additional Ratios as per pasted image -->
                            <tr>
                                <td>5</td>
                                <td>नफााचे कर्ज + गुंतवणूकशी प्रमाण</td>
                                <td> खर्च ÷ गुंतवणूक x 100</td>
                                <td></td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
        ? number_format((($totalProfit / $client['गुंतवणूकशी प्रमाण'])) * 100, 2) 
        : '0.00' 
    }}
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>व्यवस्थापन खर्चाचे खेळत्या भांडवलाशी प्रमाण</td>
                                <td>व्यवस्थापन खर्च ÷ खेळते भांडवल x 100</td>
                                <td></td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
        ? number_format((($client['व्यवस्थापन खर्च_sum_currentYear']) / $client['खेळते भागभांडवल_sum'] / 12) * 100, 2) 
        : '0.00' 
    }}
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>मुदत ठेवीचे एकूण ठेवीशी प्रमाण</td>
                                <td>मुदत ठेवी (बचत व चालू ठेवी वगळून) ÷ एकूण ठेवी x 100</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ratio_term_deposit_total" value="{{ $clientInputs['ratio_term_deposit_total'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>सरासारी ठेव वाढीचे प्रमाण</td>
                                <td>गतवर्षातील ठेवी ÷ सरासरी ठेवी x 100</td>
                                <td></td>
                                <td>
                                    {{ $client['खेळते भागभांडवल_sum'] != 0 
                                        ? number_format((($client['गतवर्षातील ठेवी'] / $client['ठेवी_sum_lastYear'])) * 100, 2) 
                                        : '0.00' 
                                    }}
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>स्वनिधीचे खेळत्या भांडवलाशी प्रमाण</td>
                                <td>स्वनिधी ÷ खेळते भांडवल x 100</td>
                                <td></td>
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
                                <td>{{number_format(( $total_networth_current / $client['खेळते भागभांडवल_sum']) * 100, 2)}}</td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>सभासद वाढीचे प्रमाण</td>
                                <td>चालू वर्षातील सभासद संख्या - गत वर्षातील सभासद संख्या ÷ गत वर्षातील सभासद संख्या x 100</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ratio_member_growth" value="{{ $clientInputs['ratio_member_growth'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>थकबाकीचे कर्जाशी प्रमाण</td>
                                <td>थकबाकी ÷ एकूण कर्ज x 100</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ratio_overdue_to_loan" value="{{ $clientInputs['ratio_overdue_to_loan'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>सी डी रेशो</td>
                                <td>एकूण कर्ज - उपलब्ध निधी ÷ ठेवी x 100</td>
                                <td>65 ते 70</td>
                                <td>{{number_format(( ($client['येणे कर्ज_sum'] - $client['निधी_sum_currentYear']) / $client['ठेवी_sum']) * 100, 2)}}</td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>ढोबळ अनुत्पादक जिदंगी प्रमाण</td>
                                <td>एनपीए झालेल्या सर्व कर्जाची येणे बाकी ÷ एकूण ठेवी x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_npa_to_deposit" value="{{ $clientInputs['ratio_npa_to_deposit'] ?? '61' }}"></td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td>निकृष्ट अनुज्ञात जिद्दीची प्रमाण</td>
                                <td>ठेवी अनुज्ञात जिद्दीची प्रमाण - अनुज्ञात जिद्दीची केली तरतूद ÷ अनुज्ञात कर्ज x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_bad_npa" value="{{ $clientInputs['ratio_bad_npa'] ?? '' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mb-2">
                        <span style="font-weight:bold;">1. पत्र ठेवी प्रमाण (सी डी रेशो): <span style="background: yellow;">{{ $clientInputs['ratio_cd'] ?? '' }}</span></span>
                    </div>
                    <table class="table table-bordered text-center align-middle" style="min-width:950px;">
                        <thead>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>विवरण</th>
                                <th>राशी</th>
                            </tr>
                        </thead>
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

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>स्वनिधी ₹</td>
                                <td>{{$total_networth_current}}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>वजा राखीव निधी</td>
                                <td> {{$client['राखीव निधी_sum_currentYear']}}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>मालमता</td>
                                <td>{{$client['कायम मालमत्ता_sum_currentYear']}}</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>इतर भाग</td>
                                <td>{{$client['इतर भाग']}}</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>उपलब्ध निधी</td>
                                <td>{{$client['उपलब्ध निधी']= ($total_networth_current - $client['राखीव निधी_sum_currentYear'] -$client['कायम मालमत्ता_sum_currentYear']- $client['इतर भाग'])}}</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>एकूण कर्ज - उपलब्ध निधी ÷ ठेव ४००</td>
                                <td>
                                    {{ number_format( ( ($client['येणे कर्ज_sum'] - $client['उपलब्ध निधी']) / $client['ठेवी_sum'] ) * 100, 2) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="mb-2">
                        <span style="font-weight:bold;">2. कालनिहाय थकबाकी पुढीलप्रमाणे : </span>
                    </div>
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>कालावधीत थकबाकी</th>
                                <th>थकबाकीदार संख्या</th>
                                <th>रक्कम</th>
                                <th>एकूण येणे कर्जाची प्रमाण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>एक वर्षाच्या आतली</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa0" value="{{ $clientInputs['npa_summary_overdue_npa0'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa0_amount" value="{{ $clientInputs['npa_summary_overdue_npa0_amount'] ?? '' }}"></td>
                                <td>{{ number_format((($clientInputs['npa_summary_overdue_npa0_amount'] ?? 0) / $client['येणे कर्ज_sum']) * 100, 2) }}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>एक ते तीन वर्षांच्या आतली</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa1" value="{{ @$clientInputs['npa_summary_overdue_npa1'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa1_amount" value="{{ @$clientInputs['npa_summary_overdue_npa1_amount'] ?? '' }}"></td>
                                <td>{{ number_format((($clientInputs['npa_summary_overdue_npa1_amount'] ?? 0) / $client['येणे कर्ज_sum']) * 100, 2) }}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>तीन ते पाच वर्षांच्या आतली</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa2" value="{{ $clientInputs['npa_summary_overdue_npa2'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa2_amount" value="{{ $clientInputs['npa_summary_overdue_npa2_amount'] ?? '' }}"></td>
                                <td>{{ number_format((($clientInputs['npa_summary_overdue_npa2_amount'] ?? 0) / $client['येणे कर्ज_sum']) * 100, 2) }}</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>पाच वर्षांच्या वरील</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa3" value="{{ $clientInputs['npa_summary_overdue_npa3'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa3_amount" value="{{ $clientInputs['npa_summary_overdue_npa3_amount'] ?? '' }}"></td>
                                <td>{{ number_format((($clientInputs['npa_summary_overdue_npa3_amount'] ?? 0) / $client['येणे कर्ज_sum']) * 100, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Summary Row -->
                    <table class="table table-bordered text-center">
                        <tbody>
                            <tr>
                                <th>एकूण</th>
                                <td>{{($clientInputs['npa_summary_overdue_npa0'] ?? 0 + @$clientInputs['npa_summary_overdue_npa1'] ?? 0 + $clientInputs['npa_summary_overdue_npa2'] ?? 0 + $clientInputs['npa_summary_overdue_npa3'] ?? 0)}}</td>
                                <td>{{($clientInputs['npa_summary_overdue_npa0_amount'] ?? 0 + @$clientInputs['npa_summary_overdue_npa1_amount'] ?? 0 + $clientInputs['npa_summary_overdue_npa2_amount'] ?? 0 + $clientInputs['npa_summary_overdue_npa3_amount'] ?? 0)}}</td>
                                <td>61.45</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mb-2">
                        <span style="font-weight:bold;">3.थकबाकीदारांवर पुढील प्रमाणे कायदेशीर कारवाई करण्यात आली आहे . </span>
                    </div>
                    <table class="table table-bordered table-striped text-center">
                        <thead>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>तपशील</th>
                                <th>थकबाकीदार संख्या</th>
                                <th>रक्कम</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>थकबाकी वसूलिच्या नोटीस</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa41" value="{{ $clientInputs['npa_summary_overdue_npa41'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa41_amount" value="{{ $clientInputs['npa_summary_overdue_npa41_amount'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>कलम 101 अंतर्गत दाखल केलेले दावे</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa4" value="{{ $clientInputs['npa_summary_overdue_npa4'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa4_amount" value="{{ $clientInputs['npa_summary_overdue_npa4_amount'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>कलम 101 अंतर्गत प्राप्त वसुली दावे</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa51" value="{{ $clientInputs['npa_summary_overdue_npa51'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa51_amount" value="{{ $clientInputs['npa_summary_overdue_npa51_amount'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>कलम 156 अंतर्गत पाठविलेल्या जप्ती नोटीस</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa52" value="{{ $clientInputs['npa_summary_overdue_npa52'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa52_amount" value="{{ $clientInputs['npa_summary_overdue_npa52_amount'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>जप्ती केलेली प्रकरणे</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa53" value="{{ $clientInputs['npa_summary_overdue_npa53'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa53_amount" value="{{ $clientInputs['npa_summary_overdue_npa53_amount'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>लिलावात काढलेली प्रकरणे</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa54" value="{{ $clientInputs['npa_summary_overdue_npa54'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa54_amount" value="{{ $clientInputs['npa_summary_overdue_npa54_amount'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>कलम 100 व नियम 85 अंतर्गत संस्थेच्या नावे हस्तांतरीत केलेली मालमता प्रकरणे</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa55" value="{{ $clientInputs['npa_summary_overdue_npa55'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa55_amount" value="{{ $clientInputs['npa_summary_overdue_npa55_amount'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>निगोशिएबल इन्स्ट्रुमेंट ॲक्ट अंतर्गत कलम 138 अंतर्गत दाखल केलेले दावे</td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa56" value="{{ $clientInputs['npa_summary_overdue_npa56'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="npa_summary_overdue_npa56_amount" value="{{ $clientInputs['npa_summary_overdue_npa56_amount'] ?? '' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                    <span> लेखापरीक्षण कालावधीत नव्याने दावे दाखल केलेले
                        <select name="npa_summary_overdue_npa5"
                            class="form-control d-inline-block" style="width:80px;display:inline;">
                            <option value="">Select</option>
                            <option value="नाही" {{ (isset($clientInputs['npa_summary_overdue_npa5']) && $clientInputs['npa_summary_overdue_npa5'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            <option value="आहे" {{ (isset($clientInputs['npa_summary_overdue_npa5']) && $clientInputs['npa_summary_overdue_npa5'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        </select>
                        . एकूण थकबाकीदारांची संख्या पहाता वसूलीसाठी कायदेशीर कारवाई केल्याचे प्रमाण कमी आहे. सर्व थकबाकीदारांवर संचालक मंडळाने योग्य त्या कायदयांतर्गत वसूली बाबतची कारवाई करुन पाठपुरावा करावा. थकबाकी वसूलीची संपूर्ण जबाबदारी वैयक्तिक व सामुहिकरित्या संचालक मंडळ व व्यवस्थापकावर आहे याची नोंद घ्यावी. कारवाई केलेल्या थकबाकिदारांची यादी अहवालासोबत जोडली
                        <select name="npa_summary_overdue_npa6"
                            class="form-control d-inline-block" style="width:80px;display:inline;">
                            <option value="">Select</option>
                            <option value="नाही" {{ (isset($clientInputs['npa_summary_overdue_npa6']) && $clientInputs['npa_summary_overdue_npa6'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            <option value="आहे" {{ (isset($clientInputs['npa_summary_overdue_npa6']) && $clientInputs['npa_summary_overdue_npa6'] == 'आहे') ? 'selected' : '' }}>आहे</option>

                        </select>
                    </span>
                </div>
                <!-- END: आर्थिक प्रमाणके Design -->

                <!-- START: NPA सारांश व प्रमाणे Design as per pasted image -->
                <div class="mb-4">

                    <div class="mb-2">
                        <span class="fw-bold">4. एन.पी.ए. प्रमाण ए ची तरतूद केले. सी.एल.एन -
                            <span style="font-weight:bold;">
                                <select class="form-control d-inline-block" style="width:80px;display:inline;" name="npa_provision_cln">
                                    <option value="">Select</option>
                                    <option value="नाही" {{ (isset($clientInputs['npa_provision_cln']) && $clientInputs['npa_provision_cln'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    <option value="आहे" {{ (isset($clientInputs['npa_provision_cln']) && $clientInputs['npa_provision_cln'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                </select>
                            </span>
                        </span>
                    </div>
                    <div class="container my-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th rowspan="2">अ.क्र.</th>
                                    <th rowspan="2">तपशील</th>
                                    <th rowspan="2">कर्जदार संख्या</th>
                                    <th rowspan="2">येणे कर्ज रक्कम</th>
                                    <th rowspan="2">तरतूद करावयाचे %</th>
                                    <th colspan="2">तरतूद</th>
                                    <th rowspan="2">कमी/जादा तरतूद</th>
                                </tr>
                                <tr>
                                    <th>करावयाची रक्कम</th>
                                    <th>संस्थेने केलेली तरतूद</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>स्टँडर्ड कर्ज (9 महिने पर्यंत)</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa7" value="{{ $clientInputs['npa_summary_overdue_npa7'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa7_amount" value="{{ $clientInputs['npa_summary_overdue_npa7_amount'] ?? '' }}"></td>
                                    <td>0.25</td>
                                    <td>{{$total7=number_format(@$clientInputs['npa_summary_overdue_npa7_amount']*0.25/100,2)}}</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa71_amount" value="{{ $clientInputs['npa_summary_overdue_npa71_amount'] ?? '' }}"></td>
                                    <td>{{$total7 - @$clientInputs['npa_summary_overdue_npa71_amount']}}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>अनियमित कर्ज (थकीत महिने 10 ते 24)</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa8" value="{{ $clientInputs['npa_summary_overdue_npa8'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa8_amount" value="{{ $clientInputs['npa_summary_overdue_npa8_amount'] ?? '' }}"></td>
                                    <td>0.50</td>
                                    <td>{{
        $total8 = number_format((@$clientInputs['npa_summary_overdue_npa8_amount'] ?? 0) * 0.50 / 100, 2) 
    }}</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa81_amount" value="{{ $clientInputs['npa_summary_overdue_npa81_amount'] ?? '' }}"></td>
                                    <td>{{ $total8 - (@$clientInputs['npa_summary_overdue_npa81_amount'] ?? 0) }}</td>

                                </tr>
                                <tr>
                                    <td rowspan="2">3</td>
                                    <td>संशयीत 1 (25 ते 48 महिन्ये पर्यंत)<br><small>तारण नसलेले</small></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    @php
                                        $amount9 = floatval($clientInputs['npa_summary_overdue_npa9_amount'] ?? 0);
                                        $calcTotal9 = $amount9 * 10 / 100;

                                        $recovered9 = floatval($clientInputs['npa_summary_overdue_npa91_amount'] ?? 0);
                                        $final9 = $calcTotal9 - $recovered9;
                                    @endphp

                                    <td>तारणी</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa9" value="{{ $clientInputs['npa_summary_overdue_npa9'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa9_amount" value="{{ $clientInputs['npa_summary_overdue_npa9_amount'] ?? '' }}"></td>
                                    <td>10</td>
                                    <td>{{ number_format($calcTotal9, 2) }}</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa91_amount" value="{{ $clientInputs['npa_summary_overdue_npa91_amount'] ?? '' }}"></td>
                                    <td>{{ number_format($final9, 2) }}</td>

                                </tr>
                                   <tr>
                                    @php
                                        $amount14 = floatval($clientInputs['npa_summary_overdue_npa14_amount'] ?? 0);
                                        $calcTotal14 = $amount14 * 50 / 100;

                                        $recovered14 = floatval($clientInputs['npa_summary_overdue_npa141_amount'] ?? 0);
                                        $final14 = $calcTotal14 - $recovered14;
                                    @endphp
                                    <td></td>
                                    <td>विनातारणी</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa14" value="{{ $clientInputs['npa_summary_overdue_npa14'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa14_amount" value="{{ $clientInputs['npa_summary_overdue_npa14_amount'] ?? '' }}"></td>
                                    <td>50</td>
                                    <td>{{ number_format($calcTotal14, 2) }}</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa141_amount" value="{{ $clientInputs['npa_summary_overdue_npa141_amount'] ?? '' }}"></td>
                                    <td>{{ number_format($final14, 2) }}</td>

                                </tr>
                                 <tr>
                                    <td rowspan="2">3</td>
                                    <td>संशयीत 2 (49 ते 60 महिन्ये पर्यंत)<br><small>तारण नसलेले</small></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    @php
                                        $amount10 = floatval($clientInputs['npa_summary_overdue_npa10_amount'] ?? 0);
                                        $calcTotal10 = $amount10 * 15 / 100;

                                        $recovered10 = floatval($clientInputs['npa_summary_overdue_npa101_amount'] ?? 0);
                                        $final10 = $calcTotal10 - $recovered10;
                                    @endphp
                                    <td>तारणी</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa10" value="{{ $clientInputs['npa_summary_overdue_npa10'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa10_amount" value="{{ $clientInputs['npa_summary_overdue_npa10_amount'] ?? '' }}"></td>
                                    <td>15</td>
                                    <td>{{ number_format($calcTotal10, 2) }}</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa101_amount" value="{{ $clientInputs['npa_summary_overdue_npa101_amount'] ?? '' }}"></td>
                                    <td>{{ number_format($final10, 2) }}</td>
                                </tr>
                                <tr>
                                         @php
                                        $amount11 = floatval($clientInputs['npa_summary_overdue_npa11_amount'] ?? 0);
                                        $calcTotal11 = $amount11 * 50 / 100;

                                        $recovered11 = floatval($clientInputs['npa_summary_overdue_npa111_amount'] ?? 0);
                                        $final11 = $calcTotal11 - $recovered11;
                                    @endphp
                                    <td></td>
                                    <td>विनातारणी</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa11" value="{{ $clientInputs['npa_summary_overdue_npa11'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa11_amount" value="{{ $clientInputs['npa_summary_overdue_npa11_amount'] ?? '' }}"></td>
                                    <td>50</td>
                                    <td>{{ number_format($calcTotal11, 2) }}</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa111_amount" value="{{ $clientInputs['npa_summary_overdue_npa111_amount'] ?? '' }}"></td>
                                    <td>{{ number_format($final11, 2) }}</td>
                                </tr>
                                <tr>
                                     @php
                                        $amount12 = floatval($clientInputs['npa_summary_overdue_npa12_amount'] ?? 0);
                                        $calcTotal12 = $amount12 * 100 / 100;

                                        $recovered12 = floatval($clientInputs['npa_summary_overdue_npa121_amount'] ?? 0);
                                        $final12 = $calcTotal12 - $recovered12;
                                    @endphp
                                    <td rowspan="2">5</td>
                                    <td>संशयीत 3 (60 महिनेपासुन पुढे)<br></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa12" value="{{ $clientInputs['npa_summary_overdue_npa12'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa12_amount" value="{{ $clientInputs['npa_summary_overdue_npa12_amount'] ?? '' }}"></td>
                                    <td>100</td>
                                    <td>{{ number_format($calcTotal12, 2) }}</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa121_amount" value="{{ $clientInputs['npa_summary_overdue_npa121_amount'] ?? '' }}"></td>
                                    <td>{{ number_format($final12, 2) }}</td>
                                </tr>
                                <tr>
                                    @php
                                        $amount13 = floatval($clientInputs['npa_summary_overdue_npa13_amount'] ?? 0);
                                        $calcTotal13 = $amount13 * 100 / 100;

                                        $recovered13 = floatval($clientInputs['npa_summary_overdue_npa131_amount'] ?? 0);
                                        $final13 = $calcTotal13 - $recovered13;
                                    @endphp
                                    <td>तारण असलेले</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa13" value="{{ $clientInputs['npa_summary_overdue_npa13'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa13_amount" value="{{ $clientInputs['npa_summary_overdue_npa13_amount'] ?? '' }}"></td>
                                    <td>100</td>
                                    <td>{{ number_format($calcTotal13, 2) }}</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa131_amount" value="{{ $clientInputs['npa_summary_overdue_npa131_amount'] ?? '' }}"></td>
                                    <td>{{ number_format($final13, 2) }}</td>
                                </tr>
                                 <tr>
                                    @php
                                        $amount15 = floatval($clientInputs['npa_summary_overdue_npa15_amount'] ?? 0);
                                        $calcTotal15 = $amount15 * 100 / 100;

                                        $recovered15 = floatval($clientInputs['npa_summary_overdue_npa151_amount'] ?? 0);
                                        $final15 = $calcTotal15 - $recovered15;
                                    @endphp
                                    <td>6</td>
                                    <td>बुडीत कर्ज</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa15" value="{{ $clientInputs['npa_summary_overdue_npa15'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa15_amount" value="{{ $clientInputs['npa_summary_overdue_npa15_amount'] ?? '' }}"></td>
                                    <td>100</td>
                                    <td>{{ number_format($calcTotal15, 2) }}</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa151_amount" value="{{ $clientInputs['npa_summary_overdue_npa151_amount'] ?? '' }}"></td>
                                    <td>{{ number_format($final15, 2) }}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>एकूण अनुत्पादीत कर्जे</b></td>
                                    <td>{{@$clientInputs['npa_summary_overdue_npa7'] +@$clientInputs['npa_summary_overdue_npa8'] + @$clientInputs['npa_summary_overdue_npa9'] + @$clientInputs['npa_summary_overdue_npa14'] + @$clientInputs['npa_summary_overdue_npa11'] + @$clientInputs['npa_summary_overdue_npa12'] + @$clientInputs['npa_summary_overdue_npa13'] + @$clientInputs['npa_summary_overdue_npa15'] }}</td>
                                    <td>{{@$clientInputs['npa_summary_overdue_npa7_amount'] + @$clientInputs['npa_summary_overdue_npa8_amount'] + @$clientInputs['npa_summary_overdue_npa9_amount'] + @$clientInputs['npa_summary_overdue_npa14_amount'] + @$clientInputs['npa_summary_overdue_npa10_amount'] + @$clientInputs['npa_summary_overdue_npa11_amount'] + @$clientInputs['npa_summary_overdue_npa12_amount'] + @$clientInputs['npa_summary_overdue_npa13_amount'] + @$clientInputs['npa_summary_overdue_npa15_amount']}}</td>
                                    <td></td>
                                    <td>{{ number_format($total7 + $total8 + $calcTotal9 + $calcTotal14 + $calcTotal10 + $calcTotal11 + $calcTotal12 + $calcTotal13 + $calcTotal15, 2) }}</td>
                                    <td>{{ number_format(@$clientInputs['npa_summary_overdue_npa71_amount'] + @$clientInputs['npa_summary_overdue_npa81_amount'] + @$clientInputs['npa_summary_overdue_npa91_amount'] + @$clientInputs['npa_summary_overdue_npa141_amount'] + @$clientInputs['npa_summary_overdue_npa101_amount'] + @$clientInputs['npa_summary_overdue_npa111_amount'] + @$clientInputs['npa_summary_overdue_npa121_amount'] + @$clientInputs['npa_summary_overdue_npa131_amount'] + @$clientInputs['npa_summary_overdue_npa151_amount'], 2) }}</td>
                                    <td>{{ number_format(($total7 + $total8 + $calcTotal9 + $calcTotal14 + $calcTotal10 + $calcTotal11 + $calcTotal12 + $calcTotal13 + $calcTotal15) - (@$clientInputs['npa_summary_overdue_npa71_amount'] + @$clientInputs['npa_summary_overdue_npa81_amount'] + @$clientInputs['npa_summary_overdue_npa91_amount'] + @$clientInputs['npa_summary_overdue_npa141_amount'] + @$clientInputs['npa_summary_overdue_npa101_amount'] + @$clientInputs['npa_summary_overdue_npa111_amount'] + @$clientInputs['npa_summary_overdue_npa121_amount'] + @$clientInputs['npa_summary_overdue_npa131_amount'] + @$clientInputs['npa_summary_overdue_npa151_amount']), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <span class="fw-bold">एन.पी.ए. सारांश व प्रमाणे :</span>
                    <div class="mb-2">
                        अहवाल वर्षअखेर एकूण <span><b>{{$client['येणे कर्ज_sum']}}</b></span> कर्जे त्यातील एनपीएमध्ये असलेली कर्जे येणे बाकी <span><b>{{@$clientInputs['npa_summary_overdue_npa7_amount'] + @$clientInputs['npa_summary_overdue_npa8_amount'] + @$clientInputs['npa_summary_overdue_npa9_amount'] + @$clientInputs['npa_summary_overdue_npa14_amount'] + @$clientInputs['npa_summary_overdue_npa10_amount'] + @$clientInputs['npa_summary_overdue_npa11_amount'] + @$clientInputs['npa_summary_overdue_npa12_amount'] + @$clientInputs['npa_summary_overdue_npa13_amount'] + @$clientInputs['npa_summary_overdue_npa15_amount']}}</b></span> आहे. व त्यावरील संस्थेने रु. 
                        <span><b>{{ number_format($total7 + $total8 + $calcTotal9 + $calcTotal14 + $calcTotal10 + $calcTotal11 + $calcTotal12 + $calcTotal13 + $calcTotal15, 2) }}</b></span> तरतूद करणे आवश्यक असताना प्रत्यक्षात रु. 
                        <span><b>{{ number_format(@$clientInputs['npa_summary_overdue_npa71_amount'] + @$clientInputs['npa_summary_overdue_npa81_amount'] + @$clientInputs['npa_summary_overdue_npa91_amount'] + @$clientInputs['npa_summary_overdue_npa141_amount'] + @$clientInputs['npa_summary_overdue_npa101_amount'] + @$clientInputs['npa_summary_overdue_npa111_amount'] + @$clientInputs['npa_summary_overdue_npa121_amount'] + @$clientInputs['npa_summary_overdue_npa131_amount'] + @$clientInputs['npa_summary_overdue_npa151_amount'], 2) }}</b></span> तरतूद केली आहे. म्हणजेच रु. 
                        <span><b>{{ number_format(($total7 + $total8 + $calcTotal9 + $calcTotal14 + $calcTotal10 + $calcTotal11 + $calcTotal12 + $calcTotal13 + $calcTotal15) - (@$clientInputs['npa_summary_overdue_npa71_amount'] + @$clientInputs['npa_summary_overdue_npa81_amount'] + @$clientInputs['npa_summary_overdue_npa91_amount'] + @$clientInputs['npa_summary_overdue_npa141_amount'] + @$clientInputs['npa_summary_overdue_npa101_amount'] + @$clientInputs['npa_summary_overdue_npa111_amount'] + @$clientInputs['npa_summary_overdue_npa121_amount'] + @$clientInputs['npa_summary_overdue_npa131_amount'] + @$clientInputs['npa_summary_overdue_npa151_amount']), 2) }}</b></span> कमी तरतूद केली आहे.
                    </div>
                    <div class="mb-2">
                        (टिप - लेखापरीक्षकाने संस्थेने दिलेले अनुत्पादक कर्जाचे जंबोली तपासून प्रमाणित करून स्वतंत्र रित्या लेखापरीक्षण अहवालासोबत जोडण्यात यावी)
                    </div>
                    <div class="mb-2">
                        <table class="table table-bordered text-center align-middle" style="min-width:900px;">
                            <thead>
                                <tr>
                                    <th>अ.क्र.</th>
                                    <th>तपशील</th>
                                    <th>थकबाकीदार संख्या</th>
                                    <th>रक्कम</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>एकूण कर्ज</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa_sum" value="{{ $clientInputs['npa_summary_overdue_npa_sum'] ?? '' }}"></td>
                                    <td>{{$client['येणे कर्ज_sum']}}</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>ढोबळ एनपीए</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa5_sum_currentYear" value="{{ $clientInputs['npa_summary_overdue_npa5_sum_currentYear'] ?? '' }}"></td>
                                    <td>{{$total2=  @$clientInputs['npa_summary_overdue_npa7_amount'] + @$clientInputs['npa_summary_overdue_npa8_amount'] + @$clientInputs['npa_summary_overdue_npa9_amount'] + @$clientInputs['npa_summary_overdue_npa14_amount'] + @$clientInputs['npa_summary_overdue_npa10_amount'] + @$clientInputs['npa_summary_overdue_npa11_amount'] + @$clientInputs['npa_summary_overdue_npa12_amount'] + @$clientInputs['npa_summary_overdue_npa13_amount'] + @$clientInputs['npa_summary_overdue_npa15_amount']}}</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>येणे व्याज</td>
                                    <td><input type="text" class="form-control" name="npa_summary_net_npa_sum_currentYear" value="{{ $clientInputs['npa_summary_net_npa_sum_currentYear'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_net_npa" value="{{ $clientInputs['npa_summary_net_npa'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>तरतूद</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa6_sum_currentYear" value="{{ $clientInputs['npa_summary_overdue_npa6_sum_currentYear'] ?? '' }}"></td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa_value" value="{{ $clientInputs['npa_summary_overdue_npa_value'] ?? '' }}"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>निव्वळ कर्ज (1-3-4)</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa1_sum_currentYear" value="{{ $clientInputs['npa_summary_overdue_npa1_sum_currentYear'] ?? '' }}"></td>
                                    <td>{{$client['येणे कर्ज_sum'] - @$clientInputs['npa_summary_net_npa'] - @$clientInputs['npa_summary_overdue_npa_value']}}</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>निव्वळ एनपीए (2-3-4)</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa2_sum_currentYear" value="{{ $clientInputs['npa_summary_overdue_npa2_sum_currentYear'] ?? '' }}"></td>
<td>{{$total6=$total2 - $clientInputs['npa_summary_net_npa'] - @$clientInputs['npa_summary_overdue_npa_value']}}</td>                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>थकबाकी एनपीए टक्केवारी (2/1x100)</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa3_sum_currentYear" value="{{ $clientInputs['npa_summary_overdue_npa3_sum_currentYear'] ?? '' }}"></td>
                                    <td>{{number_format(($total2 /$client['येणे कर्ज_sum'])*100, 2)}}</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>निव्वळ एनपीए टक्केवारी (6/5x100)</td>
                                    <td><input type="text" class="form-control" name="npa_summary_overdue_npa4_sum_currentYear" value="{{ $clientInputs['npa_summary_overdue_npa4_sum_currentYear'] ?? '' }}"></td>
                                    <td>{{number_format(($total6 /$client['येणे कर्ज_sum'])*100, 2)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        <span>
                            दि. 31/03/{{$start}} (गतवर्षी)अखेर थकबाकी एनपीए प्रमाण <span>{{ $clientInputs['npa_last_year_overdue_percent'] ?? '' }}</span><span><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="npa_last_year_overdue_percent_input" value="{{ $clientInputs['npa_last_year_overdue_percent_input'] ?? '' }}"></span> % व निव्वळ एनपीए प्रमाण <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="npa_last_year_net_percent_input" value="{{ $clientInputs['npa_last_year_net_percent_input'] ?? '' }}"></span> % होते. तर दि. 31/03/{{$end}} (चालूवर्षी)अखेर थकबाकी एनपीए प्रमाण <span>
                                <b>{{number_format(($total2 /$client['येणे कर्ज_sum'])*100, 2)}}</b></span> % व निव्वळ एनपीए प्रमाण 
                            <span><b>{{number_format(($total6 /$client['येणे कर्ज_sum'])*100, 2)}}</b></span> % आहे. सदरचे प्रमाण आहे.
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <span class="fw-bold">ऑडिट वर्गवारी :</span>
                    <div class="mb-2">
                        संस्थेची आर्थीक स्थिती, केलेले व्यवहार, केलेली गुंतवणुक, ठेवलेले रेकॉर्ड व
                        कायदा व नियम व पोटनियमाचे उल्लंघन आणि मॅन्युअल गुण आदि बाबींचा विचार करून संस्थेला
                        सन 2023-2024 या वर्षाकरिता ऑडिट वर्ग "{{ $clientInputs['audit_class'] ?? 'अ' }}" कायम करण्यात येत आहे.
                        आभार :-
                        अंकेक्षणाच्या वेळी संस्थेचे पदाधिकारी व कर्मचारी यांनी दिलेल्या सहकार्याबद्धल त्यांचे
                        आभार मानुन संस्था प्रगती करिता सुयश चिंतितो व हा अहवाल विभाग अ,ब,क सह पुर्ण करतो.
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
            <!-- END: NPA सारांश व प्रमाणे Design -->
        </div>
    </div>
</div>
@endsection