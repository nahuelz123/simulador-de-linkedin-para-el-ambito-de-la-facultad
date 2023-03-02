
<main class="py-5">
<section id="listado" class="mb-5">
     <div class="container">
          <h3 class="mb-3">CVs</h3>
          <div>
          <table border='1'>
          <?php
     
        foreach($url as $archivo){
            $file=$archivo->getUrl();
            $rutaDescarga = "../".$file;
            $fileName = $archivo->getFirstName().' '.$archivo->getLastName().' '. $archivo->getFileName();
        ?>  
        <tr>
        
            <td>
               <?php  echo $archivo->getFileName()."<br>" ;?>
            </td>
            <td>
               <?php echo  $archivo->getFirstName().' '.$archivo->getLastName() ;?>
            </td>
            <td>

           <td> <a href="<?php  echo $rutaDescarga ?>"download="<?php echo $fileName ;?>">descargar</a></td> 
           

          </td>
        </tr>
        <?php }?>
      </table>
          <div class="mb-3">
         
     </div>
</section>
</main>