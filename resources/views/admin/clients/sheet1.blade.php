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
                        <td>{{$client->name_of_society}} {{ $client->registration_no }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>संस्थेचा नोंदणी क्रमांक व दिनांक</td>
                        <td>{{ $client->registration_no }} {{ $client->registration_date }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>संस्थेचा कार्यक्षेत्र</td>
                        <td>{{$client->karyashetra}}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>संस्थेच्या शाखा</td>
                        <td>
                            <select class="form-control">
                                <option value="होय">होय</option>
                                <option value="नाही">नाही</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>संचालक मंडळाचा कालावधी</td>
                        <td><input type="text" class="form-control" placeholder="Enter value"></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>अध्यक्षाचे नाव दुरध्वनी क्रमांक</td>
                        <td>{{$client->chairman}}</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>उपाध्यक्षाचे नाव</td>
                        <td>{{$client->vice_chairman}}</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>सचिवाचे नाव</td>
                        <td>{{$client->manager}}</td>

                    </tr>
                    <tr>
                        <td>9</td>
                        <td>निवडणुकीची तारीख</td>
                        <td><input type="date" class="form-control" value="2024-06-02"></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>वसुल भाग भागभांडवल</td>
                        <td>{{$client['वसुल भाग भागभांडवल_sum']}}</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>निधि</td>
                        <td><input type="number" class="form-control" placeholder="Enter value"></td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>ठेवी</td>
                        <td><input type="number" class="form-control" placeholder="Enter value"></td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>घेतलेले कर्ज</td>
                        <td><input type="number" class="form-control" placeholder="Enter value"></td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>सभासदांना दिलेले कर्ज</td>
                        <td><input type="number" class="form-control" placeholder="Enter value"></td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>सभासद संख्या</td>
                        <td><input type="number" class="form-control" placeholder="Enter value"></td>
                    </tr>
                    <tr>
                        <td>16</td>
                        <td>गुंतवणुक</td>
                        <td>रु. 513000.00</td>
                    </tr>
                    <tr>
                        <td>17</td>
                        <td>नफा / तोटा</td>
                        <td>रु. 173920.00</td>
                    </tr>
                    <tr>
                        <td>18</td>
                        <td>लेखापरीक्षण वर्गवारी (मागील तिन वर्ष)</td>
                        <td><input type="text" class="form-control" value="अ, अ, अ."></td>
                    </tr>
                    <tr>
                        <td>19</td>
                        <td>संस्थेने निबंधकाकडे सादर केलेली वसुली प्रकरणे व रक्कम</td>
                        <td><input type="text" class="form-control" placeholder="निर्लेख"></td>
                    </tr>
                    <tr>
                        <td>20</td>
                        <td>संस्थेची स्वतची इमारत आहे काय?</td>
                        <td>
                            <select class="form-control">
                                <option value="होय">होय</option>
                                <option value="नाही">नाही</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>21</td>
                        <td>संस्थेकडे असलेली वाहने.</td>
                        <td>
                            <select class="form-control">
                                <option value="होय">होय</option>
                                <option value="नाही">नाही</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>22</td>
                        <td>संस्थेकडे असलेले एकुन कर्मचारी</td>
                        <td><input type="number" class="form-control" value="0"></td>
                    </tr>
                    <tr>
                        <td>23</td>
                        <td>खेळते भागभांडवल</td>
                        <td>रु. 9774578.05</td>
                    </tr>
                    <tr>
                        <td>24</td>
                        <td>संचित नफा/तोटा</td>
                        <td>रु. 0.00</td>
                    </tr>
                    <tr>
                        <td>25</td>
                        <td>रोख शिल्लक</td>
                        <td>रु. 0.00</td>
                    </tr>
                    <tr>
                        <td>26</td>
                        <td>बँक शिल्लक</td>
                        <td>रु. 0.00</td>
                    </tr>
                    <tr>
                        <td>27</td>
                        <td>सभासद संख्या</td>
                        <td><input type="number" class="form-control" value="0"></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <!-- <table class="table table-bordered table-striped">
                <thead class="table-secondary">
                    <tr>
                        <th>अ.क्र.</th>
                        <th>तपशील</th>
                        <th>माहिती</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>संस्थेचे नाव व दुरध्वनी क्रमांक</td>
                        <td>ग्राम विकास समिती कर्मचारी सहकारी पत संस्था मर्या. शहापूर र. जं. 109</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>संस्था नोंदणी क्रमांक व दिनांक</td>
                        <td>र.जं. 109 ....दि. 16 / 09 / 1968</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>संस्थेचे कार्यक्षेत्र</td>
                        <td>ग्राम विकास समिती कर्मचारी सहकारी पत संस्था मर्या. शहापूर कर्मचाऱ्यापुरते मर्यादित</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>संस्थेच्या शाखा</td>
                        <td><input type="text" class="form-control" placeholder="उदा. नाही"></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>संचालक मंडळाचा कालावधी</td>
                        <td><input type="text" class="form-control" value="5 वर्ष 2022 ते 2027"></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>अध्यक्षाचे नाव व दुरध्वनी क्रमांक</td>
                        <td>श्री. राजकुमार पुळराम बावणे</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>उपाध्यक्षाचे नाव</td>
                        <td>श्री. शरद नंदलाल राजपूत</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>सचिवाचे नाव</td>
                        <td>श्री. हेमंत अशोक बिजने</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>निवडणुकिची तारीख</td>
                        <td><input type="text" class="form-control" value="05 / 03 / 2022"></td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>वसुल भाग भागभांडवल</td>
                        <td>रु. 2218000.00</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>निधि</td>
                        <td>रु. 1518093.75</td>
                    </tr>
                    <tr>
                        <td>12</td>
                        <td>ठेवी</td>
                        <td>रु. 5800500.00</td>
                    </tr>
                    <tr>
                        <td>13</td>
                        <td>घेतलेले कर्ज</td>
                        <td>रु. 0.00</td>
                    </tr>
                    <tr>
                        <td>14</td>
                        <td>सभासदांना दिलेले कर्ज</td>
                        <td>रु. 5647500.00</td>
                    </tr>
                    <tr>
                        <td>15</td>
                        <td>सभासद संख्या</td>
                        <td><input type="number" class="form-control" value="39"></td>
                    </tr>
                    
                </tbody>
            </table> -->
            <hr />
            <div class="container mt-4">
                <h5 class="text-center">नमुना क्र. 1<br>लेखापरिक्षण अहवाल (सर्व सहकारी संस्थासाठी )<br>विभाग - पहिला</h5>

                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>संस्थेचे नाव</td>
                            <td>{{$client->name_of_society}}</td>
                        </tr>
                        <tr>
                            <td>नोंदलेला संपूर्ण पत्ता</td>
                            <td>{{$client->society_address}}</td>
                        </tr>
                        <tr>
                            <td>तालुका (गड)</td>
                            <td>{{$client->taluka}}</td>
                        </tr>
                        <tr>
                            <td>नोंदणी क्रमांक</td>
                            <td>{{$client->registration_no}}</td>
                        </tr>
                        <tr>
                            <td>नोंदणी दिनांक</td>
                            <td>{{$client->registration_date}}</td>
                        </tr>
                        <tr>
                            <td>कार्यक्षेत्र</td>
                            <td>{{$client->karyashetra}}</td>
                        </tr>
                        <tr>
                            <td>शाखा व दुकाने यांची संख्या</td>
                            <td><input type="text" class="form-control" placeholder="निर्लेख"></td>
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
                        <td><input type="date" class="form-control" value="2024-06-02"></td>
                        </tr>
                        <tr>
                            <td>3.दिनांक</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1.लेखापरीक्षा सुरू केल्याचे व चालु ठेवल्याचेदि.</td>
                            <td><input type="date" class="form-control" value="2024-06-02"></td>
                        </tr>
                        <tr>
                            <td>2.लेखापरीक्षा संपविल्याचा दिनांक</td>
                            <td><input type="date" class="form-control" value="2024-06-03"></td>
                        </tr>
                        <tr>
                            <td>3.लेखापरीक्षा सादर केल्याचा दिनांक</td>
                            <td><input type="date" class="form-control" value="2024-07-31"></td>
                        </tr>

                        <tr>
                            <th colspan="2">२) सभासद</th>
                        </tr>
                        <tr>
                            <td>1.सभासद संख्या</td>
                            <td><input type="number" class="form-control" value="39"></td>
                        </tr>
                        <tr>
                            <td>अ) व्यक्तीगत</td>
                            <td><input type="number" class="form-control" value="39"></td>
                        </tr>
                        <tr>
                            <td>1.सर्वसाधारण नियमित</td>
                            <td><input type="text" class="form-control" placeholder="निर्लेख"></td>
                        </tr>
                        <tr>
                            <td>२.नाममात्र</td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td>३) हितचिंतक</td>
                        </tr>
                        <tr>
                            <td>ब) संस्था</td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td>क) अन्य (अन्य सदस्यांची माहिती
                                तपशिलवार द्यावी)</td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td>एकूण</td>
                            <td>39</td>
                        </tr>

                        <tr>
                            <td>२.नवे सभासद यथोचितरित्या कुऊन घेतले आहेत काय?
                                ज्यांनी प्रवेश शुल्क दिले आहेत काय?</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>3) त्यांचे लेखी अर्ज घेण्यात आलेले असून ते योग्य
                                होय.
                                रीतीने नियत क्रमात केले आहेत काय?</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>४)महाराष्ट्र सहकारी संस्थेच्या 1961 च्या कानुनातील
                                नियम 32 आणि 65 (1) अन्वेय द्ररविलेल्या 'आय' या
                                नमुन्यात सभासदांची नोंदवही ठेवली आहे काय?</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
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
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>6)मृत, काढुन ट्राकलेल्या व राजीनामा दिलेल्या सभासदांच्या बाबतीत त्यांच्या नावापुढे वरीलप्रमाणे योग्य
                                ती नोंद केली आहे काय?</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>7)राजीनामे रीतसर आहेत काय आणि ते यथोचितरीत्या
                                स्वीकारले आहेत काय?</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>8)महाराष्ट्र सहकारी संस्थेच्या 1961 च्या कानुनातीलनियम
                                25 अन्वेय वारस (नॉमिनी) नेमुन दिले आहूते काय?
                                आणि त्याचे नोंद्र 26 व्या नियमाप्रमाणे सभासदांच्या....
                                नोंदवहीत. यथोचितरीत्या केली आहे काय?</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>


                        <tr>
                            <td colspan="2">3)भाग :-</td>
                        </tr>
                        <tr>
                            <td>1)भागाकरिता आलेले अर्ज बरोबर आहेत काय?</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>2)भागाची नोंदवही अद्यावत ठेवलेली आहेत काय?
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>3)भागाची नोंदवहीतील नोंदी किद्रीतील नोंदीशी जुळतात
                                काय?
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>4)भागाची खतावणी अद्यावत लिहिली आहे काय?
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>5)भागाची एकुण खतावणी बाकी ताळेबंदातील
                                नाही.
                                आगभांडवलाच्या आकड्याशी जुळते काय?
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>6)भागधारकांना ज्यानी घेतलेल्या सर्व भागाबदल भगपत्रे
                                होय.
                                दिली आहेत काय?
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
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
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
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
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>2)ती उल्लंचिली गेली होती काय ?
                                प्रश्न उद्भवत नाही.</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>3)जर ती उल्लंचिली गेली असेल तर सक्षम
                                प्राधिकाऱ्याकडून आवश्यक ती अनुज्ञा मिळवली आहे
                                काय?</td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">5)सभा :-</td>
                        </tr>
                        <tr>
                            <td>1)दिनांक द्यावेत </td>
                            <td><input type="date" class="form-control" value="2024-07-31"></td>
                        </tr>
                        <tr>
                            <td>1)वार्षिक साधारण सभा </td>
                            <td><input type="date" class="form-control" value="2024-07-31"></td>
                        </tr>
                        <tr>
                            <td>1)विशेष साधारण सभा </td>
                            <td><input type="date" class="form-control" value="2024-07-31"></td>
                        </tr>
                        <tr>
                            <td>2)लेखापरीक्षा कालावधीत भरलेल्या सभांची खालीलप्रमाणे
                                संख्या द्यावी. :-</td>
                        </tr>
                        <tr>
                            <td>अ) व्यवस्थापक समितीच्या वा संचालक मंडळाच्या प्रभा
                                कार्यकारी वा उप समितिच्या सभा :-</td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>ब) कार्यकारी वा उप समितिच्या सभा :-</td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>क) अन्य अभा :-</td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td colspan="2">6)दोष दुरूस्ती अहवाल :-</td>
                        </tr>
                        <tr>
                            <td>1)संस्थेने गेल्या लेखापरीक्षा अहवालाचे दोषदुरूस्ती
                                अहवाल पाठविलेला आहेत काय? असल्यास ते दिल्याचे
                                दिनांक द्या. नसल्यास, ते न दिल्याबद्दलची कारणे द्या. </td>
                            <td><input type="date" class="form-control" value="2024-07-31"></td>
                        </tr>
                        <tr>
                            <td>2)मागील लेखापरीक्षा अहवालात नमुद केलेल्या काही
                                महत्वाच्या मुद्यायाकडे संस्थेने दुर्लक्ष केले आहे काय?
                                तसे असल्यास तर सर्व साधारण अभिप्रायात ते नमुद
                                करा
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
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
                            <td><input type="date" class="form-control" value="2024-07-31"></td>
                        </tr>
                        <tr>
                            <td>2)जर संस्थेने लेखापरीक्षा शुल्क भरली नसेल तर देणे
                                असलेल्या परीक्षा शुल्काचा तपशील व न भरण्याची
                                कारणे द्या.
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
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
                            <td><input type="date" class="form-control" value="2024-07-31"></td>
                        </tr>
                        <tr>
                            <td>2) सांविधिक (स्टॅट्युटरी) लेखापरीक्षा व अतर्गत लेखापरीक्षा
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">9) कार्यकारी संचालक/व्यवस्थापक/चिटणीस-</td>
                        </tr>
                        <tr>
                            <td>1)अधिकाऱ्याचे नाव </td>
                            <td>श्री. हेमंत अशोक बिजने</td>

                        </tr>
                        <tr>
                            <td>2) दरमहा घेतलेले मानधन
                            </td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td>3) त्यांनाअन्ये भत्ते आणि सवलती उदा. विनामुल्य
                                निवासगृहे आदि उपलब्ध केल्या असल्यास त्या लिहा.

                            </td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td>4) ते संस्थेचे सभासद आहेत काय ते लिहा.
                            </td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td>5) जर ते सभासद असतील तर त्यांनी कर्ज घेतले आहे
                                काय? किंवा त्यांना उधार-उचल, सवलती दिल्या आहेत
                                काय? त्यांचेकडील येणे रक्कमा द्या व त्यातील थकबाकी
                                किती आहे ते लिहा.
                            </td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td>6) अन्य कोणत्या रक्कमा त्यांच्याकडुन येणे असतील तर त्यांचा तपशील द्या.
                            </td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td>6) कर्मचाऱ्यासंबधी त्यांची नावे, पदनामे, शैक्षणिक
                                पात्रता, वेतन श्रेणी व सध्याचे वेतन, देण्यात येणारे भत्ते,
                                नेमणुकीचे दिनांक, दिलेली जमानत आदि माहिती
                                दाखविणारी यादी मिळवा
                            </td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td colspan="2">10) उल्लंघण :-</td>
                        </tr>
                        <tr>
                            <td>1)संस्थेजवळ आपले नोंदलेले पोटनियम, कायदा व कानून
                                यांची प्रत आहे काय? </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
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
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td>3) पोटनियमानुसार काही नियम तयार केले आहेत काय?
                                योग्य त्या अधिकाऱ्याकडुन ते मान्ये करून घेतले आहेत
                                काय? त्याचे प्रतिपालन योग्य रीतीने होत आहे काय?
                                (उल्लंघनासंबंधी सर्वसाधारण अभिप्रायात थोडक्यात
                                चर्चा करावी)
                            </td>
                            <td><input type="text" class="form-control" value="0.00"></td>
                        </tr>
                        <tr>
                            <td colspan="2">11) नफा आणि तोटा :-
                            </td>
                        </tr>
                        <tr>
                            <td>1) गेल्या सहकारी वर्षात किती नफा वा तोटा झाला. </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>2) निव्वळ नफयाची विभागणी कशी केली ते लिहा.
                                (निर्व्यवहारी (नॉन-बिझिनेस) संस्थांच्या बाबतीत
                                प्रश्नांक 11 (2) च्या उत्तरास वाढ वा घट यांच्या
                                रक्कमा लिहाव्यात.) </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td colspan="2">11) रोकड रकमा, बँकेतील शिल्लक, आणि गुंतवणुकी (सेक्युरिटीज) :-
                                (अ) रोकड जमा :-
                            </td>
                        </tr>
                        <tr>
                            <td>1) शिल्लक मोजा किर्दीवर शिल्लका मोजल्याचा दिनांक व रक्कम नमुद करून सही करा. </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>2) रोकड रक्कम कोणी मोजावयास सुरवात केली त्याचे
                                नाव व पदनाम लिहा. रोकड रक्कम ठेवण्याबाबद त्याना पुरेशा अधिकार आहेत काय? </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>3) किर्दीप्रमाणे रोकड रक्कम बरोबर आहे काय ? </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>4) ने-आण करतांना आणि तिजोरीत ठेवलेल्या शिलकेच्या
                                रकमेच्या सुरक्षिततेबाबत केलेली व्यवस्था पुरेशी आहे
                                काय? </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>(ब) बँकेतील शिल्लका :-
                                बँकेतील पास पुस्तकातील त्यानी पाठविलेल्या पत्रकातील
                                बँकेने दिलेल्या दाखल्यातील शिल्लक रकमा संस्थेच्या
                                जमाखर्चाच्या बाक्याशी जुळतात काय? जर त्या जुळत
                                नसतील, तर मेळ पत्रके तपासा.</td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td colspan="2">(क) गुंतवणुकी :-
                            </td>
                        </tr>
                        <tr>
                            <td>1) गुंतवणुक रोखे प्रत्याक्षात पहा आणि ते संस्थेच्या
                                नावावरच आहेत काय ते पहा. </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>2) गुंतवणुकीवरील लाभांश व व्याज यथावत वसुल
                                करण्यात येत आहे काय? </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>3) जर गुंतवणुक रोक बँकेत ठेवले असतील तर त्या
                                बाबतचे संबंधित दाखले मिळविले आहेत काय?
                                लिहिली आहे काय? </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>4) गुंतवणुकीची नोंद वही ठेवली आहे काय? व ती अद्यावत लिहीली आहेत काय? </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td colspan="2">13) स्थावर आणि जंगम मालमत्ता :-
                            </td>
                        </tr>
                        <tr>
                            <td>1) संबंधित नोंदवहया ठेवल्या आहेत काय? व त्या अद्यावत
                                लिहीली आहेत काय? </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>2) मालमत्तेची यादी घेवुन प्रत्यक्ष रूजवात घ्या.
                                ताळेबंदातील रकमेशी या बाक्या जमतात काय? </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>3) जमीन आदी स्थावर मालमत्तेच्याबाबद त्याचे विलेख
                                (दस्तऐवज) पहा व ते संस्थेच्या नावावरच आहेत काय हे
                                पहा.
                            </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>4) आवश्यक तेथे मालमत्तेचा अद्यावत विमा उतरविला आहे
                                काय? तसे असल्यास, सर्वसाधारण अभिप्राय त्याचा
                                तपशिल द्या.
                            </td>
                            <td>
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
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
                                <select class="form-control">
                                    <option value="होय">होय</option>
                                    <option value="नाही">नाही</option>
                                </select>
                            </td>

                        </tr>
                        <tr>
                            <td>2) वेगवेगळ्या मालमत्तेवर आकारलेले घसाऱ्याचे दर नमुद
                                करा </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                        <tr>
                            <td>14) तुम्ही लेखापरीक्षा अहवालाच्या मसुद्यासंबंधी
                                संचालक मंडळ वा व्यवस्थापन समिती यांच्याशी चर्चा
                                केली आहे काय? नसल्यास, त्याची कारणे लिहा. </td>
                            <td><input type="text" class="form-control" value="0.00"></td>

                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4> </h4>
                    <div>
                        <button class="btn btn-success">Save</button>
                        <a href="{{url('admin/client/show',$client->id)}}"><button class="btn btn-secondary">Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection