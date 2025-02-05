<?php
session_start();
include 'header.php';

global $sql;

?>

    <div class="card">

        <form>
            <label for="student_id">رقم الطالب:</label>
            <input type="text" id="student_id" name="student_id"><br>

            <label for="name">الاسم:</label>
            <input type="text" id="name" name="name"><br>

            <label for="phone">رقم الهاتف:</label>
            <input type="text" id="phone" name="phone"><br>

            <input type="button" value="ابحث" id="search_btn">
        </form>

    </div>

    <script>
        $(document).ready(function () {
            $("#student_id").change(function () {
                var student_id = $("#student_id").val();
                $.post("test_aj.php", { student_id: student_id }, function (data) {
                    if (data.name && data.phone) {
                        $("#name").val(data.name);
                        $("#phone").val(data.phone);
                    } else {
                        alert("عذرا، لم يتم العثور على المنتج.");
                    }
                }, "json");
            });
        });
    </script>
<?php

include "footer.php";


?>