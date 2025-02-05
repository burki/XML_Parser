--TEST--
XML Parser: parse simple string
--SKIPIF--
<?php if (!extension_loaded("xml")) echo 'skip'; ?>
--FILE--
<?php
//
// Test for: XML/Parser.php
// Parts tested: - parser creation
//               - some handlers
//               - parse simple string
//
require_once "XML/Parser.php";

class __TestParser1 extends XML_Parser {
    function startHandler($xp, $element, $attribs) {
        print "<$element";
        foreach($attribs as $key => $val) {
            $enc = htmlentities($val);
            print " $key=\"$enc\"";
        }
        print ">";
    }
    function endHandler($xp, $element) {
        print "</$element>\n";
    }
    function cdataHandler($xp, $cdata) {
        print "<![CDATA[$cdata]]>";
    }
    function defaultHandler($xp, $cdata) {

    }
}
print "new __TestParser1 ";
var_dump(strtolower(get_class($o = new __TestParser1())));
print "parseString ";
var_dump($o->parseString("<?xml version='1.0' ?><root>foo</root>", 1));

?>
--EXPECT--
new __TestParser1 string(13) "__testparser1"
parseString <ROOT><![CDATA[foo]]></ROOT>
bool(true)
