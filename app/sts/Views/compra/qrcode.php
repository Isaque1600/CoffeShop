<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>finalizar.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <title>Pagamento via QRCode</title>
</head>

<body class="qr-code-body">
    <img class="upper-img" src="<?php echo IMG_PATH ?>undraw_stripe_payments_re_chlm.svg" alt="">
    <img class="bottom-img" src="<?php echo IMG_PATH ?>undraw_pay_online_re_aqe6.svg" alt="">
    <main class="qrcode-container">
        <div class="qrcode"><img src="<?php echo IMG_PATH ?>qrcode.png" alt="qrcode" style="width: 100%"></div>
        <p>Escaneie o QrCode para realizar o pagamento</p>
        <a class="continue-btn" href="<?php echo DEFAULT_URL ?>pagamento/pix?pagamento=approved">Continue</a>
    </main>
</body>

</html>