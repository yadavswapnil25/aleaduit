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
                    if (preg_match('/^(\d{4})-(\d{4})$/', $client->audit_year, $m)) {
                    $start = $m[1];
                    $end = $m[2];
                    $auditPeriod = "01/04/$start - 31/03/$end";
                    } else {
                    $auditPeriod = $client->audit_year;
                    }
                    @endphp
                    संस्थे सत्र दि. <span style="background: yellow; font-weight:bold;">01/04/{{$start}} ते 31/03/{{$end}}</span> या आर्थिक वर्षाचे नफा-तोटा पत्रक विवेचन खालीलप्रमाणे -
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
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_interest_last" value="{{ $clientInputs['pl_interest_last'] ?? '10499477.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_interest_current" value="{{ $clientInputs['pl_interest_current'] ?? '12685419.43' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_interest_diff" value="{{ $clientInputs['pl_interest_diff'] ?? '2185942.43' }}"></td>
                            </tr>
                            <tr>
                                <td>2. गुंतवणुकीवर मिळालेले व्याज <br>
                                    <span style="font-size: 0.95em;">अ) ठेविवरिल व्याज <br> ब) शासकीय कर्ज रोख्यावरिल व्याज</span>
                                </td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_inv_interest_last" value="{{ $clientInputs['pl_inv_interest_last'] ?? '884301.60' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_inv_interest_current" value="{{ $clientInputs['pl_inv_interest_current'] ?? '951072.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_inv_interest_diff" value="{{ $clientInputs['pl_inv_interest_diff'] ?? '66770.40' }}"></td>
                            </tr>
                            <tr>
                                <td>3. इतर उत्पन्न</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_other_income_last" value="{{ $clientInputs['pl_other_income_last'] ?? '509220.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_other_income_current" value="{{ $clientInputs['pl_other_income_current'] ?? '615391.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_other_income_diff" value="{{ $clientInputs['pl_other_income_diff'] ?? '106171.00' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END: नफा-तोटा पत्रक Design -->

                <!-- START: नफा-तोटा पत्रक (खर्च, नफा/तोटा सारांश) Design as per pasted image -->
                <div class="mt-4 mb-2">
                    <table class="table table-bordered text-center align-middle" style="min-width:900px;">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th style="background: yellow;">गत वर्ष अखेर रु.</th>
                                <th style="background: yellow;">चालू वर्ष अखेर रु.</th>
                                <th style="background: yellow;">वाढ/घट</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold" colspan="2" style="text-align:left;">एकूण उत्पन्न</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_total_income_last" value="{{ $clientInputs['pl_total_income_last'] ?? '11892998.6' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_total_income_current" value="{{ $clientInputs['pl_total_income_current'] ?? '14251882.43' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_total_income_diff" value="{{ $clientInputs['pl_total_income_diff'] ?? '2355883.83' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold" rowspan="7" style="vertical-align: middle;">ब</td>
                                <td class="fw-bold" style="text-align:left;">खर्च</td>
                                <td style="background: yellow;">0</td>
                                <td style="background: yellow;">0</td>
                                <td style="background: yellow;">0</td>
                            </tr>
                            <tr>
                                <td>1. ठेविवरिल व्याज</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_deposit_interest_last" value="{{ $clientInputs['pl_exp_deposit_interest_last'] ?? '6517103.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_deposit_interest_current" value="{{ $clientInputs['pl_exp_deposit_interest_current'] ?? '9656462.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_deposit_interest_diff" value="{{ $clientInputs['pl_exp_deposit_interest_diff'] ?? '3139359.00' }}"></td>
                            </tr>
                            <tr>
                                <td>2. स्थापत्याचा खर्च</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_establishment_last" value="{{ $clientInputs['pl_exp_establishment_last'] ?? '663816.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_establishment_current" value="{{ $clientInputs['pl_exp_establishment_current'] ?? '744124.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_establishment_diff" value="{{ $clientInputs['pl_exp_establishment_diff'] ?? '80308.00' }}"></td>
                            </tr>
                            <tr>
                                <td>3. प्रशासकीय खर्च</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_admin_last" value="{{ $clientInputs['pl_exp_admin_last'] ?? '4653511.00' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_admin_current" value="{{ $clientInputs['pl_exp_admin_current'] ?? '3448987.44' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_admin_diff" value="{{ $clientInputs['pl_exp_admin_diff'] ?? '-1204523.56' }}"></td>
                            </tr>
                            <tr>
                                <td>4. तूटपूर्ती</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_deficit_last" value="{{ $clientInputs['pl_exp_deficit_last'] ?? '0' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_deficit_current" value="{{ $clientInputs['pl_exp_deficit_current'] ?? '0' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_deficit_diff" value="{{ $clientInputs['pl_exp_deficit_diff'] ?? '0' }}"></td>
                            </tr>
                            <tr>
                                <td>5. इतर खर्च</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_other_last" value="{{ $clientInputs['pl_exp_other_last'] ?? '0' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_other_current" value="{{ $clientInputs['pl_exp_other_current'] ?? '0' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_exp_other_diff" value="{{ $clientInputs['pl_exp_other_diff'] ?? '0' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold" style="text-align:left;">एकूण खर्च</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_total_exp_last" value="{{ $clientInputs['pl_total_exp_last'] ?? '11834430' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_total_exp_current" value="{{ $clientInputs['pl_total_exp_current'] ?? '13849573.44' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_total_exp_diff" value="{{ $clientInputs['pl_total_exp_diff'] ?? '2015143.44' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold" style="text-align:left;">निव्वळ नफा</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_net_profit_last" value="{{ $clientInputs['pl_net_profit_last'] ?? '58568.6' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_net_profit_current" value="{{ $clientInputs['pl_net_profit_current'] ?? '402308.99' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_net_profit_diff" value="{{ $clientInputs['pl_net_profit_diff'] ?? '343740.39' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold" style="text-align:left;">निव्वळ तोटा</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_net_loss_last" value="{{ $clientInputs['pl_net_loss_last'] ?? '0' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_net_loss_current" value="{{ $clientInputs['pl_net_loss_current'] ?? '0' }}"></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="pl_net_loss_diff" value="{{ $clientInputs['pl_net_loss_diff'] ?? '0' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mb-2" style="font-weight:bold;">
                    लेखापरीक्षण मुदतीत उत्पन्नात रु. <span style="background: yellow;">{{ $clientInputs['pl_total_income_diff'] ?? '2355883.83' }}</span> वाढ/घट झाली आहे. एकूण खर्चात रु. <span style="background: yellow;">{{ $clientInputs['pl_total_exp_diff'] ?? '2015143.44' }}</span> वाढ/घट झाली आहे. निव्वळ नफा रु. <span style="background: yellow;">{{ $clientInputs['pl_net_profit_diff'] ?? '343740.39' }}</span> वाढ/घट झाली आहे. निव्वळ तोटा रु. <span style="background: yellow;">{{ $clientInputs['pl_net_loss_diff'] ?? '0' }}</span> वाढ/घट झाली आहे. अहवाल कालावधीत निव्वळ नफ़्यापुर्वी खर्चाच्या तरतुदी केल्या आहेत.
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
                        <li>खर्चाच्या रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_expense_diff" value="{{ $clientInputs['reason_expense_diff'] ?? '' }}"> तरतूद कमी जास्त केल्या/आहेत.</li>
                        <li>एनपीएची तरतूद रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_npa_diff" value="{{ $clientInputs['reason_npa_diff'] ?? '' }}"> कमी जास्त केल्या/आहे.</li>
                        <li>भांडवली खर्च व <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_capital_expense" value="{{ $clientInputs['reason_capital_expense'] ?? '' }}"> महसूल खर्चात नोंद केला आहे.</li>
                        <li>महसूल रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_revenue" value="{{ $clientInputs['reason_revenue'] ?? '' }}"> भांडवली खर्चात नोंद केला आहे.</li>
                        <li>गावठाणच्या रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_gaothan" value="{{ $clientInputs['reason_gaothan'] ?? '' }}"> खर्च उत्पन्न अहवाल वर्षात जमा/खर्च केला/आहे.</li>
                        <li>गुंतवणूकवरील मिळणारे व्याज रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_investment_interest" value="{{ $clientInputs['reason_investment_interest'] ?? '' }}"> उत्पन्नात घेतले नाही.</li>
                        <li>कर्जावरील वसूल न झालेले व्याज रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_unrealized_loan_interest" value="{{ $clientInputs['reason_unrealized_loan_interest'] ?? '' }}"> उत्पन्नात घेतले आहे.</li>
                        <li>वेविधीतिल व्याज रु. <input type="text" class="form-control d-inline-block" style="width:100px;display:inline;" name="reason_misc_interest" value="{{ $clientInputs['reason_misc_interest'] ?? '' }}"> निदर्श खर्चात घेतले नाही.</li>
                    </ol>
                </div>
                <div class="mb-2">
                    याशिवाय खालीलप्रमाणे अभिप्राय नमुद करावेत.
                </div>
                <div class="mb-2">
                    <ol style="padding-left: 20px;">
                        <li>
                            संस्थेस सर्व कायदेशीर तरतुदी करण्या इतपत रक्कमेचा ढोबळ नफा झालेबाबतचे अभिप्राय नोंदवा -
                            <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="legal_provisions_profit_opinion">
                                <option value="आहे" {{ (isset($clientInputs['legal_provisions_profit_opinion']) && $clientInputs['legal_provisions_profit_opinion'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                <option value="नाही" {{ (isset($clientInputs['legal_provisions_profit_opinion']) && $clientInputs['legal_provisions_profit_opinion'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                            </select>
                        </li>
                        <li>
                            मागील आर्थिक वर्षातील निव्वळ नफयाची कलम ६५ नियम ४९ नुसार पोटनियमाप्रमाणे विविध निधीमध्ये विभागणी करुन लाभांश देण्या इतपत निव्वळ नफा झालेबाबतचा तपशील विषद करा
                            <span style="background: yellow;">लागू नाही</span>
                        </li>
                        <li>
                            संस्थेने लाभांश जर निव्वळ नफ्याच्या १५% पेक्षा जास्त दिलेला असल्यास, त्यास निबंधकाची परवानगी घेतले किंवा कसे याबाबत शेरे नमूद करा -
                            <span style="background: yellow;">लागू नाही</span>
                        </li>
                        <li>
                            चुकीचा नफा दर्शवून अतिरिक्त लाभांश वाटप केलेबाबतचे अभिप्राय द्या. -
                            <span style="background: yellow;">लागू नाही</span>
                        </li>
                        <li>
                            संस्थेस तोटा झालेला आहे काय? असल्यास तोट्यांची कारणमिमांसा नमुद करा -
                            <span style="background: yellow;">लागू नाही</span>
                        </li>
                        <li>
                            संस्थेने सभासदांना निबंधकाच्या परवानगीशिवाय भेट वस्तु दिल्यास त्याबाबत अभिप्राय नमूद करावेत -
                            <span style="background: yellow;">लागू नाही</span>
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
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_share_capital" value="{{ $clientInputs['ratio_share_capital'] ?? '4.53' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>निधी</td>
                                <td>एकूण निधी ÷ खेळते भांडवल x 100</td>
                                <td>4 ते 6</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_fund" value="{{ $clientInputs['ratio_fund'] ?? '6.61' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>ठेवी</td>
                                <td>एकूण ठेवी ÷ खेळते भांडवल x 100</td>
                                <td>80 ते 85</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_deposit" value="{{ $clientInputs['ratio_deposit'] ?? '85.41' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>इतर ठेवी</td>
                                <td>इतर ठेवी ÷ खेळते भांडवल x 100</td>
                                <td>2 ते 3</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_other_deposit" value="{{ $clientInputs['ratio_other_deposit'] ?? '0.03' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>निव्वळ नफा</td>
                                <td>निव्वळ नफा ÷ खेळते भांडवल x 100</td>
                                <td>1 ते 2</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_net_profit" value="{{ $clientInputs['ratio_net_profit'] ?? '0.82' }}"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>रोख व बँकेतील शिल्लक</td>
                                <td>रोख व बँकेतील शिल्लक ÷ खेळते भांडवल x 100</td>
                                <td>2 ते 4</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_cash_bank" value="{{ $clientInputs['ratio_cash_bank'] ?? '2.33' }}"></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>गुंतवणूक</td>
                                <td>गुंतवणूक ÷ खेळते भांडवल x 100</td>
                                <td>25</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_investment" value="{{ $clientInputs['ratio_investment'] ?? '10.36' }}"></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>कर्ज</td>
                                <td>एकूण कर्ज ÷ खेळते भांडवल x 100</td>
                                <td>60 ते 65</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_loan" value="{{ $clientInputs['ratio_loan'] ?? '77.36' }}"></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>इतर येणे</td>
                                <td>इतर येणे ÷ खेळते भांडवल x 100</td>
                                <td>6</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_other_receivable" value="{{ $clientInputs['ratio_other_receivable'] ?? '0.15' }}"></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>एकूण उत्पन्न</td>
                                <td>एकूण उत्पन्न ÷ खेळते भांडवल x 100</td>
                                <td>10 ते 12</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_total_income" value="{{ $clientInputs['ratio_total_income'] ?? '12.15' }}"></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>व्यवस्थापन खर्च</td>
                                <td>व्यवस्थापन खर्च ÷ खेळते भांडवल x 100</td>
                                <td>2</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_management_exp" value="{{ $clientInputs['ratio_management_exp'] ?? '3.57' }}"></td>
                            </tr>
                            <tr class="fw-bold">
                                <td colspan="5" style="text-align:left;">ब) एकूण उत्पन्नाशी प्रमाण</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>निव्वळ नफ्याचे</td>
                                <td>निव्वळ नफा ÷ एकूण उत्पन्न x 100</td>
                                <td>10</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_net_profit_to_income" value="{{ $clientInputs['ratio_net_profit_to_income'] ?? '2.82' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>व्यवस्थापन खर्चाचे</td>
                                <td>व्यवस्थापन खर्च ÷ एकूण उत्पन्न x 100</td>
                                <td>30 ते 35</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_management_exp_to_income" value="{{ $clientInputs['ratio_management_exp_to_income'] ?? '29.42' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>आस्थापना खर्च</td>
                                <td>आस्थापना खर्च ÷ एकूण उत्पन्न x 100</td>
                                <td>20 ते 25</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_establishment_exp_to_income" value="{{ $clientInputs['ratio_establishment_exp_to_income'] ?? '5.22' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>दिलेल्या व्याजाचे</td>
                                <td>दिलेल्या व्याज ÷ एकूण उत्पन्न x 100</td>
                                <td>50 ते 55</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_interest_paid_to_income" value="{{ $clientInputs['ratio_interest_paid_to_income'] ?? '67.76' }}"></td>
                            </tr>
                            <tr class="fw-bold">
                                <td colspan="5" style="text-align:left;">क) अन्य प्रमाणके</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>ठेवीवरील दिलेल्या व्याजाचे प्रमाण</td>
                                <td>ठेवीवरील दिलेले व्याज ÷ कर्जावरील दिलेले व्याज x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_interest_paid_on_deposit" value="{{ $clientInputs['ratio_interest_paid_on_deposit'] ?? '76.12' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>एकूण उत्पन्नातील प्रमाण</td>
                                <td>नफा ÷ उत्पन्न x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_profit_to_income" value="{{ $clientInputs['ratio_profit_to_income'] ?? '2.82' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>निव्वळ नफ्याची सरासरी</td>
                                <td>निव्वळ नफा ÷ सरासरी खेळते x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_avg_net_profit" value="{{ $clientInputs['ratio_avg_net_profit'] ?? '0.11' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>खेळत्या भागभांडवलाशी प्रमाण</td>
                                <td>निव्वळ नफा ÷ सरासरी खेळते भांडवल x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_net_profit_to_avg_working_capital" value="{{ $clientInputs['ratio_net_profit_to_avg_working_capital'] ?? '4.11' }}"></td>
                            </tr>
                            <!-- START: Additional Ratios as per pasted image -->
                            <tr>
                                <td>5</td>
                                <td>नफााचे कर्ज + गुंतवणूकशी प्रमाण</td>
                                <td></td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_profit_loan_investment" value="{{ $clientInputs['ratio_profit_loan_investment'] ?? '0.39' }}"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>व्यवस्थापन खर्चाचे खेळत्या भांडवलाशी प्रमाण</td>
                                <td>व्यवस्थापन खर्च ÷ खेळते भांडवल x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_management_exp_working_capital" value="{{ $clientInputs['ratio_management_exp_working_capital'] ?? '3.57' }}"></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>मुदत ठेवीचे एकूण ठेवीशी प्रमाण</td>
                                <td>मुदत ठेवी (बचत व चालू ठेवी वगळून) ÷ एकूण ठेवी x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_term_deposit_total" value="{{ $clientInputs['ratio_term_deposit_total'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>सरासरी ठेवी वाढीचे प्रमाण</td>
                                <td>गतवर्षातील ठेवी ÷ सरासरी ठेवी x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_avg_deposit_growth" value="{{ $clientInputs['ratio_avg_deposit_growth'] ?? '15.47' }}"></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>स्वनिधीचे खेळत्या भांडवलाशी प्रमाण</td>
                                <td>स्वनिधी ÷ खेळते भांडवल x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_own_fund_working_capital" value="{{ $clientInputs['ratio_own_fund_working_capital'] ?? '8.25' }}"></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>सभासद वाढीचे प्रमाण</td>
                                <td>चालू वर्षातील सभासद संख्या - गत वर्षातील सभासद संख्या ÷ गत वर्षातील सभासद संख्या x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_member_growth" value="{{ $clientInputs['ratio_member_growth'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>एककांची कर्जविषयी प्रमाण</td>
                                <td>थकबाकी ÷ एकूण कर्ज x 100</td>
                                <td></td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_overdue_to_loan" value="{{ $clientInputs['ratio_overdue_to_loan'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>सी डी रेशो</td>
                                <td>एकूण कर्ज - उपलब्ध निधी ÷ ठेवी x 100</td>
                                <td>65 ते 70</td>
                                <td style="background: yellow;"><input type="text" class="form-control" name="ratio_cd" value="{{ $clientInputs['ratio_cd'] ?? '88.19' }}"></td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>ठेवी अनुज्ञात जिद्दीची प्रमाण</td>
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
                        <span style="font-weight:bold;">1. पत्र ठेवी प्रमाण (सी डी रेशो): <span style="background: yellow;">{{ $clientInputs['ratio_cd'] ?? '88.19' }}</span></span>
                    </div>
                </div>
                <!-- END: आर्थिक प्रमाणके Design -->

                <!-- START: NPA सारांश व प्रमाणे Design as per pasted image -->
                <div class="mb-4">
                    <span class="fw-bold">5. एन.पी.ए. सारांश व प्रमाणे :</span>
                    <div class="mb-2">
                        अहवाल वर्षअखेर एकूण <span style="background: yellow;">{{ $clientInputs['loan_total'] ?? '90779408' }}</span> कर्जे त्यातील एनपीएमध्ये असलेली कर्जे येणे बाकी <span style="background: yellow;">{{ $clientInputs['npa_total_loan'] ?? '55782120' }}</span> आहे. व त्यावरील संस्थेने रु. <span style="background: yellow;">{{ $clientInputs['npa_total_prov_amt'] ?? '39349726.5' }}</span> तरतूद करणे आवश्यक असताना प्रत्यक्षात रु. <span style="background: yellow;">{{ $clientInputs['npa_total_inst_prov'] ?? '661335' }}</span> तरतूद केली आहे. म्हणजेच रु. <span style="background: yellow;">{{ $clientInputs['npa_total_less_more'] ?? '38688391.5' }}</span> कमी तरतूद केली आहे.
                    </div>
                    <div class="mb-2">
                        (टिप - लेखापरीक्षकाने संस्थेने दिलेले अनुत्पादक कर्जाचे जंबोली तपासून प्रमाणित करून स्वतंत्र रित्या लेखापरीक्षण अहवालासोबत जोडण्यात यावी)
                    </div>
                    <div class="mb-2">
                        <span class="fw-bold">4. एन.पी.ए. प्रमाण ए ची तरतूद केले. सी.एल.एन -
                            <span style="background: #00ff00; font-weight:bold;">
                                <select class="form-control d-inline-block" style="width:80px;display:inline;background: #00ff00;" name="npa_provision_cln">
                                    <option value="नाही" {{ (isset($clientInputs['npa_provision_cln']) && $clientInputs['npa_provision_cln'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    <option value="आहे" {{ (isset($clientInputs['npa_provision_cln']) && $clientInputs['npa_provision_cln'] == 'आहे') ? 'selected' : '' }}>आहे</option>
                                </select>
                            </span>
                        </span>
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
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="npa_summary_total_loan" value="{{ $clientInputs['npa_summary_total_loan'] ?? '90779408' }}"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>थकबाकी एनपीए</td>
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="npa_summary_overdue_npa" value="{{ $clientInputs['npa_summary_overdue_npa'] ?? '55782120' }}"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>येणे व्याज</td>
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="npa_summary_interest_due" value="{{ $clientInputs['npa_summary_interest_due'] ?? '0' }}"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>तरतूद</td>
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="npa_summary_provision" value="{{ $clientInputs['npa_summary_provision'] ?? '661335' }}"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>निव्वळ कर्ज (1-3-4)</td>
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="npa_summary_net_loan" value="{{ $clientInputs['npa_summary_net_loan'] ?? '90118073' }}"></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>निव्वळ एनपीए (2-3-4)</td>
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="npa_summary_net_npa" value="{{ $clientInputs['npa_summary_net_npa'] ?? '55120785' }}"></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>थकबाकी एनपीए टक्केवारी (2/1x100)</td>
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="npa_summary_overdue_npa_percent" value="{{ $clientInputs['npa_summary_overdue_npa_percent'] ?? '61.45' }}"></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>निव्वळ एनपीए टक्केवारी (6/5x100)</td>
                                    <td></td>
                                    <td style="background: yellow;"><input type="text" class="form-control" name="npa_summary_net_npa_percent" value="{{ $clientInputs['npa_summary_net_npa_percent'] ?? '61.17' }}"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mb-2">
                        <span>
                            दि. 31/03/2023 (गतवर्षी)अखेर थकबाकी एनपीए प्रमाण <span style="background: yellow;">{{ $clientInputs['npa_last_year_overdue_percent'] ?? '55.87' }}</span> % व निव्वळ एनपीए प्रमाण <span style="background: yellow;">{{ $clientInputs['npa_last_year_net_percent'] ?? '54.36' }}</span> % होते. तर दि. 31/03/2024 (चालूवर्षी)अखेर थकबाकी एनपीए प्रमाण <span style="background: yellow;">{{ $clientInputs['npa_this_year_overdue_percent'] ?? '61.44' }}</span> % व निव्वळ एनपीए प्रमाण <span style="background: yellow;">{{ $clientInputs['npa_this_year_net_percent'] ?? '61.17' }}</span> % आहे. सदरचे प्रमाण आहे.
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