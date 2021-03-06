<?php


class ModelTableCreationDeletionTest extends WP_UnitTestCase {


	function test_table_creation_and_drop() {
		$model  = ModelFactory::getTestModel();
		$result = $model->create_table();
		$this->assertTrue( is_array( $result ) );
		$this->assertNotEmpty( $result );
		$this->assertTrue( $model->drop_table() );
	}


	function test_table_creation_and_drop_when_schema_has_backticks() {
		$model  = ModelFactory::getTestModelWithBackticks();
		$result = $model->create_table();
		$this->assertTrue( is_array( $result ) );
		$this->assertNotEmpty( $result );
		$this->assertTrue( $model->drop_table() );
	}


	function test_drop_on_deactivation_property() {
		$model  = ModelFactory::getTestModel();
		$result = $model->create_table();
		$this->assertTrue( is_array( $result ) );
		$this->assertNotEmpty( $result );
		$model->drop_on_deactivation = false;
		@$this->assertFalse( $model->drop_table() );
		$model->drop_on_deactivation = true;
		$this->assertTrue( $model->drop_table() );
	}

	function test_table_drop_can_be_forced() {
		$model  = ModelFactory::getTestModel();
		$result = $model->create_table();
		$this->assertTrue( is_array( $result ) );
		$this->assertNotEmpty( $result );
		$model->drop_on_deactivation = false;
		@$this->assertFalse( $model->drop_table() );
		$this->assertTrue( $model->drop_table( true ) );
	}

}