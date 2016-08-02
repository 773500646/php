<?php 
	namespace libs;
	class ImhttpRequest
	{
		public static function request($url,$params,$method="GET")
		{
			$response=null;
			if($url){
				$method=strtoupper($method);
				if($method=='POST'){
					
				}else if($method=='PUT'){
					
				}else if($method=='DELETE'){
					
				}else{
					if(is_array($params) and count($params)){
						if(strrpos($url,'?')){
							$url=$url.'&'.http_build_query($params);
						}else{
							$url=$url.'?'.http_build_query($params);
						}
						//var_dump($url);
						$response=file_get_contents($url);
					}
					
				}
			}
			return $response;
		}
	}
?>