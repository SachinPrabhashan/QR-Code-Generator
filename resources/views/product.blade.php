<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('main.css') }}">

    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <title>QR Code Generator</title>
</head>

<body>
    <div class="qr-area">
        <div>
            <h1 class="text-light">Generate QR Code for Free</h1>
        </div>

        <div class="search-area">
            <form id="qrCodeForm" class="form-group">
                @csrf
                <input class="form-control" type="text" id="data" name="data" placeholder="Enter Data Here"
                    required>
                <button class="btn btn-primary mt-3" type="button" onclick="generateQRCode()">Generate QR Code</button>
            </form>
        </div>

        <div id="qrCodeContainer" class="qrcode-output"></div>

        <div class="downloadbtn">
            <button class="btn btn-success mt-5 " id="downloadBtn" style="display: none;"
                onclick="downloadImage()">Download
                QR
                Code</button>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function generateQRCode() {
            var data = $('#data').val();
            $.ajax({
                type: 'POST',
                url: '{{ route('generateQRCode') }}',
                data: {
                    data: data,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#qrCodeContainer').html(response.qrCode);
                    $('#downloadBtn').show(); // Display the download button
                }
            });
        }

        function downloadQRCode() {
            var dataUrl = $('#qrCodeContainer img').attr('src'); // Get the data URL of the QR code image
            var a = document.createElement('a');
            a.href = dataUrl;
            a.download = 'qrcode.png'; // You can set the filename here
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }

        function downloadImage() {
            // Get the HTML element to be captured
            const htmlElement = document.getElementById('qrCodeContainer');

            // Use html2canvas to capture the HTML element
            html2canvas(htmlElement).then(canvas => {
                // Convert the canvas to a data URL
                const dataUrl = canvas.toDataURL('image/png');

                // Create a link element to trigger the download
                const link = document.createElement('a');
                link.href = dataUrl;
                link.download = 'captured_image.png';

                // Trigger a click on the link to start the download
                link.click();
            });
        }
    </script>
</body>

</html>
