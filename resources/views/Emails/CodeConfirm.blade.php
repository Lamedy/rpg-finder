<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Код подтверждения</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'alegreya_medium', 'Georgia', serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background: #ffffff;
            margin: 40px auto;
            padding: 40px;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(100, 100, 100, 0.1);
        }

        .header {
            font-family: 'forum', serif;
            font-size: 28px;
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        .message {
            font-family: 'alegreya_medium', serif;
            font-size: 16px;
            line-height: 1.6;
            color: #555;
            margin-bottom: 30px;
            text-align: center;
        }

        .code {
            display: inline-block;
            font-family: 'alegreya_bold', serif;
            font-size: 28px;
            background-color: #eee;
            color: #222;
            padding: 12px 24px;
            border-radius: 8px;
            letter-spacing: 4px;
            margin: 0 auto;
        }

        .footer {
            font-size: 12px;
            color: #999;
            text-align: center;
            margin-top: 30px;
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">Печать Подтверждения</div>

    <div class="message">
        Доблестный искатель, чтобы продолжить свой путь, введите код:
    </div>

    <div style="text-align: center;">
        <div class="code">{{ $code }}</div>
    </div>

    <div class="footer">
        Это письмо отправлено магическим вестником НРИ-Файндер. Если вы не запрашивали код — проигнорируйте его.
    </div>
</div>
</body>
</html>
