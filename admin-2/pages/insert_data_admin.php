<?php
//  this page all opertion for insert or updata  data for dont agin insert data when reload the page
include "message.php";
include "../db.php";




//add departmant for company use on mange_one_company
function AddDepartment($departID, $comid)
{
    include '../db.php';
    $departSelected = mysqli_query($con, "SELECT * FROM `department` WHERE deprat_id=$departID AND `depart_state`=1")
        or die(mysqli_error($con) . '(1)');
    $res = mysqli_fetch_array($departSelected);

    $ch = mysqli_query($con, "SELECT * FROM `department_com` WHERE deprat_id=$departID AND com_id=$comid")
        or die(mysqli_error($con) . '(1)');
    if (mysqli_num_rows($ch) > 0) {
        $msg = "تم إضافتة مسبقا";
        return false;
    } else {
        $insert = mysqli_query($con, "INSERT INTO `department_com`(
           `deprat_id`, `name_depart_com`, `about_depart_com`, `com_id`, `depart_state_com`, `icon_depart_com`) 
      VALUES ('$res[deprat_id]','$res[name_depart]','$res[about_depart]','$comid','$res[depart_state]','$res[icon_depart]')")
            or die(mysqli_error($con));

        $yy = mysqli_query($con, "SELECT  * FROM `department_com` WHERE deprat_id='" . $departID . "' AND com_id='" . $comid . "'") or die(mysqli_error($con));
        $fr = mysqli_fetch_array($yy);
        $select = mysqli_query($con, "SELECT * FROM `categories` WHERE `depart_id`='" . $departID . "'") or die(mysqli_error($con));
        $cat = mysqli_fetch_array($select);
        $rows = mysqli_num_rows($select);
        while ($rows > 0) {
            $insert_cat = mysqli_query($con, "INSERT INTO `categories_com`(`cat_id_fk`, `id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`, `cat_image_com`, `cat_details_com`, `state_cat_com`) VALUES 
('" . $cat['cat_id'] . "',
'" . $fr['id_depart_com'] . "',
'" . $fr['deprat_id'] . "','" . $comid . "',
'" . $fr['name_depart_com'] . "',
'" . $cat['cat_title'] . "','" . $cat['cat_image'] . "',
'" . $cat['cat_details'] . "','" . $cat['state_cat'] . "')") or die(mysqli_error($con));
            $rows -= 1;
        }
        if ($departSelected && $insert) {
            return true;
        } else {
            return false;
        }
    }
}


//button cahange data staff 

if (isset($_POST['btn_change_staff'])) {

    $user_id_p = $_POST['user_id_p'];

    //var for receives the data
    $user_name_edit = $_POST['user_name_edit'];
    $Email_edit = $_POST['Email_edit'];

    $password_edit = $_POST['password_edit'];
    if (strlen($password_edit) < 12) {
        $password_edit = md5($password_edit);
    }

    $country_edit = $_POST['country_edit'];
    $city_edit = $_POST['city_edit'];
    $phone_number_edit = $_POST['phone_number'];
    $staute_user_edit = isset($_POST['user_status']);
    $permissions_edit = $_POST['permissions'];




    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    if ($picture_name == "" & $picture_type == "") {



        $query = mysqli_query($con, "UPDATE `user` SET `user_name`='" . $user_name_edit . "',`Email`='" . $Email_edit . "',`password`='" . $password_edit . "',`country`='" . $country_edit . "',`city`='" . $city_edit . "',`phone_number`='" . $phone_number_edit . "',`user_state`='" . $staute_user_edit . "',`fk_permissions`='" . $permissions_edit . "' WHERE `user_id`='" . $user_id_p . "'") or die(mysqli_error($con));

        if ($query) {
            Msg_Sucess2();
            header("location:user_data_chang.php?id_user_edit=$user_id_p");
        } else {
            Msg_Error2();
            header("location:user_data_chang.php?id_user_edit=$user_id_p");
        }
    } else {

        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {
            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {

                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $user_id_p . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../../img/user/" . $pic_name); //upload the image for the folder


                //update data for the user
                $query = mysqli_query($con, "UPDATE `user` SET `user_name`='" . $user_name_edit . "',`Email`='" . $Email_edit . "',`password`='" . $password_edit . "',`country`='" . $country_edit . "',`city`='" . $city_edit . "',`icon`='$pic_name',`phone_number`='" . $phone_number_edit . "',`user_state`='" . $staute_user_edit . "',`fk_permissions`='" . $permissions_edit . "' WHERE `user_id`='" . $user_id_p . "'") or die(mysqli_error($con));


                if ($query) {

                    Msg_Sucess2();
                    header("location:user_data_chang.php?id_user_edit=$user_id_p");
                } else {
                    Msg_Error2();
                    header("location:user_data_chang.php?id_user_edit=$user_id_p");
                }
            } else {

                Msg_Warning_size_icon_user();
                header("location:user_data_chang.php?id_user_edit=$user_id_p");
            }
        } else {
            Msg_Warning_icon_user();
            header("location:user_data_chang.php?id_user_edit=$user_id_p");
        }
    }
}













//chang or add data company 
if (isset($_POST['btn_add_or_change_company'])) //عند الضغط على زر حفظ يتم حفظ القيم في متغيرات
{


    $com_id = $_POST['com_id'];


    $com_name = $_POST['com_name'];
    $com_phone = $_POST['com_phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $com_email = $_POST['com_email'];
    $com_location = $_POST['location'];


    $com_status = $_POST['com_status'];
    $com_whatsapp = $_POST['com_whatsapp'];
    $com_telegram = $_POST['com_telegram'];

    $com_website_company = $_POST['com_website_company'];
    $com_instagram = $_POST['com_instagram'];
    $com_facebook = $_POST['com_facebook'];
    $com_twitter = $_POST['com_twitter'];
    $com_linkedin = $_POST['com_linkedin'];
    $com_about_company = $_POST['com_about_company'];
    $com_messg_comm = $_POST['com_messg_comm'];




    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة




    if ($com_id > 0) {
        if ($picture_name == "" & $picture_type == "") {



            $update = mysqli_query($con, "UPDATE `company` SET `com_name`='$com_name',`com_phone`='$com_phone',`city`='$city',`com_status`='$com_status',`address`='$address',`com_email`='$com_email',
            `location`='" . $com_location . "',`date_modifide`=current_timestamp(),`whatsapp`='" . $com_whatsapp . "',`telegram`='" . $com_telegram . "',`website_company`='" . $com_website_company . "',`instagram`='" . $com_instagram . "',
            `facebook`='" . $com_facebook . "',`twitter`='" . $com_twitter . "',`linkedin`='" . $com_linkedin . "',`about_company`='" . $com_about_company . "',`messg_comm`='" . $com_messg_comm . "' 	 WHERE com_id=" . $com_id . "") or die(mysqli_error($con));

            if ($update) {

                header("location:company.php?com_id=$com_id");
            } else {
                header("location:company.php?com_id=$com_id");
            }
        } else {

            if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {

                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $com_id . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../../img/imag_comb/" . $pic_name); //upload the image for the folder

                    //update data for the user
                    $update = mysqli_query($con, "UPDATE `company` SET `com_name`='$com_name',`com_phone`='$com_phone',`city`='$city',`address`='$address',`com_email`='$com_email',`icon`='" . $pic_name . "',
                    `location`='" . $com_location . "',`date_modifide`=current_timestamp(),`whatsapp`='" . $com_whatsapp . "',`telegram`='" . $com_telegram . "',`website_company`='" . $com_website_company . "',`instagram`='" . $com_instagram . "',
                    `facebook`='" . $com_facebook . "',`twitter`='" . $com_twitter . "',`linkedin`='" . $com_linkedin . "',`about_company`='" . $com_about_company . "',`messg_comm`='" . $com_messg_comm . "'	 WHERE com_id=" . $com_id . "") or die(mysqli_error($con));


                    if ($update) {
                        header("location:company.php?com_id=$com_id");
                    } else {
                        header("location:company.php?com_id=$com_id");
                    }
                } else {

                    header("location:company.php?com_id=$com_id");
                }
            } else {
                header("location:company.php?com_id=$com_id");
            }
        }
    } else {


        if ($picture_name == "" & $picture_type == "") {



            $update = mysqli_query($con, "INSERT INTO `company`(`com_name`, `com_phone`, `city`, `address`, `com_email`, `icon`, `com_status`, `comm_Reg`, `contract_accept`,`date_modifide`, `location`,`whatsapp`, `telegram`, `website_company`, `instagram`, `facebook`, `twitter`, `linkedin`, `about_company`, `messg_comm`) VALUES
        ('" . $com_name . "','" . $com_phone . "','" . $city . "','" . $address . "','" . $com_email . "','1.png','1','" . $comm_Reg . "','" . $contract_accept . "',current_timestamp(),'" . $location . "','" . $whatsapp . "','" . $telegram . "','" . $website_company . "','" . $instagram . "','" . $facebook . "','" . $twitter . "','" . $linkedin . "','" . $about_company . "','" . $messg_comm . "');") or die(mysqli_error($con));

            if ($update) {

                header("location:company.php");
            } else {
                header("location:company.php");
            }
        } else {

            if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {

                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $com_name . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../../img/imag_comb/" . $pic_name); //upload the image for the folder

                    //update data for the user
                    $update = mysqli_query($con, "INSERT INTO `company`(`com_name`, `com_phone`, `city`, `address`, `com_email`, `icon`, `com_status`, `comm_Reg`, `contract_accept`,`date_modifide`, `location`,`whatsapp`, `telegram`, `website_company`, `instagram`, `facebook`, `twitter`, `linkedin`, `about_company`, `messg_comm`) VALUES
                ('" . $com_name . "','" . $com_phone . "','" . $city . "','" . $address . "','" . $com_email . "','" . $pic_name . "','1','" . $comm_Reg . "','" . $contract_accept . "',current_timestamp(),'" . $location . "','" . $whatsapp . "','" . $telegram . "','" . $website_company . "','" . $instagram . "','" . $facebook . "','" . $twitter . "','" . $linkedin . "','" . $about_company . "','" . $messg_comm . "');") or die(mysqli_error($con));


                    if ($update) {
                        header("location:company.php");
                    } else {
                        header("location:company.php");
                    }
                } else {

                    header("location:company.php");
                }
            } else {
                header("location:company.php");
            }
        }
    }
}


//this code to stop every think about compny  used in page mange_items_pro
if (isset($_POST['stop_item'])) {
    $state_item = $_POST['state_item'];
    $item_id = $_POST['item_id'];

    $sql_stop_enab_item = "UPDATE `form_items_pro` SET `status_ite_for`='" .$state_item."' WHERE `id_ite_for`='".$item_id."' ;" or die(mysqli_error($con));
    if (mysqli_query($con, $sql_stop_enab_item)) {
        Msg_Sucess2();
    }
    
}

//this code to stop every think about compny  used in page mange_items_pro
if (isset($_POST['state_items_2'])) {
    $item_form_status = $_POST['item_form_status'];
    $item_id = $_POST['item_id'];

    $sql_stop_enab_item = "UPDATE `form_items_pro` SET `status_ite_for`='" . $item_form_status . "'  WHERE `id_ite_for`='" . $item_id . "'  AND status_ite_for!=3  ;" or die(mysqli_error($con));
    if (mysqli_query($con, $sql_stop_enab_item)) {
        Msg_Sucess2();
    }
   
}







//this code to stop every think about compny  used in page mange_size_pro
if (isset($_POST['state_size_1'])) {
    $size_form_status = $_POST['size_form_status'];
    $size_id = $_POST['size_id'];

    $sql_stop_enab_item = "UPDATE `form_size` SET `form_state`='" . $size_form_status . "' WHERE `id_form`='" . $size_id . "' ;" or die(mysqli_error($con));
    if (mysqli_query($con, $sql_stop_enab_item)) {
        Msg_Sucess2();
    }
    
}

//this code to stop every think about compny  used in page mange_size_pro
if (isset($_POST['state_size_2'])) {
    $size_form_status = $_POST['size_form_status'];
    $size_id = $_POST['size_id'];

    $sql_stop_enab_item = "UPDATE `form_size` SET `form_state`='" . $size_form_status . "'  WHERE `id_form`='" . $size_id . "'  AND form_state!=3  ;" or die(mysqli_error($con));
    if (mysqli_query($con, $sql_stop_enab_item)) {
        Msg_Sucess2();
    }
   
}












//this code to stop every think about compny  used in page mang_onmpany
if (isset($_POST['stop_all_com'])) {
    $stop_all_company_stat = $_POST['stop_all_company_stat'];
    $id_com_stop_all_company_stat = $_POST['id_com_stop_all_company_stat'];

    $sql_stop_enab_com = "UPDATE `mang_com` SET `status`=" . $stop_all_company_stat . " WHERE `com_id`=" . $id_com_stop_all_company_stat . " ;" or die(mysqli_error($con));
    if (mysqli_query($con, $sql_stop_enab_com)) {
        Msg_Sucess2();
    }
    $sql_stop_show_com = "UPDATE `company` SET `com_status`=" . $stop_all_company_stat . " WHERE `com_id`=" . $id_com_stop_all_company_stat . " ;" or die(mysqli_error($con));
    if (mysqli_query($con, $sql_stop_show_com)) {
        Msg_Sucess2();
    }
}

//this code to stop show the compny used in page mang_onmpany
if (isset($_POST['stop_show_com'])) {
    $stop_company_stat = $_POST['stop_company_stat'];
    $id_com_stop_company_stat = $_POST['id_com_stop_company_stat'];

    $sql_stop_show_com = "UPDATE `company` SET `com_status`=" . $stop_company_stat . " WHERE `com_id`=" . $id_com_stop_company_stat . " AND com_status!=3  ;" or die(mysqli_error($con));
    if (mysqli_query($con, $sql_stop_show_com)) {
        Msg_Sucess2();
    }
    $sql_stop_enab_com = "UPDATE `mang_com` SET `status`=" . $stop_company_stat . " WHERE `com_id`=" . $id_com_stop_company_stat . "AND status!=3  ;" or die(mysqli_error($con));
    if (mysqli_query($con, $sql_stop_enab_com)) {
        Msg_Sucess2();
    }
}





//this code to add or chang data bunch used in page mang_bunch
if (isset($_POST['add_bunch_or_updata'])) {
    $bunch_ID = $_POST['bunch_ID'];

    $bunch_form_name = $_POST['bunch_form_name'];
    $bunch_form_pro_count = $_POST['bunch_form_pro_count'];
    $bunch_form_price = $_POST['bunch_form_price'];
    $bunch_form_about = $_POST['bunch_form_about'];
    $bunch_form_department = $_POST['bunch_form_department'];


    if ($bunch_ID > 0) {


        $sql_updata_bunch_form = "UPDATE `bunch` SET `bunch_form_name`='" . $bunch_form_name . "',`bunch_form_price`=" . $bunch_form_price . ",`bunch_form_about`='" . $bunch_form_about . "',bunch_form_department='" . $bunch_form_department . "',`bunch_form_pro_count`='" . $bunch_form_pro_count . "',`bunch_form_date_updata`=current_timestamp()	 WHERE `bunch_ID`=" . $bunch_ID . ";";
        if (mysqli_query($con, $sql_updata_bunch_form)) {
            header("location:mang_bunch.php");
        }
    } else {

        $sql_insert_bunch_form = "INSERT INTO `bunch`(`bunch_form_name`, `bunch_form_pro_count`, `bunch_form_price`, `bunch_form_about`,  `bunch_form_department`) VALUES ('" . $bunch_form_name . "'," . $bunch_form_pro_count . "," . $bunch_form_price . ",'" . $bunch_form_about . "','" . $bunch_form_department . "');";
        if (mysqli_query($con, $sql_insert_bunch_form)) {
            header("location:mang_bunch.php");
        }
    }
}



//this code to add or chang data department used in page mange_department
if (isset($_POST['add_department_or_updata'])) {
    $deprat_id = $_POST['deprat_id'];
    $name_depart = $_POST['name_depart'];
    $about_depart = $_POST['about_depart'];


    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة


    if ($deprat_id > 0) {

        if ($picture_name == "" & $picture_type == "") {
            $sql_updata_bunch_form = "UPDATE `department` SET `name_depart`='" . $name_depart . "',`about_depart`='" . $about_depart . "' WHERE `deprat_id`=" . $deprat_id . "";
            if (mysqli_query($con, $sql_updata_bunch_form)) {
                header("location:mange_department.php");
            }
        } else {
            if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {
                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../../img/imag_depart/" . $pic_name); //upload the image for the folder

                    $sql_updata_bunch_form = "UPDATE `department` SET `name_depart`='" . $name_depart . "',`about_depart`='" . $about_depart . "',`icon_depart`='" . $pic_name . "' WHERE `deprat_id`=" . $deprat_id . "";
                    if (mysqli_query($con, $sql_updata_bunch_form)) {
                        header("location:mange_department.php");
                    }
                } else {

                    header("location:mange_department.php");
                }
            } else {

                header("location:mange_department.php");
            }
        }
    } else {
        #if no one have that data we insert data 

        #search about categ if on table debartment
        $result = mysqli_query($con, "SELECT * FROM `department` WHERE `name_depart` = '" . $name_depart . "' ;") or die(mysqli_error($con));
        #if the search on table cat true
        if (mysqli_num_rows($result) != 0) {

            header("location:mange_department.php");
            return 0;
        } elseif ($picture_name == "" & $picture_type == "") {

            $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `department`( `name_depart`, `about_depart`) VALUES ('" . $name_depart . "','" . $about_depart . "');") or die(mysqli_error($con));
            if ($sql_che_ord_non_imag) {
                header("location:mange_department.php");
            } else {
                header("location:mange_department.php");
            }
        } elseif ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {
            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {
                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../../img/imag_depart/" . $pic_name); //upload the image for the folder


                //update data for the order
                $sql_che_ord = mysqli_query($con, "INSERT INTO `department`( `name_depart`, `about_depart`, `icon_depart`) VALUES ('" . $name_depart . "','" . $about_depart . "','" . $pic_name . "');") or die(mysqli_error($con));
                if ($sql_che_ord) {
                    header("location:mange_department.php");
                } else {
                    header("location:mange_department.php");
                }
            } else {

                header("location:mange_department.php");
            }
        } else {
            header("location:mange_department.php");
        }
    }
}




//this code to add or chang data categories used in page mange_categories
if (isset($_POST['add_categories_or_updata'])) {
    $deprat_id = $_POST['deprat_id'];
    $cat_title = $_POST['cat_title'];
    $cat_details = $_POST['cat_details'];
    $cat_id = $_POST['cat_id'];



    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    if ($deprat_id > 0) {
        if ($cat_id > 0) {

            if ($picture_name == "" & $picture_type == "") {
                $sql_updata_bunch_form = "UPDATE `categories` SET `cat_title`='" . $cat_title . "',`depart_id`='" . $deprat_id . "',`cat_details`='" . $cat_details . "' WHERE `cat_id`='" . $cat_id . "'";
                if (mysqli_query($con, $sql_updata_bunch_form)) {
                    header("location:mange_categories.php");
                }
            } else {
                if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
                {
                    if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                    {
                        //code take name file and search . and tak after that
                        $type = substr($picture_name, strrpos($picture_name, '.'));
                        $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                        move_uploaded_file($picture_tmp_name, "../../img/cat_images/" . $pic_name); //upload the image for the folder

                        $sql_updata_bunch_form = "UPDATE `categories` SET `cat_title`='" . $cat_title . "',`depart_id`='" . $deprat_id . "',`cat_image`='" . $pic_name . "',`cat_details`='" . $cat_details . "' WHERE `cat_id`='" . $cat_id . "'";
                        if (mysqli_query($con, $sql_updata_bunch_form)) {
                            header("location:mange_categories.php");
                        }
                    } else {

                        header("location:mange_categories.php");
                    }
                } else {

                    header("location:mange_categories.php");
                }
            }
        }
        #if no one have that data we insert data 
        else {
            #search about categ if on table debartment
            $result = mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_title`='" . $cat_title . "' AND `depart_id`='" . $deprat_id . "'") or die(mysqli_error($con));
            #if the search on table cat true
            if (mysqli_num_rows($result) != 0) {

                header("location:mange_categories.php");
                return 0;
            } elseif ($picture_name == "" & $picture_type == "") {

                $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `categories`(`cat_title`, `depart_id`, `cat_details`)
            VALUES ('" . $cat_title . "','" . $deprat_id . "','" . $cat_details . "');") or die(mysqli_error($con));
                if ($sql_che_ord_non_imag) {
                    header("location:mange_categories.php");
                } else {
                    header("location:mange_categories.php");
                }
            } elseif ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {
                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../../img/cat_images/" . $pic_name); //upload the image for the folder


                    //update data for the order
                    $sql_che_ord = mysqli_query($con, "INSERT INTO `categories`(`cat_title`, `depart_id`,`cat_image`, `cat_details`)
                    VALUES ('" . $cat_title . "','" . $deprat_id . "','" . $pic_name . "','" . $cat_details . "');") or die(mysqli_error($con));
                    if ($sql_che_ord) {
                        header("location:mange_categories.php");
                    } else {
                        header("location:mange_categories.php");
                    }
                } else {

                    header("location:mange_categories.php");
                }
            } else {
                header("location:mange_categories.php");
            }
        }
    } else {
        header("location:mange_categories.php");
        return 0;
    }
}

//this code to add or chang data categories used in page mange_categories
if (isset($_POST['add_form_items_or_updata'])) {
    $fk_cat_ite_for = $_POST['fk_cat_ite_for'];
    $items_title = $_POST['items_title'];
    $items_details = $_POST['items_details'];
    $items_id = $_POST['items_id'];



    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    if ($fk_cat_ite_for > 0) {
        if ($items_id > 0) {

            if ($picture_name == "" & $picture_type == "") {
                $sql_updata_item_form = "UPDATE `form_items_pro` SET `fk_cat_ite_for`='" . $fk_cat_ite_for . "',`na_ite_fo`='" . $items_title . "',`detali_ite_fo`='" . $items_details . "' WHERE `id_ite_for`='" . $items_id . "'";
                if (mysqli_query($con, $sql_updata_item_form)) {
                    header("location:mange_items_pro.php");
                }
            } else {
                if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
                {
                    if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                    {
                        //code take name file and search . and tak after that
                        $type = substr($picture_name, strrpos($picture_name, '.'));
                        $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                        move_uploaded_file($picture_tmp_name, "../../img/items_photo/" . $pic_name); //upload the image for the folder

                        $sql_updata_item_form = "UPDATE `form_items_pro` SET `fk_cat_ite_for`='" . $fk_cat_ite_for . "',`na_ite_fo`='" . $items_title . "',`detali_ite_fo`='" . $items_details . "',`img_ite_for`='" . $pic_name . "' WHERE `id_ite_for`='" . $items_id . "'";
                        if (mysqli_query($con, $sql_updata_item_form)) {
                            header("location:mange_items_pro.php");
                        }
                    } else {

                        header("location:mange_items_pro.php");
                    }
                } else {

                    header("location:mange_items_pro.php");
                }
            }
        }
        #if no one have that data we insert data 
        else {
            #search about categ if on table debartment
            $result = mysqli_query($con, "SELECT * FROM `form_items_pro` WHERE `na_ite_fo`='" . $items_title . "' AND `fk_cat_ite_for`='" . $fk_cat_ite_for . "'") or die(mysqli_error($con));
            #if the search on table cat true
            if (mysqli_num_rows($result) != 0) {

                header("location:mange_items_pro.php");
                return 0;
            } elseif ($picture_name == "" & $picture_type == "") {

                $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `form_items_pro`( `fk_cat_ite_for`, `na_ite_fo`, `detali_ite_fo`)
            VALUES ('" . $fk_cat_ite_for . "','" . $items_title . "','" . $items_details . "');") or die(mysqli_error($con));
                if ($sql_che_ord_non_imag) {
                    header("location:mange_items_pro.php");
                } else {
                    header("location:mange_items_pro.php");
                }
            } elseif ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {
                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../../img/items_photo/" . $pic_name); //upload the image for the folder


                    //update data for the order
                    $sql_che_ord = mysqli_query($con, "INSERT INTO `form_items_pro`( `fk_cat_ite_for`, `na_ite_fo`, `detali_ite_fo`, `img_ite_for`)
                    VALUES ('" . $fk_cat_ite_for . "','" . $items_title . "','" . $items_details . "','" . $pic_name . "');") or die(mysqli_error($con));
                    if ($sql_che_ord) {
                        header("location:mange_items_pro.php");
                    } else {
                        header("location:mange_items_pro.php");
                    }
                } else {

                    header("location:mange_items_pro.php");
                }
            } else {
                header("location:mange_items_pro.php");
            }
        }
    } else {
        header("location:mange_items_pro.php");
        return 0;
    }
}

//this code to add or chang data categories used in page mange_size_pro
if (isset($_POST['add_form_size_or_updata'])) {
    $fk_cat_ite_for = $_POST['size_cat'];
    $size_title = $_POST['size_title'];
    $size_details = $_POST['size_details'];
    $size_id = $_POST['size_id'];


    if ($fk_cat_ite_for > 0) {
        if ($size_id > 0) {

            
                $sql_updata_item_form = "UPDATE `form_size` SET `cat_fk_id`='" . $fk_cat_ite_for . "',`size`='" . $size_title . "',`details`='" . $size_details . "' WHERE `id_form`='" . $size_id . "'";
                if (mysqli_query($con, $sql_updata_item_form)) {
                    header("location:mange_size_pro.php");
                }
             else {
                header("location:mange_size_pro.php");
            }
        }
        #if no one have that data we insert data 
        else {
            #search about categ if on table debartment
            $result = mysqli_query($con, "SELECT * FROM `form_size` WHERE `size`='" . $size_title . "' AND `cat_fk_id`='" . $fk_cat_ite_for . "'") or die(mysqli_error($con));
            #if the search on table cat true
            if (mysqli_num_rows($result) != 0) {

                header("location:mange_size_pro.php");
                return 0;
            } else{

                $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `form_size`( `cat_fk_id`, `size`, `details`)
            VALUES ('" . $fk_cat_ite_for . "','" . $size_title . "','" . $size_details . "');") or die(mysqli_error($con));
                if ($sql_che_ord_non_imag) {
                    header("location:mange_size_pro.php");
                } else {
                    header("location:mange_size_pro.php");
                }
            }
        }
    } else {
        header("location:mange_size_pro.php");
        return 0;
    }
}

//this code to add or chang data bunch used in page mang_bunch
if (isset($_POST['stop_bunch_form'])) {
    $bunch_ID = $_POST['bunch_ID'];
    $bunch_form_status = $_POST['bunch_form_status'];

    if ($bunch_ID > 0) {


        $sql_updata_bunch_form = "UPDATE `bunch` SET `bunch_form_status`=" . $bunch_form_status . " ,`bunch_form_date_updata`=current_timestamp() WHERE `bunch_ID`=" . $bunch_ID . ";";
        if (mysqli_query($con, $sql_updata_bunch_form)) {
            header("location:mang_bunch.php");
        }
    }
}



//this code to add or chang  department state stop or turn on used in page mange_department
if (isset($_POST['stop_department1'])) {
    $depart_id = $_POST['depart_id'];
    $depart_state = $_POST['depart_state'];

    if ($depart_id > 0) {


        $sql_updata_department_stope = "UPDATE `department` SET `depart_state`='" . $depart_state . "' WHERE `deprat_id`=" . $depart_id . "";
        if (mysqli_query($con, $sql_updata_department_stope)) {
            header("location:mange_department.php");
        }

        $sql_updata_depart_com_stope = "UPDATE `department_com` SET `depart_state_com`=" . $depart_state . " WHERE `deprat_id`=" . $depart_id . "";
        if (mysqli_query($con, $sql_updata_depart_com_stope)) {
            header("location:mange_department.php");
        }
    }
}


//this code to add or chang  department state show or hide used in page mange_department
if (isset($_POST['stop_department2'])) {
    $depart_id = $_POST['depart_id'];
    $depart_state = $_POST['depart_state'];

    if ($depart_id > 0) {


        $sql_updata_department_hide = "UPDATE `department` SET `depart_state`='" . $depart_state . "' WHERE `deprat_id`=" . $depart_id . " AND `depart_state`!=3";
        if (mysqli_query($con, $sql_updata_department_hide)) {
            header("location:mange_department.php");
        }

        $sql_updata_depart_com_hide = "UPDATE `department_com` SET `depart_state_com`=" . $depart_state . " WHERE `deprat_id`=" . $depart_id . " AND `depart_state_com`!=3";
        if (mysqli_query($con, $sql_updata_depart_com_hide)) {
            header("location:mange_department.php");
        }
    }
}










//this code to add or chang  department state stop or turn on used in page mange_department
if (isset($_POST['stop_cat1'])) {
    $cat_id = $_POST['cat_id'];
    $state_cat = $_POST['state_cat'];

    if ($cat_id > 0) {


        $sql_updata_cat_stope = "UPDATE `categories` SET `state_cat`='" . $state_cat . "' WHERE `cat_id`=" . $cat_id . "";
        if (mysqli_query($con, $sql_updata_cat_stope)) {
            header("location:mange_categories.php");
        }

        $sql_updata_cat_com_stope = "UPDATE `categories_com` SET `state_cat_com`=" . $state_cat . " WHERE `cat_id_fk`=" . $cat_id . "";
        if (mysqli_query($con, $sql_updata_cat_com_stope)) {
            header("location:mange_categories.php");
        }
    }
}


//this code to add or chang  department state show or hide used in page mange_department
if (isset($_POST['stop_cat2'])) {
    $cat_id = $_POST['cat_id'];
    $state_cat = $_POST['state_cat'];

    if ($cat_id > 0) {


        $sql_updata_cat_hide = "UPDATE `categories` SET `state_cat`='" . $state_cat . "' WHERE `cat_id`=" . $cat_id . " AND `state_cat`!=3";
        if (mysqli_query($con, $sql_updata_cat_hide)) {
            header("location:mange_categories.php");
        }

        $sql_updata_cat_com_hide = "UPDATE `categories_com` SET `state_cat_com`=" . $state_cat . " WHERE `cat_id_fk`=" . $cat_id . " AND `state_cat_com`!=3";
        if (mysqli_query($con, $sql_updata_cat_com_hide)) {
            header("location:mange_categories.php");
        }
    }
}




















//this code to turn on  bunch used in page Subscription_requests & detailsSubscrip
if (isset($_POST['turn_on_bunch'])) {
    $bunch_com_status = $_POST['bunch_com_status'];
    $id_bunch_com = $_POST['id_bunch_com'];
    $type = $_POST['type_pagr'];
    //cod updata com_bunch to acceept this bunch_com to the company
    if ($type == "insert_from_Subscription_requests") {
        $sql_updata_bunch_form = "UPDATE `bunch_com` SET `bunch_com_status`=1 WHERE `id_bunch_com`=" . $id_bunch_com . " ;";
        if (mysqli_query($con, $sql_updata_bunch_form)) {
            header("location:Subscription_requests.php");
        }
    }
    //cod updata com_bunch to 2 for stop or start bunch
    if ($type == "insert_from_detailsSubscrip") {
        $sql_updata_bunch_form = "UPDATE `bunch_com` SET `bunch_com_status`=" . $bunch_com_status . " WHERE `id_bunch_com`=" . $id_bunch_com . " ;";
        if (mysqli_query($con, $sql_updata_bunch_form)) {
            header("location:detailsSubscrip.php");
        }
    }
}













//this code to stop show the compny used in page detailsSubscrip
if (isset($_POST['add_bunch_to_the_comany'])) {
    $comid = $_POST['com_id'];
    $bunch_form_name_come = $_POST['bunch_name'];

    $sql = mysqli_query($con, "SELECT `bunch_form_name`, `bunch_form_pro_count`, `bunch_form_price`, `bunch_form_about`, `bunch_form_department` FROM `bunch` WHERE `bunch_form_name`='" . $bunch_form_name_come . "';") or die(mysqli_error($con));
    $r = mysqli_fetch_array($sql);
    $bunch_form_name = $r['bunch_form_name'];
    $bunch_form_pro_count = $r['bunch_form_pro_count'];
    $bunch_form_price = $r['bunch_form_price'];
    $bunch_form_about = $r['bunch_form_about'];
    $bunch_form_department = $r['bunch_form_department'];

    $q = "INSERT INTO `bunch_com`(`com_id`, `date_subs`, `bunch_com_status`, `bunch_name_com`, `pro_count_com`, `bunch_com_price`, `bunch_com_about`, `bunch_com_depatr`) VALUES (" . $comid . ", CURRENT_TIMESTAMP(),1,'" . $bunch_form_name . "'," . $bunch_form_pro_count . "," . $bunch_form_price . ",'" . $bunch_form_about . "','" . $bunch_form_department . "')";

    $res = mysqli_query($con, $q) or die(mysqli_error($con));
    if ($res) {
        echo Msg_Sucess();
    } else {
        echo Msg_Error();
    }
}

























//this code to accept new center used in page orderAcceptable
if (isset($_POST['click_accept'])) {
    $id_com_accept = $_POST['id_com_accept'];

    $sql_accep_new_center = "UPDATE `company` SET `com_status`=1 WHERE `com_id`=" . $id_com_accept . ";";
    $sql_accep_new_center_email_pass = "UPDATE `mang_com` SET `status`=1 WHERE `com_id`=" . $id_com_accept . ";";


    if (mysqli_query($con, $sql_accep_new_center)) {
        if (mysqli_query($con, $sql_accep_new_center_email_pass)) {
            header("location:orderAcceptable.php");
        }
    }
}




//this code to non_accept new center used in page orderAcceptable
if (isset($_POST['click_non_accept'])) {
    $com_id_non_accept = $_POST['com_id_non_accept'];

    $sql_non_accep_new_center = "UPDATE `company` SET `com_status`=4 WHERE `com_id`=" . $com_id_non_accept . ";";
    $sql_non_accep_new_center_email_pass = "UPDATE `mang_com` SET `status`=4 WHERE `com_id`=" . $com_id_non_accept . ";";


    if (mysqli_query($con, $sql_non_accep_new_center)) {
        if (mysqli_query($con, $sql_non_accep_new_center_email_pass)) {
            header("location:orderAcceptable.php");
        }
    }
}








//*********this cod for copmany and prodects 


//this cod for stope prodect from one copmany 
if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $com_id = $_GET['com_id'];
    $sql = "UPDATE `product` SET `status_pro`='2' WHERE `product_id`=" . $id . ";";
    if (mysqli_query($con, $sql) or die(mysqli_error($con))) {

        // Msg_Sucess();
        header("location:mange_one_company.php?com_id=$com_id");
    } else {
        // Msg_Error();
    }
}


//back the prodect for the company 
if (isset($_GET['back_pro'])) {
    $back_pro = $_GET['back_pro'];
    $id_company = $_GET['id_company'];
    $sql_back_prod = "UPDATE `product` SET `status_pro`=1 WHERE  `product_id`=?";
    $stmt = mysqli_prepare($con, $sql_back_prod);
    mysqli_stmt_bind_param($stmt, "i", $back_pro);
    if (mysqli_stmt_execute($stmt)) {
        // Msg_Sucess();
        header("location:mange_one_company.php?com_id=$id_company");
    } else {
        header("location:mange_one_company.php?com_id=$id_company");
    }
    mysqli_stmt_close($stmt);
}







function GetProductBy_depart_id($id, $com_id)
{
    include '../db.php';

    $result = mysqli_query($con, "SELECT `product_id`,product_title,name_depart_com,cat_title,QR_number,product_image,price,opponent,product_desc,notice,product.com_id com_id FROM `product`,department_com,categories WHERE product.id_depart_com=department_com.id_depart_com AND product.product_cat=categories.cat_id AND product.com_id='" . $com_id . "' AND product.id_depart_com='" . $id . "' AND `status_pro`=1") or die(mysqli_error($con));
    if (mysqli_num_rows($result) > 0) {
?>
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">

                        <table id="osa<?php echo $id; ?>" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th># </th>
                                    <th>بيانات المنتج</th>

                                    <th>
                                        <span>الصنف</span>
                                    </th>
                                    <th>
                                        <span class="badge badge-danger">السعر</span><span class="badge badge-warning">الخصم</span>
                                    </th>
                                    <th>رقم الباركود</th>
                                    <th>
                                        #</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $count_row = 0;
                                while ($pro_depart = mysqli_fetch_array($result)) {

                                ?>

                                    <tr>
                                        <td><?php echo $count_row += 1; ?></td>
                                        <td>
                                            <img src="../../img/product_images/<?php echo $pro_depart['product_image']; ?>" alt="<?php echo $pro_depart['product_title']; ?>" width='50px' height='50px' class='img-fluid rounded'>
                                            <?php echo $pro_depart['product_title']; ?>

                                            <p style="display: none;"> <?php echo $pro_depart['product_id']; ?></p>
                                        </td>

                                        <td><span class="badge badge-success">
                                                <?php echo $pro_depart['name_depart_com']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-info"><?php echo $pro_depart['cat_title']; ?></span>
                                            </small>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $pro_depart['price']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-warning">
                                                    <?php echo $pro_depart['opponent']; ?>
                                                </span>
                                            </small>
                                        </td>

                                        <td>

                                            <?php echo $pro_depart['QR_number']; ?>

                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-sm " href='insert_data_admin.php?delete&com_id=<?php echo $pro_depart['com_id'] ?>&id=<?php echo $pro_depart['product_id'] ?>' id="" role="button">إيقاف</a>



                                        </td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>

                        </table>
                        <script>
                            $(function() {
                                $("#osa<?php echo $id; ?>").DataTable();
                                $('#example2').DataTable({
                                    "paging": true,
                                    "lengthChange": false,
                                    "searching": false,
                                    "ordering": true,
                                    "info": true,
                                    "autoWidth": false,
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>


    <?php } else {
    ?>
        <p class="h5 text-center">لا يوجد منتجات</p>
<?php
    }
}
?>



<?php



function GetProduct_deleted_By_id_com($com_id)
{
    include '../db.php';


    $sql_st_pro1 = mysqli_query($con, "SELECT `product_id`,product_title,name_depart_com,cat_title,QR_number,product_image,price,opponent,product_desc,notice FROM `product`,department_com,categories WHERE product.id_depart_com=department_com.id_depart_com AND product.product_cat=categories.cat_id AND product.status_pro=0 AND product.com_id='" . $com_id . "' ") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_st_pro1) == 0) {
        echo "<h6 class='text-center'>لا توجد منتجات محذوفة</h6>";
    } else {
?>



        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">

                        <table id="table-deleted-product" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th># </th>
                                    <th>بيانات المنتج</th>

                                    <th>
                                        <span>الصنف</span>
                                    </th>
                                    <th>
                                        <span class="badge badge-danger">السعر</span><span class="badge badge-warning">الخصم</span>
                                    </th>
                                    <th>رقم الباركود</th>
                                    <th>
                                        #</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $count_row = 0;

                                while ($pro_deleted = mysqli_fetch_array($sql_st_pro1)) {

                                ?>

                                    <tr>
                                        <td><?php echo $count_row += 1; ?></td>
                                        <td>
                                            <img width='50px' height='50px' class='img-fluid rounded' src="../../img/product_images/<?php echo $pro_deleted['product_image']; ?>" alt="<?php echo $pro_deleted['product_title']; ?>">
                                            <?php echo $pro_deleted['product_title']; ?>

                                            <p style="display: none;"> <?php echo $pro_deleted['product_id']; ?></p>

                                        </td>

                                        <td><span class="badge badge-success">
                                                <?php echo $pro_deleted['name_depart_com']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-info"><?php echo $pro_deleted['cat_title']; ?></span>
                                            </small>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $pro_deleted['price']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-warning">
                                                    <?php echo $pro_deleted['opponent']; ?>
                                                </span>
                                            </small>
                                        </td>

                                        <td>
                                            <?php echo $pro_deleted['QR_number']; ?>

                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href='insert_data_admin.php?back_pro=<?php echo $pro_deleted['product_id'] ?>&id_company=<?php echo $com_id ?>' id="" role="button">
                                                <i class="fas fa-1x fa-sync-alt">
                                                </i>
                                                إعادة
                                            </a>
                                        </td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>






<?php

    }
}
?>






<?php



function GetProduct_deleted_by_admin_website_By_id_com($com_id)
{
    include '../db.php';


    $sql_st_pro1 = mysqli_query($con, "SELECT `product_id`,product_title,name_depart_com,cat_title,QR_number,product_image,price,opponent,product_desc,notice FROM `product`,department_com,categories WHERE product.id_depart_com=department_com.id_depart_com AND product.product_cat=categories.cat_id AND product.status_pro=2 AND product.com_id='" . $com_id . "' ") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_st_pro1) == 0) {
        echo "<h6 class='text-center'>لا توجد منتجات محذوفة</h6>";
    } else {
?>



        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">

                        <table id="producte_deleted_by_admin_website" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th># </th>
                                    <th>بيانات المنتج</th>

                                    <th>
                                        <span>الصنف</span>
                                    </th>
                                    <th>
                                        <span class="badge badge-danger">السعر</span><span class="badge badge-warning">الخصم</span>
                                    </th>
                                    <th>رقم الباركود</th>
                                    <th>
                                        #</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $count_row = 0;
                                while ($pro_deleted = mysqli_fetch_array($sql_st_pro1)) {

                                ?>

                                    <tr>
                                        <td><?php echo $count_row += 1; ?></td>
                                        <td>
                                            <img width='50px' height='50px' class='img-fluid rounded' src="../../img/product_images/<?php echo $pro_deleted['product_image']; ?>" alt="<?php echo $pro_deleted['product_title']; ?>">
                                            <?php echo $pro_deleted['product_title']; ?>

                                            <p style="display: none;"> <?php echo $pro_deleted['product_id']; ?></p>

                                        </td>

                                        <td><span class="badge badge-success">
                                                <?php echo $pro_deleted['name_depart_com']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-info"><?php echo $pro_deleted['cat_title']; ?></span>
                                            </small>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $pro_deleted['price']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-warning">
                                                    <?php echo $pro_deleted['opponent']; ?>
                                                </span>
                                            </small>
                                        </td>

                                        <td>
                                            <?php echo $pro_deleted['QR_number']; ?>

                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href='insert_data_admin.php?back_pro=<?php echo $pro_deleted['product_id'] ?>&id_company=<?php echo $com_id ?>' id="" role="button">
                                                <i class="fas fa-1x fa-sync-alt">
                                                </i>
                                                إعادة
                                            </a>
                                        </td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>






<?php

    }
}
?>





<?php



function Get_all_Product_By_id_com($com_id)
{
    include '../db.php';


    $sql_all_product = mysqli_query($con, "SELECT `product_id`,product_title,name_depart_com,cat_title,QR_number,product_image,price,opponent,product_desc,notice,`status_pro`,`product`.`com_id` FROM `product`,department_com,categories WHERE product.id_depart_com=department_com.id_depart_com AND product.product_cat=categories.cat_id  AND product.com_id='" . $com_id . "' ") or die(mysqli_error($con));
    if (mysqli_num_rows($sql_all_product) == 0) {
        echo "<h6 class='text-center'>لا توجد منتجات </h6>";
    } else {
?>

        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">

                <div class="row">
                    <div class="col-sm-12 table-responsive p-0">

                        <table id="table-all-product" class="table table-bordered table-hover dataTable " role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th>#</th>
                                    <th>بيانات المنتج</th>

                                    <th>
                                        <span>الصنف</span>
                                    </th>
                                    <th>
                                        <span class="badge badge-danger">السعر</span><span class="badge badge-warning">الخصم</span>
                                    </th>
                                    <th>رقم الباركود</th>
                                    <th>حالة المنتج</th>
                                    <th>
                                        #</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $count_row = 0;



                                while ($all_product = mysqli_fetch_array($sql_all_product)) {

                                ?>

                                    <tr>
                                        <td>
                                            <p> <?php echo $count_row += 1; ?></p>
                                        </td>
                                        <td>
                                            <img width='50px' height='50px' class='img-fluid rounded' src="../../img/product_images/<?php echo $all_product['product_image']; ?>" alt="<?php echo $all_product['product_title']; ?>">
                                            <?php echo $all_product['product_title']; ?>
                                        </td>

                                        <td><span class="badge badge-success">
                                                <?php echo $all_product['name_depart_com']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-info"><?php echo $all_product['cat_title']; ?></span>
                                            </small>
                                        </td>
                                        <td><span class="badge badge-danger">
                                                <?php echo $all_product['price']; ?>
                                            </span>
                                            <small>
                                                <span class="badge badge-warning">
                                                    <?php echo $all_product['opponent']; ?>
                                                </span>
                                            </small>
                                        </td>

                                        <td>

                                            <?php echo $all_product['QR_number']; ?>
                                        </td>
                                        <td>

                                            <?php

                                            if ($all_product['status_pro'] > 0) {
                                                if ($all_product['status_pro'] > 1) {
                                            ?>
                                                    <span class="badge badge-danger"> محذوف من إدارة الموقع </span>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="badge badge-success"> مفعل </span>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <span class="badge badge-danger"> محذوف من إدارة المركز </span>
                                            <?php
                                            }

                                            ?>




                                        </td>
                                        <td>
                                            <div class="row">


                                                <div class="col col-sm-6 col-12">
                                                    <a title="عرض بيانات " class="btn btn-info   btn-sm" href="../../A/pages/details-reactive-prod.php?details_prod_id=<?php echo $all_product['product_id'] ?>"><i class="fas fa-eye"></i></a>
                                                    <a title="إعادة" class="btn btn-success btn-sm" href='insert_data_admin.php?back_pro=<?php echo $all_product['product_id'] ?>&id_company=<?php echo $com_id ?>' id="" role="button"><i class="fas fa-1x fa-sync-alt"></i></a>
                                                </div>
                                                <div class="col col-sm-6  col-12">
                                                    <a title="حذف" class="btn btn-danger btn-sm " href='insert_data_admin.php?delete&id=<?php echo $all_product['product_id'] ?>&com_id=<?php echo $all_product['com_id'] ?>' id="" role="button"><i class="far fa-trash-alt"></i></a>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                <?php }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

<?php

    }
}





if (isset($_POST['id_depart_com'])) {

    global $sql_1;

    $id_depart_com = $_POST['id_depart_com'];
    $name_depart_com_new_or_up = $_POST['join_with'];




    $sql = mysqli_query($con, "SELECT DISTINCT  * FROM `department_com` WHERE `id_depart_com`='" . $id_depart_com . "';") or die(mysqli_error($con));

    if (mysqli_num_rows($sql) != 0) {
        $data_department_com_new = mysqli_fetch_array($sql);

        $id_depart_com_new = $data_department_com_new['id_depart_com'];
        $deprat_id_new = $data_department_com_new['deprat_id'];
        $name_depart_com_new = $data_department_com_new['name_depart_com'];
        $about_depart_com_new = $data_department_com_new['about_depart_com'];
        $depart_state_com_new = $data_department_com_new['depart_state_com'];
        $icon_depart_com_new = $data_department_com_new['icon_depart_com'];

        if ($name_depart_com_new_or_up > 0) {
            $sql_1 = mysqli_query($con, "SELECT * FROM `department` WHERE `name_depart`='" . $name_depart_com_new_or_up . "';") or die(mysqli_error($con));
        } else {

            $as = mysqli_query($con, "INSERT INTO `department`(`name_depart`, `about_depart`, `icon_depart`) VALUES ('" . $name_depart_com_new . "','" . $about_depart_com_new . "','" . $icon_depart_com_new . "')") or die(mysqli_error($con));
            $sql_1 = mysqli_query($con, "SELECT * FROM `department` WHERE `name_depart`='" . $name_depart_com_new . "' AND about_depart='" . $about_depart_com_new . "';") or die(mysqli_error($con));
        }
        if (mysqli_num_rows($sql_1) != 0) {
            $data_department_com_new_2 = mysqli_fetch_array($sql_1);

            $deprat_id_new2 = $data_department_com_new_2['deprat_id'];

            $sql_2 = mysqli_query($con, "UPDATE `department_com` SET `deprat_id`='" . $deprat_id_new2 . "' WHERE `id_depart_com` = any (SELECT `id_depart_com` FROM department_com WHERE `name_depart_com`='" . $name_depart_com_new . "');") or die(mysqli_error($con));
            $sql_3 = mysqli_query($con, "UPDATE `categories_com` SET `deprat_id_fk`='" . $deprat_id_new2 . "' WHERE `id_depart_com_fk` = any (SELECT cat_com.id_depart_com_fk FROM department_com dep_com JOIN categories_com cat_com ON dep_com.id_depart_com=cat_com.id_depart_com_fk WHERE dep_com.name_depart_com='" . $name_depart_com_new . "');") or die(mysqli_error($con));
            header("location:mange_department.php");
            return 0;
        } else {
            header("location:mange_department.php");
            return 0;
        }
    } else {
        header("location:mange_department.php");
        return 0;
    }
}






















































//this cod for add  new categories for categories form and add department new with categories  
if (isset($_POST['add_or_merge'])) {


    //take id cat company for search this data
    $id_cat_com = $_POST['id_cat_com'];
    //  name categories for mirg this cat with any one 
    $name_cat_id_new_or_up = $_POST['join_with_1'];


    $sql = mysqli_query($con, "SELECT DISTINCT  * FROM `categories_com` WHERE `id_cat_com`='" . $id_cat_com . "';") or die(mysqli_error($con));

    if (mysqli_num_rows($sql) != 0) {
        $data_categories_com_new = mysqli_fetch_array($sql);

        $cat_id_fk_categories_com_new = $data_categories_com_new['cat_id_fk'];
        $id_depart_com_fk_new = $data_categories_com_new['id_depart_com_fk'];
        $deprat_id_fk_categories_com_new = $data_categories_com_new['deprat_id_fk'];
        $com_id_fk_categories_com_new = $data_categories_com_new['com_id_fk'];
        $name_depart_form_com_new = $data_categories_com_new['name_depart_form'];
        $name_cat_form_categories_com_new = $data_categories_com_new['name_cat_form'];
        $cat_details_com_new = $data_categories_com_new['cat_details_com'];
        $state_cat_com_categories_new = $data_categories_com_new['state_cat_com'];
        $cat_image_com_categories_new = $data_categories_com_new['cat_image_com'];



        $sql_depart_id = mysqli_query($con, "SELECT * FROM `department` WHERE `deprat_id`='" . $deprat_id_fk_categories_com_new . "';") or die(mysqli_error($con));
        if (mysqli_num_rows($sql_depart_id) != 0) {


            if ($name_cat_id_new_or_up > 1) {

                $sql_cat_id = mysqli_query($con, "SELECT DISTINCT * FROM `categories` WHERE `cat_title`='" . $name_cat_id_new_or_up . "' AND `depart_id` ='" . $deprat_id_fk_categories_com_new . "'  ; ") or die(mysqli_error($con));

                if (mysqli_num_rows($sql_cat_id) != 0) {
                    $data_categories_com_new_2 = mysqli_fetch_array($sql_cat_id);

                    $cat_id_new2 = $data_categories_com_new_2['cat_id'];

                    mysqli_query($con, "UPDATE `categories_com` SET `cat_id_fk`='" . $cat_id_new2 . "'  WHERE `name_cat_form`='" . $name_cat_form_categories_com_new . "' AND `deprat_id_fk`='" . $deprat_id_fk_categories_com_new . "' AND `cat_id_fk`='0' ;") or die(mysqli_error($con));
                    header("location:mange_categories.php");
                }
            } else {

                mysqli_query($con, "INSERT INTO `categories`(`cat_title`, `depart_id`,`cat_image`, `cat_details`) VALUES('" . $name_cat_form_categories_com_new . "','" . $deprat_id_fk_categories_com_new . "','" . $cat_image_com_categories_new . "','" . $cat_details_com_new . "');") or die(mysqli_error($con));

                $sql_updata_all_cat_id = mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_title`='" . $name_cat_form_categories_com_new . "' AND `depart_id` ='" . $deprat_id_fk_categories_com_new . "'  ; ") or die(mysqli_error($con));

                if (mysqli_num_rows($sql_updata_all_cat_id) != 0) {
                    $data_categories = mysqli_fetch_array($sql_updata_all_cat_id);

                    $cat_id_new = $data_categories['cat_id'];

                    mysqli_query($con, "UPDATE `categories_com` SET `cat_id_fk`='" . $cat_id_new . "'  WHERE `name_cat_form`='" . $name_cat_form_categories_com_new . "' AND `deprat_id_fk`='" . $deprat_id_fk_categories_com_new . "' AND `cat_id_fk`='0' ;") or die(mysqli_error($con));

                    header("location:mange_categories.php");
                }
            }
        } else {

            $sql_depart_com_id = mysqli_query($con, "SELECT * FROM `department_com` WHERE `id_depart_com`='" . $id_depart_com_fk_new . "' ;") or die(mysqli_error($con));
            if (mysqli_num_rows($sql_depart_com_id) != 0) {
                $data_depart_com_new = mysqli_fetch_array($sql_depart_com_id);

                mysqli_query($con, "INSERT INTO `department`(`name_depart`, `about_depart`, `icon_depart`) VALUES ('" . $data_depart_com_new['name_depart_com'] . "','" . $data_depart_com_new['about_depart_com'] . "','" . $data_depart_com_new['icon_depart_com'] . "');") or die(mysqli_error($con));
                $sql_1 = mysqli_query($con, "SELECT * FROM `department` WHERE `name_depart`='" . $data_depart_com_new['name_depart_com'] . "' AND `about_depart`='" . $data_depart_com_new['about_depart_com'] . "';") or die(mysqli_error($con));
                if (mysqli_num_rows($sql_1) != 0) {
                    $data_department_com_new_2 = mysqli_fetch_array($sql_1);

                    $deprat_id_new2 = $data_department_com_new_2['deprat_id'];
                    $deprat_name_new2 = $data_department_com_new_2['name_depart'];

                    $sql_2 = mysqli_query($con, "UPDATE `department_com` SET `deprat_id`='" . $deprat_id_new2 . "' WHERE `id_depart_com` = any (SELECT `id_depart_com` FROM department_com WHERE `name_depart_com`='" . $deprat_name_new2 . "' AND `deprat_id`='0' );") or die(mysqli_error($con));
                    $sql_3 = mysqli_query($con, "UPDATE `categories_com` SET `deprat_id_fk`='" . $deprat_id_new2 . "' WHERE `id_depart_com_fk` = any (SELECT cat_com.id_depart_com_fk FROM department_com dep_com JOIN categories_com cat_com ON dep_com.id_depart_com=cat_com.id_depart_com_fk WHERE dep_com.name_depart_com='" . $deprat_name_new2 . "' AND `deprat_id_fk`='0' );") or die(mysqli_error($con));
                    header("location:mange_categories.php");
                }
                header("location:mange_categories.php");
            }
            header("location:mange_categories.php");
        }
    }
}
















//this code to add or chang data categories used in page manage_cat
if (isset($_POST['add_categories_or_updata_for_company'])) {
    $id_depart_com_fk = $_POST['id_depart_com_fk'];
    $name_cat_form = $_POST['name_cat_form'];
    $cat_details_com = $_POST['cat_details_com'];
    $id_cat_com = $_POST['id_cat_com'];





    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    if ($id_depart_com_fk > 0) {

        $result_7 = mysqli_query($con, "SELECT * FROM `department_com` WHERE `id_depart_com`='" . $id_depart_com_fk . "'") or die(mysqli_error($con));
        #if the search on table cat true
        if (mysqli_num_rows($result_7) != 0) {
            $r = mysqli_fetch_array($result_7);
            $deprat_id = $r['deprat_id'];
            $com_id = $r['com_id'];
            $name_depart_com = $r['name_depart_com'];
        }
        if ($id_cat_com > 0) {

            if ($picture_name == "" & $picture_type == "") {
                $sql_updata_bunch_form = "UPDATE `categories_com` SET `name_cat_form`='" . $name_cat_form . "',`id_depart_com_fk`='" . $id_depart_com_fk . "',`cat_details_com`='" . $cat_details_com . "' WHERE `id_cat_com`='" . $id_cat_com . "'";
                if (mysqli_query($con, $sql_updata_bunch_form)) {
                    header("location:mange_one_company.php");
                }
            } else {
                if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
                {
                    if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                    {
                        //code take name file and search . and tak after that
                        $type = substr($picture_name, strrpos($picture_name, '.'));
                        $pic_name = $id_cat_com . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                        move_uploaded_file($picture_tmp_name, "../../img/cat_images/" . $pic_name); //upload the image for the folder

                        $sql_updata_bunch_form = "UPDATE `categories_com` SET `name_cat_form`='" . $name_cat_form . "',`id_depart_com_fk`='" . $id_depart_com_fk . "',`cat_image_com`='" . $pic_name . "',`cat_details_com`='" . $cat_details_com . "' WHERE `id_cat_com`='" . $id_cat_com . "'";
                        if (mysqli_query($con, $sql_updata_bunch_form)) {
                            header("location:mange_one_company.php");
                        }
                    } else {

                        header("location:mange_one_company.php");
                    }
                } else {

                    header("location:mange_one_company.php");
                }
            }
        }
        #if no one have that data we insert data 
        else {
            #search about categ if on table debartment
            $result = mysqli_query($con, "SELECT * FROM `categories_com` WHERE `name_cat_form`='" . $name_cat_form . "' AND `id_depart_com_fk`='" . $id_depart_com_fk . "'") or die(mysqli_error($con));
            #if the search on table cat true
            if (mysqli_num_rows($result) != 0) {

                header("location:mange_one_company.php");
                return 0;
            } elseif ($picture_name == "" & $picture_type == "") {

                $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `categories_com`(`id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`, `cat_details_com`)
            VALUES ('" . $id_depart_com_fk . "','" . $deprat_id . "','" . $com_id . "','" . $name_depart_com . "','" . $name_cat_form . "','" . $cat_details_com . "');") or die(mysqli_error($con));
                if ($sql_che_ord_non_imag) {
                    header("location:mange_one_company.php");
                } else {
                    header("location:mange_one_company.php");
                }
            } elseif ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {
                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $id_cat_com . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../../img/cat_images/" . $pic_name); //upload the image for the folder


                    //update data for the order
                    $sql_che_ord = mysqli_query($con, "INSERT INTO `categories_com`(`id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`, `cat_image_com`, `cat_details_com`)
                    VALUES ('" . $id_depart_com_fk . "','" . $deprat_id . "','" . $com_id . "','" . $name_depart_com . "','" . $name_cat_form . "','" . $pic_name . "','" . $cat_details_com . "');") or die(mysqli_error($con));
                    if ($sql_che_ord) {
                        header("location:mange_one_company.php");
                    } else {
                        header("location:mange_one_company.php");
                    }
                } else {

                    header("location:mange_one_company.php");
                }
            } else {
                header("location:mange_one_company.php");
            }
        }
    } else {
        header("location:mange_one_company.php");
        return 0;
    }
}









//this code to add or chang data department used in page mange_one_company
if (isset($_POST['add_department_or_updata_com'])) {
    $id_depart_com = $_POST['id_depart_com_one'];
    $name_depart_com = $_POST['name_depart_com'];
    $about_depart_com = $_POST['about_depart_com'];

    $com_id_depart = $_POST['com_id_depart_com'];


    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    #for see if updata or insert new
    if ($id_depart_com > 0) {

        if ($picture_name == "" & $picture_type == "") {
            $sql_updata_bunch_form = "UPDATE `department_com` SET `name_depart_com`='" . $name_depart_com . "',`about_depart_com`='" . $about_depart_com . "' WHERE `id_depart_com`=" . $id_depart_com . "";
            if (mysqli_query($con, $sql_updata_bunch_form)) {
                header("location:mange_one_company.php?com_id=$com_id_depart");
            }
        } else {
            if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {
                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $id_depart_com . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../../img/imag_depart/" . $pic_name); //upload the image for the folder

                    $sql_updata_bunch_form = "UPDATE `department_com` SET `name_depart_com`='" . $name_depart_com . "',`about_depart_com`='" . $about_depart_com . "',`icon_depart_com`='" . $pic_name . "' WHERE `id_depart_com`=" . $id_depart_com . "";
                    if (mysqli_query($con, $sql_updata_bunch_form)) {
                        header("location:mange_one_company.php?com_id=$com_id_depart");
                    }
                } else {

                    header("location:mange_one_company.php?com_id=$com_id_depart");
                }
            } else {

                header("location:mange_one_company.php?com_id=$com_id_depart");
            }
        }
    }
    #if no one have that data we insert data 
    else {
        $result3 = mysqli_query($con, "SELECT * FROM `department_com` WHERE `name_depart_com`='" . $name_depart_com . "'AND `com_id`='" . $com_id_depart . "' ; ") or die(mysqli_error($con));

        #search about department if on table debartment
        $result = mysqli_query($con, "SELECT DISTINCT  * FROM `department` WHERE `name_depart`LIKE'" . $name_depart_com . "'") or die(mysqli_error($con));
        #if the search on table departmen true
        if (mysqli_num_rows($result) != 0) {
            #take data for verb
            $data_department = mysqli_fetch_array($result);
            #search if the data for this department on company
            $result2 = mysqli_query($con, "SELECT * FROM `department_com` WHERE `deprat_id`='" . $data_department['deprat_id'] . "' And com_id='" . $com_id_depart . "'") or die(mysqli_error($con));
            #if that fules we insert data from the department for combany
            if (mysqli_num_rows($result2) == 0) {
                $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `department_com`(`deprat_id`, `name_depart_com`, `about_depart_com`, `com_id`, `depart_state_com`, `icon_depart_com`) VALUES 
           ('" . $data_department[0] . "','" . $data_department[1] . "','" . $data_department[2] . "','" . $com_id_depart . "','" . $data_department[4] . "','" . $data_department[3] . "');") or die(mysqli_error($con));
                header("location:mange_one_company.php?com_id=$com_id_depart");
                return 0;
            }
            #or if thet already on the table we  comback to bage
            else {
                header("location:mange_one_company.php?com_id=$com_id_depart");
                return 0;
            }
        } elseif (mysqli_num_rows($result3)) {
            header("location:mange_one_company.php?com_id=$com_id_depart");
            return 0;
        }
        #here see if the data for department not have imge insert without imge
        elseif ($picture_name == "" & $picture_type == "") {

            $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `department_com`(`deprat_id`,`name_depart_com`, `about_depart_com`, `com_id`) VALUES (0,'" . $name_depart_com . "','" . $about_depart_com . "','" . $com_id_depart . "');") or die(mysqli_error($con));
            if ($sql_che_ord_non_imag) {
                header("location:mange_one_company.php?com_id=$com_id_depart");
                return 0;
            } else {
                header("location:mange_one_company.php?com_id=$com_id_depart");
                return 0;
            }
        } elseif ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {


            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {
                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $id_depart_com . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../../img/imag_depart/" . $pic_name); //upload the image for the folder


                //update data for the order
                $sql_che_ord = mysqli_query($con, "INSERT INTO `department_com`( `name_depart_com`, `about_depart_com`,`com_id`, `icon_depart_com`) VALUES ('" . $name_depart_com . "','" . $about_depart_com . "','" . $com_id_depart . "','" . $pic_name . "');") or die(mysqli_error($con));
                if ($sql_che_ord) {
                    header("location:mange_one_company.php?com_id=$com_id_depart");
                    return 0;
                } else {
                    header("location:mange_one_company.php?com_id=$com_id_depart");
                    return 0;
                }
            } else {

                header("location:mange_one_company.php?com_id=$com_id_depart");
                return 0;
            }
        } else {
            header("location:mange_one_company.php?com_id=$com_id_depart");
            return 0;
        }
    }
}




if (isset($_GET['add_depart_for_com'])) {
    include 'Myfun.php';
    $id = $_GET['deprat_id'];
    $com_id = $_GET['com_id'];

    if (AddDepartment($id, $com_id)) {

        header("location:mange_one_company.php");
    } else {

        header("location:mange_one_company.php");
    }
}





//this code to show or hid the  categries state to show or hide used in page mange_one_company
if (isset($_POST['state_cat_com2'])) {
    $id_cat_com = $_POST['id_cat_com'];
    $state_cat = $_POST['state_cat'];

    if ($id_cat_com > 0) {

        $sql_updata_depart_com_hide = "UPDATE `categories_com` SET `state_cat_com`=" . $state_cat . " WHERE `id_cat_com`='" . $id_cat_com . "' AND `state_cat_com`!=3 ;";
        if (mysqli_query($con, $sql_updata_depart_com_hide)) {
            header("location:mange_one_company.php");
        }
    }
}


//this code to turn off or turn on  categries state to show or hide used in page mange_one_company
if (isset($_POST['state_cat_com1'])) {
    $id_cat_com = $_POST['id_cat_com'];
    $state_cat = $_POST['state_cat'];

    if ($id_cat_com > 0) {



        $sql_updata_depart_com_stope = "UPDATE `categories_com` SET `state_cat_com`=" . $state_cat . " WHERE `id_cat_com`='" . $id_cat_com . "' ;";
        if (mysqli_query($con, $sql_updata_depart_com_stope)) {
            header("location:mange_one_company.php");
        }
    }
}






//this codeto show or hid the department state show or hide used in page mange_one_company
if (isset($_POST['stop_department_com2'])) {
    $depart_id = $_POST['depart_id'];
    $depart_state = $_POST['depart_state'];

    if ($depart_id > 0) {

        $sql_updata_depart_com_hide = "UPDATE `department_com` SET `depart_state_com`=" . $depart_state . " WHERE `id_depart_com`='" . $depart_id . "' AND `depart_state_com`!=3 ;";
        if (mysqli_query($con, $sql_updata_depart_com_hide)) {
            header("location:mange_one_company.php");
        }

        $sql_updata_cat_com_hide = "UPDATE `categories_com` SET `state_cat_com`=" . $depart_state . " WHERE `id_depart_com_fk`='" . $depart_id . "' AND `state_cat_com`!=3 ;";
        if (mysqli_query($con, $sql_updata_cat_com_hide)) {
            header("location:mange_one_company.php");
        }
    }
}

//this code to turn off or turn on department state stop or turn on used in page mange_one_company
if (isset($_POST['stop_department_com1'])) {
    $depart_id = $_POST['depart_id'];
    $depart_state = $_POST['depart_state'];

    if ($depart_id > 0) {



        $sql_updata_depart_com_stope = "UPDATE `department_com` SET `depart_state_com`=" . $depart_state . " WHERE `id_depart_com`='" . $depart_id . "' ;";
        if (mysqli_query($con, $sql_updata_depart_com_stope)) {
            header("location:mange_one_company.php");
        }

        $sql_updata_cat_com_stope = "UPDATE `categories_com` SET `state_cat_com`=" . $depart_state . " WHERE `id_depart_com_fk`='" . $depart_id . "' ;";
        if (mysqli_query($con, $sql_updata_cat_com_stope)) {
            header("location:mange_one_company.php");
        }
    }
}









//*******************finsh  */
?>