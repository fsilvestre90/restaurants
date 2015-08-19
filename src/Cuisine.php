<?php
  class Cuisine
  {

    private $id;
    private $cuisine_type;

    function __construct($cuisine_type, $id = null) {

        $this->cuisine_type = $cuisine_type;
        $this->id = $id;
    }

    function getId() {
        return $this->id;
    }

    function getCuisineType() {
        return $this->cuisine_type;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCuisineType($cuisine) {
        $this->cuisine_type = $cuisine;
    }

    function save() {
        $GLOBALS['DB']->exec("INSERT INTO cuisines (cuisine_type) VALUES ('{$this->getCuisineType()}');");
        $result_id = $GLOBALS['DB']->lastInsertId();
        $this->setId($result_id);
    }

    static function getAll() {
        $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisines;");
        $cuisines = array();
        foreach($returned_cuisines as $cuisine) {
            $cuisine_type = $cuisine['cuisine_type'];
            $id = $cuisine['id'];
            $new_cuisine = new Cuisine($cuisine_type, $id);
            array_push($cuisines, $new_cuisine);
        }
        return $cuisines;
    }

    function find() {

    }

    static function deleteAll() {
        $GLOBALS['DB']->exec("DELETE FROM cuisines;");
    }

    function deleteOne() {

    }

    function updateOne() {

    }

  }
?>
