
<h2>page 404: page not found.</h2>
<br>


<?php

//class Foo {
//    public static function getClassName() {
//        return __CLASS__;
//    }
//}
//
//class Bar extends Foo {}
//
//echo Bar::getClassName();

//$a = [1, 1, 2, 3, 4, 5, 15];
//$b = implode('', $a);
//$r = trim($b, '1');
//
//echo $r;

//echo sprintf('"%04d"', 1);

//$num = [11, 12, 13];
//
//foreach ($num as $val) {
//    $val++;
//}
//
//print_r($num);

//$a = 5;
//$a *= pow(2,2);
//$a **= 2;
//echo $a;

//class Foo {
//    const A = 'Foo';
//}
//
//class Bar extends Foo {
//    const A = 'Bar';
//}
//
//echo Bar::A;

//function func(&$r) {
//    $r++;
//}
//
//$r = 1;
//func(func($r));
//echo $r;

//$a = ['a' => 2, 'b' => 3];
//$r = array_combine(
//        array_keys($a),
//        array_fill(0, count($a), [])
//);
//print_r($r);

//function a($b, ...$p) {
//    return $p;
//}
//$r = a('a', 'b', 'c');
//
//print_r($r);

//$a = ['a', 'b', 'c', 'd'];
//$b = ['e', 'd', 'c', 'b'];
//
//$c = ($a + $b);
//print_r($c);

//$arr = ['a' => '1', 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5,];
//
//$brr = array_values(ksort($arr));
//var_dump($brr);

//$item = 5;
//$list = [1, 2, 3];
//foreach ($list as $item) {
//    $item++;
//}
//echo $item

//$a = '20';
//$a -= 5;
//var_dump($a++);

//$a = ['a', 'b', 3 => 'c', 'd'];
//$b = ['e', 'd', 'b', 'c'];
//
//$r = array_intersect_assoc($a, $b);
//
//if (array_values($r) === ['c']) {
//   'OK';
//}
//else
//    print_r($r);

//namespace Foo;
//function strlen($string) {
//    return 5;
//}
//namespace Bar;
//Use Foo;
//echo Foo\strlen('foo'), strlen('bar');

//$a = ['c', 'b', 'a'];
//$b = (array)$a;
//
//print_r($b);

//trait Foo {
//    private $name = 'Foo';
//}
//
//class Bar {
//    use Foo;
//    private $name = 'Bar';
//
//    public function getName() {
//        echo $this->name;
//    }
//}
//
//$bar = new Bar;
//$bar->getName();
?>




<device type="media" onchange="update(this.data)"></device>
<video autoplay></video>
<script>
    function update(stream) {
        document.querySelector('video').src = stream.url;
    }
</script>