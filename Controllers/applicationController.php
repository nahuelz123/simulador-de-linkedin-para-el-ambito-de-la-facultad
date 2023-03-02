<?php

namespace Controllers;

use DAO\ApplicationsDAO as ApplicationsDAO;
use DAO\JobOfertDAO as JobOfertDAO;
use DAO\StudentDAO as StudentDAO;
use Models\Applications;
use Controllers\MailController;
use Models\JobOfert;

class ApplicationController
{
    private $studentDAO;
    private $jobOferDAO;
    private $applicationDAO;

    public function __construct()
    {
        $this->studentDAO = new StudentDAO();
        $this->jobOferDAO = new JobOfertDAO();
        $this->applicationDAO = new ApplicationsDAO();
    }


    public function deleteApplication($id_JobOfert)
    {
        $student = $this->studentDAO->GetByEmail($_SESSION["email"]);

        if ($student) {
            $this->applicationDAO->delete($student->getStudentId(), $id_JobOfert);
            
        ?>
        <script type="text/javascript">
            alert("baja exitosa!");
        </script>
    <?php
            $this->listarApplication();
        }
    }




    public function applicationNew($jobOfertId)
    {

        $student = $this->studentDAO->GetByEmail($_SESSION['email']);

        $application = $this->applicationDAO->GetAplication($jobOfertId, $student->getStudentId());


        if (!$application) {
            $applica = new Applications();
            $applica->setStudent($student);
            $jobOfer = new JobOfert();
            $jobOfer = $this->jobOferDAO->GetByIdOfert($jobOfertId);
            $applica->setJobOfert($jobOfer);

            $this->applicationDAO->Add($applica);
?>
            <script type="text/javascript">
                alert("Aplicación exitosa!");
            </script>
        <?php
            $aux = new OfertController();
            $aux->ShowListJobOferView();
        } else {

        ?>
            <script type="text/javascript">
                alert("ya aplico en esta oferta!");
            </script>
        <?php
            $aux = new OfertController();
            $aux->ShowListJobOferView();
        }
    }





    public function showListApplication($jobApplication)
    {

        require_once(VIEWS_PATH . "listApplication.php");
    }




    public function listarApplication()
    {
        $student = $this->studentDAO->GetByEmail($_SESSION["email"]);
        $applicationList = $this->applicationDAO->GetByIdStudent($student->getStudentId());

        if ($applicationList) {
            $this->showListApplication($applicationList);
        }
    }



    public function SeeApplication($id_JobOfert)
    {

        $jobOfertList = $this->jobOferDAO->GetByIdOfert($id_JobOfert);

        if ($jobOfertList) {
            $this->ShowSeeApplicationView($jobOfertList);
        }
    }




    public function ShowSeeApplicationView($key)
    {
        require_once(VIEWS_PATH . "applicationData.php");
    }

    public function cancelarTodasPostulacion($studentId)
    {

        $applicationList = $this->applicationDAO->GetByIdStudent( $studentId);
        $student = $this->studentDAO->GetByStudentId($studentId);
        if ($applicationList) {

            $this->applicationDAO->deleteByStudent($studentId);
            if ($student) {

                $mailUser = $student->getEmail();
                $titulo = "baja job offer";
                $mensaje = "fue dado debaja de la oferta";
                $mail = new MailController();
                $mail->sendMail($mailUser, $titulo, $mensaje);
            }
            ?>
            <script type="text/javascript">
                alert("Aplicación eliminada con exito!");
            </script>
        <?php
             $aux = new StudentController();
             $aux->ShowListView();
        }else{
            ?>
            <script type="text/javascript">
                alert("no posee aplicaciones!");
            </script>
        <?php
         $aux = new StudentController();
         $aux->ShowListView();
        }
    }

    public function cancelarPostulacion($id_JobOfert, $studentId)
    {

        $applicationList = $this->applicationDAO->GetAplication($id_JobOfert, $studentId);
        $student = $this->studentDAO->GetByStudentId($studentId);
        if ($applicationList) {

            $this->applicationDAO->delete($studentId, $id_JobOfert);
            if ($student) {

                $mailUser = $student->getEmail();
                $titulo = "baja job offer";
                $mensaje = "fue dado debaja de la oferta";
                $mail = new MailController();
                $mail->sendMail($mailUser, $titulo, $mensaje);
            }
        }
    }
}
?>