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
class StageCategoryTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $stageId;
	/**  */
	var $categoryId;
	var $factStageId;
	var $factCategoryId;


	function StageCategoryTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->stageId = null;
		$this->categoryId = null;
		$this->setId($id);
	}
	function connection(){
		if(!Rhaco::isVariable("_R_D_CON_","concert")){
			Rhaco::addVariable("_R_D_CON_",new DbConnection("concert"),"concert");
		}
		return Rhaco::getVariable("_R_D_CON_",null,"concert");
	}
	function table(){
		if(!Rhaco::isVariable("_R_D_T_","StageCategory")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_concert_PREFIX")."stage_category",__CLASS__),"StageCategory");
		}
		return Rhaco::getVariable("_R_D_T_",null,"StageCategory");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","StageCategory::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			Rhaco::addVariable("_R_D_C_",$column,"StageCategory::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"StageCategory::Id");
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
	function columnStageId(){
		if(!Rhaco::isVariable("_R_D_C_","StageCategory::StageId")){
			$column = new Column("column=stage_id,variable=stageId,type=integer,size=22,require=true,reference=Stage::Id,",__CLASS__);
			$column->label(Message::_("stage_id"));
			Rhaco::addVariable("_R_D_C_",$column,"StageCategory::StageId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"StageCategory::StageId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setStageId($value){
		$this->stageId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getStageId(){
		return $this->stageId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCategoryId(){
		if(!Rhaco::isVariable("_R_D_C_","StageCategory::CategoryId")){
			$column = new Column("column=category_id,variable=categoryId,type=integer,size=22,require=true,reference=Category::Id,",__CLASS__);
			$column->label(Message::_("category_id"));
			Rhaco::addVariable("_R_D_C_",$column,"StageCategory::CategoryId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"StageCategory::CategoryId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setCategoryId($value){
		$this->categoryId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getCategoryId(){
		return $this->categoryId;
	}


	function getFactStageId(){
		return $this->factStageId;
	}
	function setFactStageId($obj){
		$this->factStageId = $obj;
	}
	function getFactCategoryId(){
		return $this->factCategoryId;
	}
	function setFactCategoryId($obj){
		$this->factCategoryId = $obj;
	}
}
?>