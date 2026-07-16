<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ECOMMERCE PHP</title>
    
</head>
<body>
<div class="contenedor">
<?php
require_once("dbcon.php");
?>

<div class="emoji">🛍️</div>
<h1>ECOMMERCE PHP</h1>
<hr>
<p class="estado">Estado del sistema</p>
<div class="correcto">
    Yeii, Proyecto conectado correctamente a la base de datos.
</div>
<form action="login.php" method="get">
    <button type="submit"> Ir al Login </button>
</form>
<footer>
    Administración de Servidores
</footer>

</div>
<style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body{
            background: linear-gradient(135deg,#ffd6e8,#ffeaf4,#fff5fa);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .contenedor{
            background:white;
            width:450px;
            padding:40px;
            border-radius:25px;
            box-shadow:0 10px 30px rgba(255,105,180,.25);
            text-align:center;
            border:4px solid #ffc2d9;
        }

        h1{
            color:#ff4f9a;
            margin-bottom:15px;
            font-size:32px;
        }

        hr{
            border:none;
            height:2px;
            background:#ffd1e3;
            margin:20px 0;
        }

        p{
            color:#666;
            font-size:18px;
            margin:10px 0;
        }

        .estado{
            color:#ff4f9a;
            font-weight:bold;
        }

        .correcto{
            background:#ffe5f0;
            color:#d63384;
            padding:15px;
            border-radius:15px;
            margin:20px 0;
            border:2px solid #ffc2d9;
        }

        button{
            background:#ff69b4;
            color:white;
            border:none;
            padding:15px 35px;
            border-radius:30px;
            font-size:18px;
            cursor:pointer;
            transition:.3s;
            box-shadow:0 5px 15px rgba(255,105,180,.4);
        }

        button:hover{
            background:#ff4f9a;
            transform:scale(1.05);
        }

        .emoji{
            font-size:45px;
            margin-bottom:10px;
        }

        footer{
            margin-top:25px;
            color:#c26b93;
            font-size:14px;
        }
    </style>

</body>
</html>