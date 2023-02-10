<?php

include_once "base.php";
?>
<style>
    #block {
        width: 540px;
        height: 370px;
        background-image: url(./icon/03D04.png);
        box-sizing: border-box;
        padding-top: 18px;
    }

    .seats {
        width: 316px;
        height: 340px;
        display: flex;
        flex-wrap: wrap;
        margin: auto;
    }

    .seats>div {
        width: 20%;
        height: 85px;
        position: relative;
    }

    .seats input[type='checkbox']{
        position: absolute;
        right: 5px;
        bottom: 5px;
    }
    .null-seat {
        background-image: url(./icon/03D02.png);

    }

    .booking-seat {
        background-image: url(./icon/03D03.png);

    }

    #bolck,
    .null-seat,
    .booking-seat {
        background-position: center;
        background-repeat: no-repeat;

    }
</style>

<div id="block">
    <div class="seats">
        <?php
        for ($i = 0; $i < 20; $i++) {
        ?>

            <div class="null-seat">
                <div>
                    <?php
                    echo (floor($i / 5) + 1) . "排" . ($i % 5 + 1) . "號";
                    ?>
                </div>
                <input type="checkbox" value="$i">
            </div>

        <?php
        }
        ?>


    </div>
</div>
<div id="info">
    <p>您選擇的電影是： <span id="selectMovie"></span> </p>
    <p>您選擇的時刻是： <span id="selectDate"></span>&nbsp;&nbsp;&nbsp;<span id="selectSession"></span> </p>
    <p>您已經勾選 <span id="tickets"></span> 張票，最多可以購買四張票</p>

    <div class="ct">
        <button onclick="$('#orderForm,#booking').toggle();$('#booking').html('')">上一步</button>
        <button>確定</button>
    </div>
</div>