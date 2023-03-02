<?php

namespace DAO;

use DAO\IViews as IViews;
use Models\Admin as Admin;
use \Exception as Exception;

class AdminDAO  implements IViews
{
    

    private $connection;
    private $tableName = "useadmin";




    public function Add($admin)
    {
    

        try {
                    $query = "INSERT INTO " . $this->tableName . " (email, password ) VALUES (:email, :password);";
                   
                    $valuesArray["email"] = $admin->getEmail();
                    $valuesArray["password"] =$admin->getPassword();
                  

                    $this->connection = Connection::GetInstance();

                    $this->connection->ExecuteNonQuery($query, $valuesArray);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetAll()
    {
        try {
            $adminList= array();

            $query = "SELECT * FROM " . $this->tableName;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            foreach ($resultSet as $valuesArray) {
                $admin = new Admin();
                $admin->setEmail($valuesArray["email"]);
                $admin->setPassword($valuesArray["password"]);
                array_push($adminList, $admin);
            }

            return $adminList;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function GetByEmail($email)
    {
       
        try {
           
            $admin=0;
            $query = "SELECT * FROM .$this->tableName WHERE email = '$email'";;

            $this->connection = Connection::GetInstance();

            $resultSet = $this->connection->Execute($query);

            if ($resultSet) {
                $admin = new Admin();
                $admin->setEmail($resultSet[0]["email"]);
                $admin->setPassword($resultSet[0]["password"]);
             
            }

            return $admin;
        } catch (Exception $ex) {
            throw new Exception('Error al cargar la base de datos');
        }
    }


}
