<?php

namespace DAO;
use \Exception as Exception;
use DAO\IViews as IViews;
use Models\Company as Company;
use DAO\Connection as Connection;
class CompanyDAO implements IViews
{
    private $companytList = array();
  
    private $connection;
    private $tableName = "company";


public function Add($company)
{    
    try
    {
        $query = "INSERT INTO ".$this->tableName." (CompanyName, BusinessName, CompanyAdress,cuil,telephone,email,web,password ) VALUES (:CompanyName, :BusinessName, :CompanyAdress,:cuil,:telephone,:email,:web,:password);";
    
        $valuesArray["CompanyName"] = $company->getCompanyName();
        $valuesArray["BusinessName"] = $company->getBusinessName();
        $valuesArray["CompanyAdress"] = $company->getCompanyAdress();
        $valuesArray["cuil"]=$company->getCuil();
        $valuesArray["telephone"] = $company->getTelephone();
        $valuesArray["email"] = $company->getEmail();
        $valuesArray["web"] = $company->getWeb();
        $valuesArray["password"]= $company->getPassword();
     
    $this->connection = Connection::GetInstance();
   $this->connection->ExecuteNonQuery($query, $valuesArray);
    }
    catch(Exception $ex)
    {
        throw $ex;
    }
}


public function GetByName($name)
    {
     
        try {
           
            $company=NULL;

            $query = "SELECT * FROM .$this->tableName WHERE CompanyName LIKE '$name%'  ";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if ($resultSet) {
    
            $company=$this->setData($resultSet);
            }

            return $company;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }





    public function GetbyIdCompany($id_company)
    {
        
        try {
            $company=NULL;
            
            $query = "SELECT * FROM .$this->tableName WHERE id_company = '$id_company'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if ($resultSet) {
      
            $company=$this->setData($resultSet);
            }

            return $company;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }










    
public function GetByEmail($email)
    {
       
        try {
            $company=NULL;
            
            $query = "SELECT * FROM .$this->tableName WHERE email = '$email'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if ($resultSet) {
      
            $company=$this->setData($resultSet);
            }

            return $company;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }
    

    public function GetExist($CompanyName, $BusinessName, $CompanyAdress, $cuil, $telephone, $email, $web)
    {
    
        try {
            $company=NULL;
            
            $query = "SELECT * FROM .$this->tableName WHERE CompanyName = '$CompanyName' OR BusinessName = '$BusinessName' OR CompanyAdress = '$CompanyAdress' OR cuil = '$cuil' OR telephone = $telephone OR email = '$email'OR web = '$web'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if ($resultSet) {
         
            $company=$this->setData($resultSet);
            }

            return $company;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }
    public function   setData($resultSet)
    {
        $company = new Company();
        $company->setId_company($resultSet[0]["id_company"]);
        $company->setCompanyName($resultSet[0]["CompanyName"]);
        $company->setBusinessName($resultSet[0]["BusinessName"]);
        $company->setCompanyAdress($resultSet[0]["CompanyAdress"]);
        $company->setCuil($resultSet[0]["cuil"]);
        $company->setTelephone($resultSet[0]["telephone"]);
        $company->setEmail($resultSet[0]["email"]);
        $company->setWeb($resultSet[0]["web"]);
        $company->setPassword($resultSet[0]['password']);
        return $company;
    }




  public function GetAll()
{
    try
    {
        $companytList = array();

        $query = "SELECT * FROM ".$this->tableName;

        $this->connection = Connection::GetInstance();

        $resultSet = $this->connection->Execute($query);
        
        foreach ($resultSet as $valuesArray)
        {                
            $company = new Company();
            $company->setId_company($valuesArray["id_company"]);
            $company->setCompanyName($valuesArray["CompanyName"]);
            $company->setBusinessName($valuesArray["BusinessName"]);
            $company->setCompanyAdress($valuesArray["CompanyAdress"]);
            $company->setCuil($valuesArray["cuil"]);
            $company->setTelephone($valuesArray["telephone"]);
            $company->setEmail($valuesArray["email"]);
            $company->setWeb($valuesArray["web"]);
            $company->setPassword($valuesArray['password']);

            array_push($companytList, $company);
        }

        return $companytList;
    }
    catch(Exception $ex)
    {
        throw $ex;
    }
}








    public function Modify( $CompanyName, $BusinessName, $CompanyAdress,$id_company, $telephone, $email, $web,$cuil,$password)
    {  
        $this->connection = Connection::GetInstance();
        
        $consulta= "UPDATE company
        SET CompanyName = '$CompanyName', BusinessName = '$BusinessName', CompanyAdress = '$CompanyAdress',cuil = '$cuil', telephone = $telephone, email = '$email', web = '$web', password ='$password'
        WHERE id_company = '$id_company'";
        $connection = $this->connection;
        $connection->Execute($consulta);
    
    }

    public function delete($CompanyName)
    {
        $this->connection = Connection::GetInstance();
        $consulta= "DELETE From company WHERE CompanyName = '$CompanyName'";
      $connection = $this->connection;
        $connection->Execute($consulta);
    }


}
?>