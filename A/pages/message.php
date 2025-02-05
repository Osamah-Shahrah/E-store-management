
<?php
function Msg_Sucess()
{
  echo "
    <script>
      $('.toastrDefaultSuccess').ready(function() {
        toastr.success('تم العملية بنجاح.')
      });
    </script>
  ";
}
?>


<?php
function Msg_Sucess2()
{
  echo "
    <script>
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      
        
      Toast.fire({
        type: 'success',
        title: 'تم العملية بنجاح.'
      });
    
  });
    </script>
  ";
}
?>


<?php
function Msg_info2()
{
  echo "
    <script>
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        type: 'info',
        title: 'لم تتم العملية.'
      })
    });

    </script>
  ";
}
?>


<?php
function Msg_Error2()
{
  echo "
    <script>
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        type: 'error',
        title: 'تم الغاء العملية.'
      })
    });
    </script>
  ";
}
?>


<?php
function Msg_Warning2()
{
  echo "
    <script>
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        type: 'warning',
        title: 'عذرا'
      })
    });
    </script>
  ";
}
?>



<?php
function Msg_Question2()
{
  echo "
    <script>
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        type: 'question',
        title: '?'
      })
    });
    </script>
  ";
}
?>


<!--2-->
<?php
function Msg_info1()
{
  echo "
    <script>
      $('.toastrDefaultInfo').ready(function() {
        toastr.info('لم تتم العملية')
      });
    </script>
  ";
}
?>

<!--3-->
<?php
function Msg_Error()
{
  echo "
    <script>
      $('.toastrDefaultError').ready(function() {
        toastr.error('تم الغاء العملية')
      });
    </script>
  ";
}
?>

<!--messge for false login account -->
<?php
function Msg_Error_login_foulse()
{
  echo "
    <script>
      $('.toastrDefaultError').ready(function() {
        toastr.error('اسم المستخدم او كلمة المرور خطأ')
      });
    </script>
  ";
}
?>

<?php
function Msg_Warning_icon_user()
{
  echo "
    <script>
      $('.toastrDefaultWarning').ready(function() {
        toastr.error(' عذرا يرجى تحديد صورة ذات امتداد واحد من الانواع التالية (jpeg/jpg/png/gif/ico/jpe)')
      });
    </script>
  ";
}
?>

<?php
function Msg_Warning_size_icon_user()
{
  echo "
    <script>
      $('.toastrDefaultWarning').ready(function() {
        toastr.error('يرجى تحديد صورة ذات حجم أقل من 5 ميجابايت')
      });
    </script>
  ";
}
?>

<!--3-->
<?php
function Msg_Error_like()
{
  echo "
    <script>
      $('.toastrDefaultWarning').ready(function() {
        toastr.warning('تم الغاء الاعجاب.')
      });
    </script>
  ";
}
?>

<!--4-->
<?php
function Msg_Warning1()
{
  echo "
    <script>
      $('.toastrDefaultWarning').ready(function() {
        toastr.warning('لم تتم العملية يرجى مراجعة الحقول')
      });
    </script>
  ";
}
?>













































<script>

  // code messages in javascript 

  function Msg_Sucess3() {


      toastr.success('تم العملية بنجاح.')
   

  }




  function Msg_Sucess4() {

    $(function () {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });


      Toast.fire({
        type: 'success',
        title: 'تم العملية بنجاح.'
      });

    });

  }


  function Msg_info2() {
    $(function () {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        type: 'info',
        title: 'لم تتم العملية.'
      })
    });


  }


  function Msg_Error2() {

    $(function () {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        type: 'error',
        title: 'تم الغاء العملية.'
      })
    });
  }




  function Msg_Warning2() {

    $(function () {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        type: 'warning',
        title: 'عذرا'
      })
    });

  }



  function Msg_Question2() {

    $(function () {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });
      Toast.fire({
        type: 'question',
        title: '?'
      })
    });

  }


  function Msg_info1() {

    $('.toastrDefaultInfo').ready(function () {
      toastr.info('لم تتم العملية')
    });

  }

  function Msg_Error() {

    $('.toastrDefaultError').ready(function () {
      toastr.error('تم الغاء العملية')
    });

  }

  //messge for false login account 

  function Msg_Error_login_foulse() {

    $('.toastrDefaultError').ready(function () {
      toastr.error('اسم المستخدم او كلمة المرور خطأ')
    });

  }

  function Msg_Warning_icon_user() {

    $('.toastrDefaultWarning').ready(function () {
      toastr.error(' عذرا يرجى تحديد صورة ذات امتداد واحد من الانواع التالية (jpeg/jpg/png/gif/ico/jpe)')
    });

  }

  function Msg_Warning_size_icon_user() {

    $('.toastrDefaultWarning').ready(function () {
      toastr.error('يرجى تحديد صورة ذات حجم أقل من 5 ميجابايت')
    });

  }

  function Msg_Error_like() {

    $('.toastrDefaultWarning').ready(function () {
      toastr.warning('تم الغاء الاعجاب.')
    });

  }

  function Msg_Warning1() {


    $('.toastrDefaultWarning').ready(function () {
      toastr.warning('لم تتم العملية يرجى مراجعة الحقول')
    });


  }

</script>