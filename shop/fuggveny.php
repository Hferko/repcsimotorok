<?php

function pager($limit, $oldal, $sorokSzama)
{
  $ossz_oldal = ceil($sorokSzama / $limit);

  echo '<div><br></div><div div="row">';
  $oldalLink = '<ul class="pagination pagination-lg justify-content-end">';
  for ($i = 1; $i <= $ossz_oldal; $i++) {

    if ($i == $oldal) {
      $oldalLink .= '<li class="page-item disabled"><a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="shop.php?oldal=' . $i . '" >' . $i . "</a></li>";
    } else {
      $oldalLink .= '<li class="page-item"><a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="shop.php?oldal=' . $i . '">' . $i . "</a></li>";
    }
  }
  echo $oldalLink . "</ul></div>";
}


function pager_kereskedelmi($limit, $oldal, $sorokSzama)
{
  $ossz_oldal = ceil($sorokSzama / $limit);

  echo '<div><br></div><div div="row">';
  $oldalLink = '<ul class="pagination pagination-lg justify-content-end">';
  for ($i = 1; $i <= $ossz_oldal; $i++) {

    if ($i == $oldal) {
      $oldalLink .= '<li class="page-item disabled"><a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="shop_com.php?oldal=' . $i . '" >' . $i . "</a></li>";
    } else {
      $oldalLink .= '<li class="page-item"><a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="shop_com.php?oldal=' . $i . '">' . $i . "</a></li>";
    }
  }
  echo $oldalLink . "</ul></div>";
}


function pager_katonai($limit, $oldal, $sorokSzama)
{
  $ossz_oldal = ceil($sorokSzama / $limit);

  echo '<div><br></div><div div="row">';
  $oldalLink = '<ul class="pagination pagination-lg justify-content-end">';
  for ($i = 1; $i <= $ossz_oldal; $i++) {

    if ($i == $oldal) {
      $oldalLink .= '<li class="page-item disabled"><a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="shop_military.php?oldal=' . $i . '" >' . $i . "</a></li>";
    } else {
      $oldalLink .= '<li class="page-item"><a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="shop_military.php?oldal=' . $i . '">' . $i . "</a></li>";
    }
  }
  echo $oldalLink . "</ul></div>";
}

function pager_ipari($limit, $oldal, $sorokSzama)
{
  $ossz_oldal = ceil($sorokSzama / $limit);

  echo '<div><br></div><div div="row">';
  $oldalLink = '<ul class="pagination pagination-lg justify-content-end">';
  for ($i = 1; $i <= $ossz_oldal; $i++) {

    if ($i == $oldal) {
      $oldalLink .= '<li class="page-item disabled"><a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="shop_indust.php?oldal=' . $i . '" >' . $i . "</a></li>";
    } else {
      $oldalLink .= '<li class="page-item"><a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="shop_indust.php?oldal=' . $i . '">' . $i . "</a></li>";
    }
  }
  echo $oldalLink . "</ul></div>";
}



function tablaRajz($ered)
{
  while ($row = mysqli_fetch_array($ered)) {
    // ellenőrzöm, hogy az adott mezőben van-e adat
    if (empty($row['kat_nev2'])) {
      $row['kat_nev2'] = '-';
    }

    if (empty($row['ar'])) {
      $row['ar'] = '0 &#8364;';
    }

    if (empty($row['gep'])) {
      $row['ig'] = 'Tupoliev';
    }
   
    echo '<div class=" col-md-4">   
    <div class="card h-100 mb-1 product-wap rounded-0">
     <form method="POST" action="shop-single.php">
      <input type="hidden" name="azonosit" value="' . $row['t_id'] . '" />
      <div class="card rounded-0">';
    echo '<img class="card-img rounded-0 img-fluid" src="./assets/product/' . $row["path"] . '" alt="' . $row["alt"] . '">';
    echo '<div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                <ul class="list-unstyled">
                  <li><button class="btn btn-success text-white mt-2"><i type="submit" class="far fa-eye"></i></button></li>      
                </ul>
              </div>
          </div>';
    echo '<div class="card-body">';
    echo '<button class="btn btn-success fs-4 text-white mt-1">' . $row["nev"] . '</button>';
    echo '<ul class="w-100 list-unstyled mb-0">';
    echo '<li class="pt-2"><span class="product-color-dot color-dot-green float-left rounded-circle ml-1">' . $row["kat_nev1"] . '</span></li>';
    echo '<li>' . $row["kat_nev2"] . '</li><hr>';
    echo '<li><i>Alkalmazása:</i></li>';
    echo '<li>' . $row["gep"] . '</li>';
    echo '<ul class="list-unstyled d-flex justify-content-center mt-1"><li>';
    echo '<i class="text-warning fa fa-star"></i>';
    $star = rand(1, 6);
    for ($i = 1; $i < $star; $i++) {
      echo '<i class="text-warning fa fa-star"></i>';
    }
    for ($j = 1; $j < (6 - $star); $j++) {
      echo '<i class="text-muted fa fa-star"></i>';
    }
    echo '</ul></li></ul>';
    echo '<p class="text-center mt-2">' . number_format(($row["ar"]), 0, ', ', ' ') . ' &#8364;</p>';
    echo '<button style="position:absolute; bottom:1px;" type="submit" style="bottom: 20px">Termék ismertető</button>';
    echo '</form></div> </div></div>';   

  }
}

