 <?php require_once "./db.php"; ?>
 <?php
  $sql = "SELECT * FROM hamburger";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $hamburger = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>

 <section class="burgers">
   <div class="container">
     <div class="burger__content">
       <h2 class="visually-hidden">NAME OF BURGERS</h2>
       <div class="burger__row">

         <div class="burger-most">
           <img class="most-img" src="./image/hamburger/<?= $hamburger['filename_1'] ?>" alt="most">
         </div>

         <div class="burgers-others">
           <img class="more-img" src="./image/hamburger/<?= $hamburger['filename_2'] ?>" alt="more">

           <img class="fresh-img" src="./image/hamburger/<?= $hamburger['filename_3'] ?>" alt="fresh">
         </div>

       </div><!--burger__row-->
       </h2>
     </div>
   </div>
 </section>