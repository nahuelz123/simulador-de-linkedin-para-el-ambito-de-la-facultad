<?php
namespace Controllers;

use DAO\AdminDAO as AdminDAO;
use Models\Admin;


class UserController
{

    private $AdminDAO;
    public function __construct()
    {
        $this->AdminDAO = new AdminDAO();
    }

    public function ShowUserAdminView()
    {
        require_once(VIEWS_PATH . "addUserAdmin.php");
    }

    public function AddAdmin($email, $password)
    {
        $admin = $this->AdminDAO->GetByEmail($email);
        if( $admin)
        {
            ?>
            <script type="text/javascript">
                alert("el usuario ya se encuentra registrado!");
            </script>
          <?php
          $this->ShowUserAdminView();
        }else{
            $newAdmin = new Admin();
            $newAdmin->setEmail($email);
            $newAdmin->setPassword($password);
    
            $this->AdminDAO->Add($newAdmin);
            ?>
            <script type="text/javascript">
                alert("admin agregado con exito!");
            </script>
          <?php
          $this->ShowUserAdminView();
        }
    }

}
