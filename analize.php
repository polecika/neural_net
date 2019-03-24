<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Лабоаторная работа по нейсроным сетям</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    </head>
<?php if(isset($_POST["add_file"])) { 
$uploaddir = 'images/'; 
$error_flag = $_FILES["img"]["error"]; 
if($error_flag == 0) 
	{ 
		if($_FILES['img']['type'] == "image/gif" || $_FILES['img']['type'] == "image/jpg" || $_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png") 
		{ 
			$uploadfile = $uploaddir .time().'_'. basename($_FILES['img']['name']); 
			move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile);
		   	//header('Location: learning.php'); 
			echo '<h4>Файл успешно загружен</h4>';
			$im = imagecreatefrompng($uploadfile); //анализируем картинку. Формат картинки png
			$a = array();
			for ($y = 0; $y <= 4; $y++)
            {
                for ($x = 0; $x <= 2; $x++)
                {
                     $rgb = imagecolorat($im, $x, $y); 
                   $color=imagecolorsforindex($im, $rgb); 
                   if($color['red']>127){ 
                      $color=0; //если белое
                   }else{ 
                      $color=1; //если черное
                   } 
                    echo $color.' ' ;
                    array_push($a, $color);
                    
                }
                echo '<br/>';

            }
			
		} 
		else 
		{ 
		echo 'Недопустимый формат изображения'; 
		} 
	} 
}

else { 
//$error='Изображение не загружено. Попробуйте ещё раз'; 
}
echo $error;

 class Perseptron
    {
        public $x = array();
        public $W = array();
        public $Sum;
        public $porog = 1;
        public $del;
        
        public function __construct()
        {
        
        }
        
        public function Summ($x,$W) //функция суммы
        {
            $Sum = 0;
            for($i=0;$i<15;$i++)
            {
                $Sum+=$x[$i]*$W[$i];
            }
            return $Sum;
        }
        public function porog($Sum, $porog) //пороговая функция
        {
            if($Sum < $porog && $Sum> 0) {
                return true;
            }
            else
            {
                return false;
        }
        }
        public function W_new($W, $x, $porog, $Sum) { //метод меняет веса
            for($i=0;$i<15;$i++)
            {
                $W[$i]=$W[$i]+($porog-$Sum)*$x[$i]*0.1;
            }
            return $W;
        }
        
            
        
    }
?>

    <body>
        <h2>Загрузите изображение для анализа</h2>
        <form role="form" enctype="multipart/form-data" method="POST" action="analize.php">
    		<div class="form-group">
    			<label>Добавьте еще фотографий</label>
    			<input name="add_file" hidden>
    			<input type="file" name="img" required>
    		</div>
    		<input type="submit" value="Проверить">
        </form>
        <hr>
        <?
            if(isset($_POST["add_file"]))    {   
                $pers = new Perseptron();
                //$a = array(1,1,1,0,0,1,1,1,1,0,0,1,1,1,1);//дала входы
                
                //$vesa = array(0.1,0.1,0.1,0.1,0.1,0.4,0.1,0.1,0.1,0.1,0.1,0.1,0.1,0.1,0.1);//дала веса
                $vesa_str = file_get_contents('w.txt'); //в этом файле хранятся веса
                $vesa = explode(',',  $vesa_str); //разбиваем веса в массив
                
                if($pers->porog($pers->Summ($a,$vesa), 1) === true)
                {
                    echo 'На картинке изображена цифра три<br>';
                        
                }
                    
                else
                {
                    echo 'Не получилось распознать тройку. Если вы уверены, что изображена цифра три, зайдите в режим обучения<br>';
                }
                
               
            }
        ?>
        <a href="learning.php"><button>Начать обучение</button></a><a href="index.php"><button>Вернуться в меню</button></a>
    </body>
</html>