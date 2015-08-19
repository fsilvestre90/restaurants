<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Cuisine.php";

    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown() {
            Cuisine::deleteAll();
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
