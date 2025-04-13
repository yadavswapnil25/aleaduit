<div class="mb-3">
    <a href="{{ route('admin.client.master', ['id' => $clientId]) }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left"></i> Back
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered" id="masterTable">
        <thead>
            <tr>
                <th>ENTITY</th>
                <th>LAST YEAR</th>
                <th>CURRENT YEAR</th>
                <th>DIFFERENCE</th>
                <th>RESULT</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select class="form-control entity-select" id="entityDropdown">
                        <option>Select Product</option>
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" class="form-control mt-2 custom-entity-input" placeholder="Enter custom product" style="display: none;">
                </td>
                <td><input type="text" class="form-control last-year" placeholder="Enter last year value"></td>
                <td><input type="text" class="form-control current-year" placeholder="Enter current year value"></td>
                <td><input type="text" class="form-control difference" readonly></td>
                <td><input type="text" class="form-control result" readonly></td>
                <td>
                    <button class="btn btn-danger btn-sm remove-row"><i class="fa fa-times"></i></button>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-primary btn-sm" id="addRow"><i class="fa fa-plus"></i> Add Row</button>
    <button class="btn btn-success btn-sm" id="saveData"><i class="fa fa-save"></i> Save Data</button>
</div>

<div class="table-responsive mt-4">
    <table class="table table-bordered" id="summaryTable">
        <thead class="bg-dark text-white">
            <tr>
                <th>ID</th>
                <th>ENTITY</th>
                <th>LAST YEAR</th>
                <th>CURRENT YEAR</th>
                <th>DIFF</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be dynamically populated here -->
        </tbody>
    </table>
</div>

<div class="table-responsive mt-4">
    <table class="table table-bordered" id="totalsTable">
        <thead>
            <tr>
                <th>TOTAL:</th>
                <th>PRICE TOTAL</th>
                <th>QTY TOTAL</th>
                <th>GRAND TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Total:</td>
                <td id="priceTotal">0.00</td>
                <td id="qtyTotal">0.00</td>
                <td id="grandTotal">0.00</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Define dropdown options for different conditions
        const dropdownOptions = {
            'वसूल भागभांडवल': ['सभासद भांडवल', 'Other'],
            'राखीव निधी': ['राखीव निधी', 'Other'],
            'इतर सर्व निधी': [
                'इमारत निधी', 'आकस्मिक फंड','सभासद कल्याण निधी','शिक्षण निधी', 'घसारा निधी', 'कर्मचारी कल्याण निधी',
                 'संशयित बुडीत कर्जनिधी', 'धर्मदाय निधी', 'कल्याण निधी',
                 'नाममात्र फी', 'बुडीत कर्ज निधी', 'संगणक झीज फंड', 'टेम्पररी झीज फंड',
                'संशयित बुडीत कर्ज निधी', 'सभासद देणगी फंड', 'अधिलाभांष', 'कर्मचारी भविष्य निर्वाह निधी',
                'सुरक्षा ठेव निधी', 'भांडवल चढ उतार निधी', 'गुंतवणूक चढ उतार निधी', 'तंत्रज्ञान विकास निधी','आवर्त', 'Other'
            ],
            'ठेवी': [
                'बचत ठेव','आवर्त ठेव', 'मुदत ठेव', 'मुदत ठेव 1 वर्ष', 'मुदत ठेव 2 वर्ष', 'मुदत ठेव 3 वर्ष',
                'मुदत ठेव 4 वर्ष', 'मुदत ठेव 5 वर्ष','दामदुप्पट ठेव', 'दामतिप्पट ठेव','दामचौपट ठेव','आवर्त ठेव 1 वर्ष', 'आवर्त ठेव 2 वर्ष',
                'आवर्त ठेव 3 वर्ष', 'आवर्त ठेव 4 वर्ष', 'आवर्त ठेव 5 वर्ष',
                'कुटुंबनिर्वाह मासिक व्याज योजना','सुकन्या ठेव योजना', 'सुरुक्षा ठेव योजना', 'शुभमंगल ठेव', 'अल्पमुदती ठेव','लक्षावधी ठेव',
                'लक्ष्मी ठेव', 'सुरक्षा ठेव', 'संचालक ठेव', 'नाममात्र सभासद ठेव','सभासद ठेव',
                'सदाफुली ठेव', 'कर्मचारी ठेव', 'मासिक ठेव/पेंशन ठेव योजना', 'कर्ज सुरक्षा ठेव',
                'सभासद मासिक उत्पन्न ठेव', 'Other'
            ],
            'संचित नफा': ['संचित नफा', 'Other'],
            'तरतूद': [
                'कर्मचारी बोनस','परिश्रमिक',
                'इमारत घसारा फंड', 'ऑडिट फी तरतूद', 'शिक्षण निधी तरतूद', 'आयकर तरतूद', 'टॅक्स ऑडिट तरतूद',
                'अध्यक्ष मानधन तरतूद', 'सचिव मानधन तरतूद', 'अपघात विमा तरतूद', 'एन पी ए तरतूद',
                'निवडणूक खर्च तरतूद', 'सभासद कल्याण तरतूद', 'ठेवी वरील देय व्याज तरतूद', 'कर्मचारी मानधन तरतूद',
                'ऑफिस भाडे तरतूद', 'विदुयत बिल तरतूद', 'जी. एस. टी. तरतूद', 'Other'
            ],
            'देणे कर्ज': [
                'बँक खाते', 'बँक ऑफ बडोदा', 'बँक ऑफ इंडिया', 'बँक ऑफ महाराष्ट्र', 'कॅनरा बँक',
                'सेंट्रल बँक ऑफ इंडिया', 'इंडियन बँक', 'इंडियन ओव्हरसीज बँक', 'पंजाब अँड सिंध बँक',
                'पंजाब नॅशनल बँक', 'स्टेट बँक ऑफ इंडिया', 'युको बँक', 'युनियन बँक ऑफ इंडिया',
                'बी डी सी बँक', 'अर्बन को ऑप बँक', 'जनता को ऑप बँक', 'Other'
            ],
            'इतर देणी': [
                'सराफ कमिशन', 'निवडणूक खर्च', 'लाभांश', 'ऑडिट फी', 'विद्युत बिल', 
                'एन.पी.ए.तरतूद', 'भविष्य निर्वाह निधी', 'इतर अनामत', 'कर्ज अनामत', 
                'सुरक्षा ठेव', 'सराफा कमिशन', 'टी डी एस', 
                'जि एस टी', 'व्यवसाय कर', 'शाखा देणे', 'देय कार्यालय भाडे', 
                'कर्मचारी बोनस निधी', 'कर्मचारी ग्रॅच्युटी निधी', 
                'कर्मचारी भविष्य निर्वाह निधी', 'पतसंस्था रिकव्हरी चार्ज', 
                'पतसंस्था प्रोसेस चार्ज', 'विशेष वसुली चार्ज', 
                'कर्मचारी व्यवसाय कर', 'ठेववरील देय व्याज', 'Other'
            ],
            'रोख शिल्लक': [
                'रोख शिल्लक', 'शाखा क्रमांक १', 'शाखा क्रमांक २', 'Other'
            ],
            'बँक शिल्लक': [
                'चालू बँक खाते','बचत बँक खाते','बँक ऑफ बडोदा', 'बँक ऑफ इंडिया', 'बँक ऑफ महाराष्ट्र', 'कॅनरा बँक',
                'सेंट्रल बँक ऑफ इंडिया', 'इंडियन बँक', 'इंडियन ओव्हरसीज बँक', 'पंजाब अँड सिंध बँक',
                'पंजाब नॅशनल बँक', 'स्टेट बँक ऑफ इंडिया', 'युको बँक', 'युनियन बँक ऑफ इंडिया',
                'बी डी सी बँक', 'अर्बन को ऑप बँक', 'जनता को ऑप बँक','चालू खाते', 'Other'
            ],
            'गुंतवणूक': [
                'मुदत ठेव', 'बँक भाग हिस्से', 'राखीव निधी गुंतवणूक', 'इमारत निधी गुंतवणूक',
                'इतर निधी गुंतवणूक', 'दि को-ऑप बँक भाग हिस्से', 'पत संस्था भाग हिस्से',
                'महा राज्य भाग हिस्से', 'कर्मचारी कल्याण निधी', 'कर्मचारी भविष्य निधी',
                'एजन्ट सुरक्षा निधी','महावितरण मुदत ठेव','तंत्रज्ञ विकास निधी','कर्मचारी ग्रॅच्युटी निधी','सुरक्षा ठेव निधी',
                'अपघात सुरक्षा निधी', 'महागुंतवणूक मुदत ठेव', 'बँक आवर्त ठेव',
                'बुडीत कर्ज निधी गुंतवणूक', 'घसारा निधी गुंतवणूक', 'धर्मदाय निधी गुंतवणूक',
                'सभासद कल्याण निधी',
                'लाभांश समीकरण निधी गुंतवणूक', 'संगणक घसारा निधी', 'शेअर्स', 
                'म्युच्युअल फंड', 'टेलेफोन डिपॉझिट', 'वीज मीटर डिपॉझिट', 'Other'
            ],
            'कायम मालमत्ता': [
                'डेड स्टॉक खाते', 'कायम सामान खर्च', 'सॉफ्टवेअर', 'टेम्पररी स्टॉक', 'संगणक',
                'संस्था इमारत', 'धान्य स्टॉक', 'संगणक व सॉफ्टवेअर', 'पाणीशुद्धीकरण मशीन (आर. ओ.)',
                'ऑफिस फर्निचर', 'जनरेटर', 'इन्व्हर्टर', 'संस्थेची जागा', 'प्रिंटर',
                'सोलर पॅनल', 'लॉकर', 'सी.सी.टीव्ही कॅमेरा', 'मोबाईल', 'स्टेशनरी स्टॉक',
                'सायकल', 'इतर गाडी', 'वाचनालय साहित्य', 'Other'
            ],
            'येणे कर्ज': [
                'शुभमंगल ठेव कर्ज', 'सोने तारण', 'वाहन तारण', 'आवर्त ठेव तारण', 
                'दामदुप्पट ठेव तारण', 'मुदत ठेव तारण', 'नित्यनिधी ठेव तारण कर्ज', 
                'आकस्मिक कर्ज', 'गृह तारण कर्ज', 'नाममात्र कर्ज', 'नियमित कर्ज', 
                'पगार तारण कर्ज', 'अल्प मुदती ठेव तारण', 'इतर कर्ज', 'दीर्घ मुदती कर्ज', 
                'वाहन खरेदी कर्ज', 'व्यवसाय तारण कर्ज', 'घर बांधणी कर्ज', 
                'मासिक ठेव तारण कर्ज', 'दामदुप्पट तारण कर्ज','Other'
            ],
            'इतर येणे': [
                'विद्युत बिल कर कपात', 'विमा खर्च घेणे', 'साहायक निधी', 'Diwali Advanced',
                'विद्युत बिल कमिशन घेणे', 'अनामत खाते', 'टी डी एस', 'दिवाळी ऍडव्हान्स',
                'अफरातफर', 'सस्पेन्स', 'Other'
            ],
            'घेणे व्यज':[
                'सोनेतारण कर्ज', '१ वर्षीय मुदतठेव तारण', 'घेणे व्याज एन्डव्हान्स पगार',
                'घेणे व्याज गुंतवणुकीवरील व्याज', 'घेणे व्याज शुभमंगल ठेव कर्ज', 
                'घेणे व्याज सोने तारण', 'घेणे व्याज वाहन तारण', 'घेणे व्याज आवर्त ठेव तारण', 
                'घेणे व्याज दामदुप्पट ठेव तारण', 'घेणे व्याज मुदत ठेव तारण', 
                'घेणे व्याज नित्यनिधी ठेव तारण कर्ज', 'घेणे व्याज आकस्मिक कर्ज', 
                'घेणे व्याज गृह तारण कर्ज', 'घेणे व्याज नाममात्र कर्ज', 
                'घेणे व्याज नियमित कर्ज', 'घेणे व्याज पगार तारण कर्ज', 
                'घेणे व्याज अल्प मुदती ठेव तारण', 'घेणे व्याज इतर कर्ज','घेणे व्याज दीर्घ मुदती कर्ज', 
                'घेणे व्याज वाहन खरेदी कर्ज', 'घेणे व्याज व्यवसाय तारण कर्ज', 
                'घेणे व्याज घर बांधणी कर्ज', 'घेणे व्याज मासिक ठेव तारण कर्ज', 
                'घेणे व्याज दामदुप्पट तारण कर्ज', 'गुंतवणुकीवरील घेणे व्याज', 'Other'
            ],
            'संचित तोटा': ['तोटा', 'Other'],
            'किरकोळ उत्त्पन्न': [
                'किरकोळ उत्त्पन्न','Other'
            ],
            'कर्जावरील व्याज':[
                'कर्जावरील व्याज','Other'
            ],
            'गुंतवणुकीवरील व्याज':[
                'गुंतवणुकीवरील व्याज','Other'
            ],
            'इतर उत्त्पन्न':[
                'इतर उत्त्पन्न','Other'
            ],
            'ठेववरील व्याज':[
                'ठेववरील व्याज','Other'
            ],
            'आस्थापना खर्च':[
                'आस्थापना खर्च','Other'
            ],
            'प्रशासकीय खर्च':[
                'प्रशासकीय खर्च','Other'
            ],
            'तरतुदी':[
                'तरतुदी','Other'
            ],
            'इतर खर्च':[
                'इतर खर्च','Other'
            ]
        };

        // Handle sidebar menu item click
        $('.sidebar-menu-item').on('click', function(e) {
            e.preventDefault();

            // Get the menu name from the clicked item
            const menuName = $(this).data('menu');

            // Get the corresponding dropdown options
            const options = dropdownOptions[menuName] || [];

            // Update the ENTITY dropdown
            const $entityDropdown = $('#entityDropdown');
            $entityDropdown.empty(); // Clear existing options
            $entityDropdown.append('<option>Select Product</option>'); // Add default option
            options.forEach(option => {
                $entityDropdown.append(`<option>${option}</option>`);
            });
            
            // Clear all rows from the masterTable
            $('#masterTable tbody').empty();

            // Add a default empty row with conditional columns
            let defaultRow = `
                <tr>
                    <td>
                        <select class="form-control entity-select">
                            <option>Select Product</option>
                            ${options.map(option => `<option>${option}</option>`).join('')}
                        </select>
                        <input type="text" class="form-control mt-2 custom-entity-input" placeholder="Enter custom product" style="display: none;">
                    </td>
                    <td><input type="text" class="form-control last-year" placeholder="Enter last year value"></td>
                    <td><input type="text" class="form-control current-year" placeholder="Enter current year value"></td>
                    ${
                        menuName === 'देणे कर्ज' || menuName === 'बँक शिल्लक'
                            ? `<td><input type="text" class="form-control bank-amount" placeholder="Enter बँक दाखल्याप्रमाणे रक्कम"></td>`
                            : ''
                    }
                    <td><input type="text" class="form-control difference" readonly></td>
                    <td><input type="text" class="form-control result" readonly></td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-row"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            `;
            $('#masterTable tbody').append(defaultRow);

            // Update table headers conditionally
            const $headerRow = $('#masterTable thead tr');
            $headerRow.find('th').remove(); // Clear existing headers
            $headerRow.append('<th>ENTITY</th>');
            $headerRow.append('<th>LAST YEAR</th>');
            $headerRow.append('<th>CURRENT YEAR</th>');
            if (menuName === 'देणे कर्ज' || menuName === 'बँक शिल्लक') {
                $headerRow.append('<th>बँक दाखल्याप्रमाणे रक्कम</th>');
            }
            $headerRow.append('<th>DIFFERENCE</th>');
            $headerRow.append('<th>RESULT</th>');
            $headerRow.append('<th>ACTION</th>');

            fetchSummaryData();
            calculateTotals();
        });

        // Add Row functionality
        $('#addRow').on('click', function() {
            let newRow = `
                <tr>
                    <td>
                        <select class="form-control entity-select">
                            <option>Select Product</option>
                            <option value="Other">Other</option>
                        </select>
                        <input type="text" class="form-control mt-2 custom-entity-input" placeholder="Enter custom product" style="display: none;">
                    </td>
                    <td><input type="text" class="form-control last-year" placeholder="Enter last year value"></td>
                    <td><input type="text" class="form-control current-year" placeholder="Enter current year value"></td>
                    <td><input type="text" class="form-control difference" readonly></td>
                    <td><input type="text" class="form-control result" readonly></td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-row"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            `;
            $('#masterTable tbody').append(newRow); // Append the new row
            calculateTotals(); // Recalculate totals after adding a row
        });

        // Remove Row functionality
        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            calculateTotals();
        });

        // Save Data functionality
        $('#saveData').on('click', function() {
            let tableData = [];
            const menuName = $('.sidebar-menu-item.active').data('menu'); // Get the active menu name

            $('#masterTable tbody tr').each(function() {
                const entitySelect = $(this).find('.entity-select').val();
                const customEntity = $(this).find('.custom-entity-input').val();
                let row = {
                    menu: menuName, // Include the menu value
                    entity: entitySelect === 'Other' ? customEntity : entitySelect, // Use custom value if "Other"
                    lastYear: $(this).find('.last-year').val(),
                    currentYear: $(this).find('.current-year').val(),
                    bankAmount: $(this).find('.bank-amount').val(), // Include bank account amount if applicable
                    difference: $(this).find('.difference').val(),
                    result: $(this).find('.result').val()
                };
                tableData.push(row);
            });

            const clientId = '{{ $clientId }}';
            if (clientId) {
                $.ajax({
                    url: `/admin/client/${clientId}/save-master-data`, // Dynamically include clientId in the URL
                    method: 'POST',
                    data: {
                        tableData: tableData,
                        _token: '{{ csrf_token() }}' // Include CSRF token for Laravel
                    },
                    success: function(response) {
                        // Clear all rows in the masterTable after saving
                        $('#masterTable tbody').empty();

                        // Optionally, add a default empty row
                        $('#masterTable tbody').append(`
                            <tr>
                                <td>
                                    <select class="form-control entity-select">
                                        <option>Select Product</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <input type="text" class="form-control mt-2 custom-entity-input" placeholder="Enter custom product" style="display: none;">
                                </td>
                                <td><input type="text" class="form-control last-year" placeholder="Enter last year value"></td>
                                <td><input type="text" class="form-control current-year" placeholder="Enter current year value"></td>
                                <td><input type="text" class="form-control difference" readonly></td>
                                <td><input type="text" class="form-control result" readonly></td>
                                <td>
                                    <button class="btn btn-danger btn-sm remove-row"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        `);

                        fetchSummaryData(); // Refresh the summary table
                    },
                    error: function(xhr) {
                        alert('An error occurred while saving data.');
                    }
                });
            } else {
                alert('Client ID is missing. Unable to save data.');
            }
        });

        // Function to calculate totals
        function calculateTotals() {
            let priceTotal = 0; // Sum of LAST YEAR
            let qtyTotal = 0;   // Sum of CURRENT YEAR
            let grandTotal = 0; // Sum of DIFFERENCE

            // Iterate through each row in the summary table
            $('#summaryTable tbody tr').each(function() {
                const lastYear = parseFloat($(this).find('td:nth-child(3)').text()) || 0; // LAST YEAR column
                const currentYear = parseFloat($(this).find('td:nth-child(4)').text()) || 0; // CURRENT YEAR column
                const difference = parseFloat($(this).find('td:nth-child(5)').text()) || 0; // DIFF column

                priceTotal += lastYear;
                qtyTotal += currentYear;
                grandTotal += difference;
            });

            // Update totals in the totals table
            $('#priceTotal').text(priceTotal.toFixed(2)); // Update PRICE TOTAL
            $('#qtyTotal').text(qtyTotal.toFixed(2));     // Update QTY TOTAL
            $('#grandTotal').text(grandTotal.toFixed(2)); // Update GRAND TOTAL
        }

        // Trigger totals calculation after data is populated
        fetchSummaryData(); // Ensure data is fetched and totals are calculated on page load

        // Recalculate totals on input change
        $(document).on('input', '.last-year, .current-year', function() {
            const $row = $(this).closest('tr');
            const lastYear = parseFloat($row.find('.last-year').val()) || 0;
            const currentYear = parseFloat($row.find('.current-year').val()) || 0;

            // Calculate the difference
            const difference = currentYear - lastYear;

            // Update the difference field
            $row.find('.difference').val(difference);

            // Update the result field based on the difference
            if (difference > 0) {
                $row.find('.result').val('Up');
            } else if (difference < 0) {
                $row.find('.result').val('Down');
            } else {
                $row.find('.result').val('Neutral');
            }

            // Recalculate totals
            calculateTotals();
        });

        // Initial calculation
        calculateTotals();

        // Handle delete button in summaryTable
        $(document).on('click', '.delete-summary-row', function() {
            if (confirm('Are you sure you want to delete this row?')) {
                $(this).closest('tr').remove();
                calculateTotals(); // Recalculate totals after deletion
            }
        });

        // Fetch data for summaryTable
        function fetchSummaryData() {
            const menuName = $('.sidebar-menu-item.active').data('menu'); // Get the active menu name

            $.ajax({
                url: `/admin/client/{{ $clientId }}/master-data`, // Dynamically include clientId in the URL
                method: 'GET',
                data: { menu: menuName }, // Pass the menu name as a parameter
                success: function(response) {
                    const $tbody = $('#summaryTable tbody');
                    $tbody.empty(); // Clear existing rows

                    if (response.data.length === 0) {
                        $tbody.append(`
                            <tr>
                                <td colspan="6" class="text-center">No data available</td>
                            </tr>
                        `);
                    } else {
                        response.data.forEach(row => {
                            // Ensure valid numeric values for calculation
                            const lastYear = parseFloat(row.lastYear) || 0;
                            const currentYear = parseFloat(row.currentYear) || 0;
                            const difference = currentYear - lastYear;

                            let newRow = `
                                <tr>
                                    <td>${row.id}</td>
                                    <td>${row.entity}</td>
                                    <td>${lastYear}</td>
                                    <td>${currentYear}</td>
                                    <td>${difference}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete-summary-row" data-id="${row.id}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            `;
                            $tbody.append(newRow);
                        });
                    }

                    // Trigger totals calculation after data is populated
                    calculateTotals();
                },
                error: function(xhr) {
                    alert('An error occurred while fetching summary data.');
                }
            });
        }

        // Handle delete button in summaryTable
        $(document).on('click', '.delete-summary-row', function() {
            const rowId = $(this).data('id');
            if (confirm('Are you sure you want to delete this row?')) {
                $.ajax({
                    url: `/admin/client/master-data/${rowId}`, // Replace with your server endpoint
                    method: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        alert('Row deleted successfully!');
                        fetchSummaryData(); // Refresh the summary table
                    },
                    error: function(xhr) {
                        alert('An error occurred while deleting the row.');
                    }
                });
            }
        });

        // Fetch summary data on page load
        fetchSummaryData();

        // Show input field when "Other" is selected
        $(document).on('change', '.entity-select', function() {
            const $row = $(this).closest('td');
            if ($(this).val() === 'Other') {
                $row.find('.custom-entity-input').show();
            } else {
                $row.find('.custom-entity-input').hide().val(''); // Hide and clear input
            }
        });

    });
</script>