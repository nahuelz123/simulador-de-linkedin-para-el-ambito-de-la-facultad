<?php

namespace Models;
use Models\Company;

use Models\Job ;

class JobOfert
{
 private $id_JobOfert;
  private Company $company;
  private Job $jobPosition;
  private $cargaHoraria;
  private $activo;
  private $titulo;
  private $descripcion;
  private $puesto;
 private $imagen;



 /**
  * Get the value of id_JobOfert
  */ 
 public function getId_JobOfert()
 {
  return $this->id_JobOfert;
 }

 /**
  * Set the value of id_JobOfert
  *
  * @return  self
  */ 
 public function setId_JobOfert($id_JobOfert)
 {
  $this->id_JobOfert = $id_JobOfert;

  return $this;
 }

  

  /**
   * Get the value of cargaHoraria
   */ 
  public function getCargaHoraria()
  {
    return $this->cargaHoraria;
  }

  /**
   * Set the value of cargaHoraria
   *
   * @return  self
   */ 
  public function setCargaHoraria($cargaHoraria)
  {
    $this->cargaHoraria = $cargaHoraria;

    return $this;
  }

  /**
   * Get the value of activo
   */ 
  public function getActivo()
  {
    return $this->activo;
  }

  /**
   * Set the value of activo
   *
   * @return  self
   */ 
  public function setActivo($activo)
  {
    $this->activo = $activo;

    return $this;
  }

  /**
   * Get the value of titulo
   */ 
  public function getTitulo()
  {
    return $this->titulo;
  }

  /**
   * Set the value of titulo
   *
   * @return  self
   */ 
  public function setTitulo($titulo)
  {
    $this->titulo = $titulo;

    return $this;
  }

  /**
   * Get the value of descripcion
   */ 
  public function getDescripcion()
  {
    return $this->descripcion;
  }

  /**
   * Set the value of descripcion
   *
   * @return  self
   */ 
  public function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;

    return $this;
  }

  /**
   * Get the value of puesto
   */ 
  public function getPuesto()
  {
    return $this->puesto;
  }

  /**
   * Set the value of puesto
   *
   * @return  self
   */ 
  public function setPuesto($puesto)
  {
    $this->puesto = $puesto;

    return $this;
  }

/**
 * Get the value of imagen
 */ 
public function getImagen()
{
return $this->imagen;
}

/**
 * Set the value of imagen
 *
 * @return  self
 */ 
public function setImagen($imagen)
{
$this->imagen = $imagen;

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
   * Get the value of jobPosition
   */ 
  public function getJobPosition()
  {
    return $this->jobPosition;
  }

  /**
   * Set the value of jobPosition
   *
   * @return  self
   */ 
  public function setJobPosition(Job $jobPosition)
  {
    $this->jobPosition = $jobPosition;

    return $this;
  }
}
?>