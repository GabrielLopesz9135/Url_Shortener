<!DOCTYPE html>
<html>
<head>
    <title>Email de Teste</title>
</head>
<body>
    <h1>Olá do Laravel!</h1>
    <p>Este é um email de teste enviado usando o Gmail.</p>
    @if(isset($meuDado))
        <p>Você enviou o seguinte dado: {{ $meuDado }}</p>
    @endif
    <p>Atenciosamente,</p>
    <p>Sua Aplicação Laravel</p>
</body>
</html>