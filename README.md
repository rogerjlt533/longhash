# longhash

##功能介绍
对于长文本内容使用关键词进行加密/解密

##使用范例

require '../vendor/autoload.php';

$content = "test";
$hashTool = new \Fallen\Longhash\HashTool("longhash");
$encodeText = $hashTool->encode($content);
$decodeText = $hashTool->decode($encodeText);