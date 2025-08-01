@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet Seven</h4>
                <div>
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
            <form action="{{ route('admin.client.saveInputs', $client->id) }}" method="POST">
                @csrf
                <!-- content here -->

                <!-- START: हिसोबी दोष व आक्षेप Design as per pasted image -->
                <div class="mb-4">
                    <div class="text-center mb-2">
                        <span class="fw-bold" style="font-size: 1.1em;">परिशिष्ट "क"<br>हिशोबी दोष व आक्षेप</span>
                    </div>
                    <div class="mb-2">
                        तपासणी काळात लेखापरीक्षणाच्या वेळी निदर्शनास आलेले किरकोळ स्वरुपाचे दोष वेळीच
                        दुरुस्ती करण्यात आलेले असुन दुरुस्ती न झालेले दोष व सुचनात्मक बाबी खालील प्रमाणे –
                    </div>
                    <ol style="padding-left: 20px;">
                        <li>
                            नियमित सभेला गैरहजर असलेल्या लागोपाठ तीन मासोक सभेत संचालाकावर कारवाही करण्यात यावी.

                        </li>
                        <li>
                            पोटनियम 68 प्रमाणे कर्ज सभासंदाना देण्यात आले आहेत पण दिलेले कर्ज त्याच कामासाठी
                            उपयोग केला किंवा नाही याची खात्री कमेटीने केली नाही.
                        </li>
                        <li>
                            संस्थेत गुंतवणुक रजिस्टर ठेवण्यात आलेले नाही.
                        </li>
                        <li>
                            संस्थेचे नियम 65 नुसर आवशक पुस्तक व रजिस्टर ठेवलेले नाही.
                        </li>
                        <li>
                            कायम स्कंध व टेम्पररी स्टॉक मधील तुटफुट झालेल्या सामानाचे अपलेखन करून स्टॉक कमी करण्यात यावा.
                        </li>
                        <li>
                            एन.पी.ए.ची तरतुद करण्यात आले नाही.
                        </li>
                        <li>
                            काही लोन केसेस मध्ये संभासदांना कर्ज देते वेळी त्याचा कडुन त्याचा आय संबधी उत्पन्नाचा दाखला/ आयकर विवरण पत्रक . व इतर कोण्त्याही बॅकेचे कर्ज नाही या संबधी दाखला घेण्यात आले नाही. व जमानत दारासंबधी संपुर्ण माहीती व फोटो घेण्यात आले नाही. कर्जफार्म मध्ये आगंठा घेण्यता आले असून आंगठा प्रमाणीत करण्यात आले नाही.

                        </li>
                        <li>
                            काही सभासदांचे वारसदाराचे नाव नोंदवीले नाही.
                        </li>
                        <li>
                            संस्था व्यवसाय कर रू 750.00 भरण्यात आले नाही.
                        </li>
                        <li>
                            50000.00 रू चा वर ठेवी स्वीकारतांना पॅन कार्ड घेतलेले नाही.
                        </li>
                        <li>
                            तक्रार निवारण व तडजोड समिती स्थापन करण्यात आले नाही.
                        </li>
                        <li>
                            इमारत व रोख आण करणारा चा विमा काढलेला नाही.
                        </li>
                        <li>
                            अंतगर्त लेखपरिक्षण करण्यात आले नाही.
                        </li>
                    </ol>
                    <p>सदर लेखापरिक्षण अहवाला मधील परिशिष्ठ "अ" "ब" व "क" मधील चुकांची दुरुस्ती करुन सहकार कायदा 1960 नुसार कलम 82 नियम 73 नुसार नमुना "ओ" मध्ये तीन प्रतीत या कार्यालयात सादर करावे.</p>
                </div>
                <p>{{$auditor->name}}<br />
                    प्रमाणित लेखापरीक्षक<br />
                    सह. संस्था, भंडारा</p>
                <!-- END: हिसोबी दोष व आक्षेप Design -->

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