<?php

namespace core\utils;

class Files
{
    
    public $dirOrig = '/content/images_orig/';
    public $dirCreated = '/content/images/';
    public $defaultChange = 2;
    
    public $changeList = array(
        1 => "Область из центра",
        2 => "По максимальному отношению",
        3 => "Сохранение пропорций со смещённым центром"
    );        
            
    
    function ActionGet($url)
    {
        $method = "ActionGet".$url[1];
        $this->$method($url[2]);
    }
    
    function ActionGetImages($link)
    {
        $param = $this->parseParams($link);
        $path = $this->getImgPath($param['id'],$param['type']);
        
        if(!$path){
            $path = $_SERVER['DOCUMENT_ROOT'].$this->dirOrig."0.png";
            $param['type'] = 'png';
        }
        
        $file = $this->loadImage($path,$param['type']);
        $sizeOrig = $this->getSize($path);
        $sizeTpl = $this->getTplSize($param['tpl'],$sizeOrig);
        
        //pr($sizeOrig);
        
        //pr($sizeTpl);
        
        $cache = $this->imgResize($file,$param['type'],$param['tpl'],$sizeTpl,$sizeOrig);
        $this->saveImage($link,$param['type'],$cache);
        $this->echoImg($cache,mime_content_type($path),$type);
        
    }
    
    function saveImage($link,$type,$file)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . $this->dirCreated . $link;
        switch($type){
            case 'png':
                imagepng($file, $path, 0);
                break;
            case 'gif':
                imagegif($file, $path);
                break;
            default:
                imagejpeg($file, $path, 100);
                break;
        }
    }
    
    function echoImg($file,$mime,$type) 
    {
        header('Content-Type: '.$mime);
        switch($type){
            case 'png':
                imagepng($file, null, 0);
                break;
            case 'gif':
                imagegif($file);
                break;
            default:
                imagejpeg($file, null, 100);
                break;
        }
    }
    
    function loadImage($path,$type) 
    {
        switch ($type) {
            case 'gif': 
                return imagecreatefromgif($path);
                break;
            case 'jpeg':
            case 'jpg':
                return imagecreatefromjpeg($path);
                break;
            case 'png': 
                return imagecreatefrompng($path);
                break;
        }
    }
    
    function getSize($path) 
    {
        $ar = getimagesize($path);
        
        $size = new \stdClass();
        
        $size->width = $ar[0];
        $size->height = $ar[1];
        $size->delta = $size->width / $size->height;
        
        return $size;
    }
    
    function getImgPath($id,$type)
    {
        $file = $_SERVER['DOCUMENT_ROOT'].$this->dirOrig."$id.$type";
        if(file_exists($file)){
            return $file;
        }else{
            return null;
        }
    }
    
    
    function getTemplate($name)
    {
        $template = \Core\Core::$app->db()->selectRow("select img_change_id as 'change',new_width as width,new_height as height"
                . " from img_templates where alias = ?",$name);
        return $template;
    }
    
    function parseParams($patch)
    {
        $st = explode("_",$patch);
        $ex = explode(".",$st[1]);
        $tpl = $ex[0];
        $type = $ex[1];
        
        if (preg_match("/([0-9]*)x([0-9]*)x([0-9]*)/", $tpl, $match)) {
            $tpl = array(
                "width"=>$match[1],
                "height"=>$match[2],
                "change"=>$match[3]
            );
        } elseif(preg_match("/([0-9]*)x([0-9]*)/", $tpl, $match)){
            $tpl = array(
                "width"=>$match[1],
                "height"=>$match[2],
                "change"=>$this->defaultChange
            );
        } else {
            $tpl = $this->getTemplate($tpl);
        }
        
        return array(
            'id'=>$st[0],
            'tpl'=>$tpl,
            'type'=>$type
        );
    }
    
    function getTplSize($tpl,$sizeOrig) 
    {
        
        $sizeTpl = new \stdClass();
        
        $sizeTpl->width = $tpl['width'];
        $sizeTpl->height = $tpl['height'];
        
        
        if($sizeTpl->width == 0 && $sizeTpl->height == 0){
            $sizeTpl->width = $sizeOrig->width;
            $sizeTpl->height = $sizeOrig->height;
        }else{
            
            if($sizeTpl->width == 0){
                $sizeTpl->width = round(($sizeOrig->width / $sizeOrig->height) * $sizeTpl->height);
            }
            
            if($sizeTpl->height == 0){
                 $sizeTpl->height = round(($sizeOrig->height / $sizeOrig->width) * $sizeTpl->width);
            }
        }
        
        return $sizeTpl;
    }
    
    function imgResize($file,$typeFile,$tpl,$sizeTpl,$sizeOrig) 
    {
        
        switch ($tpl['change']) {
            case 1:
                //Область из центра
                if ($sizeOrig->delta < 1) {
                    $tempWidth = $sizeTpl->width;
                    $tempHeight = round(($sizeOrig->height / $sizeOrig->width ) * $sizeTpl->width);
                    
                    $y = ceil(($tempHeight - $sizeTpl->height) / 2);
                    $x = 0;
                } else {
                    $tempHeight = $sizeOrig->height;
                    $tempWidth = round(($sizeOrig->width / $sizeOrig->height ) * $sizeTpl->height);
                    
                    $y = 0;
                    $x = ceil(($tempWidth - $sizeTpl->width) / 2);
                }
                $tempImg = imagecreatetruecolor($tempWidth, $tempHeight);
                imagecopyresampled($tempImg, $file, 0, 0, 0, 0, $tempWidth, $tempHeight, $sizeOrig->width, $sizeOrig->height);
                
                $cache = imagecreatetruecolor($sizeTpl->width, $sizeTpl->height);
                if ($typeFile == 'png') {
                    imagealphablending($cache, false);
                    imagesavealpha($cache, true);
                    $transColour = imagecolorallocatealpha($cache, 0, 0, 0, 127);
                    imagefill($cache, 0, 0, $transColour);
                }
                imagecopyresampled($cache, $tempImg, 0, 0, $x, $y, $sizeTpl->width, $sizeTpl->height, $sizeTpl->width, $sizeTpl->height);
                return $cache;
                break;

            case 2:
                //По максимальному отношению
                if ($sizeOrig->width == $sizeOrig->height) {
                    $sizeTpl->width = $sizeTpl->height = min($sizeTpl->width, $sizeTpl->height);
                } elseif ($sizeTpl->width > $sizeTpl->height) {
                    
                    if ($sizeOrig->delta > 1) {
                        $delta = $sizeOrig->height / $sizeOrig->width;
                        $sizeTpl->height = $sizeTpl->width * $delta;
                    } else {
                        $delta = $sizeOrig->delta;
                        $sizeTpl->width = $sizeTpl->heigh * $delta;
                    }
                    
                } else {
                    
                    if ($sizeOrig->delta > 1) {
                        $delta = $sizeOrig->delta;
                        $sizeTpl->width = $sizeTpl->height * $delta;
                    } else {
                        $delta = $sizeOrig->height / $sizeOrig->width;
                        $sizeTpl->height = $sizeTpl->width * $delta;
                    }
                    
                }
                
                $cache = imagecreatetruecolor($sizeTpl->width, $sizeTpl->height);
                
                if ($typeFile == 'png') {
                    imagealphablending($cache, false);
                    imagesavealpha($cache, true);
                    $transColour = imagecolorallocatealpha($cache, 0, 0, 0, 127);
                    imagefill($cache, 0, 0, $transColour);
                }
                imagecopyresampled($cache, $file, 0, 0, 0, 0, $sizeTpl->width, $sizeTpl->height, $sizeOrig->width, $sizeOrig->height);
                break;

            case 3: // Сохранение пропорций со смещённым центром
                $cache = imagecreatetruecolor($sizeTpl->width, $sizeTpl->height);
                if ($typeFile == 'png') {
                    imagealphablending($cache, false);
                    imagesavealpha($cache, true);
                    $transColour = imagecolorallocatealpha($cache, 0, 0, 0, 127);
                    imagefill($cache, 0, 0, $transColour);
                }
                
                $h_ot_d = $sizeTpl->height / $sizeOrig->height; // Определяем отношение нужной высоты к исходной
                $w_ot_d = $sizeTpl->width / $sizeOrig->width; // И ширины
                
                if ($h_ot_d > $w_ot_d) { // Если отношение по высоте больше чем по ширине, то отталкиваемся от ширины
                    if ($tpl['cx']) {
                        $fc = round($sizeOrig->width / $tpl['cx']);
                        $fxc = round($sizeOrig->width / $fc - ($sizeTpl->width / $h_ot_d) / $fc);
                        if ($fxc < 0) {
                            $fxc = 0;
                        }
                        if ($fxc + $sizeTpl->widt > $sizeOrig->width) {
                            $fxc = $sizeOrig->width - $sizeTpl->width;
                        }
                    } else {
                        $fxc = round(($sizeOrig->width - $sizeTpl->width/ $h_ot_d) / 2);
                    }
                    imagecopyresampled($cache, $file, 0, 0, $fxc, 0, $sizeTpl->width, $sizeTpl->height, round($sizeTpl->width / $h_ot_d), $sizeOrig->height);
                } elseif ($h_ot_d < $w_ot_d) {
                    $fyc = round(($sizeOrig->height - $sizeTpl->height / $w_ot_d) / 2);
                    imagecopyresampled($cache, $file, 0, 0, 0, $fyc, $sizeTpl->width, $sizeTpl->height, $this->width, round($sizeOrig->height / $w_ot_d));
                } else{
                    imagecopyresampled($cache, $file, 0, 0, 0, 0, $sizeTpl->width, $sizeTpl->height, $sizeOrig->width, $sizeOrig->height);
                }
                break;
                
            default:
                $cache = imagecreatetruecolor($sizeTpl->width, $sizeTpl->height);
                if ($typeFile == 'png') {
                    imagealphablending($cache, false);
                    imagesavealpha($cache, true);
                    $transColour = imagecolorallocatealpha($cache, 0, 0, 0, 127);
                    imagefill($cache, 0, 0, $transColour);
                }
                imagecopyresampled($cache, $file, 0, 0, 0, 0, $sizeTpl->width, $sizeTpl->height, $sizeOrig->width, $sizeOrig->height);
                break;
        }
        
        return $cache;
    }
}