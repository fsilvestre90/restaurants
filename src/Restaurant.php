<?php
      class Restaurant
      {
          private $id;
          private $resturaunt_name;
          private $cuisine_id;
          private $restaurant_phone;
          private $restaurant_address;


          function __construct($restaurant_name, $cuisine_id, $restaurant_phone, $restaurant_address, $id = null)
          {
              $this->restaurant_name = $restaurant_name;
              $this->cuisine_id = $cuisine_id;
              $this->restaurant_phone = $restaurant_phone;
              $this->restaurant_address = $restaurant_address;
              $this->id = $id;
          }

          function getId()
          {
              return $this->id;
          }

          function getRestaurantName()
          {
              return $this->restaurant_name;
          }

          function getCuisineId()
          {
              return $this->cuisine_id;
          }

          function getRestaurantPhone()
          {
              return $this->restaurant_phone;
          }

          function getRestaurantAddress()
          {
              return $this->restaurant_address;
          }

          function setId($id)
          {
              $this->id = $id;
          }

          function setRestaurantName($restaurant_name)
          {
              $this->restaurant_name = $restaurant_name;
          }

          function setRestaurantId($restaurant_id)
          {
              $this->restaurant_id = $restuarant_id;
          }

          function setRestaurantPhone($restaurant_phone)
          {
              $this->$restaurant_phone = $restaurant_id;
          }

          function setRestaurantAddress($restaurant_address)
          {
              $this->$restaurant_address = $restaurant_address;
          }

          function save()
          {
              $GLOBALS['DB']->exec("INSERT INTO restaurants (restaurant_name, cuisine_id, restaurant_phone, restaurant_address) VALUES ('{$this->getRestaurantName()}', '{$this->getCuisineId()}', '{$this->getRestaurantPhone()}', '{$this->getRestaurantAddress()}');");
              $result_id = $GLOBALS['DB']->lastInsertId();
              $this->setId($result_id);
          }

          static function getAll()
          {
              $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
              $restaurants = array();
              foreach($returned_restaurants as $restaurant) {
                  $restaurant_name = $restaurant['restaurant_name'];
                  $id = $restaurant['id'];
                  $cuisine_id = $restaurant['cuisine_id'];
                  $restaurant_phone = $restaurant['restaurant_phone'];
                  $restaurant_address = $restaurant['restaurant_address'];
                  $new_restaurant = new Restaurant($restaurant_name, $cuisine_id, $restaurant_phone, $restaurant_address, $id);
                  array_push($restaurants, $new_restaurant);
              }
              var_dump($restaurants);
              return $restaurants;
          }

          static function find($search_id)
          {
              $found_restaurants = null;
              $restaurants = Restaurant::getAll();
              foreach($restaurants as $restaurant) {
                  $restaurant_id = $restaurant->getId();
                  if ($restaurant_id == $search_id){
                      $found_restaurant = $restaurant;
                  }
              }
              return $found_restaurant;
          }

          static function findAllRestaurantsWithCuisine($cuisine_id)
          {

          }

          static function deleteAll()
          {
              $GLOBALS['DB']->exec("DELETE FROM restaurants;");
          }

          function deleteOne()
          {
              $GLOBALS['DB']->exec("DELETE FROM restaurants WHERE id = ('{$this->getId()}');");
          }

          function update()
          {
              $GLOBALS['DB']->exec("UPDATE restaurants SET restaurant_name = ('{$this->getRestaurantName()}') WHERE id = ('{$this->getId()}');");
          }
      }

?>
