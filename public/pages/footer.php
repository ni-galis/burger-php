 <?php require_once "./db.php"; ?>
 <?php
  // Получаем текущие данные из БД (id = 1)
  $sql = 'SELECT * FROM footer';
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $footer = $stmt->fetch(PDO::FETCH_ASSOC);
  ?>

 <footer class="footer">
   <div class="container">
     <div class="footer__content">
       <div class="footer__row" style="background: url('./image/footer/<?= $footer['filename'] ?>');">
         <div class="footer-info">
           <div class="footer-info">
             <div class="footer-info__logo">
               <img src="./image/footer/<?= $footer['logo'] ?>" alt="footer-logo">
             </div>
             <div class="footer-info__txt">
               <p class="info-text">
                <?= $footer['textarea'] ?>
               </p>
             </div>
             <div class="foooter-info__copyright">
               <span class="span-txt">
                 <?= $footer['copyright'] ?>
               </span>
             </div>
           </div>
         </div><!--footer-info-->

         <div class="footer-connection">
           <div class="connection-info">
             <div class="footer-connection__location">
               <img class="location-img" src="./image/footer/<?= $footer['location'] ?>" alt="location">
               <span class="location-txt"><?= $footer['location_text'] ?></span>
             </div>
             
             <div class="footer-connection__post">
               <img class="email-img" src="./image/footer/<?= $footer['email'] ?>" alt="email__img">
               <span class="email-txt"><?= $footer['email_address'] ?></span>
             </div>
           </div><!--connection-info-->

           <div class="footer-connection__social">
            <div class="facebook">
               <img src="./image/footer/<?= $footer['instagram'] ?>" alt="facebook">
             </div>
             <div class="facebook">
               <img src="./image/footer/<?= $footer['facebook'] ?>" alt="facebook">
             </div>
             <div class="twitter">
               <img src="./image/footer/<?= $footer['twitter'] ?>" alt="twitter">
             </div>
             <div class="whatsapp">
               <img src="./image/footer/<?= $footer['whatsapp'] ?>" alt="whatsapp">
             </div>
           </div>
         </div><!--footer-connection-->
       </div><!--footer__row-->
     </div><!--footer__content-->
   </div><!--container-->
 </footer>

 <script src="./swiper-bundle.js"></script>
 <script src="js/main.js"></script>
 </body>

 </html>