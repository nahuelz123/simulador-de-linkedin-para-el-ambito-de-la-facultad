<main class="py-5">
     <section id="listado" class="mb-5">
          <form action=<?php echo FRONT_ROOT ?>Company\CompanyMody method="POST">
               <div class="container">
                    <h3 class="mb-3">Edit Company</h3>


                    <div class="mb-3">

                         <label for="CompanyName">Name</label>
                         <input type="text" name="CompanyName" class="form-control form-control-ml" value="<?php echo $companyDate["name"] ?>" placeholder="name" required>

                    </div>

                    <div class="mb-3">
                         <label for="BusinessName">Business Name</label>
                         <input type="text" name="BusinessName" class="form-control form-control-ml" value="<?php echo $companyDate["busissName"] ?>" placeholder="business name" required>
                    </div>
                    <div class="mb-3">
                         <label for="CompanyAdress">Address</label>
                         <input type="text" name="CompanyAdress" class="form-control form-control-ml" value="<?php echo $companyDate["adress"] ?>" placeholder="user" required>
                         <input type=hidden value=<?= $companyDate["id_company"] ?> name="id_company">
                         </div>
                         <div class="mb-3">
                              <label for="cuil">Cuil</label>
                              <input type="text" name="cuil" class="form-control form-control-ml" value="<?php echo $companyDate["cuil"] ?>" placeholder="Cuil" required>
                         </div>
                         <div class="mb-3">
                              <label for="telephone">Telephone</label>
                              <input type="text" name="telephone" class="form-control form-control-ml" value="<?php echo $companyDate["telephone"] ?>" placeholder="telephone" required>
                         </div>
                         <div class="mb-3">
                              <label for="email">E-mail</label>
                              <input type="email" name="email" class="form-control form-control-ml" value="<?php echo $companyDate["email"] ?>" placeholder="email" required>
                         </div>
                         <div class="mb-3">
                              <label for="web">Web</label>
                              <input type="text" name="web" class="form-control form-control-ml" value="<?php echo $companyDate["web"] ?>" placeholder="web" required>
                         </div>

                         <input type=hidden value=<?= $companyDate["password"] ?> name="password">

                         <div class="mb-3">
                              <button type="submit" name="" class="btn btn-primary ml-auto d-block">Modify Company</button>
                         </div>
               </div>
          </form>


     </section>
</main>