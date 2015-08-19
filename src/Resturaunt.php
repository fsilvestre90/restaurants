<?php
  class Resturaunt
  {
      private $id;
      private $resturaunt_name;
      private $cuisine_id;
      private $review_id;

      function __construct($restaurant_name, $cuisine_id, $review_id = null, $id = null)
      {
          $this->restaurant_name = $restaurant_name;
          $this->cuisine_id = $cuisine_id;
          $this->review_id = $review_id;
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

      function getCuisineId() {
          return $this->cuisine_id;
      }

      function getReviewId() {
          return $this->review_id;
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

      function setReviewId($review_id)
      {
          $this->review_id = $review_id;
      }

      function save()
      {
          $GLOBALS['DB']->exec("INSERT INTO restaurants (restaurant_name) VALUES ('{$this->getRestaurantName()}');");
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
              $new_restaurant = new Restaurant($restaurant_name, $id);
              array_push($restaurants, $new_restaurant);
          }
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
