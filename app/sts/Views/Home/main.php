<?php
// * Pagina inicial do site *


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Bonne Café</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>head-foot.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH ?>index.css">
</head>

<?php
require("app/sts/Views/Base/header.php");
?>

<body>
<main class="main">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#2D271Dff" fill-opacity="1" d="M0,288L40,250.7C80,213,160,139,240,138.7C320,139,400,213,480,234.7C560,256,640,224,720,197.3C800,171,880,149,960,160C1040,171,1120,213,1200,202.7C1280,192,1360,128,1400,96L1440,64L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path></svg>    <h1>Produtos mais vendidos</h1>
        <section class="products">
            <div class="products__categories">
                <a href="#" class="product__category">Cafés</a>
                <a href="#" class="product__category">Massas</a>
                <a href="#" class="product__category">Sobremesas</a>
            </div>
            <div class="scroller__container">
                <div class="products__showcase scroller">
                    <div class="scroller__inner">
                        <figure class="showcase__content">
                            <img src="<?php echo IMG_PATH ?>teste.jpg" alt="" class="showcase__img">
                            <div class="showcase__details">
                                <figcaption>Teste</figcaption>
                                <b>R$39,99</b>
                            </div>
                        </figure>
                        <figure class="showcase__content">
                            <img src="<?php echo IMG_PATH ?>teste.jpg" alt="" class="showcase__img">
                            <div class="showcase__details">
                                <figcaption>Teste</figcaption>
                                <b>R$39,99</b>
                            </div>
                        </figure>
                        <figure class="showcase__content">
                            <img src="<?php echo IMG_PATH ?>teste.jpg" alt="" class="showcase__img">
                            <div class="showcase__details">
                                <figcaption>Teste</figcaption>
                                <b>R$39,99</b>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </section>
        <section class="company-benefits">
            <article class="company-benefits__container">
                <div class="benefit">
                    <p><i class="fa-solid fa-headset fa-xl" style="color: #6D9891ff;"></i></p>
                    <p>Estamos sempre próximos a você</p>
                </div>
                <div class="benefit">
                    <p><i class="fa-solid fa-seedling fa-xl" style="color: #6D9891ff;"></i></p>
                    <p>Usamos apenas ingredientes naturais</p>
                </div>
                <div class="benefit">
                    <p><i class="fa-solid fa-battery-full fa-xl" style="color: #6D9891ff;"></i></p>
                    <p>Garantimos a você o alívio que só a Bonne Café pode</p>
                </div>
            </article>
        </section>
    </main>
    <script type="text/javascript" src="<?php echo JS_PATH ?>index.js"></script>
</body>

</html>