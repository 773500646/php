<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title></title>
	</head>
	<body>
		<?php
			// 1:传入页码
			$page=$_GET['p'];
			// 2:根据页码取出数据：php-mysql处理
			$host='localhost';
			$username='root';
			$password='';
			$db='test';
			//链接数据库
			$conn=mysql_connect($host,$username,$password);
			if(!$conn){
				echo '数据连接失败';
				exit;
			}else{
				echo '数据库连接成功<br />';
			};
			//选择连接数据库
			mysql_select_db($db,$conn);
			//设置数据库编码格式
			mysql_query("SET NAMES UTF8");
			//编写sql 获取分页数据 SELECT * FROM 表名 LIMIT 起始位置,显示条数
			$sql = "SELECT * FROM newinfos LIMIT " .($page-1)*10 .",10";
			var_dump($sql);
			//把sql语句传送数据库
			$result=mysql_query($sql,$conn);
			//处理数据
			while($row=mysql_fetch_assoc($result)){
				echo $row['id'].'-'.$row['loginname'].'-'.$row['password'].'<br />';
			}
		
			$prev='<a href='.$_SERVER["PHP_SELF"].'?p='.($page-1).'>上一页</a>';
			$next='<a href='.$_SERVER["PHP_SELF"].'?p='.($page+1).'>下一页</a>';
			//显示数据+分页条
			echo $prev;
			echo $next;
		?>	
	</body>
</html>