@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet Two</h4>
                <div>
                    <!-- <button class="btn btn-success">Save</button> -->
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
            <center>
                <h2>नमुना क्र. ८ </h2>
                <h2>लेखापरीक्षण अहवाल (वेतनदारांच्या सहकारी संस्था) </h2>
                <h2>विभाग दुसरा</h2>
            </center>
            <hr>
            <form action="{{ route('admin.client.saveInputs', $client->id) }}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>अ. क्र.</th>
                            <th>ठेवी आणि वर्गण्या :-</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>(अ) पोटनियमातील तरतुदी प्रमाणे वेतन आणि मजुरी यातुन ठेवी
                                आणि वर्गण्यांची कपात करतात काय ?</td>
                            <td>

                                <select class="form-control" name="deposits_deductions_b" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['deposits_deductions_b']) && $clientInputs['deposits_deductions_b'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['deposits_deductions_b']) && $clientInputs['deposits_deductions_b'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(ब) वर्गण्याचे नियमितपणे भागात रूपांतर केले जात आहे काय?</td>
                            <td>
                                <select class="form-control" name="transformation_regular" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['transformation_regular']) && $clientInputs['transformation_regular'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['transformation_regular']) && $clientInputs['transformation_regular'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(क) ठेवींच्या व्यवहार चालविण्यासाठी स्वतंत्र नियम तयार केले
                                आहे काय?</td>
                            <td> <select class="form-control" name="separate_rules_deposits" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['separate_rules_deposits']) && $clientInputs['separate_rules_deposits'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['separate_rules_deposits']) && $clientInputs['separate_rules_deposits'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(ड) त्याचे योग्य रितीने अनुपालन होत आहे काय ?</td>
                            <td> <select class="form-control" name="compliance_properly" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['compliance_properly']) && $clientInputs['compliance_properly'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['compliance_properly']) && $clientInputs['compliance_properly'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(ई) बिगर सभासदांकडुन काही ठेवी स्विकारल्या आहे काय?
                                असल्यास, बँक विनीयतनाबाबदच्या कायद्यातील तरतुदीचे पालन होत आहे काय ? ते पहा</td>
                            </td>
                            <td> <select class="form-control" name="deposits_from_non_members" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['deposits_from_non_members']) && $clientInputs['deposits_from_non_members'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['deposits_from_non_members']) && $clientInputs['deposits_from_non_members'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>व्यक्तीगत खात्यातील बाक्या सर्वसाधारण खाता वहीतील एकदंर
                                खात्याशी जुळतात काय?</td>
                            <td>

                                <select class="form-control" name="personal_account_match_2" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['personal_account_match_2']) && $clientInputs['personal_account_match_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['personal_account_match_2']) && $clientInputs['personal_account_match_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="personal_account_match" value="{{ isset($clientInputs['personal_account_match']) ? $clientInputs['personal_account_match'] : '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>ठेवीची देय काल नोंदवही ठेवली आहे काय? आणि ठेवीची
                                परतफेड वक्तशिरपणे करण्यात येत आहे काय?</td>
                            <td> <select class="form-control" name="timely_repayment_deposits" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['timely_repayment_deposits']) && $clientInputs['timely_repayment_deposits'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['timely_repayment_deposits']) && $clientInputs['timely_repayment_deposits'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="timely_repayment_deposits_2" value="{{ isset($clientInputs['timely_repayment_deposits_2']) ? $clientInputs['timely_repayment_deposits_2'] : '' }}">
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>ठेवीपोटी कर्जावु रकमा देण्यात येतात तेव्हा पोटनियम आणि त्या
                                कारणासाठी तयार केलेले नियमानुसार त्या काटेकोरपणे दिलेल्या
                                आहे काय?</td>
                            <td>

                                <select class="form-control" name="loan_disbursement_compliance_2" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_disbursement_compliance_2']) && $clientInputs['loan_disbursement_compliance_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_disbursement_compliance_2']) && $clientInputs['loan_disbursement_compliance_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_disbursement_compliance" value="{{ isset($clientInputs['loan_disbursement_compliance']) ? $clientInputs['loan_disbursement_compliance'] : '' }}">

                            </td>

                        </tr>
                        <tr>
                            <td>5</td>
                            <td>ठेव खात्यात दाखविल्या रकमावरील व्याजाची आकारणी
                                पडताळून पहा. जर या तपासण्या शेकडेवारी पध्दतीवर केल्या
                                असतील तर त्याचे शेकडा प्रमाण लिहा.</td>
                            <td> <input type="text" class="form-control" name="interest_calculation" value="{{ isset($clientInputs['interest_calculation']) ? $clientInputs['interest_calculation'] : '' }}"></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>चल संपत्ती व व्यापार :-</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1)</td>
                            <td>अ) चल संपत्ती (फल्युईड रिसोसेस) तरतुद पुरेशी ठेवली आहे
                                काय?</td>
                            <td>

                                <select class="form-control" name="current_assets_1_2" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['current_assets_1_2']) && $clientInputs['current_assets_1_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['current_assets_1_2']) && $clientInputs['current_assets_1_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="current_assets_1" value="{{ isset($clientInputs['current_assets_1']) ? $clientInputs['current_assets_1'] : '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>अ) चल संपत्ती दैनदिन वा साप्ताहिक पध्दतीवर ठेवली आहे
                                काय ते लिहा.</td>
                            <td>

                                <select class="form-control" name="current_assets_2_2" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['current_assets_2_2']) && $clientInputs['current_assets_2_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['current_assets_2_2']) && $clientInputs['current_assets_2_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="current_assets_2" value="{{ isset($clientInputs['current_assets_2']) ? $clientInputs['current_assets_2'] : '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ब) संस्थेची चल संपत्ती आणि सांपत्तिक स्थिती दर्शविणारी
                                माहिती समक्ष अधिकारी यांना योग्य वेळेत पाठविण्यात आली आहे काय?
                            </td>
                            <td> <select class="form-control" name="financial_info_timely" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['financial_info_timely']) && $clientInputs['financial_info_timely'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['financial_info_timely']) && $clientInputs['financial_info_timely'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>लेखापरीक्षण काळात भांडवलाच्या तरतुदीत काही कमतरता
                                आढळल्या आहेत काय? असल्यास, सर्वसाधारण अभिप्राय व्यक्त
                                करा.</td>
                            <td><input type="text" class="form-control" name="capital_shortfall" value="{{ isset($clientInputs['capital_shortfall']) ? $clientInputs['capital_shortfall'] : '' }}"></td>
                        </tr>
                        <tr>
                            <td>4)</td>
                            <td>निबंधकांनी घालुन दिलेल्या प्रमाणशिर विचार करता संस्था
                                जास्त व्यवहार (ओव्हर ट्रेडीग) करते काय? असल्यास जास्तीच्या
                                व्यवहाराची मर्यादा लिहा.</td>
                            <td>

                                <select class="form-control" name="over_trading" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['over_trading']) && $clientInputs['over_trading'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['over_trading']) && $clientInputs['over_trading'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="over_trading_limit" value="{{ isset($clientInputs['over_trading_limit']) ? $clientInputs['over_trading_limit'] : '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>बाहेरील कर्ज :-</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>जिल्हा सहकारी बँकेने वा शासनाने विविध कारणांच्या
                                योजनेखाली दिलेले कर्ज अथवा पतमर्यादा यांच्या रकमा कशा
                                आहेत? पुढिल प्रमाणे माहिती लिहा.</td>
                            <td>

                                <select class="form-control" name="external_loan_1_2" >
                                    <option value="" selected >Select</option>
                                    <option value="लागु नाही" {{ (isset($clientInputs['external_loan_1_2']) && $clientInputs['external_loan_1_2'] == 'लागु नाही') ? 'selected' : '' }}>लागु नाही</option>

                                    <option value="होय" {{ (isset($clientInputs['external_loan_1_2']) && $clientInputs['external_loan_1_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['external_loan_1_2']) && $clientInputs['external_loan_1_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="external_loan_1" value="{{ isset($clientInputs['external_loan_1']) ? $clientInputs['external_loan_1'] : '' }}">

                            </td>

                        </tr>
                        <tr>

                            <td></td>
                            <td>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>अ. क.</th>
                                            <th>पतमयादेचे प्रकार</th>
                                            <th>कारण</th>
                                            <th>मंजूर रक्कम</th>
                                            <th>परतफेडीचा निधारीत दि.</th>
                                            <th>उचललेली बाकी</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Row 1 -->
                                        <tr>
                                            <td class="green-cell">1</td>
                                            <td class="green-cell">2</td>
                                            <td class="green-cell">3</td>
                                            <td class="green-cell">4</td>
                                            <td class="green-cell">5</td>
                                            <td class="green-cell">6</td>
                                        </tr>
                                        <tr>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row1_col1" value="{{ isset($clientInputs['annex11_row1_col1']) ? $clientInputs['annex11_row1_col1'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row1_col2" value="{{ isset($clientInputs['annex11_row1_col2']) ? $clientInputs['annex11_row1_col2'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row1_col3" value="{{ isset($clientInputs['annex11_row1_col3']) ? $clientInputs['annex11_row1_col3'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row1_col4" value="{{ isset($clientInputs['annex11_row1_col4']) ? $clientInputs['annex11_row1_col4'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex1_row1_col5" value="{{ isset($clientInputs['annex11_row1_col5']) ? $clientInputs['annex11_row1_col5'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row1_col6" value="{{ isset($clientInputs['annex11_row1_col6']) ? $clientInputs['annex11_row1_col6'] : '' }}"></td>
                                        </tr>
                                        <tr>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row2_col1" value="{{ isset($clientInputs['annex11_row2_col1']) ? $clientInputs['annex11_row2_col1'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row2_col2" value="{{ isset($clientInputs['annex11_row2_col2']) ? $clientInputs['annex11_row2_col2'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row2_col3" value="{{ isset($clientInputs['annex11_row2_col3']) ? $clientInputs['annex11_row2_col3'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row2_col4" value="{{ isset($clientInputs['annex11_row2_col4']) ? $clientInputs['annex11_row2_col4'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row2_col5" value="{{ isset($clientInputs['annex11_row2_col5']) ? $clientInputs['annex11_row2_col5'] : '' }}"></td>
                                            <td class="green-cell"><input type="text" class="form-control" name="annex11_row2_col6" value="{{ isset($clientInputs['annex11_row2_col6']) ? $clientInputs['annex11_row2_col6'] : '' }}"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>संस्थेने मिळविलेल्या कर्जाचा आणि पत मर्यादेचा व्यवहार समाधानकारक आहे काय?</td>
                            <td>

                                <select class="form-control" name="external_loan_2_2" >
                                    <option value="" selected >Select</option>
                                    <option value="लागु नाही" {{ (isset($clientInputs['external_loan_2_2']) && $clientInputs['external_loan_2_2'] == 'लागु नाही') ? 'selected' : '' }}>लागु नाही</option>

                                    <option value="होय" {{ (isset($clientInputs['external_loan_2_2']) && $clientInputs['external_loan_2_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['external_loan_2_2']) && $clientInputs['external_loan_2_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="external_loan_2" value="{{ isset($clientInputs['external_loan_2']) ? $clientInputs['external_loan_2'] : '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>कर्ज वेळेवर परत केले जातात काय ?</td>
                            <td> <select class="form-control" name="repayment_timeliness" >
                                    <option value="" selected >Select</option>
                                    <option value="लागु नाही" {{ (isset($clientInputs['repayment_timeliness']) && $clientInputs['repayment_timeliness'] == 'लागु नाही') ? 'selected' : '' }}>लागु नाही</option>

                                    <option value="होय" {{ (isset($clientInputs['repayment_timeliness']) && $clientInputs['repayment_timeliness'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['repayment_timeliness']) && $clientInputs['repayment_timeliness'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>4)</td>
                            <td>कर्जाकरीता दिलेले नियम व्यवस्थित वाचलेले आहेत काय?</td>
                            <td> <select class="form-control" name="loan_terms_read" >
                                    <option value="" selected >Select</option>
                                    <option value="लागु नाही" {{ (isset($clientInputs['loan_terms_read']) && $clientInputs['loan_terms_read'] == 'लागु नाही') ? 'selected' : '' }}>लागु नाही</option>                                    <option value="होय" {{ (isset($clientInputs['loan_terms_read']) && $clientInputs['loan_terms_read'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_terms_read']) && $clientInputs['loan_terms_read'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>कर्ज आणि आगाऊ दिलेल्या कर्जाऊ रकमा :-</td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>1)</td>
                            <td>कर्ज आणि आगाऊ दिलेल्या कर्जाऊ रकमांसाठी सभासदांकडुन आलेले कर्ज नियमानुसार आहेत काय?</td>
                            <td> <select class="form-control" name="loan_advances_1">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_1']) && $clientInputs['loan_advances_1'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_1']) && $clientInputs['loan_advances_1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>कर्जाच्या अर्जाची नोंदवही ठेवली असुन ती अद्यावत लिहीली आहे काय?</td>
                            <td> <select class="form-control" name="loan_advances_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_2']) && $clientInputs['loan_advances_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_2']) && $clientInputs['loan_advances_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>पोटनियमानुसार विविध प्रकारची कर्ज आणि आगावु रकमा यासाठी व्यक्तीगत आणि एकुण कमाल मर्यादा ठरविल्या आहेत काय? त्या मर्यादा पाळल्या जातात काय?</td>
                            <td>

                                <select class="form-control" name="loan_advances_3_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_3_2']) && $clientInputs['loan_advances_3_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_3_2']) && $clientInputs['loan_advances_3_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_3" value="{{ $clientInputs['loan_advances_3'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>4)</td>
                            <td>अ) सभासदांच्या परतफेडीच्या क्षमतेची योग्य चौकशी करून
                                पत-पात्रता ठरविलेली आहे काय? व्यवस्थापन समिती व
                                संचालक मंडळ यांनी स्विकारलेली वैशिष्ठे लिहा.</td>
                            <td>

                                <select class="form-control" name="loan_advances_4a_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_4a_2']) && $clientInputs['loan_advances_4a_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_4a_2']) && $clientInputs['loan_advances_4a_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_4a" value="{{ $clientInputs['loan_advances_4a'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ब) ठरवुन दिलेल्या नमुन्यात पत-पात्रता आणि जामिन दायीत्व
                                नोंदवही (सिक्युरिटी लायबिलीटी रजिस्टर) ठेवली आहे काय?</td>
                            <td> <select class="form-control" name="loan_advances_4b">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_4b']) && $clientInputs['loan_advances_4b'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_4b']) && $clientInputs['loan_advances_4b'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>5)</td>
                            <td>कायदा, कानुन, व पोटनियम यातील तरतुदीनुसार कर्ज काटेकोर
                                पणे दिली गेली आहेत काय?</td>
                            <td> <select class="form-control" name="loan_advances_5">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_5']) && $clientInputs['loan_advances_5'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_5']) && $clientInputs['loan_advances_5'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>6)</td>
                            <td> संस्थेने मागणी, वसुली आणि बाकी नोदवही योग्ये रितीने ठेवली
                                आहेत काय?</td>
                            <td> <select class="form-control" name="loan_advances_6">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_6']) && $clientInputs['loan_advances_6'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_6']) && $clientInputs['loan_advances_6'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>7)</td>
                            <td>योग्य चौकशी केल्यानतंर सादर करण्यासाठी मुदत वाढ देण्यात
                                येतात काय? अशा मुदतीसाठी आवश्यक जामिदारच्या
                                संमतीपत्रासहीत अर्ज मिळविलेले आहेत काय?</td>
                            <td>

                                <select class="form-control" name="loan_advances_7_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_7_2']) && $clientInputs['loan_advances_7_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_7_2']) && $clientInputs['loan_advances_7_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_7" value="{{ $clientInputs['loan_advances_7'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>8)</td>
                            <td> अ) सभासदांकडील थकबाक्या वसुल करण्यासाठी काय कार्यवाही
                                केली ते लिहा.</td>
                            <td>

                                <select class="form-control" name="loan_advances_8">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_8']) && $clientInputs['loan_advances_8'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_8']) && $clientInputs['loan_advances_8'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_8_1" value="{{ $clientInputs['loan_advances_8_1'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> ब) मागणी आणि थकबाकी यांच्या शेकडा प्रमाण काय आहे?</td>
                            <td>

                                <select class="form-control" name="loan_advances_9">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_9']) && $clientInputs['loan_advances_9'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_9']) && $clientInputs['loan_advances_9'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_9_1" value="{{ $clientInputs['loan_advances_9_1'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>9)</td>
                            <td> संस्थेने करून घेतलेले कर्जरोखे, वचनचिठठी आणि अन्वये
                                कागदपत्रे नियमानुसार आहेत काय? काही उणिवा असल्यास
                                नमुद करा.</td>
                            <td> <select class="form-control" name="loan_advances_10">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_10']) && $clientInputs['loan_advances_10'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_10']) && $clientInputs['loan_advances_10'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>10)</td>
                            <td>1961 च्या महाराष्ट्र सहकारी संस्थांच्या कायद्यातील 49 च्या
                                कलमाप्रमाणे सभासदांनकडुन त्यांच्या पगारातुन वा पगारातुन
                                करारपत्रकात मंजुर केलेल्या रकमा संस्थेच्या नावाने कपात
                                करण्याबाबद नोकरी देणाऱ्यास अधिकार देणारी कागदपत्रे करून
                                घेतली आहेत काय?</td>
                            <td> <select class="form-control" name="loan_advances_11">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_11']) && $clientInputs['loan_advances_11'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_11']) && $clientInputs['loan_advances_11'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>11)</td>
                            <td>परतफेडी वक्तशीर आहेत काय? संस्थेच्या मागण्या पुर्ण
                                करण्यासाठी नोकरी देणाऱ्याने वेतन व मजुरी यातुन मासीक
                                कपाती नियमाप्रमाणे केले आहेत काय?</td>
                            <td> <select class="form-control" name="loan_advances_12">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_12']) && $clientInputs['loan_advances_12'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_12']) && $clientInputs['loan_advances_12'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_12_1" value="{{ $clientInputs['loan_advances_12_1'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>12)</td>
                            <td>अशी कपात केलेली रक्कम नोकरी देणाऱ्याने संस्थेस वक्तशीपणे
                                दिली आहे काय? न दिलेली एकुण रक्कम असल्यास लिहा, अशा
                                रकमा कोणत्या दिनांकापासुन थकित आहेत ते लिहा.</td>
                            <td>

                                <select class="form-control" name="loan_advances_13">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_13']) && $clientInputs['loan_advances_13'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_13']) && $clientInputs['loan_advances_13'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_13_1" value="{{ $clientInputs['loan_advances_13_1'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>13)</td>
                            <td>पुर्वीचे कर्जपरतफेड आणि नविन कर्ज देणे यात ठरवुन दिलेला
                                कालांतर यथायत पाळले आहे काय?</td>
                            <td> <select class="form-control" name="loan_advances_14">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_14']) && $clientInputs['loan_advances_14'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_14']) && $clientInputs['loan_advances_14'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>14)</td>
                            <td>सभासदांना दिलेल्या पासबुकातील नोदी व्यक्तीक खाता वहीतील
                                नोंदीशी तपासुन पहा. अशा तपासलेल्या बुकांची संख्या लिहा.
                            </td>
                            <td>

                                <select class="form-control" name="loan_advances_15_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_15_2']) && $clientInputs['loan_advances_15_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_15_2']) && $clientInputs['loan_advances_15_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_15" value="{{ $clientInputs['loan_advances_15'] ?? '' }}">

                            </td>

                        </tr>
                        <tr>
                            <td>15)</td>
                            <td>थकित व्याजाची रक्कम किती आहे. जर ती हिशोबात घेतली
                                असेल तर तिची यथावत तरतुदी केली आहे काय?</td>
                            <td>

                                <select class="form-control" name="loan_advances_16_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_16_2']) && $clientInputs['loan_advances_16_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_16_2']) && $clientInputs['loan_advances_16_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_16" value="{{ $clientInputs['loan_advances_16'] ?? '' }}">

                            </td>
                            <td>
                        </tr>
                        <tr>
                            <td>16)</td>
                            <td>संस्थेला येणे असलेली कर्ज तपासणी आणि त्यांचे बुडीत आणि
                                संशयीत असे वर्गीकरण झाले आहेत काय? ते पहा. अशा
                                संशयीत व बुडीत कर्जासाठी पुरेशी तरतुद केली आहे काय ते
                                तपासा.</td>
                            <td>

                                <select class="form-control" name="loan_advances_17_2">
                                    <option value="">Select</option>
                                    <option value="बुडीत कर्ज" {{ (isset($clientInputs['loan_advances_17_2']) && $clientInputs['loan_advances_17_2'] == 'बुडीत कर्ज') ? 'selected' : '' }}>बुडीत कर्ज</option>

                                    <option value="होय" {{ (isset($clientInputs['loan_advances_17_2']) && $clientInputs['loan_advances_17_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_17_2']) && $clientInputs['loan_advances_17_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_17" value="{{ $clientInputs['loan_advances_17'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>17)</td>
                            <td>संस्थेच्या व्यवस्थापन समितीच्या व संचालक मंडळाच्या
                                सभासदांना आणि बॅकेचे अधिकारी यांना दिलेल्या आणि येणे
                                असलेल्या कर्जाची रक्कम लिहा.</td>
                            <td>

                                <select class="form-control" name="loan_advances_18_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_18_2']) && $clientInputs['loan_advances_18_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_18_2']) && $clientInputs['loan_advances_18_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_18" value="{{ $clientInputs['loan_advances_18'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>18)</td>
                            <td>कलमानुसार थकबाकीचे खालीलप्रमाणे वर्गीकरण करा.</td>
                            <td> <input type="text" class="form-control" id="loan_advances_18_1" name="loan_advances_18_1" value="{{ $clientInputs['loan_advances_18_1'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1) पाच वर्षावरील थकबाकी</td>
                            <td> <input type="text" class="form-control" id="loan_advances_18_2" name="loan_advances_18_2" value="{{ $clientInputs['loan_advances_18_2'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2) तीन वर्षावरील थकबाकी</td>
                            <td> <input type="text" class="form-control" id="loan_advances_18_3" name="loan_advances_18_3" value="{{ $clientInputs['loan_advances_18_3'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>3) एक वर्षावरील थकबाकी</td>
                            <td> <input type="text" class="form-control" id="loan_advances_18_4" name="loan_advances_18_4" value="{{ $clientInputs['loan_advances_18_4'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>4) एक वर्षाखालील थकबाकी</td>
                            <td> <input type="text" class="form-control" id="loan_advances_18_total" name="loan_advances_18_total" value="{{ $clientInputs['loan_advances_18_total'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>एकुण रू.</td>
                            <td> <input type="text" class="form-control" id="loan_advances_19" name="loan_advances_19" value="{{ $clientInputs['loan_advances_19'] ?? '' }}" readonly></td>
                        </tr>
                        <tr>
                            <td>19)</td>
                            <td>तारणानुसार थकबाकीचे वर्गीकरण करा.</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>अ) जमीनदाराच्या हमीनुसार सुरक्षीत आणि चांगली असलेली
                                थकबाकी</td>

                            <td>


                                <select class="form-control" name="loan_advances_20">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_20']) && $clientInputs['loan_advances_20'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_20']) && $clientInputs['loan_advances_20'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_20_1" value="{{ $clientInputs['loan_advances_20_1'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ब) विमापत्रत्वये सुरक्षीत आणि चांगली असलेली थकबाकी.</td>
                            <td><input type="text" class="form-control" name="loan_advances_20_2" value="{{ $clientInputs['loan_advances_20_2'] ?? '' }}"> </td>
                        </tr>
                        <tr>
                            <td></td>

                            <td>क) अन्य कारणामुळे सुरक्षीत आणि चांगली असलेली थकबाकी.</td>
                            <td><input type="text" class="form-control" name="loan_advances_20_3" value="{{ $clientInputs['loan_advances_20_3'] ?? '' }}"> </td>
                        </tr>
                        <tr>
                            <td></td>

                            <td>ड) असुरक्षित आणि संभाव्य संशयीत व बुडीत ठरणारी थकबाकी.</td>
                            <td><input type="text" class="form-control" name="loan_advances_20_4" value="{{ $clientInputs['loan_advances_20_4'] ?? '' }}"> </td>
                        </tr>

                        <tr>
                            <td>20)</td>
                            <td>निबंधकाच्यां नामनिर्देषीत व्यक्तीकडे प्रलंबित असलेल्या
                                प्रकरणाची संख्या, संस्थेजवळ प्रलंबित असलेल्या आणि
                                बजावणीसाठी पाठविलेल्या निवडावयाची संख्या त्याच्यां रक्मे सह
                                तपशील देवुन लादावा दाव्यातील प्रकरणात अडकुन राहिलेल्या
                                रक्कमा द्या.</td>
                            <td>

                                <select class="form-control" name="loan_advances_21_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_21_2']) && $clientInputs['loan_advances_21_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_21_2']) && $clientInputs['loan_advances_21_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="loan_advances_21" value="{{ $clientInputs['loan_advances_21'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>21)</td>
                            <td>विविध प्रकारच्या कर्जावर आकारण्यात येणाऱ्या कर्जावरील व्याज
                                दर नमुद करा.</td>
                            <td> <input type="text" class="form-control" name="loan_advances_22" value="{{ $clientInputs['loan_advances_22'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>22)</td>
                            <td>दंडाचे व्याज आकारले जाते काय? पोटनियमात ठरवुन दिले
                                असल्यास दंड व्याजाचा दर लिहा.</td>
                            <td> <input type="text" class="form-control" name="loan_advances_23" value="{{ $clientInputs['loan_advances_23'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>23)</td>
                            <td>1960 च्या महाराष्ट्र संस्थाबाबद कायद्याच्या कलम 81 (2) मध्ये
                                दर्शविल्याप्रमाणे येणे असलेली कर्ज, थकित रक्कमा, कोणत्या
                                दिनांकापासुन थकित आहेत, त्या वसुल करण्यासाठी केले गेलेली
                                कार्यवाही इत्यादी दर्शविणारी थकबाकी यादीबाकीची यादी मिळवा
                                आणि तपासा.</td>
                            <td>

                                <select class="form-control" name="loan_advances_24_2">
                                    <option value="">Select</option>
                                    <option value="यादी नुसार" {{ (isset($clientInputs['loan_advances_24_2']) && $clientInputs['loan_advances_24_2'] == 'यादी नुसार') ? 'selected' : '' }}>यादी नुसार</option>
                                    <option value="होय" {{ (isset($clientInputs['loan_advances_24_2']) && $clientInputs['loan_advances_24_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['loan_advances_24_2']) && $clientInputs['loan_advances_24_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" placeholder="Enter value" name="loan_advances_24" value="{{ $clientInputs['loan_advances_24'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>गुतंवणुकी :-</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>1)</td>
                            <td>कायदा, कानुन, व पोटनियम यातील तरतुदीनुसार गुतंवणुकी
                                केल्या आहेत काय?</td>
                            <td>

                                <select class="form-control" name="investments_1_2" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['investments_1_2']) && $clientInputs['investments_1_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['investments_1_2']) && $clientInputs['investments_1_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="investments_1" value="{{ $clientInputs['investments_1'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>गुंतवणुकी अवमुल्यंनासाठी पुरेशी तरतुद केली आहे. काय?</td>
                            <td> 
                                
                            <select class="form-control" name="investments_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['investments_2']) && $clientInputs['investments_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['investments_2']) && $clientInputs['investments_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            <input type="text" class="form-control"  name="investments_2_2" value="{{ $clientInputs['investments_2_2'] ?? '' }}">
                            </td>
                            </td>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>संस्थेच्या गुंतवणुका दर्शविणारी नोंदवही अद्यावत ठेवली आहे.
                                काय? गुंतवणुक विभागवरील जबाबदार अधिकाऱ्याने त्यावर
                                सहया केल्या आहेत काय?</td>
                            <td> <select class="form-control" name="investments_3">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['investments_3']) && $clientInputs['investments_3'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['investments_3']) && $clientInputs['investments_3'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                            </td>
                        </tr>
                        <tr>
                            <td>4)</td>
                            <td>गुंतवणुक नोंदवही संस्थेजवळ असलेल्या रोख्याशी तपासा.</td>
                            <td>

                                <select class="form-control" name="investments_4_2" >
                                    <option value="" selected >Select</option>
                                    <option value="होय" {{ (isset($clientInputs['investments_4_2']) && $clientInputs['investments_4_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['investments_4_2']) && $clientInputs['investments_4_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="investments_4" value="{{ $clientInputs['investments_4'] ?? '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>5)</td>
                            <td>रोखे जर बँकेमध्ये ठेवले असतील तर बँकेचे प्रमाणपत्र मिळविली
                                आहे काय?</td>
                            <td> <select class="form-control" name="investments_5">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['investments_5']) && $clientInputs['investments_5'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['investments_5']) && $clientInputs['investments_5'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            </td>
                            <input type="text" class="form-control" name="investments_5_2" value="{{ $clientInputs['investments_5_2'] ?? '' }}">

                        </tr>
                        <tr>
                            <td>6.</td>
                            <td> खर्च :-</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>1)</td>
                            <td> खर्चाची पत्रके संचालक मंडळ व व्यवस्थापन समितीयांच्या
                                मंजुरीसाठी ठेवण्यात आली काय?</td>
                            <td> <select class="form-control" name="expenses_1">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['expenses_1']) && $clientInputs['expenses_1'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['expenses_1']) && $clientInputs['expenses_1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td> अ) वार्षिक अंदाजपत्रक तयार करून त्यास संचालक मंडळ वा
                                व्यवस्थापन समिती आणि साधारण सभा यांनी मंजुरी दिली आहे
                                काय?
                            </td>
                            <td>

                                <select class="form-control" name="expenses_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['expenses_2']) && $clientInputs['expenses_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['expenses_2']) && $clientInputs['expenses_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="expenses_2_1" value="{{ $clientInputs['expenses_2_1'] ?? '' }}">

                            </td>
                        <tr>
                            <td></td>
                            <td>ब) झालेला खर्च अंदाज पत्रकाच्या मर्यादेत आहे काय? नसल्यास,
                                साधारण सभेने पुर्वनियोजनाला मान्यता दिली आहे काय?</td>
                            <td>
                                <select class="form-control" name="expenses_2_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['expenses_2_2']) && $clientInputs['expenses_2_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['expenses_2_2']) && $clientInputs['expenses_2_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="expenses_2_3" value="{{ $clientInputs['expenses_2_3'] ?? '' }}">
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>संस्थेच्या व्यवहाराशी संबंध नसलेले खर्चाच्या प्रकरणाची सर्व
                                साधारण अभिप्राय नोंद करा.</td>
                            <td>

                                <select class="form-control" name="expenses_3_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['expenses_3_2']) && $clientInputs['expenses_3_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['expenses_3_2']) && $clientInputs['expenses_3_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                                <br>
                                <input type="text" class="form-control" name="expenses_3" value="{{ isset($clientInputs['expenses_3']) ? $clientInputs['expenses_3'] : '' }}">

                            </td>

                        </tr>
                        <tr>
                            <td>4)</td>
                            <td> संस्थेने नगरातंर दुरध्वनी नोंदवही ठेवली आहे काय? खाजगी
                                दुरध्वनी हा खर्च वसुल करण्यात येतो काय?</td>
                            <td> <select class="form-control" name="expenses_4">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['expenses_4']) && $clientInputs['expenses_4'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['expenses_4']) && $clientInputs['expenses_4'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>5)</td>
                            <td> खेळत्या भाग भांडवलाशी आणि निव्वळ उत्पन्नाशी (मिळालेले
                                व्याजातुन दिलेले व्याज वजा जाता) व्यवस्थापन खर्चाचा शेकडा
                                प्रमाण लिहा.</td>
                            <td> <input type="text" class="form-control" name="expenses_5" value="{{ isset($clientInputs['expenses_5']) ? $clientInputs['expenses_5'] : '' }}"></td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>अंर्तगत तपासणी :-</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>1)</td>
                            <td>संस्थेची अंर्तगत तपासणी व्यवस्था समाधान कारक आहे काय?</td>
                            <td>

                                <select class="form-control" name="internal_audit_1_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['internal_audit_1_2']) && $clientInputs['internal_audit_1_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['internal_audit_1_2']) && $clientInputs['internal_audit_1_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    <option value="अशी व्यवस्था नाही" {{ (isset($clientInputs['internal_audit_1_2']) && $clientInputs['internal_audit_1_2'] == 'अशी व्यवस्था नाही') ? 'selected' : '' }}>अशी व्यवस्था नाही</option>

                                </select>
                                <br>
                                <input type="text" class="form-control" name="internal_audit_1" value="{{ isset($clientInputs['internal_audit_1']) ? $clientInputs['internal_audit_1'] : '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>संस्थेने लेखापरीक्षकाची नेमणुक केली आहे काय? त्यांना
                                दिलेल्या लेखापरीक्षा शुल्काची रक्कम आणि लेखापरिक्षकाचा
                                तपासलेला कालखंड लिहा.</td>
                            <td>

                                <select class="form-control" name="internal_audit_2_2">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['internal_audit_2_2']) && $clientInputs['internal_audit_2_2'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['internal_audit_2_2']) && $clientInputs['internal_audit_2_2'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    <option value="प्रशनच उदभवत नाही" {{ (isset($clientInputs['internal_audit_2_2']) && $clientInputs['internal_audit_2_2'] == 'प्रशनच उदभवत नाही') ? 'selected' : '' }}>प्रशनच उदभवत नाही</option>

                                </select>
                                <br>
                                <input type="text" class="form-control" name="internal_audit_2" value="{{ isset($clientInputs['internal_audit_2']) ? $clientInputs['internal_audit_2'] : '' }}">

                            </td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td>व्यवस्थापन :-</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>अधिलाभांश (बोनस) कायद्याप्रमाणे कर्मचारी वर्गाला द्यावयाचा,
                                अधिलाभांशी पुरेशी तरतुद करण्यात आली आहे काय?</td>
                            <td><select class="form-control" name="management_bonus">
                                    <option value="">Select</option>
                                    <option value="होय" {{ (isset($clientInputs['management_bonus']) && $clientInputs['management_bonus'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['management_bonus']) && $clientInputs['management_bonus'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select></td>
                        </tr>
                    </tbody>
                </table>
                <hr />
                <div class="container mt-4">
                    <h5 class="text-center">परिशिष्ठ क्रमांक 1 (एक)</h5>
                    <h6 class="text-center">कायदा नियम व पोटनियम तरतुदीचे उल्लंघन व्यवहाराचा गोषवारा.</h6>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>पावती क्रमांक व दिनांक</th>
                                <th>रक्कम</th>
                                <th>व्यवहाराचा गोषवारा</th>
                                <th>दोषांचे स्वरूप
                                    ज्या कायदा
                                    नियम
                                    पोटनियमाचे
                                    उल्लंघन झाले
                                    त्याचा
                                    गोषवारा</th>
                                <th>गुंतलेली रक्कम</th>
                                <th>अमलबलावणी
                                    संबंधी शेरा व
                                    वसुल
                                    करावयाची
                                    रक्कम.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 -->
                            <tr>
                                <td class="green-cell">1</td>
                                <td class="green-cell">2</td>
                                <td class="green-cell">3</td>
                                <td class="green-cell">4</td>
                                <td class="green-cell">5</td>
                                <td class="green-cell">6</td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row1_col1" value="{{ isset($clientInputs['annex1_row1_col1']) ? $clientInputs['annex1_row1_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row1_col2" value="{{ isset($clientInputs['annex1_row1_col2']) ? $clientInputs['annex1_row1_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row1_col3" value="{{ isset($clientInputs['annex1_row1_col3']) ? $clientInputs['annex1_row1_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row1_col4" value="{{ isset($clientInputs['annex1_row1_col4']) ? $clientInputs['annex1_row1_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row1_col5" value="{{ isset($clientInputs['annex1_row1_col5']) ? $clientInputs['annex1_row1_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row1_col6" value="{{ isset($clientInputs['annex1_row1_col6']) ? $clientInputs['annex1_row1_col6'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row2_col1" value="{{ isset($clientInputs['annex1_row2_col1']) ? $clientInputs['annex1_row2_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row2_col2" value="{{ isset($clientInputs['annex1_row2_col2']) ? $clientInputs['annex1_row2_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row2_col3" value="{{ isset($clientInputs['annex1_row2_col3']) ? $clientInputs['annex1_row2_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row2_col4" value="{{ isset($clientInputs['annex1_row2_col4']) ? $clientInputs['annex1_row2_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row2_col5" value="{{ isset($clientInputs['annex1_row2_col5']) ? $clientInputs['annex1_row2_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row2_col6" value="{{ isset($clientInputs['annex1_row2_col6']) ? $clientInputs['annex1_row2_col6'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row3_col1" value="{{ isset($clientInputs['annex1_row3_col1']) ? $clientInputs['annex1_row3_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row3_col2" value="{{ isset($clientInputs['annex1_row3_col2']) ? $clientInputs['annex1_row3_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row3_col3" value="{{ isset($clientInputs['annex1_row3_col3']) ? $clientInputs['annex1_row3_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row3_col4" value="{{ isset($clientInputs['annex1_row3_col4']) ? $clientInputs['annex1_row3_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row3_col5" value="{{ isset($clientInputs['annex1_row3_col5']) ? $clientInputs['annex1_row3_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row3_col6" value="{{ isset($clientInputs['annex1_row3_col6']) ? $clientInputs['annex1_row3_col6'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row4_col1" value="{{ isset($clientInputs['annex1_row4_col1']) ? $clientInputs['annex1_row4_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row4_col2" value="{{ isset($clientInputs['annex1_row4_col2']) ? $clientInputs['annex1_row4_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row4_col3" value="{{ isset($clientInputs['annex1_row4_col3']) ? $clientInputs['annex1_row4_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row4_col4" value="{{ isset($clientInputs['annex1_row4_col4']) ? $clientInputs['annex1_row4_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row4_col5" value="{{ isset($clientInputs['annex1_row4_col5']) ? $clientInputs['annex1_row4_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex1_row4_col6" value="{{ isset($clientInputs['annex1_row4_col6']) ? $clientInputs['annex1_row4_col6'] : '' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                                </div>
                <div class="container mt-4">
                    <h5 class="text-center">परीशिष्ठ पाहावे</h5>
                    <h6 class="text-center">परिशिष्ठ क्रमांक 2 (दोन)</h6>
                    <p class="text-center">ज्या रक्कमा हिशोबात घेणे आवश्यक होत्या पण घेतल्या नाहीत अशा रक्कमांचा तपशील.</p>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>पावती क्र. व दिनांक.</th>
                                <th>प्रत्यक्ष मिळालेली रक्कम</th>
                                <th>संस्थेत येणे असलेल्या रक्कमा कमी जमा झाल्या किंवा जमा झाल्याच नाहीत
                                    अशा व्यवहाराचा
                                    तपशिल</th>
                                <th>मिळावयास
                                    पाहीजे असलेली रक्कम</th>
                                <th>कमी जमा झालेली अगर हिशोबात न घेतलेली रक्कम</th>
                                <th>उपस्थित केलेल्या
                                    आक्षेपांचे
                                    स्वरूप</th>
                                <th>वसुल
                                    करावयाची रक्कम
                                    अभिप्राय</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 -->
                            <tr>
                                <td class="green-cell">1</td>
                                <td class="green-cell">2</td>
                                <td class="green-cell">3</td>
                                <td class="green-cell">4</td>
                                <td class="green-cell">5</td>
                                <td class="green-cell">6</td>
                                <td class="green-cell">7</td>
                                <td class="green-cell">8</td>

                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row1_col1" value="{{ isset($clientInputs['annex2_row1_col1']) ? $clientInputs['annex2_row1_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row1_col2" value="{{ isset($clientInputs['annex2_row1_col2']) ? $clientInputs['annex2_row1_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row1_col3" value="{{ isset($clientInputs['annex2_row1_col3']) ? $clientInputs['annex2_row1_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row1_col4" value="{{ isset($clientInputs['annex2_row1_col4']) ? $clientInputs['annex2_row1_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row1_col5" value="{{ isset($clientInputs['annex2_row1_col5']) ? $clientInputs['annex2_row1_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row1_col6" value="{{ isset($clientInputs['annex2_row1_col6']) ? $clientInputs['annex2_row1_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row1_col7" value="{{ isset($clientInputs['annex2_row1_col7']) ? $clientInputs['annex2_row1_col7'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row1_col8" value="{{ isset($clientInputs['annex2_row1_col8']) ? $clientInputs['annex2_row1_col8'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row2_col1" value="{{ isset($clientInputs['annex2_row2_col1']) ? $clientInputs['annex2_row2_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row2_col2" value="{{ isset($clientInputs['annex2_row2_col2']) ? $clientInputs['annex2_row2_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row2_col3" value="{{ isset($clientInputs['annex2_row2_col3']) ? $clientInputs['annex2_row2_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row2_col4" value="{{ isset($clientInputs['annex2_row2_col4']) ? $clientInputs['annex2_row2_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row2_col5" value="{{ isset($clientInputs['annex2_row2_col5']) ? $clientInputs['annex2_row2_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row2_col6" value="{{ isset($clientInputs['annex2_row2_col6']) ? $clientInputs['annex2_row2_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row2_col7" value="{{ isset($clientInputs['annex2_row2_col7']) ? $clientInputs['annex2_row2_col7'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row2_col8" value="{{ isset($clientInputs['annex2_row2_col8']) ? $clientInputs['annex2_row2_col8'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row3_col1" value="{{ isset($clientInputs['annex2_row3_col1']) ? $clientInputs['annex2_row3_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row3_col2" value="{{ isset($clientInputs['annex2_row3_col2']) ? $clientInputs['annex2_row3_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row3_col3" value="{{ isset($clientInputs['annex2_row3_col3']) ? $clientInputs['annex2_row3_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row3_col4" value="{{ isset($clientInputs['annex2_row3_col4']) ? $clientInputs['annex2_row3_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row3_col5" value="{{ isset($clientInputs['annex2_row3_col5']) ? $clientInputs['annex2_row3_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row3_col6" value="{{ isset($clientInputs['annex2_row3_col6']) ? $clientInputs['annex2_row3_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row3_col7" value="{{ isset($clientInputs['annex2_row3_col7']) ? $clientInputs['annex2_row3_col7'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row3_col8" value="{{ isset($clientInputs['annex2_row3_col8']) ? $clientInputs['annex2_row3_col8'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row4_col1" value="{{ isset($clientInputs['annex2_row4_col1']) ? $clientInputs['annex2_row4_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row4_col2" value="{{ isset($clientInputs['annex2_row4_col2']) ? $clientInputs['annex2_row4_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row4_col3" value="{{ isset($clientInputs['annex2_row4_col3']) ? $clientInputs['annex2_row4_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row4_col4" value="{{ isset($clientInputs['annex2_row4_col4']) ? $clientInputs['annex2_row4_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row4_col5" value="{{ isset($clientInputs['annex2_row4_col5']) ? $clientInputs['annex2_row4_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row4_col6" value="{{ isset($clientInputs['annex2_row4_col6']) ? $clientInputs['annex2_row4_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row4_col7" value="{{ isset($clientInputs['annex2_row4_col7']) ? $clientInputs['annex2_row4_col7'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex2_row4_col8" value="{{ isset($clientInputs['annex2_row4_col8']) ? $clientInputs['annex2_row4_col8'] : '' }}"></td>
                            </tr>

                            <!-- More rows can be added here -->
                        </tbody>
                    </table>

                    <p class="text-center fw-bold">परिशिष्ट पाहावे</p>
                </div>
                <div class="container mt-4">
                    <h5 class="text-center">परिशिष्ठ क्रमांक 3 (तिन)</h5>
                    <h6 class="text-center">अयोग्य व अनियमित दिलेल्या रक्कमा.</h6>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>पावती क्र. व दिनांक</th>
                                <th>दिलेली रक्कम</th>
                                <th>व्यवहाराचा
                                    तपशील</th>
                                <th>उपस्थित केलेल्या
                                    आक्षेपाचे</th>
                                <th>करावयाची
                                    कार्यवाही वसुल
                                    करावयाची रक्कम
                                    इत्यादी संबधी
                                    अभिप्राय</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 -->
                            <tr>
                                <td class="green-cell">1</td>
                                <td class="green-cell">2</td>
                                <td class="green-cell">3</td>
                                <td class="green-cell">4</td>
                                <td class="green-cell">5</td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row1_col1" value="{{ isset($clientInputs['annex3_row1_col1']) ? $clientInputs['annex3_row1_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row1_col2" value="{{ isset($clientInputs['annex3_row1_col2']) ? $clientInputs['annex3_row1_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row1_col3" value="{{ isset($clientInputs['annex3_row1_col3']) ? $clientInputs['annex3_row1_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row1_col4" value="{{ isset($clientInputs['annex3_row1_col4']) ? $clientInputs['annex3_row1_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row1_col5" value="{{ isset($clientInputs['annex3_row1_col5']) ? $clientInputs['annex3_row1_col5'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row2_col1" value="{{ isset($clientInputs['annex3_row2_col1']) ? $clientInputs['annex3_row2_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row2_col2" value="{{ isset($clientInputs['annex3_row2_col2']) ? $clientInputs['annex3_row2_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row2_col3" value="{{ isset($clientInputs['annex3_row2_col3']) ? $clientInputs['annex3_row2_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row2_col4" value="{{ isset($clientInputs['annex3_row2_col4']) ? $clientInputs['annex3_row2_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row2_col5" value="{{ isset($clientInputs['annex3_row2_col5']) ? $clientInputs['annex3_row2_col5'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row3_col1" value="{{ isset($clientInputs['annex3_row3_col1']) ? $clientInputs['annex3_row3_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row3_col2" value="{{ isset($clientInputs['annex3_row3_col2']) ? $clientInputs['annex3_row3_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row3_col3" value="{{ isset($clientInputs['annex3_row3_col3']) ? $clientInputs['annex3_row3_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row3_col4" value="{{ isset($clientInputs['annex3_row3_col4']) ? $clientInputs['annex3_row3_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row3_col5" value="{{ isset($clientInputs['annex3_row3_col5']) ? $clientInputs['annex3_row3_col5'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row4_col1" value="{{ isset($clientInputs['annex3_row4_col1']) ? $clientInputs['annex3_row4_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row4_col2" value="{{ isset($clientInputs['annex3_row4_col2']) ? $clientInputs['annex3_row4_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row4_col3" value="{{ isset($clientInputs['annex3_row4_col3']) ? $clientInputs['annex3_row4_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row4_col4" value="{{ isset($clientInputs['annex3_row4_col4']) ? $clientInputs['annex3_row4_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row4_col5" value="{{ isset($clientInputs['annex3_row4_col5']) ? $clientInputs['annex3_row4_col5'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row5_col1" value="{{ isset($clientInputs['annex3_row5_col1']) ? $clientInputs['annex3_row5_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row5_col2" value="{{ isset($clientInputs['annex3_row5_col2']) ? $clientInputs['annex3_row5_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row5_col3" value="{{ isset($clientInputs['annex3_row5_col3']) ? $clientInputs['annex3_row5_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row5_col4" value="{{ isset($clientInputs['annex3_row5_col4']) ? $clientInputs['annex3_row5_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex3_row5_col5" value="{{ isset($clientInputs['annex3_row5_col5']) ? $clientInputs['annex3_row5_col5'] : '' }}"></td>
                            </tr>

                            <!-- More rows can be added here -->
                        </tbody>
                    </table>

                    <p class="text-center fw-bold">निरंक</p>
                </div>
                <div class="container mt-4">
                    <h5 class="text-center">परशिष्ठ क्रमांक 4 (चार)</h5>
                    <h6 class="text-center">संशयीत व बुडीत कर्जाची यादी</h6>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>खाते नंबर</th>
                                <th>कर्जदारांचे नाव</th>
                                <th>येणे कर्ज</th>
                                <th>पैकी संशयित
                                    वाटलेली</th>
                                <th>थकित
                                    दिनांक</th>
                                <th>शेरा</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Row 1 -->
                            <tr>
                                <td class="green-cell">1</td>
                                <td class="green-cell">2</td>
                                <td class="green-cell">3</td>
                                <td class="green-cell">4</td>
                                <td class="green-cell">5</td>
                                <td class="green-cell">6</td>

                                <td class="green-cell">7</td>

                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row1_col1" value="{{ isset($clientInputs['annex4_row1_col1']) ? $clientInputs['annex4_row1_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row1_col2" value="{{ isset($clientInputs['annex4_row1_col2']) ? $clientInputs['annex4_row1_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row1_col3" value="{{ isset($clientInputs['annex4_row1_col3']) ? $clientInputs['annex4_row1_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row1_col4" value="{{ isset($clientInputs['annex4_row1_col4']) ? $clientInputs['annex4_row1_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row1_col5" value="{{ isset($clientInputs['annex4_row1_col5']) ? $clientInputs['annex4_row1_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row1_col6" value="{{ isset($clientInputs['annex4_row1_col6']) ? $clientInputs['annex4_row1_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row1_col7" value="{{ isset($clientInputs['annex4_row1_col7']) ? $clientInputs['annex4_row1_col7'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row2_col1" value="{{ isset($clientInputs['annex4_row2_col1']) ? $clientInputs['annex4_row2_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row2_col2" value="{{ isset($clientInputs['annex4_row2_col2']) ? $clientInputs['annex4_row2_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row2_col3" value="{{ isset($clientInputs['annex4_row2_col3']) ? $clientInputs['annex4_row2_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row2_col4" value="{{ isset($clientInputs['annex4_row2_col4']) ? $clientInputs['annex4_row2_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row2_col5" value="{{ isset($clientInputs['annex4_row2_col5']) ? $clientInputs['annex4_row2_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row2_col6" value="{{ isset($clientInputs['annex4_row2_col6']) ? $clientInputs['annex4_row2_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row2_col7" value="{{ isset($clientInputs['annex4_row2_col7']) ? $clientInputs['annex4_row2_col7'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row3_col1" value="{{ isset($clientInputs['annex4_row3_col1']) ? $clientInputs['annex4_row3_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row3_col2" value="{{ isset($clientInputs['annex4_row3_col2']) ? $clientInputs['annex4_row3_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row3_col3" value="{{ isset($clientInputs['annex4_row3_col3']) ? $clientInputs['annex4_row3_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row3_col4" value="{{ isset($clientInputs['annex4_row3_col4']) ? $clientInputs['annex4_row3_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row3_col5" value="{{ isset($clientInputs['annex4_row3_col5']) ? $clientInputs['annex4_row3_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row3_col6" value="{{ isset($clientInputs['annex4_row3_col6']) ? $clientInputs['annex4_row3_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row3_col7" value="{{ isset($clientInputs['annex4_row3_col7']) ? $clientInputs['annex4_row3_col7'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row4_col1" value="{{ isset($clientInputs['annex4_row4_col1']) ? $clientInputs['annex4_row4_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row4_col2" value="{{ isset($clientInputs['annex4_row4_col2']) ? $clientInputs['annex4_row4_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row4_col3" value="{{ isset($clientInputs['annex4_row4_col3']) ? $clientInputs['annex4_row4_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row4_col4" value="{{ isset($clientInputs['annex4_row4_col4']) ? $clientInputs['annex4_row4_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row4_col5" value="{{ isset($clientInputs['annex4_row4_col5']) ? $clientInputs['annex4_row4_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row4_col6" value="{{ isset($clientInputs['annex4_row4_col6']) ? $clientInputs['annex4_row4_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row4_col7" value="{{ isset($clientInputs['annex4_row4_col7']) ? $clientInputs['annex4_row4_col7'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row5_col1" value="{{ isset($clientInputs['annex4_row5_col1']) ? $clientInputs['annex4_row5_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row5_col2" value="{{ isset($clientInputs['annex4_row5_col2']) ? $clientInputs['annex4_row5_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row5_col3" value="{{ isset($clientInputs['annex4_row5_col3']) ? $clientInputs['annex4_row5_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row5_col4" value="{{ isset($clientInputs['annex4_row5_col4']) ? $clientInputs['annex4_row5_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row5_col5" value="{{ isset($clientInputs['annex4_row5_col5']) ? $clientInputs['annex4_row5_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row5_col6" value="{{ isset($clientInputs['annex4_row5_col6']) ? $clientInputs['annex4_row5_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row5_col7" value="{{ isset($clientInputs['annex4_row5_col7']) ? $clientInputs['annex4_row5_col7'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row6_col1" value="{{ isset($clientInputs['annex4_row6_col1']) ? $clientInputs['annex4_row6_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row6_col2" value="{{ isset($clientInputs['annex4_row6_col2']) ? $clientInputs['annex4_row6_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row6_col3" value="{{ isset($clientInputs['annex4_row6_col3']) ? $clientInputs['annex4_row6_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row6_col4" value="{{ isset($clientInputs['annex4_row6_col4']) ? $clientInputs['annex4_row6_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row6_col5" value="{{ isset($clientInputs['annex4_row6_col5']) ? $clientInputs['annex4_row6_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row6_col6" value="{{ isset($clientInputs['annex4_row6_col6']) ? $clientInputs['annex4_row6_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row6_col7" value="{{ isset($clientInputs['annex4_row6_col7']) ? $clientInputs['annex4_row6_col7'] : '' }}"></td>
                            </tr>
                            <tr>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row7_col1" value="{{ isset($clientInputs['annex4_row7_col1']) ? $clientInputs['annex4_row7_col1'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row7_col2" value="{{ isset($clientInputs['annex4_row7_col2']) ? $clientInputs['annex4_row7_col2'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row7_col3" value="{{ isset($clientInputs['annex4_row7_col3']) ? $clientInputs['annex4_row7_col3'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row7_col4" value="{{ isset($clientInputs['annex4_row7_col4']) ? $clientInputs['annex4_row7_col4'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row7_col5" value="{{ isset($clientInputs['annex4_row7_col5']) ? $clientInputs['annex4_row7_col5'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row7_col6" value="{{ isset($clientInputs['annex4_row7_col6']) ? $clientInputs['annex4_row7_col6'] : '' }}"></td>
                                <td class="green-cell"><input type="text" class="form-control" name="annex4_row7_col7" value="{{ isset($clientInputs['annex4_row7_col7']) ? $clientInputs['annex4_row7_col7'] : '' }}"></td>
                            </tr>
                            <!-- More rows can be added here -->
                        </tbody>
                    </table>

                    <p class="text-center fw-bold">{{$auditor->name}}
                        प्रमाणित लेखापरीक्षक
                        सह. संस्था, भंडारा</p>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    function calcTotalMembers() {
        let reg = parseInt(document.getElementById('loan_advances_18_2').value) || 0;
        let nom = parseInt(document.getElementById('loan_advances_18_3').value) || 0;
        let inst = parseInt(document.getElementById('loan_advances_18_4').value) || 0;
        let other = parseInt(document.getElementById('loan_advances_18_total').value) || 0;
        document.getElementById('loan_advances_19').value = reg + nom + inst + other;
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Calculate once on load using existing values
        calcTotalMembers();
        // Add event listeners for live calculation
        ['loan_advances_18_2', 'loan_advances_18_3', 'loan_advances_18_4', 'loan_advances_18_total'].forEach(function(id) {
            let el = document.getElementById(id);
            if (el) el.addEventListener('input', calcTotalMembers);
        });
    });
</script>
@endsection