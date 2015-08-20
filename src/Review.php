<?php
      class Review
      {

        private $id;
        private $description;
        private $restaurant_id;

        function __construct($description, $restaurant_id, $id = null)
        {

            $this->description = $description;
            $this->restaurant_id = $restaurant_id;
            $this->id = $id;

        }

        function getId()
        {
            return $this->id;
        }

        function getReview()
        {
            return $this->description;
        }

        function getRestaurantId()
        {
            return $this->restaurant_id;
        }

        function setId($id)
        {
            $this->id = $id;
        }

        function setReview($description)
        {
            $this->description = $description;
        }
        function setRestaurantId($restaurant_id)
        {
            $this->restaurant_id = $restaurant_id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO reviews (description, restaurant_id) VALUES ('{$this->getReview()}', {$this->getRestaurantId()});");
            $result_id = $GLOBALS['DB']->lastInsertId();
            $this->setId($result_id);
        }

        static function getAll()
        {
            $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
            $reviews = array();
            foreach($returned_reviews as $review) {
                $description = $review['description'];
                $id = $review['id'];
                $restaurant_id = $review['restaurant_id'];
                $new_Review = new Review($description, $restaurant_id, $id);
                array_push($reviews, $new_Review);
            }
            return $reviews;
        }

        static function find($search_id)
        {
            $found_review = null;
            $reviews = Review::getAll();
            foreach($reviews as $review) {
                $review_id = $review->getId();
                if ($Review_id == $search_id){
                    $found_Review = $Review;
                }
            }
            return $found_Review;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews;");
        }

        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM reviews WHERE id = ('{$this->getId()}');");
        }

        function update()
        {
            $GLOBALS['DB']->exec("UPDATE reviews SET description = ('{$this->getReview()}') WHERE id = ('{$this->getId()}');");
        }

      }
?>
