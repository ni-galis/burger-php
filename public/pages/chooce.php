 <?php require_once "./db.php"; ?>
 <?php
  $sql = "SELECT * FROM chooce";
  $sql = $pdo->prepare($sql);
  $sql->execute();
  $chooce = $sql->fetch(PDO::FETCH_ASSOC);
  ?>

 <style>
   .choce__top {
     text-align: center;
   }

   .chooce__subtitle {
     margin-top: 19px;
   }

   .subtitle-img {
     max-width: 100%;
   }

   .choce-title {
     font-size: 50px;
     font-family: "Alfa Slab One";
     color: rgb(61, 37, 20);
     text-transform: uppercase;
     line-height: 0.75;
     margin-top: 44px;
   }
 </style>
 <section class="choce">
   <div class="container">
     <div class="chooce__content">
       <div class="choce__top">
         <div class="chooce__subtitle">
           <img class="subtitle-img" src="./image/choose/<?= $chooce['subtitle'] ?>" alt="pic4">
         </div>
         <h2 class="choce-title"><?= $chooce['title'] ?></h2>
         <div class="choce__suptitle">
           <p class="suptitle-txt">
             <?= $chooce['suptitle'] ?>"
           </p>
         </div><!--choce__suptitle-->
       </div><!--choce__top-->

       <div class="chooce__inner">
         <div class="inner-row">

           <?php
            $sql = "SELECT * FROM chooce";
            $sql = $pdo->prepare($sql);
            $sql->execute();
            $chooce = $sql->fetchAll(PDO::FETCH_ASSOC);
            ?>

           <?php foreach ($chooce as $el) : ?>

             <div class="inner-row__column">
               <img class="column-img" src="./image/choose/<?= $el["filename"] ?>" alt="pic1">
               <div class="shadow">
                 <img сlass="shadow-img" src="./image/choose/<?= $el["shadow"] ?>" alt="pic7">
               </div>
               <h4 class="column-title1 column-title"><?= $el["column_title"] ?></h4>
               <div class="column__suptitle1 column__suptitle">
                 <?= $el["column_suptitle"] ?>
               </div>
               <div class="column__order">
                 <img class="order-img1 order-img" src="./image/choose/<?= $el["column_order"] ?>" alt="pic5">
               </div>
             </div><!--inner-row__column-->
           <?php endforeach ?>
         </div><!--inner-row-->
       </div>
     </div><!--chooce__content-->
   </div><!--container-->
 </section>