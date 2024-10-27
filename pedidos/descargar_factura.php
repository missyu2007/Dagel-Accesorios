<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar PDF con jsPDF</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>

<h1>Generar PDF con jsPDF</h1>
<button id="download">Descargar PDF</button>

<script>
    document.getElementById('download').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        
        doc.text("Hola mundo!", 10, 10);
        doc.save("documento.pdf");
    });
</script>

</body>
</html>
