@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet Nine</h4>
                <div>
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>

            </div>
            <!-- START: सहकारी पतसंस्था लेखापरीक्षण गुणवत्त्ता Design as per pasted image -->
            <div class="mb-4">
                <div class="text-center mb-2">
                    <span class="fw-bold" style="font-size: 1.1em;">
                        सेवक (पगारदार नोकरांच्या) सहकारी पतसंस्था लेखापरीक्षण वर्गवारी गुणतक्ता<br>
                    </span>
                </div>
                <div class="mb-2">
                    <span>संस्थेचे नाव : <span style="font-weight:bold;">{{$client->name_of_society}}</span></span>
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
                    <span>लेखापरीक्षण वर्ष – सन् {{$start}} — {{$end}}</span>
                </div>
                <form action="{{ route('admin.client.saveInputs', $client->id) }}" method="POST">
                    @csrf
                    <table class="table table-bordered" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th rowspan="2">अ.क्र.</th>
                                <th rowspan="2">तपशील</th>
                                <th rowspan="2">निकष गुण</th>
                            </tr>
                            <tr>
                                <th>एकूण गुण</th>
                                <th>दिलेले गुण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">1. स्वनिधी (Own Fund) := 45 गुण</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="text-start">अ) संस्थेचे स्वनिधी खेळत्या भांडवलाशी 10% पेक्षा जास्त असल्यास</td>
                                <td>10</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_1_detail" value="{{ $clientInputs['ownfund_1_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>ब) संस्थेचे स्वनिधी खेळत्या भांडवलाशी 05% ते 10% पेक्षा कमी
                                    असल्यास</td>
                                <td>5</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_2_detail" value="{{ $clientInputs['ownfund_2_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>क) संस्थेचे स्वनिधी खेळत्या भांडवलाशी 05% पेक्षा कमी असल्यास</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_3_detail" value="{{ $clientInputs['ownfund_3_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>स्वनिधी वाढविण्याची क्षमता</td>
                                <td></td>
                                <td>15</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>अ) उपविधीतील तरतूदीनुसार कर्ज रकमेतून कर्जाच्या प्रमाणात भाग
                                    रक्कम कपात करीत असल्यास</td>
                                <td>2</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_4_detail" value="{{ $clientInputs['ownfund_4_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>ब) नफ्यातून राखीव निधीस वर्ग रकमा</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>1) नफ्यामधून 25% रक्कम राखीव निधीस वर्ग केल्यास</td>
                                <td>5</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_6_detail" value="{{ $clientInputs['ownfund_6_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>2) नफ्यामधून 25% पेक्षा कमी रक्कम राखीव निधीस वर्ग केल्यास (निबंधकाच्या मंजूरीने 25 पेक्षा कमी रक्कम राखीव निधीस वर्ग
                                    केल्यास व त्या संदर्भातील अटी व शर्तीचे पालन केले असल्यास 5
                                    गुण द्यावेत)</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_66_detail" value="{{ $clientInputs['ownfund_66_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>क) सभासदांकडून उपविधीतील तरतूदीनुसार दरमहा वर्गणी वसुल
                                    होत असल्यास</td>
                                <td>5</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_7_detail" value="{{ $clientInputs['ownfund_7_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>ड) जमा वर्गणीचे नियमितपणे भागा मध्ये / संचित ठेवी मध्ये रूपांतर
                                    केले जात असल्यास</td>
                                <td>3</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_8_detail" value="{{ $clientInputs['ownfund_8_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">3. स्वनिधीमध्ये वाढ :-</td>
                            </tr>
                            <tr>
                                <td>अ)</td>
                                <td> स्वनिधीमध्ये गतवर्षाशी तुलना करता 7.5% व त्त्यापेक्षा जास्त
                                    वाढ असल्यास</td>
                                <td>20</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_9_detail" value="{{ $clientInputs['ownfund_9_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>ब)</td>
                                <td>स्वनिधीमध्ये गतवर्षाशी तुलना करता 5% ते 7.5% व पेक्षा कमी
                                    वाढ असल्यास</td>
                                <td>15</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_10_detail" value="{{ $clientInputs['ownfund_10_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>क)</td>
                                <td>स्वनिधीमध्ये गतवर्षाशी तुलना करता 2.5% ते 5% व पेक्षा कमी
                                    वाढ असल्यास</td>
                                <td>10</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_11_detail" value="{{ $clientInputs['ownfund_11_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>ड)</td>
                                <td>स्वनिधीमध्ये गतवर्षाशी तुलना करता 2.5% पेक्षा कमी वाढ
                                    असल्यास</td>
                                <td>5</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_12_detail" value="{{ $clientInputs['ownfund_12_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>ई)</td>
                                <td>स्वनिधीमध्ये गतवर्षी तुलना घट / हास असल्यास</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="ownfund_13_detail" value="{{ $clientInputs['ownfund_13_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold" style="text-align:right;background: #ffff99;">एकूण गुण</td>
                                <td style="background: #ffff99;">45</td>
                                <td style="background: #00e6ff;">
                                    <input type="text" class="form-control" name="ownfund_total_score" value="{{ $clientInputs['ownfund_total_score'] ?? '' }}">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    2. जिंदगीची गुणवत्ता (Assets Quality) :- <span style="font-weight:normal;">55 गुण</span>
                                </td>
                            </tr>
                            <!-- START: Assets Quality section as per pasted image -->
                            <tr>
                                <td class="fw-bold" colspan="5" style="text-align:left;">1. निव्वळ अनुत्पादक जिद्दीची (Net N.P.A.) प्रमाण :-</td>
                            </tr>
                            <tr>
                                <td>अ)</td>
                                <td>0% ते 5% पर्यंत असल्यास</td>
                                <td>10 ते 15</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_net_npa_1_detail" value="{{ $clientInputs['assets_net_npa_1_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>ब)</td>
                                <td>5% पेक्षा अधिक ते 10% पर्यंत असल्यास</td>
                                <td>5 ते 9</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_net_npa_2_detail" value="{{ $clientInputs['assets_net_npa_2_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>क)</td>
                                <td>10% पेक्षा अधिक ते 15% पर्यंत असल्यास</td>
                                <td>0 ते 4</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_net_npa_3_detail" value="{{ $clientInputs['assets_net_npa_3_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold" colspan="5" style="text-align:left;">2. ढोबळ अनुत्पादक जिंदगीचे (Gross N.P.A.) प्रमाण :-</td>
                            </tr>
                            <tr>
                                <td>अ)</td>
                                <td>5% व त्यापेक्षा कमी असल्यास</td>
                                <td>15</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_gross_npa_1_detail" value="{{ $clientInputs['assets_gross_npa_1_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>ब)</td>
                                <td>5% पेक्षा अधिक ते 10% पर्यंत असल्यास</td>
                                <td>10 ते 14</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_gross_npa_2_detail" value="{{ $clientInputs['assets_gross_npa_2_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>क)</td>
                                <td>10% पेक्षा अधिक ते 15% पर्यंत असल्यास</td>
                                <td>05 ते 09</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_gross_npa_3_detail" value="{{ $clientInputs['assets_gross_npa_3_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>ड)</td>
                                <td>15% पेक्षा अधिक ते 20% पर्यंत असल्यास</td>
                                <td>0 ते 04</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_gross_npa_4_detail" value="{{ $clientInputs['assets_gross_npa_4_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold" colspan="5" style="text-align:left;">3. गत वर्षअखेरच्या अनुत्पादक (N.P.A.) कर्जाच्या वसुलीचे प्रमाण :-</td>
                            </tr>
                            <tr>
                                <td>अ)</td>
                                <td>20% पेक्षा अधिक ते 30% व त्यापेक्षा अधिक असल्यास</td>
                                <td>11 ते 15</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_npa_recovery_1_detail" value="{{ $clientInputs['assets_npa_recovery_1_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>ब)</td>
                                <td>10% पेक्षा अधिक ते 20% पर्यंत असल्यास</td>
                                <td>6 ते 0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_npa_recovery_2_detail" value="{{ $clientInputs['assets_npa_recovery_2_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>क)</td>
                                <td>10% पर्यंत असल्यास</td>
                                <td>0 ते 5</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="assets_npa_recovery_3_detail" value="{{ $clientInputs['assets_npa_recovery_3_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="fw-bold" colspan="5" style="text-align:left;">4. कर्ज व्यवहार :-</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>कर्ज प्रकरणी आवश्यक ते दस्तऐवज व कागदपत्रे घेउन, कर्ज
                                    मागणी अर्ज परिपूर्ण भरलेला असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="loan_doc_1_detail" value="{{ $clientInputs['loan_doc_1_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td> सर्व कर्जदारांनी आपले पगारातून कर्जाचा हप्ता कपात
                                    करणेबाबतचे अधिकारपत्र कलम 49 नुसार संस्थेस दिले असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="loan_doc_2_detail" value="{{ $clientInputs['loan_doc_2_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>मालक संस्थेकडून पगारातून कर्जाचा हप्ता कपात करून वेळेत
                                    पाठविणेबाबत हमीपत्र घेतले असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="loan_doc_3_detail" value="{{ $clientInputs['loan_doc_3_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>मालक संस्थेकडून पगारातून कपात केलेली वर्गणीची रक्कम
                                    दरमहा नियमित जमा होत असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="loan_doc_4_detail" value="{{ $clientInputs['loan_doc_4_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>सभासदांना द्यावयाच्या कर्जाबाबत सभासदाचे वेतनमान, कर्ज
                                    परतफेड क्षमता आणि इतर वैधानिक कपात (वेतन प्रदान
                                    अधिनियमाप्रमाणे) यांचा विचार करून कर्जाचे हप्ते ठरविले असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="loan_doc_5_detail" value="{{ $clientInputs['loan_doc_5_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>उपविधीतील तरतूदी व नियामक मंडळ परिपत्रकीय सूचनांनुसार
                                    सभासद कमाल कर्ज मर्यादेचे पालन होत असल्यास</td>
                                <td>2</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="loan_doc_6_detail" value="{{ $clientInputs['loan_doc_6_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>उपविधीतील तरतूदीनुसार पूर्वीचे कर्ज परतफेड झाले नंतरच
                                    नवीन कर्जे दिली असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="loan_doc_7_detail" value="{{ $clientInputs['loan_doc_7_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>नियामक मंडळ परिपत्रकीय सूचनांनुसार कर्जाचे व्याजदर निश्चित
                                    केले असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="loan_doc_8_detail" value="{{ $clientInputs['loan_doc_8_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>कर्जातून पोटनियम बाह्य कपाती केल्या नसल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="loan_doc_9_detail" value="{{ $clientInputs['loan_doc_9_detail'] ?? '' }}"></td>
                            </tr>

                            <tr>
                                <td colspan="3" class="fw-bold" style="text-align:right;background: #ffff99;">एकूण गुण</td>
                                <td style="background: #ffff99;">55</td>
                                <td style="background: #00e6ff;">
                                    <input type="text" class="form-control" name="assets_total_score" value="{{ $clientInputs['assets_total_score'] ?? '' }}">
                                </td>
                            </tr>
                            <!-- END: Assets Quality section -->
                        </tbody>
                    </table>
                    <!-- START: Management section as per pasted image -->
                    <table class="table table-bordered" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    3. व्यवस्थापन (Management) :- <span style="font-weight:normal;">38 गुण</span>
                                </th>
                            </tr>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>तपशील</th>
                                <th>लक्ष्य गुण</th>
                                <th>एकूण गुण</th>
                                <th>तपशील गुण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-start">
                                    सभा कामकाज :<br>
                                    <span style="margin-left: 1em;">अ) सभांना सूचना विहित मुदतीत पाठविली असल्यास</span><br>
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_meeting_detail" value="{{ $clientInputs['mgmt_meeting_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    ब) वार्षिक सर्वसाधारण सभा सहकार कायदा कलम 75 (2) मध्ये तरतूदींनुसार विहित मुदतीत घेतली असल्यास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_meeting_2_detail" value="{{ $clientInputs['mgmt_meeting_2_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    क) संचालक मंडळाची उपविधीतील तरतुदीप्रमाणे दरमहा किमान
                                    एक सभा घेऊन सभा कामकाज होत असल्यास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_meeting_3_detail" value="{{ $clientInputs['mgmt_meeting_3_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    ड) संचालक मंडळ सभेमध्ये आयत्या वेळच्या विषयात धोरणात्मक
                                    बाबींवर निर्णय घेतले असल्यास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_policy_detail" value="{{ $clientInputs['mgmt_policy_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    ई) संचालक मंडळ सभेचे इतिवृत्त प्रत्येक संचालकांना पाठविले
                                    असल्यास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_receipt_detail" value="{{ $clientInputs['mgmt_receipt_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-start">
                                    सहकार तज्ञ संचालक :<br>
                                    <span style="margin-left: 1em;">अ) उपविधीनुसार सहकारी पतसंस्था/ सेवक पतसंस्था सहकारी बँका/राष्ट्रीयकृत बँक/व्यापारी बँक यामधील अनुभवी व्यक्ती/सनदी लेखापाल यापैकी किमाल एक तज्ञ संचालक नियुक्त केला असल्यास</span>
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_expert_detail" value="{{ $clientInputs['mgmt_expert_detail'] ?? '' }}"></td>
                            </tr>
                              <tr>
                                <td></td>
                                <td class="text-start">
                                    <span style="margin-left: 1em;">अन्यथा</span>
                                </td>
                                <td>0</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="text-start">
                                    सहकार शिक्षण व प्रशिक्षण :<br>
                                    <span style="margin-left: 1em;">अ) एका आर्थिक वर्षात एकूण सदस्यांपैकी किमान 1/5 सदस्यांना सहकार प्रशिक्षण केंद्र/मान्यताप्राप्त प्रशिक्षण संस्थेत 1 ते 3 दिवसांचे प्रशिक्षण दिले असल्यास</span>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                             <tr>
                                <td></td>
                                <td class="text-start">
                                    <br>
                                    <span>ब)संचालकांना शासनाने अधिसुचीत केलेल्या प्रशिक्षण संस्थेत किमान 1 ते 3 दिवसांचे प्रशिक्षण दिले असल्यास :</span>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    <br>
                                    <span style="margin-left: 2em;">1)100% संचालक प्रशिक्षित असल्यास</span>
                                </td>
                                <td>3</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_training_2_detail" value="{{ $clientInputs['mgmt_training_2_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    <span style="margin-left: 2em;">2) 75% व त्यापेक्षा अधिक संचालक प्रशिक्षित असल्यास</span>
                                </td>
                                <td>2</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_training_3_detail" value="{{ $clientInputs['mgmt_training_3_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    <span style="margin-left: 2em;">3)50% ते 75% पेक्षा कमी संचालक प्रशिक्षित असल्यास</span>
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_training_4_detail" value="{{ $clientInputs['mgmt_training_4_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    <span style="margin-left: 2em;">4)50% पेक्षा कमी संचालक प्रशिक्षित असल्यास</span>
                                </td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_training_5_detail" value="{{ $clientInputs['mgmt_training_5_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="text-start">
                                    व्यवस्थापक / महाव्यवस्थापक/कार्यकारी संचालक/मुख्य कार्यकारी
                                    अधिकारी / वरिष्ठ अधिकारीः-
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    1)100% अधिकारी / सेवक प्रशिक्षित असल्यास
                                </td>
                                <td>3</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_training_6_detail" value="{{ $clientInputs['mgmt_training_6_detail'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    2) 75% व त्यापेक्षा अधिक अधिकारी / सेवक प्रशिक्षित असल्यास
                                </td>
                                <td>2</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_training_7_detail" value="{{ $clientInputs['mgmt_training_7_detail'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    3) 50% ते 75% पर्यंत अधिकारी/सेवक प्रशिक्षित असल्यास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_training_8_detail" value="{{ $clientInputs['mgmt_training_8_detail'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    4)50% पेक्षा कमी अधिकारी / सेवक प्रशिक्षित असल्यास
                                </td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="mgmt_training_9_detail" value="{{ $clientInputs['mgmt_training_9_detail'] ?? '' }}"></td>

                            </tr>
                            <!-- END: Management section -->

                            <!-- START: कार्यकारी/प्रशासकीय कार्यक्षमता Design as per pasted image -->
                            <tr>
                                <td colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    4. कार्यकारी/प्रशासकीय कार्यक्षमता :- <span style="font-weight:normal;">3 गुण</span>
                                </td>
                            </tr>
                             <tr>
                                <td></td>
                                <td class="text-start">
                                    <br>
                                    <span>व्यवस्थापक/मुख्याधिकारी/कार्यकारी संचालक/मुख्य कार्यकारी अधिकारी/वरिष्ठ अधिकारी -</span>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="text-start">
                                    
                                    <br>अ) व्यवस्थापक/महाव्यवस्थापक/कार्यकारी संचालक/मुख्य
                                    कार्यकारी अधिकारी यांची शैक्षणिक अर्हता, अनुभव व तांत्रित
                                    क्षमता विचारात घेऊन सेवानियमानुसार नेमणूक केली असलयास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="admin_appoint_detail" value="{{ $clientInputs['admin_appoint_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-start">
                                    ब) वरीष्ट अधिकारी/शाखा व्यवस्थापक यांची शैक्षणिक अर्हता,अनुभव
                                    व तांत्रित क्षमता विचारात घेऊन सेवानियमानुसार नेमणूक केली
                                    असल्यास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="admin_branch_mgr_detail" value="{{ $clientInputs['admin_branch_mgr_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="text-start">
                                    क) व्यवस्थापक/महाव्यवस्थापक/कार्यकारी संचालक / मुख्य
                                    कार्यकारी अधिकारी यांनी उपविधीनुसार कर्तव्याचे पालन करून
                                    कामकाज केले असल्यास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="admin_duty_detail" value="{{ $clientInputs['admin_duty_detail'] ?? '' }}"></td>
                            </tr>

                            <!-- END: कार्यकारी/प्रशासकीय कार्यक्षमता Design -->

                            <!-- START: वसूली कार्यक्षमता Design as per pasted image -->
                            <tr>
                                <td colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    5. वसुलीची कायदेशीर कारवाई:- <span style="font-weight:normal;">10 गुण</span>
                                </td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td class="text-start">100% थकबाकीदारांवर कारवाई पूर्ण असल्यास</td>
                                <td>10</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="recovery_100_detail" value="{{ $clientInputs['recovery_100_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-start">75% ते 99% पर्यंत थकबाकीदारांवर कारवाई पूर्ण असल्यास</td>
                                <td>8</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="recovery_75_99_detail" value="{{ $clientInputs['recovery_75_99_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="text-start">50% ते 74% पर्यंत थकबाकीदारांवर कारवाई पूर्ण असल्यास</td>
                                <td>5</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="recovery_50_74_detail" value="{{ $clientInputs['recovery_50_74_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="text-start">25% ते 49% पर्यंत थकबाकीदारांवर कारवाई पूर्ण असल्यास</td>
                                <td>2</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="recovery_25_49_detail" value="{{ $clientInputs['recovery_25_49_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td class="text-start">25% पेक्षा कमी थकबाकीदारांवर कारवाई पूर्ण असल्यास</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="recovery_below_25_detail" value="{{ $clientInputs['recovery_below_25_detail'] ?? '' }}"></td>
                            </tr>
                            <!-- END: वसूली कार्यक्षमता Design -->
                        </tbody>
                    </table>
                    <!-- START: गतवर्षाच्या तुलनेत ठेवीतील वाढ, सभासद, संचालक मंडळ, निकाल Design as per pasted image -->
                    <table class="table table-bordered" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    6. गतवर्षाच्या तुलनेत ठेवीतील वाढ :- <span style="font-weight:normal;">4 गुण</span>
                                </th>
                            </tr>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>तपशील</th>
                                <th>लक्ष्य गुण</th>
                                <th>एकूण गुण</th>
                                <th>तपशील गुण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>अ)</td>
                                <td>10% पेक्षा जास्त वाढ असल्यास</td>
                                <td>4</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="deposit_growth_above_10_detail" value="{{ $clientInputs['deposit_growth_above_10_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>ब)</td>
                                <td>5% ते 10% पर्यंत वाढ असल्यास</td>
                                <td>3</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="deposit_growth_5_10_detail" value="{{ $clientInputs['deposit_growth_5_10_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>क)</td>
                                <td>5% पेक्षा कमी वाढ असल्यास</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="deposit_growth_below_5_detail" value="{{ $clientInputs['deposit_growth_below_5_detail'] ?? '' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    7. सभासदत्व :- <span style="font-weight:normal;">3 गुण</span>
                                </th>
                            </tr>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>तपशील</th>
                                <th>लक्ष्य गुण</th>
                                <th>एकूण गुण</th>
                                <th>तपशील गुण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>अधिनियम, नियम व उपविधीतिल तरतूदीप्रमाणे यथोचितरीत्या सभासद करून घेतले असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="member_admission_detail" value="{{ $clientInputs['member_admission_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>सर्व सभासदांकडून वारसांचे नामनिर्देशन करून घेतले असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="member_nomination_detail" value="{{ $clientInputs['member_nomination_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>सर्व सभासदांना भाग दाखले दिले असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="member_loan_share_detail" value="{{ $clientInputs['member_loan_share_detail'] ?? '' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    8. संचालक मंडळ :- <span style="font-weight:normal;">2 गुण</span>
                                </th>
                            </tr>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>तपशील</th>
                                <th>लक्ष्य गुण</th>
                                <th>एकूण गुण</th>
                                <th>तपशील गुण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>संचालक मंडळ निवडणूक – संचालक मंडळाच्या निवडणुकी संदर्भात कायदा व नियमातील तरतूदीप्रमाणे आवश्यक ती पुर्णता वेळेवर केली असल्यास</td>
                                <td></td>
                                <td>2</td>
                                <td><input type="text" class="form-control" name="sysctrl_detail1" value="{{ $clientInputs['sysctrl_detail1'] ?? '' }}"></td>
                            </tr>
                           <tr>
                            <td></td>
                                <td class="text-start">अन्यथा</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_113_detail" value="{{ $clientInputs['earnings_net_profit_113_detail'] ?? '' }}"></td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td colspan="3" class="fw-bold" style="text-align:right;background: #ffff99;">एकूण गुण</td>
                                <td style="background: #ffff99;">38</td>
                                <td style="background: #00e6ff;">
                                    <input type="text" class="form-control" name="sysctrl_total_score1" value="{{ $clientInputs['sysctrl_total_score1'] ?? '' }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END: गतवर्षाच्या तुलनेत ठेवीतील वाढ, सभासद, संचालक मंडळ, निकाल Design -->

                    <!-- START: उत्पन्न (Earnings) Design as per pasted image -->
                    <table class="table table-bordered" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    4. उत्पन्न (Earnings) :- <span style="font-weight:normal;">17 गुण</span>
                                </th>
                            </tr>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>तपशील</th>
                                <th>लक्ष्य गुण</th>
                                <th>एकूण गुण</th>
                                <th>तपशील गुण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="6">1</td>
                                <td class="text-start">निव्वळ नफ्याचे सरासरी खेळत्या भांडवलाशी प्रमाण :</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-start">अ) 1% पेक्षा अधिक असल्यास</td>
                                <td>10</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_1_detail" value="{{ $clientInputs['earnings_net_profit_1_detail'] ?? '' }}"></td>
                            </tr>

                            <tr>
                                <td class="text-start">ब) 0.80% पेक्षा अधिक ते 1% असल्यास</td>
                                <td>8</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_2_detail" value="{{ $clientInputs['earnings_net_profit_2_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">क) 0.50% पेक्षा अधिक ते 0.80% असल्यास</td>
                                <td>6</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_3_detail" value="{{ $clientInputs['earnings_net_profit_3_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">ड) 0.20% पेक्षा अधिक ते 0.50% असल्यास</td>
                                <td>4</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_4_detail" value="{{ $clientInputs['earnings_net_profit_4_detail'] ?? '' }}"></td>
                            </tr>

                            <tr>
                                <td class="text-start">इ) 0.20% पर्यंत असल्यास</td>
                                <td>2</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_5_detail" value="{{ $clientInputs['earnings_net_profit_5_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td rowspan="4">2</td>
                                <td class="text-start">व्यवस्थापन खर्चाचे सरासरी खेळत्या भांडवलाशी प्रमाण :</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-start">अ) 2% पर्यंत असल्यास</td>
                                <td>5</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_mgmt_exp_1_detail" value="{{ $clientInputs['earnings_mgmt_exp_1_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">ब) 2% पेक्षा अधिक ते 2.5% असल्यास</td>
                                <td>3</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_mgmt_exp_2_detail" value="{{ $clientInputs['earnings_mgmt_exp_2_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">क) 2.5% पेक्षा अधिक ते 3% असल्यास</td>
                                <td>2</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_mgmt_exp_3_detail" value="{{ $clientInputs['earnings_mgmt_exp_3_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">ड) 3% पेक्षा अधिक असल्यास</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_mgmt_exp_4_detail" value="{{ $clientInputs['earnings_mgmt_exp_4_detail'] ?? '' }}"></td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td class="text-start">
                                    तरतुदी :<br>
                                    कलम 65, नियम 49 अ मधील तरतूदी व नियामक मंडळाकडील
                                    परिपत्रकीय सूचनांनुसार उत्पादक कर्ज व अनुत्पादक कर्ज गुंतवणूक,
                                    इतर जिंदगी इ.बाबत आवश्यक तरतूदी केल्या असल्यास
                                </td>
                                <td>2</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_provision_detail" value="{{ $clientInputs['earnings_provision_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold" style="text-align:right;background: #ffff99;">एकूण गुण</td>
                                <td style="background: #ffff99;">17</td>
                                <td style="background: #00e6ff;">
                                    <input type="text" class="form-control" name="earnings_total_score1" value="{{ $clientInputs['earnings_total_score1'] ?? '' }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END: उत्पन्न (Earnings) Design -->
                    <!-- start -->
                    <table class="table table-bordered" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th colspan="5" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    5. तरलता (Liquidity) :- <span style="font-weight:normal;">15 गुण</span>
                                </th>
                            </tr>
                            <!-- <tr>
                                <th>अ.क्र.</th>
                                <th>तपशील</th>
                                <th>लक्ष्य गुण</th>
                                <th>एकूण गुण</th>
                                <th>तपशील गुण</th>
                            </tr> -->
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="5">1</td>
                                <td class="text-start">1 वैधानिक तरलता निधी प्रमाण (S.L.R – Statutory Liquidity Ratio) :-</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-start">अ) नियामक मंडळाने निर्धारित केल्यानुसार संस्थेने दैनंदिन पद्धतीने
                                    वैधानिक तरलता निधी प्रमाण राखून तरलतेपोटी कलम 70 व
                                    144-10 अ प्रमाणे गुंतवणूक केली असल्यास
                                </td>
                                <td>3</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_11_detail" value="{{ $clientInputs['earnings_net_profit_11_detail'] ?? '' }}"></td>
                            </tr>

                            <tr>
                                <td class="text-start">अन्यथा</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_12_detail" value="{{ $clientInputs['earnings_net_profit_12_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">ब)संस्थेने वैधानिक तरलता निधीबाबत दैनंदिन पद्धतीने नोंदी ठेवून
                                    मुख्य कार्यकारी अधिकारी यानी अशा नोंदी प्रमाणित करून संचालक
                                    मंडळ सभेत दरमहा नोंद घेतली असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_13_detail" value="{{ $clientInputs['earnings_net_profit_13_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">अन्यथा</td>
                                <td>0</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td rowspan="4"></td>
                                <td class="text-start">क) नियामक मंडळाने निर्धारित केल्यानुसार संस्थेने वैधानिक तरलता
                                    निधीचे विहित नमुन्यातील तिमाही विवरणपत्र विहित मुदतीत
                                    निबंधक कार्यलयास सादर केले असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_15_detail" value="{{ $clientInputs['earnings_net_profit_15_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">अन्यथा</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_16_detail" value="{{ $clientInputs['earnings_net_profit_16_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">रोख राखीव निधी प्रमाण (C.R.R.-Cash Reserve Ratio):—</td>
                                <td></td>
                                <td>3</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-start">अ) नियामक मंडळाने निर्धारित केल्यानुसार संस्थेने दैनंदिन
                                    पद्धतीने रोख राखीव निधी प्रमाण राखून कलम 70 व 144 -9 अ
                                    चे पालन केले असल्यास</td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_17_detail" value="{{ $clientInputs['earnings_net_profit_17_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">अन्यथा</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_18_detail" value="{{ $clientInputs['earnings_net_profit_18_detail'] ?? '' }}"></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td class="text-start">
                                    ब)संस्थेने रोख राखीव निधीबाबत दैनंदिन पद्धतीने नोंदी ठेवून
                                    मुख्य कार्यकारी अधिकारी यांनी अशा नोंदी प्रमाणित करून
                                    संचालक मंडळ सभेत दरमहा नोंद घेतली असल्यास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_19_detail" value="{{ $clientInputs['earnings_net_profit_19_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    क) नियामक मंडळाने निर्धारित केल्यानुसार संस्थेने रोख राखीव
                                    निधीचे विहीत नमुन्यातील तिमाही विवरण विहित मुदतीत निबंधक
                                    कार्यालयास सादर केले असल्यास
                                </td>
                                <td>1</td>
                                <td></td>
                                <td> <input type="text" class="form-control" name="earnings_net_profit_20_detail" value="{{ $clientInputs['earnings_net_profit_20_detail'] ?? '' }}"> </td>
                            </tr>
                              <tr>
                                <td></td>
                                <td class="text-start">अन्यथा</td>
                                <td>0</td>
                                <td></td>
                                <td><input type="text" class="form-control" name="earnings_net_profit_18_detail" value="{{ $clientInputs['earnings_net_profit_18_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="text-start">
                                    एकूण गुंतवणूकीत अनुत्पादक गुंतवणूकीचे प्रमाण :-
                                </td>
                                <td></td>
                                <td>5</td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    अ) 5% पेक्षा कमी असल्यास
                                </td>
                                <td>5</td>
                                <td></td>
                                <td> <input type="text" class="form-control" name="earnings_net_profit_21_detail" value="{{ $clientInputs['earnings_net_profit_21_detail'] ?? '' }}"> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    ब) 5% ते 10% पर्यंत असल्यास
                                </td>
                                <td>4</td>
                                <td></td>
                                <td> <input type="text" class="form-control" name="earnings_net_profit_22_detail" value="{{ $clientInputs['earnings_net_profit_22_detail'] ?? '' }}"> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    क) 10% पेक्षा अधिक ते 20% पर्यंत असल्यास
                                </td>
                                <td>2</td>
                                <td></td>
                                <td> <input type="text" class="form-control" name="earnings_net_profit_23_detail" value="{{ $clientInputs['earnings_net_profit_23_detail'] ?? '' }}"> </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-start">
                                    ड) 10% पेक्षा अधिक असल्यास
                                </td>
                                <td>0</td>
                                <td></td>
                                <td> <input type="text" class="form-control" name="earnings_net_profit_24_detail" value="{{ $clientInputs['earnings_net_profit_24_detail'] ?? '' }}"> </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="text-start">
                                    राखीव निधीची 100% गुंतवणूक कलम 70 प्रमाणे केली असल्यास
                                </td>
                                <td></td>
                                <td>2</td>
                                <td> <input type="text" class="form-control" name="earnings_net_profit_25_detail" value="{{ $clientInputs['earnings_net_profit_25_detail'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold" style="text-align:right;background: #ffff99;">एकूण गुण</td>
                                <td style="background: #ffff99;">15</td>
                                <td style="background: #00e6ff;">
                                    <input type="text" class="form-control" name="earnings_total_score2" value="{{ $clientInputs['earnings_total_score2'] ?? '' }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- end -->
                    <!-- START: कार्यपद्धती व नियंत्रण (System And Control) Design as per pasted image -->
                    <table class="table table-bordered" style="min-width:1000px;">
                        <thead>
                            <tr>
                                <th colspan="4" class="fw-bold" style="text-align:left;background: #f5f5f5;">
                                    6. कार्यपद्धती व नियंत्रण (System And Control) :- <span style="font-weight:normal;">30 गुण</span>
                                </th>
                            </tr>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>तपशील</th>
                                <th>गुण</th>
                                <th>तपशील गुण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-start">नियामक मंडळ निर्णयाप्रमाणे ठेवीवरील द्यावयाच्या कमाल व्याजदर
                                    मर्यादित पालन केले असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_deposit_interest_limit" value="{{ $clientInputs['sysctrl_deposit_interest_limit'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-start">नियामक मंडळाच्या निर्णयानुसार स्थिरिकरण व तरलता सहाय्य निधीस अंशदान मुदतीत भरणा केले असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_stabilization_fund" value="{{ $clientInputs['sysctrl_stabilization_fund'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td rowspan="5">3</td>
                                <td class="text-start">दोष दुरुस्ती अहवाल :-</td>
                                <td>5</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-start">अ) वैधानिक लेखापरीक्षण अहवालाचा दोष दुरुस्ती अहवाल विहित
                                    मुदतीत सारद केला असल्यास</td>
                                <td>2</td>
                                <td><input type="text" class="form-control" name="sysctrl_tech_audit_correction" value="{{ $clientInputs['sysctrl_tech_audit_correction'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">ब) वैधानिक लेखापरीक्षण अहवालात नमूद दोषांची पूर्तता केली
                                    असल्यास</td>
                                <td>2</td>
                                <td><input type="text" class="form-control" name="sysctrl_tech_audit_fulfilled" value="{{ $clientInputs['sysctrl_tech_audit_fulfilled'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">क) अंतर्गत लेखापरीक्षण अहवालात नमूद दोषांची पूर्तता केली
                                    असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_account_audit_fulfilled" value="{{ $clientInputs['sysctrl_account_audit_fulfilled'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td class="text-start">ड) खात्याच्या तपासणी अहवालात नमूद दोषांची पूर्तता केली
                                    असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_other_audit_fulfilled" value="{{ $clientInputs['sysctrl_other_audit_fulfilled'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="text-start">संस्थेने हिशोबी पुस्तके कायदा नियम व उपविधीनुसार ठेवली
                                    असल्यास
                                </td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_books_maintained" value="{{ $clientInputs['sysctrl_books_maintained'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td class="text-start">संस्था उपविधीमध्ये नमूद उद्देशाप्रमाणे कामकाज करीत असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_objective_work" value="{{ $clientInputs['sysctrl_objective_work'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td class="text-start">शाखा व मुख्यालय खाती जुळतात अथवा जुळत नसल्यास याबाबत
                                    तयार केलेल्या मेळपत्रकानुसार बाक्या जुळतात व त्यामध्ये तीन महिन्यापेश्रा जास्त काळाच्या नोंदी प्रलबीत नसल्यास </td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_bank_reconciliation" value="{{ $clientInputs['sysctrl_bank_reconciliation'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td class="text-start">वसुल भागभांडवल,ठेवी,कर्जे,गुंतवणूका,व्याज,येणे-देणे इ.याद्याची
                                    बाकी ताळेबंद रक्कमेशी जुळत असल्यास</td>
                                <td>2</td>
                                <td><input type="text" class="form-control" name="sysctrl_balances_match" value="{{ $clientInputs['sysctrl_balances_match'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td class="text-start">बँक खाते बाक्या पासबुक/दाखला यांचेशी जुळत असल्यास अथवा
                                    जुळत नसल्यास याबाबत तयार मेळपत्रकानुसार बाक्या जुळतात व
                                    त्यामध्ये तीन महिन्यापेक्षा जास्त काळाच्या नोंदी प्रलंबित नसल्यास</td>
                                <td>2</td>
                                <td><input type="text" class="form-control" name="sysctrl_bank_passbook_match" value="{{ $clientInputs['sysctrl_bank_passbook_match'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td class="text-start">सभासद “आय” नमुना नोंदवही व सभासद “जे” नमुना यादी
                                    अद्ययावत असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_all_books_listed" value="{{ $clientInputs['sysctrl_all_books_listed'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td class="text-start">सभासदांना अद्ययावत खातेउतारे/पासबुक दिले असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_president_certificate" value="{{ $clientInputs['sysctrl_president_certificate'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td class="text-start">आपला ग्राहक जाणा (KYC-Know Your Customer) निकषांबाबत
                                    100% सभासदांची पूर्तती केली असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_kyc" value="{{ $clientInputs['sysctrl_kyc'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td class="text-start">कर्मचाऱ्यांना कामाचे लेखी आदेश दिले असल्यास/त्यांचे कामात
                                    नियतमालिका बदल केले जात असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_loan_docs" value="{{ $clientInputs['sysctrl_loan_docs'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td class="text-start">रोख रक्कम हाताळणाऱ्या कर्मचाऱ्यांकडून नियमानुसार योग्य ते
                                    सुरक्षा तारण व हमी पत्र (Fidelity Guarntee) घेतले असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_fidelity_guarantee" value="{{ $clientInputs['sysctrl_fidelity_guarantee'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td class="text-start">रोख शिल्लक, कॅश इन ट्रांझिट, इ. मालमत्तेला सर्व समावेशक विमा घेतला असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_cash_insurance" value="{{ $clientInputs['sysctrl_cash_insurance'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>15</td>
                                <td class="text-start">हातावरील रोख शिल्लंक सतत उपविधीनुसार मर्यादेत ठेवली
                                    असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_saving_share_limit" value="{{ $clientInputs['sysctrl_saving_share_limit'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>16</td>
                                <td class="text-start">कलम 79 (1अ) व (1ब) मधील तरतूदी प्रमाणे अनिवार्य
                                    विवरणपत्रे,एम.आय.एस., इतर माहिती निर्धारित मुदतीत संबंधित
                                    निबंधकाकडे सादर केली असल्यास</td>
                                <td>2</td>
                                <td><input type="text" class="form-control" name="sysctrl_section79_reports" value="{{ $clientInputs['sysctrl_section79_reports'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>17</td>
                                <td class="text-start">क्लम 75 2अ मधील तरतूदी प्रमाणे वैधानिक लेखापरीक्षकाची
                                    नियुक्ती केली असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_medical_auditor" value="{{ $clientInputs['sysctrl_medical_auditor'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>18</td>
                                <td class="text-start">आयकर,व्यवसाय कर व इतर कायद्यानुसार लागू असणारी विवरणपत्रे
                                    विहित मुदतीत संबंधीत विभागाकडे दाखल केली असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_tax_certificates" value="{{ $clientInputs['sysctrl_tax_certificates'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>19</td>
                                <td class="text-start">सेवक सेवानियम व भविष्य निर्वाह निधी नियम तयार करून त्याचे
                                    पालन होत असल्यास</td>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="sysctrl_all_records" value="{{ $clientInputs['sysctrl_all_records'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>20</td>
                                
                                <td class="text-start">
                                    संगणकीकरण :- <br>
                                    अ) संस्थेच्या मुख्यालयासह सर्व शाखांचे कामकाज संगणकीकृत
                                    असल्यास<br>
                                    ब) संस्थेचे सेवकांनी संगणक वापराचे अद्यावत प्रशिक्षण घेतले
                                    असल्यास<br>
                                    क) संस्थेचा संगणकीय डाटा सुरक्षित जतन करणेसाठी प्रभावी
                                    उपाययोजना केली असल्यास<br>
                                    ड) ई.डी.पी. व सिस्टीम ऑडीट होऊन त्यातील उणिवांची पूर्तता
                                    केली असल्यास
                                </td>
                                <td>4</td>
                                <td><input type="text" class="form-control" name="sysctrl_branch_control" value="{{ $clientInputs['sysctrl_branch_control'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="fw-bold" style="text-align:right;background: #ffff99;">एकूण गुण</td>
                                <td style="background: #ffff99;">30</td>
                                <td style="background: #00e6ff;">
                                    <input type="text" class="form-control" name="sysctrl_total_score" value="{{ $clientInputs['sysctrl_total_score'] ?? '0.00' }}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- END: कार्यपद्धती व नियंत्रण (System And Control) Design -->

                    <!-- START: गुणांचे सारांश व अंतिम गणना Design as per pasted image -->
                    <table class="table table-bordered" style="min-width:900px;">
                        <thead>
                            <tr>
                                <th>अ.क्र.</th>
                                <th>तपशील</th>
                                <th>एकूण गुण</th>
                                <th>लेखापरीक्षकाने दिलेले गुण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><span style="font-weight:bold;">स्वनिधी (Own Fund)</span></td>
                                <td>45</td>
                                <td><input type="text" class="form-control" name="summary_ownfund_score" value="{{ $clientInputs['summary_ownfund_score'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span style="font-weight:bold;">जिंदगीची गुणवत्ता (Assets Quality)</span></td>
                                <td>55</td>
                                <td><input type="text" class="form-control" name="summary_assets_score" value="{{ $clientInputs['summary_assets_score'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><span style="font-weight:bold;">व्यवस्थापन (Management)</span></td>
                                <td>38</td>
                                <td><input type="text" class="form-control" name="summary_mgmt_score" value="{{ $clientInputs['summary_mgmt_score'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><span style="font-weight:bold;">उत्पन्न (Earnings)</span></td>
                                <td>17</td>
                                <td><input type="text" class="form-control" name="summary_earnings_score" value="{{ $clientInputs['summary_earnings_score'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><span style="font-weight:bold;">तरलता (Liquidity)</span></td>
                                <td>15</td>
                                <td><input type="text" class="form-control" name="summary_liquidity_score" value="{{ $clientInputs['summary_liquidity_score'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td><span style="font-weight:bold;">कार्यपद्धती व नियंत्रण (System And Control)</span></td>
                                <td>30</td>
                                <td><input type="text" class="form-control" name="summary_sysctrl_score" value="{{ $clientInputs['summary_sysctrl_score'] ?? '' }}"></td>
                            </tr>
                            <tr class="fw-bold">
                                <td colspan="2">एकूण गुण</td>
                                <td>200</td>
                                <td><input type="text" class="form-control" name="summary_total_score" value="{{ $clientInputs['summary_total_score'] ?? '' }}"></td>
                            </tr>
                            <tr class="fw-bold">
                                <td colspan="2">एकूण प्राप्त गुण</td>
                                <td colspan="2"><input type="text" class="form-control" name="summary_obtained_score" value="{{ $clientInputs['summary_obtained_score'] ?? '' }}"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4> </h4>
                        <div>
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ url('admin/client/show', $client->id) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                        </div>
                    </div>
                </form>
                <div class="mt-2 mb-4">
                    <span>
                        वरील प्रमाणे लेखापरीक्षकाने दिलेल्या एकूण गुणांपैकी 200 गुण पैकी 2 ने भागून एकूण प्राप्त गुण काढण्यात यावे.
                    </span>
                </div>
                <!-- END: गुणांचे सारांश व अंतिम गणना Design -->
            </div>
            <!-- END: सहकारी पतसंस्था लेखापरीक्षण गुणवत्त्ता Design -->
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const inputNames = [
            'ownfund_1_detail', 'ownfund_2_detail', 'ownfund_3_detail', 'ownfund_4_detail',
            'ownfund_5_detail', 'ownfund_6_detail', 'ownfund_66_detail', 'ownfund_7_detail',
            'ownfund_8_detail', 'ownfund_9_detail', 'ownfund_10_detail', 'ownfund_11_detail',
            'ownfund_12_detail', 'ownfund_13_detail'
        ];

        const inputNames1 = [
            'assets_net_npa_1_detail', 'assets_net_npa_2_detail', 'assets_net_npa_3_detail',
            'assets_gross_npa_1_detail', 'assets_gross_npa_2_detail', 'assets_gross_npa_3_detail', 'assets_gross_npa_4_detail',
            'assets_npa_recovery_1_detail', 'assets_npa_recovery_2_detail', 'assets_npa_recovery_3_detail',
            'loan_doc_1_detail', 'loan_doc_2_detail', 'loan_doc_3_detail', 'loan_doc_4_detail', 'loan_doc_5_detail',
            'loan_doc_6_detail', 'loan_doc_7_detail', 'loan_doc_8_detail', 'loan_doc_9_detail', 'loan_doc_10_detail'
        ];

        const inputNames2 = [
            'mgmt_meeting_detail', 'mgmt_meeting_2_detail', 'mgmt_meeting_3_detail', 'mgmt_policy_detail', 'mgmt_receipt_detail', 'mgmt_expert_detail',
            'mgmt_training_1_detail', 'mgmt_training_2_detail', 'mgmt_training_3_detail', 'mgmt_training_4_detail', 'mgmt_training_5_detail',
            'mgmt_training_6_detail', 'mgmt_training_7_detail', 'mgmt_training_8_detail', 'mgmt_training_9_detail', 'admin_appoint_detail',
            'admin_branch_mgr_detail', 'admin_duty_detail', 'recovery_100_detail', 'recovery_75_99_detail', 'recovery_50_74_detail',
            'recovery_25_49_detail', 'recovery_below_25_detail', 'deposit_growth_above_10_detail', 'deposit_growth_5_10_detail',
            'deposit_growth_below_5_detail', 'member_admission_detail', 'member_nomination_detail', 'member_loan_share_detail'
        ];
        const inputNames3 = [
            'earnings_net_profit_1_detail', 'earnings_net_profit_2_detail', 'earnings_net_profit_3_detail', 'earnings_net_profit_4_detail',
            'earnings_net_profit_5_detail', 'earnings_mgmt_exp_1_detail', 'earnings_mgmt_exp_2_detail', 'earnings_mgmt_exp_3_detail', 'earnings_mgmt_exp_4_detail',
            'earnings_provision_detail'
        ];
        const inputNames4 = [
            'earnings_net_profit_11_detail', 'earnings_net_profit_12_detail', 'earnings_net_profit_13_detail', 'earnings_net_profit_15_detail',
            'earnings_net_profit_16_detail', 'earnings_net_profit_17_detail', 'earnings_net_profit_18_detail', 'earnings_net_profit_19_detail',
            'earnings_net_profit_20_detail', 'earnings_net_profit_21_detail', 'earnings_net_profit_22_detail', 'earnings_net_profit_23_detail',
            'earnings_net_profit_24_detail'
        ];
        const inputNames5 = [
            'sysctrl_deposit_interest_limit', 'sysctrl_stabilization_fund', 'sysctrl_tech_audit_correction', 'sysctrl_tech_audit_fulfilled',
            'sysctrl_account_audit_fulfilled', 'sysctrl_other_audit_fulfilled', 'sysctrl_books_maintained', 'sysctrl_objective_work',
            'sysctrl_bank_reconciliation', 'sysctrl_balances_match', 'sysctrl_bank_passbook_match', 'sysctrl_all_books_listed', 'sysctrl_president_certificate',
            'sysctrl_kyc', 'sysctrl_loan_docs', 'sysctrl_fidelity_guarantee', 'sysctrl_cash_insurance', 'sysctrl_saving_share_limit',
            'sysctrl_section79_reports', 'sysctrl_medical_auditor', 'sysctrl_tax_certificates', 'sysctrl_all_records', 'sysctrl_branch_control'
        ];

        function calculateTotal() {
            let total = 0;
            let total1 = 0;
            let total2 = 0;
            let total3 = 0;
            let total4 = 0;
            let total5 = 0;

            inputNames.forEach(name => {
                let value = parseFloat($(`[name="${name}"]`).val()) || 0;
                total += value;
            });
            $('[name="ownfund_total_score"]').val(total.toFixed(2));
            $('[name="summary_ownfund_score"]').val(total.toFixed(2));

            inputNames1.forEach(name => {
                let value = parseFloat($(`[name="${name}"]`).val()) || 0;
                total1 += value;
            });
            $('[name="assets_total_score"]').val(total1.toFixed(2));
            $('[name="summary_assets_score"]').val(total1.toFixed(2));

            inputNames2.forEach(name => {
                let value = parseFloat($(`[name="${name}"]`).val()) || 0;
                total2 += value;
            });
            $('[name="sysctrl_total_score1"]').val(total2.toFixed(2));
            $('[name="summary_mgmt_score"]').val(total2.toFixed(2));

            inputNames3.forEach(name => {
                let value = parseFloat($(`[name="${name}"]`).val()) || 0;
                total3 += value;
            });
            $('[name="earnings_total_score1"]').val(total3.toFixed(2));
            $('[name="summary_earnings_score"]').val(total3.toFixed(2));
            inputNames4.forEach(name => {
                let value = parseFloat($(`[name="${name}"]`).val()) || 0;
                total4 += value;
            });
            $('[name="earnings_total_score2"]').val(total4.toFixed(2));
            $('[name="summary_liquidity_score"]').val(total4.toFixed(2));

            inputNames5.forEach(name => {
                let value = parseFloat($(`[name="${name}"]`).val()) || 0;
                total5 += value;
            });
            $('[name="sysctrl_total_score"]').val(total5.toFixed(2));
            $('[name="summary_sysctrl_score"]').val(total5.toFixed(2));
            $('[name="summary_total_score"]').val((total + total1 + total2 + total3 + total4 + total5).toFixed(2));
            let summary = ((total + total1 + total2 + total3 + total4 + total5) / 200) * 100;
            $('[name="summary_obtained_score"]').val(summary.toFixed(2) + '%');

        }

        // ✅ Calculate once when page loads
        calculateTotal();
    });
</script>

@endsection