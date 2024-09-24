<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function Delete(id) {
            if (confirm("確認是否刪除該資料")) {
                // 找到對應的刪除表單並提交
                document.getElementById('delete-form-' + id).submit();
            }
        }

        function upDate(id) {
            // 找到對應的修改表單並提交
            document.getElementById('update-form-' + id).submit();
        }
        
    </script>
    <style>
        .message-box{
            padding: 20px;
            position: relative;
        }
        .del-btn{
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .update-btn{
            position: absolute;
            top: 50px;
            right: 10px;
        }
    </style>
</head>
<body>
    <?php
    require_once("dbtools.inc.php");
    $link=create_connection();
    $sql="SELECT * FROM `talk` ORDER BY `id` DESC";
    $result=execute_sql($link,"iamgood",$sql);

    echo "<table width='800' align='center' border='1'>";
    $j=1;
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr><td><div class='message-box'>";
        echo "作者".$row["name"]."&nbsp&nbsp&nbsp   id:".$row["id"]."<br>";
        echo "gmail".$row["gmail"]."<br>";
        if($row["sex"]==1){
            echo "男<br>";
        }else{
            echo "女<br>";
        }
        
        $studies = explode(',', $row["studies"]); // 將科目字串轉換為陣列
        $allSubjects = ['英文', '數學', '國文']; // 定義所有可能的科目

        echo "科目:<select name='studies[]' multiple size='3'>";
        foreach ($allSubjects as $subject) {
            $selected = in_array($subject, $studies) ? 'selected' : ''; // 如果科目已選中，則加上 selected
            echo "<option value='$subject' $selected>$subject</option>";
        }
        echo "</select><br>";

        // 刪除表單
        echo "<form id='delete-form-" . $row["id"] . "' method='POST' action='delete.php' style='display:inline;'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<button type='button' class='del-btn' onclick='Delete(" . $row["id"] . ")'>x</button>";
        echo "</form>";
       
        // 修改表單
        echo "<form id='update-form-" . $row["id"] . "' method='POST' action='upDate.php' style='display:inline;'>";
        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
        echo "<button type='button' class='update-btn' onclick='upDate(" . $row["id"] . ")'>修改</button>";
        echo "</form>";
       
        echo "內容<br><textarea readonly cols='33' rows='5' name='".$row["content"]."'>".$row["content"]."</textarea></tr></td></div>";
        $j++;
    }
    echo "</table>";
    ?>

    
    <form action="post.php" name="myForm" method="post">
        <table width="800" align="center">
            <tr>
                <td colspan="2" align="center"><p>請輸入新的留言</p></td>
            </tr>
            <tr>
                <td width="15%">作者:</td>
                <td width="85%"><input type="text" name="name" size="50"></td>
            </tr>
            <tr>
                <td width="15%">gmail:</td>
                <td width="85%"><input type="text" name="gmail" size="50"></td>
            </tr>
            <tr>
                
                    <td width="15%">性別:</td>
                    <td width="85%"><input type="radio" name="sex" value="1">   男
                    <input type="radio" name="sex" value="0">   女</td><br>
                
            </tr>
            <tr>
                <td width="15%">標題:</td>
                <td width="85%"><input type="text" name="subject" size="50"></td>
            </tr>
            <tr>
                <td width="15%">內容:</td>
                <td width="85%"><textarea name="content" cols="50" rows="5" ></textarea></td>
            </tr>
            <tr>
            <td width="15%">科目:</td>
            <td width="85%">
                <select name="studies[]" multiple size="3">
                    <option value="英文">英文</option>
                    <option value="數學">數學</option>
                    <option value="國文">國文</option>
                </select>
            </td>
        </tr>

            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="送出">
                    <input type="reset" value="重製">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>