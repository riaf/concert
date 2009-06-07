<?php
Rhaco::import('generic.Views');
Rhaco::import('model.Category');
Rhaco::import('model.Comment');
Rhaco::import('model.Stage');
Rhaco::import('model.StageCategory');

class ConcertView extends Views
{
    function __init__($args){
        parent::__init__($args);
        if(!$this->isSession('__concert_key')){
            $this->setSession('__concert_key', md5(time() + mt_rand(0, 9999999)));
        }
        if($this->isPost()){
            if(!$this->isVariable('__concert_key') || $this->getVariable('__concert_key') != $this->getSession('__concert_key')){
                ExceptionTrigger::raise(new GenericException('__concert_key'));
                Header::redirect(Rhaco::url());
            }
        }
    }
    function index(){
        return $this->read(new Stage(), new C(Q::orderDesc(Stage::columnId())));
    }
    function play($stage_id){
        $stage = $this->dbUtil->get(new Stage(), new C(Q::eq(Stage::columnId(), $stage_id)));
        if(!Variable::istype('Stage', $stage)){
            $this->_notFound();
            return $this->parser();
        }
        $this->setVariable('object', $stage);
        if($this->isPost()){
            // add comment
            $this->setVariable('stage_id', $stage->id);
            if($this->dbUtil->insert($this->toObject(new Comment()))){
                Header::redirect(Rhaco::url('play/'. $stage->id));
            }
        }
        $stage_file_name = Rhaco::path(sprintf('stages/%d.apif', $stage->id));
        $stage_data = unserialize(file_get_contents($stage_file_name));
        foreach($stage_data as &$v){
            if(preg_match('/^images.*?gif$/', $v['value'])){
                $v['value'] = Rhaco::url($v['value']);
            }
        }
        $this->setVariable('stage_data', $stage_data);
        $this->setVariable('comments', $this->dbUtil->select(new Comment(), new C(Q::eq(Comment::columnStageId(), $stage->id))));
        return $this->parser('play.html');
    }
    function upload(){
        if($this->isPost() && $this->isFile('stage')){
            $file = $this->getFile('stage');
            $src = mb_convert_encoding(file_get_contents($file->tmp), 'utf-8', 'Shift_JIS,EUC-JP,UTF-8');
            if(SimpleTag::setof($tag, $src, 'body', true)){
                foreach($tag->getIn('applet') as $applet){
                    if($applet->getParameter('code') != 'MasaoConstruction') continue;
                    $gamedata = array();
                    foreach($applet->getIn('param') as $param){
                        $gamedata[$param->getParameter('name')] = array('name' => $param->getParameter('name'), 'value' => $param->getParameter('value'));
                    }
                    if(empty($gamedata)){
                        break;
                    }
                    $stage = $this->dbUtil->insert($this->toObject(new Stage()));
                    if(!Variable::istype('Stage', $stage)){
                        break;
                    }
                    
                    $_images = array('title', 'ending', 'gameover', 'pattern', 'chizu');
                    foreach($_images as $k){
                        if(!isset($gamedata[sprintf("filename_%s", $k)])) continue;
                        $gamedata[sprintf("filename_%s", $k)] = array('name' => sprintf("filename_%s", $k), 'value' => 'images/' . $k . '.gif');
                        if($this->isFile('img_' . $k)){
                            $image = $this->getFile('img_' . $k);
                            $img_info = getimagesize($image->tmp);
                            if($img_info[2] != IMAGETYPE_GIF) continue;
                            $filename = Rhaco::path(sprintf('images/%s_%d.gif', $k, $stage->id));
                            if(move_uploaded_file($image->tmp, $filename)){
                                $gamedata[sprintf("filename_%s", $k)] = array('name' => sprintf("filename_%s", $k), 'value' => sprintf("images/%s_%d.gif", $k, $stage->getId()));
                            }
                        }
                    }
                    FileUtil::write(Rhaco::path(sprintf('stages/%d.apif', $stage->id)), serialize($gamedata));
                    
                    Header::redirect(Rhaco::url());
                    Rhaco::end();
                }
            }
        }
        return $this->parser('upload.html');
    }
    function parser($template=null){
        $this->setVariable('__concert_key', $this->getSession('__concert_key'));
        return parent::parser($template);
    }
}