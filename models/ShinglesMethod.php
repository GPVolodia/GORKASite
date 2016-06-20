<?php
class ShinglesMethod
    {
        var $length;
        var $stopSymbols = array(".",",","!","?",":",";","-","n","r","(",")");
        var $stopWords = array('это', 'как', 'так', 'и', 'в', 'над', 'к', 'до', 'не', 'на', 'но', 'за', 'то', 'с', 'ли', 'а', 'во', 'от', 'со', 'для', 'о', 'же', 'ну', 'вы', 'бы', 'что', 'кто', 'он', 'она');
 
        function ShinglesMethod($length, $stopSymbols = false, $stopWords = false)
        {
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
           // var_dump($shinglesA);
            //var_dump($shinglesB);
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