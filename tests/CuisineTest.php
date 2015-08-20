<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown() {
            Cuisine::deleteAll();
            Restaurant::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $cuisine = "Pizza";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals($test_cuisine, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $cuisine = "Pizza";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();

            //Act
            $result = Cuisine::getAll();

            //Assert
            $this->assertEquals([$test_cuisine], $result);


        }


        function fest_allRestaurantsInCuisine()
        {
            //Arrange
            $cuisine = "Pizza";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();

            $cuisine = "Burgers";
            $test_cuisine2 = new Cuisine($cuisine);
            $test_cuisine2->save();

            $restaurant_name = "Antoons";
            $cuisine_type = 1;
            $restaurant_phone = "4128675309";
            $restaurant_address = "123 Atwood St";
            $test_Restaurant = new Restaurant($restaurant_name, $cuisine_type, $restaurant_phone, $restaurant_address);
            $test_Restaurant->save();


            $restaurant_name = "Spankys";
            $cuisine_type = 2;
            $restaurant_phone = "8015715713";
            $restaurant_address = "379 E 3333 S";
            $test_next_Restaurant = new Restaurant($restaurant_name, $cuisine_type, $restaurant_phone, $restaurant_address);
            $test_next_Restaurant->save();

            $restaurant_name = "Dave & Busters";
            $cuisine_type = 1;
            $restaurant_phone = "44444444";
            $restaurant_address = "HELL";
            $test_third_restaurant = new Restaurant($restaurant_name, $cuisine_type, $restaurant_phone, $restaurant_address);
            $test_third_restaurant->save();

            //Act
            $result = Cuisine::getRestaurants();

            //Assert
            $this->assertEquals([$test_Restaurant, $test_third_restaurant], $result);


        }

        function test_find()
        {
            //Arrange
            $cuisine = "Pizza";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();

            //Act
            $result = Cuisine::find($test_cuisine->getId());

            //Assert
            $this->assertEquals($test_cuisine, $result);
        }

        function test_deleteOne()
        {
            //Arrange
            $cuisine = "Pizza";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();

            //Act
            $result = Cuisine::find($test_cuisine->getId());
            $result->deleteOne();

            //Assert
            $this->assertEquals($test_cuisine, $result);
        }

        function test_update()
        {
            //Arrange
            $cuisine = "Pizza";
            $test_cuisine = new Cuisine($cuisine);
            $test_cuisine->save();

            //Act
            $result = Cuisine::find($test_cuisine->getID());
            $result->setCuisineType("Burgers");
            $result->update();
            $result = $result->getCuisineType();

            //Assert
            $this->assertEquals("Burgers", $result);
        }
    }
?>
