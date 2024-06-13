<!DOCTYPE html>
<html>
<head>
    <title>Download Receipt</title>
    <script>
        function downloadAndRedirect(pdfPath) {
            // Buat link unduhan
            var link = document.createElement('a');
            link.href = pdfPath;
            link.download = 'receipt.pdf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            // Arahkan ke halaman index setelah unduhan selesai
            window.location.href = "{{ route('pembayaran.index') }}";
        }
    </script>
</head>
<body onload="downloadAndRedirect('{{ $pdfPath }}')">
    <p>Generating your receipt...</p>
</body>
</html>
