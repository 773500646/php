<?php
	namespace app;
	use libs\ImhttpRequest;
	use libs\imRedis;
	class QueryPhone
	{	
		const TAOBAO_API='https://tcc.taobao.com/cc/json/mobile_tel_segment.htm';
		const CACHE_KEY='PHONE:INFO';
		public static function query($phone){
			$ret=array();
			if(self::validPhone($phone)){
				$redisKey=substr($phone,0,7);
				$phoneInfo=ImRedis::getRedis()->hGet(self::CACHE_KEY,$redisKey);
				if($phoneInfo){
					$ret=json_decode($phoneInfo,true);
					$ret['msg']='由个人提供数据';
				}else{
					$response=ImhttpRequest::request(self::TAOBAO_API,array('tel'=>$phone));
					$data=self::formatData($response);
					if($data){
						$json=json_encode($data);
						ImRedis::getRedis()->hSet(self::CACHE_KEY,$redisKey,$json);
						$data['msg']='由阿里巴巴提供数据';
						$ret=$data;
					}
				}
			};
			return $ret;
		}
		//检查手机号合法性
		public static function validPhone($phone=null){
			$ret=false;
			if($phone){
				if(preg_match('/^1[34578]{1}\d{9}/',$phone)){
						$ret=true;
				}
			}
			return $ret;
		}
		//格式化API请求回来的数据m
		public static function formatData($data=null){
			$ret=false;
			if($data){
				preg_match_all("/(\w+):'([^']+)/",$data,$res);
				$items=array_combine($res[1],$res[2]);
				foreach($items as $key=>$value){
					$ret[$key]=iconv('GB2312','UTF-8',$value);
				}
			}
			return $ret;
		}
	}
?>