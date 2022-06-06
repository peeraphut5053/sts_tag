<?php
class ReplaceHtml{
	var $mainDetail;

	function ReplaceHtml($filePath){
		$this->mainDetail = $this->getTemplate($filePath);
	}

	function setReplace($sign,$data){
		$this->mainDetail = str_replace($sign,$data,$this->mainDetail);
	}	

	function getReplace(){
		return $this->mainDetail;
	}

	function getTemplate($filePath="") {
		return implode('',file($filePath));					
	} 
}
?>