<?php

include_once "base.php";
?>
<style>
    #block {
        width: 540px;
        height: 370px;
        background-image: url(./icon/03D04.png);
        box-sizing: border-box;
        background-position: center;
        background-repeat: no-repeat;
        padding-top: 18px;
    }

    .seats {
        width: 316px;
        height: 340px;
        display: flex;
        flex-wrap: wrap;
        margin: auto;
    }

    .seats>div{
        width: 20%;
        height: 85px;
    }
</style>

<div id="block">
    <div class="seats">
        <div>1</div>
        <div>2</div>
        <div>3</div>
        <div>4</div>
        <div>5</div>
        <div>6</div>
        <div>7</div>
        <div>8</div>
        <div>9</div>
        <div>10</div>
        <div>11</div>
        <div>12</div>
        <div>13</div>
        <div>14</div>
        <div>15</div>
        <div>16</div>
        <div>17</div>
        <div>18</div>
        <div>19</div>
        <div>20</div>
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