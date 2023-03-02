
<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">List company</h2>

               <table class="table bg-light">
                    <thead class="bg-dark text-white">
                 
                               
                               <li>Name:  <?php echo $company->getCompanyName()  ;?> </li>
                               <li>BusinessName:  <?php echo $company->getBusinessName() ;?> </ñ>
                               <li>Address:  <?php echo $company->getCompanyAdress() ;?> </li>
                               <li>Cuil:  <?php echo $company->getCuil() ;?> 
                               <li>Telephone:  <?php echo $company->getTelephone() ;?> </li>
                               <li>E-mail:  <?php echo $company->getEmail() ;?> </li>
                               <li>Web:  <?php echo $company->getWeb() ;?> </li>
                               <br>
      
                    </thead>

                   
               </table>
               <?php
          
          $id_company= $company->getId_company();
         
          $CompanyName= $company->getCompanyName();
          if($_SESSION["user"]=="admin"){
?>
     <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Ofert\filtroListCompany?id_company=<?php echo $id_company ?> role="button">Offer List</a>
     <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Company\SearchCompany?CompanyName=<?php echo $CompanyName ?> role="button">Modify</a>
     <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Company\deleteSearchCompany?CompanyName=<?php echo $CompanyName ?> role="button">Delete</a>
<?php
          }
?>
          </div>
     </section>

 

</main>

