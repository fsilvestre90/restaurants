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

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown() {
            Restaurant::deleteAll();
            Cuisine::deleteAll();
        }

        function test_save()
        {
            //Arrange
            $restaurant_name = "Antoons";
            $cuisine_type = 1;
            $restaurant_phone = "4128675309";
            $restaurant_address = "123 Atwood St";
            $test_Restaurant = new Restaurant($restaurant_name, $cuisine_type, $restaurant_phone, $restaurant_address);
            $test_Restaurant->save();

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals($test_Restaurant, $result[0]);
        }

        function test_getAll()
        {
            //Arrange

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

            //Act
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals([$test_Restaurant, $test_next_Restaurant], $result);


        }

        function fest_allRestaurantsInCuisine()
        {
            //Arrange
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

            $restaurant_name = "Dave & Busters"
            $cuisine_type = 1;
            $restaurant_phone = "44444444";
            $restaurant_address = "HELL";
            $test_third_restaurant = new Restaurant($restaurant_name, $cuisine_type, $restaurant_phone, $restaurant_address);
            $test_third_restaurant->save();

            //Act
            

            //Assert


        }

        function test_find()
        {
            //Arrange
            $restaurant_name = "Antoons";
            $cuisine_type = 1;
            $restaurant_phone = "4128675309";
            $restaurant_address = "123 Atwood St";
            $test_Restaurant = new Restaurant($restaurant_name, $cuisine_type, $restaurant_phone, $restaurant_address);
            $test_Restaurant->save();

            //Act
            $result = Restaurant::find($test_Restaurant->getId());

            //Assert
            $this->assertEquals($test_Restaurant, $result);
        }
        //
        // function test_deleteOne()
        // {
        //     //Arrange
        //     $Restaurant = "Pizza";
        //     $test_Restaurant = new Restaurant($Restaurant);
        //     $test_Restaurant->save();
        //
        //     //Act
        //     $result = Restaurant::find($test_Restaurant->getId());
        //     $result->deleteOne();
        //
        //     //Assert
        //     $this->assertEquals($test_Restaurant, $result);
        // }
        //
        // function test_update()
        // {
        //     //Arrange
        //     $Restaurant = "Pizza";
        //     $test_Restaurant = new Restaurant($Restaurant);
        //     $test_Restaurant->save();
        //
        //     //Act
        //     $result = Restaurant::find($test_Restaurant->getID());
        //     $result->setRestaurantType("Burgers");
        //     $result->update();
        //     $result = $result->getRestaurantType();
        //
        //     //Assert
        //     $this->assertEquals("Burgers", $result);
        // }
    }
?>
