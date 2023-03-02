<?php

namespace Controllers;

use DAO\AdminDAO;
use DAO\ApplicationsDAO;
use DAO\CompanyDAO as CompanyDAO;
use DAO\JobPositionDAO as JobPositionDAO;
use DAO\JobOfertDAO as JobOfertDAO;
use DAO\StudentDAO;
use Models\Company;
use Models\Job;
use Models\JobOfert as JobOfert;


class OfertController
{
    private $jobOfertDAO;

    private  $jobPositionDAO;
    private $companyDAO;
    private $studetDAO;
    private  $adminDAO;
    private  $applicationDAO;

    public function __construct()
    {
        $this->jobOfertDAO = new JobOfertDAO();
        $this->jobPositionDAO = new JobPositionDAO();
        $this->companyDAO = new CompanyDAO();
        $this->studetDAO = new StudentDAO();
        $this->adminDAO = new AdminDAO();
        $this->applicationDAO = new ApplicationsDAO();
    }

    public function addOfert($id_company, $jobPositionId, $cargaHoraria, $activo, $titulo, $descripcion, $imagen)
    {

        $jobPosition = $this->jobPositionDAO->GetByIdJobPosition($jobPositionId);
        $puesto = 0;

        if ($jobPosition) {
          
                $puesto = $jobPosition->getDescription();
            
        }
        $jobOfert = new JobOfert();

        $company = new Company();
        $company= $this->companyDAO->GetbyIdCompany($id_company);
        $jobOfert->setCompany($company);
        $jobOfert->setJobPosition($jobPosition);
        $jobOfert->setCargaHoraria($cargaHoraria);
        $jobOfert->setActivo($activo);
        $jobOfert->setTitulo($titulo);
        $jobOfert->setDescripcion($descripcion);
        $jobOfert->setPuesto($puesto);

        $jobOfert->setImagen($imagen);
         
        $this->jobOfertDAO->Add($jobOfert);

?>
        <script type="text/javascript">
            alert("job ofert creado!");
        </script>
        <?php
       $this->ShowADDofertchView();
    }











    public function ShowListJobOferView()
    {
        $admin = $this->adminDAO->GetByEmail($_SESSION["email"]);
        $student = $this->studetDAO->GetByEmail($_SESSION["email"]);
        $company=$this->companyDAO->GetByEmail($_SESSION["email"]);
        $jobOfertFiltro = array();
        $aux = array();
        $position = array();
        if ($admin) {
            $jobOfertFiltro = $this->jobOfertDAO->GetAll();
            foreach ($jobOfertFiltro as $filtro) {

                array_push($aux, $filtro->getPuesto());
            }
            $position = array_unique($aux);

            require_once(VIEWS_PATH . "listJobOfert.php");
        }


        if ($student) {

            $this->filtroListJobOfert($student);
        }
        if($company)
        {
            $this->verOdertas();
        }
    }


    public function filtroListJobOfert($student)
    {

        $aux = array();
        $jobPositionList = $this->jobPositionDAO->GetByCarrerId($student->getCareer()->getCareerId());

        $jobOfertFiltro = array();
        $jobOfertList = array();
        foreach ($jobPositionList as $jobPosition) {
            $jobOfertList = $this->jobOfertDAO->GetByPuesto($jobPosition->getDescription());
            foreach ($jobOfertList as $ofert) {

                array_push($jobOfertFiltro, $ofert);
            }
        }

        $position = array();
        foreach ($jobOfertFiltro as $filtro) {
            array_push($aux, $filtro->getPuesto());
        }
        
        $position = array_unique($aux);
        

        require_once(VIEWS_PATH . "listJobOfert.php");
        
    }







    public function ShowListOfer($position, $jobOfertFiltro)
    {
        require_once(VIEWS_PATH . "listJobOfert.php");
    }



    public function serachOfert($puesto)
    {

        $puesto = str_replace("-", " ", $puesto);

        $student = $this->studetDAO->GetByEmail($_SESSION["email"]);

        if ($_SESSION["user"] == "admin") {

            $jobOfertList = $this->jobOfertDAO->GetByPuesto($puesto);
            if ($jobOfertList) {
                $this->ShowSeeView($jobOfertList);
            }
        }



        if ($student) {



            $this->filtroBusqueda($puesto);
        }
    }
    public function filtroBusqueda($puesto)
    {
        $jobOfertList = $this->jobOfertDAO->GetByPuesto($puesto);

        if (isset($jobOfertList)) {

            $this->ShowSeeView($jobOfertList);
        } else {
            //PONER QUE PASA SI NO SE ENCUENTRA
        }
    }



    public function SeeOfert($id_JobOfert)
    {

        $jobOfertList = $this->jobOfertDAO->GetByIdOfert($id_JobOfert);

        if ($jobOfertList) {

            $this->ShowSeeView($jobOfertList);
        }
    }


    public function ShowSeeView($jobOferts)
    {
        require_once(VIEWS_PATH . "jobOfertData.php");
    }




    public function ShowADDofertchView()
    {
        $company= array();
        $companytList= array();
        if($_SESSION['user']=='company')
        {
            $company = $this->companyDAO->GetByEmail($_SESSION["email"]);

        }else 
        {
            $companytList= $this->companyDAO->GetAll();
        }
        $company;
        $jobPositionList = $this->jobPositionDAO->GetAll();
        require_once(VIEWS_PATH . "addOfertJob.php");
    }



    public function SearchOJobOfert($id_JobOfert)
    {

        $this->ShowModifyOferView($id_JobOfert);
    }


    public function ShowModifyOferView($id_JobOfert)
    {
       
        $companytList = $this->companyDAO->GetAll();
        $jobPositionList = $this->jobPositionDAO->GetAll();
        $jobOfertDate = array();
        $jobOfert = $this->jobOfertDAO->GetByIdOfert($id_JobOfert);
        if ($jobOfert) {
            $jobOfertDate['idCompany']= $jobOfert->getCompany()->getId_company();  
            $jobOfertDate['name'] = $jobOfert->getCompany()->getCompanyName();
            $jobOfertDate['puesto'] = $jobOfert->getPuesto();
            $jobOfertDate['cargaHoraria'] = $jobOfert->getCargaHoraria();
            $jobOfertDate['activo'] = $jobOfert->getActivo();
            $jobOfertDate['titulo'] = $jobOfert->getTitulo();
            $jobOfertDate['descripcion'] = $jobOfert->getDescripcion();
            $jobOfertDate['imagen'] = $jobOfert->getImagen();

            require_once(VIEWS_PATH . "modifyJobOfert.php");
        }
    }

    public function JobOfertMody($id_JobOfert, $id_company, $jobPositionId, $cargaHoraria, $activo, $titulo, $descripcion, $imagen)
    {
        $puestos = $this->jobPositionDAO->GetByIdJobPosition($jobPositionId);

        if ($puestos) {
            $puesto = $puestos->getDescription();
        }
        $this->jobOfertDAO->Modify($id_JobOfert, $id_company, $jobPositionId, $cargaHoraria, $activo, $titulo, $descripcion, $puesto, $imagen);
        $this->ShowListJobOferView();
    }


    public function deleteJobOfert($id_JobOfert)
    {
           
        $applicationList = $this->applicationDAO->GetByIdOfert($id_JobOfert);

        if ($applicationList) {
        
            foreach ($applicationList as $application) {
                $student = $this->studetDAO->GetByStudentId($application->getStudent()->getStudentId());
                if ($student) {

                    $mailUser = $student->getEmail();

                    $titulo = "fin job offer";
                    $mensaje = "la oferta de trabajo a finalizado, gracias por postularte";

                    $mail = new MailController();
                    $mail->sendMail($mailUser, $titulo, $mensaje);
                }
                $this->applicationDAO->deleteFromComp($id_JobOfert);
            }
            $this->jobOfertDAO->delete($id_JobOfert);
            ?>
                   <script type="text/javascript">
                        alert("oferta eliminada!");
                    </script>
                <?php
               $this->ShowListJobOferView();
        }else{
            $this->jobOfertDAO->delete($id_JobOfert);
            ?>
            <script type="text/javascript">
                alert("oferta eliminada!");
            </script>
        <?php
          $this->ShowListJobOferView();
        }
       
    }




    public function filtroListCompany($id_company)
    {
        $jobOfertList = $this->jobOfertDAO->GetbyIdCompany($id_company);

        if ($jobOfertList) {

            $this->ShowSeeView($jobOfertList);
        } else 
        {
            ?>
            <script type="text/javascript">
                alert("no posee ofertas!");
            </script>
        <?php
            $company=$this->companyDAO->GetbyIdCompany($id_company);
            $companyController = new CompanyController();
            $companyController->ShowSeeView($company);
        }
    }





    public function verPostulados($id_JobOfert)
    {
        $applicationList = $this->applicationDAO->GetByIdOfert($id_JobOfert);

        $studentList = array();

        foreach ($applicationList as $application) {
            $student = $this->studetDAO->GetByStudentId($application->getStudent()->getStudentId());
            if ($student) {
                array_push($studentList, $student);
            }
        }

        if ($studentList) {

            $this->ShowListView($studentList, $id_JobOfert);
        } else {
         
        ?>
            <script type="text/javascript">
                alert("sin postulantes actualmente!");
            </script>
<?php
            $this->ShowListJobOferView();
        }
    }



    public function ShowListView($studentList, $id_JobOfert)
    {


        require_once(VIEWS_PATH . "student-list.php");
    }







    public function verOdertas()
    {

        $company = $this->companyDAO->GetByEmail($_SESSION["email"]);
        if($company){
            $jobOfertList = $this->jobOfertDAO->GetbyIdCompany($company->getId_company());
            if($jobOfertList)
            {
                $this->ShowSeeView($jobOfertList);
            }
            else{
                ?>
                <script type="text/javascript">
                    alert("no posee ofertas!");
                </script>
            <?php
            $companyController= new CompanyController();

           $companyController->showProfileCompany();
            }

        }
       

      
    }



}
