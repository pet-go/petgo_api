<!DOCTYPE html>
<html>
<head>
    <title>Pet Clinic</title>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .content {
            text-align: left;
        }
        .senha {
            text-align: center;
            background-color:#aaa;
            padding: 10px
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            font-size: 0.8em;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Olá, {{ $cliente->nome }}!</h1>
        </div>
        <div class="content">
            <p>Seja bem-vindo {{ $cliente->nome }},</p>
            <p>Obrigado por se registrar conosco. Estamos entusiasmados por ter você a bordo.</p>
            <h4>Sua senha de acesso é: </h4>
            <div class="senha">
                <h1> {{ $senha }} </h1>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} {loja}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
