<?php

namespace Controllers;

use DAO\ApplicationsDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobOfertDAO;
use Models\Company as Company;

class CompanyController
{
    private $companyDAO;
    private $jobOfertDAO;
    private $applicationDAO;

    public function __construct()
    {
        $this->companyDAO = new CompanyDAO();
        $this->jobOfertDAO = new JobOfertDAO();
        $this->applicationDAO = new ApplicationsDAO();
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "add-fromCompany.php");
    }
    public function ShowSearchView()
    {
        require_once(VIEWS_PATH . "search.php");
    }

    public function ShowModifyView($companyDate)
    {

        require_once(VIEWS_PATH . "modifyDataCompany.php");
    }

    public function ShowListView()
    {
        $companytList = $this->companyDAO->GetAll();

        require_once(VIEWS_PATH . "listCompany.php");
    }
    public function ShowDeleteView()
    {
        require_once(VIEWS_PATH . "deleteCompany.php");
    }
    public function ShowSeeView($company)
    {
        require_once(VIEWS_PATH . "companyData.php");
    }


    public function CompanyData()
    {
        require_once(VIEWS_PATH . "companyData.php");
    }

    public function NewAdd($CompanyName, $BusinessName, $CompanyAdress, $cuil, $telephone, $email, $web, $password)
    {
        $company = new Company();
        $company->setCompanyName($CompanyName);
        $company->setBusinessName($BusinessName);
        $company->setCompanyAdress($CompanyAdress);
        $company->setCuil($cuil);
        $company->setTelephone($telephone);
        $company->setEmail($email);
        $company->setWeb($web);
        $company->setPassword($password);
        return $company;
    }

    public function companyNew($CompanyName, $BusinessName, $CompanyAdress, $cuil, $telephone, $email, $web, $password)
    {
        $company = $this->companyDAO->GetExist($CompanyName, $BusinessName, $CompanyAdress, $cuil, $telephone, $email, $web);

        if ($company) {


            if ($company->getCompanyName() == $CompanyName) {
?>
                <script type="text/javascript">
                    alert("la compania con ese nombre ya existe!");
                </script>
            <?php
                $this->ShowAddView();
            }
            if ($company->getBusinessName() == $BusinessName) {
            ?>
                <script type="text/javascript">
                    alert("el  business name ya existe!");
                </script>
            <?php
                $this->ShowAddView();
            }
            if ($company->getCuil() == $cuil) {
            ?>
                <script type="text/javascript">
                    alert("el cuil ya existe !");
                </script>
            <?php
                $this->ShowAddView();
            }
            if ($company->getTelephone() == $telephone) {
            ?>
                <script type="text/javascript">
                    alert("el telephone ya existe !");
                </script>
            <?php
                $this->ShowAddView();
            }
            if ($company->getEmail() == $email) {
            ?>
                <script type="text/javascript">
                    alert("el email ya existe !");
                </script>
            <?php
                $this->ShowAddView();
            }
            if ($company->getWeb() == $web) {

            ?>
                <script type="text/javascript">
                    alert("el sitio web ya existe en el sistema  !");
                </script>
            <?php
                $this->ShowAddView();
            }
        } else {

            $company = $this->NewAdd($CompanyName, $BusinessName, $CompanyAdress, $cuil, $telephone, $email, $web, $password);

            $this->companyDAO->Add($company);
            ?>
            <script type="text/javascript">
                alert("se agrego la company con exito !");
            </script>
        <?php
            $homecontroller = new HomeController();
            $homecontroller->Index();
        }
    }



    public function CompanyMody($CompanyName, $BusinessName, $CompanyAdress, $id_company, $cuil, $telephone, $email, $web, $password)
    {

        $this->companyDAO->Modify($CompanyName, $BusinessName, $CompanyAdress, $id_company, $telephone, $email, $web, $cuil, $password);
        $this->ShowListView();
    }

    public function SearchCompany($CompanyName)
    {
    
        $company = $this->companyDAO->GetByName($CompanyName);
        if ($company) {
            $companyDate['name'] = $company->getCompanyName();
            $companyDate['busissName'] = $company->getBusinessName();
            $companyDate['adress'] = $company->getCompanyAdress();
            $companyDate['id_company'] = $company->getId_company();
            $companyDate['telephone'] = $company->getTelephone();
            $companyDate['email'] = $company->getEmail();
            $companyDate['web'] = $company->getWeb();
            $companyDate['cuil'] = $company->getCuil();
            $companyDate['password'] = $company->getPassword();
            $this->ShowModifyView($companyDate);
        } else {
          
        ?>
            <script type="text/javascript">
                alert("la compañia no existe!");
            </script>
        <?php
          $this->ShowSearchView();
        }
    }


    public function deleteSearchCompany($CompanyName)
    {

        $company = $this->companyDAO->GetByName($CompanyName);

        if ($company) {
            $jobOfertList = $this->jobOfertDAO->GetbyIdCompany($company->getId_company());
            if ($jobOfertList) {
                foreach ($jobOfertList as $jobOfert) {

                    $this->applicationDAO->deleteFromComp($jobOfert->getId_JobOfert());

                    $this->jobOfertDAO->delete($jobOfert->getId_JobOfert());
                }
            }
            $this->companyDAO->delete($company->getCompanyName());
        ?>
            <script type="text/javascript">
                alert("compañia eliminada con exito!");
            </script>
        <?php
            $this->ShowListView();
        } else {
        ?>
            <script type="text/javascript">
                alert("compañia no encontrada!");
            </script>
<?php
            $this->ShowDeleteView();
        }
    }





    public function SeeCompany($name)
    {
        $company = $this->companyDAO->GetByName($name);
        if ($company) {

            $this->ShowSeeView($company);
        }
    }




    public function Register()
    {
        require_once(VIEWS_PATH . "add-fromCompany.php");
    }



    public function showProfileCompany()
    {
        $company = $this->companyDAO->GetByEmail($_SESSION["email"]);

        require_once(VIEWS_PATH . "companyProfile.php");
    }
}
