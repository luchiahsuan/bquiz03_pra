<style>
    #poster {
        width: 420px;
        height: 400px;
        position: relative;
    }

    .pos {
        width: 210px;
        height: 280px;
        margin-left: 105px;
        position: absolute;
        text-align: center;
        display: none;
    }

    .pos>img {
        width: 100%;
        height: 260px;
    }

    .controls {
        width: 420px;
        height: 110px;
        margin: 10px auto 0 auto;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        position: absolute;
        bottom: 0;
    }

    .left,
    .right {
        /* width: 40px;
        height: 40px;
        background-color: lightcoral; */
        border-top: 20px solid transparent;
        border-bottom: 20px solid transparent;
    }

    .left {
        border-right: 20px solid white;

    }

    .right {
        border-left: 20px solid white;

    }


    .btns {
        width: 320px;
        height: 100px;
        display: flex;
        overflow: hidden;
    }

    .btn {
        width: 80px;
        font-size: 12px;
        text-align: center;
        flex-shrink: 0;
        box-sizing: border-box;
        padding: 3px;
        position: relative;
    }

    .btn img {
        width: 100%;
        height: 80px;
    }
</style>
<div class="half" style="vertical-align:top;">
    <h1>預告片介紹</h1>
    <div class="rb tab" style="width:95%;">
        <div id="poster">
            <div class="lists">
                <?php
                $posters = $Trailer->all(['sh' => 1]);
                foreach ($posters as $poster) {
                ?>
                    <div class="pos">
                        <img src="./upload/<?= $poster['img']; ?>" alt="">
                        <div><?= $poster['name']; ?></div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="controls">
                <div class="left" onclick="pp(1)"></div>
                <div class="btns">
                    <?php
                    foreach ($posters as $key => $poster) {
                    ?>
                        <div class="btn" id="pos<?= $key; ?>">
                            <img src="./upload/<?= $poster['img']; ?>" alt="">
                            <div><?= $poster['name']; ?></div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="right" onclick="pp(2)"></div>
            </div>
        </div>
    </div>
</div>



<div class="half">
    <h1>院線片清單</h1>
    <div class="rb tab" style="width:95%;">
        <div style="display: flex; flex-wrap:wrap;">
            <?php
            $today = date("Y-m-d");
            $ondate = date("Y-m-d", strtotime("-2 days"));

            $all = q("select count(*) as 'total' from `movie` where `sh`=1 && `ondate` between '$ondate' AND '$today'")[0]['total'];
            $div = 4;
            $pages = ceil($all / $div);
            $now = $_GET['p'] ?? 1;
            $start = ($now - 1) * $div;
            $rows = $Movie->all(['sh' => 1], " && `ondate` between '$ondate' AND '$today' order by `rank` limit $start,$div");
            foreach ($rows as $row) {
            ?>

                <div style="width:46%;margin:0.5%;border:1px solid white;border-radius:5px;padding:5px;">
                    <div style="margin-bottom: 5px;">片名：<?= $row['name'] ?></div>
                    <div style="display:flex; ">
                        <div style="margin-right: 15px;">
                            <img src="./upload/<?= $row['poster']; ?>" alt="" style="width:80px;height:100px;" onclick="location.href='?do=intro&id=<?= $row['id']; ?>'">
                        </div>
                        <div>
                            <p>分級：<img src="./icon/03C0<?= $row['level']; ?>.png" style="width:20px;height:20px;"></p>
                            <p>上映日期：<?= $row['ondate']; ?></p>
                        </div>
                    </div>
                    <div>
                        <button onclick="location.href='?do=intro&id=<?= $row['id']; ?>'">劇情簡介</button>
                        <button onclick="location.href='?do=order&id=<?= $row['id']; ?>'">線上訂票</button>
                    </div>


                </div>

            <?php
            }
            ?>
        </div>
        <div class="ct">
            <?php
            for ($i = 1; $i <= $pages; $i++) {
                $size = ($i == $now) ? '20px' : '16px';
            ?>
                <a href="index.php?p=$i" style="font-size: <?= $size; ?>"> <?= $i; ?> </a>

            <?php
            }
            ?>

        </div>
    </div>
</div>

<script>
    $(".pos").eq(0).show();
    let btns = $(".btn").length;
    let p = 0;
    $(".right,.left").on("click", function() {
        if ($(this).hadClass('left')) {
            if (p - 1 >= 0){
                p - 1;
        } else {
            if (p + 1 <= btns - 4);{
            p + 1;
        }
    }
        $(".btn").animate({right: 80 * p});
    }})

    var nowpage = 0,
        num = <?= count($posters); ?>;

    function pp(x) {
        var s, t;
        if (x == 1 && nowpage - 1 >= 0) {
            nowpage--;
        }
        if (x == 2 && (nowpage + 1) <= num * 1 - 4) {
            nowpage++;
        }
        $(".btn").hide()
        for (s = 0; s <= 3; s++) {
            t = s * 1 + nowpage * 1;
            $("#pos" + t).show()
        }
    }
    pp(1)
</script>