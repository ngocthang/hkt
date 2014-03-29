Framgia Hyakkaten Project - Coding Standard 
=================

1. PHP version
-----------

* PHP 5.4 or higher (5.5 recommended)

2. Cách đặt tên
-----------

* Class, Function
Tên Class bắt đầu bằng chữ hoa, Function bắt đầu bằng chữ thường. Cả hai đều viết theo kiểm CamelCase.

Ví dụ Class: `MailSender`, `UserIdentity` ...

Ví dụ Function: `addCondition()`, `sendMail()` ...

* Biến
Đặt tên biến theo kiểu snake_case

Ví dụ: `is_admin`, `user_id` …

* Private function và private variable của một class phải bắt đầu bằng dấu `_`, nhưng protected function và protected variable thì không cần.

Ví dụ `$_status`, `_sort()`, `_initTree()` …

* Constant
Tên Constants thì được viết hoa toàn bộ, có dấu `_` giữa các từ.

Ví dụ A_CONSTANT_VARIABLE

3. Indent
--------------

Không sử dụng tab, lấy indent là 4 dấu cách

4. String
--------------

Sử dụng nháy đơn cho string thông thường.
```php
$str = 'This is a string';
echo 'This is a string';
```
Chỉ dùng nháy kép khi trong đó có biến PHP.
```php
echo "result = {$result}";
```
5. Biểu thức điều kiện 
--------------

Viết if, else theo cấu trúc sau 
```php
if ((condition1) || (condition2)) {
    action1;
} elseif ((condition3) && (condition4)) {
    action2;
} else {
    defaultaction;
}
```

Khi sử dụng switch, thì case được viết cùng indent với switch
```php
switch (condition) {
case 1:
    action1;
    break;

case 2:
    action2;
    break;

default:
    defaultaction;
    break;
}
```

Nếu một câu điều kiện quá dài, thì phải tách ra thành các dòng khác nhau theo quy tắc sau:
* Các điều kiện được đặt trên các dòng khác nhau, indent là 4.
* Các phép logic được đặt cùng hàng với điều kiện (để dễ dàng comment, hoặc xoá)
* Dấu đóng ngoặc sau khi kết thúc điều kiện được đặt ở một dòng riêng.
```php
if (($condition1
    || $condition2)
    && $condition3
    && $condition4
) {
    // code here
}
```
* Điều kiện đầu tiên có thể được căn thẳng hàng với các điều kiện khác
```php
if (   $condition1
    || $condition2
    || $condition3
) {
    // code here
}
```
* Để giữ cho việc không phải xuống dòng thì có thể tách nhỏ biểu thức điều kiện ra bằng cách sử dụng thêm các biến trung gian ở ngoài.
```php
$is_foo = ($condition1 || $condition2);
$is_bar = ($condition3 && $condtion4);
if ($is_foo && $is_bar) {
    // code here
}
```
Một phép toán ternary cũng có thể được chia ra làm nhiều dòng, và dấu `?` hay dấu `:` được đặt ở đầu dòng mới.
```php
$a = $condition1 && $condition2
    ? $foo : $bar;

$b = $condition3 && $condition4
    ? $foo_man_this_is_too_long_what_should_i_do
    : $bar;
```
6. Function 
--------------

Cách gọi Functions. 
* Không có dấu cách giữa tên hàm và dấu mở ngoặc
* Không có dấu cách giữa dấu mở ngoặc và tên biến đầu tiên
* Có dấu cách giữa dấu phẩy và tên biến
* Không có dấu cách giữa tên biến cuối cùng và dấu đóng ngoặc
* Không có dấu cách giữa dấu đóng ngoặc và dấu chấm phẩy.
```php
$var = foo($bar, $baz, $quux);
```
Có một dấu cách trước và sau dấu bằng trong phép gán. Tuy nhiên trong một block có nhiều phép gán thì có thể chèn thêm các dấu cách vào để cho các dấu bằng thẳng hàng.
```php
$short         = foo($bar);
$long_variable = foo($baz);
```
Khi gọi đến cùng một hàm, có thể chèn thêm các dấu cách để các tham số truyền vào được thẳng hàng.
```php
$this->callSomeFunction('param1',     'second',        true);
$this->callSomeFunction('parameter2', 'third',         false);
$this->callSomeFunction('3',          'verrrrrrylong', true);
```
Gọi một hàm với nhiều tham số truyền vào thì có thể viết trên nhiều dòng khác nhau.

Có thể viết nhiều tham số trên một hàm.
* Tham số trên một dòng mới được lùi vào 4 dấu cách so với dòng gọi hàm.
* Dấu mở ngoặc được đặt ở cuối dòng gọi hàm.
* Dấu đóng ngặc được đặt ở một dòng mới, sau dòng chứa tham số cuối cùng.
* Quy tắc trên cũng áp dụng khi truyền array vào hàm.
```php
$this->someObject->subObject->callThisFunctionWithALongName(
    $this->someOtherFunc(
        $this->someEvenOtherFunc(
            'Help me!',
            [
                'foo'  => 'bar',
                'spam' => 'eggs',
            ],
            23
        ),
        $this->someEvenOtherFunc()
    ),
    $this->wowowowowow(12)
);
```
* Một object có thể gọi đến nhiều hàm lần lượt. Mỗi lời gọi hàm có thể được viết trên một dòng. Khi đó dấu `->` được lùi vào 4 dấu cách.
```php
$someObject->someFunction("some", "parameter")
    ->someOtherFunc(23, 42)
    ->andAThirdFunction();
```
* Để dễ dọc thì trong những phép gán, nên canh để các dấu bằng thẳng hàng
```php
$short  = foo($bar);
$longer = foo($baz);
```
Tuy nhiên quy tắc này có thể được phá bỏ nếu tên một biến dài (hoặc ngắn) hơn ít nhất 8 ký tự so với biến khác.
```php
$short = foo($bar);
$thisVariableNameIsVeeeeeeeeeeryLong = foo($baz);
```
Một phép gán có thể tách ra làm nhiều dòng, khi đó dấu bằng được đặt ở dòng mới, và lùi vào 4 dấu cách.
```php
$GLOBALS['TSFE']->additionalHeaderData[$this->strApplicationName]
    = $this->xajax->getJavascript(t3lib_extMgm::siteRelPath('nr_xajax'));
```
7. Định nghĩa Class
--------------

Khi định nghĩa một class thì dấu `{` được đặt ở một dòng mới.
```php
class Foo_Bar
{
    //... code goes here
}
```
8. Định nghĩa Function
--------------

Khi định nghĩa một hàm thì dấu `{` được đặt ở một dòng mới. Các đối số có giá trị mặc định được đặt ở cuối.
```php
function fooFunction($arg1, $arg2 = '')
{
    if (condition) {
        statement;
    }
    return $val;
}
```
Cố gắng trả về giá trị của hàm sau khi kết thúc.
```php
function connect(&$dsn, $persistent = false)
{
    if (is_array($dsn)) {
        $dsninfo = &$dsn;
    } else {
        $dsninfo = DB::parseDSN($dsn);
    }

    if (!$dsninfo || !$dsninfo['phptype']) {
        return $this->raiseError();
    }

    return true;
}
```
Hàm có nhiều đối số thì có thể được tách ra làm nhiều dòng. Dòng mới lùi vào 4 dấu cách. Dấu đóng ngoặc được đặt ở dòng mới, thẳng hàng với từ khoá function
```php
function someFunctionWithAVeryLongName($firstParameter = 'something', 
    $secondParameter = 'booooo',
    $third = null, $fourthParameter = false, $fifthParameter = 123.12,
    $sixthParam = true
) 
{
    //....
}
```
9. Array
--------------

* Không dùng `array()`, thay vào đó hãy dùng `[]`.
* Khi tách array thành nhiều dòng thì ở dòng cuối cùng, vẫn chèn dấu `,` như bình thường.  
```php
$some_array =  [
    'key'  => 'val',
    'foo' => 'bar',
];
```
10. PHP Code Tags
--------------

* Luôn sử dụng `<?php ?>`. Không dùng `<? ?>`. 
* Có thể dùng `<?= ?>`.
* Nếu trong một file mà chỉ gồm code php thì ở cuối file không dùng đóng tag `?>`

11. Comments
--------------

Sử dụng comment style của C (`/* */`) hoặc C++ (`//`). 

Không nên dùng của Perl/shell (`#`)

12.	Cách viết comment cho một class 
--------------

* Cần viết comment cho mỗi biến khai báo trong một class. Phần comment được đặt ngay phía trên phần khai báo biến.

Cấu trúc : `@var ClassName (VariableName) Nội dung comment`

Ví dụ
```php
/**
 * @var ActiveRecord the currently loaded data model instance.
 */
 
private $_model;
```
* Cần viết comment cho mỗi hàm trong một class. Phần comment được đặt ngay phía trước phần khai báo hàm.
Cấu trúc :
```php
@param ClassName VariableName
@return ClassName VariableName
```
Ví dụ
```php
/**
* Returns the static model of the specified AR class.
* @param string $className active record class name.
* @return User the static model class
*/
public static function model($className = __CLASS__) 
{
    return parent::model($className);
}
```

* Như vậy nhìn chung, trong một class, khi khai báo biến mình cần comment xem biến đó là loại gì (thuộc về class gì, hay là `string`, `array` …) thông qua từ khoá `@var`, khi khai báo hàm cần comment xem tham số truyền vào (nếu có) sẽ thuộc loại gì thông qua từ khoá `@params`, và giá trị hàm trả về (nếu có) sẽ thuộc loại gì thông qua từ khoá `@return`.
* Ngoài ra nếu có thể comment được xem biến đó, hàm đó thực hiện công việc gì trong class thì sẽ tốt hơn.