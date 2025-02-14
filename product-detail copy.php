<?php require __DIR__ . '/__connect_db.php';
$pageName = '';  // 這裡放你的pagename


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
$t_sql = "SELECT * FROM `product` WHERE `sid`= $sid";
$row = $pdo->query($t_sql)->fetch();

$series_sid = $row['series'];
$s_sql = "SELECT `series_name` FROM `product_series` WHERE `series_sid`=$series_sid ";
$series_name = $pdo->query($s_sql)->fetch()['series_name'];


?>
<?php include __DIR__ . '/__html_head.php' ?>
<title>WATZ - 商品頁面</title>

<style>
    .container {
        width: 100vw;
        min-height: 100vh;
        position: relative;
        background-size: cover;
        background-image: url(images/BG3.svg);
        background-repeat: repeat-y;
    }

    .wrapper {
        width: 1200px;
        justify-content: space-between;
        padding: 120px 0;
    }

    .btn-top {
        z-index: 1;
    }

    .block-left-top,
    .block-left-bottom,
    .block-fixed {
        background: white;
        border-radius: 15px;

    }

    .block-left-top,
    .block-left-bottom {
        width: 800px;
        padding: 20px;
    }

    .mobile-visible {
        display: none;
    }

    .block-right {
        width: 350px;
        letter-spacing: 2px;
        position: relative;
    }

    .block-fixed {
        width: 350px;
        height: 80vh;
        padding: 5vh;
        right: calc(50vw - 600px);
        flex-direction: column;
        justify-content: space-between;
        top: 120px;
    }

    .position-sticky {
        position: sticky;
    }

    .block-fixed>h3 {
        margin-bottom: 3vh;
        font-weight: 400;
    }

    .block-fixed .price {
        text-align: right;
        color: #03588C;
        margin: 10vh 0 20px 0;
        font-weight: 600;
    }

    .block-fixed p {
        margin-bottom: 3vh;
    }

    .quantity-choose {
        width: 100%;
        height: 45px;
        border: 1px solid black;
        align-items: center;
        justify-content: space-between;
        border-radius: 2px;
        margin-bottom: 10px;
    }

    .minus,
    .plus {
        width: 30px;
        height: 30px;
        border-radius: 4px;
        text-align: center;
        cursor: pointer;
    }

    .quantity-input {
        height: 25px;
        width: 40px;
        text-align: center;
        font-size: 14px;
        border: 1px solid transparent;
        border-radius: 2px;
        outline: none;

    }

    .block-fixed>button {
        width: 100%;
        height: 45px;
        background: #FF9685;
        border: 0;
        border-radius: 2px;
        color: white;
        font-family: 'Noto Sans TC', sans-serif;
        letter-spacing: 2px;
        outline: none;
        cursor: pointer;
    }

    .block-fixed>button:hover {
        background: #0388A6;
    }

    .block-fixed>ul {
        width: 250px;
        margin: 20px 0;
        justify-content: space-evenly;
        cursor: pointer;
    }

    .block-fixed>ul>li {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: lightcoral;
    }

    .img-select-circle {
        width: 50px;
        margin-left: -5px;
        margin-top: -5px;
        opacity: 0;
    }

    .img-select-circle:hover {
        opacity: 1;
    }

    .active {
        opacity: 1;
    }

    .block-left-top {
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
    }

    .bread-crumb {
        margin: 20px 0 10px 70px;
        align-self: start;
        letter-spacing: 2px;
    }

    .box-photo {
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 40px;
    }

    .slider-box {
        display: none;
    }

    .box-photo-left {
        flex-direction: column;
        justify-content: space-evenly;
    }

    .box-photo-left div {
        width: 120px;
        height: 120px;
        background: grey;
        margin-bottom: 10px;
    }

    .box-photo-right {
        width: 500px;
        height: 600px;
        background: grey;
        margin-left: 10px;
    }

    .box-text {
        margin-bottom: 150px;
        letter-spacing: 2px;
        line-height: 2.5rem;
    }

    .box-promise {
        flex-direction: column;
        width: 100%;
        justify-content: space-evenly;
        align-items: center;
        position: relative;
        margin-bottom: 90px;
    }

    .title-promise {
        width: 250px;
        margin-bottom: 50px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .title-promise>h5 {
        position: absolute;
        color: white;
        margin-top: 10px;
        letter-spacing: 2px;

    }

    .box-promise>ul>li {
        margin: 0 15px;
    }

    .box-promise>ul>li>h5 {
        font-weight: 300;
    }

    .box-bigphoto>div {
        width: 600px;
        height: 400px;
        background: gray;
        margin-bottom: 20px;
    }

    .block-left-bottom {
        margin: 20px 0 0 0;
    }

    .box-suggest {
        margin-bottom: 50px;
    }

    .box-suggest>h5 {
        margin: 20px 0 10px 70px;
        align-self: start;
        letter-spacing: 2px;
        font-weight: 300;
    }

    .box-suggest>ul {
        justify-content: center;
        align-items: center;
    }

    .box-suggest>ul>li {
        width: 190px;
        height: 240px;
        background: gray;
        margin-right: 10px;
    }

    footer {
        z-index: 0;
    }


    @media screen and (max-width: 1280px) {
        .wrapper {
            width: 950px;
            padding: 120px 20px;
        }

        .block-left,
        .block-left-top,
        .block-left-bottom {
            width: 600px;
        }

        .block-right,
        .block-fixed {
            width: 280px;
        }

        .block-fixed {
            right: calc(50vw - 475px);
        }

        .quantity-choose {
            width: 200px;
            margin-bottom: 5px;
        }

        .block-fixed h3 {
            font-size: 1.1rem;
        }

        .block-fixed p {
            font-size: .9rem;
        }

        .block-fixed>ul {
            margin: 20px 0 0 -25px;
        }

        .bread-crumb {
            margin: 20px 0 10px 23px;
        }

        .box-photo-left div {
            width: 100px;
            height: 100px;
        }

        .box-photo-right {
            width: 400px;
            height: 480px;
        }

        .box-bigphoto>div {
            width: 480px;
            height: 320px;
        }

        .box-suggest>ul>li {
            width: 130px;
            height: 160px;
        }

        .block-fixed .price {
            margin: 0;
            margin: 8vh 0 2vh 0;
        }

        .quantity-choose {
            width: 100%;
        }
    }

    @media screen and (max-width: 992px) {
        .wrapper {
            width: 570px;
            padding: 120px 0;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .block-right {
            display: none;
        }

        .block-left {
            width: 90vw;
            margin: 0;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .block-left-top {
            width: 90vw;
            margin: 0;
        }

        .block-left .bread-crumb {
            margin: 0 0 10px;
            width: calc(15vw + 60vw + 10px);
            align-self: auto;
        }

        .wrapper .block-left-top {
            width: 100%;
            margin: 0;
        }

        .box-photo-left div {
            width: 15vw;
            height: 15vw;
        }

        .box-photo-right {
            width: 60vw;
            height: 72vw;
        }

        .mobile-visible {
            display: block;
            width: 100%;
            height: auto;
            padding: 0 40px;
            flex-direction: column;
        }

        .mobile-visible ul {
            display: none;
        }

        .mobile-visible .price {
            margin-top: -59px;
            margin-bottom: 40px;
            font-size: 1.2rem;
        }

        .buy {
            width: 100%;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
        }

        .mobile-visible .quantity-choose {
            width: 60%;
            margin-bottom: 10px;
            margin-top: 30px;
        }

        .buy button {
            width: 60%;
            margin-bottom: 60px;
        }

        .buy button:hover {
            background: #0388A6;
        }

        .box-text {
            width: 100%;
            padding: 0 40px;
            margin-bottom: 100px;
        }

        .box-promise {
            width: 100%;
        }

        .box-bigphoto>div {
            width: 72vw;
            height: 48vw;
        }

        .block-left-bottom {
            width: 90vw;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .box-suggest h5 {
            margin-left: 0;
        }

    }

    @media screen and (max-width: 576px) {
        .wrapper {
            width: 100vw;
            padding: 80px 0 0 0;
        }

        .slider-box {
            display: block;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 20px;
        }

        .slider-box .box-photo-right {
            width: 70vw;
            height: 84vw;
            margin: 0;
        }

        .block-left .bread-crumb {
            width: 70vw;
            margin: 0;
        }

        .mobile-visible {
            width: 70vw;
            padding: 0;
        }

        .box-photo-right {
            background: rgb(212, 212, 212);
        }

        .box-photo {
            position: relative;
        }

        .arrow-left,
        .arrow-right {
            width: 10vw;
            height: 84vw;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0;
        }

        .arrow-right {
            right: 0;
        }

        .arrow-left img,
        .arrow-right img {
            width: 3vw;
        }

        .mobile-visible>h3 {
            margin-bottom: 15px;
        }

        .mobile-visible p {
            margin-bottom: 15px;
        }

        .mobile-visible .price {
            margin-bottom: 30px;
        }

        .mobile-visible .quantity-choose,
        .mobile-visible button {
            width: 70vw;
        }

        .mobile-visible .quantity-choose {
            margin-top: 4px;
        }

        .box-text {
            width: 70vw;
            padding: 0;
        }

        .title-promise img {
            width: 55vw;
        }

        .box-promise ul {
            flex-wrap: wrap;
            justify-content: center;
            padding: 0;
        }

        .box-promise ul li {
            margin: 0 15px 25px 15px;
        }

        .box-suggest ul li {
            width: 25vw;
            height: 30vw;
            margin: 0 5px;
        }


    }
</style>


<div class="container flex">
    <?php include __DIR__ . '/__navbar.php' ?>
    <?php include __DIR__ . '/__html_btn-top.php' ?>

    <div class="wrapper flex transition">
        <div class="block-left transition">
            <div class="block-left-top flex transition">
                <div class="bread-crumb transition">
                    <a href="">商品</a>
                    <span> > </span>
                    <a href=""><?= $series_name ?></a>
                </div>
                <div class="box-photo flex transition mobile-none">
                    <div class="box-photo-left flex transition">
                        <div><img src="" alt=""></div>
                        <div><img src="" alt=""></div>
                        <div><img src="" alt=""></div>
                        <div><img src="" alt=""></div>
                    </div>
                    <div class="box-photo-right transition">
                        <img src="images/product/<?= $row['img_ID'] ?>-1.jpg" alt="">
                    </div>
                </div>
                <div class="box-photo flex transition slider-box flex">
                    <div class="box-photo-left flex transition mobile-none">
                        <div><img src="" alt=""></div>
                        <div><img src="" alt=""></div>
                        <div><img src="" alt=""></div>
                        <div><img src="" alt=""></div>
                    </div>
                    <div class="box-photo-right transition">
                        <img src="" alt="">
                    </div>
                    <div class="arrow-left flex">
                        <img src="images/arrow-left-thiner.svg" alt="">
                    </div>
                    <div class="arrow-right flex">
                        <img src="images/arrow-right-thiner.svg" alt="">
                    </div>
                </div>
                <div class="block-fixed flex mobile-visible mobile-none">
                    <h3><?= $row['product_name'] ?></h3>
                    <p>後腳跟設計可配合兒童成長而長期穿著。具有可抑制汗味的效果。使用對環境溫和的有機棉所製成。</p>
                    <p>中長襪<br>
                        22-25cm<br>
                        材質:100%純棉</p>
                    <ul class="flex">
                        <li class="active">
                            <div class="socks-pattern flex">
                                <img class="img-select-circle transition active" src="images/select circle.svg" alt="">
                                <div class=""><img src="" alt=""></div>
                            </div>
                        </li>
                        <li>
                            <div class="socks-pattern flex">
                                <img class="img-select-circle transition" src="images/select circle.svg" alt="">
                                <div class=""><img src="" alt=""></div>
                            </div>
                        </li>
                        <li>
                            <div class="socks-pattern flex">
                                <img class="img-select-circle transition" src="images/select circle.svg" alt="">
                                <div class=""><img src="" alt=""></div>
                            </div>
                        </li>
                        <li>
                            <div class="socks-pattern flex">
                                <img class="img-select-circle transition" src="images/select circle.svg" alt="">
                                <div class=""><img src="" alt=""></div>
                            </div>
                        </li>
                    </ul>
                    <h3 class="price">售價 120元</h3>
                    <div class="buy flex">
                        <div class="quantity-choose flex">
                            <span class="minus">-</span>
                            <input class="quantity-input" type="text" value="1" />
                            <span class="plus">+</span>
                        </div>
                        <button class="transition btn-coral buy_btn">加入購物車</button>
                    </div>
                </div>
                <div class="box-text">
                    <ul>
                        <li>
                            <p>・手洗／最高水溫不超過30℃</p>
                        </li>
                        <li>
                            <p>・不可以用機器烘乾</p>
                        </li>
                        <li>
                            <p>・棉襪穿起來長度有±2cm彈性，可用腳底長度及穿著舒適感來做選擇</p>
                        </li>
                        <li>
                            <p>＊由於雙針筒織法，可能會有1至2公分的線頭，為正常現象</p>
                        </li>
                    </ul>
                </div>
                <div class="box-promise flex">
                    <div class="title-promise flex">
                        <h5>WATZ與你的五個約定</h5>
                        <img src="images/title-bgc.svg" alt="">
                    </div>
                    <ul class="flex">
                        <li>
                            <img src="images/promise1.svg" alt="">
                            <h5>台灣製造</h5>
                        </li>
                        <li>
                            <img src="images/promise2.svg" alt="">
                            <h5>舒適透氣</h5>
                        </li>
                        <li>
                            <img src="images/promise3.svg" alt="">
                            <h5>蓬鬆柔軟</h5>
                        </li>
                        <li>
                            <img src="images/promise4.svg" alt="">
                            <h5>耐洗耐穿</h5>
                        </li>
                        <li>
                            <img src="images/promise5.svg" alt="">
                            <h5>無害環境</h5>
                        </li>
                    </ul>
                </div>
                <div class="box-bigphoto">
                    <div><img src="" alt=""></div>
                    <div><img src="" alt=""></div>
                    <div><img src="" alt=""></div>
                </div>
            </div>
            <div class="block-left-bottom">
                <div class="box-suggest">
                    <h5>你可能會喜歡:</h5>
                    <ul class="flex">
                        <li><img src="" alt=""></li>
                        <li><img src="" alt=""></li>
                        <li><img src="" alt=""></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="block-right">
            <div class="block-fixed flex position-sticky">
                <h3 class="p_item" data-sid="<?= $sid ?>"><?= $row['product_name'] ?></h3>
                <p><?= $row['introduction'] ?></p>
                <p>中長襪<br>
                    22-25cm<br>
                    材質:100%純棉</p>
                <ul class="flex">
                    <li class="active">
                        <div class="socks-pattern flex">
                            <img class="img-select-circle transition active" src="images/select circle.svg" alt="">
                            <div class=""><img src="" alt=""></div>
                        </div>
                    </li>
                    <li>
                        <div class="socks-pattern flex">
                            <img class="img-select-circle transition" src="images/select circle.svg" alt="">
                            <div class=""><img src="" alt=""></div>
                        </div>
                    </li>
                    <li>
                        <div class="socks-pattern flex">
                            <img class="img-select-circle transition" src="images/select circle.svg" alt="">
                            <div class=""><img src="" alt=""></div>
                        </div>
                    </li>
                    <li>
                        <div class="socks-pattern flex">
                            <img class="img-select-circle transition" src="images/select circle.svg" alt="">
                            <div class=""><img src="" alt=""></div>
                        </div>
                    </li>
                </ul>
                <h3 class="price">售價 120元</h3>
                <div class="quantity-choose flex">
                    <span class="minus">-</span>
                    <input class="quantity-input qty" type="number" value="1" />
                    <span class="plus">+</span>
                </div>
                <button class="transition buy_btn">加入購物車</button>
            </div>
        </div>
    </div>
    <?php include __DIR__ . '/__html_footer.php' ?>
</div>
<?php include __DIR__ . '/__scripts.php' ?>

<script>
    // 同款樣式hover
    $("img.img-select-circle").hover(function(event) {
        $(".img-select-circle").removeClass("active")
    })

    $("img.img-select-circle").mouseleave(function(event) {
        $(".img-select-circle").eq(0).addClass("active")
    })

    // 數量加減功能
    $(document).ready(function() {
        $('.minus').click(function() {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function() {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    });



    // php

    const buy_btn = $('.buy_btn');

    buy_btn.click(function() {
        const p_item = $('.p_item');
        const sid = p_item.attr('data-sid');
        const qty = $('.qty').val();
        const sendObj = {
            action: 'add',
            sid,
            qty
        }
        $.get('cart-handle.php', sendObj, function(data) {
            setCartCount(data);
        }, 'json');

        // alert(sid +','+qty)
    });

</script>

<?php require __DIR__ . '/__html_foot.php' ?>