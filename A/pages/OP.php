<?php

function getproducts($con, $com_id)
{
  if (isset($_GET['com_id'])) {

    // echo $_GET['com_id'];
    $q = "SELECT `product_id`, `com_id`, 
     `id_depart_com`, `product_title`,
      `product_cat`, `QR_number`, 
      `product_image`, `price`, `opponent`, `product_desc`,
       `notice`, `like` FROM `product` WHERE com_id='" . $com_id . "'";
    $result = mysqli_query($con, $q);
    while ($i = mysqli_fetch_array($result)) {
      echo $i['product_title'] . "<br>";
    }
  }
}


function getDepartment($con, $com_id)
{
  $q = "SELECT * FROM `department_com` WHERE `com_id`=$com_id";
  $result = mysqli_query($con, $q);
  while ($i = mysqli_fetch_array($result)) {
    echo "
        
        <div class='card-header card-header-primary'>
        <h6 class='card-title'> $i[name_depart_com]</h6>
        </div>
        ";
    $q = "SELECT * FROM `product` WHERE id_depart_com=$i[id_depart_com]";
    $res = mysqli_query($con, $q);
    while ($i = mysqli_fetch_array($res)) {
      echo "<table class='table table-hover tablesorter ' id='tbl' style='margin: bottom 10px ;'>
    <tbody>
    ";

      echo "<tr>
  <td><img id='pic' src='../product_images/$i[product_image]' width='70px' height='70px'></td>
                  <td>
                  $i[product_title]
                  </td>
                  <td>$i[price]</td>
                  
                  </tr>";
    }


    echo "</tbody></table >";
  }
  if (mysqli_num_rows($result) == 0) {
    echo "<h5 class='card-text text-center'>لا يوجد منتجات</h5>";
  }
}
// selects products based on their department ID. It does this by running a query against the product table and fetching the results one by one.
//The function uses the mysqli_query() function to run the query and mysqli_fetch_array() to fetch each result as an array. It then echoes the product_title field of each product.
//This function could be used to display a list of products in a specific department on a website.
function getPro_by_departID($con, $departID)
{
  $q = "SELECT * FROM `product` WHERE id_depart_com=$departID";
  $res = mysqli_query($con, $q);
  while ($i = mysqli_fetch_array($res)) {
    echo "<h5 class='card-title'> $i[product_title]</h5>";
  }
}


function get_subdepartment($con, $depart_id)
{
  $sql = mysqli_query($con, "SELECT * FROM `categories` WHERE depart_id=$depart_id");

  if (mysqli_num_rows($sql) > 0) {
    while ($r = mysqli_fetch_array($sql)) {
      //all_department.php?delete&id=

      echo "
    
    <li class='list-group-item d-flex justify-content-between align-items-center'>
      <p id='dname'> $r[cat_title]</p>
      <p id='depart_id' style='visibility:hidden;'> $r[depart_id]</p>
    
       <p class='h6' ><a href='getCat.php?delete&cat_id=$r[cat_id]' id='deleteCat'><span class='badge bg-danger'>حذف</span></a></p>
      </li>
    
    ";
    }
  } else { ?>

<div class="container ">
    <div class="container-fluid">
        <p class="text_center h5" text-center>لا يوجد أقسام فرعية </p>;
    </div>


</div>
</ul>
</div>

<?php
  }
}
?>