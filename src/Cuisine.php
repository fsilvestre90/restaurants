<?php
  class Cuisine
  {

    private $id;
    private $cuisine_type;

    function __construct($cuisine_type, $id = null)
    {

        $this->cuisine_type = $cuisine_type;
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function getCuisineType()
    {
        return $this->cuisine_type;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setCuisineType($cuisine)
    {
        $this->cuisine_type = $cuisine;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO cuisines (cuisine_type) VALUES ('{$this->getCuisineType()}');");
        $result_id = $GLOBALS['DB']->lastInsertId();
        $this->setId($result_id);
    }

    static function getAll()
    {
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

    function getRestaurants() {
        $restaurants = array();
        $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()};");
        foreach($returned_restaurants as $restaurant) {
            $restaurant_name = $restaurant['restaurant_name'];
            $id = $restaurant['id'];
            $cuisine_id = $restaurant['cuisine_id'];
            $restaurant_phone = $restaurant['restaurant_phone'];
            $restaurant_address = $restaurant['restaurant_address'];
            $new_restaurant = new Restaurant($restaurant_name, $cuisine_id, $restaurant_phone, $restaurant_address, $id);
            array_push($restaurants, $new_restaurant);
        }
        return $restaurants;
    }

    static function find($search_id)
    {
        $found_cuisines = null;
        $cuisines = Cuisine::getAll();
        foreach($cuisines as $cuisine) {
            $cuisine_id = $cuisine->getId();
            if ($cuisine_id == $search_id){
                $found_cuisine = $cuisine;
            }
        }
        return $found_cuisine;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM cuisines;");
    }

    function deleteOne()
    {
        $GLOBALS['DB']->exec("DELETE FROM cuisines WHERE id = ('{$this->getId()}');");
    }

    function update()
    {
        $GLOBALS['DB']->exec("UPDATE cuisines SET cuisine_type = ('{$this->getCuisineType()}') WHERE id = ('{$this->getId()}');");
    }

  }
?>
