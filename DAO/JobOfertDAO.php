<?php
namespace DAO;

use DAO\IViews as IViews;
use DAO\Connection as Connection;
use \Exception as Exception;
use Models\JobOfert as JobOfert;

class JobOfertDAO implements IViews
{
    private $jobOfertList = array();

    private $connection;
    private $tableName = "job_ofert";


    public function Add($jobOfert)
    {

        try {


            $query = "INSERT INTO " . $this->tableName . " (id_company, jobPositionId,cargaHoraria,activo,titulo,descripcion,puesto,imagen) VALUES (:id_company, :jobPositionId,:cargaHoraria,:activo,:titulo,:descripcion,:puesto, :imagen);";

            $valuesArray["id_company"] = $jobOfert->getCompany()->getId_company();
            $valuesArray["jobPositionId"] = $jobOfert->getJobPosition()->getJobPositionId();
            $valuesArray["cargaHoraria"] = $jobOfert->getCargaHoraria();
            $valuesArray["activo"] = $jobOfert->getActivo();
            $valuesArray["titulo"] = $jobOfert->getTitulo();
            $valuesArray["descripcion"] = $jobOfert->getDescripcion();
            $valuesArray["puesto"] = $jobOfert->getPuesto();
            $valuesArray["imagen"] = $jobOfert->getImagen();
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $valuesArray);
        } catch (Exception $ex) {
            throw $ex;
        }
    }



    public function GetbyIdCompany($id_company)
    {

        try {
            $jobOfertList = array();

            $query = "SELECT * FROM .$this->tableName WHERE id_company = '$id_company'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $valuesArray) {
             
                $job= $this->setData($valuesArray);
                array_push($jobOfertList, $job);
            }

            return $jobOfertList;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }







    public function GetByIdOfert($idOfert)
    {

        try {

            $job = NULL;
            $query = "SELECT * FROM .$this->tableName WHERE id_JobOfert = '$idOfert'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if ($resultSet) {
                $job = new JobOfert();


                $job->setId_JobOfert($resultSet[0]["id_JobOfert"]);

                $company = new CompanyDAO();
                $comp = $company->GetbyIdCompany($resultSet[0]["id_company"]);
                $job->setCompany($comp);

                $jobPosition = new JobPositionDAO();
                $jobpo = $jobPosition->GetByIdJobPosition($resultSet[0]["jobPositionId"]);
                $job->setJobPosition($jobpo);

                $job->setCargaHoraria($resultSet[0]["cargaHoraria"]);
                $job->setActivo($resultSet[0]["activo"]);
                $job->setTitulo($resultSet[0]["titulo"]);
                $job->setDescripcion($resultSet[0]["descripcion"]);
                $job->setPuesto($resultSet[0]["puesto"]);
                $job->setImagen($resultSet[0]["imagen"]);
            }

            return $job;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }



    public function GetByPuesto($puesto)
    {
        $jobOfertList = array();
        try {


            $query = "SELECT * FROM .$this->tableName WHERE puesto = '$puesto'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $valuesArray) {
             
                $job= $this->setData($valuesArray);
                array_push($jobOfertList, $job);
            }

            return $jobOfertList;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }


    public function   setData($valuesArray)
    {
        $job = new JobOfert();
        $job->setId_JobOfert($valuesArray["id_JobOfert"]);
        $company = new CompanyDAO();
        $comp = $company->GetbyIdCompany($valuesArray["id_company"]);
        $job->setCompany($comp);

        $jobPosition = new JobPositionDAO();
        $jobpo = $jobPosition->GetByIdJobPosition($valuesArray["jobPositionId"]);
        $job->setJobPosition($jobpo);

        $job->setCargaHoraria($valuesArray["cargaHoraria"]);
        $job->setActivo($valuesArray["activo"]);
        $job->setTitulo($valuesArray["titulo"]);
        $job->setDescripcion($valuesArray["descripcion"]);
        $job->setPuesto($valuesArray["puesto"]);
        $job->setImagen($valuesArray["imagen"]);
        return $job;
    }







    public function GetAll()
    {
        try {
            $jobOfertList = array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $valuesArray) {
                $job = new JobOfert();


                $job->setId_JobOfert($valuesArray["id_JobOfert"]);

                $company = new CompanyDAO();
                $comp = $company->GetbyIdCompany($valuesArray["id_company"]);
                $job->setCompany($comp);

                $jobPosition = new JobPositionDAO();
                $jobpo = $jobPosition->GetByIdJobPosition($valuesArray["jobPositionId"]);
                $job->setJobPosition($jobpo);


                $job->setCargaHoraria($valuesArray["cargaHoraria"]);
                $job->setActivo($valuesArray["activo"]);
                $job->setTitulo($valuesArray["titulo"]);
                $job->setDescripcion($valuesArray["descripcion"]);
                $job->setPuesto($valuesArray["puesto"]);
                $job->setImagen($valuesArray["imagen"]);
                array_push($jobOfertList, $job);
            }

            return $jobOfertList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Modify($id_JobOfert, $id_company, $jobPositionId, $cargaHoraria, $activo, $titulo, $descripcion, $puesto, $imagen)
    {


        $this->connection = Connection::GetInstance();

        $consulta = "UPDATE job_ofert
        SET id_company = '$id_company', jobPositionId = '$jobPositionId', cargaHoraria  = '$cargaHoraria',activo = '$activo', titulo = '$titulo', descripcion = '$descripcion', puesto = '$puesto', imagen = '$imagen'
        WHERE id_JobOfert = '$id_JobOfert'";
        $connection = $this->connection;
        $connection->Execute($consulta);
    }

    public function delete($id_JobOfert)
    {
        $this->connection = Connection::GetInstance();
        $consulta = "DELETE From job_ofert WHERE id_JobOfert = '$id_JobOfert'";
        $connection = $this->connection;
        $connection->Execute($consulta);
    }
}
