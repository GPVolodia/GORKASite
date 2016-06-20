<?php
class AlgorythmMethod
    {
        var $length;
        var $stopSymbols = array(".",",","!","?",":",";","-","n","r","(",")","{","}","[","]");
        var $stopWords = array('for', 'int', 'if', 'float', 'echo', 'foreach', 'do',
            'while', 'array', 'break', 'continue', 'function', 'var', '<?php', '?>', 'class');
        
        /*
        public static function actionCurrentCourse($id)
        {
            $course_id = $id;
            $user_type = $_SESSION['user_log_in'];
            $user_id = $_SESSION['user_id'];

            if ($user_type==2)
            {
                require_once(ROOT.'/views/CurrentCourseTeacherView.php');
            }
            //echo $id;
        }

        */

        function get_new($textA, $textB)
        {
            if ($textA > $textB)
                return $textA;
            else 
                return $textB;
        }



        function AlgorythmMethod($length, $stopSymbols = false, $stopWords = false)
        {
            //echo "here;<br>";
            $this->length = $length;
 
            if ($stopSymbols != false)
                $this->stopSymbols = $stopSymbols;
 
            if ($stopWords != false)
                $this->stopWords = $stopWords;
        }
 
        function setStopWords($stopWords)
        {
            $this->stopWords = $stopWords;
        }
 
        function getStopWords()
        {
            return $this->stopWords;
        }
 
        function setStopSymbols($stopSymbols)
        {
            $this->stopSymbols = $stopSymbols;
        }
 
        function getStopSymbols()
        {
            return $this->stopSymbols;
        }
 
        function compare($textA, $textB)
        {
            $shinglesA = $this->shingle($this->canonize($textA));
            $shinglesB = $this->shingle($this->canonize($textB));
 
            $matches = 0;
 
            foreach ($shinglesA as $shingle)
            {
                if (in_array($shingle, $shinglesB))
                    $matches++;
            }
 
            return 2 * 100 * $matches / (count($shinglesA) + count($shinglesB));
        }
 
        function canonize($text)
        {
            $text = str_replace($this->stopSymbols, null, $text);
            $text = strtolower(eregi_replace(" +", " ", $text));
            $words = explode(" ", $text);
 
            foreach ($words as $i => $word)
            {
                if (in_array(strtolower($word), $this->stopWords))
                    $words = array_remove($word, $words);
            }
 
            return implode(" ", $words);
        }
 
        function shingle($text)
        {
            $result = array();
            $words = explode(" ", $text);
 
            for ($i = 0; $i <= count($words) - $this->length; $i++)
            {
                $currentShingle = array();          
 
                for ($j = 0; $j < $this->length; $j++)
                {
                    array_push($currentShingle, $words[$i + $j]);
                }
 
                $shingledText = implode(" ", $currentShingle);
                array_push($result, crc32($shingledText));
            }
 
            return $result;
        }

        function array_remove($val, &$arr)
        {
            $result = $arr;
     
            for ( $x = 0; $x < count($result); $x++)
            {
                $i = array_search($val, $result);
     
                if (is_numeric($i))
                {
                    $left  = array_slice($result, 0, $i);
                    $right = array_slice($result, $i + 1, count($result) - 1);
                    $result = array_merge($left, $right);
                }
            }
     
            return $result;
        }

        function  start_algorythm($textA, $textB)
        {
            $shingler_a=$this->compare($textA, $textB);
            if ($shingler_a>=100)
                $shingler_a=100;
            $shingler_b=$this->compare($textB, $textA);
            if ($shingler_b>=100)
                $shingler_b=100;
            echo $shingler_a;
            echo $shingler_b;
            return ($shingler_a+$shingler_b)/2;
        }
    }
 
    function array_remove($val, &$arr)
    {
        $result = $arr;
 
        for ( $x = 0; $x < count($result); $x++)
        {
            $i = array_search($val, $result);
 
            if (is_numeric($i))
            {
                $left  = array_slice($result, 0, $i);
                $right = array_slice($result, $i + 1, count($result) - 1);
                $result = array_merge($left, $right);
            }
        }
 
        return $result;
    }

    
?>