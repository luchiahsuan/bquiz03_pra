<h3>預告片清單</h3>
<div style="width:100%">
    <div style="display: flex;align-items:center;justify-content:center;text-align:center">
        <div style="width:25%">預告片海報</div>
        <div style="width:25%">預告片片名</div>
        <div style="width:25%">預告片排序</div>
        <div style="width:25%">操作</div>
    </div>
    <form action="./api/edit_trailer" method="post">
        <div>
            <?php
            $ts = $Trailer->all(" ORDER BY `rank`");
            foreach ($ts as $key => $t) {

            ?>
                <div style="display: flex;align-items:center;justify-content:center;text-align:center">

                    <div style="width:25%;padding:1px;">
                        <img src="./upload/<?= $t['img']; ?>" style="width:100px;">
                    </div>
                    <div style="width:25%">
                        <input type="text" name="name[]" value="<?= $t['name']; ?>">
                    </div>
                    <div style="width:25%">
                        <input type="button" value="往上">
                        <input type="button" value="往下">
                    </div>
                    <div style="width:25%">
                        <input type="checkbox" name="sh[]" value="<?= $t['id']; ?>">顯示&nbsp;
                        <input type="checkbox" name="del[]" value="<?= $t['id']; ?>">刪除&nbsp;
                        <select name="ani[]">
                            <option value="1">淡入淡出</option>
                            <option value="2">滑入滑出</option>
                            <option value="3">縮放</option>
                        </select>
                    </div>
                </div>
            <?php
            }
            ?>


        </div>
        <div class="ct">
            <input type="submit" value="編輯確定">
            <input type="reset" value="重置">
        </div>
    </form>
</div>

<hr>
<h3 class="ct">新增預告片海報</h3>
<form action="./api/add_trailer.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>預告片海報：<input type="file" name="img"></td>
            <td>預告片片名：<input type="text" name="name"></td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>