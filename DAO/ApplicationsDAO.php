<?php

namespace DAO;

use DAO\IViews as IViews;
use Models\Applications as Applications;
use Models\Company as Company;
use \Exception as Exception;
use Models\JobOfert as JobOfert;

class ApplicationsDAO implements IViews
{
    private $Applicationslist;

    private $connection;
    private $tableName = "applications";




    public function Add($application)
    {


        try {


            $query = "INSERT INTO " . $this->tableName . " (studentId, id_JobOfert) VALUES (:studentId, :id_JobOfert);";

            $valuesArray["studentId"] = $application->getStudent()->getStudentId();

            $valuesArray["id_JobOfert"] = $application->getJobOfert()->getId_JobOfert();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $valuesArray);
        } catch (Exception $ex) {
            throw $ex;
        }
    }








    public function GetByIdStudent($idStudent)
    {

        try {
            $jobOfertList = array();

            $query = "SELECT * FROM .$this->tableName WHERE studentId = '$idStudent'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $valuesArray) {
          
                $application= $this->setData($valuesArray);
                array_push($jobOfertList, $application);
            }

            return $jobOfertList;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }



    public function GetByIdOfert($id_JobOfert)
    {

        try {
            $jobOfertList = array();

            $query = "SELECT * FROM .$this->tableName WHERE id_JobOfert = '$id_JobOfert'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $valuesArray) {
        

                $application= $this->setData($valuesArray);
                array_push($jobOfertList, $application);
            }

            return $jobOfertList;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }

    public function GetAplication($id_JobOfert, $studentId)
    {

        try {
            $application = NULL;

            $query = "SELECT * FROM .$this->tableName WHERE id_JobOfert = '$id_JobOfert' and studentId = '$studentId'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if ($resultSet) {
                $application = new Applications();
                $student = new StudentDAO();
                $stud = $student->GetByStudentId($resultSet[0]["studentId"]);
                $application->setStudent($stud);
                $jobOfert = new JobOfertDAO();
                $job = $jobOfert->GetByIdOfert($resultSet[0]["id_JobOfert"]);
                $application->setJobOfert($job);
            }

            return $application;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }



    public function   setData($valuesArray)
    {
        $application = new Applications();

        $student = new StudentDAO();
        $stud = $student->GetByStudentId($valuesArray["studentId"]);
        $application->setStudent($stud);
        $jobOfert = new JobOfertDAO();
        $job = $jobOfert->GetByIdOfert($valuesArray["id_JobOfert"]);
        $application->setJobOfert($job);
        return $application;
    }










    public function GetAll()
    {
        try {
            $jobOfertList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $valuesArray) {
                $application = new Applications();

                $application->setStudent($valuesArray["studentId"]);
                $application->setJobOfert($valuesArray["id_JobOfert"]);



                array_push($jobOfertList, $application);
            }

            return $jobOfertList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }


    public function delete($studentId, $id_JobOfert)
    {
        $this->connection = Connection::GetInstance();
        $consulta = "DELETE From applications WHERE studentId = '$studentId' and id_JobOfert='$id_JobOfert' ";
        $connection = $this->connection;
        $connection->Execute($consulta);
    }

    public function deleteByStudent($studentId)
    {
        $this->connection = Connection::GetInstance();
        $consulta = "DELETE From applications WHERE studentId = '$studentId' ";
        $connection = $this->connection;
        $connection->Execute($consulta);
    }

    public function deleteFromComp($id_JobOfert)
    {
        $this->connection = Connection::GetInstance();
        $consulta = "DELETE From applications WHERE  id_JobOfert='$id_JobOfert' ";
        $connection = $this->connection;
        $connection->Execute($consulta);
    }
}
