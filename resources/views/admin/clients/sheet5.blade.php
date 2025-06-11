@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet Five</h4>
                <div>
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
            <form action="{{ route('admin.client.saveInputs', $client->id) }}" method="POST">
                @csrf

                <!-- Financial Statement Analysis Section -->
                <div>
                    <h5 class="fw-bold mb-3">व आर्थिक पत्रके विवेचन :</h5>
                    <div class="mb-2 fw-bold">1. ताळेबंद विवेचन:</div>
                    <div class="ps-3 mb-2">
                        संस्थेचे मुख्यालय व शाखा (असल्यास) यांचे एकत्रित ताळेबंदाचे विवेचन खालीलप्रमाणे -
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">अ. भांडवल व ठेवी बाजू :</span>
                        <b> <span style="font-weight:bold;">रु. {{$client['totalIncome6'] ?? ''}}</span></b>
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">1. भागभांडवल :</span>
                        <b> <span style="font-weight:bold;">- रु. {{$client['totalIncome7'] ?? ''}}</span></b>
                    </div>
                    <div class="mb-2">
                        संस्थेचे अधिकृत भागभांडवल रु.
                        <span><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="authorized_share_capital" value="{{ $clientInputs['authorized_share_capital'] ?? '' }}"></span>
                        आहे. एका भागाची दर्शनी किंमत रु.
                        <span style="background: #00ff00;"><input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="share_face_value" value="{{ $clientInputs['share_face_value'] ?? '' }}"></span>
                        आहे. दि.
                        <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="last_year_date" value="{{ $clientInputs['last_year_date'] ?? '' }}"></span>
                        (गतवर्षी) अखेर संस्थेकडून वस्तुम भागभांडवल रु.
                        <b> <span>{{$client['वसुल भाग भागभांडवल_sum_lastYear'] ?? ''}}</span></b>
                        होते. लेखापरीक्षण कालावधीत त्यामध्ये रु.
                        <b> <span>{{$client['वसुल भाग भागभांडवल_sum_currentYear'] - $client['वसुल भाग भागभांडवल_sum_lastYear']}}</span></b>
                        ने वाढ झालेली असून दि.
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
                        <b> <span>31/03/2025</span></b>
                        (चालूवर्षी) अखेर संस्थेकडून वस्तुम भागभांडवल रु.
                        <b> <span>{{$client['totalIncome7'] ?? ''}}</span></b>
                        झालेले आहे. सदरचे वस्तुम भागभांडवल अधिकृत भागभांडवलाच्या
                        <select class="form-control d-inline-block" style="width:80px;display:inline;" name="share_capital_less_than_authorized">
                            <option value="कमी" {{ (isset($clientInputs['share_capital_less_than_authorized']) && $clientInputs['share_capital_less_than_authorized'] == 'कमी') ? 'selected' : '' }}>कमी</option>
                            <option value="जास्त" {{ (isset($clientInputs['share_capital_less_than_authorized']) && $clientInputs['share_capital_less_than_authorized'] == 'जास्त') ? 'selected' : '' }}>जास्त</option>
                        </select>
                        आहे
                    </div>

                    <!-- START: Design as per pasted image -->
                    <div class="mb-2">
                        <span>लेखापरिक्षण कालावधीत रु. <span><input type="text" class="form-control d-inline-block" style="width:80px;display:inline;" name="share_capital_returned" value="{{ $clientInputs['share_capital_returned'] ?? '' }}"></span> भागभांडवल परत केले असून त्याचे प्रमाण <span>$clientInputs['share_capital_returned']/$clientInputs['totalIncome7']*100</span> % आहे. अहवाल वर्षात
                            भागभांडवल रु. <span><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="share_capital_increase_amount" value="{{ $clientInputs['share_capital_increase_amount'] ?? '' }}"></span> ने वाढलेले असुन, भागभांडवल वाढीचे प्रमाण <span><input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="share_capital_increase_percent" value="{{ $clientInputs['share_capital_increase_percent'] ?? '9.86' }}"></span> % आहे. भागभांडवल यादीची रक्कम
                            ताळेबंदातील रक्कमेशी जुळत
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="share_capital_matches">
                                <option value="आहे" {{ (isset($clientInputs['share_capital_matches']) && $clientInputs['share_capital_matches'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['share_capital_matches']) && $clientInputs['share_capital_matches'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            .
                        </span>
                    </div>

                    <div class="mb-2">
                        <span class="fw-bold">2. राखीव व इतर निधी :</span>
                        <span style="font-weight:bold;">- रु. {{$client['totalIncome8'] ?? ''}}</span>
                    </div>

                    <div class="mb-2">
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
                        दि. <span>31/03/{{$end}}</span> अखेर संस्थेचे खालीलप्रमाणे निधी उभा आहे. चालू व मागील आर्थिक वर्षातील तुलनात्मक आकडेवारी खालीलप्रमाणे -
                    </div>

                    <div>
                        <table class="table table-bordered text-center align-middle" style="min-width:700px;">
                            <thead>
                                <tr>
                                    <th>अ.क्र.</th>
                                    <th>निधी</th>
                                    <th>गतवर्षी अखेर रु.</th>
                                    <th>चालूवर्षी अखेर रु.</th>
                                    <th>वाढ/घट</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>राखीव निधी</td>
                                    <td>{{$client['राखीव निधी_sum_lastYear'] ?? 0}}</td>
                                    <td>{{$client['राखीव निधी_sum_currentYear'] ?? 0}}</td>
                                    @php
                                    $diff = ($client['राखीव निधी_sum_currentYear'] ?? 0) - ($client['राखीव निधी_sum_lastYear'] ?? 0);
                                    @endphp
                                    <td>
                                        @if($diff > 0)
                                        <span>{{ $diff }}-Up</span>
                                        @elseif($diff < 0)
                                            <span>{{ $diff }}-Down</span>
                                            @else
                                            0-Equal
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>बुडीत कर्ज निधी</td>
                                    <td>{{$client['बुडीत कर्ज निधी_sum_lastYear'] ?? 0}}</td>
                                    <td>{{$client['बुडीत कर्ज निधी_sum_currentYear'] ?? 0}}</td>
                                    @php
                                    $diff = ($client['बुडीत कर्ज निधी_sum_currentYear'] ?? 0) - ($client['बुडीत कर्ज निधी_sum_lastYear'] ?? 0);
                                    @endphp
                                    <td>
                                        @if($diff > 0)
                                        <span>{{ $diff }}-Up</span>
                                        @elseif($diff < 0)
                                            <span>{{ $diff }}-Down</span>
                                            @else
                                            0-Equal
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>कर्मचारी ग्रॅच्युइटी निधी</td>
                                    <td>?</td>
                                    <td>?</td>
                                    <td>0-Equal</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>कर्मचारी कल्याण निधी</td>
                                    <td>{{$client['कल्याण निधी_sum_lastYear'] ?? 0}}</td>
                                    <td>{{$client['कल्याण निधी_sum_currentYear'] ?? 0}}</td>
                                    @php
                                    $diff = ($client['कल्याण निधी_sum_currentYear'] ?? 0) - ($client['कल्याण निधी_sum_lastYear'] ?? 0);
                                    @endphp
                                    <td>
                                        @if($diff > 0)
                                        <span>{{ $diff }}-Up</span>
                                        @elseif($diff < 0)
                                            <span>{{ $diff }}-Down</span>
                                            @else
                                            0-Equal
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>कर्मचारी भविष्य निर्वाह निधी</td>
                                    <td>{{$client['कर्मचारी भविष्य निर्वाह निधी_sum_lastYear'] ?? 0}}</td>
                                    <td>{{$client['कर्मचारी भविष्य निर्वाह निधी_sum_currentYear'] ?? 0}}</td>
                                    @php
                                    $diff = ($client['कर्मचारी भविष्य निर्वाह निधी_sum_currentYear'] ?? 0) - ($client['कर्मचारी भविष्य निर्वाह निधी_sum_lastYear'] ?? 0);
                                    @endphp
                                    <td>
                                        @if($diff > 0)
                                        <span>{{ $diff }}-Up</span>
                                        @elseif($diff < 0)
                                            <span>{{ $diff }}-Down</span>
                                            @else
                                            0-Equal
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>नि.नि.अभिकृती सुरक्षा ठेव</td>
                                    <td>{{$client['सुरक्षा ठेव निधी_sum_lastYear'] ?? 0}}</td>
                                    <td>{{$client['सुरक्षा ठेव निधी_sum_currentYear'] ?? 0}}</td>
                                    @php
                                    $diff = ($client['सुरक्षा ठेव निधी_sum_currentYear'] ?? 0) - ($client['सुरक्षा ठेव निधी_sum_lastYear'] ?? 0);
                                    @endphp
                                    <td>
                                        @if($diff > 0)
                                        <span>{{ $diff }}-Up</span>
                                        @elseif($diff < 0)
                                            <span>{{ $diff }}-Down</span>
                                            @else
                                            0-Equal
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>इमारत निधी</td>
                                    <td>{{$client['इमारत निधी_sum_lastYear'] ?? 0}}</td>
                                    <td>{{$client['इमारत निधी_sum_currentYear'] ?? 0}}</td>
                                    @php
                                    $diff = ($client['इमारत निधी_sum_currentYear'] ?? 0) - ($client['इमारत निधी_sum_lastYear'] ?? 0);
                                    @endphp
                                    <td>
                                        @if($diff > 0)
                                        <span>{{ $diff }}-Up</span>
                                        @elseif($diff < 0)
                                            <span>{{ $diff }}-Down</span>
                                            @else
                                            0-Equal
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>संचयी निधी कर्ज</td>
                                    <td>?</td>
                                    <td>?</td>
                                    <td>0-Equal</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>संगणक निधी</td>
                                    <td>?</td>
                                    <td>?</td>
                                    <td>-13754-Down</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>आकस्मिक फंड</td>
                                    <td>{{$client['आकस्मिक फंड_sum_lastYear'] ?? 0}}</td>
                                    <td>{{$client['आकस्मिक फंड_sum_currentYear'] ?? 0}}</td>
                                    @php
                                    $diff = ($client['आकस्मिक फंड_sum_currentYear'] ?? 0) - ($client['आकस्मिक फंड_sum_lastYear'] ?? 0);
                                    @endphp
                                    <td>
                                        @if($diff > 0)
                                        <span>{{ $diff }}-Up</span>
                                        @elseif($diff < 0)
                                            <span>{{ $diff }}-Down</span>
                                            @else
                                            0-Equal
                                            @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>आर्थिक उन्नत सुरक्षा जमा</td>
                                    <td>?</td>
                                    <td>?</td>
                                    <td>16398-Up</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="fw-bold">एकूण</td>
                                    <td>{{ $funds_last = $client['राखीव निधी_sum_lastYear'] + $client['बुडीत कर्ज निधी_sum_lastYear'] + $client['कल्याण निधी_sum_lastYear'] +$client['कर्मचारी भविष्य निर्वाह निधी_sum_lastYear'] + $client['सुरक्षा ठेव निधी_sum_lastYear'] + $client['इमारत निधी_sum_lastYear'] + $client['आकस्मिक फंड_sum_lastYear']}}</td>
                                    <td>{{ $funds_current = $client['राखीव निधी_sum_currentYear'] + $client['बुडीत कर्ज निधी_sum_currentYear'] +  $client['कल्याण निधी_sum_currentYear'] + $client['कर्मचारी भविष्य निर्वाह निधी_sum_currentYear'] + $client['सुरक्षा ठेव निधी_sum_currentYear'] + $client['इमारत निधी_sum_currentYear'] + $client['आकस्मिक फंड_sum_currentYear']}}</td>
                                    <td>{{ $funds_current - $funds_last }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-2">
                        <span>सदर निधींच्या वाढ/घटीबाबत कारणमिमांसा नमुद करावी. तसेच लेखापरिक्षण कालवधीत काही निर्धीचा
                            विनियोग झालेला असल्यास तो योग्य पध्द्तीने झालेला
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="funds_utilization_proper">
                                <option value="आहे" {{ (isset($clientInputs['funds_utilization_proper']) && $clientInputs['funds_utilization_proper'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['funds_utilization_proper']) && $clientInputs['funds_utilization_proper'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </span>
                    </div>
                    <!-- END: Design as per pasted image -->

                    <!-- 3. ठेवी -->
                    <div class="mb-2">
                        <span class="fw-bold">3. ठेवी :</span>
                        <span style="font-weight:bold;">- रु. {{$client['ठेवी_sum_currentYear'] ?? 0}}</span>
                    </div>
                    <div class="mb-2">
                        <span>वरील सर्व निधींची कलम 70 व नियम 54,55 प्रमाणे संस्थेने स्वतंत्रपणे गुंतवणूक केली आहे. निधी विनियोगांची
                            नियमावली तयार करण्यात आली
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="fund_investment_policy_prepared">
                                <option value="आहे" {{ (isset($clientInputs['fund_investment_policy_prepared']) && $clientInputs['fund_investment_policy_prepared'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['fund_investment_policy_prepared']) && $clientInputs['fund_investment_policy_prepared'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>

                        </span>
                    </div>
                    <div class="mb-2">
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
                        <span>दि. <span>31/03/2025</span> अखेर संस्थेने खालीलप्रमाणे ठेवी स्विकारलेल्या आहेत. चालु व मागील आर्थिक वर्षातील तुलनात्मक
                            आकडेवारी खालीलप्रमाणे -</span>
                    </div>
                    <div>
                        <table class="table table-bordered text-center align-middle" style="min-width:700px;">
                            <thead>
                                <tr>
                                    <th>अ.क्र.</th>
                                    <th>ठेवी प्रकार</th>
                                    <th>गतवर्षी अखेर रु.</th>
                                    <th>चालूवर्षी अखेर रु.</th>
                                    <th>वाढ/घट</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @php
                                $totalCurrentYear = 0;
                                $totalLastYear = 0;

                                $totalDiff = 0;
                                @endphp
                                @foreach($client['ठेवी'] as $c)
                                @php
                                $totalCurrentYear += $c->currentYear;
                                $totalLastYear += $c->lastYear;
                                $totalDiff += ($c->currentYear - $c->lastYear);
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->entity }}</td>
                                    <td>{{ number_format($c->currentYear, 2) }}</td>
                                    <td>{{ number_format($c->lastYear, 2) }}</td>
                                    <td>{{ number_format(($c->currentYear - $c->lastYear), 2) }}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td class="fw-bold">एकूण</td>
                                    <td></td>
                                    <td>{{ number_format($totalCurrentYear, 2) }}</td>
                                    <td>{{ number_format($totalLastYear, 2) }}</td>
                                    <td>{{ number_format($totalDiff, 2) }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        <span>
                            @php
                            $funds_last_total =$client['बचत ठेव_sum_lastYear']+ $client['कुटुंबनिर्वाह मासिक व्याज योजना_sum_lastYear'] + $client['मुदत ठेव_sum_lastYear'] + $client['दामतिप्पट ठेव_sum_lastYear'] + $client['दामदुप्पट ठेव_sum_lastYear'] + $client['दामचौपट ठेव_sum_lastYear'] + $client['आवर्त ठेव_sum_lastYear'];
                            $funds_current_total =$client['बचत ठेव_sum_currentYear'] + $client['कुटुंबनिर्वाह मासिक व्याज योजना_sum_currentYear'] + $client['मुदत ठेव_sum_currentYear'] +$client['दामतिप्पट ठेव_sum_currentYear'] + $client['दामदुप्पट ठेव_sum_currentYear'] + $client['दामचौपट ठेव_sum_currentYear'] + $client['आवर्त ठेव_sum_currentYear'];
                            $funds_current_total - $funds_last_total;
                            @endphp
                            लेखापरीक्षण मुदतीत एकूण ठेवीमध्ये रु.
                            <span style="font-weight:bold;">
                                {{ $funds_current_total - $funds_last_total }}
                            </span>
                            लाख इतकी
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="deposit_list_computerized_1">
                                <option value="वाढ" {{ (isset($clientInputs['deposit_list_computerized_1']) && $clientInputs['deposit_list_computerized_1'] == 'वाढ') ? 'selected' : '' }}>वाढ</option>
                                <option value="घट" {{ (isset($clientInputs['deposit_list_computerized_1']) && $clientInputs['deposit_list_computerized_1'] == 'नाही') ? 'selected' : '' }}>घट</option>
                            </select>
                            झालेली आहे. वाढीचे प्रमाण
                            <span style=" font-weight:bold;">
                                {{ $funds_last_total != 0 ? number_format((($funds_current_total - $funds_last_total) / $funds_last_total) * 100, 2) : 'N/A' }}

                            </span>
                            % आहे. लेखापरीक्षण मुदतीत ठेव व्याज दर
                            <span style="font-weight:bold;">
                                <input type="text" class="form-control d-inline-block" style="width:80px;display:inline;" name="deposit_interest_rate" value="{{ $clientInputs['deposit_interest_rate'] ?? '' }}">
                            </span>
                            % पर्यंत आकारलेला आहे. संस्थेचे कामकाज संगणकीकृत
                            असल्याने ठेव यादयासंगणक प्रणालीव्दारे काढलेल्या
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="deposit_list_computerized">
                                <option value="आहे" {{ (isset($clientInputs['deposit_list_computerized']) && $clientInputs['deposit_list_computerized'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['deposit_list_computerized']) && $clientInputs['deposit_list_computerized'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            . ताळेबंदाशी ठेव यादया जुळत
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="deposit_list_matches">
                                <option value="आहे" {{ (isset($clientInputs['deposit_list_matches']) && $clientInputs['deposit_list_matches'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['deposit_list_matches']) && $clientInputs['deposit_list_matches'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            .</span>
                    </div>
                    <div class="mb-2">
                        तसेच संस्थेस प्राप्त झालेल्या ठेवींमध्ये संस्थांच्या ठेवींची विगतवारी स्वतंत्रपणे नमुद करावी.
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">4. देय व्याज तरतूद :-</span>
                        <span style="font-weight:bold;">
                            रु. {{$client['तरतुद_sum_currentYear'] ?? 0}}</span>
                        </span>
                    </div>
                    <div>
                        यामध्ये खालील देय व्याजाच्या तरतुदींचा समावेश आहे.
                        <table class="table table-bordered text-center align-middle" style="min-width:700px;">
                            <thead>
                                <tr>
                                    <th>अ.क्र</th>
                                    <th>ठेवी देय व्याज</th>
                                    <th>रक्कम</th>
                                </tr>
                            </thead>
                            <tbody>

                                 @php $i = 1; @endphp
                                @php
                                $totalCurrentYear = 0;

                                $totalDiff = 0;
                                @endphp
                                @foreach($client['तरतूद'] as $c)
                                @php
                                $totalCurrentYear += $c->currentYear;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->entity }}</td>
                                    <td>{{ number_format($c->currentYear, 2) }}</td>
                                </tr>
                                @endforeach                              
                                <tr>
                                    <td class="fw-bold">एकूण</td>
                                    <td></td>
                                    <td>{{ number_format($totalCurrentYear, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        संस्थेचे कामकाज संगणकीकृत असल्याने देय व्याजाच्या तरतुदी संगणक प्रणालीद्वारे काढलेल्या. काही देय
                        ठेव खात्यांची व्याजाची आकारणी तपासणी केली असता त्यामध्ये फरक दिसुन
                        <span>
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="interest_diff_found">
                                <option value="आला" {{ (isset($clientInputs['interest_diff_found']) && $clientInputs['interest_diff_found'] == 'आला') ? 'selected' : '' }}>आला</option>
                                <option value="नाही" {{ (isset($clientInputs['interest_diff_found']) && $clientInputs['interest_diff_found'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </span>
                        . या ठेवीच्या व्याजाच्या
                        तरतुदी केल्या प्रमाणात केल्या आहेत. त्याचा परिणाम नफा/तोटयावर
                        <span>
                            <input type="text" class="form-control d-inline-block" style="width:80px;display:inline;" name="interest_effect_on_profit" value="{{ $clientInputs['interest_effect_on_profit'] ?? '' }}">
                        </span>
                        झाला.
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">5. इतर देणे :-</span>
                        <span style="font-weight:bold;">
                            रु. {{ $client['इतर देणी_sum_currentYear'] ?? 0 }}
                        </span>
                    </div>
                    <div class="mb-2">
                        <span>दि.31/03/2025 अखेर देणे असलेल्या रकमामध्ये खालील देय रकमांचा समावेश आहे.</span>
                        <table class="table table-bordered text-center align-middle" style="min-width:700px;">
                            <thead>
                                <tr>
                                    <th>अ.क्र.</th>
                                    <th>देणे रकमाचा तपशील</th>
                                    <th>लेजर प्रमाणे बाकी</th>
                                    <th>यादीप्रमाणे बाकी</th>
                                    <th>फरक</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                 @php $i = 1; @endphp
                                @php
                                $totalCurrentYear = 0;
                                $totalLastYear =0;
                                $totalDiff = 0;
                                @endphp
                                @foreach( $client['इतर देणी'] as $c)
                                @php
                                $totalCurrentYear += $c->currentYear;
                                $totalLastYear += $c->lastYear;
                                $totalDiff += ($c->currentYear - $c->lastYear);
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->entity }}</td>
                                    <td>{{ number_format($c->currentYear, 2) }}</td>
                                    <td>{{ number_format($c->lastYear, 2) }}</td>
                                    <td>{{ number_format(($c->currentYear - $c->lastYear), 2) }}</td>
                                </tr>
                                @endforeach                              
                                <tr>
                                    <td class="fw-bold">एकूण</td>
                                    <td></td>
                                    <td>{{ number_format($totalCurrentYear, 2) }}</td>
                                    <td>{{ number_format($totalLastYear, 2) }}</td>
                                    <td>{{ number_format($totalDiff, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        संस्थेने विविध खर्चासाठी वरिल प्रमाणे तरतुद केलेले आहे. प्रत्याक्षात संभासदानां लाभांष देय नसल्यास ती रक्कम
                        राखीव निधीला स्थांलातरित करून बाकी निरंक करण्यात यावे. संस्पेन्स खात्याचे शाहनिषा करून बाकी निरंक
                        करण्यात यावे इतर देणे देउन बाकी निरंक करावे. फरक असल्यास याबाबत अभिप्राय नमुद करावेत.
                    </div>
                </div>

                <!-- START: Design as per pasted image -->

                <!-- 6. शाखा ठेवी -->
                <div class="mt-4 mb-2">
                    <span class="fw-bold" style="font-size: 1.1em;">6. शाखा ठेवी देणे :-</span>
                    <span style="font-weight:bold;">रु. {{$client['शाखा ठेवी देणे_sum_currentYear']}}</span>
                </div>
                <div class="mb-2">
                    शाखा येणे देणे रक्कमांमध्ये फरक असल्यास या फ़रकाबाबत सखोल तपासणी करुन अभिप्राय नमुद करावेत.

                </div>

                <!-- 7. देय कर्ज -->
                <div class="mb-2">
                    <span class="fw-bold">7. देय कर्ज :-</span>
                    <span style="font-weight:bold;">रु. {{$client['देणे कर्ज_sum_currentYear']}}</span>
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:600px;">
                        <thead>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>ठेवी रकम तपशील</th>
                                <th>गतवर्षी अखेर रु.</th>
                                <th>चालू वर्ष अखेर रु.</th>
                                <th>फरक</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>को.ऑप. बँक मुदत ठेव तारण कर्ज</td>
                                <td>{{$client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_lastYear']}}</td>
                                <td>{{$client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_currentYear']}}</td>
                                <td>{{$client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_currentYear'] - $client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_lastYear']}}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td>{{$client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_lastYear']}}</td>
                                <td>{{$client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_currentYear']}}</td>
                                <td>{{$client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_currentYear'] - $client['को.ऑप. बँक मुदत ठेव तारण कर्ज_sum_lastYear']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                    पुरविण्यात आलेले बँक स्टेटमेंट चे ताळेबंदाशी मेळ जुळते -
                </div>

                <!-- 8. संचीत नफा -->
                <div class="mb-2">
                    <span class="fw-bold">8. संचीत नफा :-</span>
                    <span style="font-weight:bold;">रु. {{$client['संचित नफा_sum_currentYear']}}</span>
                </div>
                <div class="mb-2">
                    सदर बाकी दि.<span>31/03/{{$end}}</span> अखेर ताळेबंदा प्रमाणे असुन मागील वर्षाचा संचीत नफा तोटा <span>{{$client['संचित नफा_sum_lastYear']}}</span> अधिक/व चालू वर्षाचा नफा/तोटा <span>{{$client['totalIncome7']}}</span> एकूण संचीत नफा <span>{{$client['संचित नफा_sum_currentYear']}}</span> बरोबर आहे/अधिक/कमी.
                    <br>
                    तरतूद व केल्यामुळ संचीत नफा प्रमाणीत करता आहे /
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="retained_profit_certified">
                        <option value="आहे" {{ (isset($clientInputs['retained_profit_certified']) && $clientInputs['retained_profit_certified'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['retained_profit_certified']) && $clientInputs['retained_profit_certified'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    .
                    <br>
                    नफा वाटणी कायदा कलम 65 व पोटनियम 73 मधील तरतुदी प्रमाणे करण्यात यावे.
                </div>

                <!-- 9. मालमत्ता व येणे बाजू -->
                <div class="mb-2">
                    <span class="fw-bold">ब) मालमत्ता व येणे बाजू :-</span>
                    <span style="font-weight:bold;">रु. {{$client['मालमत्ता व येणे बाजू']}}</span>
                </div>

                <!-- 10. रोख शिल्लक -->
                <div class="mb-2">
                    <span class="fw-bold">रोख शिल्लक :-</span>
                    <span style="font-weight:bold;">रु. {{$client['रोख शिल्लक_sum_currentYear']}}</span>
                </div>
                <div class="mb-2">
                    शाखासह एकूण रोख शिल्लक रु. <span>{{$client['मालमत्ता व येणे बाजू']}}</span> आहे. दैनंदिन पध्दतीने रोखता तरलता रजिस्टर ठेवलेले आहे. रोखता
                    उपविधीतील नियमानुसार मर्यादेत ठेवली
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="cash_register_verified">
                        <option value="आहे" {{ (isset($clientInputs['cash_register_verified']) && $clientInputs['cash_register_verified'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['cash_register_verified']) && $clientInputs['cash_register_verified'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    . ज्यादाची रोखतेचा परिणाम संस्थेच्या उत्पन्नावर होत
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="excess_cash_affects_income">
                        <option value="आहे" {{ (isset($clientInputs['excess_cash_affects_income']) && $clientInputs['excess_cash_affects_income'] == 'आहे') ? 'selected' : '' }}> आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['excess_cash_affects_income']) && $clientInputs['excess_cash_affects_income'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    .
                    <br>
                    बँकशाखेतील रोख शिल्लक दि. <span style="background: yellow;"><input type="date" class="form-control d-inline-block" style="width:120px;display:inline;" name="cash_balance_bank_date" value="{{ $clientInputs['cash_balance_bank_date'] ?? '2024-05-22' }}"></span> रोजी रु. <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="cash_balance_bank_amount" value="{{ $clientInputs['cash_balance_bank_amount'] ?? '' }}"></span> मिळाली असून ती रोकडीत जमा करण्यात आलेली आहे. रोख शिल्लक प्रमाणपत्र
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="cash_certificate_available">
                        <option value="आहे" {{ (isset($clientInputs['cash_certificate_available']) && $clientInputs['cash_certificate_available'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['cash_certificate_available']) && $clientInputs['cash_certificate_available'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    . रोख शिल्लकाची सुरक्षिततेची तिजोरी, अलमारी यांची व्यवस्था
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="cash_safe_arrangement">
                        <option value="आहे" {{ (isset($clientInputs['cash_safe_arrangement']) && $clientInputs['cash_safe_arrangement'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['cash_safe_arrangement']) && $clientInputs['cash_safe_arrangement'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    .
                </div>

                <!-- START: Design as per pasted image -->
                <div class="mt-4 mb-2">
                    <span style="font-weight:bold;"> रोख शिल्लक रक्कम जवळ बाळगणेबाबत रोखपालास अधिकार दिलेबाबतचा
                        तपशील विपद करा.</span>
                    रोखपालाकडून जामिनकीचे बॉंड व सुरक्षा ठेव रक्कम घेतलेबाबतचा तपशील नमूद करा.
                    रोखपालाकडून जामिनकीचे बॉंड व सुरक्षा ठेव रक्कम घेतलेल्या
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="cash_bond_taken">
                        <option value="आहे" {{ (isset($clientInputs['cash_bond_taken']) && $clientInputs['cash_bond_taken'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['cash_bond_taken']) && $clientInputs['cash_bond_taken'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    .
                </div>
                <div class="mb-2">
                    तपासणी मुदती रोख शिल्लकचे उल्लंघन झाले असल्यास खालीलप्रमाणे तपशील नमूद करावा.
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:700px;">
                        <thead>
                            <tr>
                                <th>अ.क्र</th>
                                <th>दिनांक</th>
                                <th>पोटनियम प्रमाणे शिल्लक मंजूर मर्यादा</th>
                                <th>प्रत्यक्ष हातातील रोख शिल्लक रु.</th>
                                <th>मर्यादेपेक्षा जास्त शिल्लक रु.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><input type="date" class="form-control" name="cash_limit_date_1" value="{{ $clientInputs['cash_limit_date_1'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_approved_1" value="{{ $clientInputs['cash_limit_approved_1'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_actual_1" value="{{ $clientInputs['cash_limit_actual_1'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_excess_1" value="{{ $clientInputs['cash_limit_excess_1'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><input type="date" class="form-control" name="cash_limit_date_2" value="{{ $clientInputs['cash_limit_date_2'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_approved_2" value="{{ $clientInputs['cash_limit_approved_2'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_actual_2" value="{{ $clientInputs['cash_limit_actual_2'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_excess_2" value="{{ $clientInputs['cash_limit_excess_2'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><input type="date" class="form-control" name="cash_limit_date_3" value="{{ $clientInputs['cash_limit_date_3'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_approved_3" value="{{ $clientInputs['cash_limit_approved_3'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_actual_3" value="{{ $clientInputs['cash_limit_actual_3'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_excess_3" value="{{ $clientInputs['cash_limit_excess_3'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><input type="date" class="form-control" name="cash_limit_date_4" value="{{ $clientInputs['cash_limit_date_4'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_approved_4" value="{{ $clientInputs['cash_limit_approved_4'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_actual_4" value="{{ $clientInputs['cash_limit_actual_4'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="cash_limit_excess_4" value="{{ $clientInputs['cash_limit_excess_4'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="cash_limit_total_actual" value="{{ $clientInputs['cash_limit_total_actual'] ?? '0.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="cash_limit_total_excess" value="{{ $clientInputs['cash_limit_total_excess'] ?? '0.00' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                    <span style="font-weight:bold;">2. बँक शिल्लक :- रु. {{$client['बँक शिल्लक_sum_currentYear']}}</span>
                </div>
                <div class="mb-2">
                    दि. <span>31/03/{{$end}}</span> अखेर खालीलप्रमाणे बँक शिल्लक आहे.
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:900px;">
                        <thead>
                            <tr>
                                <th>अ.क्र</th>
                                <th>बँकेचे नाव</th>
                                <th>ताळेबंदप्रमाणे रक्कम</th>
                                <th>बँक दाखल्याप्रमाणे रक्कम</th>
                                <th>फरक</th>
                                <th>शेरा</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @php
                            $totalCurrentYear = 0;
                            $totalBankAmount = 0;
                            $totalDiff = 0;
                            @endphp
                            @foreach($client['बँक शिल्लक'] as $c)
                            @php
                            $totalCurrentYear += $c->currentYear;
                            $totalBankAmount += $c->bankAmount;
                            $totalDiff += ($c->currentYear - $c->lastYear);
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->entity }}</td>
                                <td>{{ number_format($c->currentYear, 2) }}</td>
                                <td>{{ number_format($c->bankAmount, 2) }}</td>
                                <td>{{ number_format(($c->currentYear - $c->lastYear), 2) }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td>{{ number_format($totalCurrentYear, 2) }}</td>
                                <td>{{ number_format($totalBankAmount, 2) }}</td>
                                <td>{{ number_format($totalDiff, 2) }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <span>(टिप - अवसायनातील बँकांमध्ये बचत / चालू ठेव खाते असल्यास त्याबाबत स्वतंत्र अभिप्राय नमुद करावेत.)</span>
                <p>ताळमेळपत्रकानुसार ज्या रक्कमा तीन महिन्यापेक्षा जास्त कालवधीसाठी प्रलंबीत आहेत त्याबाबतचा तपशील
                    नमूद करावा. बँक खात्यावर अनावश्यक जादा रक्कमा पडून असल्यास त्याबाबतचा तपशील नमूद करावा.</p>
                <!-- END: Design as per pasted image -->
                <!-- existing content -->
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
                <!-- START: गुंतवणूक (Investment) Section as per pasted image -->
                <div class="mt-4 mb-2">
                    <span class="fw-bold" style="font-size: 1.1em;">३. गुंतवणूक :-</span>
                    <span style="font-weight:bold;">रु. {{$client['गुंतवणूक_sum']}}</span>
                </div>
                <div class="mb-2">
                    <span style="font-weight:bold;">दि. 31/03/2025 अखेर संस्थेने खालीलप्रमाणे गुंतवणूक केलेली आहे.</span>
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:950px;">
                        <thead>
                            <tr>
                                <th>अ. क्र</th>
                                <th>गुंतवणूक तपशील</th>
                                <th>दि. 31/03/2023</th>
                                <th>दि. 31/03/2024</th>
                                <th>वाढ/घट</th>
                                <th>वाढ/घट प्रमाण (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @php
                            $totalCurrentYear = 0;
                            $totalLastYear = 0;
                            $totalDiff = 0;
                            @endphp
                            @foreach($client['गुंतवणूक'] as $c)
                            @php
                            $totalCurrentYear += $c->currentYear;
                            $totalLastYear += $c->lastYear;
                            $totalDiff += ($c->currentYear - $c->lastYear);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->entity }}</td>
                                <td>{{ number_format($c->lastYear, 2) }}</td>
                                <td>{{ number_format($c->currentYear, 2) }}</td>
                                <td>{{ number_format(($c->currentYear - $c->lastYear), 2) }}</td>
                                <td>
                                    @if($c->lastYear != 0)
                                    {{ number_format((($c->currentYear - $c->lastYear) / $c->lastYear) * 100, 2) }}%
                                    @else
                                    0%
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td>{{ number_format($totalLastYear, 2) }}</td>
                                <td>{{ number_format($totalCurrentYear, 2) }}</td>
                                <td>{{ number_format($totalDiff, 2) }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                    <ol class="mb-2" style="padding-left: 20px;">
                        <li>संस्थेने केलेल्या सर्व गुंतवणूक यादीनुसार गुंतवणूक रक्कम जुळत -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="investment_list_matches">
                                <option value="आहे" {{ (isset($clientInputs['investment_list_matches']) && $clientInputs['investment_list_matches'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['investment_list_matches']) && $clientInputs['investment_list_matches'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>गुंतवणुकीचे दाखले
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="investment_certificates_available">
                                <option value="आहे" {{ (isset($clientInputs['investment_certificates_available']) && $clientInputs['investment_certificates_available'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['investment_certificates_available']) && $clientInputs['investment_certificates_available'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            . ठेव पावत्या तपासाव्यात
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="investment_certificates_available1">
                                <option value="आहे" {{ (isset($clientInputs['investment_certificates_available1']) && $clientInputs['investment_certificates_available1'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['investment_certificates_available1']) && $clientInputs['investment_certificates_available1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>राखीव निधी, इमारत निधी व इतर कायदेशीर निधीची स्वतंत्र गुंतवणूक केलेली -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="statutory_funds_invested">
                                <option value="आहे" {{ (isset($clientInputs['statutory_funds_invested']) && $clientInputs['statutory_funds_invested'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['statutory_funds_invested']) && $clientInputs['statutory_funds_invested'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>निधीचे व्यवस्थापन योग्यरीत्या केले -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="fund_management_proper">
                                <option value="आहे" {{ (isset($clientInputs['fund_management_proper']) && $clientInputs['fund_management_proper'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['fund_management_proper']) && $clientInputs['fund_management_proper'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>तत्संबंधित केलेली गुंतवणूक किमती आहे का, ती नियमावली प्रमाणे तपशील नमूद करावा -
                            <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="investment_value_compliant" value="{{ $clientInputs['investment_value_compliant'] ?? '' }}">
                        </li>
                        <li>गुंतवणूक प्रमाणपत्रे नियमानुसार पुर्ण प्रमाणात आहेत -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="investment_certificates_compliant">
                                <option value="आहे" {{ (isset($clientInputs['investment_certificates_compliant']) && $clientInputs['investment_certificates_compliant'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['investment_certificates_compliant']) && $clientInputs['investment_certificates_compliant'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>सध्या नागरी सहकारी बँक/सेंट्रल/डिस्ट्रिक्ट बँके व्यतिरिक्त अन्य कुठे गुंतवणूक केली असल्यास/त्याबाबत तपशील नमूद करावा.</li>
                        <input type="text" class="form-control d-inline-block" style="width:300px;display:inline;" name="other_investments_details" value="{{ $clientInputs['other_investments_details'] ?? '' }}">
                        <li> गुंतवणूक खेळत्या भांडवलाशी असल्याचे प्रमाण नमूद करावे. @if($client['totalIncome7'] != 0)
                            <b>{{ number_format(($client['गुंतवणूक_sum'] / $client['totalIncome7']) * 100, 2) }}% </b>
                            @else
                            0%
                            @endif
                        </li>
                    </ol>
                </div>
                <span>(टिप - अवसायनातील बँकां/संस्थांमध्ये गुंतवणूक असल्यास त्याबाबत स्वतंत्र अभिप्राय नमुद करावेत.)</span>
                <!-- END: गुंतवणूक (Investment) Section -->

                <!-- START: कर्ज (Loan) Section as per pasted image -->
                <div class="mt-4 mb-2">
                    <span class="fw-bold" style="font-size: 1.1em;">4. कर्जे :-</span>
                    <span style="font-weight:bold;">रु. {{$client['देणे कर्ज_sum_currentYear']}}</span>
                </div>
                <div class="mb-2">
                    <span style="font-weight:bold;">दि. 31/03/2025 अखेर संस्थेस खालीलप्रमाणे कर्ज येणे आहे.</span>
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:950px;">
                        <thead>
                            <tr>
                                <th>अ. क्र</th>
                                <th>कर्ज प्रकार</th>
                                <th>गतवर्षी अखेर रु.</th>
                                <th>चालू वर्ष अखेर रु.</th>
                                <th>वाढ/घट</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @php
                            $totalCurrentYear = 0;
                            $totalLastYear = 0;
                            $totalDiff = 0;
                            @endphp
                            @foreach($client['देणे कर्ज'] as $c)
                            @php
                            $totalCurrentYear += $c->currentYear;
                            $totalLastYear += $c->lastYear;
                            $totalDiff += ($c->currentYear - $c->lastYear);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->entity }}</td>
                                <td>{{ number_format($c->lastYear, 2) }}</td>
                                <td>{{ number_format($c->currentYear, 2) }}</td>
                                <td>{{number_format(($c->currentYear - $c->lastYear),2) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td>{{ number_format($totalLastYear, 2) }}</td>
                                <td>{{ number_format($totalCurrentYear, 2) }}</td>
                                <td>{{ number_format($totalDiff, 2) }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                    कर्जाची तुलनात्मक आकडेवारी पाहता अहवाल सालात कर्जात रु.
                    <span style="font-weight:bold;">
                        {{ number_format($totalDiff, 2) }}
                    </span>
                    वाढ झाली आहे. लेखापरीक्षण कालावधीत कर्जाचा व्याजदर
                    <span style="font-weight:bold;">
                        <input type="text" class="form-control d-inline-block" style="width:80px;display:inline;" name="loan_interest_rate" value="{{ $clientInputs['loan_interest_rate'] ?? '' }}">
                    </span>
                    आकारला आहे. सेवक कर्जाचा
                    <span style="font-weight:bold;">
                        <input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="employee_loan_interest_rate" value="{{ $clientInputs['employee_loan_interest_rate'] ?? '' }}">
                    </span>
                    व्याज आकारणी केली आहे. संस्थेचे कामकाज संगणकीकृत असल्याने कर्जे यादया संगणक प्रणालीद्वारे काढलेल्या
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="loan_list_computerized">
                        <option value="आहे" {{ (isset($clientInputs['loan_list_computerized']) && $clientInputs['loan_list_computerized'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['loan_list_computerized']) && $clientInputs['loan_list_computerized'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    . ताळेबंदाशी कर्जे यादया जुळत
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="loan_list_matches">
                        <option value="आहे" {{ (isset($clientInputs['loan_list_matches']) && $clientInputs['loan_list_matches'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['loan_list_matches']) && $clientInputs['loan_list_matches'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    याबाबत अभिप्राय नमुद करावेत. कर्जाबाबतचा सविस्तर तपशील स्वतंत्रपणे नमुद केलेला आहे. कृपया अवलोकन व्हावे.
                </div>

                <!-- END: कर्ज (Loan) Section -->

                <!-- START: शाखा येणे देणे/स्थावर व जंगम मालमत्ता Section as per pasted image -->
                <div class="mt-4 mb-2">
                    <span style="background: yellow; font-weight:bold;">1. शाखा येणे देणे :-</span>
                    <span style="background: yellow; font-weight:bold;">निरंक</span>
                </div>
                <div class="mb-2">
                    शाखा येणे देणे रकमांमध्ये फरक असल्यास या फरकाबाबत सखोल तपासणी करून अभिप्राय नमूद करावा.
                </div>
                <div class="mb-2">
                    <span style="font-weight:bold;">6. स्थावर व जंगम मालमत्ता: {{$client['कायम मालमत्ता_sum_currentYear']}}</span>
                </div>
                <div class="mb-2">
                    <span style="font-weight:bold;">दि. 31/03/2024 अखेर संस्थेची मालमत्ता खालीलप्रमाणे आहे.</span>
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:950px;">
                        <thead>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>मालमत्तेचा तपशील</th>
                                <th>दि.31/03/2023 अखेर रक्कम रु.</th>
                                <th>दि.31/03/2024 अखेर रक्कम रु.</th>
                                <th>वाढ/घट रक्कम रु.</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php $i = 1; @endphp
                            @php
                            $totalCurrentYear = 0;
                            $totalLastYear = 0;
                            $totalDiff = 0;
                            @endphp
                            @foreach($client['कायम मालमत्ता'] as $c)
                            @php
                            $totalCurrentYear += $c->currentYear;
                            $totalLastYear += $c->lastYear;
                            $totalDiff += ($c->currentYear - $c->lastYear);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->entity }}</td>
                                <td>{{ number_format($c->lastYear, 2) }}</td>
                                <td>{{ number_format($c->currentYear, 2) }}</td>
                                <td>{{number_format(($c->currentYear - $c->lastYear),2) }}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td>{{ number_format($totalLastYear, 2) }}</td>
                                <td>{{ number_format($totalCurrentYear, 2) }}</td>
                                <td>{{ number_format($totalDiff, 2) }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END: शाखा येणे देणे/स्थावर व जंगम मालमत्ता Section -->

                <!-- START: मालमत्ता/घसारा/इतर येणे Section as per pasted image -->
                <div class="mt-4 mb-2">
                    <ol style="padding-left: 20px;">
                        <li>
                            संस्थेने मालमत्तेवर नियमाप्रमाणे घसारा आकारणी केलेली आहे का?
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="depreciation_applied">
                                <option value="आहे" {{ (isset($clientInputs['depreciation_applied']) && $clientInputs['depreciation_applied'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['depreciation_applied']) && $clientInputs['depreciation_applied'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>
                            संस्थेने अद्यावत मालमत्ता रजिस्टर ठेवलेले आहे का?
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="asset_register_maintained">
                                <option value="आहे" {{ (isset($clientInputs['asset_register_maintained']) && $clientInputs['asset_register_maintained'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['asset_register_maintained']) && $clientInputs['asset_register_maintained'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>
                            लेखापरीक्षण कालावधीत रु.
                            <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="asset_purchase_amount" value="{{ $clientInputs['asset_purchase_amount'] ?? '' }}">
                            मालमत्तांची खरेदी व रु.
                            <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="asset_sale_amount" value="{{ $clientInputs['asset_sale_amount'] ?? '' }}">
                            मालमत्तांची विक्री विविध कार्यपद्धती अवलंबून झाली.
                        </li>
                        <li>
                            सदस्य विक्रीतून संस्थेस नफाजमा/तथलेख मानांकनानुसार केलेला तोटा झाला असल्यास त्यांचा/लागू
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="member_asset_loss_applied">
                                <option value="आहे" {{ (isset($clientInputs['member_asset_loss_applied']) && $clientInputs['member_asset_loss_applied'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['member_asset_loss_applied']) && $clientInputs['member_asset_loss_applied'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                    </ol>
                </div>
                <div class="mb-2">
                    <span class="fw-bold">8. इतर येणे :-</span>
                    <span style="font-weight:bold;">रु. {{ $client['इतर देणी_sum_currentYear'] ?? 0 }}</span>
                </div>
                <div class="mb-2">
                    दि. <span>31/03/2025</span> अखेर संस्थेस खालीलप्रमाणे इतर रक्कम येणे आहे.
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:950px;">
                        <thead>
                            <tr>
                                <th style="background: yellow;">अ.क्र.</th>
                                <th style="background: yellow;">तपशील</th>
                                <th style="background: yellow;">ताळेबंदानुसार रक्कम</th>
                                <th style="background: yellow;">यादीप्रमाणे रक्कम</th>
                                <th style="background: yellow;">फरक</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @php
                            $totalCurrentYear = 0;
                            $totalLastYear = 0;
                            $totalDiff = 0;
                            @endphp
                            @foreach($client['इतर देणी'] as $c)
                            @php
                            $totalCurrentYear += $c->currentYear;
                            $totalLastYear += $c->lastYear;
                            $totalDiff += ($c->currentYear - $client->lastYear);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->entity }}</td>
                                <td>{{ number_format($c->lastYear, 2) }}</td>
                                <td>{{ number_format($c->currentYear, 2) }}</td>
                                <td>{{number_format(($c->currentYear - $c->lastYear),2) }}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td>{{ number_format($totalLastYear, 2) }}</td>
                                <td>{{ number_format($totalCurrentYear, 2) }}</td>
                                <td>{{ number_format($totalDiff, 2) }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                    <span class="fw-bold">घेणे व्याज :-</span>
                    <span style="font-weight:bold;">रु. {{ $client['घेणे व्यज_sum_currentYear'] ?? 0 }}</span>
                </div>
                <div class="mb-2">
                    दि. <span>31/03/2025</span> अखेर संस्थेस खालीलप्रमाणे इतर रक्कम घेणे आहे.
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:950px;">
                        <thead>
                            <tr>
                                <th style="background: yellow;">अ.क्र.</th>
                                <th style="background: yellow;">तपशील</th>
                                <th style="background: yellow;">ताळेबंदानुसार रक्कम</th>
                                <th style="background: yellow;">यादीप्रमाणे रक्कम</th>
                                <th style="background: yellow;">फरक</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @php
                            $totalCurrentYear = 0;
                            $totalLastYear = 0;
                            $totalDiff = 0;
                            @endphp
                            @foreach($client['घेणे व्यज'] as $c)
                            @php
                            $totalCurrentYear += $c->currentYear;
                            $totalLastYear += $c->lastYear;
                            $totalDiff += ($c->currentYear - $c->lastYear);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $c->entity }}</td>
                                <td>{{ number_format($c->lastYear, 2) }}</td>
                                <td>{{ number_format($c->currentYear, 2) }}</td>
                                <td>{{number_format(($c->currentYear - $c->lastYear),2) }}</td>
                            </tr>
                            @endforeach

                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td>{{ number_format($totalLastYear, 2) }}</td>
                                <td>{{ number_format($totalCurrentYear, 2) }}</td>
                                <td>{{ number_format($totalDiff, 2) }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <span class="text-muted">(टीप- संस्था विलिनीकरण केली असल्यास विलिनीकृत संस्थांची येणे रक्कम स्वतंत्र दर्शविण्यात यावी)</span>
                <div class="mt-3 mb-2">
                    <span class="fw-bold" style="font-size: 1.1em;">9. संचीत तोटा : -</span>
                    <span style="font-weight:bold;">रु. {{$client['नफा_तोटा_sum_currentYear']}}</span>
                </div>
                <div class="mb-2">
                    सदर बाकी दि.<span>31/03/2025</span> अखेर ताळेबंदा प्रमाणे असुन मागील वर्षाचा संचीत नफा/तोटा रु.
                    <span>{{$client['नफा_तोटा_sum_lastYear']}}</span>
                    अधिक/व चालू वर्षाचा नफा/तोटा रु.
                    <span></span>
                    एकूण संचीत तोटा रु. {{$client['नफा_तोटा_sum_currentYear']}}
                    <span>{{$client['नफा_तोटा_sum_lastYear']}}</span>
                    बरोबर आहे. आवष्यक तरतुद न केल्यामुळे संचीत तोटा प्रमाणीत करता येत नाही.
                    <br>
                    नफा वाटणी कायदा कलम 65 व पोटनियम 73 मधील तरतुदी प्रमाणे करण्यात यावे.
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