<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nova mensagem do site X7 Rural</title>
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

        .field {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
            color: #166534;
        }

        .value {
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>X7 - Escritório de Advocacia Rural</h1>
            <p>Nova mensagem recebida do site</p>
        </div>

        <div class="content">
            <div class="field">
                <div class="label">Nome:</div>
                <div class="value">{{ $contact->name }}</div>
            </div>

            <div class="field">
                <div class="label">E-mail:</div>
                <div class="value">{{ $contact->email }}</div>
            </div>

            @if ($contact->phone)
                <div class="field">
                    <div class="label">Telefone:</div>
                    <div class="value">{{ $contact->phone }}</div>
                </div>
            @endif

            @if ($contact->company)
                <div class="field">
                    <div class="label">Empresa/Propriedade:</div>
                    <div class="value">{{ $contact->company }}</div>
                </div>
            @endif

            @if ($contact->subject)
                <div class="field">
                    <div class="label">Assunto:</div>
                    <div class="value">{{ $contact->subject }}</div>
                </div>
            @endif

            <div class="field">
                <div class="label">Mensagem:</div>
                <div class="value">{{ nl2br(e($contact->message)) }}</div>
            </div>

            <div class="field">
                <div class="label">Data/Hora:</div>
                <div class="value">{{ $contact->created_at->format('d/m/Y H:i:s') }}</div>
            </div>
        </div>
    </div>
</body>

</html>
