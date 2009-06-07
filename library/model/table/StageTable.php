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
class StageTable extends TableObjectBase{
	/**  */
	var $id;
	/**  */
	var $title;
	/**  */
	var $author;
	/**  */
	var $userId;
	/**  */
	var $ctime;
	var $dependComments;
	var $dependStageCategorys;


	function StageTable($id=null){
		$this->__init__($id);
	}
	function __init__($id=null){
		$this->id = null;
		$this->title = null;
		$this->author = null;
		$this->userId = 0;
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
		if(!Rhaco::isVariable("_R_D_T_","Stage")){
			Rhaco::addVariable("_R_D_T_",new Table(Rhaco::constant("DATABASE_concert_PREFIX")."stage",__CLASS__),"Stage");
		}
		return Rhaco::getVariable("_R_D_T_",null,"Stage");
	}


	/**
	 * 
	 * @return database.model.Column
	 */
	function columnId(){
		if(!Rhaco::isVariable("_R_D_C_","Stage::Id")){
			$column = new Column("column=id,variable=id,type=serial,size=22,primary=true,",__CLASS__);
			$column->label(Message::_("id"));
			$column->depend("Comment::StageId","StageCategory::StageId");
			Rhaco::addVariable("_R_D_C_",$column,"Stage::Id");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Stage::Id");
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
	function columnTitle(){
		if(!Rhaco::isVariable("_R_D_C_","Stage::Title")){
			$column = new Column("column=title,variable=title,type=string,size=60,require=true,",__CLASS__);
			$column->label(Message::_("title"));
			Rhaco::addVariable("_R_D_C_",$column,"Stage::Title");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Stage::Title");
	}
	/**
	 * 
	 * @return string
	 */
	function setTitle($value){
		$this->title = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getTitle(){
		return $this->title;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnAuthor(){
		if(!Rhaco::isVariable("_R_D_C_","Stage::Author")){
			$column = new Column("column=author,variable=author,type=string,size=30,require=true,",__CLASS__);
			$column->label(Message::_("author"));
			Rhaco::addVariable("_R_D_C_",$column,"Stage::Author");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Stage::Author");
	}
	/**
	 * 
	 * @return string
	 */
	function setAuthor($value){
		$this->author = TableObjectUtil::cast($value,"string");
	}
	/**
	 * 
	 */
	function getAuthor(){
		return $this->author;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnUserId(){
		if(!Rhaco::isVariable("_R_D_C_","Stage::UserId")){
			$column = new Column("column=user_id,variable=userId,type=integer,size=22,",__CLASS__);
			$column->label(Message::_("user_id"));
			Rhaco::addVariable("_R_D_C_",$column,"Stage::UserId");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Stage::UserId");
	}
	/**
	 * 
	 * @return integer
	 */
	function setUserId($value){
		$this->userId = TableObjectUtil::cast($value,"integer");
	}
	/**
	 * 
	 */
	function getUserId(){
		return $this->userId;
	}
	/**
	 * 
	 * @return database.model.Column
	 */
	function columnCtime(){
		if(!Rhaco::isVariable("_R_D_C_","Stage::Ctime")){
			$column = new Column("column=ctime,variable=ctime,type=timestamp,",__CLASS__);
			$column->label(Message::_("ctime"));
			Rhaco::addVariable("_R_D_C_",$column,"Stage::Ctime");
		}
		return Rhaco::getVariable("_R_D_C_",null,"Stage::Ctime");
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


	function setDependComments($value){
		$this->dependComments = $value;
	}
	function getDependComments(){
		return $this->dependComments;
	}
	function setDependStageCategorys($value){
		$this->dependStageCategorys = $value;
	}
	function getDependStageCategorys(){
		return $this->dependStageCategorys;
	}
}
?>