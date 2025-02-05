<?php
//  this page all opertion for insert or updata  data for dont agin insert data when reload the page
include "message.php";
include "../db.php";
session_start();

//insert for add item product for order
if (isset($_POST['btn_add_item'])) {

    $id_pro = $_POST['id_pro'];
    $quantity = $_POST['quantity'];
    $pro_size = $_POST['pro_size'];
    $notice_item = $_POST['notice_item'];
    //code for git price for var to insert for table and if for check the id is realy product or not for run cod or messg 
    $sel_pro_pric = mysqli_query($con, "SELECT price-opponent as fin_price  FROM `product` where `product_id`=$id_pro") or die(mysqli_error($con));
    if (mysqli_num_rows($sel_pro_pric) != 0) {
        $sel_pri = mysqli_fetch_array($sel_pro_pric);
        $price = $sel_pri['fin_price'];
        $total_price = $quantity * $price;
        //insert data for table item_order and sit id for order to add and change this id in realy id for order 
        $ins_item_ord = mysqli_query($con, "INSERT INTO `order_item`(`fk_order`, `fk_pro`, `pro_size_id`, `note`, `quantity_item`,`price_one`, `total_item`, `com_id_item_ord`) VALUES ('1','" . $id_pro . "','" . $pro_size . "','" . $notice_item . "','" . $quantity . "','" . $price . "','" . $total_price . "'," . $_SESSION['comid'] . ")");
        if ($ins_item_ord) {
            Msg_Sucess();
            header("location:add_order.php");
        } else {
            Msg_info1();
            header("location:add_order.php");
        }
    } else {
        Msg_info1();
        header("location:add_order.php");
    }
}






//insert data order

if (isset($_POST['btn_save_order'])) {
    //$id_coustomer = 2;

    $name_coustomer = $_POST['name_coustomer'];
    $phone_number = $_POST['phone_number'];

    $type_order = $_POST['type_order'];
    $address_order = $_POST['address_order'];

    $notice_order = $_POST['notice_order'];

    $location = $_POST['location'];
    $date_receipt = $_POST['date_receipt'];
    $pers_gift = $_POST['pers_gift'];

    $delivery = $_POST['delivery'];
    $shipping_type = $_POST['shipping_type'];
    $cost_ship = $_POST['cost_ship'];
    //insert data order
    $ins_ord_da = mysqli_query($con, "INSERT INTO `order`(`cu_name`, `cus_phone`, `type_order`, `address_order`, `order_location`, `order_dale_receipt`, `pers_gift`,  `order_note`,`com_id_ord`) VALUES
       ('" . $name_coustomer . "','" . $phone_number . "','" . $type_order . "','" . $address_order . "','" . $location . "','" . $date_receipt . "','" . $pers_gift . "','" . $notice_order . "'," . $_SESSION['comid'] . ")");
    if ($ins_ord_da) {
        //if true git data from table and take id for new order and updata data fk_ordere product item for id_order realay 
        $sel_git_id_order = mysqli_query($con, "SELECT MAX(`id_order`) max_id_ord FROM `order` WHERE  `cu_name`='" . $name_coustomer . "' AND `cus_phone`='" . $phone_number . "' AND `type_order`='" . $type_order . "' AND `address_order`='" . $address_order . "' AND `com_id_ord`=" . $_SESSION['comid'] . "  ;") or die(mysqli_error($con));
        if (mysqli_num_rows($sel_git_id_order) != 0) {
            //git array
            $sel_ord_id = mysqli_fetch_array($sel_git_id_order);
            //take data
            $id_oredr = $sel_ord_id['max_id_ord'];
            //updata data
            $sql_upfk_it = "UPDATE `order_item` SET `fk_order`='" . $id_oredr . "' WHERE `fk_order`=1    AND `com_id_item_ord`= " . $_SESSION['comid'] . " ;";
            //run cod updata
            mysqli_query($con, $sql_upfk_it);


            $ins_data_ship = mysqli_query($con, "INSERT INTO `shipping`(`fk_order`, `fk_delivery`, `type_ship`, `cost_ship`, `address_ship`, `ship_location`, `ship_date_receipt`) VALUES 
            ('" . $id_oredr . "','" . $delivery . "','" . $shipping_type . "','" . $cost_ship . "','" . $address_order . "','" . $location . "','" . $date_receipt . "')") or die(mysqli_error($con));
        }
        Msg_Sucess();
        header("location:manage_order.php");
    } else {
        Msg_info1();
        header("location:manage_order.php");
    }
}

//delet all item order that dont insert for any order
if (isset($_GET['del_all_item'])) {
    $del_item_ord = mysqli_query($con, "DELETE FROM `order_item` WHERE `fk_order`=1;");
    if ($del_item_ord) {
        Msg_Sucess();
        header("location:add_order.php");
    } else {
        Msg_info1();
        header("location:add_order.php");
    }
}
//delet one item from order 
if (isset($_GET['del_item'])) {
    $id_item = $_GET['id_item'];
    $sql_del_item = "DELETE FROM `order_item` WHERE `id_item_order`='" . $id_item . "'";
    if (mysqli_query($con, $sql_del_item) or die(mysqli_error($con))) {
        Msg_Sucess();
        header("location:add_order.php");
    } else {
        Msg_info1();
        header("location:add_order.php");
    }
}









//insert check money
if (isset($_POST['id_order_check'])) {
    $id_order_check = $_POST['id_order_check'];


    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    if ($picture_name == "" & $picture_type == "") {

        $sql_che_ord_non_imag = mysqli_query($con, "UPDATE `order` SET `chack_money`=1,`mony_image`='0' WHERE `id_order`=" . $id_order_check) or die(mysqli_error($con));
        if ($sql_che_ord_non_imag) {
            Msg_Sucess();
            header("location:chack_money.php");
        } else {
            Msg_info1();
            header("location:chack_money.php");
        }
    } else {

        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {
            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {
                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $id_order_check . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../../img/chack_money/" . $pic_name); //upload the image for the folder


                //update data for the order
                $sql_che_ord = mysqli_query($con, "UPDATE `order` SET `chack_money`=1,`mony_image`='" . $pic_name . "' WHERE `id_order`=" . $id_order_check) or die(mysqli_error($con));
                if ($sql_che_ord) {
                    Msg_Sucess();
                    header("location:chack_money.php");
                } else {
                    Msg_info1();
                    header("location:chack_money.php");
                }
            } else {

                //Msg_Warning_size_icon_user();
                header("location:chack_money.php");
            }
        } else {
            Msg_Warning_icon_user();
            header("location:chack_money.php");
        }
    }
}









//insert check procsess
if (isset($_POST['id_order_check_procsess'])) {
    $id_order_check_procsess = $_POST['id_order_check_procsess'];


    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    if ($picture_name == "" & $picture_type == "") {

        $sql_che_ord_non_imag = mysqli_query($con, "UPDATE `order` SET `processor_order`=1,`process_image`='0' WHERE `id_order`=" . $id_order_check_procsess) or die(mysqli_error($con));
        if ($sql_che_ord_non_imag) {
            Msg_Sucess();
            header("location:manage_order.php");
        } else {
            Msg_info1();
            header("location:manage_order.php");
        }
    } else {

        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {
            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {
                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $id_order_check_procsess . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../../img/chack_process/" . $pic_name); //upload the image for the folder


                //update data for the order
                $sql_che_ord = mysqli_query($con, "UPDATE `order` SET `processor_order`=1,`process_image`='" . $pic_name . "' WHERE `id_order`=" . $id_order_check_procsess) or die(mysqli_error($con));
                if ($sql_che_ord) {
                  //  Msg_Sucess();
                    header("location:chack_procsseor.php");
                } else {
                  //  Msg_info1();
                    header("location:chack_procsseor.php");
                }
            } else {

               // Msg_Warning_size_icon_user();
                header("location:chack_procsseor.php");
            }
        } else {
           // Msg_Warning_icon_user();
            header("location:chack_procsseor.php");
        }
    }
}














//insert check delivery
if (isset($_POST['id_order_check_deliyery'])) {
    $id_order_check_delivery = $_POST['id_order_check_deliyery'];


    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    if ($picture_name == "" & $picture_type == "") {

        $sql_che_ord_non_imag = mysqli_query($con, "UPDATE `order` SET `delivery_order`=1,`delivery_image`='0',`status_order`=2 WHERE `id_order`=" . $id_order_check_delivery) or die(mysqli_error($con));
        if ($sql_che_ord_non_imag) {
            Msg_Sucess();
            header("location:chack_delivery.php");
        } else {
            Msg_info1();
            header("location:chack_delivery.php");
        }
    } else {

        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {
            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {
                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $id_order_check_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../../img/chack_delivery/" . $pic_name); //upload the image for the folder


                //update data for the order
                $sql_che_ord = mysqli_query($con, "UPDATE `order` SET `delivery_order`=1,`delivery_image`='" . $pic_name . "' ,`status_order`=2  WHERE `id_order`=" . $id_order_check_delivery) or die(mysqli_error($con));
                if ($sql_che_ord) {
              //      Msg_Sucess();
                    header("location:chack_delivery.php");
                } else {
              //      Msg_info1();
                    header("location:chack_delivery.php");
                }
            } else {

             //   Msg_Warning_size_icon_user();
                header("location:chack_delivery.php");
            }
        } else {
            //Msg_Warning_icon_user();
            header("location:chack_delivery.php");
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




//button add data staff 
if (isset($_POST['btn_add_staff'])) {


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

    if ($picture_name == "" & $picture_type == "") {



        $query = mysqli_query($con, "INSERT INTO `user`(`user_name`, `Email`, `password`, `country`, `city`, `phone_number`,  `user_type`, `com_id`, `fk_permissions`) VALUES
                 ('" . $user_name_edit . "','" . $Email_edit . "','" . $password_edit . "','" . $country_edit . "','" . $city_edit . "','" . $phone_number_edit . "','1','" . $_SESSION['comid'] . "','" . $permissions_edit . "' )") or die(mysqli_error($con));

        if ($query) {
            Msg_Sucess2();
            header("location:user_data_chang.php");
        } else {
            Msg_Error2();
            header("location:user_data_chang.php");
        }
    } else {


        //picture coding for git data about the pictuer
        $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
        $picture_type = $_FILES['picture']['type']; //نوع الصورة
        $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
        $picture_size = $_FILES['picture']['size']; //حجم الصورة


        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {
            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {

                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $user_name_edit . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../../img/user/" . $pic_name); //upload the image for the folder

                //update data for the user
                $query = mysqli_query($con, "INSERT INTO `user`(`user_name`, `Email`, `password`, `country`, `city`, `phone_number`, `icon`, `user_type`, `com_id`, `fk_permissions`) VALUES
                 ('" . $user_name_edit . "','" . $Email_edit . "','" . $password_edit . "','" . $country_edit . "','" . $city_edit . "','" . $phone_number_edit . "','" . $pic_name . "','2','" . $_SESSION['comid'] . "','" . $permissions_edit . "' )") or die(mysqli_error($con));


                if ($query) {

                    Msg_Sucess2();
                    header("location:user_data_chang.php");
                } else {
                    Msg_Error2();
                    header("location:user_data_chang.php");
                }
            } else {

                Msg_Warning_size_icon_user();
                header("location:user_data_chang.php");
            }
        } else {
            Msg_Warning_icon_user();
            header("location:user_data_chang.php");
        }
    }
}
















//chang data company 
if (isset($_POST['btn_save_data_profile'])) //عند الضغط على زر حفظ يتم حفظ القيم في متغيرات
{
    $com_name = $_POST['com_name'];
    $com_phone = $_POST['com_phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $com_email = $_POST['com_email'];
    $com_location = $_POST['location'];



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

    if ($picture_name == "" & $picture_type == "") {



        $update = mysqli_query($con, "UPDATE `company` SET `com_name`='$com_name',`com_phone`='$com_phone',`city`='$city',`address`='$address',`com_email`='$com_email',
            `location`='" . $com_location . "',`date_modifide`=current_timestamp(),`whatsapp`='" . $com_whatsapp . "',`telegram`='" . $com_telegram . "',`website_company`='" . $com_website_company . "',`instagram`='" . $com_instagram . "',
            `facebook`='" . $com_facebook . "',`twitter`='" . $com_twitter . "',`linkedin`='" . $com_linkedin . "',`about_company`='" . $com_about_company . "',`messg_comm`='" . $com_messg_comm . "' 	 WHERE com_id=" . $_SESSION['comid'] . "") or die(mysqli_error($con));

        if ($update) {

            header("location:myaccount.php");
        } else {
            header("location:myaccount.php");
        }
    } else {

        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {
            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {

                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $_SESSION['comid'] . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../../img/imag_comb/" . $pic_name); //upload the image for the folder

                //update data for the user
                $update = mysqli_query($con, "UPDATE `company` SET `com_name`='$com_name',`com_phone`='$com_phone',`city`='$city',`address`='$address',`com_email`='$com_email',`icon`='" . $pic_name . "',
                    `location`='" . $com_location . "',`date_modifide`=current_timestamp(),`whatsapp`='" . $com_whatsapp . "',`telegram`='" . $com_telegram . "',`website_company`='" . $com_website_company . "',`instagram`='" . $com_instagram . "',
                    `facebook`='" . $com_facebook . "',`twitter`='" . $com_twitter . "',`linkedin`='" . $com_linkedin . "',`about_company`='" . $com_about_company . "',`messg_comm`='" . $com_messg_comm . "'	 WHERE com_id=" . $_SESSION['comid'] . "") or die(mysqli_error($con));


                if ($update) {
                    header("location:myaccount.php");
                } else {
                    header("location:myaccount.php");
                }
            } else {

                header("location:myaccount.php");
            }
        } else {
            header("location:myaccount.php");
        }
    }
}





if (isset($_POST['updata_subscriptions'])) {

    $bunch_form_id = $_POST['bunch_form_id'];
    $com_id = $_POST['com_id'];

    $bunch_name_com = $_POST['bunch_name_com'];

    $pro_count_com = $_POST['pro_count_com'];
    $bunch_com_price = $_POST['bunch_com_price'];
    $bunch_com_about = $_POST['bunch_com_about'];

    $sqldelete = "INSERT INTO `bunch_com`( `com_id`, `date_subs`, `bunch_name_com`, `pro_count_com`, `bunch_com_price`, `bunch_com_about`) VALUES
     (" . $com_id . ",current_timestamp(),'" . $bunch_name_com . "','" . $pro_count_com . "','" . $bunch_com_price . "','" . $bunch_com_about . "')";
    if (mysqli_query($con, $sqldelete)) {

        header("location:subscriptions.php");
    }
}






if (isset($_GET['add_Delivery_comapny_for_com'])) {
    include 'Myfun.php';
    $id = $_GET['Delivery_company_form_id'];


    if (AddDelivery_comapny($id, $_SESSION['comid'])) {

        header("location:delivery_com.php");
    } else {

        header("location:delivery_com.php");
    }
}












//this code to add or chang data delivery used in page delivery_com
if (isset($_POST['add_delivery_or_updata_com'])) {


    $id_delivery = $_POST['id_delivery'];
    $delivery_name = $_POST['delivery_name'];
    $delivery_phone = $_POST['delivery_phone'];
    $delivery_address = $_POST['delivery_address'];
    $delivery_email = $_POST['delivery_email'];
    $delivery_type = $_POST['delivery_type'];
    $delivery_details = $_POST['delivery_details'];
    $com_id_delivery = $_POST['com_id_delivery'];


    //picture coding for git data about the pictuer
    $picture_name = $_FILES['picture']['name']; //اضافة صورة للمنتج هنا يتم حفظ الاسم
    $picture_type = $_FILES['picture']['type']; //نوع الصورة
    $picture_tmp_name = $_FILES['picture']['tmp_name']; //ملف مؤقت خاص بالصورة
    $picture_size = $_FILES['picture']['size']; //حجم الصورة

    #for see if updata or insert new
    if ($id_delivery > 0) {

        if ($picture_name == "" & $picture_type == "") {
            $sql_updata_bunch_form = "UPDATE `delivery_com` SET `delivery_name`='" . $delivery_name . "',`delivery_phone`='" . $delivery_phone . "',`delivery_address`='" . $delivery_address . "',`delivery_email`='" . $delivery_email . "',`delivery_type`='" . $delivery_type . "',`delivery_details`='" . $delivery_details . "' WHERE `id_delivery`='" . $id_delivery . "'";
            if (mysqli_query($con, $sql_updata_bunch_form)) {
                header("location:delivery_com.php");
            }
        } else {
            if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
            {
                if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                {
                    //code take name file and search . and tak after that
                    $type = substr($picture_name, strrpos($picture_name, '.'));
                    $pic_name = $id_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                    move_uploaded_file($picture_tmp_name, "../../img/delivery_com/" . $pic_name); //upload the image for the folder

                    $sql_updata_bunch_form = "UPDATE `delivery_com` SET `delivery_name`='" . $delivery_name . "',`delivery_phone`='" . $delivery_phone . "',`delivery_address`='" . $delivery_address . "',`delivery_email`='" . $delivery_email . "',`delivery_type`='" . $delivery_type . "',`delivery_details`='" . $delivery_details . "',`delivery_icon`='" . $pic_name . "' WHERE `id_delivery`='" . $id_delivery . "'";
                    if (mysqli_query($con, $sql_updata_bunch_form)) {
                        header("location:delivery_com.php");
                    }
                } else {

                    header("location:delivery_com.php");
                }
            } else {

                header("location:delivery_com.php");
            }
        }
    }
    #if no one have that data we insert data 
    else {
        $result3 = mysqli_query($con, "SELECT * FROM `delivery_com` WHERE `delivery_name`='" . $delivery_name . "'AND `delivery_fk_com`='" . $com_id_delivery . "' ; ") or die(mysqli_error($con));

        #search about delivery if on table debartment
        $result = mysqli_query($con, "SELECT DISTINCT  * FROM `delivery_form` WHERE `delivery_name_form`LIKE'" . $delivery_name . "' AND `delivery_statue_form`<=2") or die(mysqli_error($con));
        #if the search on table departmen true
        if (mysqli_num_rows($result) != 0) {
            #take data for verb
            $data_delivery = mysqli_fetch_array($result);
            #search if the data for this delivery on company
            $result2 = mysqli_query($con, "SELECT * FROM `delivery_com` WHERE `id_delivery`='" . $data_delivery['id_delivery_form'] . "' And fk_id_delivery_form='" . $com_id_delivery . "'") or die(mysqli_error($con));
            #if that fules we insert data from the delivery for combany
            if (mysqli_num_rows($result2) == 0) {


                        //code take name file and search . and tak after that
                        $type = substr($picture_name, strrpos($picture_name, '.'));
                        $pic_name = $id_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                        move_uploaded_file($picture_tmp_name, "../../img/delivery_com/" . $pic_name); //upload the image for the folder

                        $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `delivery_com`( `delivery_name`, `delivery_phone`, `delivery_address`, `delivery_email`, `delivery_icon`,
                         `delivery_fk_com`, `delivery_type`, `delivery_details`, `fk_id_delivery_form`)
                         VALUES 
                        ('" . $data_delivery[`delivery_name_form`] . "','" . $data_delivery[`delivery_phone_form`] . "','" . $data_delivery[`delivery_address_form`] . "','" . $data_delivery[`delivery_email_form`] . "','" . $data_delivery[`delivery_icon_form`] . "','" . $com_id_delivery . "','" . $data_delivery[`delivery_type_form`] . "','" . $data_delivery[`delivery_details_form`] . "','" .$data_delivery[`id_delivery_form`] . "');") or die(mysqli_error($con));
                        header("location:delivery_com.php");
                        return 0;
                    

            }
            #or if thet already on the table we  comback to bage
            else {
                header("location:delivery_com.php");
                return 0;
            }
        } elseif (mysqli_num_rows($result3)) {
            header("location:delivery_com.php");
            return 0;
        }
        #here see if the data for delivery not have imge insert without imge
        elseif ($picture_name == "" & $picture_type == "") {





            $id_delivery = $_POST['id_delivery'];
            $delivery_name = $_POST['delivery_name'];
            $delivery_phone = $_POST['delivery_phone'];
            $delivery_address = $_POST['delivery_address'];
            $delivery_email = $_POST['delivery_email'];
            $delivery_type = $_POST['delivery_type'];
            $delivery_details = $_POST['delivery_details'];
            $com_id_delivery = $_POST['com_id_delivery'];



            $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `delivery_com`( `delivery_name`, `delivery_phone`, `delivery_address`, `delivery_email`, `delivery_fk_com`, `delivery_type`, `delivery_details`)VALUES ('" . $delivery_name . "','" . $delivery_phone . "','" . $delivery_address . "','" . $delivery_email . "','" . $com_id_delivery . "','" . $delivery_type . "','" . $delivery_details . "');") or die(mysqli_error($con));
            if ($sql_che_ord_non_imag) {
                header("location:delivery_com.php");
                return 0;
            } else {
                header("location:delivery_com.php");
                return 0;
            }
        } elseif ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
        {


            if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
            {
                //code take name file and search . and tak after that
                $type = substr($picture_name, strrpos($picture_name, '.'));
                $pic_name = $id_delivery . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                move_uploaded_file($picture_tmp_name, "../../img/delivery_com/" . $pic_name); //upload the image for the folder


                //update data for the order
                $sql_che_ord = mysqli_query($con, " INSERT INTO `delivery_com`( `delivery_name`, `delivery_phone`, `delivery_address`, `delivery_email`, `delivery_icon`, `delivery_fk_com`, `delivery_type`, `delivery_details`)VALUES ('" . $delivery_name . "','" . $delivery_phone . "','" . $delivery_address . "','" . $delivery_email . "','" . $pic_name . "','" . $com_id_delivery . "','" . $delivery_type . "','" . $delivery_details . "');") or die(mysqli_error($con));
                if ($sql_che_ord) {
                    header("location:delivery_com.php");
                    return 0;
                } else {
                    header("location:delivery_com.php");
                    return 0;
                }
            } else {

                header("location:delivery_com.php");
                return 0;
            }
        } else {
            header("location:delivery_com.php");
            return 0;
        }
    }
}









//this code to add or chang  delivery state stop or turn on used in page delivery_com
if (isset($_POST['stop_delivery_com1'])) {
    $delivery_id = $_POST['delivery_id'];
    $delivery_state = $_POST['delivery_state'];

    if ($delivery_id > 0) {



        $sql_updata_depart_com_stope = "UPDATE `delivery_com` SET `delivery_statue`=" . $delivery_state . " WHERE `id_delivery`=" . $delivery_id . " AND (`delivery_statue`!=2 AND `delivery_statue`!=3)";
        if (mysqli_query($con, $sql_updata_depart_com_stope)) {
            header("location:delivery_com.php");
        }
    }
}


//this code to add or chang  delivery state show or hide used in page delivery_com
if (isset($_POST['stop_delivery_com2'])) {
    $delivery_id = $_POST['delivery_id'];
    $delivery_state = $_POST['delivery_state'];

    if ($delivery_id > 0) {

        $sql_updata_depart_com_hide = "UPDATE `delivery_com` SET `delivery_statue`=" . $delivery_state . " WHERE `id_delivery`=" . $delivery_id . " AND (`delivery_statue`=1 or   `delivery_statue`= 4)";
        if (mysqli_query($con, $sql_updata_depart_com_hide)) {
            header("location:delivery_com.php");
        }
    }
}











if (isset($_GET['add_depart_for_com'])) {
    include 'Myfun.php';
    $id = $_GET['deprat_id'];


    if (AddDepartment($id, $_SESSION['comid'])) {

        header("location:all_department.php");
    } else {

        header("location:all_department.php");
    }
}








//this code to add or chang data department used in page all_department
if (isset($_POST['add_department_or_updata_com'])) {
    $id_depart_com = $_POST['id_depart_com'];
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
                header("location:all_department.php");
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
                        header("location:all_department.php");
                    }
                } else {

                    header("location:all_department.php");
                }
            } else {

                header("location:all_department.php");
            }
        }
    }
    #if no one have that data we insert data 
    else {
        $result3 = mysqli_query($con, "SELECT * FROM `department_com` WHERE `name_depart_com`='" . $name_depart_com . "'AND `com_id`='" . $com_id_depart . "' ; ") or die(mysqli_error($con));

        #search about department if on table debartment
        $result = mysqli_query($con, "SELECT DISTINCT  * FROM `department` WHERE `name_depart`LIKE'" . $name_depart_com . "' AND `depart_state`<=2") or die(mysqli_error($con));
        #if the search on table departmen true
        if (mysqli_num_rows($result) != 0) {
            #take data for verb
            $data_department = mysqli_fetch_array($result);
            #search if the data for this department on company
            $result2 = mysqli_query($con, "SELECT * FROM `department_com` WHERE `deprat_id`='" . $data_department['deprat_id'] . "' And com_id='" . $com_id_depart . "'") or die(mysqli_error($con));
            #if that fules we insert data from the department for combany
            if (mysqli_num_rows($result2) == 0) {
                if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
                {
                    if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                    {
                        //code take name file and search . and tak after that
                        $type = substr($picture_name, strrpos($picture_name, '.'));
                        $pic_name = $id_depart_com . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                        move_uploaded_file($picture_tmp_name, "../../img/imag_depart/" . $pic_name); //upload the image for the folder

                        $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `department_com`(`deprat_id`, `name_depart_com`, `about_depart_com`, `com_id`, `depart_state_com`, `icon_depart_com`) VALUES 
                        ('" . $data_department[0] . "','" . $data_department[1] . "','" . $about_depart_com . "','" . $com_id_depart . "','" . $data_department[4] . "','" . $pic_name . "');") or die(mysqli_error($con));
                        header("location:all_department.php");
                        return 0;
                    }
                } else {

                    $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `department_com`(`deprat_id`, `name_depart_com`, `about_depart_com`, `com_id`, `depart_state_com`, `icon_depart_com`) VALUES 
           ('" . $data_department[0] . "','" . $data_department[1] . "','" . $about_depart_com . "','" . $com_id_depart . "','" . $data_department[4] . "','" . $data_department[3] . "');") or die(mysqli_error($con));
                    header("location:all_department.php");
                    return 0;
                }
            }
            #or if thet already on the table we  comback to bage
            else {
                header("location:all_department.php");
                return 0;
            }
        } elseif (mysqli_num_rows($result3)) {
            header("location:all_department.php");
            return 0;
        }
        #here see if the data for department not have imge insert without imge
        elseif ($picture_name == "" & $picture_type == "") {

            $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `department_com`(`deprat_id`,`name_depart_com`, `about_depart_com`, `com_id`) VALUES (0,'" . $name_depart_com . "','" . $about_depart_com . "','" . $com_id_depart . "');") or die(mysqli_error($con));
            if ($sql_che_ord_non_imag) {
                header("location:all_department.php");
                return 0;
            } else {
                header("location:all_department.php");
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
                    header("location:all_department.php");
                    return 0;
                } else {
                    header("location:all_department.php");
                    return 0;
                }
            } else {

                header("location:all_department.php");
                return 0;
            }
        } else {
            header("location:all_department.php");
            return 0;
        }
    }
}









//this code to add or chang  department state stop or turn on used in page mange_department
if (isset($_POST['stop_department_com1'])) {
    $depart_id = $_POST['depart_id'];
    $depart_state = $_POST['depart_state'];

    if ($depart_id > 0) {



        $sql_updata_depart_com_stope = "UPDATE `department_com` SET `depart_state_com`=" . $depart_state . " WHERE `id_depart_com`=" . $depart_id . " AND (`depart_state_com`!=2 AND `depart_state_com`!=3)";
        if (mysqli_query($con, $sql_updata_depart_com_stope)) {
            header("location:all_department.php");
        }
    }
}


//this code to add or chang  department state show or hide used in page mange_department
if (isset($_POST['stop_department_com2'])) {
    $depart_id = $_POST['depart_id'];
    $depart_state = $_POST['depart_state'];

    if ($depart_id > 0) {

        $sql_updata_depart_com_hide = "UPDATE `department_com` SET `depart_state_com`=" . $depart_state . " WHERE `id_depart_com`=" . $depart_id . " AND (`depart_state_com`=1 or   `depart_state_com`= 4)";
        if (mysqli_query($con, $sql_updata_depart_com_hide)) {
            header("location:all_department.php");
        }
    }
}




















//this code to add or chang  department state stop or turn on used in page manage_cat
if (isset($_POST['state_cat_com1'])) {
    $id_cat_com = $_POST['id_cat_com'];
    $state_cat = $_POST['state_cat'];

    if ($id_cat_com > 0) {



        $sql_updata_depart_com_stope = "UPDATE `categories_com` SET `state_cat_com`=" . $state_cat . " WHERE `id_cat_com`=" . $id_cat_com . " AND (`state_cat_com`!=2 AND `state_cat_com`!=3)";
        if (mysqli_query($con, $sql_updata_depart_com_stope)) {
            header("location:manage_cat.php");
        }
    }
}


//this code to add or chang  department state show or hide used in page manage_cat
if (isset($_POST['state_cat_com2'])) {
    $id_cat_com = $_POST['id_cat_com'];
    $state_cat = $_POST['state_cat'];

    if ($id_cat_com > 0) {

        $sql_updata_depart_com_hide = "UPDATE `categories_com` SET `state_cat_com`=" . $state_cat . " WHERE `id_cat_com`=" . $id_cat_com . " AND (`state_cat_com`=1 or   `state_cat_com`= 4)";
        if (mysqli_query($con, $sql_updata_depart_com_hide)) {
            header("location:manage_cat.php");
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
                    header("location:manage_cat.php");
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
                            header("location:manage_cat.php");
                        }
                    } else {

                        header("location:manage_cat.php");
                    }
                } else {

                    header("location:manage_cat.php");
                }
            }
        }
        #if no one have that data we insert data 
        else {
            #search about categ if on table debartment
            $result_6 = mysqli_query($con, "SELECT * FROM `categories_com` WHERE `name_cat_form`='" . $name_cat_form . "' AND `id_depart_com_fk`='" . $id_depart_com_fk . "'") or die(mysqli_error($con));
            #if the search on table cat true

            $result_7 = mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_title`='" . $name_cat_form . "' AND `depart_id`='" . $deprat_id . "' AND `state_cat`<=2 ") or die(mysqli_error($con));

            if (mysqli_num_rows($result_7) != 0) {

                $data_cat = mysqli_fetch_array($result_7);

                $result_9 = mysqli_query($con, "SELECT * FROM `categories_com` WHERE `name_cat_form`='" . $data_cat['cat_title'] . "' AND `deprat_id_fk`='" . $data_cat['depart_id'] . "' AND com_id_fk='" . $com_id . "' ") or die(mysqli_error($con));

                if (mysqli_num_rows($result_9) == 0) {

                    if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
                    {
                        if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                        {
                            //code take name file and search . and tak after that
                            $type = substr($picture_name, strrpos($picture_name, '.'));
                            $pic_name = $id_cat_com . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                            move_uploaded_file($picture_tmp_name, "../../img/cat_images/" . $pic_name); //upload the image for the folder


                            //update data for the order
                            $sql_che_ord = mysqli_query($con, "INSERT INTO `categories_com`(`cat_id_fk`,`id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`, `cat_image_com`, `cat_details_com`)
                            VALUES ('" . $data_cat['cat_id'] . "','" . $id_depart_com_fk . "','" . $deprat_id . "','" . $com_id . "','" . $name_depart_com . "','" . $name_cat_form . "','" . $pic_name . "','" . $cat_details_com . "');") or die(mysqli_error($con));
                            if ($sql_che_ord) {
                                header("location:manage_cat.php");
                            } else {
                                header("location:manage_cat.php");
                            }
                        } else {

                            header("location:manage_cat.php");
                        }
                    } else {
                        $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `categories_com`(`cat_id_fk`,`id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`,`cat_image_com`, `cat_details_com`)
                        VALUES ('" . $data_cat['cat_id'] . "','" . $id_depart_com_fk . "','" . $deprat_id . "','" . $com_id . "','" . $name_depart_com . "','" . $name_cat_form . "','" . $data_cat['cat_image'] . "','" . $cat_details_com . "');") or die(mysqli_error($con));
                        if ($sql_che_ord_non_imag) {
                            header("location:manage_cat.php");
                        } else {
                            header("location:manage_cat.php");
                        }
                    }
                } else {
                    header("location:manage_cat.php");
                    return 0;
                }
            } elseif (mysqli_num_rows($result_6) != 0) {

                header("location:manage_cat.php");
                return 0;
            } elseif ($picture_name == "" & $picture_type == "") {

                $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `categories_com`(`id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`, `cat_details_com`)
            VALUES ('" . $id_depart_com_fk . "','" . $deprat_id . "','" . $com_id . "','" . $name_depart_com . "','" . $name_cat_form . "','" . $cat_details_com . "');") or die(mysqli_error($con));
                if ($sql_che_ord_non_imag) {
                    header("location:manage_cat.php");
                } else {
                    header("location:manage_cat.php");
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
                        header("location:manage_cat.php");
                    } else {
                        header("location:manage_cat.php");
                    }
                } else {

                    header("location:manage_cat.php");
                }
            } else {
                header("location:manage_cat.php");
            }
        }
    } else {
        header("location:manage_cat.php");
        return 0;
    }
}












//this code to add or chang data categories used in page addproduct
if (isset($_POST['insert_product_or_updata'])) {
    include "../db.php";
    //  $product_id = $_POST['product_id'];
    $targetDir = "../../img/product_images/";
    $allowedTypes = array("jpg", "jpeg", "png", "gif");


    $com_id = $_POST['com_id'];

    $productName = $_POST['proname'];

    $price_product = $_POST['price_product'];


    $pro_depart = $_POST['pro_depart'];
    $opponent = $_POST['opponent'];
    $pro_cat = $_POST['pro_cat'];
    $selectedItems = $_POST['items'];
    $pro_desc = $_POST['pro_desc'];
    $form_size = $_POST['form_size'];


    $notice = $_POST['notice'];

    $pro_barcode = $_POST['pro_barcode'];


    $images = $_FILES["images"];

    // Insert product data into the database
    $sql = "INSERT INTO `product`(`com_id`, `id_depart_com`, `product_title`, `product_cat`, `QR_number`, `price`, `opponent`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssss", $com_id, $pro_depart, $productName, $pro_cat, $pro_barcode, $price_product, $opponent);
    
    if ($stmt->execute()) {
        $product_id = $con->insert_id;
    
        if (!empty($_FILES["images"]["name"])) {
            $totalFiles = count($_FILES["images"]["name"]);
    
            if ($totalFiles > 4) {
                echo "يرجاء تحديد اربع صور فقط";
                exit;
            }
    
            $allowedTypes = array('jpg', 'jpeg', 'png');
            $targetDir = "../../img/product_images/";
    
            for ($i = 0; $i < $totalFiles; $i++) {
                $fileName = basename($_FILES["images"]["name"][$i]);
                $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    
                if (!in_array($fileType, $allowedTypes)) {
                    echo "فقط هاذي الانواع من الصور المسومح بهاء JPG, JPEG, PNG.";
                    exit;
                }
    
                if ($_FILES["images"]["size"][$i] > 5 * 1024 * 1024) {
                    echo "يرجاء تحديد حجم الصور اقل من MB5";
                    exit;
                }
    
                // Generate a unique filename
                $uniqueId = uniqid('', true);
                $pic_name = $com_id . "_" . $product_id . "_" . $uniqueId . "." . $fileType;
    
                $targetFilePath = $targetDir . $pic_name;
    
                if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetFilePath)) {
                    $sql = "INSERT INTO product_images (product_id, image_path) VALUES (?, ?)";
                    $stmt = $con->prepare($sql);
                    $stmt->bind_param("is", $product_id, $pic_name);
    
                    if (!$stmt->execute()) {
                        echo "Error uploading image " . ($i + 1) . ": " . $con->error;
                    }
                } else {
                    echo "Error uploading image " . ($i + 1);
                }
            }
        } else {
            header("location:manage_products.php");
        }
    
        // Rest of your code for other insertions
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
        header("location:manage_products.php");
    }
    
  

    $con->close();



    /*


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
                    header("location:manage_cat.php");
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
                            header("location:manage_cat.php");
                        }
                    } else {

                        header("location:manage_cat.php");
                    }
                } else {

                    header("location:manage_cat.php");
                }
            }
        }
        #if no one have that data we insert data 
        else {
            #search about categ if on table debartment
            $result_6 = mysqli_query($con, "SELECT * FROM `categories_com` WHERE `name_cat_form`='" . $name_cat_form . "' AND `id_depart_com_fk`='" . $id_depart_com_fk . "'") or die(mysqli_error($con));
            #if the search on table cat true

            $result_7 = mysqli_query($con, "SELECT * FROM `categories` WHERE `cat_title`='" . $name_cat_form . "' AND `depart_id`='" . $deprat_id . "' AND `state_cat`<=2 ") or die(mysqli_error($con));

            if (mysqli_num_rows($result_7) != 0) {

                $data_cat = mysqli_fetch_array($result_7);

                $result_9 = mysqli_query($con, "SELECT * FROM `categories_com` WHERE `name_cat_form`='" . $data_cat['cat_title'] . "' AND `deprat_id_fk`='" . $data_cat['depart_id'] . "' AND com_id_fk='" . $com_id . "' ") or die(mysqli_error($con));

                if (mysqli_num_rows($result_9) == 0) {

                    if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif" || $picture_type == "image/ico" || $picture_type == "image/jpe") //يشترط ان تكون الصورةبأحد الإمتدادات التالية
                    {
                        if ($picture_size <= 50000000) //شرط حجم الصورة لايكون اكبر من 5 ميجابت
                        {
                            //code take name file and search . and tak after that
                            $type = substr($picture_name, strrpos($picture_name, '.'));
                            $pic_name = $id_cat_com . "_" . time() . $type; //rename the file for dont replucation the data and rename use id_naem_time.data type 
                            move_uploaded_file($picture_tmp_name, "../../img/cat_images/" . $pic_name); //upload the image for the folder


                            //update data for the order
                            $sql_che_ord = mysqli_query($con, "INSERT INTO `categories_com`(`cat_id_fk`,`id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`, `cat_image_com`, `cat_details_com`)
                            VALUES ('" . $data_cat['cat_id'] . "','" . $id_depart_com_fk . "','" . $deprat_id . "','" . $com_id . "','" . $name_depart_com . "','" . $name_cat_form . "','" . $pic_name . "','" . $cat_details_com . "');") or die(mysqli_error($con));
                            if ($sql_che_ord) {
                                header("location:manage_cat.php");
                            } else {
                                header("location:manage_cat.php");
                            }
                        } else {

                            header("location:manage_cat.php");
                        }
                    } else {
                        $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `categories_com`(`cat_id_fk`,`id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`,`cat_image_com`, `cat_details_com`)
                        VALUES ('" . $data_cat['cat_id'] . "','" . $id_depart_com_fk . "','" . $deprat_id . "','" . $com_id . "','" . $name_depart_com . "','" . $name_cat_form . "','" . $data_cat['cat_image'] . "','" . $cat_details_com . "');") or die(mysqli_error($con));
                        if ($sql_che_ord_non_imag) {
                            header("location:manage_cat.php");
                        } else {
                            header("location:manage_cat.php");
                        }
                    }
                } else {
                    header("location:manage_cat.php");
                    return 0;
                }
            } elseif (mysqli_num_rows($result_6) != 0) {

                header("location:manage_cat.php");
                return 0;
            } elseif ($picture_name == "" & $picture_type == "") {

                $sql_che_ord_non_imag = mysqli_query($con, "INSERT INTO `categories_com`(`id_depart_com_fk`, `deprat_id_fk`, `com_id_fk`, `name_depart_form`, `name_cat_form`, `cat_details_com`)
            VALUES ('" . $id_depart_com_fk . "','" . $deprat_id . "','" . $com_id . "','" . $name_depart_com . "','" . $name_cat_form . "','" . $cat_details_com . "');") or die(mysqli_error($con));
                if ($sql_che_ord_non_imag) {
                    header("location:manage_cat.php");
                } else {
                    header("location:manage_cat.php");
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
                        header("location:manage_cat.php");
                    } else {
                        header("location:manage_cat.php");
                    }
                } else {

                    header("location:manage_cat.php");
                }
            } else {
                header("location:manage_cat.php");
            }
        }
    } else {
        header("location:manage_cat.php");
        return 0;
    }

    */
}
