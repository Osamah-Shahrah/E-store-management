
//**************/ cod javascript for page add order \\**************\
$(document).ready(function () {
    var comidll = $("#comid").val();
    $("#id_pro").change(function () {
        var id_pro = $("#id_pro").val();
        $.post("run_ajax_fun.php", {
            id_pro: id_pro,
            comid: comidll
        }, function (data) {
            if (data.product && data.price) {
                $("#product").val(data.product);
                $("#price").val(data.price);
                $("#img").fadeIn("fast").attr('style', "style='display:block;'");
                $("#img").fadeIn("fast").attr('src', data.img);

                var sizes = data.size_n.split(',');
                var size_id = data.size_id.split(',');

                $('#pro_size').empty();
                $.each(sizes, function (index, size) {
                    $('#pro_size').append($('<option>', {
                        value: size_id[index],
                        text: size
                    }));
                });

                var colors = data.colors.split(',');
                var color_id = data.color_id.split(',');

                $('#pro_color').empty();
                $.each(colors, function (index, colo) {
                    $('#pro_color').append($('<option>', {
                        value: color_id[index],
                        text: colo
                    }));
                });






                $("#quantity").val("1");
                $("#total_price").val(data.price);
            } else {

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









//**************/ cod javascript for page add product \\**************\

$(document).ready(function () {


    $("#pro_depart").change(function () {

        var pro_depart = $("#pro_depart").val();
        $.post("run_ajax_fun.php", {
            pro_depart: pro_depart
        }, function (data) {

            //alert($("#pro_depart").val());
            if (data.cat_n && data.cat_id) {


                var cat_name = data.cat_n.split(',');
                var cat_id = data.cat_id.split(',');
                $('#pro_cat').empty();
                $.each(cat_name, function (index, cat_name) {
                    $('#pro_cat').append($('<option>', {
                        value: cat_id[index],
                        text: cat_name
                    }));
                });



            } else {

                alert("عذرا، لم يتم العثور على المنتج.");
            }
        }, "json");
    });

});







//**************/ cod javascript for page add product to even in chang catg search and get size and items \\**************\

$(document).ready(function () {


    $("#pro_cat").change(function () {

        var pro_cat = $("#pro_cat").val();
        $.post("run_ajax_fun.php", {
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
                $('#items').empty();
                $.each(items_name, function (index, items_name) {
                    $('#items').append($('<option>', {
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




//**************/ script to  butoon swetch for stope or turn on the delivery company  this cod used on page delivery_com  \\**************\                      
$(document).ready(function () {
    $('input[name="delivery_statue1"]').on('switchChange.bootstrapSwitch', function (event, state) {
        var st = state ? 4 : 5;
        var delivery_id_s = $(this).closest('tr').find('input[name="id_delivery"]').val();
        var r = window.confirm("هل تريد حقاً تغيير حالة شركة التوصيل ");
        if (r) {

            $.ajax({
                type: 'POST',
                url: 'insert_data.php',
                data: {
                    stop_delivery_com1: 1,
                    delivery_state: st,
                    delivery_id: delivery_id_s
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



//**************/script to  butoon swetch for show or hid the  delivery company  this cod used on page delivery_com    \\**************\                    
$(document).ready(function () {
    $('input[name="delivery_statue2"]').on('switchChange.bootstrapSwitch', function (event, state) {
        var st = state ? 1 : 4;
        var delivery_id_s = $(this).closest('tr').find('input[name="id_delivery"]').val();
        var r = window.confirm("هل تريد حقاً تغيير حالة الوصول الى شركة التوصيل ");
        if (r) {

            $.ajax({
                type: 'POST',
                url: 'insert_data.php',
                data: {
                    stop_delivery_com2: 1,
                    delivery_state: st,
                    delivery_id: delivery_id_s
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





//**************/ script to  butoon swetch for stope or turn on the department  this cod used on page all_department  \\**************\                      
$(document).ready(function () {
    $('input[name="depart_state_com1"]').on('switchChange.bootstrapSwitch', function (event, state) {
        var st = state ? 4 : 5;
        var depart_id_s = $(this).closest('tr').find('input[name="id_depart_com"]').val();
        var r = window.confirm("هل تريد حقاً تغيير حالة القسم ");
        if (r) {

            $.ajax({
                type: 'POST',
                url: 'insert_data.php',
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



//**************/script to  butoon swetch for show or hid the department  this cod used on page all_department    \\**************\                    
$(document).ready(function () {
    $('input[name="depart_state_com2"]').on('switchChange.bootstrapSwitch', function (event, state) {
        var st = state ? 1 : 4;
        var depart_id_s = $(this).closest('tr').find('input[name="id_depart_com"]').val();
        var r = window.confirm("هل تريد حقاً تغيير حالة الوصول الى القسم ");
        if (r) {

            $.ajax({
                type: 'POST',
                url: 'insert_data.php',
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



//script to  butoon swetch for stope or turn on the categories  this cod used on page mange_categories                        
$(document).ready(function () {
    $('input[name="state_cat_com1"]').change(function (event) {
        var state_cat_com1_1 = $(this).val();
        var st = (state_cat_com1_1 === '5') ? 4 : 5;
        var id_cat_com_s = $(this).closest('tr').find('input[name="id_cat_com"]').val();
        var r = window.confirm("هل تريد حقاً تغيير حالة الصنف ");
        if (r) {

            $.ajax({
                type: 'POST',
                url: 'insert_data.php',
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



//script to  butoon swetch for show or hid the categories  this cod used on page mange_categories                        
$(document).ready(function () {
    $('input[name="state_cat_com2"]').change(function (event) {
        var state_cat_com2_1 = $(this).val();
        var st = (state_cat_com2_1 === '1') ? 4 : 1;

        var id_cat_com_s = $(this).closest('tr').find('input[name="id_cat_com"]').val();
        var r = window.confirm("هل تريد حقاً تغيير حالة الوصول الى الصنف ");
        if (r) {

            $.ajax({
                type: 'POST',
                url: 'insert_data.php',
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











$(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});



$(function () {
    $("#cat_com_table").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});










$(function () {
    $("#table-deleted-product").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});


$(function () {
    $("#table-all-product").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});




//script to use data table to search and view check_order_compang this cod used on page check_order_compang
$(function () {
    $("#check_order_compang").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});



//script to use data table to search and view check_order_compang this cod used on page check_order_compang
$(function () {
    $("#check_order_deleted").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});



//script to use data table to search and view producte_deleted_by_admin_website this cod used on page Myfun
$(function () {
    $("#producte_deleted_by_admin_website").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});





//script to use data table to search and view departmnt for web sit to add department in to company  this cod used on page all_department
$(function () {
    $("#public_department_com_table").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});



//script to use data table to search and view departmnt for web sit to add department in to company  this cod used on page all_department
$(function () {
    $("#department_com_table").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});



//script to use data table to search and view delivery_company in websit   this cod used on page delivery_com
$(function () {
    $("#delivery_com_table").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});






//script to use data table to search and view delivery_company for web sit to add the delivary_com to the company  this cod used on page delivery_com
$(function () {
    $("#public_delivery_com_table").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
    });
});









//////////////////////////////////////////////////////////

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




/////////////////////////////////////////////////




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










////////////////////////////////


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





//////////////////////////////////////////////////////////////////
