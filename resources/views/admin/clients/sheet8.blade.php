@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet Eight</h4>
                <div>
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
            <form action="{{ route('admin.client.saveInputs', $client->id) }}" method="POST">
                @csrf
                <!-- content here -->

                <!-- START: लेखा परीक्षकाचा अहवाल Design as per pasted image -->
                <div class="mb-4">
                    <div class="text-center mb-2">
                        <b><span class="fw-bold" style="font-size: 1.1em;">लेखा परीक्षकाचा अहवाल</span></b><br>
                        <span>(महाराष्ट्र सहकारी संस्थांचा कायदा कलम 81 (5) (ब) आणि महाराष्ट्र सहकारी संस्थांचा नियम 69
                            अन्वेय द्यावयाचा.)</span>
                    </div>
                    <ol style="padding-left: 20px;">
                        <li>
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
                            मी, <b>{{$client->name_of_society}} र. न. {{ $client->registration_no }}</b>
                            या संस्थेच्या सोबत जोडलेल्या <span>31 मार्च {{$end}}</span> या दिनांकाच्या ताळेबंद व वर्ष <span>{{$start}}-{{$end}}</span> या सहकारी वर्षाचे
                            नफा-तोटा पत्रक तपासले आहे. आणि या आर्थिक पत्रकाची जबाबदारी संस्थेच्या व्यवस्थापक
                            मंडळावर आहे. माझी जबाबदारी या आर्थिक पत्रकावर माझया लेखापरिक्षणाचे आधारे माझे मत
                            प्रगट करणे ऐवढेच राहील.
                        </li>
                        <li>
                            मी अंकेक्षण हे भारतामध्ये प्रचलित असलेल्या अंतर्गत अंकेक्षण मानक नुसार केले. त्या अंकेक्षण
                            मानकानुसार अंतर्गत अंकेक्षकांने योजनाबध्दतेने अंकेक्षण केले असुन आर्थिक पत्रकामध्ये गंभीर
                            दोष व चुका नाहित या बद्दल आवश्यक विश्वासर्हत संपादित करणे आवश्यक आहे. अंतर्गत
                            अंकेक्षणामध्ये आर्थिक पत्रकामध्ये दिलेली माहिती हि योग्य रित्या दर्शविलेली आहे. याची नमुना पध्दतिने पडताळणी करण्यात येते व संबंधित रक्कमेचे पुरावे पडताळण्यात येतात. अंकेक्षणामध्ये
                            संचालकांनी अवलबलेली मानक व प्रमुख अंदाज यांचे सर्वेक्षण करण्यात येते व त्यांचे आर्थिक
                            पत्रकात दिलेल्या माहितीशी सुसंबध्दता तपासण्यात येते.
                        </li>
                        <li>
                            वर केलेल्या शेऱ्यासह मी अहवाल सादर करतो की,
                            <ol type="i" style="padding-left: 20px;">
                                <li>
                                    माझ्या लेखापरीक्षणाच्या उदेशासाठी माझ्या संपुर्ण ज्ञानाप्रमाणे / माहितीप्रमाणे विश्वासाप्रमाणे
                                    खालील प्रमाणे जरूरी ती सर्व माहिती व खुलासे मला उपलब्ध झाले आहेत.
                                </li>
                                <li>
                                    माझ्या मते व मला मिळालेली माहिती खुलाश्याच्या आधारे....
                                </li>
                                <li>
                                    ताळेबंद व नफातोटा पत्रक संस्थेने ठेवलेल्या हिशोब पुस्तकांशी जुळते असुन नमुद <span>31/03/{{$end}}</span> या दिनांकाच्या ताळेबंद व्यवहाराची / कामकाजाची सत्य व वास्तव स्थिती दर्शविते आणि
                                    नफा-तोटा पत्रकाचे बाबतीत त्या दिनांकास संपणाऱ्या वर्षातील नफा-तोटयाची सत्य व वास्तव
                                    स्थिती दर्शविते.
                                </li>
                                <li>
                                    माझ्या मते व माझ्या माहितीनुसार व मिळालेल्या माहिती व खुलाश्याच्या आधारे संस्थेचे हिशोब, अधिनियमानुसार आवश्यक अशी सर्व माहिती देतात व त्यातुन खालील बाबतीत वास्तविक व खरे चित्र दिसुन येते.
                                </li>
                                <span>
                                    अ) जमाखर्चाच्या ताळेबंदाच्या बाबतीत दि. 31/03/{{$end}} या तारखेपर्यंत संस्थेच्या कारभाराची
                                    स्थिती दर्शवितो.
                                </span>
                                <br>
                                <span>
                                    ब) नफा-तोटा पत्रकाच्या बाबतीत दि. 31/03/{{$end}} रोजी संपणाऱ्या आर्थिक वर्षातील नफ्याबाबत.
                                </span><br>
                                v) सन <span>{{$auditPeriod}}</span> या वर्षासाठी संस्थेचे लेखापरीक्षण वर्ग "<span>{{$client->lekha_parikshan_vargwari}}</span>" मागील प्रमाणे कायम करण्यात येत आहे.

                            </ol>
                        </li>

                        <div class="mt-3 d-flex justify-content-between align-items-start">
                            <div>
                                <span>स्थळ : <span>{{$client->district}}</span></span><br>
                                <span>दिनांक :
                                    <input type="date" name="date" value="{{ $clientInputs['date'] ?? '' }}">
                                </span>
                            </div>

                            <div style="padding: 8px 16px; text-align: right;">
                                {{$auditor->name}}<br>
                                प्रमाणित लेखापरीक्षक<br>
                                सहकारी संस्था भंडारा
                            </div>
                        </div>

                    </ol>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4> </h4>
                    <div>
                        <button type="submit" class="btn btn-success">Save</button>
                        <a href="{{ url('admin/client/show', $client->id) }}"><button type="button" class="btn btn-secondary">Back</button></a>
                    </div>
                </div>
                <!-- END: लेखा परीक्षकाचा अहवाल Design -->
            </form>
        </div>
    </div>
</div>
@endsection