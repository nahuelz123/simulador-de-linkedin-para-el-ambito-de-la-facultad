<?php

namespace Controllers;

use DAO\StudentDAO as StudentDAO;
use DAO\AdminDAO as AdminDAO;
use DAO\CompanyDAO;


class SessionController
{
  private $studentDAO;
  private $adminDAO;
  private $companyDAO;

  public function __construct()
  {
    $this->studentDAO = new StudentDAO();
    $this->adminDAO = new AdminDAO();
    $this->companyDAO = new CompanyDAO();
  }
 

  public function comprobarApi($email)
  {
    $students = $this->studentDAO->checkApi();

    foreach ($students as $student) {

      if ($student["email"] == $email) {
        if ($student["active"] == true) {
          $_SESSION['email']=$email;
          ?>
        <script type="text/javascript">
            alert("registrarse!");
        </script>
        <?php
        $this->ShowLogin();
          
        }
      }
    }

    if (is_null($_SESSION['email'])) {
 
      ?>
      <script type="text/javascript">
          alert("su datos no son validos o no se encuentra registrado en el sistema  , comuniquese con la facultad!");
      </script>
      <?php
      $this->ShowLogin();
    }
  }



public function ShowLogin()
{
  require_once(VIEWS_PATH."login.php");
}


  /************prueba de login nueva ****************************/
  public function Login($email, $password)
  {

    $student = $this->studentDAO->GetByEmail($email);
    $admin = $this->adminDAO->GetByEmail($email);
    $company = $this->companyDAO->GetByEmail($email);
    $homeController=new HomeController();

    if ( $student) {

      if ($password == $student->getPassword() && $student->getActivo() == true) {

        $_SESSION['email'] = $email;
        $_SESSION["user"] = "student";
        
        $homeController->index();
      } else {
        session_destroy();
        ?>
        <script type="text/javascript">
            alert("password incorrecta!");
        </script>
        <?php      
      $this->ShowLogin();

      }
    }


   else if ($company) {
      if ($password == $company->getPassword()) {

        $_SESSION['email'] = $email;
        $_SESSION["user"] = "company";

        $homeController->index();
      } else {
        session_destroy();
        ?>
        <script type="text/javascript">
            alert("password incorrecta!");
        </script>
        <?php
        $this->ShowLogin();
      }
    }




   else  if ($admin) {
       
     if ($password == $admin->getPassword()) {

        $_SESSION['email'] = $email;
        $_SESSION["user"] = "admin";

     
        
        $homeController->index();
      } else {
        session_destroy();
        ?>
        <script type="text/javascript">
            alert("password incorrecta!");
        </script>
        <?php
        $this->ShowLogin();
      }
    }

   else if (is_null($_SESSION['email'])) {
      $this->comprobarApi($email);
    }
  }




  public function logout()
  {
    session_start();
    session_destroy();
    header("location: ../index.php");
  }


 
}
