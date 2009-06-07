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
class CommentTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $stageId;
	/**  */
	var $name;
	/**  */
	var $message;
	/**  */
	var $ctime;
	var $factStageId;


	function CommentTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->stageId = null;
		$this->name = "名無しさん";
		$this->message = null;
		$this->ctime = time();
		$this->setId($id);
	}
	function connection(){
		if(!Rhaco::isVariable("_R_D_CON_","concert")){
			Rhaco::addVariable("_R_D_CON_",new DbConnection("concert"),"concert");
		}
		return Rhaco::getVariable("_R_D_CON_",null,"concert");
	}
	function table(){
		if(!Rhaco::isVariable("_R_D_T_","Comment")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_concert_PREFIX")."comment",__CLASS__),"Comment");
		}
		return Rhaco::getVariable("_R_D_T_",null,"Comment");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","Comment::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			Rhaco::addVariable("_R_D_C_",$column,"Comment::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Comment::Id");
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
		if(!Rhaco::isVariable("_R_D_C_","Comment::StageId")){
			$column = new Column("column=stage_id,variable=stageId,type=integer,size=22,require=true,reference=Stage::Id,",__CLASS__);
			$column->label(Message::_("stage_id"));
			Rhaco::addVariable("_R_D_C_",$column,"Comment::StageId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Comment::StageId");
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
	function columnName(){
		if(!Rhaco::isVariable("_R_D_C_","Comment::Name")){
			$column = new Column("column=name,variable=name,type=string,size=30,",__CLASS__);
			$column->label(Message::_("name"));
			Rhaco::addVariable("_R_D_C_",$column,"Comment::Name");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Comment::Name");
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
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnMessage(){
		if(!Rhaco::isVariable("_R_D_C_","Comment::Message")){
			$column = new Column("column=message,variable=message,type=text,size=1000,require=true,",__CLASS__);
			$column->label(Message::_("message"));
			Rhaco::addVariable("_R_D_C_",$column,"Comment::Message");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Comment::Message");
	}
	/**
	 * 
	 * @return text
	 */
	function setMessage($value){
		$this->message = TableObjectUtil::cast($value,"text");
	}
	/**
	 * 
	 */
	function getMessage(){
		return $this->message;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCtime(){
		if(!Rhaco::isVariable("_R_D_C_","Comment::Ctime")){
			$column = new Column("column=ctime,variable=ctime,type=timestamp,",__CLASS__);
			$column->label(Message::_("ctime"));
			Rhaco::addVariable("_R_D_C_",$column,"Comment::Ctime");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Comment::Ctime");
	}
	/**
	 * 
	 * @return timestamp
	 */
	function setCtime($value){
		$this->ctime = TableObjectUtil::cast($value,"timestamp");
	}
	/**
	 * 
	 */
	function getCtime(){
		return $this->ctime;
	}
	/**  */
	function formatCtime($format="Y/m/d H:i:s"){
		return DateUtil::format($this->ctime,$format);
	}


	function getFactStageId(){
		return $this->factStageId;
	}
	function setFactStageId($obj){
		$this->factStageId = $obj;
	}
}
?>