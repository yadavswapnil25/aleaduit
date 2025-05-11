@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet One</h4>
                <div>
                    <!-- <button class="btn btn-success">Save</button> -->
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
            <center>
                <h2>अनुक्रमणिका </h2>
            </center>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>क्र. सं.</th>
                        <th>तपशिल</th>
                        <th>पान क्र.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>लेखापरीक्षण निर्देशांच्या आदेश/ पत्रकांची आदेश व लेखापरीक्षण मुख्य माहिती</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>सारांश अहवाल (Executive Summary)</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>नमुना :- 1 चे सर्वसाधारण शेरे व माहिती</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>नमुना :- 8 चे सर्वसाधारण शेरे व माहिती</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>कलम 81 (2) नुसार 1 ते 9 मुददावर द्यावयाचे शेरे</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><b>विभाग "अ"</b></td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>

                            <ol>
                                <li>अ) गैरव्यहार, अफरातफर फसवणुक, बनावट कागदपत्रांद्वारे लेखापरीक्षणात निर्देशनास आलेला अपहार :-</li>
                            </ol>
                        </td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>ब) लेखापरीक्षणात निर्देशनास आलेल्या आर्थीक नुकसानीबाबत.</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>क) अन्य महत्वाच्या व ग्रभीर बाबी ज्या निबंधकाच्या निर्देशनास आणने आवश्यक आहे.</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>विभाग ‘‘ब’’</b></td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>अ) व्यवस्थापन विभाग</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1. संस्था नोंदणी</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2. संस्था कार्यक्षेत्र</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3. संस्थेचे मुख्य कार्यालय व शाखा</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>4. संस्थेचे उददेश</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>5. सभासदत्व</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>6. सभा कामकाज</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>7. संस्थेचे संचालक मंडळ निवडणुक कालावधी</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>8. अंतर्गत नियंत्रण</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1) सेवक कामकाज</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2) शाखा अंतर्गत व्यवहार</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3) विविध लेखापरीक्षण व अन्य तपासण्या</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>9. कायदा, नियम व पोटनियमाचे उल्लंघन</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>10. स्वनिधी व भागाचे नक्त मुल्य</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>11. पतसंस्था नियामक मंडळ कामकाज/उल्लंघनाच्या बाबी</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>12. संस्थेच्या उपविधी दुरुस्तीबाबत</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>13. संस्था विमा </td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>ब) आर्थीक पत्रके विवेचन</b> </td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1. ताळेबंद विवेचन </td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2. नफा तोटा पत्रक</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>क) आर्थिक प्रमाणके</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td><b>थकबाकी</b></td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1. थकबाकी रक्कम</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2. एन. पी. ए. प्रमाणे</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td><b>विभाग "क"</b></td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>लेखापरीक्षण प्रमाणपत्र नमुना "ए - 2"</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>नियम 69 (6) नुसारची परिशिष्टे 1 ते 5</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>लेखापरीक्षण वर्गवारी गुणांक</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>प्रमाणित ताळेबंद व नफा – तोटा पत्रक (पदाधिकारी, वैधानिक लेखापरीक्षकाच्या सही शिक्कयासह)</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>बँक बाकी पत्रके व बँक ताळमेळ पत्रके</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>रोख शिल्लक प्रमाणपत्रे</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>वसुल भाग भांडवल यादी/सारांश पत्रक (Summery Report)</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>ठेव यादी / सारांश पत्रक (Summery Report)</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>कर्जे यादी/ सारांश पत्रक (Summery Report)</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>इतर देणी याद्या/ सारांश पत्रक (Summery Report)</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td>इतर देणी याद्या/ सारांश पत्रक</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td>संचालक ठेव यादी</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>21</td>
                        <td>संस्था कर्मचारी यादी</td>
                        <td>-- ते --</td>
                    </tr>
                    <tr>
                        <td>22</td>
                        <td>इतर आवश्यक कागदपत्रे</td>
                        <td>-- ते --</td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <form action="{{ route('admin.client.saveInputs', $client->id) }}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>अ. क्र.</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>संस्थेचे नाव व नोंदणी क्रमांक</td>
                            <td><b>{{$client->name_of_society}} {{ $client->registration_no }}</b></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>संस्थेचा नोंदणी क्रमांक व दिनांक</td>
                            <td><b>{{ $client->registration_no }} {{ $client->registration_date }}</b></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>संस्थेचा कार्यक्षेत्र</td>
                            <td><b>{{$client->karyashetra}}</b></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>संस्थेच्या शाखा</td>
                            <td>
                                <b>
                                    <input type="text" class="form-control" name="branches" placeholder="Enter value" value="{{ $clientInputs['branches'] ?? '' }}">
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>संचालक मंडळाचा कालावधी</td>
                            <td><b><input type="text" class="form-control" name="board_duration" placeholder="Enter value" value="{{ $clientInputs['board_duration'] ?? '' }}"></b></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>अध्यक्षाचे नाव दुरध्वनी क्रमांक</td>
                            <td><b>{{$client->chairman}}</b></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>उपाध्यक्षाचे नाव</td>
                            <td><b>{{$client->vice_chairman}}</b></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>सचिवाचे नाव</td>
                            <td><b>{{$client->manager}}</b></td>

                        </tr>
                        <tr>
                            <td>9</td>
                            <td>निवडणुकीची तारीख</td>
                            <td><input type="date" class="form-control" name="election_date" value="{{ $clientInputs['election_date'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td>वसुल भाग भागभांडवल</td>
                            <td><b>रु. {{$client['वसुल भाग भागभांडवल_sum']}}</b></td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>निधि</td>
                            <td><b>रु. {{$client['राखीव निधी_sum']}}</b></td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>ठेवी</td>
                            <td><b>रु. {{$client['ठेवी_sum']}}</b></td>
                        </tr>
                        <tr>
                            <td>13</td>
                            <td>घेतलेले कर्ज</td>
                            <td><input type="number" class="form-control" name="loans_taken" placeholder="Enter value" value="{{ $clientInputs['loans_taken'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>14</td>
                            <td>सभासदांना दिलेले कर्ज</td>
                            <td><input type="number" class="form-control" name="loans_given" placeholder="Enter value" value="{{ $clientInputs['loans_given'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>सभासद संख्या</td>
                            <td><input type="number" class="form-control" name="member_count" placeholder="Enter value" value="{{ $clientInputs['member_count'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>16</td>
                            <td>गुंतवणुक</td>
                            <td><b>रु. {{$client['गुंतवणूक_sum']}}</b></td>
                        </tr>
                        <tr>
                            <td>17</td>
                            <td>नफा / तोटा</td>
                            <td>रु. 173920.00</td>
                        </tr>
                        <tr>
                            <td>18</td>
                            <td>लेखापरीक्षण वर्गवारी (मागील तिन वर्ष)</td>
                            <td><input type="text" class="form-control" name="audit_classification"  value="{{ $clientInputs['audit_classification'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>19</td>
                            <td>संस्थेने निबंधकाकडे सादर केलेली वसुली प्रकरणे व रक्कम</td>
                            <td><input type="text" class="form-control" name="recovery_cases" placeholder="निर्लेख" value="{{ $clientInputs['recovery_cases'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>20</td>
                            <td>संस्थेची स्वतची इमारत आहे काय?</td>
                            <td>
                                <select class="form-control" name="own_building">
                                    <option value="होय" {{ (isset($clientInputs['own_building']) && $clientInputs['own_building'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['own_building']) && $clientInputs['own_building'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>21</td>
                            <td>संस्थेकडे असलेली वाहने.</td>
                            <td>
                                <select class="form-control" name="vehicles">
                                    <option value="होय" {{ (isset($clientInputs['vehicles']) && $clientInputs['vehicles'] == 'होय') ? 'selected' : '' }}>होय</option>
                                    <option value="नाही" {{ (isset($clientInputs['vehicles']) && $clientInputs['vehicles'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>22</td>
                            <td>संस्थेकडे असलेले एकुन कर्मचारी</td>
                            <td><input type="number" class="form-control" name="total_employees" value="{{ $clientInputs['total_employees'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>23</td>
                            <td>खेळते भागभांडवल</td>
                            <td><input type="text" class="form-control" name="working_capital" value="{{ $clientInputs['working_capital'] ?? '' }}"></td>
                        </tr>
                        <tr>
                            <td>24</td>
                            <td>संचित नफा/तोटा</td>
                            <td><input type="text" class="form-control" name="accumulated_profit_loss" value="{{$client['संचित नफा_sum']}}"></td>
                        </tr>
                        <tr>
                            <td>25</td>
                            <td>रोख शिल्लक</td>
                            <td><input type="text" class="form-control" name="cash_balance" value="{{$client['रोख शिल्लक_sum']}}"></td>
                        </tr>
                        <tr>
                            <td>26</td>
                            <td>बँक शिल्लक</td>
                            <td><input type="text" class="form-control" name="bank_balance" value="{{$client['बँक शिल्लक_sum']}}"></td>
                        </tr>
                        <tr>
                            <td>27</td>
                            <td>सभासद संख्या</td>
                            <td><input type="number" class="form-control" name="member_count" value="{{ $clientInputs['member_count'] ?? '' }}"></td>
                        </tr>
                    </tbody>
                </table>
                <hr />
                <div class="container mt-4">
                    <h5 class="text-center">नमुना क्र. 1<br>लेखापरिक्षण अहवाल (सर्व सहकारी संस्थासाठी )<br>विभाग - पहिला</h5>

                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <td>संस्थेचे नाव</td>
                                <td><b>{{$client->name_of_society}}</b></td>
                            </tr>
                            <tr>
                                <td>नोंदलेला संपूर्ण पत्ता</td>
                                <td><b>{{$client->society_address}}</b></td>
                            </tr>
                            <tr>
                                <td>तालुका (गड)</td>
                                <td><b>{{$client->taluka}}</b></td>
                            </tr>
                            <tr>
                                <td>नोंदणी क्रमांक</td>
                                <td><b>{{$client->registration_no}}</b></td>
                            </tr>
                            <tr>
                                <td>नोंदणी दिनांक</td>
                                <td><b>{{$client->registration_date}}</b></td>
                            </tr>
                            <tr>
                                <td>कार्यक्षेत्र</td>
                                <td><b>{{$client->karyashetra}}</b></td>
                            </tr>
                            <tr>
                                <td>शाखा व दुकाने यांची संख्या</td>
                                <td><input type="text" class="form-control" name="branch_count" placeholder="निर्लेख" value="{{ $clientInputs['branch_count'] ?? '' }}"></td>
                            </tr>

                            <tr>
                                <th colspan="2">अ) लेखापरीक्षा विषयक माहीती</th>
                            </tr>
                            <tr>
                                <td>1.लेखापरीक्षण करणाऱ्या अधिकाऱ्याचे नाव</td>
                                <td>ग्रा.वि. सो. कर्मचाऱ्यांची संस्था, शहापूर</td>
                            </tr>
                            <tr>
                                <td>पदनाम</td>
                                <td>श्री. राजकुमार पुळराम बावणे</td>
                            </tr>
                            <tr>
                                <td>मुख्यालय</td>
                                <td>श्री. हेमंत अशोक बिजने</td>
                            </tr>
                            <tr>
                                <td>2.लेखा परीक्षणाचा कालावधी वर्ष</td>
                                <td><input type="date" class="form-control" name="audit_period" value="{{ $clientInputs['audit_period'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3.दिनांक</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.लेखापरीक्षा सुरू केल्याचे व चालु ठेवल्याचेदि.</td>
                                <td><input type="date" class="form-control" name="audit_start_date" value="{{ $clientInputs['audit_start_date'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2.लेखापरीक्षा संपविल्याचा दिनांक</td>
                                <td><input type="date" class="form-control" name="audit_end_date" value="{{ $clientInputs['audit_end_date'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3.लेखापरीक्षा सादर केल्याचा दिनांक</td>
                                <td><input type="date" class="form-control" name="audit_submission_date" value="{{ $clientInputs['audit_submission_date'] ?? '' }}"></td>
                            </tr>

                            <tr>
                                <th colspan="2">२) सभासद</th>
                            </tr>
                            <tr>
                                <td>1.सभासद संख्या</td>
                                <td><input type="number" class="form-control" name="total_members" value="{{ $clientInputs['total_members'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>अ) व्यक्तीगत</td>
                                <td><input type="number" class="form-control" name="individual_members" value="{{ $clientInputs['individual_members'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>1.सर्वसाधारण नियमित</td>
                                <td><input type="text" class="form-control" name="regular_members" placeholder="निर्लेख" value="{{ $clientInputs['regular_members'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>२.नाममात्र</td>
                                <td><input type="text" class="form-control" name="nominal_members" value="{{ $clientInputs['nominal_members'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>३) हितचिंतक</td>
                            </tr>
                            <tr>
                                <td>ब) संस्था</td>
                                <td><input type="text" class="form-control" name="institution_members" value="{{ $clientInputs['institution_members'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>क) अन्य (अन्य सदस्यांची माहिती
                                    तपशिलवार द्यावी)</td>
                                <td><input type="text" class="form-control" name="other_members" value="{{ $clientInputs['other_members'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>एकूण</td>
                                <td>39</td>
                            </tr>

                            <tr>
                                <td>२.नवे सभासद यथोचितरित्या कुऊन घेतले आहेत काय?
                                    ज्यांनी प्रवेश शुल्क दिले आहेत काय?</td>
                                <td>
                                    <select class="form-control" name="new_members_fee_paid">
                                        <option value="होय" {{ (isset($clientInputs['new_members_fee_paid']) && $clientInputs['new_members_fee_paid'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['new_members_fee_paid']) && $clientInputs['new_members_fee_paid'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>3) त्यांचे लेखी अर्ज घेण्यात आलेले असून ते योग्य
                                    होय.
                                    रीतीने नियत क्रमात केले आहेत काय?</td>
                                <td>
                                    <select class="form-control" name="written_applications_received">
                                        <option value="होय" {{ (isset($clientInputs['written_applications_received']) && $clientInputs['written_applications_received'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['written_applications_received']) && $clientInputs['written_applications_received'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>४)महाराष्ट्र सहकारी संस्थेच्या 1961 च्या कानुनातील
                                    नियम 32 आणि 65 (1) अन्वेय द्ररविलेल्या 'आय' या
                                    नमुन्यात सभासदांची नोंदवही ठेवली आहे काय?</td>
                                <td>
                                    <select class="form-control" name="member_register_maintained">
                                        <option value="होय" {{ (isset($clientInputs['member_register_maintained']) && $clientInputs['member_register_maintained'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['member_register_maintained']) && $clientInputs['member_register_maintained'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>5)महाराष्ट्र सहकारी संस्थेच्या 1961 च्या कानुनातील
                                    नियम 33 अन्वेय' जे आा नमुन्यात सभासदांची
                                    होय.
                                    होय.
                                    नोंदवही ठेवली आहे काय?</td>
                                <td>
                                    <select class="form-control" name="member_register_maintained_rule_33">
                                        <option value="होय" {{ (isset($clientInputs['member_register_maintained_rule_33']) && $clientInputs['member_register_maintained_rule_33'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['member_register_maintained_rule_33']) && $clientInputs['member_register_maintained_rule_33'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>6)मृत, काढुन ट्राकलेल्या व राजीनामा दिलेल्या सभासदांच्या बाबतीत त्यांच्या नावापुढे वरीलप्रमाणे योग्य
                                    ती नोंद केली आहे काय?</td>
                                <td>
                                    <select class="form-control" name="deceased_resigned_members_recorded">
                                        <option value="होय" {{ (isset($clientInputs['deceased_resigned_members_recorded']) && $clientInputs['deceased_resigned_members_recorded'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['deceased_resigned_members_recorded']) && $clientInputs['deceased_resigned_members_recorded'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>7)राजीनामे रीतसर आहेत काय आणि ते यथोचितरीत्या
                                    स्वीकारले आहेत काय?</td>
                                <td>
                                    <select class="form-control" name="resignations_properly_accepted">
                                        <option value="होय" {{ (isset($clientInputs['resignations_properly_accepted']) && $clientInputs['resignations_properly_accepted'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['resignations_properly_accepted']) && $clientInputs['resignations_properly_accepted'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>8)महाराष्ट्र सहकारी संस्थेच्या 1961 च्या कानुनातीलनियम
                                    25 अन्वेय वारस (नॉमिनी) नेमुन दिले आहूते काय?
                                    आणि त्याचे नोंद्र 26 व्या नियमाप्रमाणे सभासदांच्या....
                                    नोंदवहीत. यथोचितरीत्या केली आहे काय?</td>
                                <td>
                                    <select class="form-control" name="nominee_appointed">
                                        <option value="होय" {{ (isset($clientInputs['nominee_appointed']) && $clientInputs['nominee_appointed'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['nominee_appointed']) && $clientInputs['nominee_appointed'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>


                            <tr>
                                <td colspan="2">3)भाग :-</td>
                            </tr>
                            <tr>
                                <td>1)भागाकरिता आलेले अर्ज बरोबर आहेत काय?</td>
                                <td>
                                    <select class="form-control" name="share_applications_correct">
                                        <option value="होय" {{ (isset($clientInputs['share_applications_correct']) && $clientInputs['share_applications_correct'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['share_applications_correct']) && $clientInputs['share_applications_correct'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>2)भागाची नोंदवही अद्यावत ठेवलेली आहेत काय?
                                </td>
                                <td>
                                    <select class="form-control" name="share_register_updated">
                                        <option value="होय" {{ (isset($clientInputs['share_register_updated']) && $clientInputs['share_register_updated'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['share_register_updated']) && $clientInputs['share_register_updated'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>3)भागाची नोंदवहीतील नोंदी किद्रीतील नोंदीशी जुळतात
                                    काय?
                                </td>
                                <td>
                                    <select class="form-control" name="share_register_entries_match">
                                        <option value="होय" {{ (isset($clientInputs['share_register_entries_match']) && $clientInputs['share_register_entries_match'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['share_register_entries_match']) && $clientInputs['share_register_entries_match'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>4)भागाची खतावणी अद्यावत लिहिली आहे काय?
                                </td>
                                <td>
                                    <select class="form-control" name="share_ledger_updated">
                                        <option value="होय" {{ (isset($clientInputs['share_ledger_updated']) && $clientInputs['share_ledger_updated'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['share_ledger_updated']) && $clientInputs['share_ledger_updated'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>5)भागाची एकुण खतावणी बाकी ताळेबंदातील
                                    नाही.
                                    आगभांडवलाच्या आकड्याशी जुळते काय?
                                </td>
                                <td>
                                    <select class="form-control" name="share_ledger_balance_matches">
                                        <option value="होय" {{ (isset($clientInputs['share_ledger_balance_matches']) && $clientInputs['share_ledger_balance_matches'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['share_ledger_balance_matches']) && $clientInputs['share_ledger_balance_matches'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>6)भागधारकांना ज्यानी घेतलेल्या सर्व भागाबदल भगपत्रे
                                    होय.
                                    दिली आहेत काय?
                                </td>
                                <td>
                                    <select class="form-control" name="share_certificates_issued">
                                        <option value="होय" {{ (isset($clientInputs['share_certificates_issued']) && $clientInputs['share_certificates_issued'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['share_certificates_issued']) && $clientInputs['share_certificates_issued'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>7)भागाची हस्तांतरण (ट्रान्स्फर) अगर त्यांची किंमत परत
                                    नाही.
                                    द्वेणे.या गोष्टी कायद्रा कानून व प्रोटुनियम यातील
                                    तरतुदीप्रमाणे झाल्या आहेत काय?
                                </td>
                                <td>
                                    <select class="form-control" name="share_transfers_legal">
                                        <option value="होय" {{ (isset($clientInputs['share_transfers_legal']) && $clientInputs['share_transfers_legal'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['share_transfers_legal']) && $clientInputs['share_transfers_legal'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">4)बाहेरील कर्ज :-</td>
                            </tr>
                            <tr>
                                <td>1)प्रोटूनियमाप्रमाणे संस्थेने कर्ज घेण्याची मर्यादा काय
                                    होय.</td>
                                <td>
                                    <select class="form-control" name="loan_limit_followed">
                                        <option value="होय" {{ (isset($clientInputs['loan_limit_followed']) && $clientInputs['loan_limit_followed'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['loan_limit_followed']) && $clientInputs['loan_limit_followed'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>2)ती उल्लंचिली गेली होती काय ?
                                    प्रश्न उद्भवत नाही.</td>
                                <td>
                                    <select class="form-control" name="loan_limit_exceeded">
                                        <option value="होय" {{ (isset($clientInputs['loan_limit_exceeded']) && $clientInputs['loan_limit_exceeded'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['loan_limit_exceeded']) && $clientInputs['loan_limit_exceeded'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>3)जर ती उल्लंचिली गेली असेल तर सक्षम
                                    प्राधिकाऱ्याकडून आवश्यक ती अनुज्ञा मिळवली आहे
                                    काय?</td>
                                <td>
                                    <select class="form-control" name="loan_limit_exceeded_permission">
                                        <option value="होय" {{ (isset($clientInputs['loan_limit_exceeded_permission']) && $clientInputs['loan_limit_exceeded_permission'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['loan_limit_exceeded_permission']) && $clientInputs['loan_limit_exceeded_permission'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">5)सभा :-</td>
                            </tr>
                            <tr>
                                <td>1)दिनांक द्यावेत </td>
                                <td><input type="date" class="form-control" name="meeting_date" value="{{ $clientInputs['meeting_date'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>1)वार्षिक साधारण सभा </td>
                                <td><input type="date" class="form-control" name="annual_general_meeting" value="{{ $clientInputs['annual_general_meeting'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>1)विशेष साधारण सभा </td>
                                <td><input type="date" class="form-control" name="special_general_meeting" value="{{ $clientInputs['special_general_meeting'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2)लेखापरीक्षा कालावधीत भरलेल्या सभांची खालीलप्रमाणे
                                    संख्या द्यावी. :-</td>
                            </tr>
                            <tr>
                                <td>अ) व्यवस्थापक समितीच्या वा संचालक मंडळाच्या प्रभा
                                    कार्यकारी वा उप समितिच्या सभा :-</td>
                                <td><input type="text" class="form-control" name="board_meetings_count" value="{{ $clientInputs['board_meetings_count'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>ब) कार्यकारी वा उप समितिच्या सभा :-</td>
                                <td><input type="text" class="form-control" name="executive_meetings_count" value="{{ $clientInputs['executive_meetings_count'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>क) अन्य अभा :-</td>
                                <td><input type="text" class="form-control" name="other_meetings_count" value="{{ $clientInputs['other_meetings_count'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td colspan="2">6)दोष दुरूस्ती अहवाल :-</td>
                            </tr>
                            <tr>
                                <td>1)संस्थेने गेल्या लेखापरीक्षा अहवालाचे दोषदुरूस्ती
                                    अहवाल पाठविलेला आहेत काय? असल्यास ते दिल्याचे
                                    दिनांक द्या. नसल्यास, ते न दिल्याबद्दलची कारणे द्या. </td>
                                <td><input type="date" class="form-control" name="previous_audit_correction_report_date" value="{{ $clientInputs['previous_audit_correction_report_date'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2)मागील लेखापरीक्षा अहवालात नमुद केलेल्या काही
                                    महत्वाच्या मुद्यायाकडे संस्थेने दुर्लक्ष केले आहे काय?
                                    तसे असल्यास तर सर्व साधारण अभिप्रायात ते नमुद
                                    करा
                                </td>
                                <td>
                                    <select class="form-control" name="previous_audit_issues_ignored">
                                        <option value="होय" {{ (isset($clientInputs['previous_audit_issues_ignored']) && $clientInputs['previous_audit_issues_ignored'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['previous_audit_issues_ignored']) && $clientInputs['previous_audit_issues_ignored'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">7)लेखापरीक्षा शुल्क :-</td>
                            </tr>
                            <tr>
                                <td>1)शेवटच्या लेखापरीक्षा शुल्काची आकारणी रक्कम द्या.
                                    कोणता कालावधी करीता आहे तो कालावधी लिहा.
                                    लेखापरीक्षा शुल्क वसुल झाल्याचा दिनांक, कोषागाराचे
                                    नाव आणि भरलेली रक्कम द्या. (कोषागाराच्या
                                    चलनाचाकमांक व दिनांक द्या.) </td>
                                <td><input type="date" class="form-control" name="last_audit_fee_date" value="{{ $clientInputs['last_audit_fee_date'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2)जर संस्थेने लेखापरीक्षा शुल्क भरली नसेल तर देणे
                                    असलेल्या परीक्षा शुल्काचा तपशील व न भरण्याची
                                    कारणे द्या.
                                </td>
                                <td>
                                    <select class="form-control" name="audit_fee_not_paid">
                                        <option value="होय" {{ (isset($clientInputs['audit_fee_not_paid']) && $clientInputs['audit_fee_not_paid'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['audit_fee_not_paid']) && $clientInputs['audit_fee_not_paid'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">8) अंतर्गत वा स्थानिक लेखापरीक्षा :-</td>
                            </tr>
                            <tr>
                                <td>1)
                                    जर अतर्गत वा स्थानिक लेखापरीक्षा झाली असेल तर
                                    ती कोणी केली. कोणत्या कालावधीसाठी केली व त्याचा
                                    लेखापरीक्षा अहवाल संस्थेच्या दप्तरी आहे काय? याची
                                    माहीती द्या. </td>
                                <td><input type="date" class="form-control" name="internal_audit_date" value="{{ $clientInputs['internal_audit_date'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2) सांविधिक (स्टॅट्युटरी) लेखापरीक्षा व अतर्गत लेखापरीक्षा
                                </td>
                                <td>
                                    <select class="form-control" name="statutory_internal_audit">
                                        <option value="होय" {{ (isset($clientInputs['statutory_internal_audit']) && $clientInputs['statutory_internal_audit'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['statutory_internal_audit']) && $clientInputs['statutory_internal_audit'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">9) कार्यकारी संचालक/व्यवस्थापक/चिटणीस-</td>
                            </tr>
                            <tr>
                                <td>1)अधिकाऱ्याचे नाव </td>
                                <td><b>{{$client->manager}}</b></td>

                            </tr>
                            <tr>
                                <td>2) दरमहा घेतलेले मानधन
                                </td>
                                <td><input type="text" class="form-control" name="monthly_honorarium" value="{{ $clientInputs['monthly_honorarium'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3) त्यांनाअन्ये भत्ते आणि सवलती उदा. विनामुल्य
                                    निवासगृहे आदि उपलब्ध केल्या असल्यास त्या लिहा.

                                </td>
                                <td><input type="text" class="form-control" name="other_allowances" value="{{ $clientInputs['other_allowances'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>4) ते संस्थेचे सभासद आहेत काय ते लिहा.
                                </td>
                                <td><input type="text" class="form-control" name="member_status" value="{{ $clientInputs['member_status'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>5) जर ते सभासद असतील तर त्यांनी कर्ज घेतले आहे
                                    काय? किंवा त्यांना उधार-उचल, सवलती दिल्या आहेत
                                    काय? त्यांचेकडील येणे रक्कमा द्या व त्यातील थकबाकी
                                    किती आहे ते लिहा.
                                </td>
                                <td><input type="text" class="form-control" name="loans_taken_by_manager" value="{{ $clientInputs['loans_taken_by_manager'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>6) अन्य कोणत्या रक्कमा त्यांच्याकडुन येणे असतील तर त्यांचा तपशील द्या.
                                </td>
                                <td><input type="text" class="form-control" name="other_amounts_due_from_manager" value="{{ $clientInputs['other_amounts_due_from_manager'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>6) कर्मचाऱ्यासंबधी त्यांची नावे, पदनामे, शैक्षणिक
                                    पात्रता, वेतन श्रेणी व सध्याचे वेतन, देण्यात येणारे भत्ते,
                                    नेमणुकीचे दिनांक, दिलेली जमानत आदि माहिती
                                    दाखविणारी यादी मिळवा
                                </td>
                                <td><input type="text" class="form-control" name="employee_details" value="{{ $clientInputs['employee_details'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td colspan="2">10) उल्लंघण :-</td>
                            </tr>
                            <tr>
                                <td>1)संस्थेजवळ आपले नोंदलेले पोटनियम, कायदा व कानून
                                    यांची प्रत आहे काय? </td>
                                <td>
                                    <select class="form-control" name="bylaws_copy_available">
                                        <option value="होय" {{ (isset($clientInputs['bylaws_copy_available']) && $clientInputs['bylaws_copy_available'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['bylaws_copy_available']) && $clientInputs['bylaws_copy_available'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>2) कायदा, कानू व पोनियम, यांचे उल्लंघन झाल्याच्या
                                    नोंदी द्या.
                                    1)
                                    कायदा कलम कमांक
                                    2)
                                    कानुन कमांक
                                    3)
                                    पोटनियम कमांक
                                </td>
                                <td><input type="text" class="form-control" name="violations_record" value="{{ $clientInputs['violations_record'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>3) पोटनियमानुसार काही नियम तयार केले आहेत काय?
                                    योग्य त्या अधिकाऱ्याकडुन ते मान्ये करून घेतले आहेत
                                    काय? त्याचे प्रतिपालन योग्य रीतीने होत आहे काय?
                                    (उल्लंघनासंबंधी सर्वसाधारण अभिप्रायात थोडक्यात
                                    चर्चा करावी)
                                </td>
                                <td><input type="text" class="form-control" name="rules_prepared_as_per_bylaws" value="{{ $clientInputs['rules_prepared_as_per_bylaws'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td colspan="2">11) नफा आणि तोटा :-
                                </td>
                            </tr>
                            <tr>
                                <td>1) गेल्या सहकारी वर्षात किती नफा वा तोटा झाला. </td>
                                <td><input type="text" class="form-control" name="profit_loss_last_year" value="{{ $clientInputs['profit_loss_last_year'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>2) निव्वळ नफयाची विभागणी कशी केली ते लिहा.
                                    (निर्व्यवहारी (नॉन-बिझिनेस) संस्थांच्या बाबतीत
                                    प्रश्नांक 11 (2) च्या उत्तरास वाढ वा घट यांच्या
                                    रक्कमा लिहाव्यात.) </td>
                                <td><input type="text" class="form-control" name="profit_distribution" value="{{ $clientInputs['profit_distribution'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td colspan="2">11) रोकड रकमा, बँकेतील शिल्लक, आणि गुंतवणुकी (सेक्युरिटीज) :-
                                    (अ) रोकड जमा :-
                                </td>
                            </tr>
                            <tr>
                                <td>1) शिल्लक मोजा किर्दीवर शिल्लका मोजल्याचा दिनांक व रक्कम नमुद करून सही करा. </td>
                                <td><input type="text" class="form-control" name="cash_balance_date" value="{{ $clientInputs['cash_balance_date'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>2) रोकड रक्कम कोणी मोजावयास सुरवात केली त्याचे
                                    नाव व पदनाम लिहा. रोकड रक्कम ठेवण्याबाबद त्याना पुरेशा अधिकार आहेत काय? </td>
                                <td><input type="text" class="form-control" name="cash_counted_by" value="{{ $clientInputs['cash_counted_by'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>3) किर्दीप्रमाणे रोकड रक्कम बरोबर आहे काय ? </td>
                                <td><input type="text" class="form-control" name="cash_balance_correct" value="{{ $clientInputs['cash_balance_correct'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>4) ने-आण करतांना आणि तिजोरीत ठेवलेल्या शिलकेच्या
                                    रकमेच्या सुरक्षिततेबाबत केलेली व्यवस्था पुरेशी आहे
                                    काय? </td>
                                <td><input type="text" class="form-control" name="cash_security_arrangements" value="{{ $clientInputs['cash_security_arrangements'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>(ब) बँकेतील शिल्लका :-
                                    बँकेतील पास पुस्तकातील त्यानी पाठविलेल्या पत्रकातील
                                    बँकेने दिलेल्या दाखल्यातील शिल्लक रकमा संस्थेच्या
                                    जमाखर्चाच्या बाक्याशी जुळतात काय? जर त्या जुळत
                                    नसतील, तर मेळ पत्रके तपासा.</td>
                                <td><input type="text" class="form-control" name="bank_balance_correct" value="{{ $clientInputs['bank_balance_correct'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td colspan="2">(क) गुंतवणुकी :-
                                </td>
                            </tr>
                            <tr>
                                <td>1) गुंतवणुक रोखे प्रत्याक्षात पहा आणि ते संस्थेच्या
                                    नावावरच आहेत काय ते पहा. </td>
                                <td>
                                    <select class="form-control" name="investments_in_name_of_society">
                                        <option value="होय" {{ (isset($clientInputs['investments_in_name_of_society']) && $clientInputs['investments_in_name_of_society'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['investments_in_name_of_society']) && $clientInputs['investments_in_name_of_society'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>2) गुंतवणुकीवरील लाभांश व व्याज यथावत वसुल
                                    करण्यात येत आहे काय? </td>
                                <td>
                                    <select class="form-control" name="dividends_interest_collected">
                                        <option value="होय" {{ (isset($clientInputs['dividends_interest_collected']) && $clientInputs['dividends_interest_collected'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['dividends_interest_collected']) && $clientInputs['dividends_interest_collected'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>3) जर गुंतवणुक रोक बँकेत ठेवले असतील तर त्या
                                    बाबतचे संबंधित दाखले मिळविले आहेत काय?
                                    लिहिली आहे काय? </td>
                                <td><input type="text" class="form-control" name="investment_certificates_obtained" value="{{ $clientInputs['investment_certificates_obtained'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>4) गुंतवणुकीची नोंद वही ठेवली आहे काय? व ती अद्यावत लिहीली आहेत काय? </td>
                                <td><input type="text" class="form-control" name="investment_register_updated" value="{{ $clientInputs['investment_register_updated'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td colspan="2">13) स्थावर आणि जंगम मालमत्ता :-
                                </td>
                            </tr>
                            <tr>
                                <td>1) संबंधित नोंदवहया ठेवल्या आहेत काय? व त्या अद्यावत
                                    लिहीली आहेत काय? </td>
                                <td><input type="text" class="form-control" name="property_register_updated" value="{{ $clientInputs['property_register_updated'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>2) मालमत्तेची यादी घेवुन प्रत्यक्ष रूजवात घ्या.
                                    ताळेबंदातील रकमेशी या बाक्या जमतात काय? </td>
                                <td><input type="text" class="form-control" name="property_list_matches_balance_sheet" value="{{ $clientInputs['property_list_matches_balance_sheet'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>3) जमीन आदी स्थावर मालमत्तेच्याबाबद त्याचे विलेख
                                    (दस्तऐवज) पहा व ते संस्थेच्या नावावरच आहेत काय हे
                                    पहा.
                                </td>
                                <td><input type="text" class="form-control" name="property_deeds_in_name_of_society" value="{{ $clientInputs['property_deeds_in_name_of_society'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>4) आवश्यक तेथे मालमत्तेचा अद्यावत विमा उतरविला आहे
                                    काय? तसे असल्यास, सर्वसाधारण अभिप्राय त्याचा
                                    तपशिल द्या.
                                </td>
                                <td>
                                    <select class="form-control" name="property_insured">
                                        <option value="होय" {{ (isset($clientInputs['property_insured']) && $clientInputs['property_insured'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['property_insured']) && $clientInputs['property_insured'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">5) झीज (घसारा) :-
                                </td>
                            </tr>
                            <tr>
                                <td>1) घसारा यथावत आकारला आहे काय ? </td>
                                <td>
                                    <select class="form-control" name="depreciation_charged">
                                        <option value="होय" {{ (isset($clientInputs['depreciation_charged']) && $clientInputs['depreciation_charged'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['depreciation_charged']) && $clientInputs['depreciation_charged'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>2) वेगवेगळ्या मालमत्तेवर आकारलेले घसाऱ्याचे दर नमुद
                                    करा </td>
                                <td><input type="text" class="form-control" name="depreciation_rates" value="{{ $clientInputs['depreciation_rates'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>14) तुम्ही लेखापरीक्षा अहवालाच्या मसुद्यासंबंधी
                                    संचालक मंडळ वा व्यवस्थापन समिती यांच्याशी चर्चा
                                    केली आहे काय? नसल्यास, त्याची कारणे लिहा. </td>
                                <td>
                                    <select class="form-control" name="audit_report_discussed">
                                        <option value="होय" {{ (isset($clientInputs['audit_report_discussed']) && $clientInputs['audit_report_discussed'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['audit_report_discussed']) && $clientInputs['audit_report_discussed'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

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
        </div>
    </div>
</div>

@endsection