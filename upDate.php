<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once("dbtools.inc.php");
    $link=create_connection();
    $id=$_POST["id"];
    $sql="SELECT * FROM `talk` WHERE `id`='$id'";
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);

    mysqli_close($link);
    ?>

    <form action="upDate_action" name="upDate" method="post">
        <table align="center" width="800">
            <input type="hidden" name="id" value="<?php echo $row["id"];?>">
            <tr>
                <td colspan="2" align="center"><p>請想輸入修改的留言</p></td>
            </tr>
            <tr>
                <td width="15%">作者:</td>
                <td width="85%"><input type="text" name="name" value="<?php echo $row["name"];?>"></td>
            </tr>
            <tr>
                <td width="15%">gmail:</td>
                <td width="85%"><input type="text" name="gmail" value="<?php echo $row["gmail"];?>"></td>
            </tr>
            <tr>
                <td>
                    性別:<input type="radio" name="sex" value="1" <?php if ($row["sex"] == 1) echo "checked"; ?>>男
                    <input type="radio" name="sex" value="0" <?php if($row["sex"]==0) echo "checked"; ?>>女
                </td>
            </tr>
            <tr>
                <td width="15%">標題:</td>
                <td width="85%"><input type="text" name="subject" value="<?php echo $row["subject"];?>"></td>
            </tr>
            <tr>
                <td width="15%">內容:</td>
                <td width="85%"><textarea name="content" cols="50" rows="5" value="<?php echo $row["content"];?>"><?php echo $row["content"];?></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="送出">
                </td>
            </tr>
        </table>
    </form>


</body>
</html>