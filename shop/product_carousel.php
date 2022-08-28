 <section class="py-5">
     <div class="container">
         <div class="row text-left p-2 pb-3">
             <h4>Kapcsolódó termékek</h4>
         </div>

         <!--Start Carousel Wrapper-->
         <div class="card-group row" id="carousel-related-product">
             <?php
                require('./config.php');

                $db = $dbname;

                $sql = "SELECT COUNT(t_id) FROM `$db`.`turbina`";
                $eredmeny = mysqli_query($conn, $sql);
                $sor = mysqli_fetch_array($eredmeny);
                $mennyi = $sor[0];

                $tomb = [];
                $set  = array_unique($tomb);

                while (count($set) < 12) {
                    $tomb[] = rand(1, $mennyi);
                    $set  = array_unique($tomb);
                }

                foreach ($set as $szamok) {
                    $sql2 = "SELECT  turbina.t_id, turbina.nev, category.kat_nev1, category.kat_nev2, images.path, images.alt, arak.ar 
                    FROM (((`$db`.`turbina` 
                    INNER JOIN category ON turbina.kat=category.kat_id)
                    INNER JOIN images ON turbina.t_id=images.t_id)
                    INNER JOIN arak ON turbina.t_id=arak.t_id)
                    WHERE turbina.t_id = $szamok AND images.alap =1;";

                    $result = mysqli_query($conn, $sql2);
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>

                     <!-- iTT KEZDŐDIK A CIKLUS-->
                     <div class="p-2 pb-3 h-100">
                         <div class="product-wap rounded-0 card h-100">
                             <form action="shop-single.php" method="POST">
                                 <input type="hidden" name="azonosit" value="<?php print($row["t_id"]); ?>">
                                 <div class="card rounded-0">
                                     <img class="card-img rounded-0 img-fluid" src="./assets/product/<?php print($row["path"]); ?>" alt="<?php print($row["alt"]); ?>">
                                     <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                         <ul class="list-unstyled">
                                             <li><button type="submit" class="btn btn-success text-white mt-2"><i class="far fa-eye"></i></button></li>
                                         </ul>
                                     </div>
                                 </div>
                                 <div class="card-body">
                                     <button class="btn btn-success fs-5 text-white mb-2"><?php print($row["nev"]); ?></button>
                                     <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                         <li><?php print($row["kat_nev1"] . '<br>' . $row["kat_nev2"]); ?></li>
                                     </ul>
                                     <ul class="list-unstyled d-flex justify-content-center mb-1">
                                         <li>
                                             <i class="text-warning fa fa-star"></i>
                                             <?php
                                                $star = rand(1, 5);
                                                for ($i = 1; $i < $star; $i++) {
                                                    echo '<i class="text-warning fa fa-star"></i>';
                                                }
                                                for ($j = 1; $j < (6 - $star); $j++) {
                                                    echo '<i class="text-muted fa fa-star"></i>';
                                                }
                                                ?>
                                         </li>
                                     </ul>
                                     <p class="text-center mb-0"><?php print (number_format(($row["ar"]), 0, ', ', ' ')) . '&#8364;'; ?></p>
                                 </div>
                             </form>
                         </div>
                     </div>

             <?php
                    }
                }
                ?>
             <!--EDDIG CIKLUS-->

         </div>
     </div>
 </section>