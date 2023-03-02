<?php

namespace Controllers;

use DAO\ApplicationsDAO;
use DAO\CareerDAO;
use DAO\JobOfertDAO;
use DAO\JobPositionDAO;
use DAO\StudentDAO as StudentDAO;

use Models\Student as Student;


use \Exception as Exception;


class StudentController
{
    private $studentDAO;
    private $applicationDAO;
 

    public function __construct()
    {
        $this->studentDAO = new StudentDAO();
      
        $this->applicationDAO = new ApplicationsDAO();
      
    }

    public function ShowAddView()
    {
        require_once(VIEWS_PATH . "student-add.php");
    }

    public function ShowListView()
    {
        $studentList = $this->studentDAO->GetAll();

        require_once(VIEWS_PATH . "student-list.php");
    }

    public function crearCareer()
    {
        $careertList = new CareerDAO();

        $careertList->createCarrer();
    }
    public function crearJob()
    {
        $jobList = new JobPositionDAO();

        $jobList->createJob();
    }


    public function AddNew($email, $password)
    {
        $homecontroller= new HomeController();
        $student = $this->studentDAO->GetByEmail($email);
        $newStudent = 0;

        if ($student) {
            if ($student->getEmail() == $email) {
?>
                <script type="text/javascript">
                    alert("ya existe en el sistema!");
                </script>
            <?php
                $this->Register();
            }
        } else {
            $students = $this->studentDAO->checkApi();


            foreach ($students as $student) {

                if (($student['email'] == $email)) {


                    $newStudent = new Student();

                    $newStudent->setStudentId($student["studentId"]);
                    $newStudent->setCareerId($student["careerId"]);
                    $newStudent->setFirstName($student["firstName"]);
                    $newStudent->setLastName($student["lastName"]);
                    $newStudent->setDni($student["dni"]);
                    $newStudent->setFileNumber($student["fileNumber"]);
                    $newStudent->setGender($student["gender"]);
                    $newStudent->setBirthDate($student["birthDate"]);
                    $newStudent->setEmail($student["email"]);
                    $newStudent->setPhoneNumber($student["phoneNumber"]);
                    $newStudent->setActivo($student["active"]);
                    $newStudent->setPassword($password);
                    $this->studentDAO->Add($newStudent);
                   
                    ?>
                    <script type="text/javascript">
                        alert("registro exitoso!");
                    </script>
                <?php
                $homecontroller->Index();
                }
            }
            if ($newStudent == 0) {
              
                ?>
                <script type="text/javascript">
                    alert("no se encuentra registrado en el sistema , comuniquese con la facultad!");
                </script>
            <?php
            $homecontroller->Index();
            }
        }
    }

    public function Profile()
    {
        $student = $this->studentDAO->GetByEmail($_SESSION["email"]);
        require_once(VIEWS_PATH . "student-profile.php");
    }

    public function Register()
    {
        require_once(VIEWS_PATH . "addStudent.php");
    }




    public function ObtenerPdf()
    {

        $studentList = $this->studentDAO->GetAll();
        $applicationList = array();

        $studentPost = array();
        foreach ($studentList as $student) {
            $applicationList = $this->applicationDAO->GetByIdStudent($student->getStudentId());
            if ($applicationList) {
                array_push($studentPost, $student);
            }
        }
        if ($studentPost) {
            $this->showPdf($studentPost);
        } else {
            ?> <script type="text/javascript">
                alert("no aplicaron estudiantes a las ofertas!");
            </script> <?php
                    }
                }


                public function showPdf($postulaciones)
                {
                    require_once("pdf/crearPdf.php");
                }




                public function subirCv()
                {
                    try {

                        $directorio = "upload/";

                        $url = $directorio . $_FILES["archivo"]['name'];
                        $fileName = $_FILES["archivo"]['name'];
                        if (file_exists($_FILES['archivo']['tmp_name'])) {
                            if (move_uploaded_file($_FILES['archivo']['tmp_name'], $url)) {

                                $student = $this->studentDAO->GetByEmail($_SESSION["email"]);

                                $this->studentDAO->addCv($student->getStudentId(), $url, $fileName);

                        ?>
                    <script type="text/javascript">
                        alert("cv subido con exito!");
                    </script>
                <?php

                                $this->Profile();
                            } else {

                ?>
                    <script type="text/javascript">
                        alert("ocurrio un error al guardar el cv!");
                    </script>
                <?php
                                $this->showAddCv();
                            }
                        } else {
                ?>
                <script type="text/javascript">
                    alert("ocurrio un error!");
                </script>
            <?php
                            $this->showAddCv();
                        }
                    } catch (Exception $e) {
            ?>
            <script type="text/javascript">
                alert("ocurrio un error al subir el cv!");
            </script>
<?php
                        $this->showAddCv();
                    }
                }



                public function showAddCv()
                {

                    require_once(VIEWS_PATH . "add-cv.php");
                }


                public function showViewCV()
                {
                    $url = $this->studentDAO->GetByNotNull();

                    require_once(VIEWS_PATH . "cv.php");
                }
            }
?>