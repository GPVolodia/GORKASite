<?php 
class PatternsController 
{
	public function actionView()
	{
		self::singleton();
		self::factory_method();
		self::prototype();
		self::builder();
	}

	public static function singleton()
	{
		echo "<br><br>Приклад роботи singleton : <br>";
		$firstProduct = Product::getInstance();
		$secondProduct = Product::getInstance();

		$firstProduct->a = 1;
		$secondProduct->a = 2;

		print_r($firstProduct->a);
		// 2
		print_r($secondProduct->a);
		// 2
	}

	public static function factory_method()
	{
		echo "<br><br>Приклад factory_method : <br>";
		$factory = new FirstFactory();
		$firstProduct = $factory->getProduct();
		$factory = new SecondFactory();
		$secondProduct = $factory->getProduct();
	
		print_r($firstProduct->getName());
		// The first product
		print_r($secondProduct->getName());
	}

	public static function prototype()
	{
		echo "<br><br>Приклад prototype : <br>";
		$prototypeFactory = new Factory_PR(new SomeProduct());

		$firstProduct = $prototypeFactory->getProduct();
		$firstProduct->name = 'The first product';

		$secondProduct = $prototypeFactory->getProduct();
		$secondProduct->name = 'Second product';

		print_r($firstProduct->name);
		// The first product
		print_r($secondProduct->name);
	}

	public static function builder()
	{
		echo "<br><br>Приклад builder : <br>";
		$firstDirector = new Factory_BUILDER(new FirstBuilder());
		$secondDirector = new Factory_BUILDER(new SecondBuilder());
		print_r($firstDirector->getProduct()->getName());
		// The product of the first builder
		print_r($secondDirector->getProduct()->getName());
		// The product of second builder
	}
}
///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
class Product
{

    
    private static $instance;

    public $a;

    // Returns himself
    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }
}

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
interface Factory_
{

   //return product
    public function getProduct();
}

//product
interface Product_
{

    //return name of product
    public function getName();
}

class FirstFactory implements Factory_
{

    //return first product
    public function getProduct()
    {
        return new FirstProduct();
    }
}


class SecondFactory implements Factory_
{

    //return second product
    public function getProduct()
    {
        return new SecondProduct();
    }
}

//first product
class FirstProduct implements Product_
{

    //return firdt product
    public function getName()
    {
        return 'The first product';
    }
}

//second product
class SecondProduct implements Product_
{

   //return second product
    public function getName()
    {
        return 'Second product';
    }
}

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
interface Product_PR
{
}

class Factory_PR
{

    private $product;


    public function __construct(Product_PR $product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return clone $this->product;
    }
}

class SomeProduct implements Product_PR
{
    public $name;
}

///////////////////////////////////////////////////////
///////////////////////////////////////////////////////
class Product_BUILDER
{

    private $name;

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}

class Factory_BUILDER
{

    private $builder;

	public function __construct(Builder $builder)
    {
        $this->builder = $builder;
        $this->builder->buildProduct();
    }

    public function getProduct()
    {
        return $this->builder->getProduct();
    }
}

abstract class Builder
{

    protected $product;

   final public function getProduct()
    {
        return $this->product;
    }

    public function buildProduct()
    {
        $this->product = new Product_BUILDER();
    }
}


class FirstBuilder extends Builder
{
    public function buildProduct()
    {
        parent::buildProduct();
        $this->product->setName('The product of the first builder');
    }
}

class SecondBuilder extends Builder
{

    public function buildProduct()
    {
        parent::buildProduct();
        $this->product->setName('The product of second builder');
    }
}

/*
 * =====================================
 *            USING OF BUILDER
 * =====================================
 */

////STRATEGY
class StrategyContext {
    private $strategy = NULL; 
    public function __construct($strategy_ind_id) {
        switch ($strategy_ind_id) {
            case "C": 
                $this->strategy = new StrategyCaps();
            break;
            case "E": 
                $this->strategy = new StrategyExclaim();
            break;
            case "S": 
                $this->strategy = new StrategyStars();
            break;
        }
    }
    public function showBookTitle($book) { return $this->strategy->showTitle($book);  }
}

interface StrategyInterface {
    public function showTitle($book_in);
}
 
class StrategyCaps implements StrategyInterface {
    public function showTitle($book_in) {
        $title = $book_in->getTitle();
        $this->titleCount++;
        return strtoupper ($title);    }
}

class StrategyExclaim implements StrategyInterface {
    public function showTitle($book_in) {
        $title = $book_in->getTitle();
        $this->titleCount++;
        return Str_replace(' ','!',$title);
    }
}

class StrategyStars implements StrategyInterface {
    public function showTitle($book_in) {
        $title = $book_in->getTitle();
        $this->titleCount++;
        return Str_replace(' ','*',$title);
    }
}

class Book {
    private $author;
    private $title;
    function __construct($title_in, $author_in) {
        $this->author = $author_in;
        $this->title  = $title_in;
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
    function getAuthorAndTitle() {
        return $this->getTitle() . ' by ' . $this->getAuthor();
    }
}


////decorator
class Book {
    private $author;
    private $title;
    function __construct($title_in, $author_in) {
        $this->author = $author_in;
        $this->title  = $title_in;
    }
    function getAuthor() {
        return $this->author;
    }
    function getTitle() {
        return $this->title;
    }
    function getAuthorAndTitle() {
      return $this->getTitle().' by '.$this->getAuthor();
    }
}

class BookTitleDecorator {
    protected $book;
    protected $title;
    public function __construct(Book $book_in) {
        $this->book = $book_in;
        $this->resetTitle();
    }   
    //doing this so original object is not altered
    function resetTitle() {
        $this->title = $this->book->getTitle();
    }
    function showTitle() {
        return $this->title;
    }
}

class BookTitleExclaimDecorator extends BookTitleDecorator {
    private $btd;
    public function __construct(BookTitleDecorator $btd_in) {
        $this->btd = $btd_in;
    }
    function exclaimTitle() {
        $this->btd->title = "!" . $this->btd->title . "!";
    }
}

class BookTitleStarDecorator extends BookTitleDecorator {
    private $btd;
    public function __construct(BookTitleDecorator $btd_in) {
        $this->btd = $btd_in;
    }
    function starTitle() {
        $this->btd->title = Str_replace(" ","*",$this->btd->title);
    }
}
?>