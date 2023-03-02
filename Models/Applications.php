<?php

namespace Models;
use Models\JobOfert;
use Models\Student;
class Applications {
  
   
    private Student $student;
  //  private $id_JobOfert; 
    private JobOfert $JobOfert;

    

    /**
     * Get the value of student
     */ 
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set the value of student
     *
     * @return  self
     */ 
    public function setStudent(Student $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get the value of JobOfert
     */ 
    public function getJobOfert()
    {
        return $this->JobOfert;
    }

    /**
     * Set the value of JobOfert
     *
     * @return  self
     */ 
    public function setJobOfert(JobOfert $JobOfert)
    {
        $this->JobOfert = $JobOfert;

        return $this;
    }
}
?>