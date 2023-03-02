<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Job offers list</h2>

               <table class="table bg-light">
                    <thead class="bg-dark text-white">
                         <?php

                       

                         if (is_object($jobOferts)) {?>
                              <li>Title: <?php echo $jobOferts->getTitulo(); ?> </li>
                              <li>Workload: <?php echo $jobOferts->getCargaHoraria(); ?> </ñ>
                              <li>Position: <?php echo $jobOferts->getPuesto(); ?> </li>
                              <li>Description: <?php echo $jobOferts->getDescripcion(); ?> </li>
                              <?php if ($jobOferts->getImagen() != NULL) { ?>
                                   <dl align="center"><?php echo '<img src="../Data/image/' . $jobOferts->getImagen() . '"/>'; ?> </dl>
                              <?php } ?>
                              <br>
                              <br>
                              <?php
                              $id_JobOfert = $jobOferts->getId_JobOfert();
                              if (($_SESSION["user"] == "admin") || ($_SESSION["user"] == "company")) {

                              ?>
                                   <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Ofert\SearchOJobOfert?id_JobOfert=<?php echo $id_JobOfert ?>role="button">Modify</a>
                                   <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Ofert\deleteJobOfert?id_JobOfert=<?php echo $id_JobOfert ?> role="button">Delete</a>
                                   <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Ofert\verPostulados?id_JobOfert=<?php echo $id_JobOfert ?> role="button">Postulate List</a>
                              <?php
                              } else {
                              ?>
                                   <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Application\applicationNew?id_JobOfert=<?php echo $id_JobOfert ?> role="button">Postulate</a>
                              <?php
                              }
                              ?>
                         <?php }else{

                    
                          foreach ($jobOferts as $value) {?>
                              <li>Title: <?php echo $value->getTitulo(); ?> </li>
                              <li>Workload: <?php echo $value->getCargaHoraria(); ?> </ñ>
                              <li>Position: <?php echo $value->getPuesto(); ?> </li>
                              <li>Description: <?php echo $value->getDescripcion(); ?> </li>
                              <?php if ($value->getImagen() != NULL) { ?>
                                   <dl align="center"><?php echo '<img src="../Data/image/' . $value->getImagen() . '"/>'; ?> </dl>
                              <?php } ?>
                              <br>
                              <br>
                              <?php
                              $id_JobOfert = $value->getId_JobOfert();
                              if (($_SESSION["user"] == "admin") || ($_SESSION["user"] == "company")) {

                              ?>
                                   <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Ofert\SearchOJobOfert?id_JobOfert=<?php echo $id_JobOfert ?>role="button">Modify</a>
                                   <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Ofert\deleteJobOfert?id_JobOfert=<?php echo $id_JobOfert ?> role="button">Delete</a>
                                   <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Ofert\verPostulados?id_JobOfert=<?php echo $id_JobOfert ?> role="button">Postulate List</a>
                              <?php
                              } else {
                              ?>
                                   <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Application\applicationNew?id_JobOfert=<?php echo $id_JobOfert ?> role="button">Postulate</a>
                              <?php
                              }
                              ?>
                         <?php }
                         }

                         ?>

                    </thead>

               </table>

          </div>
     </section>

</main>