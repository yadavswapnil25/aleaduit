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
                            <td> <input type="text" class="form-control" placeholder="Enter value">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(ब) वर्गण्याचे नियमितपणे भागात रूपांतर केले जात आहे काय?</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(क) ठेवींच्या व्यवहार चालविण्यासाठी स्वतंत्र नियम तयार केले
                                आहे काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(ड) त्याचे योग्य रितीने अनुपालन होत आहे काय ?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>(ई) बिगर सभासदांकडुन काही ठेवी स्विकारल्या आहे काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>व्यक्तीगत खात्यातील बाक्या सर्वसाधारण खाता वहीतील एकदंर
                                खात्याशी जुळतात काय?</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value">
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>ठेवीची देयु काल नोंदवही ठेवली आहे काय? आणि ठेवीची
                                परतफेड वक्तशिरपणे करण्यात येत आहे काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>ठेवीपोटी कर्जावु रकमा देण्यात येतात तेव्हा पोटनियम आणि त्या
                                कारणासाठी तयार केलेले नियमानुसार त्या काटेकोरपणे दिलेल्या
                                आहे काय?</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value">
                            </td>

                        </tr>
                        <tr>
                            <td>5</td>
                            <td>ठेव खात्यात दाखविल्या रकमावरील व्याजाची आकारणी
                                व्याज आकारणी
                                पडताळून पहा. जर या तपासण्या शेकडेवारी पध्दतीवर केल्या
                                असतील तर त्याचे शेकडा प्रमाण लिहा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value">
                            </td>
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
                            <td> <input type="text" class="form-control" placeholder="Enter value">
                            </td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>अ) चल संपत्ती दैनदिन वा साप्ताहिक पध्दतीवर ठेवली आहे
                                काय ते लिहा.</td>
                            <td><input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ब) संस्थेची चल संपत्ती आणि सांपत्तिक स्थिती दर्शविणारी
                                माहिती समक्ष अधिकारी यांना योग्य वेळेत पाठविण्यात आली
                                नाही.
                                आहे काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>लेखापरीक्षण काळात भांडवलाच्या तरतुदीत काही कमतरता
                                आढळल्या आहेत काय? असल्यास, सर्वसाधारण अभिप्राय व्यक्त
                                करा.</td>
                            <td><input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>4)</td>
                            <td>निबंधकांनी घालुन दिलेल्या प्रमाणशिर विचार करता संस्था
                                जास्त व्यवहार (ओव्हर ट्रेडीग) करते काय? असल्यास जास्तीच्या
                                व्यवहाराची मर्यादा लिहा.</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>बाहेरील कर्ज :-</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>जिल्हा सहकारी बँकेने वा शासनाने विविध कारणांच्या
                                निरंक
                                योजनेखाली दिलेले कर्ज अथवा पतमर्यादा यांच्या रकमा कशा
                                आहेत? पुढिल प्रमाणे माहिती लिहा.</td>
                            <td>
                                <input type="text" class="form-control" placeholder="Enter value">
                            </td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>संस्थेने मिळविलेल्या कर्जाचा आणि पत मर्यादेचा व्यवहार समाधानकारक आहे काय?</td>
                            <td>
                                <input type="text" class="form-control" placeholder="Enter value">
                            </td>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>कर्ज वेळेवर परत केले जातात काय ?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>4)</td>
                            <td>कर्जाकरीता दिलेले नियम व्यवस्थित वाचलेले आहेत काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
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
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>कर्जाच्या अर्जाची नोंदवही ठेवली असुन ती अद्यावत लिहीली आहे काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>पोटनियमानुसार विविध प्रकारची कर्ज आणि आगावु रकमा यासाठी व्यक्तीगत आणि एकुण कमाल मर्यादा ठरविल्या आहेत काय? त्या मर्यादा पाळल्या जातात काय?</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value">
                            </td>
                        </tr>
                        <tr>
                            <td>4)</td>
                            <td>अ) सभासदांच्या परतफेडीच्या क्षमतेची योग्य चौकशी करून
                                पत-पात्रता ठरविलेली आहे काय? व्यवस्थापन समिती व
                                संचालक मंडळ यांनी स्विकारलेली वैशिष्ठे लिहा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>ब) ठरवुन दिलेल्या नमुन्यात पत-पात्रता आणि जामिन दायीत्व
                                नोंदवही (सिक्युरिटी लायबिलीटी रजिस्टर) ठेवली आहे काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>5)</td>
                            <td>कायदा, कानुन, व पोटनियम यातील तरतुदीनुसार कर्ज काटेकोर
                                पणे दिली गेली आहेत काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>6)</td>
                            <td> संस्थेने मागणी, वसुली आणि बाकी नोदवही योग्ये रितीने ठेवली
                                आहेत काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>7)</td>
                            <td>योग्य चौकशी केल्यानतंर सादर करण्यासाठी मुदत वाढ देण्यात
                                येतात काय? अशा मुदतीसाठी आवश्यक जामिदारच्या
                                संमतीपत्रासहीत अर्ज मिळविलेले आहेत काय?</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>8)</td>
                            <td> अ) सभासदांकडील थकबाक्या वसुल करण्यासाठी काय कार्यवाही
                                केली ते लिहा.</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> ब) मागणी आणि थकबाकी यांच्या शेकडा प्रमाण काय आहे?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>9)</td>
                            <td> संस्थेने करून घेतलेले कर्जरोखे, वचनचिठठी आणि अन्वये
                                कागदपत्रे नियमानुसार आहेत काय? काही उणिवा असल्यास
                                नमुद करा.</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>10)</td>
                            <td>1961 च्या महाराष्ट्र सहकारी संस्थांच्या कायद्यातील 49 च्या
                                कलमाप्रमाणे सभासदांनकडुन त्यांच्या पगारातुन वा पगारातुन
                                करारपत्रकात मंजुर केलेल्या रकमा संस्थेच्या नावाने कपात
                                करण्याबाबद नोकरी देणाऱ्यास अधिकार देणारी कागदपत्रे करून
                                घेतली आहेत काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>11)</td>
                            <td>परतफेडी वक्तशीर आहेत काय? संस्थेच्या मागण्या पुर्ण
                                करण्यासाठी नोकरी देणाऱ्याने वेतन व मजुरी यातुन मासीक
                                कपाती नियमाप्रमाणे केले आहेत काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>12)</td>
                            <td>अशी कपात केलेली रक्कम नोकरी देणाऱ्यानी संस्थेस वक्तशीपणे
                                दिली आहे काय? न दिलेली एकुण रक्कम असल्यास लिहा, अशा
                                रकमा कोणत्या दिनांकापासुन थकित आहेत ते लिहा.</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>13)</td>
                            <td>पुर्वीचे कर्जपरतफेड आणि नविन कर्ज देणे यात ठरवुन दिलेला
                                कालांतर यथायत पाळले आहे काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>14)</td>
                            <td>सभासदांना दिलेल्या पासबुकातील नोदी व्यक्तीक खाता वहीतील
                                नोंदीशी तपासुन पहा. अशा तपासलेल्या बुकांची संख्या लिहा.
                            </td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>15)</td>
                            <td>थकित व्याजाची रक्कम किती आहे. जर ती हिशोबात घेतली
                                असेल तर तिची यथावत तरतुदी केली आहे काय?</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value">
                            <td>
                        </tr>
                        <tr>
                            <td>16)</td>
                            <td>संस्थेला येणे असलेली कर्ज तपासणी आणि त्यांचे बुडीत आणि
                                संशयीत असे वर्गीकरण झाले आहेत काय? ते पहा. अशा
                                संशयीत व बुडीत कर्जासाठी पुरेशी तरतुद केली आहे काय ते
                                तपासा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>17)</td>
                            <td>संस्थेच्या व्यवस्थापन समितीच्या व संचालक मंडळाच्या
                                सभासदांना आणि बॅकेचे अधिकारी यांना दिलेल्या आणि येणे
                                असलेल्या कर्जाची रक्कम लिहा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>18)</td>
                            <td>कलमानुसार थकबाकीचे खालीलप्रमाणे वर्गीकरण करा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>1) पाच वर्षावरील थकबाकी</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>2) तीन वर्षावरील थकबाकी</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>3) एक वर्षावरील थकबाकी</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>4) एक वर्षाखालील थकबाकी</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>एकुण रू.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>19)</td>
                            <td>19) तारणानुसार थकबाकीचे वर्गीकरण करा.</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>अ) जमीनदाराच्या हमीनुसार सुरक्षीत आणि चांगली असलेली
                                थकबाकी
                                ब) विमापत्रत्वये सुरक्षीत आणि चांगली असलेली थकबाकी.
                                क) अन्य कारणामुळे सुरक्षीत आणि चांगली असलेली थकबाकी.
                                ड) असुरक्षित आणि संभाव्य संशयीत व बुडीत ठरणारी थकबाकी.</td>
                            
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>20)</td>
                            <td>निबंधकाच्यां नामनिर्देषीत व्यक्तीकडे प्रलंबित असलेल्या
                                प्रकरणाची संख्या, संस्थेजवळ प्रलंबित असलेल्या आणि
                                बजावणीसाठी पाठविलेल्या निवडावयाची संख्या त्याच्यां रक्मे सह
                                तपशील देवुन लादावा दाव्यातील प्रकरणात अडकुन राहिलेल्या
                                रक्कमा द्या.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>21)</td>
                            <td>विविध प्रकारच्या कर्जावर आकारण्यात येणाऱ्या कर्जावरील व्याज
                                दर नमुद करा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>22)</td>
                            <td>दंडाचे व्याज आकारले जाते काय? पोटनियमात ठरवुन दिले
                                असल्यास दंड व्याजाचा दर लिहा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>23)</td>
                            <td>1960 च्या महाराष्ट्र संस्थाबाबद कायद्याच्या कलम 81 (2) मध्ये
                                दर्शविल्याप्रमाणे येणे असलेली कर्ज, थकित रक्कमा, कोणत्या
                                दिनांकापासुन थकित आहेत, त्या वसुल करण्यासाठी केले गेलेली
                                कार्यवाही इत्यादी दर्शविणारी थकबाकी यादीबाकीची यादी मिळवा
                                आणि तपासा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
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
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>गुंतवणुकी अवमुल्यंनासाठी पुरेशी तरतुद केली आहे. काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                            </td>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>संस्थेच्या गुंतवणुका दर्शविणारी नोंदवही अद्यावत ठेवली आहे.
                                काय? गुंतवणुक विभागवरील जबाबदार अधिकाऱ्याने त्यावर
                                सहया केल्या आहेत काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                            </td>
                        </tr>
                        <tr>
                            <td>4)</td>
                            <td>गुंतवणुक नोंदवही संस्थेजवळ असलेल्या रोख्याशी तपासा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                            </td>
                        </tr>
                        <tr>
                            <td>5)</td>
                            <td>रोखे जर बँकेमध्ये ठेवले असतील तर बँकेचे प्रमाणपत्र मिळविली
                                आहे काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
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
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td> अ) वार्षिक अंदाजपत्रक तयार करून त्यास संचालक मंडळ वा
                                व्यवस्थापन समिती आणि साधारण सभा यांनी मंजुरी दिली आहे
                                काय?
                                ब) झालेला खर्च अंदाज पत्रकाच्या मर्यादेत आहे काय? नसल्यास,
                                साधारण सभेने पुर्वनियोजनाला मान्यता दिली आहे काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>3)</td>
                            <td>संस्थेच्या व्यवहाराशी संबंध नसलेले खर्चाच्या प्रकरणाची सर्व
                                साधारण अभिप्राय नोंद करा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>

                        </tr>
                        <tr>
                            <td>4)</td>
                            <td> संस्थेने नगरातंर दुरध्वनी नोंदवही ठेवली आहे काय? खाजगी
                                दुरध्वनी हा खर्च वसुल करण्यात येतो काय?</td>
                            <td> <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>5)</td>
                            <td> खेळत्या भाग भांडवलाशी आणि निव्वळ उत्पन्नाशी (मिळालेले
                                व्याजातुन दिलेले व्याज वजा जाता) व्यवस्थापन खर्चाचा शेकडा
                                प्रमाण लिहा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>अंर्तगत तपासणी :-</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>1)</td>
                            <td>संस्थेची अंर्तगत तपासणी व्यवस्था समाधान कारक आहे काय?</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
                        </tr>
                        <tr>
                            <td>2)</td>
                            <td>संस्थेने लेखापरीक्षकाची नेमणुक केली आहे काय? त्यांना
                                दिलेल्या लेखापरीक्षा शुल्काची रक्कम आणि लेखापरिक्षकाचा
                                तपासलेला कालखंड लिहा.</td>
                            <td> <input type="text" class="form-control" placeholder="Enter value"></td>
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
                            <td><select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select></td>
                        </tr>
                    </tbody>
                </table>
                <hr />
                <!-- <div class="container mt-4">
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
                                <td>तालुका (गट)</td>
                                <td><b>{{$client->taluka}}</b></td>
                            </tr>
                            <tr>
                                <td>नोंदणी क्रमांक</td>
                                <td><b>{{$client->registration_no}}</b></td>
                            </tr>
                            <tr>
                                <td>नोंदणी दिनांक</td>
                                <td><b>{{ \Carbon\Carbon::parse($client->registration_date)->format('d/m/Y') }}</b></td>
                            </tr>
                            <tr>
                                <td>कार्यक्षेत्र</td>
                                <td><b>{{$client->karyashetra}}</b></td>
                            </tr>
                            <tr>
                                <td>शाखा व दुकाने यांची संख्या</td>
                                <td><input type="text" class="form-control" name="branch_count" value="{{ $clientInputs['branch_count'] ?? '' }}"></td>
                            </tr>

                            <tr>
                                <th colspan="2">अ) लेखापरीक्षा विषयक माहीती</th>
                            </tr>

                            <tr>
                                <td>2.लेखा परीक्षणाचा कालावधी वर्ष</td>
                                <td>
                                    <input type="date" class="form-control me-2" name="audit_period_start" placeholder="Start Date" value="{{ $clientInputs['audit_period_start'] ?? '' }}">
                                    <input type="date" class="form-control" name="audit_period_end" placeholder="End Date" value="{{ $clientInputs['audit_period_end'] ?? '' }}">
                                </td>
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
                                <td><input type="text" class="form-control" name="regular_members" value="{{ $clientInputs['regular_members'] ?? '' }}"></td>
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
                                <td>1)पोटनियमाप्रमाणे संस्थेने कर्ज घेण्याची मर्यादा काय
                                    होय.</td>
                                <td><input type="text" class="form-control" name="loan_limit_followed" value="{{ $clientInputs['loan_limit_followed'] ?? '' }}"></td>

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
                                    <select class="form-control" name="loan_limit_exceeded_permission_opt1">
                                        <option value="">Select</option>

                                        <option value="होय" {{ (isset($clientInputs['loan_limit_exceeded_permission_opt1']) && $clientInputs['loan_limit_exceeded_permission_opt1'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['loan_limit_exceeded_permission_opt1']) && $clientInputs['loan_limit_exceeded_permission_opt1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                    <input type="text" class="form-control" name="loan_limit_exceeded_permission" value="{{ $clientInputs['loan_limit_exceeded_permission'] ?? '' }}">
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
                                <td><input type="text" class="form-control" name="previous_audit_issues_ignored" value="{{ $clientInputs['previous_audit_issues_ignored'] ?? '' }}"></td>
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
                                <td><input type="text" class="form-control" name="audit_fee_not_paid" value="{{ $clientInputs['audit_fee_not_paid'] ?? '' }}"></td>

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
                                <td><input type="text" class="form-control" name="internal_audit_date" value="{{ $clientInputs['internal_audit_date'] ?? '' }}"></td>
                            </tr>
                            <tr>
                                <td>2) सांविधिक(स्टॅट्युटरी)लेखापरीक्षा व अतर्गत लेखापरीक्षा
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
                                <td>
                                    <select class="form-control" name="member_status">
                                        <option value="होय" {{ (isset($clientInputs['member_status']) && $clientInputs['member_status'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['member_status']) && $clientInputs['member_status'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>
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
                                <td>
                                    <select class="form-control" name="bylaws_copy_available_opt1">
                                        <option value="होय" {{ (isset($clientInputs['bylaws_copy_available_opt1']) && $clientInputs['bylaws_copy_available_opt1'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['bylaws_copy_available_opt1']) && $clientInputs['bylaws_copy_available_opt1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                    <input type="text" class="form-control" name="rules_prepared_as_per_bylaws" value="{{ $clientInputs['rules_prepared_as_per_bylaws'] ?? '' }}">
                                </td>
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
                                <td>
                                    <select class="form-control" name="profit_distribution_opt1">
                                        <option value="नियमाप्रमाणे केले आहे" {{ (isset($clientInputs['profit_distribution_opt1']) && $clientInputs['profit_distribution_opt1'] == 'नियमाप्रमाणे केले आहे') ? 'selected' : '' }}>नियमाप्रमाणे केले आहे</option>
                                        <option value="होय" {{ (isset($clientInputs['profit_distribution_opt1']) && $clientInputs['profit_distribution_opt1'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['profit_distribution_opt1']) && $clientInputs['profit_distribution_opt1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                    <input type="text" class="form-control" name="profit_distribution" value="{{ $clientInputs['profit_distribution'] ?? '' }}">
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">11) रोकड रकमा, बँकेतील शिल्लक, आणि गुंतवणुकी (सेक्युरिटीज) :-
                                    (अ) रोकड जमा :-
                                </td>
                            </tr>
                            <tr>
                                <td>1) शिल्लक मोजा किर्दीवर शिल्लका मोजल्याचा दिनांक व रक्कम नमुद करून सही करा. </td>
                                <td>
                                    <select class="form-control" name="cash_balance_date_opt1">
                                        <option value="कॅशबुकअद्यावत लिहिलेले नाही त्यामुळे रोख शिल्लक मोजता आले नाही" {{ (isset($clientInputs['cash_balance_date_opt1']) && $clientInputs['cash_balance_date_opt1'] == 'कॅशबुकअद्यावत लिहिलेले नाही त्यामुळे रोख शिल्लक मोजता आले नाही') ? 'selected' : '' }}>कॅशबुकअद्यावत लिहिलेले नाही त्यामुळे रोख शिल्लक मोजता आले नाही</option>
                                        <option value="होय" {{ (isset($clientInputs['cash_balance_date_opt1']) && $clientInputs['cash_balance_date_opt1'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['cash_balance_date_opt1']) && $clientInputs['cash_balance_date_opt1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                    <input type="text" class="form-control" name="cash_balance_date" value="{{ $clientInputs['cash_balance_date'] ?? '' }}">
                                </td>

                            </tr>
                            <tr>
                                <td>2) रोकड रक्कम कोणी मोजावयास सुरवात केली त्याचे
                                    नाव व पदनाम लिहा. रोकड रक्कम ठेवण्याबाबद त्याना पुरेशा अधिकार आहेत काय? </td>
                                <td><input type="text" class="form-control" name="cash_counted_by" value="{{ $clientInputs['cash_counted_by'] ?? '' }}"></td>

                            </tr>
                            <tr>
                                <td>3) किर्दीप्रमाणे रोकड रक्कम बरोबर आहे काय ? </td>
                                <td>
                                    <select class="form-control" name="cash_balance_correct">
                                        <option value="होय" {{ (isset($clientInputs['cash_balance_correct']) && $clientInputs['cash_balance_correct'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['cash_balance_correct']) && $clientInputs['cash_balance_correct'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>4) ने-आण करतांना आणि तिजोरीत ठेवलेल्या शिलकेच्या
                                    रकमेच्या सुरक्षिततेबाबत केलेली व्यवस्था पुरेशी आहे
                                    काय? </td>
                                <td>
                                    <select class="form-control" name="cash_security_arrangements">
                                        <option value="होय" {{ (isset($clientInputs['cash_security_arrangements']) && $clientInputs['cash_security_arrangements'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['cash_security_arrangements']) && $clientInputs['cash_security_arrangements'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>(ब) बँकेतील शिल्लका :-
                                    बँकेतील पास पुस्तकातील त्यानी पाठविलेल्या पत्रकातील
                                    बँकेने दिलेल्या दाखल्यातील शिल्लक रकमा संस्थेच्या
                                    जमाखर्चाच्या बाक्याशी जुळतात काय? जर त्या जुळत
                                    नसतील, तर मेळ पत्रके तपासा.</td>
                                <td>
                                    <select class="form-control" name="bank_balance_correct_option">
                                        <option value="होय" {{ (isset($clientInputs['bank_balance_correct_option']) && $clientInputs['bank_balance_correct_option'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['bank_balance_correct_option']) && $clientInputs['bank_balance_correct_option'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                    <input type="text" class="form-control" name="bank_balance_correct" value="{{ $clientInputs['bank_balance_correct'] ?? '' }}">
                                </td>

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
                                <td>
                                    <select class="form-control" name="investment_certificates_obtained_opt1">
                                        <option value="होय" {{ (isset($clientInputs['investment_certificates_obtained_opt1']) && $clientInputs['investment_certificates_obtained_opt1'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['investment_certificates_obtained_opt1']) && $clientInputs['investment_certificates_obtained_opt1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                    <input type="text" class="form-control" name="investment_certificates_obtained" value="{{ $clientInputs['investment_certificates_obtained'] ?? '' }}">
                                </td>

                            </tr>
                            <tr>
                                <td>4) गुंतवणुकीची नोंद वही ठेवली आहे काय? व ती अद्यावत लिहीली आहेत काय? </td>
                                <td>
                                    <select class="form-control" name="investment_register_updated">
                                        <option value="होय" {{ (isset($clientInputs['investment_register_updated']) && $clientInputs['investment_register_updated'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['investment_register_updated']) && $clientInputs['investment_register_updated'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="2">13) स्थावर आणि जंगम मालमत्ता :-
                                </td>
                            </tr>
                            <tr>
                                <td>1) संबंधित नोंदवहया ठेवल्या आहेत काय? व त्या अद्यावत
                                    लिहीली आहेत काय? </td>
                                <td>
                                    <select class="form-control" name="property_register_updated">
                                        <option value="होय" {{ (isset($clientInputs['property_register_updated']) && $clientInputs['property_register_updated'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['property_register_updated']) && $clientInputs['property_register_updated'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>2) मालमत्तेची यादी घेवुन प्रत्यक्ष रूजवात घ्या.
                                    ताळेबंदातील रकमेशी या बाक्या जमतात काय? </td>
                                <td>
                                    <select class="form-control" name="property_list_matches_balance_sheet">
                                        <option value="होय" {{ (isset($clientInputs['property_list_matches_balance_sheet']) && $clientInputs['property_list_matches_balance_sheet'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['property_list_matches_balance_sheet']) && $clientInputs['property_list_matches_balance_sheet'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

                            </tr>
                            <tr>
                                <td>3) जमीन आदी स्थावर मालमत्तेच्याबाबद त्याचे विलेख
                                    (दस्तऐवज) पहा व ते संस्थेच्या नावावरच आहेत काय हे
                                    पहा.
                                </td>
                                <td>
                                    <select class="form-control" name="property_deeds_in_name_of_society">
                                        <option value="होय" {{ (isset($clientInputs['property_deeds_in_name_of_society']) && $clientInputs['property_deeds_in_name_of_society'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['property_deeds_in_name_of_society']) && $clientInputs['property_deeds_in_name_of_society'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                </td>

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
                                    <select class="form-control" name="depreciation_rates_opt1">
                                        <option value="होय" {{ (isset($clientInputs['depreciation_rates_opt1']) && $clientInputs['depreciation_rates_opt1'] == 'होय') ? 'selected' : '' }}>होय</option>
                                        <option value="नाही" {{ (isset($clientInputs['depreciation_rates_opt1']) && $clientInputs['depreciation_rates_opt1'] == 'नाही') ? 'selected' : '' }}>नाही</option>
                                    </select>
                                    <input type="text" class="form-control" name="depreciation_rates" value="{{ $clientInputs['depreciation_rates'] ?? '' }}">
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
                    </div> -->
            </form>
        </div>
    </div>
</div>

@endsection