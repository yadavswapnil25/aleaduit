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
                        <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:160px;display:inline;" name="capital_deposit_side" value="{{ $clientInputs['capital_deposit_side'] ?? '117339566.2' }}"></span>
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">1. भागभांडवल :</span>
                        <span style="background: yellow; font-weight:bold;">- रु. <input type="text" class="form-control d-inline-block" style="width:160px;display:inline;" name="share_capital" value="{{ $clientInputs['share_capital'] ?? '5318190.00' }}"></span>
                    </div>
                    <div class="mb-2">
                        संस्थेचे अधिकृत भागभांडवल रु.
                        <span style="background: #00ff00;"><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="authorized_share_capital" value="{{ $clientInputs['authorized_share_capital'] ?? '7000000' }}"></span>
                        आहे. एका भागाची दर्शनी किंमत रु.
                        <span style="background: #00ff00;"><input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="share_face_value" value="{{ $clientInputs['share_face_value'] ?? '100' }}"></span>
                        आहे. दि.
                        <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="last_year_date" value="{{ $clientInputs['last_year_date'] ?? '31/03/2023' }}"></span>
                        (गतवर्षी) अखेर संस्थेकडून वस्तुम भागभांडवल रु.
                        <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="last_year_share_capital" value="{{ $clientInputs['last_year_share_capital'] ?? '4828470.00' }}"></span>
                        होते. लेखापरीक्षण कालावधीत त्यामध्ये रु.
                        <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="share_capital_increase" value="{{ $clientInputs['share_capital_increase'] ?? '489720.00' }}"></span>
                        ने वाढ झालेली असून दि.
                        <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="current_year_date" value="{{ $clientInputs['current_year_date'] ?? '31/03/2024' }}"></span>
                        (चालूवर्षी) अखेर संस्थेकडून वस्तुम भागभांडवल रु.
                        <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="current_year_share_capital" value="{{ $clientInputs['current_year_share_capital'] ?? '5318190.00' }}"></span>
                        झालेले आहे. सदरचे वस्तुम भागभांडवल अधिकृत भागभांडवलाच्या कमी
                        <select class="form-control d-inline-block" style="width:80px;display:inline;" name="share_capital_less_than_authorized">
                            <option value="आहे" {{ (isset($clientInputs['share_capital_less_than_authorized']) && $clientInputs['share_capital_less_than_authorized'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                            <option value="नाही" {{ (isset($clientInputs['share_capital_less_than_authorized']) && $clientInputs['share_capital_less_than_authorized'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                        </select>
                        आहे / नाही
                    </div>

                    <!-- START: Design as per pasted image -->
                    <div class="mb-2">
                        <span>लेखापरिक्षण कालावधीत रु. <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:80px;display:inline;" name="share_capital_returned" value="{{ $clientInputs['share_capital_returned'] ?? '75200' }}"></span> भागभांडवल परत केले असून त्याचे प्रमाण <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="share_capital_returned_percent" value="{{ $clientInputs['share_capital_returned_percent'] ?? '1.55' }}"></span> % आहे. अहवाल वर्षात
                            भागभांडवल रु. <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="share_capital_increase_amount" value="{{ $clientInputs['share_capital_increase_amount'] ?? '954510.39' }}"></span> ने वाढलेले असुन, भागभांडवल वाढीचे प्रमाण <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="share_capital_increase_percent" value="{{ $clientInputs['share_capital_increase_percent'] ?? '9.86' }}"></span> % आहे. भागभांडवल यादीची रक्कम
                            ताळेबंदातील रक्कमेशी जुळती
                            <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="share_capital_matches">
                                <option value="आहे" {{ (isset($clientInputs['share_capital_matches']) && $clientInputs['share_capital_matches'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['share_capital_matches']) && $clientInputs['share_capital_matches'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            .
                        </span>
                    </div>

                    <div class="mb-2">
                        <span class="fw-bold">2. राखीव व इतर निधी :</span>
                        <span style="background: yellow; font-weight:bold;">- रु. <input type="text" class="form-control d-inline-block" style="width:160px;display:inline;" name="reserve_and_other_funds" value="{{ $clientInputs['reserve_and_other_funds'] ?? '7759577.44' }}"></span>
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
                                    <td>1711061</td>
                                    <td>1711061</td>
                                    <td>0-Equal</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>बुडीत कर्ज निधी</td>
                                    <td>644270.44</td>
                                    <td>644270.44</td>
                                    <td>0-Equal</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>कर्मचारी ग्रॅच्युइटी निधी</td>
                                    <td>396075</td>
                                    <td>396075</td>
                                    <td>0-Equal</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>कर्मचारी कल्याण निधी</td>
                                    <td>329175</td>
                                    <td>329175</td>
                                    <td>0-Equal</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>कर्मचारी भविष्य निर्वाह निधी</td>
                                    <td>102744</td>
                                    <td>113160</td>
                                    <td style="background: yellow;">10416-Up</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>नि.नि.अभिकृती सुरक्षा ठेव</td>
                                    <td>690191</td>
                                    <td>771294</td>
                                    <td style="background: yellow;">81103-Up</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>इमारत निधी</td>
                                    <td>3085647</td>
                                    <td>3206697</td>
                                    <td style="background: yellow;">121050-Up</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>संचयी निधी कर्ज</td>
                                    <td>414866</td>
                                    <td>414866</td>
                                    <td>0-Equal</td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>संगणक निधी</td>
                                    <td>104640</td>
                                    <td>90886</td>
                                    <td style="background: yellow;">-13754-Down</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>आकस्मिक फंड</td>
                                    <td>15383</td>
                                    <td>15383</td>
                                    <td>0-Equal</td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>आर्थिक उन्नत सुरक्षा जमा</td>
                                    <td>50213</td>
                                    <td>66710</td>
                                    <td style="background: yellow;">16398-Up</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="fw-bold">एकूण</td>
                                    <td>7544364.44</td>
                                    <td>7759577.44</td>
                                    <td style="background: yellow;">215213</td>
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
                        <span style="background: yellow; font-weight:bold;">- रु. <input type="text" class="form-control d-inline-block" style="width:160px;display:inline;" name="total_deposit" value="{{ $clientInputs['total_deposit'] ?? '100219811.00' }}"></span>
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
                        <span>दि. <span>31/03/{{ $end }}</span> अखेर संस्थेने खालीलप्रमाणे ठेवी स्विकारलेल्या आहेत. चालु व मागील आर्थिक वर्षातील तुलनात्मक
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
                                <tr>
                                    <td>1</td>
                                    <td>बचत ठेव</td>
                                    <td style="background: yellow;">9553428</td>
                                    <td style="background: yellow;">9638603</td>
                                    <td style="background: yellow;">85175-Up</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>कुटुंब निर्मिती ठेव खाते</td>
                                    <td style="background: yellow;">16972000</td>
                                    <td style="background: yellow;">19926000</td>
                                    <td style="background: yellow;">2954000-Up</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>मुदत ठेव</td>
                                    <td style="background: yellow;">24722104</td>
                                    <td style="background: yellow;">35108977</td>
                                    <td style="background: yellow;">10386873-Up</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>नियतिनिधी ठेव</td>
                                    <td style="background: yellow;">10017284</td>
                                    <td style="background: yellow;">12978564</td>
                                    <td style="background: yellow;">2961280-Up</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>दामदिप्पट ठेव</td>
                                    <td style="background: yellow;">1144500</td>
                                    <td style="background: yellow;">424500</td>
                                    <td style="background: yellow;">-720000-Down</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>दामदुप्पट ठेव</td>
                                    <td style="background: yellow;">17744898</td>
                                    <td style="background: yellow;">14384085</td>
                                    <td style="background: yellow;">-3360813-Down</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>दामचौपट ठेव</td>
                                    <td style="background: yellow;">1038000</td>
                                    <td style="background: yellow;">779000</td>
                                    <td style="background: yellow;">-259000-Down</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>आमर्त ठेव</td>
                                    <td style="background: yellow;">5602966</td>
                                    <td style="background: yellow;">6980082</td>
                                    <td style="background: yellow;">1377116-Up</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">एकूण</td>
                                    <td></td>
                                    <td style="background: yellow;">86795180.00</td>
                                    <td style="background: yellow;">100219811.00</td>
                                    <td style="background: yellow;">13424631.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        <span>
                            लेखापरीक्षण मुदतीत एकूण ठेवीमध्ये रु.
                            <span style="background: yellow; font-weight:bold;">
                                <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="deposit_increase_amount" value="{{ $clientInputs['deposit_increase_amount'] ?? '13424631.00' }}">
                            </span>
                            लाख इतकी
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="deposit_list_computerized_1">
                                <option value="वाढ" {{ (isset($clientInputs['deposit_list_computerized_1']) && $clientInputs['deposit_list_computerized_1'] == 'वाढ') ? 'selected' : '' }}>वाढ</option>
                                <option value="घट" {{ (isset($clientInputs['deposit_list_computerized_1']) && $clientInputs['deposit_list_computerized_1'] == 'नाही') ? 'selected' : '' }}>घट</option>
                            </select>
                            झालेली आहे. वाढीचे प्रमाण
                            <span style="background: yellow; font-weight:bold;">
                                <input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="deposit_increase_percent" value="{{ $clientInputs['deposit_increase_percent'] ?? '15.47' }}">
                            </span>
                            % आहे. लेखापरीक्षण मुदतीत ठेव व्याज दर
                            <span style="background: yellow; font-weight:bold;">
                                <input type="text" class="form-control d-inline-block" style="width:80px;display:inline;" name="deposit_interest_rate" value="{{ $clientInputs['deposit_interest_rate'] ?? '4 to 9.50' }}">
                            </span>
                            % पर्यंत आकारलेला आहे. संस्थेचे कामकाज संगणकीकृत
                            असल्याने ठेव यादयासंगणक प्रणालीव्दारे काढलेल्या
                            <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="deposit_list_computerized">
                                <option value="आहे" {{ (isset($clientInputs['deposit_list_computerized']) && $clientInputs['deposit_list_computerized'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['deposit_list_computerized']) && $clientInputs['deposit_list_computerized'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            . ताळेबंदाशी ठेव यादया जुळत
                            <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="deposit_list_matches">
                                <option value="आहे" {{ (isset($clientInputs['deposit_list_matches']) && $clientInputs['deposit_list_matches'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['deposit_list_matches']) && $clientInputs['deposit_list_matches'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                            .
                        </span>
                    </div>
                    <div class="mb-2">
                        तसेच संस्थेस प्राप्त झालेल्या ठेवींमध्ये संस्थांच्या ठेवींची विगतवारी स्वतंत्रपणे नमुद करावी.
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">4. देय व्याज तरतूद :-</span>
                        <span style="background: yellow; font-weight:bold;">
                            रु. <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="interest_provision" value="{{ $clientInputs['interest_provision'] ?? '292257.00' }}">
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
                                <tr>
                                    <td>1</td>
                                    <td>एफ डी ए तरतूद</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="interest_provision_fda" value="{{ $clientInputs['interest_provision_fda'] ?? '247491' }}"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>कर्मचारी बोनस</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="interest_provision_bonus" value="{{ $clientInputs['interest_provision_bonus'] ?? '00' }}"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>शिक्षण निधी तरतूद</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="interest_provision_edu" value="{{ $clientInputs['interest_provision_edu'] ?? '00' }}"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>निवडणूक खर्च तरतूद</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="interest_provision_election" value="{{ $clientInputs['interest_provision_election'] ?? '3071' }}"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>शिक्षण निधी तरतूद</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="interest_provision_edu2" value="{{ $clientInputs['interest_provision_edu2'] ?? '30068' }}"></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>देणे व्याज कर्ज</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="interest_provision_loan" value="{{ $clientInputs['interest_provision_loan'] ?? '00' }}"></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>ऑडिट फी तरतूद</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="interest_provision_audit" value="{{ $clientInputs['interest_provision_audit'] ?? '11627' }}"></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">एकूण</td>
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="interest_provision_total" value="{{ $clientInputs['interest_provision_total'] ?? '292257.00' }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        संस्थेचे कामकाज संगणकीकृत असल्याने देय व्याजाच्या तरतुदी संगणक प्रणालीद्वारे काढलेल्या. काही देय
                        ठेव खात्यांची व्याजाची आकारणी तपासणी केली असता त्यामध्ये फरक दिसुन
                        <span style="background: #00ff00;">
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="interest_diff_found">
                                <option value="आला" {{ (isset($clientInputs['interest_diff_found']) && $clientInputs['interest_diff_found'] == 'आला') ? 'selected' : '' }}>आला</option>
                                <option value="नाही" {{ (isset($clientInputs['interest_diff_found']) && $clientInputs['interest_diff_found'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </span>
                        . या ठेवीच्या व्याजाच्या
                        तरतुदी केल्या प्रमाणात केल्या आहेत. त्याचा परिणाम नफा/तोटयावर
                        <span style="background: #00ff00;">
                            <input type="text" class="form-control d-inline-block" style="width:80px;display:inline;" name="interest_effect_on_profit" value="{{ $clientInputs['interest_effect_on_profit'] ?? '' }}">
                        </span>
                        झाला.
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">5. इतर देणे :-</span>
                        <span style="background: yellow; font-weight:bold;">
                            रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="other_payables" value="{{ $clientInputs['other_payables'] ?? '37363.70' }}">
                        </span>
                    </div>
                    <div class="mb-2">
                        <span>दि.31/03/{{ $end }} अखेर देणे असलेल्या रकमामध्ये खालील देय रकमांचा समावेश आहे.</span>
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
                                <tr>
                                    <td>1</td>
                                    <td>कर्ज अनामत</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="payable_loan_security" value="{{ $clientInputs['payable_loan_security'] ?? '14000' }}"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>विशेष वसुली चार्ज</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="payable_special_charge" value="{{ $clientInputs['payable_special_charge'] ?? '1438' }}"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>जी एस टी</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="payable_gst" value="{{ $clientInputs['payable_gst'] ?? '2518.70' }}"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>निवडणूक खर्च</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="payable_election" value="{{ $clientInputs['payable_election'] ?? '400' }}"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>टी डी एस</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="payable_tds" value="{{ $clientInputs['payable_tds'] ?? '15387' }}"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>पत्ता संस्था री. चार्ज</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="payable_address_recharge" value="{{ $clientInputs['payable_address_recharge'] ?? '960' }}"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>पत्ता संस्था प्रो. चार्ज</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="payable_address_procharge" value="{{ $clientInputs['payable_address_procharge'] ?? '155' }}"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>प्रवेश फी</td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="payable_entry_fee" value="{{ $clientInputs['payable_entry_fee'] ?? '2445' }}"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">एकूण</td>
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="payable_total" value="{{ $clientInputs['payable_total'] ?? '37363.70' }}"></td>
                                    <td></td>
                                    <td></td>
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
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="branch_deposit" value="{{ $clientInputs['branch_deposit'] ?? '' }}"></span>
                </div>
                <div class="mb-2">
                    शाखा येणे देणे रक्कमांमध्ये फरक असल्यास या फ़रकाबाबत सखोल तपासणी करुन अभिप्राय नमुद करावेत.

                </div>

                <!-- 7. देय कर्ज -->
                <div class="mb-2">
                    <span class="fw-bold">7. देय कर्ज :-</span>
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="payable_loan" value="{{ $clientInputs['payable_loan'] ?? '2800000.00' }}"></span>
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
                                <td style="background: yellow;"><input type="text" class="form-control" name="coop_bank_loan_last" value="{{ $clientInputs['coop_bank_loan_last'] ?? '1550000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="coop_bank_loan_current" value="{{ $clientInputs['coop_bank_loan_current'] ?? '2800000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="coop_bank_loan_diff" value="{{ $clientInputs['coop_bank_loan_diff'] ?? '1250000' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>इतर</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_loan_last" value="{{ $clientInputs['other_loan_last'] ?? '0' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_loan_current" value="{{ $clientInputs['other_loan_current'] ?? '0' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_loan_diff" value="{{ $clientInputs['other_loan_diff'] ?? '0' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="total_loan_last" value="{{ $clientInputs['total_loan_last'] ?? '1550000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="total_loan_current" value="{{ $clientInputs['total_loan_current'] ?? '2800000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="total_loan_diff" value="{{ $clientInputs['total_loan_diff'] ?? '1250000' }}"></td>
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
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="retained_profit" value="{{ $clientInputs['retained_profit'] ?? '912367.06' }}"></span>
                </div>
                <div class="mb-2">
                    सदर बाकी दि.<span style="background: yellow;">31/03/2024</span> अखेर ताळेबंदा प्रमाणे असुन मागील वर्षाचा संचीत नफा तोटा <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="retained_profit_last" value="{{ $clientInputs['retained_profit_last'] ?? '510058.97' }}"></span> अधिक/व चालू वर्षाचा नफा/तोटा <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="retained_profit_current" value="{{ $clientInputs['retained_profit_current'] ?? '402308.99' }}"></span> एकूण संचीत नफा <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="retained_profit_total" value="{{ $clientInputs['retained_profit_total'] ?? '912367.06' }}"></span> बरोबर आहे/अधिक/कमी.
                    <br>
                    तरतूद व केल्यामुळ संचीत नफा प्रमाणीत करता आहे /
                    <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="retained_profit_certified">
                        <option value="आहे" {{ (isset($clientInputs['retained_profit_certified']) && $clientInputs['retained_profit_certified'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['retained_profit_certified']) && $clientInputs['retained_profit_certified'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    .
                    <br>
                    नफा वाटणी कायदा कलम 65 व पोटनियम 73 मधील तरतुदी प्रमाणे करण्यात यावे.
                </div>

                <!-- 9. मालमत्ता व येणे बाजू -->
                <div class="mb-2">
                    <span class="fw-bold">९) मालमत्ता व येणे बाजू :-</span>
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:160px;display:inline;" name="asset_receivable_side" value="{{ $clientInputs['asset_receivable_side'] ?? '117339566.2' }}"></span>
                </div>

                <!-- 10. रोख शिल्लक -->
                <div class="mb-2">
                    <span class="fw-bold">रोख शिल्लक :-</span>
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="cash_balance" value="{{ $clientInputs['cash_balance'] ?? '1040686.00' }}"></span>
                </div>
                <div class="mb-2">
                    शाखासह एकूण रोख शिल्लक रु. <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="cash_balance_total" value="{{ $clientInputs['cash_balance_total'] ?? '1040686.00' }}"></span> आहे. दैनंदिन पध्दतीने रोखता तरलता रजिस्टर ठेवलेले आहे. रोखता
                    उपविधीतील नियमानुसार मर्यादेत ठेवली
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="cash_register_verified">
                        <option value="आहे" {{ (isset($clientInputs['cash_register_verified']) && $clientInputs['cash_register_verified'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['cash_register_verified']) && $clientInputs['cash_register_verified'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    . ज्यादाची रोखतेचा परिणाम संस्थेच्या उत्पन्नावर
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="excess_cash_affects_income">
                        <option value="होत आहे" {{ (isset($clientInputs['excess_cash_affects_income']) && $clientInputs['excess_cash_affects_income'] == 'होत आहे') ? 'selected' : '' }}>होत आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['excess_cash_affects_income']) && $clientInputs['excess_cash_affects_income'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    .
                    <br>
                    बँकशाखेतील रोख शिल्लक दि. <span style="background: yellow;"><input type="date" class="form-control d-inline-block" style="width:120px;display:inline;" name="cash_balance_bank_date" value="{{ $clientInputs['cash_balance_bank_date'] ?? '2024-05-22' }}"></span> रोजी रु. <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="cash_balance_bank_amount" value="{{ $clientInputs['cash_balance_bank_amount'] ?? '902153.00' }}"></span> मिळाली असून ती रोकडीत जमा करण्यात आलेली आहे. रोख शिल्लक प्रमाणपत्र आहे /
                    <select class="form-control d-inline-block" style="width:80px;display:inline;" name="cash_certificate_available">
                        <option value="आहे" {{ (isset($clientInputs['cash_certificate_available']) && $clientInputs['cash_certificate_available'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['cash_certificate_available']) && $clientInputs['cash_certificate_available'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    . रोख शिल्लकाची सुरक्षिततेची तिजोरी, अलमारी यांची व्यवस्था आहे /
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
                    <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="cash_bond_taken">
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
                    <span style="font-weight:bold;background:yellow;">2. बँक शिल्लक :- रु. <input type="text" class="form-control d-inline-block" style="width:160px;display:inline;" name="bank_balance" value="{{ $clientInputs['bank_balance'] ?? '1692346.20' }}"></span>
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
                            <tr>
                                <td>1</td>
                                <td>बचत खाते 38 बिडीसीसी बँक कोटा</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_1_balance_tb" value="{{ $clientInputs['bank_1_balance_tb'] ?? '1413346.12' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_1_balance_stmt" value="{{ $clientInputs['bank_1_balance_stmt'] ?? '1413346.12' }}"></td>
                                <td><input type="text" class="form-control" name="bank_1_diff" value="{{ $clientInputs['bank_1_diff'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="bank_1_remark" value="{{ $clientInputs['bank_1_remark'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>को.ऑफ बँक खाते शाखा अडुळगाव</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_2_balance_tb" value="{{ $clientInputs['bank_2_balance_tb'] ?? '1000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_2_balance_stmt" value="{{ $clientInputs['bank_2_balance_stmt'] ?? '1000' }}"></td>
                                <td><input type="text" class="form-control" name="bank_2_diff" value="{{ $clientInputs['bank_2_diff'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="bank_2_remark" value="{{ $clientInputs['bank_2_remark'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>चालू खाते 3 बिडीसीसी बँक कोटा</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_3_balance_tb" value="{{ $clientInputs['bank_3_balance_tb'] ?? '5792.20' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_3_balance_stmt" value="{{ $clientInputs['bank_3_balance_stmt'] ?? '5792.20' }}"></td>
                                <td><input type="text" class="form-control" name="bank_3_diff" value="{{ $clientInputs['bank_3_diff'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="bank_3_remark" value="{{ $clientInputs['bank_3_remark'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>चालू ठेव खाते 17 को ऑप बँक खाते</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_4_balance_tb" value="{{ $clientInputs['bank_4_balance_tb'] ?? '25175' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_4_balance_stmt" value="{{ $clientInputs['bank_4_balance_stmt'] ?? '25175' }}"></td>
                                <td><input type="text" class="form-control" name="bank_4_diff" value="{{ $clientInputs['bank_4_diff'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="bank_4_remark" value="{{ $clientInputs['bank_4_remark'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>अर्बन बँक पंढरी चालू खाते</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_5_balance_tb" value="{{ $clientInputs['bank_5_balance_tb'] ?? '6342' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_5_balance_stmt" value="{{ $clientInputs['bank_5_balance_stmt'] ?? '6342' }}"></td>
                                <td><input type="text" class="form-control" name="bank_5_diff" value="{{ $clientInputs['bank_5_diff'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="bank_5_remark" value="{{ $clientInputs['bank_5_remark'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>ICICI बँक चालू खाते</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_6_balance_tb" value="{{ $clientInputs['bank_6_balance_tb'] ?? '979.40' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_6_balance_stmt" value="{{ $clientInputs['bank_6_balance_stmt'] ?? '979.40' }}"></td>
                                <td><input type="text" class="form-control" name="bank_6_diff" value="{{ $clientInputs['bank_6_diff'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="bank_6_remark" value="{{ $clientInputs['bank_6_remark'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>बँक ऑफ इंडिया चालू खाते</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_7_balance_tb" value="{{ $clientInputs['bank_7_balance_tb'] ?? '239711.48' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_7_balance_stmt" value="{{ $clientInputs['bank_7_balance_stmt'] ?? '239711.48' }}"></td>
                                <td><input type="text" class="form-control" name="bank_7_diff" value="{{ $clientInputs['bank_7_diff'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="bank_7_remark" value="{{ $clientInputs['bank_7_remark'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_total_balance_tb" value="{{ $clientInputs['bank_total_balance_tb'] ?? '1692346.20' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="bank_total_balance_stmt" value="{{ $clientInputs['bank_total_balance_stmt'] ?? '1692346.20' }}"></td>
                                <td><input type="text" class="form-control" name="bank_total_diff" value="{{ $clientInputs['bank_total_diff'] ?? '' }}"></td>
                                <td><input type="text" class="form-control" name="bank_total_remark" value="{{ $clientInputs['bank_total_remark'] ?? '' }}"></td>
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
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:160px;display:inline;" name="investment_total" value="{{ $clientInputs['investment_total'] ?? '12160685.00' }}"></span>
                </div>
                <div class="mb-2">
                    <span style="font-weight:bold;">दि. 31/03/{{ $end }} अखेर संस्थेने खालीलप्रमाणे गुंतवणूक केलेली आहे.</span>
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
                            <tr>
                                <td>1</td>
                                <td>को ऑप बँक कोटा आवर्तठेव</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_1_2023" value="{{ $clientInputs['inv_1_2023'] ?? '1800000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_1_2024" value="{{ $clientInputs['inv_1_2024'] ?? '00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_1_diff" value="{{ $clientInputs['inv_1_diff'] ?? '-1800000-Down' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_1_percent" value="{{ $clientInputs['inv_1_percent'] ?? '-100%' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>महाराष्ट्र गुंतवणूक</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_2_2023" value="{{ $clientInputs['inv_2_2023'] ?? '200000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_2_2024" value="{{ $clientInputs['inv_2_2024'] ?? '200000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_2_diff" value="{{ $clientInputs['inv_2_diff'] ?? '0-Equal' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_2_percent" value="{{ $clientInputs['inv_2_percent'] ?? '0%' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>श्रीराम फिनान्स</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_3_2023" value="{{ $clientInputs['inv_3_2023'] ?? '00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_3_2024" value="{{ $clientInputs['inv_3_2024'] ?? '300000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_3_diff" value="{{ $clientInputs['inv_3_diff'] ?? '300000-Up' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_3_percent" value="{{ $clientInputs['inv_3_percent'] ?? '00.00%' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>कर्मचारी कल्याण निधी</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_4_2023" value="{{ $clientInputs['inv_4_2023'] ?? '242749' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_4_2024" value="{{ $clientInputs['inv_4_2024'] ?? '255979' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_4_diff" value="{{ $clientInputs['inv_4_diff'] ?? '13230-Up' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_4_percent" value="{{ $clientInputs['inv_4_percent'] ?? '5.45%' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>कर्मचारी ग्रॅच्युइटी निधी</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_5_2023" value="{{ $clientInputs['inv_5_2023'] ?? '366222' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_5_2024" value="{{ $clientInputs['inv_5_2024'] ?? '386181' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_5_diff" value="{{ $clientInputs['inv_5_diff'] ?? '19959-Up' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_5_percent" value="{{ $clientInputs['inv_5_percent'] ?? '5.45%' }}"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>नि.नि.एजंट सुरक्षा निधी</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_6_2023" value="{{ $clientInputs['inv_6_2023'] ?? '664410' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_6_2024" value="{{ $clientInputs['inv_6_2024'] ?? '700620' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_6_diff" value="{{ $clientInputs['inv_6_diff'] ?? '36210-Up' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_6_percent" value="{{ $clientInputs['inv_6_percent'] ?? '5.45%' }}"></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>बीडीसीसी बँक</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_7_2023" value="{{ $clientInputs['inv_7_2023'] ?? '8000000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_7_2024" value="{{ $clientInputs['inv_7_2024'] ?? '8473500' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_7_diff" value="{{ $clientInputs['inv_7_diff'] ?? '473500-Up' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_7_percent" value="{{ $clientInputs['inv_7_percent'] ?? '5.92%' }}"></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>राखीव निधी गुंतवणूक</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_8_2023" value="{{ $clientInputs['inv_8_2023'] ?? '1711061' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_8_2024" value="{{ $clientInputs['inv_8_2024'] ?? '1804314' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_8_diff" value="{{ $clientInputs['inv_8_diff'] ?? '93253-Up' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_8_percent" value="{{ $clientInputs['inv_8_percent'] ?? '5.45%' }}"></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>अर्बन बँक पंढरी</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_9_2023" value="{{ $clientInputs['inv_9_2023'] ?? '13091' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_9_2024" value="{{ $clientInputs['inv_9_2024'] ?? '13091' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_9_diff" value="{{ $clientInputs['inv_9_diff'] ?? '0-Equal' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_9_percent" value="{{ $clientInputs['inv_9_percent'] ?? '0%' }}"></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>शेअर्स</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_10_2023" value="{{ $clientInputs['inv_10_2023'] ?? '27000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_10_2024" value="{{ $clientInputs['inv_10_2024'] ?? '27000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_10_diff" value="{{ $clientInputs['inv_10_diff'] ?? '0-Equal' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_10_percent" value="{{ $clientInputs['inv_10_percent'] ?? '0%' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_total_2023" value="{{ $clientInputs['inv_total_2023'] ?? '13024533.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_total_2024" value="{{ $clientInputs['inv_total_2024'] ?? '12160685.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="inv_total_diff" value="{{ $clientInputs['inv_total_diff'] ?? '-863848.00' }}"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                    <ol class="mb-2" style="padding-left: 20px;">
                        <li>संस्थेने केलेल्या सर्व गुंतवणूक यादीनुसार गुंतवणूक रक्कम जुळत आहे -
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
                        </li>
                        <li>राखीव निधी, इमारत निधी व इतर कायदेशीर निधीची स्वतंत्र गुंतवणूक केलेली आहे -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="statutory_funds_invested">
                                <option value="आहे" {{ (isset($clientInputs['statutory_funds_invested']) && $clientInputs['statutory_funds_invested'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['statutory_funds_invested']) && $clientInputs['statutory_funds_invested'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>निधीचे व्यवस्थापन योग्यरीत्या केले आहे -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="fund_management_proper">
                                <option value="आहे" {{ (isset($clientInputs['fund_management_proper']) && $clientInputs['fund_management_proper'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['fund_management_proper']) && $clientInputs['fund_management_proper'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>तत्संबंधित केलेली गुंतवणूक किमती आहे का, ती नियमावली प्रमाणे तपशील नमूद करावा -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="investment_valued_as_per_rules">
                                <option value="आहे" {{ (isset($clientInputs['investment_valued_as_per_rules']) && $clientInputs['investment_valued_as_per_rules'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['investment_valued_as_per_rules']) && $clientInputs['investment_valued_as_per_rules'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>गुंतवणूक प्रमाणपत्रे नियमानुसार पुर्ण प्रमाणात आहेत -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;" name="investment_certificates_compliant">
                                <option value="आहे" {{ (isset($clientInputs['investment_certificates_compliant']) && $clientInputs['investment_certificates_compliant'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['investment_certificates_compliant']) && $clientInputs['investment_certificates_compliant'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>सध्या नागरी सहकारी बँक/सेंट्रल/डिस्ट्रिक्ट बँके व्यतिरिक्त अन्य कुठे गुंतवणूक केली असल्यास/त्याबाबत तपशील नमूद करावा.</li>
                        <li> गुंतवणूक खेळत्या भांडवलाशी असल्याचे प्रमाण नमूद करावे. <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="investment_to_working_capital_ratio" value="{{ $clientInputs['investment_to_working_capital_ratio'] ?? '' }}">
                        </li>
                    </ol>
                </div>
                <span>(टिप - अवसायनातील बँकां/संस्थांमध्ये गुंतवणूक असल्यास त्याबाबत स्वतंत्र अभिप्राय नमुद करावेत.)</span>
                <!-- END: गुंतवणूक (Investment) Section -->

                <!-- START: कर्ज (Loan) Section as per pasted image -->
                <div class="mt-4 mb-2">
                    <span class="fw-bold" style="font-size: 1.1em;">4. कर्जे :-</span>
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:160px;display:inline;" name="loan_total" value="{{ $clientInputs['loan_total'] ?? '90779408.00' }}"></span>
                </div>
                <div class="mb-2">
                    <span style="font-weight:bold;background:yellow;">दि. 31/03/{{ $end }} अखेर संस्थेस खालीलप्रमाणे कर्ज येणे आहे.</span>
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
                            <tr>
                                <td>1</td>
                                <td>मध्यम मुदत कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_1_last" value="{{ $clientInputs['loan_1_last'] ?? '64149472' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_1_current" value="{{ $clientInputs['loan_1_current'] ?? '74024521' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_1_diff" value="{{ $clientInputs['loan_1_diff'] ?? '9875049-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>सोने तारण</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_2_last" value="{{ $clientInputs['loan_2_last'] ?? '6467046' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_2_current" value="{{ $clientInputs['loan_2_current'] ?? '7638391' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_2_diff" value="{{ $clientInputs['loan_2_diff'] ?? '1171345-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>आकस्मिक कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_3_last" value="{{ $clientInputs['loan_3_last'] ?? '940495' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_3_current" value="{{ $clientInputs['loan_3_current'] ?? '1041105' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_3_diff" value="{{ $clientInputs['loan_3_diff'] ?? '100610-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>अल्प मुदत कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_4_last" value="{{ $clientInputs['loan_4_last'] ?? '1112011' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_4_current" value="{{ $clientInputs['loan_4_current'] ?? '1244020' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_4_diff" value="{{ $clientInputs['loan_4_diff'] ?? '132009-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>कुटुंब निविदित ठेव तारण कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_5_last" value="{{ $clientInputs['loan_5_last'] ?? '490000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_5_current" value="{{ $clientInputs['loan_5_current'] ?? '700000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_5_diff" value="{{ $clientInputs['loan_5_diff'] ?? '210000-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>मुदत ठेव तारण</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_6_last" value="{{ $clientInputs['loan_6_last'] ?? '752610' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_6_current" value="{{ $clientInputs['loan_6_current'] ?? '1664431' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_6_diff" value="{{ $clientInputs['loan_6_diff'] ?? '911821-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>नियमानुसार ठेव तारण कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_7_last" value="{{ $clientInputs['loan_7_last'] ?? '1907984' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_7_current" value="{{ $clientInputs['loan_7_current'] ?? '3205950' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_7_diff" value="{{ $clientInputs['loan_7_diff'] ?? '1297966-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>दाम दिप्पट ठेव तारण कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_8_last" value="{{ $clientInputs['loan_8_last'] ?? '12000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_8_current" value="{{ $clientInputs['loan_8_current'] ?? '12000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_8_diff" value="{{ $clientInputs['loan_8_diff'] ?? '0-Equal' }}"></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>दामदुप्पट ठेव तारण कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_9_last" value="{{ $clientInputs['loan_9_last'] ?? '1161000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_9_current" value="{{ $clientInputs['loan_9_current'] ?? '712790' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_9_diff" value="{{ $clientInputs['loan_9_diff'] ?? '-448210-Down' }}"></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>दाम चौपट ठेव तारण कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_10_last" value="{{ $clientInputs['loan_10_last'] ?? '46000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_10_current" value="{{ $clientInputs['loan_10_current'] ?? '26000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_10_diff" value="{{ $clientInputs['loan_10_diff'] ?? '-20000-Down' }}"></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>इतर कर्जे</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_11_last" value="{{ $clientInputs['loan_11_last'] ?? '0' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_11_current" value="{{ $clientInputs['loan_11_current'] ?? '20000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_11_diff" value="{{ $clientInputs['loan_11_diff'] ?? '20000-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>आवर्त ठेव तारण</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_12_last" value="{{ $clientInputs['loan_12_last'] ?? '129100' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_12_current" value="{{ $clientInputs['loan_12_current'] ?? '310200' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_12_diff" value="{{ $clientInputs['loan_12_diff'] ?? '181100-Up' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_total_last" value="{{ $clientInputs['loan_total_last'] ?? '77167718.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_total_current" value="{{ $clientInputs['loan_total_current'] ?? '90779408.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="loan_total_diff" value="{{ $clientInputs['loan_total_diff'] ?? '13611690.00' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                    कर्जाची तुलनात्मक आकडेवारी पाहता अहवाल सालात कर्जात रु.
                    <span style="background: yellow; font-weight:bold;">
                        <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="loan_total_diff_text" value="{{ $clientInputs['loan_total_diff_text'] ?? '13611690.00' }}">
                    </span>
                    वाढ झाली आहे. लेखापरीक्षण कालावधीत कर्जाचा व्याजदर
                    <span style="background: yellow; font-weight:bold;">
                        <input type="text" class="form-control d-inline-block" style="width:80px;display:inline;" name="loan_interest_rate" value="{{ $clientInputs['loan_interest_rate'] ?? '11 to 13%' }}">
                    </span>
                    आकारला आहे. सेवक कर्जाचा
                    <span style="background: yellow; font-weight:bold;">
                        <input type="text" class="form-control d-inline-block" style="width:60px;display:inline;" name="employee_loan_interest_rate" value="{{ $clientInputs['employee_loan_interest_rate'] ?? '12%' }}">
                    </span>
                    व्याज आकारणी केली आहे. संस्थेचे कामकाज संगणकीकृत असल्याने कर्जे यादया संगणक प्रणालीद्वारे काढलेल्या
                    <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="loan_list_computerized">
                        <option value="आहे" {{ (isset($clientInputs['loan_list_computerized']) && $clientInputs['loan_list_computerized'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                        <option value="नाही" {{ (isset($clientInputs['loan_list_computerized']) && $clientInputs['loan_list_computerized'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                    </select>
                    . ताळेबंदाशी कर्जे यादया जुळत
                    <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="loan_list_matches">
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
                    <span style="background: yellow; font-weight:bold;">6. स्थावर व जंगम मालमत्ता: <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="fixed_movable_assets_total" value="{{ $clientInputs['fixed_movable_assets_total'] ?? '9301092.00' }}"></span>
                </div>
                <div class="mb-2">
                    <span style="font-weight:bold;">दि. 31/03/2024 अखेर संस्थेची मालमत्ता खालीलप्रमाणे आहे.</span>
                </div>
                <div>
                    <table class="table table-bordered text-center align-middle" style="min-width:950px;">
                        <thead>
                            <tr>
                                <th style="background: yellow;">अ.क्र.</th>
                                <th style="background: yellow;">मालमत्तेचा तपशील</th>
                                <th style="background: yellow;">दि.31/03/2023 अखेर रक्कम रु.</th>
                                <th style="background: yellow;">दि.31/03/2024 अखेर रक्कम रु.</th>
                                <th style="background: yellow;">वाढ/घट रक्कम रु.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>इमारत खरेदी</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_building_2023" value="{{ $clientInputs['asset_building_2023'] ?? '6530400' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_building_2024" value="{{ $clientInputs['asset_building_2024'] ?? '6692768' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_building_diff" value="{{ $clientInputs['asset_building_diff'] ?? '162368-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>मशिनरी व सॉफ्टवेअर</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_machinery_2023" value="{{ $clientInputs['asset_machinery_2023'] ?? '312434' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_machinery_2024" value="{{ $clientInputs['asset_machinery_2024'] ?? '413444' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_machinery_diff" value="{{ $clientInputs['asset_machinery_diff'] ?? '100910-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>स्टेशनरी स्टॉक</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_stationary_2023" value="{{ $clientInputs['asset_stationary_2023'] ?? '42040' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_stationary_2024" value="{{ $clientInputs['asset_stationary_2024'] ?? '42040' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_stationary_diff" value="{{ $clientInputs['asset_stationary_diff'] ?? '0-Equal' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>ऑफिस फर्निचर</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_furniture_2023" value="{{ $clientInputs['asset_furniture_2023'] ?? '1391880' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_furniture_2024" value="{{ $clientInputs['asset_furniture_2024'] ?? '2152940' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_furniture_diff" value="{{ $clientInputs['asset_furniture_diff'] ?? '761060-Up' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_total_2023" value="{{ $clientInputs['asset_total_2023'] ?? '8276754.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_total_2024" value="{{ $clientInputs['asset_total_2024'] ?? '9301092.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="asset_total_diff" value="{{ $clientInputs['asset_total_diff'] ?? '1024338.00' }}"></td>
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
                            <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="depreciation_applied">
                                <option value="आहे" {{ (isset($clientInputs['depreciation_applied']) && $clientInputs['depreciation_applied'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['depreciation_applied']) && $clientInputs['depreciation_applied'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>
                            संस्थेने अद्यावत मालमत्ता रजिस्टर ठेवलेले आहे का?
                            <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="asset_register_maintained">
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
                            <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="member_asset_loss_applied">
                                <option value="आहे" {{ (isset($clientInputs['member_asset_loss_applied']) && $clientInputs['member_asset_loss_applied'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['member_asset_loss_applied']) && $clientInputs['member_asset_loss_applied'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                    </ol>
                </div>
                <div class="mb-2">
                    <span class="fw-bold">8. इतर येणे :-</span>
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="other_receivable" value="{{ $clientInputs['other_receivable'] ?? '174945.00' }}"></span>
                </div>
                <div class="mb-2">
                    दि. <span style="background: yellow;">31/03/{{ $end }}</span> अखेर संस्थेस खालीलप्रमाणे इतर रक्कम येणे आहे.
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
                            <tr>
                                <td>1</td>
                                <td>कार्यालय घसारा अडव्हान्सेस</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_office_adv" value="{{ $clientInputs['other_receivable_office_adv'] ?? '25000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_office_adv_list" value="{{ $clientInputs['other_receivable_office_adv_list'] ?? '' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_office_adv_diff" value="{{ $clientInputs['other_receivable_office_adv_diff'] ?? '25000-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>अभिकर्ता कमिशन अडव्हान्सेस</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_agent_comm" value="{{ $clientInputs['other_receivable_agent_comm'] ?? '24000' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_agent_comm_list" value="{{ $clientInputs['other_receivable_agent_comm_list'] ?? '' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_agent_comm_diff" value="{{ $clientInputs['other_receivable_agent_comm_diff'] ?? '24000-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>टेलीफोन अडव्हान्स</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_telephone" value="{{ $clientInputs['other_receivable_telephone'] ?? '545' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_telephone_list" value="{{ $clientInputs['other_receivable_telephone_list'] ?? '' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_telephone_diff" value="{{ $clientInputs['other_receivable_telephone_diff'] ?? '0-Equal' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>कोर्ट फी खाते</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_court_fee" value="{{ $clientInputs['other_receivable_court_fee'] ?? '125400' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_court_fee_list" value="{{ $clientInputs['other_receivable_court_fee_list'] ?? '' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_court_fee_diff" value="{{ $clientInputs['other_receivable_court_fee_diff'] ?? '125400-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>ठेवी व्याज ठेव खाते</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_deposit_interest" value="{{ $clientInputs['other_receivable_deposit_interest'] ?? '00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_deposit_interest_list" value="{{ $clientInputs['other_receivable_deposit_interest_list'] ?? '' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_deposit_interest_diff" value="{{ $clientInputs['other_receivable_deposit_interest_diff'] ?? '-80-Down' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_total_tb" value="{{ $clientInputs['other_receivable_total_tb'] ?? '174945.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="other_receivable_total_list" value="{{ $clientInputs['other_receivable_total_list'] ?? '' }}"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2">
                    <span class="fw-bold">घेणे व्याज :-</span>
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="interest_receivable" value="{{ $clientInputs['interest_receivable'] ?? '2190404.00' }}"></span>
                </div>
                <div class="mb-2">
                    दि. <span>31/03/{{ $end }}</span> अखेर संस्थेस खालीलप्रमाणे इतर रक्कम घेणे आहे.
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
                            <tr>
                                <td>1</td>
                                <td>घेणे व्याज मध्यम मुदत कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_med_term_tb" value="{{ $clientInputs['int_recv_med_term_tb'] ?? '373442' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_med_term_list" value="{{ $clientInputs['int_recv_med_term_list'] ?? '' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_med_term_diff" value="{{ $clientInputs['int_recv_med_term_diff'] ?? '0-Equal' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>घेणे व्याज कॅ ऑफ गुंतवणूक</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_investment_tb" value="{{ $clientInputs['int_recv_investment_tb'] ?? '1375087' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_investment_list" value="{{ $clientInputs['int_recv_investment_list'] ?? '' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_investment_diff" value="{{ $clientInputs['int_recv_investment_diff'] ?? '145974-Up' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>घेणे व्याज आकस्मिक कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_emergency_tb" value="{{ $clientInputs['int_recv_emergency_tb'] ?? '71598' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_emergency_list" value="{{ $clientInputs['int_recv_emergency_list'] ?? '' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_emergency_diff" value="{{ $clientInputs['int_recv_emergency_diff'] ?? '0-Equal' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>व्याज घेणे अन्य मुदत कर्ज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_other_tb" value="{{ $clientInputs['int_recv_other_tb'] ?? '370277' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_other_list" value="{{ $clientInputs['int_recv_other_list'] ?? '' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_other_diff" value="{{ $clientInputs['int_recv_other_diff'] ?? '0-Equal' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold">एकूण</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_total_tb" value="{{ $clientInputs['int_recv_total_tb'] ?? '2190404.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="int_recv_total_list" value="{{ $clientInputs['int_recv_total_list'] ?? '' }}"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <span class="text-muted">(टीप- संस्था विलिनीकरण केली असल्यास विलिनीकृत संस्थांची येणे रक्कम स्वतंत्र दर्शविण्यात यावी)</span>
                <div class="mt-3 mb-2">
                    <span class="fw-bold" style="font-size: 1.1em;">9. संचीत तोटा : -</span>
                    <span style="background: yellow; font-weight:bold;">रु. <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="accumulated_loss" value="{{ $clientInputs['accumulated_loss'] ?? '0' }}"></span>
                </div>
                <div class="mb-2">
                    सदर बाकी दि.<span style="background: yellow;">31/03/{{ $end }}</span> अखेर ताळेबंदा प्रमाणे असुन मागील वर्षाचा संचीत नफा/तोटा  रु.
                    <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="accumulated_loss_last" value="{{ $clientInputs['accumulated_loss_last'] ?? '0' }}"></span>
                    अधिक/व चालू वर्षाचा नफा/तोटा रु.
                    <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="accumulated_loss_current" value="{{ $clientInputs['accumulated_loss_current'] ?? '0' }}"></span>
                    एकूण संचीत तोटा रु.
                    <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="accumulated_loss_total" value="{{ $clientInputs['accumulated_loss_total'] ?? '0' }}"></span>
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