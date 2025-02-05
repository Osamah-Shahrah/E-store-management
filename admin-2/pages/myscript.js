



//**************/ cod javascript for page add order \\**************\
$(document).ready(function () {
  var comidll = $("#comid").val();
  $("#id_pro").change(function () {
    var id_pro = $("#id_pro").val();
    $.post("run_ajax_fun_admin.php", { id_pro: id_pro, comid: comidll }, function (data) {
      if (data.product && data.price) {
        $("#product").val(data.product);
        $("#price").val(data.price);

        var sizes = data.size_n.split(',');
        var size_id = data.size_id.split(',');

        $('#pro_size').empty();
        $.each(sizes, function (index, size) {
          $('#pro_size').append($('<option>', {
            value: size_id[index],
            text: size
          }));
        });


        $("#quantity").val("1");
        $("#total_price").val(data.price);
      }


      else {

        alert("عذرا، لم يتم العثور على المنتج.");
      }
    }, "json");
  });





  $("#quantity").change(function () {

    var q = $("#quantity").val();
    var p = $("#price").val();
    $("#total_price").val(p * q);


  });



  //date shiping
  var date_receipt = document.getElementById("date_receipt");
  var shipping_type = document.getElementById("shipping_type");

  var today = new Date();
  var dd = String(today.getDate());
  var mm = String(today.getMonth() + 1).padStart(2, '0');
  var yyyy = today.getFullYear();
  today = yyyy + '-' + mm + '-' + dd;
  //min date
  date_receipt.min = today;
  //max date
  var max_date = new Date();
  var max_d = String(max_date.getDate() + 13);
  max_date = yyyy + '-' + mm + '-' + max_d;
  date_receipt.max = max_date;
  //date for input
  date_receipt.value = today;


  //fun for git date for receipt order to customer git date today and add 2 day or 1 day or date select 
  $("#shipping_type").change(function () {
    if (shipping_type.value === 'normal') {
      var today = new Date();
      var dd = String(today.getDate() + 2);
      today = yyyy + '-' + mm + '-' + dd;
      date_receipt.value = today;
      date_receipt.readOnly = true;
    } else if (shipping_type.value === 'fast') {
      var today = new Date();
      var dd = String(today.getDate() + 1);
      today = yyyy + '-' + mm + '-' + dd;
      date_receipt.value = today;
      date_receipt.readOnly = true;
    } else if (shipping_type.value === 'in_date') {
      date_receipt.readOnly = false;
    }


  });



});



//**************/ cod javascript to send data use ajax to send department and compak categorus  used in page mange_size_pro \\**************\

$(document).ready(function () {


  $("#size_depart").change(function () {

    var pro_depart = $("#size_depart").val();
    $.post("run_ajax_fun_admin.php", { pro_depart: pro_depart }, function (data) {

      //alert($("#pro_depart").val());
      if (data.cat_n && data.cat_id) {


        var cat_name = data.cat_n.split(',');
        var cat_id = data.cat_id.split(',');
        $('#size_cat').empty();
        $.each(cat_name, function (index, cat_name) {
          $('#size_cat').append($('<option>', {
            value: cat_id[index],
            text: cat_name
          }));
        });



      }


      else {

        alert("عذرا، لم يتم العثور على المنتج.");
      }
    }, "json");
  });

});




//**************/cod javascript to send data use ajax to send categoures and comback size  used in page mange_size_pro \\**************\

$(document).ready(function () {


  $("#size_cat").change(function () {

    var pro_cat = $("#size_cat").val();
    $.post("run_ajax_fun_admin.php", { pro_cat: pro_cat }, function (data) {

      //alert($("#pro_cat").val());
      if (data.size_name && data.id_size) {


        var name_size = data.size_name.split(',');
        var id_size_it = data.id_size.split(',');
        $('#form_size').empty();
        $.each(name_size, function (index, name_size) {
          $('#form_size').append($('<option>', {
            value: id_size_it[index],
            text: name_size
          }));
        });




        var items_name = data.name_items.split(',');
        var items_id = data.id_items.split(',');
        $('#items').empty();
        $.each(items_name, function (index, items_name) {
          $('#items').append($('<option>', {
            value: items_id[index],
            text: items_name
          }));
        });




      }


      else {

        alert("عذرا، لم يتم العثور على المنتج.");
      }
    }, "json");
  });
});




//**************/ cod javascript to send data use ajax to send department and compak categorus  used in page mange_items_pro \\**************\

$(document).ready(function () {


  $("#pro_depart").change(function () {

    var pro_depart = $("#pro_depart").val();
    $.post("run_ajax_fun_admin.php", { pro_depart: pro_depart }, function (data) {

      //alert($("#pro_depart").val());
      if (data.cat_n && data.cat_id) {


        var cat_name = data.cat_n.split(',');
        var cat_id = data.cat_id.split(',');
        $('#fk_cat_ite_for').empty();
        $.each(cat_name, function (index, cat_name) {
          $('#fk_cat_ite_for').append($('<option>', {
            value: cat_id[index],
            text: cat_name
          }));
        });



      }


      else {

        alert("عذرا، لم يتم العثور على المنتج.");
      }
    }, "json");
  });

});







//**************/ cod javascript for page add product to even in chang catg search and get size and items \\**************\

$(document).ready(function () {


  $("#fk_cat_ite_for").change(function () {

      var pro_cat = $("#fk_cat_ite_for").val();
      $.post("run_ajax_fun_admin.php", {
          pro_cat: pro_cat
      }, function (data) {

          //alert($("#pro_cat").val());
          if (data.size_name && data.id_size) {


              var name_size = data.size_name.split(',');
              var id_size_it = data.id_size.split(',');
              $('#form_size').empty();
              $.each(name_size, function (index, name_size) {
                  $('#form_size').append($('<option>', {
                      value: id_size_it[index],
                      text: name_size
                  }));
              });


              var items_name = data.name_items.split(',');
              var items_id = data.id_items.split(',');
              $('#items_mange').empty();
              $.each(items_name, function (index, items_name) {
                  $('#items_mange').append($('<option>', {
                      value: items_id[index],
                      text: items_name
                  }));
              });




          } else {

              alert("عذرا، لم يتم العثور على المنتج.");
          }
      }, "json");
  });
});

















$(function () {
  $("#example1").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});

$(function () {
  $("#table-deleted-product").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});


$(function () {
  $("#table-all-product").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});
//script to use data table to search and view this cod used on page Subscrips
$(function () {
  $("#subscraib_table").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});





//script to use data table to search and view this cod used on page mange_categories
$(function () {
  $("#cat_table").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});


$(function () {
  $("#cat_table_new").DataTable();
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
  });
});



$(function () {
  $("#items_table").DataTable();
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
  });
});


$(function () {
  $("#items_table_new").DataTable();
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
  });
});



$(function () {
  $("#size_table").DataTable();
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
  });
});


$(function () {
  $("#size_table_new").DataTable();
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
  });
});


//script to use data table to search and view this cod used on page mange_department
$(function () {
  $("#department_table").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});



//script to use data table to search and view this cod used on page mange_department
$(function () {
  $("#department_table_join").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});

//script to use data table to search and view this cod used on page manage_cat_one_com
$(function () {
  $("#cat_com_table").DataTable();
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
  });
});


//script to use data table to search and view departmnt for company  this cod used on page mane_depart_one_com
$(function () {
  $("#department_com_table").DataTable();
  $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
  });
});







//script to use data table to search and view this cod used on page mang_comany
$(function () {
  $("#company_table").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});

//script to use data table to search and view producte_deleted_by_admin_website this cod used on page Myfun
$(function () {
  $("#producte_deleted_by_admin_website").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});


//script to use data table to search and view this cod used on page mang_comany for company unacceptable
$(function () {
  $("#company_table_unacceptable").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
  });
});
//script to  butoon swetch for enable or disbale the all activites for the comapny this cod used on page mang_comany
$(document).ready(function () {
  $('input[name="staute_com_Enabled"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var ste = state ? 2 : 3;
    var comide = $(this).closest('tr').find('input[name="com_id"]').val();
    var $modal = $('#confirmationModal2');

    $modal.modal('show');

    $modal.find('.confirm-btn1').on('click', function () {
      // alert('osamah');
      $modal.modal('hide');

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          stop_all_com: 1,
          stop_all_company_stat: ste,
          id_com_stop_all_company_stat: comide
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            // alert('osamah');
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    });


  });
});







//script to  butoon swetch for enable or disbale the items this cod used on page mange_items_pro
                   
$(document).ready(function () {
  $('input[name="state_items_1"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var st = state ? 2 : 3;
    var item_id_s = $(this).closest('tr').find('input[name="items_id"]').val();
    var r = window.confirm("هل تريد حقاً تغيير حالة الوصف ");
    if (r) {

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          stop_item: 1,
          state_item: st,
          item_id: item_id_s
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }


  });
});






//script to  butoon swetch for enable or disbale the items this cod used on page mange_items_pro
$(document).ready(function () {
  $('input[name="state_items_2"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var ste = state ? 1 : 2;
    var item = $(this).closest('tr').find('input[name="items_id"]').val();
    var r = window.confirm("هل تريد حقاً تغيير الوصول الى الوصف ");
    if (r) {

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          state_items_2: 1,
          item_form_status: ste,
          item_id: item
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }

  });
});











//script to  butoon swetch for enable or disbale the size this cod used on page mange_size_pro
$(document).ready(function () {
  $('input[name="state_size_1"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var ste = state ? 2 : 3;
    var size_id = $(this).closest('tr').find('input[name="size_id"]').val();
    var r = window.confirm("هل تريد حقاً تغيير حالة الحجم ");
    if (r) {

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          state_size_1: 1,
          size_form_status: ste,
          size_id: size_id
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }

  });
});






//script to  butoon swetch for enable or disbale the size this cod used on page mange_size_pro
$(document).ready(function () {
  $('input[name="state_size_2"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var ste = state ? 1 : 2;
    var size_id = $(this).closest('tr').find('input[name="size_id"]').val();
    var r = window.confirm("هل تريد حقاً تغيير الوصول الى الحجم ");
    if (r) {

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          state_size_2: 1,
          size_form_status: ste,
          size_id: size_id
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }

  });
});



















//script to  butoon swetch for show or hid products and he can open web site and chang any think  for the comapny this cod used on page mang_comany                        
$(document).ready(function () {
  $('input[name="com_status"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var st = state ? 1 : 2;
    var comid = $(this).closest('tr').find('input[name="com_id"]').val();
    var $modal = $('#confirmationModal1');

    $modal.modal('show');

    $modal.find('.confirm-btn').on('click', function () {
      $modal.modal('hide');

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          stop_show_com: 1,
          stop_company_stat: st,
          id_com_stop_company_stat: comid
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    });


  });
});






//script to  butoon updata_bunch for the comapny and send name bunch it well have this cod used on page detailsSubscrip                        

$(document).ready(function () {

  var comid = $("#comid").text();
  var bunch = $("#bunch");
  var btn = $("#btntt");
  var procount;
  var message = $("#respon");


  bunch.change(function () {

    procount = $(this).children("option:selected").val();

    btn.click(function () {
      var r = window.confirm("هل تريد إضافة الباقة فعلاً ");


      if (r == true) {
        $.ajax({
          type: 'POST',
          url: 'insert_data_admin.php',
          data: "com_id=" + comid + "&bunch_name=" + procount +
            "&add_bunch_to_the_comany",

          success: function (data, status) {

            message.html(data);
            if (status == 'success') {
              window.location(location.reload());

            }

          },
          error: function (req, status) {
            message.html(req);
          }



        })
      } else {


      }

    })

  })

})




//script to  butoon swetch for show or hid the bunch_form and any centaer can choses for his center this cod used on page mang_bunch                        
$(document).ready(function () {
  $('input[name="bunch_form_status"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var st = state ? 1 : 0;
    var comid = $(this).closest('tr').find('input[name="bunch_ID"]').val();
    var r = window.confirm("هل تريد حقاً تغيير حالة الباقة ");
    if (r) {

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          stop_bunch_form: 1,
          bunch_form_status: st,
          bunch_ID: comid
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }


  });
});



//script to  butoon swetch for stope or turn on the department  this cod used on page mange_department                        
$(document).ready(function () {
  $('input[name="depart_state1"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var st = state ? 2 : 3;
    var depart_id_s = $(this).closest('tr').find('input[name="deprat_id"]').val();
    var r = window.confirm("هل تريد حقاً تغيير حالة القسم ");
    if (r) {

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          stop_department1: 1,
          depart_state: st,
          depart_id: depart_id_s
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }


  });
});



//script to  butoon swetch for show or hid the department  this cod used on page mange_department                        
$(document).ready(function () {
  $('input[name="depart_state2"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var st = state ? 1 : 2;
    var depart_id_s = $(this).closest('tr').find('input[name="deprat_id"]').val();
    var r = window.confirm("هل تريد حقاً تغيير حالة الوصول الى القسم ");
    if (r) {

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          stop_department2: 1,
          depart_state: st,
          depart_id: depart_id_s
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }


  });
});



























//script to  butoon swetch for stope or turn on the categories  this cod used on page mange_categories                        
$(document).ready(function () {
  $('input[name="state_cat_1"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var st = state ? 2 : 3;
    var cat_id_s = $(this).closest('tr').find('input[name="cat_id"]').val();
    var r = window.confirm("هل تريد حقاً تغيير حالة الصنف ");
    if (r) {

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          stop_cat1: 1,
          state_cat: st,
          cat_id: cat_id_s
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }


  });
});



//script to  butoon swetch for show or hid the categories  this cod used on page mange_categories                        
$(document).ready(function () {
  $('input[name="state_cat_2"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var st = state ? 1 : 2;
    var cat_id_s = $(this).closest('tr').find('input[name="cat_id"]').val();
    var r = window.confirm("هل تريد حقاً تغيير حالة الوصول الى الصنف ");
    if (r) {

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          stop_cat2: 1,
          state_cat: st,
          cat_id: cat_id_s
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }


  });
});






//script to  butoon swetch for turn on the bunch_com to center this cod used on page Subscription_requests                        
$(document).ready(function () {
  $('input[name="bunch_com_status"]').on('switchChange.bootstrapSwitch', function (event, state) {
    var st = state ? 1 : 0;
    var id_bunch_com = $(this).closest('tr').find('input[name="id_bunch_com"]').val();
    var r = window.confirm("هل تريد حقاً قبول الطلب ");
    var k = "insert_from_Subscription_requests";
    if (r) {
      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          turn_on_bunch: 1,
          bunch_com_status: st,
          id_bunch_com: id_bunch_com,
          type_pagr: k
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    } else {
      window.location.reload();
    }


  });
});

//script to  butoon swetch for turn on the bunch_com to center this cod used on page detailsSubscrip                      
$(document).ready(function () {
  $('input[name="bunch_com_status_detailsSubscrip"]').on('switchChange.bootstrapSwitch', function (event,
    state) {
    var st = state ? 1 : 2;
    var id_bunch_com = $(this).closest('tr').find('input[name="id_bunch_com_detailsSubscrip"]')
      .val();
    var k = "insert_from_detailsSubscrip";
    var $modal = $('#confirmationModal3');

    $modal.modal('show');

    $modal.find('.confirm-btn').on('click', function () {
      $modal.modal('hide');
      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          turn_on_bunch: 1,
          bunch_com_status: st,
          id_bunch_com: id_bunch_com,
          type_pagr: k
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);


        }
      });
    });


  });
});



//script to accept the new center and updata status to 1 for company and mang_com
$(document).ready(function () {
  var accept = $("#accept_new_center");
  accept.click(function () {
    var id_com_accept = $(this).closest('tr').find('input[name="com_id_accept"]').val();
    var $modal = $('#confirmationModal5');

    $modal.modal('show');

    $modal.find('.confirm-btn5').on('click', function () {
      $modal.modal('hide');

      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          click_accept: 1,
          id_com_accept: id_com_accept
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);
        }
      });
    });
  });
});



//script to  butoon to non_accept to add center this cod used on page orderAcceptable                        
$(document).ready(function () {
  var non_accept = $("#non_accept_new_center");
  non_accept.click(function () {

    var com_id_non_accept = $(this).closest('tr').find('input[name="com_id_accept"]').val();
    var r = window.confirm("هل تريد عدم قبول الأشتراك ");
    if (r) {
      $.ajax({
        type: 'POST',
        url: 'insert_data_admin.php',
        data: {
          click_non_accept: 1,
          com_id_non_accept: com_id_non_accept
        },
        success: function (data, status) {
          // Handle success response
          if (status === 'success') {
            window.location.reload();
          }
        },
        error: function (req, status) {
          // Handle error response
          console.log(req);

        }
      });
    }



  });
});







//script to  butoon swetch to show or hid the categories for one company  this cod used on page mange_one_company                        
$(document).ready(function () {
  $('input[name="state_cat_com2"]').on('switchChange.bootstrapSwitch', function (event, state) {
      var st = state ? 1 : 2;
      var id_cat_com_s = $(this).closest('tr').find('input[name="id_cat_com"]').val();
      var r = window.confirm("هل تريد حقاً تغيير حالة الوصول الى الصنف ");
      if (r) {

          $.ajax({
              type: 'POST',
              url: 'insert_data_admin.php',
              data: {
                  state_cat_com2: 1,
                  state_cat: st,
                  id_cat_com: id_cat_com_s
              },
              success: function (data, status) {
                  // Handle success response
                  if (status === 'success') {
                      window.location.reload();
                  }
              },
              error: function (req, status) {
                  // Handle error response
                  console.log(req);

              }
          });
      }


  });
});




//script to  butoon swetch to turn off or turn on the categories for one company this cod used on page mange_one_company                        
$(document).ready(function () {
  $('input[name="state_cat_com1"]').on('switchChange.bootstrapSwitch', function (event, state) {
      var st = state ? 2 : 3;
      var id_cat_com_s = $(this).closest('tr').find('input[name="id_cat_com"]').val();
      var r = window.confirm("هل تريد حقاً تغيير حالة الصنف ");
      if (r) {

          $.ajax({
              type: 'POST',
              url: 'insert_data_admin.php',
              data: {
                  state_cat_com1: 1,
                  state_cat: st,
                  id_cat_com: id_cat_com_s
              },
              success: function (data, status) {
                  // Handle success response
                  if (status === 'success') {
                      window.location.reload();
                  }
              },
              error: function (req, status) {
                  // Handle error response
                  console.log(req);

              }
          });
      }


  });
});






//**************/ script to  butoon swetch to turn off or turn on the department for one company this cod used on page mange_one_company  \\**************\                      
$(document).ready(function () {
  $('input[name="depart_state_com_mang1"]').on('switchChange.bootstrapSwitch', function (event, state) {
      var st = state ? 2 : 3;
      var depart_id_s = $(this).closest('tr').find('input[name="id_depart_state_com_mang"]').val();
      var r = window.confirm("هل تريد حقاً تغيير حالة القسم ");
      if (r) {

          $.ajax({
              type: 'POST',
              url: 'insert_data_admin.php',
              data: {
                  stop_department_com1: 1,
                  depart_state: st,
                  depart_id: depart_id_s
              },
              success: function (data, status) {
                  // Handle success response
                  if (status === 'success') {
                      window.location.reload();
                  }
              },
              error: function (req, status) {
                  // Handle error response
                  console.log(req);

              }
          });
      }


  });
});




//**************/script to  butoon swetch to show or hid the department for one company  this cod used on page mange_one_company    \\**************\                    
$(document).ready(function () {
  $('input[name="depart_state_com_mang2"]').on('switchChange.bootstrapSwitch', function (event, state) {
      var st = state ? 1 : 2;
      var depart_id_s = $(this).closest('tr').find('input[name="id_depart_state_com_mang"]').val();
      var r = window.confirm("هل تريد حقاً تغيير حالة الوصول الى القسم ");
      if (r) {

          $.ajax({
              type: 'POST',
              url: 'insert_data_admin.php',
              data: {
                  stop_department_com2: 1,
                  depart_state: st,
                  depart_id: depart_id_s
              },
              success: function (data, status) {
                  // Handle success response
                  if (status === 'success') {
                      window.location.reload();
                  }
              },
              error: function (req, status) {
                  // Handle error response
                  console.log(req);

              }
          });
      }


  });
});




////////////////////////////////////


$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()

  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', {
    'placeholder': 'dd/mm/yyyy'
  })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', {
    'placeholder': 'mm/dd/yyyy'
  })
  //Money Euro
  $('[data-mask]').inputmask()

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  })
  //Date range as a button
  $('#daterange-btn').daterangepicker({
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
        .endOf('month')
      ]
    },
    startDate: moment().subtract(29, 'days'),
    endDate: moment()
  },
    function (start, end) {
      $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )

  //Timepicker
  $('#timepicker').datetimepicker({
    format: 'LT'
  })

  //Bootstrap Duallistbox
  $('.duallistbox').bootstrapDualListbox()

  //Colorpicker
  $('.my-colorpicker1').colorpicker()
  //color picker with addon
  $('.my-colorpicker2').colorpicker()

  $('.my-colorpicker2').on('colorpickerChange', function (event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
  });

  $("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });

})





//////////////////////////////////////



$(function () {
  $(document).on('click', '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox({
      alwaysShowClose: true
    });
  });

  $('.filter-container').filterizr({
    gutterPixels: 3
  });
  $('.btn[data-filter]').on('click', function () {
    $('.btn[data-filter]').removeClass('active');
    $(this).addClass('active');
  });
})





//////////////////////////////
$(function () {
  /* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //--------------
  //- AREA CHART -
  //--------------

  // Get context with jQuery - using jQuery's .get() method.
  var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

  var areaChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [{
      label: 'Digital Goods',
      backgroundColor: 'rgba(60,141,188,0.9)',
      borderColor: 'rgba(60,141,188,0.8)',
      pointRadius: false,
      pointColor: '#3b8bba',
      pointStrokeColor: 'rgba(60,141,188,1)',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(60,141,188,1)',
      data: [28, 48, 40, 19, 86, 27, 90]
    },
    {
      label: 'Electronics',
      backgroundColor: 'rgba(210, 214, 222, 1)',
      borderColor: 'rgba(210, 214, 222, 1)',
      pointRadius: false,
      pointColor: 'rgba(210, 214, 222, 1)',
      pointStrokeColor: '#c1c7d1',
      pointHighlightFill: '#fff',
      pointHighlightStroke: 'rgba(220,220,220,1)',
      data: [65, 59, 80, 81, 56, 55, 40]
    },
    ]
  }

  var areaChartOptions = {
    maintainAspectRatio: false,
    responsive: true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines: {
          display: false,
        }
      }],
      yAxes: [{
        gridLines: {
          display: false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var areaChart = new Chart(areaChartCanvas, {
    type: 'line',
    data: areaChartData,
    options: areaChartOptions
  })

  //-------------
  //- LINE CHART -
  //--------------
  var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
  var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
  var lineChartData = jQuery.extend(true, {}, areaChartData)
  lineChartData.datasets[0].fill = false;
  lineChartData.datasets[1].fill = false;
  lineChartOptions.datasetFill = false

  var lineChart = new Chart(lineChartCanvas, {
    type: 'line',
    data: lineChartData,
    options: lineChartOptions
  })

  //-------------
  //- DONUT CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData = {
    labels: [
      'Chrome',
      'IE',
      'FireFox',
      'Safari',
      'Opera',
      'Navigator',
    ],
    datasets: [{
      data: [700, 500, 400, 600, 300, 100],
      backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
    }]
  }
  var donutOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions
  })

  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
  var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  var pieData = donutData;
  var pieOptions = {
    maintainAspectRatio: false,
    responsive: true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  var pieChart = new Chart(pieChartCanvas, {
    type: 'pie',
    data: pieData,
    options: pieOptions
  })

  //-------------
  //- BAR CHART -
  //-------------
  var barChartCanvas = $('#barChart').get(0).getContext('2d')
  var barChartData = jQuery.extend(true, {}, areaChartData)
  var temp0 = areaChartData.datasets[0]
  var temp1 = areaChartData.datasets[1]
  barChartData.datasets[0] = temp1
  barChartData.datasets[1] = temp0

  var barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false
  }

  var barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: barChartData,
    options: barChartOptions
  })

  //---------------------
  //- STACKED BAR CHART -
  //---------------------
  var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
  var stackedBarChartData = jQuery.extend(true, {}, barChartData)

  var stackedBarChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      xAxes: [{
        stacked: true,
      }],
      yAxes: [{
        stacked: true
      }]
    }
  }

  var stackedBarChart = new Chart(stackedBarChartCanvas, {
    type: 'bar',
    data: stackedBarChartData,
    options: stackedBarChartOptions
  })
})

///////////////////////////////////////////////////////