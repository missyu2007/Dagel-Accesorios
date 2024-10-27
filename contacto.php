<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo1.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Inicio Dagel</title>
</head>
<body>
<aside></aside>
<div class="container">
    <div class="box-info">
        <h1>CONTACTATE CON NOSOTROS</h1>
        <div class="data">
            <p><i class='bx bxs-phone bx-tada bx-rotate-90'></i> +57-300-098-4321</p>
            <p><i class='bx bx-envelope bx-fade-down'></i> Dagel.accesorios@gmail.com</p>
            <p><i class='bx bx-location-plus bx-fade-down bx-flip-horizontal'></i> No se por Now</p>
        </div>
    </div>
    <div class="links">
        <a href="#" aria-label="Facebook"><i class='bx bxl-facebook-circle'></i></a>
        <a href="#" aria-label="Instagram"><i class='bx bxl-instagram'></i></a>
        <a href="#" aria-label="WhatsApp"><i class='bx bxl-whatsapp'></i></a>
    </div>

    <form action="">
        <div class="input-box">
            <input type="text" name="name" required placeholder="Nombre y Apellido"> <i class='bx bx-user'></i>
        </div>
        <div class="input-box">
            <input type="email" name="email" required placeholder="Correo Electrónico"><i class='bx bxl-gmail'></i>
        </div>
        <div class="input-box">
            <input type="text" name="subject" required placeholder="Asunto"><i class='bx bx-edit'></i>
        </div>
        <div class="input-box">
            <textarea name="message" cols="30" rows="10" placeholder="Escribe tu mensaje"></textarea>
        </div>
        <button type="submit">Enviar Mensaje</button>
    </form>
</div>

</body>
</html>