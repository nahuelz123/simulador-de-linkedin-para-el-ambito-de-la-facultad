<?php
namespace Models;
use Models\Company;
use Models\Career;
class Job {
  private  $jobPositionId;
   private Career $career;
    private $description;
    private Company $company;

  /**
   * Get the value of jobPositionId
   */ 
  public function getJobPositionId()
  {
    return $this->jobPositionId;
  }

  /**
   * Set the value of jobPositionId
   *
   * @return  self
   */ 
  public function setJobPositionId($jobPositionId)
  {
    $this->jobPositionId = $jobPositionId;

    return $this;
  }

   

  

   


    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

   

    /**
     * Get the value of company
     */ 
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of company
     *
     * @return  self
     */ 
    public function setCompany( Company $company)
    {
        $this->company = $company;

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


?>