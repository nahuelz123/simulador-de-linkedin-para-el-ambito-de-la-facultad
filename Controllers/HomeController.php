<?php
    namespace Controllers;

    use DAO\AdminDAO as AdminDAO;
use DAO\StudentDAO as StudentDAO;
use DAO\CompanyDAO as CompanyDAO;
class HomeController
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
        public function Index($alert="")
        {
            $admin=$this->adminDAO->GetByEmail($_SESSION["email"]);
            $student=$this->studentDAO->GetByEmail($_SESSION["email"]);
            $company=$this->companyDAO->GetByEmail($_SESSION["email"]);
           
            if($admin)
            {
                
              
                 $companyController= new CompanyController();
                 require_once(VIEWS_PATH . "navAdmin.php");
                 $companyController->ShowListView();
                
            }
            if($student)
            {

                    $student;
                    require_once(VIEWS_PATH . "nav.php");
                 require_once(VIEWS_PATH."student-profile.php");
                
            }
            if($company )
            {
               
                require_once(VIEWS_PATH . "navCompany.php");
                    $company;
                 require_once(VIEWS_PATH."companyProfile.php");
            
            }

        if(is_null($_SESSION["email"])) {

            require_once(VIEWS_PATH."login.php");
           }
        }        
    }
?>