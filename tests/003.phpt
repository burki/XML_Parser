--TEST--
XML Parser: parse from file resource
--SKIPIF--
<?php if (!extension_loaded("xml")) echo 'skip'; ?>
--FILE--
<?php // -*- C++ -*-
//
// Test for: XML/Parser.php
// Parts tested: - parser creation
//               - some handlers
//               - parse from file resource
//
require_once "XML/Parser.php";

class __TestParser3 extends XML_Parser {
    function startHandler($xp, $element, $attribs) {
        print "<$element";
        reset($attribs);
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
print "new __TestParser3 ";
var_dump(strtolower(get_class($o = new __TestParser3())));
print "fopen ";
print is_resource($fp = fopen(dirname(__FILE__) . "/test3.xml", "r"))."\n";
print "setInput ";
var_dump($o->setInput($fp));
print "parse ";
var_dump($o->parse());

?>
--EXPECT--
new __TestParser3 string(13) "__testparser3"
fopen 1
setInput bool(true)
parse <ROOT><![CDATA[foo]]></ROOT>
bool(true)
