<?php

namespace Models;

use Models\Usuario as Usuario;
use Models\Career;

class Student extends Usuario
{
///controlar extiende de user 

    private $fileNumber;
    private  $phoneNumber;
    private $gender;
   private $studentId;
    private Career $career;
   private $password;
    private $url;
    private $fileName;
    /**
     * Get the value of fileNumber
     */ 
    public function getFileNumber()
    {
        return $this->fileNumber;
    }

    /**
     * Set the value of fileNumber
     *
     * @return  self
     */ 
    public function setFileNumber($fileNumber)
    {
        $this->fileNumber = $fileNumber;

        return $this;
    }

    /**
     * Get the value of phoneNumber
     */ 
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     *
     * @return  self
     */ 
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }


    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

   /**
    * Get the value of studentId
    */ 
   public function getStudentId()
   {
      return $this->studentId;
   }

   /**
    * Set the value of studentId
    *
    * @return  self
    */ 
   public function setStudentId($studentId)
   {
      $this->studentId = $studentId;

      return $this;
   }

   
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the value of url
     */ 
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the value of url
     *
     * @return  self
     */ 
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the value of fileName
     */ 
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set the value of fileName
     *
     * @return  self
     */ 
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get the value of career
     */ 
    public function getCareer()
    {
        return $this->career;
    }

    /**
     * Set the value of career
     *
     * @return  self
     */ 
    public function setCareer(Career $career)
    {
        $this->career = $career;

        return $this;
    }
}
