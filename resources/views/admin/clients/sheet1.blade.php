@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Sheet One</h4>
                <div>
                    <button class="btn btn-success">Save</button>
                    <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                <div class="border border-dark p-4" style="width: 70%; background-color: #fff;">
                    <h3 class="text-center mb-3" style="font-weight: bold;">लेखापरीक्षण अहवाल</h3>
                    <p class="text-center mb-3" style="font-weight: bold;">कर्मचारी</p>
                    <p class="text-center mb-3" style="font-size: 1.1rem;">
                        सहकारी पतसंस्था मर्या. भंडारा र.न. 137
                    </p>
                    <p class="text-center mb-3" style="font-size: 1.1rem;">
                        लेखापरीक्षण कालावधी<br>
                        <strong>01/04/2023 ते 31/03/2024</strong>
                    </p>
                    <p class="text-center mb-3" style="font-size: 1.1rem; font-weight: bold;">
                        ऑडिट वर्ग "क"
                    </p>
                    <div class="mt-5 text-end">
                        <p class="mb-1" style="font-size: 0.9rem;">
                            जा...../ऑडिट नोट/च/02/2024
                        </p>
                        <p class="mb-1" style="font-size: 0.9rem;">
                            कार्यालय :
                        </p>
                        <p class="mb-0" style="font-size: 1rem; font-weight: bold;">
                            प्रमाणित लेखापरीक्षक<br>
                            राजीव गांधी चौक,<br>
                            भंडारा. (म.रा.)
                        </p>
                    </div>
                </div>
            </div>
            <!-- New Design Section -->
            <div class="border border-dark p-4 mt-4" style="background-color: #f8f9fa;">
                <p class="text-end mb-3" style="font-size: 0.9rem;">मो. 9850318693</p>
                <p class="mb-3">
                    <strong>प्रति,</strong><br>
                    मा.अध्यक्ष/अधिक्षक,<br>
                    ग्राम विकास समिती कर्मचारी सहकारी पत संस्था<br>
                    मर्या. महाराष्ट्र र.न. 109
                </p>
                <p class="mb-3">
                    <strong>विषय:</strong> सन 2023–2024 वर्षाचा लेखापरीक्षण अहवाल सादर करण्याबाबत.<br>
                    <strong>संदर्भ:</strong> आपली सभा दिनांक 07/07/2023 च्या ठराव क्र. 08 अनुसार
                </p>
                <p class="mb-3" style="text-align: justify;">
                    आपल्या संस्थेच्या दिनांक 07/07/2023 च्या ठरावानुसार लेखापरीक्षण कालावधी 01/04/2023 ते 31/03/2024 या कालावधीचे लेखापरीक्षण पूर्ण करण्यात आले आहे. सदर लेखापरीक्षण अहवाल सादर करत आहे. 
                    लेखापरीक्षणात संस्थेच्या आर्थिक स्थितीचा आढावा घेण्यात आला असून संस्थेच्या आर्थिक स्थिती समाधानकारक आहे. 
                    सहकारी संस्था अधिनियम 1960 व नियम 1973 अन्वये नमूद "क" वर्गात ठेवण्यात आले आहे. 
                    तरी प्रतिवर्षीप्रमाणे कार्यवाहीसाठी अहवाल सादर करण्यात येत आहे.
                </p>
                <p class="mb-3"><strong>टिप:</strong> अहवाल पाने 2 ते 50</p>
                <p class="text-end mb-5">
                    <strong>प्रमाणित लेखापरीक्षक</strong><br>
                    पत्ता: राजीव गांधी चौक, भंडारा
                </p>
                <p class="mb-3"><strong>प्रतिलिपी:</strong></p>
                <ol>
                    <li>मा जिल्हा विशेष लेखापरीक्षक वर्ग–1, सहकारी संस्था भंडारा</li>
                    <li>मा. सहाय्यक निबंधक सह. संस्था भंडारा यांना कार्यवाहीसाठी सादर.</li>
                </ol>
                <p class="mb-3">दिनांक: 31/07/2024</p>
                <p class="text-end">
                    <strong>प्रमाणित लेखापरीक्षक</strong><br>
                    राजीव गांधी चौक,<br>
                    भंडारा. (म.रा.)<br>
                    मो. 9850318693
                </p>
            </div>
            <div class="border border-dark p-4 mt-4" style="background-color: #f8f9fa;">
                <h4 class="text-center mb-3" style="font-weight: bold;">संमती पत्र</h4>
                <p class="mb-3">
                    <strong>प्रति,</strong><br>
                    मा.अध्यक्ष/सचिव,<br>
                    ग्राम विकास समिती कर्मचारी सहकारी पत संस्था<br>
                    मर्या. शहापुर र.न. 109
                </p>
                <p class="mb-3">
                    <strong>विषय:</strong> संस्थेचे लेखापरीक्षण स्वीकारण्याबाबत.
                </p>
                <p class="mb-3" style="text-align: justify;">
                    वरील संदर्भीय पत्रान्वये कळविण्यात येते की, आपल्या संस्थेचे लेखापरीक्षण सन 2023–2024 या आर्थिक वर्षाचे लेखापरीक्षण करण्यासाठी संस्थेची मासिक सभा दि. 07/07/2023 च्या ठराव क्र. 08 अनुसार माझी नियुक्ती करण्यात आलेली असून लेखापरीक्षणास माझी संमती देत आहे.
                </p>
                <p class="mb-3" style="text-align: justify;">
                    करिता माहिती सादर.
                </p>
                <p class="mb-3">दिनांक: 25/07/2023</p>
                <p class="text-end">
                    <strong>प्रमाणित लेखापरीक्षक</strong><br>
                    सह. संस्था, भंडारा
                </p>
            </div>
        </div>
    </div>
</div>
@endsection