@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet Three</h4>
                <div>
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
            <form action="{{ route('admin.client.saveInputs', $client->id) }}" method="POST">
                @csrf
                <!-- Report Header -->
                <div class="text-center mb-3">
                    <h5 class="fw-bold" style="text-decoration: underline;">लेखापरीक्षण अहवाल</h5>
                    <div>
                        <span>{{$client->name_of_society}} र. न. {{ $client->registration_no }}</span>
                    </div>
                    <div>
                        लेखापरीक्षण कालावधी<br>
                        @php
                        // If audit_year is in format "YYYY-YYYY", show as "01/04/YYYY - 31/03/YYYY+1"
                        $auditPeriod = '';
                        $start = '';
                        $end = '';
                        if (preg_match('/^(\d{4})-(\d{4})$/', $client->year->audit_year, $m)) {
                        $start = $m[1];
                        $end = $m[2];
                        $auditPeriod = $client->year->audit_year;
                        }
                        @endphp
                        <span style="font-weight: bold;">01/04/{{ $start }} - 31/03/{{ $end }}</span>
                    </div>
                </div>
                <hr>

                <!-- प्रस्ताविक Section -->
                <div>
                    <h6 class="fw-bold">प्रास्ताविक</h6>
                    <p>
                        <span>{{$client->name_of_society}}.</span> (यानंतर संस्था असा उल्लेख करण्यात येईल) ही संस्था
                        महाराष्ट्र सहकारी संस्था अधिनियम 1960 व नियम 1961 अंतर्गत नोंदणीकृत सहकारी संस्था असून संस्थेचा नोंदणी
                        क्रमांक {{$client->registration_no}} दिनांक <b> {{ \Carbon\Carbon::parse($client->registration_date)->format('d-m-Y') }}</b> आहे. संस्थेच्या मुख्यालया व्यतिरिक्त <span><b>{{$client->total_shakha}}</b></span> शाखा आहेत. संस्थेच्या दिनांक <span><b>01/04/{{ $start }} - 31/03/{{ $end }}</b></span>
                        या कालावधीच्या वैधानिक लेखापरीक्षणासाठी संस्थेने त्यांचे दिनांक <span><input type="date" class="form-control d-inline-block" style="width:150px;display:inline;" name="tarav_date" value="{{ isset($clientInputs['tarav_date']) ? $clientInputs['tarav_date'] : '' }}"></span> रोजी पार पडलेल्या वार्षिक सर्वसाधारण
                        सभेतील ठराव क्रमांक <span><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="tarav_number" value="{{ isset($clientInputs['tarav_number']) ? $clientInputs['tarav_number'] : '' }}"></span> <b>{{$client->district}}</b> <span>
                            <input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="tarav_number_1" value="{{ isset($clientInputs['tarav_number_1']) ? $clientInputs['tarav_number_1'] : '' }}"></span> अन्वये अथवा निबंधक यांचे <span style="background: yellow;"><input type="text" class="form-control d-inline-block" style="width:120px;display:inline;" name="tarav_number_2" value="{{ isset($clientInputs['tarav_number_2']) ? $clientInputs['tarav_number_2'] : '' }}"></span>
                        आदेशानुसार वैधानिक लेखापरीक्षक म्हणून
                        आमची नियुक्ती केलेली आहे. संस्थेच्या उक्त कालावधीचे लेखापरीक्षण, संस्थेने पुरवलेल्या लेखी दस्तऐवज व तोंडी
                        माहिती व खुलाशाच्या आधारे पूर्ण केलेले आहे. लेखापरीक्षणासाठी आवश्यक असणारे सर्व रेकॉर्ड व माहिती संस्थेने
                        लेखापरीक्षणावेळी आम्हास उपलब्ध करून दिलेले आहे. लेखापरीक्षण कालावधीत संस्थेचे चेअरमन म्हणून <span>{{$client->chairman}}</span> यांनी व व्हाईस चेअरमन म्हणून श्री. <span>{{$client->vice_chairman}}</span> कार्यकारी अधिकारी म्हणून <span>{{$client->manager}}</span> यांनी कामकाज केले आहे. तसेच संस्थेचे मॅनेजर/मुख्य कार्यकारी अधिकारी म्हणून
                        <span>{{$client->manager}}</span> यांनी कामकाज केलेले आहे.
                    </p>
                </div>

                <!-- परिशिष्ट "अ" Section -->
                <div>
                    <h6 class="fw-bold mt-4">परिशिष्ट – "अ"</h6>
                    <ol>
                        <li>
                            <span class="fw-bold">संशयीत व अफरातफरीचे व्यवहारः-</span>
                            संस्थचे सन <span><b>01/04/{{ $start }} - 31/03/{{ $end }}</b></span> या
                            कालावधीचे लेखापरिक्षण केले असता संशयीत व अफरातफरीचे व्यवहार आढळलेले
                            <select class="form-control" name="member_register_maintained_rule_35">
                                        <option value="">Select</option>
                                        <option value="आहेत" {{ (isset($clientInputs['member_register_maintained_rule_35']) && $clientInputs['member_register_maintained_rule_35'] == 'आहेत') ? 'selected' : '' }}>आहेत</option>
                                        <option value="नाहीत" {{ (isset($clientInputs['member_register_maintained_rule_35']) && $clientInputs['member_register_maintained_rule_35'] == 'नाहीत') ? 'selected' : '' }}>नाहीत</option>
                            </select>
                        </li>
                        <li>
                            महाराष्ट्र सहकारी संस्था अधिनियम 1960 चे कलम 81 अन्वये खालील बाबीची तपासणी व
                            पडताळणी करून खालील प्रमाणे माहीती देत आहे
                        </li>
                    </ol>
                </div>

                <!-- START: Content as per provided image -->
                <div class="mt-4">
                    <div class="fw-bold mb-2">एक.:- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; कोणतेही ऋणे असल्यास त्यांचा बराच काळ थकलेल्या रकमा-</div>
                    <table class="table table-bordered text-center align-middle" style="width:auto;min-width:700px;">
                        <thead>
                            <tr>
                                <th>एकुण
                                    कर्जदार</th>
                                <th>प्रकार</th>
                                <th>यादी वरूण
                                    कर्ज बाकी</th>
                                <th>थकीत
                                    कर्जदार</th>
                                <th>थकीत कर्ज</th>
                                <th>प्रमाण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> <input type="text" class="form-control" name="loan_amt" id="loan_amt" value="{{ isset($clientInputs['loan_amt']) ? $clientInputs['loan_amt'] : '' }}"></td>
                                <td>नियीमत कर्ज व आक्समीक कर्ज</td>

                                <td><input type="text" class="form-control" name="loan" id="loan" value="{{ isset($clientInputs['loan']) ? $clientInputs['loan'] : '' }}"></td>
                                <td><input type="text" class="form-control" name="loan_2" id="loan_2" value="{{ isset($clientInputs['loan_2']) ? $clientInputs['loan_2'] : '' }}"></td>
                                <td><input type="text" class="form-control" name="loan_1" id="loan_1" value="{{ isset($clientInputs['loan_1']) ? $clientInputs['loan_1'] : '' }}"></td>
                                <td> <input type="text" class="form-control" id="loan_percentage" name="loan_percentage" value="{{ $clientInputs['loan_percentage'] ?? '' }}" readonly></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <div class="fw-bold mb-2">दोन. :-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; रोख शिल्लक व कर्ज रोखे आणि संस्थेचा मालमत्ता व दायीत्वे यांचे मुल्यांकन –</div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="fw-bold">रोख शिल्लक :- </span>
                        <span class="ms-2">&nbsp; 31/03/{{ $end }}</span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <span class="ms-2">{{$client['रोख शिल्लक_sum']}}</span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <span class="ms-2">किर्दी प्रमाणे बरोबर आहे</span>
                    </div>
                    --------------------------------------------------------------------------------------------------------------------------------------------------------------------
                    <div class="d-flex align-items-center">
                        <span class="fw-bold">विमा - समुह विमा</span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;

                        
                        <span class="ms-2">

                            <select name="insurance_status" class="form-select d-inline-block w-auto">
                                <option value="" selected>Select</option>
                                <option value="विमा काढलेला नाही" {{ isset($clientInputs['insurance_status']) && $clientInputs['insurance_status'] == 'विमा काढलेला नाही' ? 'selected' : '' }}>विमा काढलेला नाही</option>
                                <option value="विमा काढलेला आहे" {{ isset($clientInputs['insurance_status']) && $clientInputs['insurance_status'] == 'विमा काढलेला आहे' ? 'selected' : '' }}>विमा काढलेला आहे</option>
                                <option value="नाही" {{ isset($clientInputs['insurance_status']) && $clientInputs['insurance_status'] == 'नाही' ? 'selected' : '' }}>नाही</option>
                            </select>
                        </span>
                    </div>
                    --------------------------------------------------------------------------------------------------------------------------------------------------------------------

                </div>
                <!-- END: Content as per provided image -->

                <div class="mt-4">
                    <div class="fw-bold mb-2">गुंतवणूक –</div>
                    <table class="table table-bordered text-center align-middle" style="width:auto;min-width:600px;">
                        <thead>
                            <tr>
                                <th>प्रकार</th>
                                <th>रक्कम</th>
                                <th>टिप्पणी</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>बँकेतील ठेवी</td>
                                <td>{{$client['बँक शिल्लक_sum']}}</td>
                                <td>ताळेबंदा प्रमाणे बरोबर आहे</td>
                            </tr>
                            <tr>
                                <td>मुदती ठेवीत</td>
                                <td>{{$client['गुंतवणूक_sum']}}</td>
                                <td>ताळेबंदा प्रमाणे बरोबर आहे</td>
                            </tr>
                            <tr>
                                <td>मालमत्ता व डेड स्टॉक</td>
                                <td>{{$client['कायम मालमत्ता_sum']}}</td>
                                <td>ताळेबंदा प्रमाणे बरोबर आहे</td>
                            </tr>
                            <tr>
                                <td>दिलेली कर्जे</td>
                                <td>{{$client['येणे कर्ज_sum']}}</td>
                                <td>कायद्याचे आधारे सुरक्षित</td>
                            </tr>
                            <tr>
                                <td>ठेवी जमा</td>
                                <td>{{$client['ठेवी_sum']}}</td>
                                <td>ताळेबंदा प्रमाणे बरोबर आहे</td>
                            </tr>
                            <tr>
                                <td>इतर देणे</td>
                                <td>{{$client['इतर देणी_sum']}}</td>
                                <td>ताळेबंदा प्रमाणे बरोबर आहे</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <div class="fw-bold mb-2">तीन :-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;सभासदाकडुन ठेवीच्या रूपाने जमा केलेल्या रकमातुन व स्वनिधीतुन कर्ज वाटप केले-</div>
                    <table class="table table-bordered text-center align-middle" style="width:auto;min-width:700px;">
                        <thead>
                            <tr>
                                <th>स्वनिधी</th>
                                <th>ठेवी जमा</th>
                                <th>एकूण</th>
                                <th>कर्जवाटप</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
                                <td>{{$total_networth_current}}</td>
                                <td>{{$client['ठेवी_sum']}}</td>
                                <td>{{$total_networth_current + $client['ठेवी_sum']}}</td>
                                <td>{{ $client['येणे कर्ज_sum_currentYear']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
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
                    <p>
                        जमा केलेल्या ठेवी व दिलेल्या कर्ज संस्थेच्या सभासंदाच्या हित
                        संबंधाना बाधक ठरणा-या नाहीत असे आढळले.
                        <br>
                        चार. :-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;केवळ पुस्तकी नोंदीद्वारे झालेले व्यवहार आढळुन आले नाहीत.
                        <br>
                        पाच. :-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;संस्थेने दिलेली कर्ज व आगाउ रकमा ठेवी म्हणून दाखविण्यात आल्याचे व्यवहार
                        आढळुन आल्या नाहीत.
                        <br>
                        सहा. :-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;वैयक्तीक खात्यावरील खर्च महसुली खर्च दाखविल्याचे आढळुन आले नाही.
                        <br>
                        सात. :-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;आपल्या उद्येशा पुर्ती करीता जाहीराती वर खर्च नाही
                        <br>
                        आठ :-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;शासना कडुन अर्थ सहाय मिळाले नाही.
                        <br>
                        नउ :-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;संस्था सदस्या बाबतची आपली उदिष्टे व आबधंने योग्य प्रकारे पार पाडीत आहे.
                        <br>
                        संस्थेचे सन {{$start}}-{{$end}} चे अंकेक्षणा दरम्यान गंभीर स्वरूपाचे दोष आढळून आले नाहीत.
                        त्यामुळे माहीती निरंक आहे.
                        <br>
                        <input type="text" class="form-control d-inline-block" style="width:200px;display:inline;" name="audit_date" value="{{ isset($clientInputs['audit_date']) ? $clientInputs['audit_date'] : '' }}">
                    </p>
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
        let reg = parseInt(document.getElementById('loan').value) || 0;
        let nom = parseInt(document.getElementById('loan_1').value) || 0;
        document.getElementById('loan_percentage').value = reg ? (((nom/reg)*100).toFixed(2) + '%') : '';
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Calculate once on load using existing values
        calcTotalMembers();
        // Add event listeners for live calculation
        ['loan', 'loan_1'].forEach(function(id) {
            let el = document.getElementById(id);
            if (el) el.addEventListener('input', calcTotalMembers);
        });
    });
</script>
@endsection