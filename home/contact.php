<?php
include 'header.php';

include '../db.php';
echo "

<title>$name_system</title>

";
//echo "fsdfsdffd";

/**الأظافات ن1-
 * نقوم باشاء مجلد جديد في المجلد الرئيسي للمشروع باسم agreements 
 * (ecom_reg)والذي سيحتوي علىعلى مجلدين الاول لتخزين السجلات التجارية
 * (contract_accept) والثاني لعقد الأتفاق
 */


if(isset($_POST['btn_save']))//عند الضغط على زر حفظ يتم حفظ القيم في متغيرات
{
    $com_name=$_POST['com_name'];
    $com_phone=$_POST['com_phone'];
    $city=$_POST['city'];
    $address=$_POST['address'];
    $com_email=$_POST['com_email'];
    //$comm_Reg=$_POST['comm_Reg'];
    //$location=$_POST['location'];
   
//contract_accept file PDF
$contract_accept_name=$_FILES['contract_accept']['name'];//اضافة صورة للمنتج هنا يتم حفظ الاسم
$contract_accept_type=$_FILES['contract_accept']['type'];//نوع الصورة
$contract_accept_tmp_name=$_FILES['contract_accept']['tmp_name'];//ملف مؤقت خاص بالصورة
$contract_accept_size=$_FILES['contract_accept']['size'];//حجم الصورة

if($contract_accept_size<=50000000){
  
    $contract_accept=time()."_".$contract_accept_name;//اضافة الوقت اللي تم اظافة الصورة فيه من اجل عدم رفع صور منتجات متكررة بالأسماء
    move_uploaded_file($contract_accept_tmp_name,"../agreements/contract_accept/contract_accept".$contract_accept);//رفع الصورة إلى مجلد  الصور

}

//comm_Reg file PDF
$comm_Reg_name=$_FILES['comm_Reg']['name'];//اضافة صورة للمنتج هنا يتم حفظ الاسم
$comm_Reg_type=$_FILES['comm_Reg']['type'];//نوع الصورة
$comm_Reg_tmp_name=$_FILES['comm_Reg']['tmp_name'];//ملف مؤقت خاص بالصورة
$comm_Reg_size=$_FILES['comm_Reg']['size'];//حجم الصورة

if($comm_Reg_size<=50000000){
  
    $comm_Reg=time()."_".$comm_Reg_name;//اضافة الوقت اللي تم اظافة الصورة فيه من اجل عدم رفع صور منتجات متكررة بالأسماء
    move_uploaded_file($comm_Reg_tmp_name,"../agreements/ecom_reg/comm_Reg".$comm_Reg);//رفع الصورة إلى مجلد  الصور

}






//picture coding
$picture_name=$_FILES['picture']['name'];//اضافة صورة للمنتج هنا يتم حفظ الاسم
$picture_type=$_FILES['picture']['type'];//نوع الصورة
$picture_tmp_name=$_FILES['picture']['tmp_name'];//ملف مؤقت خاص بالصورة
$picture_size=$_FILES['picture']['size'];//حجم الصورة

if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png" || $picture_type=="image/gif")//يشترط ان تكون الصورةبأحد الإمتدادات التالية

{
	if($picture_size<=50000000)//شرط حجم الصورة لايكون اكبر من 5 ميجابت
	
		$icon=time()."_".$picture_name;//اضافة الوقت اللي تم اظافة الصورة فيه من اجل عدم رفع صور منتجات متكررة بالأسماء
    move_uploaded_file($picture_tmp_name,"../img/imag_comb/".$icon);//رفع الصورة إلى مجلد  الصور
    
    
		
$addcom= mysqli_query($con,"insert into company ( `com_name`, `com_phone`, `city`, `address`, `com_email`, `icon`, `com_status`,`comm_Reg`,`contract_accept`, `date_added`, `date_modifide`)
 VALUES('$com_name','$com_phone','$city','$address','$com_email','$icon','0','$comm_Reg','$contract_accept',current_timestamp(),current_timestamp())") or die (mysqli_error($con));
 



 
 $com_id;

 if($addcom){
     
     echo '<div class="row msg" >
     <div class="col-md-12">
         <div class="alert alert-success" role="alert">
             <strong>طلبك قيد المراجعة</strong> 
         </div>
         
     </div>
 </div>';
     
 }

 

  
}

//mysqli_close($con);
}

?>

<link rel="stylesheet" href="../assets/css/bootstrap.rtl.min.css">
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<!-- start the div whatsapp-->
<script type="text/javascript">
(function() {
    var options = {
        whatsapp: "+96777971715", // WhatsApp number
        call_to_action: "واتساب شحرة", // Call to action
        company_logo_url: "//static.whatshelp.io/img/flag.png",
        position: "right", // Position may be 'right' or 'left'
    };
    var proto = document.location.protocol,
        host = "getbutton.io",
        url = proto + "//static." + host;
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url + '/widget-send-button/js/init.js';
    s.onload = function() {
        WhWidgetSendButton.init(host, proto, options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
})();
</script>
<!-- end the div whatsapp-->



<!-- Start Content Page -->

<div class="container py-5">




    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">
            <div class="row">

                <div class="form-group col-md-6 mb-3">
                    <ul>
                        <h2 class="h2 text-success border-bottom pb-3 border-light logo">الطرف الاول</h2>
                        <li>على الطرف الأول الالتزام بتسويق المنتجات للعملاءإقليمي عن طريق الموقع</li>
                        <br>
                        <li>يلتزم الطرف الأول بإعطاءحساب خاص به الى الطرف الثاني </li>
                        <br>
                        <li> يلتزم الطرف الاول بتوفير كافة البيانات والمعلومات التي يطلبها الطرف الثاني</li>
                        <br>
                        <li>يلتزم الطرف الاول التزاما تاما بالحفاظ على سرية معلومات الطرف الثاني</li>
                    </ul>

                </div>

                <div class="form-group col-md-6 mb-3">
                    <ul>
                        <h2 class="h2 text-success border-bottom pb-3 border-light logo">الطرف الثاني</h2>
                        <li>الإلتزام بعرض منتجات حقيقة وغير مخلة باالادب اومحرمة في الشرع</li>
                        <br>
                        <li>الإلتزام بعرض منتجات غير مشتبهة</li>
                        <br>
                        <li>الإلتزام بأسعار المنتجات حسب مأتم الإعلان عنه</li>
                        <br>
                        <li>يلتزم الطرف الثاني التزاما تاما بالحفاظ على سرية معلومات حسابات الطرف الأول</li>
                    </ul>
                </div>
            </div>
        </form>

    </div>
</div>

<div class="row text-center">
    <div class="col-sm-12 text-center">

  <input class="form-check-input" type="checkbox" value="أوافق على الشروط" id="checkbox_staus">
  <label class="form-check-label h4 text-primary" for="" id="lable">
  أوافق على الشروط
  </label>

</div>

</div>

<script>
$(document).ready(function(){
  var msg=$('.msg');
  msg.hide(4000)
    var frm1=$("#frm1");
$(frm1).hide()
        var checkbox=$("#checkbox_staus");
        var lable=$("#lable");
      
            checkbox.change(function(e){
            
            if(this.checked){
               // lable.html("<span class='m-1 text-success h5'>مفعل</span>") 
               $(frm1).show();
            }else{
                $(frm1).hide()
              //  lable.html("<span class='m-1 text-danger h5'>معطل</span>") 
            }
          
        })
      
       
    })

</script>
 
<div class="row" id="frm1">
<div class="col-md-8 mx-auto">
                    <div class="card" style="margin: 20px; ">
                        <div class="card-header card-header-primary">
                            <h5 class="title">تقديم طلب إضافة مركز </h5>
                        </div>

                        <div class="container text-center">
                            <form method="POST" id="frm1" action="" type="form" name="form"
                                enctype="multipart/form-data">
                                <div class="col">


                                </div>
                                <div class="row">

                                    <div class="form-group">
                                        <label class="form-label ">شعار المركز</label>
                                        <input type="file" name="picture" required  class=" form-control file"
                                            id="picture">
                                           <!--<i class="fa fa-paperclip"></i>-->
                                    </div>

                         
                                    <div class="col">
                                        <!--col1-->
                                        <div class="form-group">
                                            <label class="form-label">السجل التجاري</label>
                                            <input type="file" name="comm_Reg" required class="form-control file"
                                                id="picture" accept=".pdf">
                                        </div>
                                        
                                        <div class="form-group bmd-form-group">
                                            <label class="form-label">أسم المركز</label>
                                            <input type="text" id="com_name" name="com_name" class="form-control"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">البريدالإلكتروني</label>
                                            <input type="text" id="price" name="com_email" required
                                                class="form-control">
                                        </div>

                                      <!--  <div class="form-group">
                                            <label class="form-label">تحميل عقد العمل</label>
                                            <br>
                                            <div class="card-footer">
                                                <a class="text-decoration-none" href="assets/img/html ll.pdf"><i class="fa fa-download"></i></a>

                                            </div>
                                        </div>-->
                                        



                                    </div>
                                    <div class="col">
                                        <!--Col2-->
 
                                        <div class="form-group">
                                          <label for="" class="form-label">المدينة</label>
                                          <select class="form-control" required name="city" id="">
                                            <option>اختر مدينة</option>
                                            <option>إب</option>
                                          </select>
                                        </div>
                                       

                                        <div class="form-group">
                                            <label class="form-label">العنوان</label>
                                            <input type="text" id="price" name="address" required class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">تلفون</label>
                                            <input type="tel" required name="com_phone"
                                                class="form-control" />
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <label class="form-label"> ملف عقد الأتفاق  </label>
                                        <input type="file" name="contract_accept" required class="form-control file">
                                    </div>
                           
                                    <div class="row text-center"> 
                                  <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-sm btn-primary m-1">تقديم الطلب</button>
                             <div class="col-md-12 text-center">
                                
                            
                            </div>
                            </div>   
                                </div>

                        </div>
                    </div>

                    </form>



                </div>


                <!--end -->
</div>







<!-- Start Footer -->


<?php
include "footer.php";

?>