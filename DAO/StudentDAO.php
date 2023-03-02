<?php

namespace DAO;

use DAO\IViews as IViews;
use Models\Student as Student;
use \Exception as Exception;
use Models\Career;

class StudentDAO implements IViews
{
    private $studentList;

    private $connection;
    private $tableName = "student";


    private function retriveData()
    {
        $opt = array(
            "http" => array(
                "method" => "GET",
                "header" => "x-api-key: 4f3bceed-50ba-4461-a910-518598664c08\r\n"
            )
        );

        $ctx = stream_context_create($opt);

        $json = file_get_contents("https://utn-students-api.herokuapp.com/api/Student", false, $ctx);

        $valuesArray = json_decode($json, true);


        $this->studentList=$valuesArray;

       
    }
    
public function checkApi()
{
    $this->retriveData();
  return  $this->studentList;
   
}

    public function Add($student)
    {
    
         
        try {
                    $query = "INSERT INTO " . $this->tableName . " (studentId, careerId, firstName,lastName,dni,fileNumber,gender,birthDate,email,phoneNumber,activo,password ) VALUES (:studentId,:careerId, :firstName,:lastName,:dni,:fileNumber,:gender,:birthDate,:email,:phoneNumber,:activo,:password);";
                    $valuesArray["studentId"] = $student->getStudentId();
                    $valuesArray["careerId"] = $student->getCareer()->getCareerId();
                    $valuesArray["firstName"] = $student->getFirstName();
                    $valuesArray["lastName"] = $student->getLastName();
                    $valuesArray["dni"] = $student->getDni();
                    $valuesArray["fileNumber"] = $student->getFileNumber();
                    $valuesArray["gender"] = $student->getGender();
                    $valuesArray["birthDate"] = $student->getBirthDate();
                    $valuesArray["email"] = $student->getEmail();
                    $valuesArray["phoneNumber"] = $student->getPhoneNumber();
                    $valuesArray["activo"] = $student->getActivo();
                    $valuesArray["password"] = $student->getPassword(); 
                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $valuesArray);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
  

    public function GetByStudentId($studentId)
    {
      
        try {
            $student = NULL;
            
            $query = "SELECT * FROM .$this->tableName WHERE studentId = '$studentId'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if ($resultSet) {
                $student=$this->setData($resultSet);
            }

            return $student;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }




    public function GetByEmail($email)
    {
       
        try {
            $student=0;
            
            $query = "SELECT * FROM .$this->tableName WHERE email = '$email'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if ($resultSet) {
                $student=$this->setData($resultSet);
            }

            return $student;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }

    
    public function   setData($resultSet)
    {
        $student = new Student();

                $student->setStudentId($resultSet[0]["studentId"]);

                $careers = new CareerDAO();
                $career = $careers->GetId($resultSet[0]["careerId"]);
                $student->setCareer($career);

                $student->setFirstName($resultSet[0]["firstName"]);
                $student->setLastName($resultSet[0]["lastName"]);
                $student->setDni($resultSet[0]["dni"]);
                $student->setFileNumber($resultSet[0]["fileNumber"]);
                $student->setGender($resultSet[0]["gender"]);
                $student->setBirthDate($resultSet[0]["birthDate"]);
                $student->setEmail($resultSet[0]["email"]);
                $student->setPhoneNumber($resultSet[0]["phoneNumber"]);
                $student->setActivo($resultSet[0]["activo"]);
                $student->setPassword($resultSet[0]["password"]);
        return $student;
    }



    public function GetAll()
    {
        try {
            $studentList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $valuesArray) {
                $student = new Student();

                $student->setStudentId($valuesArray["studentId"]);

                $careers = new CareerDAO();
                $career = $careers->GetId($valuesArray["careerId"]);
                $student->setCareer($career);

                $student->setFirstName($valuesArray["firstName"]);
                $student->setLastName($valuesArray["lastName"]);
                $student->setDni($valuesArray["dni"]);
                $student->setFileNumber($valuesArray["fileNumber"]);
                $student->setGender($valuesArray["gender"]);
                $student->setBirthDate($valuesArray["birthDate"]);
                $student->setEmail($valuesArray["email"]);
                $student->setPhoneNumber($valuesArray["phoneNumber"]);
                $student->setActivo($valuesArray["activo"]);
                $student->setPassword($valuesArray["password"]);

                array_push($studentList, $student);
            }

            return $studentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    
    public function addCv($studentId,$url,$fileName)
    {  
        $this->connection = Connection::GetInstance();
        
        $consulta= "UPDATE $this->tableName
        SET url = '$url', fileName = '$fileName' 
        WHERE studentId = '$studentId'";
        $connection = $this->connection;
        $connection->Execute($consulta);
    
    }
  



    public function GetByNotNull()
    {
        try {
            $studentList = array();


            $query = "SELECT * FROM .$this->tableName  WHERE url != NULL || url !='' ";
            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $valuesArray) {
                $student = new Student();

                $student->setStudentId($valuesArray["studentId"]);
                $student->setFileName($valuesArray["fileName"]);
                $student->setFirstName($valuesArray["firstName"]);
                $student->setLastName($valuesArray["lastName"]);
                $student->setUrl($valuesArray["url"]);
              
                array_push($studentList, $student);
            }

            return $studentList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
