<?php
Rhaco::import("resources.Message");
Rhaco::import("database.model.TableObjectBase");
Rhaco::import("database.model.DbConnection");
Rhaco::import("database.TableObjectUtil");
Rhaco::import("database.model.Table");
Rhaco::import("database.model.Column");
/**
 * #ignore
 * 
 */
class CategoryTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $name;
	var $dependStageCategorys;


	function CategoryTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->name = null;
		$this->setId($id);
	}
	function connection(){
		if(!Rhaco::isVariable("_R_D_CON_","concert")){
			Rhaco::addVariable("_R_D_CON_",new DbConnection("concert"),"concert");
		}
		return Rhaco::getVariable("_R_D_CON_",null,"concert");
	}
	function table(){
		if(!Rhaco::isVariable("_R_D_T_","Category")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_concert_PREFIX")."category",__CLASS__),"Category");
		}
		return Rhaco::getVariable("_R_D_T_",null,"Category");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","Category::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			$column->depend("StageCategory::CategoryId");
			Rhaco::addVariable("_R_D_C_",$column,"Category::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Category::Id");
	}
	/**
	 * 
	 * @return serial
	 */
	function setId($value){
		$this->id = TableObjectUtil::cast($value,"serial");
	}
	/**
	 * 
	 */
	function getId(){
		return $this->id;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnName(){
		if(!Rhaco::isVariable("_R_D_C_","Category::Name")){
			$column = new Column("column=name,variable=name,type=string,size=30,require=true,",__CLASS__);
			$column->label(Message::_("name"));
			Rhaco::addVariable("_R_D_C_",$column,"Category::Name");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Category::Name");
	}
	/**
	 * 
	 * @return string
	 */
	function setName($value){
		$this->name = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getName(){
		return $this->name;
	}


	function setDependStageCategorys($value){
		$this->dependStageCategorys = $value;
	}
	function getDependStageCategorys(){
		return $this->dependStageCategorys;
	}
}
?>