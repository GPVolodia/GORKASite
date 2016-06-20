<?php 

class LanguageController
{
	public function actionCreate()
	{
		if ($_POST['submit'])
		{
			$filenamae = $_POST['language_name'];
			
			$bd = DB::connect();
			$query = mysql_query("INSERT INTO languages(language) VALUES ('$filenamae')");
			$n_dir = ROOT.'/language/'.$filenamae.'.php';
			//if ($fp = fopen("$n_dir", "w"))
			//	unlink("$n_dir");

			$fp = fopen("$n_dir", "w");
			
			fputs( $fp, "<?php" );
			fputs($fp, "\n");
			foreach ($_POST as $key=>$value)
			{
				if ($key == "language_name")
					$key = '$'."$key";
				if ($key == "submit")
					$key = '$'."$key";

				$key = substr($key , 0 , strlen($key)-1);
				fputs( $fp, $key );
				fputs($fp , "=");
				fputs($fp , '"');
				fputs($fp , $value);
				fputs($fp , '";');
				fputs($fp, "\n");
				

			}
			fputs($fp, "\n");
			fputs( $fp, "?>" );
			fclose($fp);

			
			
		}
		$fre = $_SESSION['lang'];
		$dir = ROOT.'/language/'.$fre.'.php';
		$fp = fopen("$dir", "r"); // Открываем файл в режиме чтения
		$i=0;
		if ($fp) 
		{
			while (!feof($fp))
			{
				$mytext = fgets($fp, 999);
				$findme    = '$';
				$mystring1 = $mytext;

				$pos1 = stripos($mystring1, $findme);
				if ($pos1 !== false) {
    				list($some_adress, $value)=explode('=', $mytext);
    				$langa[$some_adress] = $value;
				}
				$i++;	
			}
		}
		else echo "Ошибка при открытии файла";
		
		require_once(ROOT. '/views/LanguagesView.php');
		
		fclose($fp);
	}
}
?>