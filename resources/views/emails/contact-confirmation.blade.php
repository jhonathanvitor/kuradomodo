<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Confirmação - Mensagem recebida</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #166534;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }

        .footer {
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>X7 - Escritório de Advocacia Rural</h1>
            <p>Confirmação de Recebimento</p>
        </div>

        <div class="content">
            <p>Olá, <strong>{{ $contact->name }}</strong>!</p>

            <p>Recebemos sua mensagem com sucesso e agradecemos pelo contato.</p>

            <p>Nossa equipe analisará sua solicitação e retornará em até <strong>24 horas</strong> através do e-mail
                <strong>{{ $contact->email }}</strong>.</p>

            <p>Se precisar de atendimento urgente, entre em contato conosco pelo telefone <strong>(65)
                    99949-2471</strong>.</p>

            <p>Atenciosamente,<br>
                <strong>Equipe X7 Rural</strong>
            </p>
        </div>

        <div class="footer">
            <p>X7 - Escritório de Advocacia Rural<br>
                Av. Eng. Teixe - Av. Especialista Roberto de Mendonça, 2700<br>
                Diamantino - MT | CEP: 78.400-000<br>
                (65) 99949-2471 | contato@x7rural.com.br</p>
        </div>
    </div>
</body>

</html>
