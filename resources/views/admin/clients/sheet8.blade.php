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
                        <span class="fw-bold" style="font-size: 1.1em;">लेखा परीक्षकाचा अहवाल</span><br>
                        <span>(महाराष्ट्र सहकारी संस्थांचा कायदा कलम 81 (5) (ब) आणि महाराष्ट्र सहकारी संस्थांचा नियम 69
                            अन्वेय द्यावयाचा.)</span>
                    </div>
                    <ol style="padding-left: 20px;">
                        <li>
                            मी, <input type="text" class="form-control d-inline-block" style="width:350px;display:inline;" name="auditor_name" value="{{ $clientInputs['auditor_name'] ?? 'ग्राम विकास समिती कर्मचारी सहकारी पत संस्था मर्या. भंडारा र. नं. 109' }}">
                            या संस्थेच्या सोबत जोडलेल्या <span style="background: yellow;">31 मार्च 2024</span> या दिनांकाच्या ताळेबंद व वर्ष <span style="background: yellow;">2023-2024</span> या सहकारी वर्षाचे
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
                                    ताळेबंद व नफातोटा पत्रक संस्थेने ठेवलेल्या हिशोब पुस्तकांशी जुळते असुन नमुद <span style="background: yellow;">31/03/2024</span> या दिनांकाच्या ताळेबंद व्यवहाराची / कामकाजाची सत्य व वास्तव स्थिती दर्शविते आणि
                                    नफा-तोटा पत्रकाचे बाबतीत त्या दिनांकास संपणाऱ्या वर्षातील नफा-तोटयाची सत्य व वास्तव
                                    स्थिती दर्शविते.
                                </li>
                                <li>
                                    माझ्या मते संस्थेने महाराष्ट्र सहकारी कायदा नियम व संस्थेचे पोटनियम यानुसार आवश्यक
                                    असणारे हिशोब पुस्तके योग्य रितीने ठेवलेली आहेत.
                                </li>
                                <li>
                                    ५) सन <span style="background: yellow;">2023-2024</span> या वर्षासाठी संस्थेचे लेखापरीक्षण वर्ग "<span style="background: yellow;">अ</span>" मागील प्रमाणे कायम करण्यात येत आहे.
                                </li>
                            </ol>
                        </li>
                        <li>
                            <div class="mt-3">
                                <span>स्थळ : <span style="background: yellow;">भंडारा</span></span><br>
                                <span>दिनांक : <span style="background: yellow;">31/07/2024</span></span>
                            </div>
                            <div class="mt-3" style="background: yellow; display: inline-block; padding: 8px 16px;">
                                वाय. सी. चकलेले<br>
                                प्रमाणित लेखापरीक्षक<br>
                                सहकारी संस्था भंडारा
                            </div>
                        </li>
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