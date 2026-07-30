 <?php require_once "./db.php"; ?>
 <?php
  $sql = "SELECT * FROM discover";
  $stmt_old = $pdo->prepare($sql);
  $stmt_old->execute();
  $discover = $stmt_old->fetch(PDO::FETCH_ASSOC);
  ?>

 <section class="discover">
   <div class="container">
     <div class="discover__content">
       <div class="discover-row">
         <div class="discover-row__info">
           <div class="discover__subtitle"><?= $discover['subtitle'] ?></div>
           <div>
             <h3 class="discover__title"><?= $discover['title'] ?></h3>
           </div>
           <div class="discover-txt">
             <p class="discover__text"><?= $discover['text'] ?></p>

             <!-- If we need pagination -->
             <div class="swiper-pagination"></div>

           </div><!--discover-txt-->
         </div><!--discover-row__info-->

         <div class="swiper">
           <!-- Additional required wrapper -->
           <div class="swiper-wrapper">
             <!-- Slides -->
             <div class="swiper-slide"><img src="./image/discover/<?= $discover['slide_1'] ?>" alt="06"></div>
             <div class="swiper-slide"><img src="./image/discover/<?= $discover['slide_2'] ?>"alt="05"></div>
             <div class="swiper-slide"><img src="./image/discover/<?= $discover['slide_3'] ?>" alt="04"></div>
           </div>
         </div><!--swiper-->

       </div><!--discover-row-->
     </div><!--discover__content-->
   </div><!--container-->
 </section>