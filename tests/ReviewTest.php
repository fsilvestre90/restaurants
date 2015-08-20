<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";
    require_once "src/Review.php";

    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ReviewTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown() {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
            Review::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $review = "Pizza was dope";
            $restaurant_id = 1;
            $test_review = new Review($review, $restaurant_id);
            $test_review->save();

            //Act
            $result = Review::getAll();

            //Assert
            $this->assertEquals($test_review, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $review = "Pizza was dope";
            $restaurant_id = 1;
            $test_review = new Review($review, $restaurant_id);
            $test_review->save();

            $review2 = "DAMN DAT GRILLED CHEESE IS FIRE";
            $restaurant_id2 = 2;
            $test_review2 = new Review($review2, $restaurant_id2);
            $test_review2->save();

            //Act
            $result = Review::getAll();

            //Assert
            $this->assertEquals([$test_review, $test_review2], $result);


        }
    }
?>
