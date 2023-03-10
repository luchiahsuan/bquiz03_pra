<?php

include_once "base.php";

$orders = $Order->all(['movie' => $_GET['movie'], 'date' => $_GET['date'], 'session' => $_GET['session']]);
// dd($_GET);

$bookings = [];

foreach ($orders as $order) {
    $seats = unserialize($order['seats']);
    $bookings = array_merge($bookings, $seats);
}


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

    .seats input[type='checkbox'] {
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
            if (in_array($i, $bookings)) {

                echo "<div class='booking-seat'>";
            } else {
                echo "<div class='null-seat'>";
            }
            echo "<div>";
            echo (floor($i / 5) + 1) . "排" . ($i % 5 + 1) . "號";
            echo "</div>";
            if (!in_array($i, $bookings)) {
                echo "<input class='chk' type='checkbox' value='$i'>";
            }
            echo "</div>";
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
        <button onclick="checkOut()">確定</button>
    </div>
</div>

<script>
    let seats = [];

    $(".chk").on("change", function() {

        if ($(this).prop('checked')) {
            if (seats.length >= 4) {
                alert("最多只能購買四張票");
                $(this).prop('checked', false)
            } else {
                seats.push($(this).val())
            }
        } else {
            seats.splice(seats.indexOf($(this).val()), 1)
        }
        console.log('seats', seats);
        $("#tickets").text(seats.length)


    })

    function checkOut() {
        $.post("./api/order.php", {
                seats,
                movie: $("#movie option:selected").text(),
                date: $("#day option:selected").val(),
                session: $("#session option:selected").val()
            },
            (result) => {
                console.log(result)
                $("#booking").html(result)
            }
        )
    }
</script>