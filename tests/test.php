<?php
/**
 *
 * Date: 2022/6/30
 * Time: 11:35
 */

require '../vendor/autoload.php';

$content = "<p>德国政治学家 Max Weber 提出了关于合法性（权威/<span data-mention='' class='hashtag-suggestion' data-id='权力'>#权力 </span> ）来源的三个途径： </p><ul><li><p>传统型权威。即一直都这样并且一直都存在，大家认同传统的力量，例如世袭制度。 </p></li><li><p>法理型权威。即用规则和法律来获得权威，大家认同的是规则而非个人，当今世界的社会治理普遍如此。 </p></li><li><p>魅力型权威。即领袖有着超凡的魅力或特质，使得大家愿意追随，例如所有的大革命时期的领袖，也正是因为这样魅力型权威普遍有革命性。 </p></li></ul>";
$hashTool = new \Fallen\Longhash\HashTool("longhash");
$encodeText = $hashTool->encode($content);
$decodeText = $hashTool->decode($encodeText);