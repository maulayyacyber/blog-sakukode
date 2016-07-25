-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 20, 2015 at 08:39 
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbsaku`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_articles`
--

CREATE TABLE IF NOT EXISTS `blog_articles` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_title` varchar(100) NOT NULL,
  `article_url` varchar(100) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `content` longtext CHARACTER SET utf8 NOT NULL,
  `author_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('publish','draft') NOT NULL DEFAULT 'publish',
  `picture` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`article_id`),
  UNIQUE KEY `article_url` (`article_url`),
  KEY `author_id` (`author_id`),
  KEY `status` (`status`),
  KEY `article_id` (`article_id`),
  KEY `article_url_2` (`article_url`),
  KEY `deleted` (`deleted`),
  KEY `article_id_2` (`article_id`,`article_url`,`author_id`,`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `blog_articles`
--

INSERT INTO `blog_articles` (`article_id`, `article_title`, `article_url`, `keyword`, `content`, `author_id`, `date`, `status`, `picture`, `created_at`, `updated_at`, `deleted`) VALUES
(1, 'Hello World', 'hello-world', 'hello,world,introduction', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. &amp;lt;!--more--&amp;gt;Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\n\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\n\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', 7, '2015-02-10 06:08:24', 'publish', 'company-profile.jpg', '2014-12-10 11:16:23', '2015-02-10 13:08:24', 0),
(2, 'Example Code Snippets', 'example-code-snippets', 'post,snippets', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;lt;!--more--&amp;gt;&lt;/p&gt;\n\n&lt;p&gt;Css Snippets :&lt;br /&gt;\n&amp;nbsp;&lt;/p&gt;\n\n&lt;pre class=&quot;code&quot; data-language=&quot;css&quot;&gt;\n@media screen and (-webkit-min-device-pixel-ratio: 0) {\n  body:first-of-type pre::after {\n    content: &amp;#39;highlight: &amp;#39; attr(class);\n  }\n  body {\n    background: linear-gradient(45deg, blue, red);\n  }\n}\n\n@import url(&amp;#39;print.css&amp;#39;);\n@page:right {\n margin: 1cm 2cm 1.3cm 4cm;\n}\n\n@font-face {\n  font-family: Chunkfive; src: url(&amp;#39;Chunkfive.otf&amp;#39;);\n}\n\ndiv.text,\n#content,\nli[lang=ru] {\n  font: Tahoma, Chunkfive, sans-serif;\n  background: url(&amp;#39;hatch.png&amp;#39;) /* wtf? */;  color: #F0F0F0 !important;\n  width: 100%;\n}&lt;/pre&gt;\n\n&lt;p&gt;Javascript Snippets&lt;/p&gt;\n\n&lt;pre class=&quot;code&quot; data-language=&quot;javascript&quot;&gt;\nfunction $initHighlight(block, flags) {\n  try {\n    if (block.className.search(/\\bno\\-highlight\\b/) != -1)\n      return processBlock(block.function, true, 0x0F) + &amp;#39; class=&amp;quot;&amp;quot;&amp;#39;;\n  } catch (e) {\n    /* handle exception */\n    var e4x =\n        &amp;lt;div&amp;gt;Example\n            &amp;lt;p&amp;gt;1234&amp;lt;/p&amp;gt;&amp;lt;/div&amp;gt;;\n  }\n  for (var i = 0 / 2; i &amp;lt; classes.length; i++) { // &amp;quot;0 / 2&amp;quot; should not be parsed as regexp\n    if (checkCondition(classes[i]) === undefined)\n      return /\\d+[\\s/]/g;\n  }\n  console.log(Array.every(classes, Boolean));\n}\n&lt;/pre&gt;\n\n&lt;p&gt;PHP Snippets&lt;/p&gt;\n\n&lt;pre class=&quot;code&quot; data-language=&quot;php&quot;&gt;\n&amp;lt;?php\nrequire_once &amp;#39;Zend/Uri/Http.php&amp;#39;;\n\nnamespace Location\\Web;\n\ninterface Factory\n{\n    static function _factory();\n}\n\nabstract class URI extends BaseURI implements Factory\n{\n    abstract function test();\n\n    public static $st1 = 1;\n    const ME = &amp;quot;Yo&amp;quot;;\n    var $list = NULL;\n    private $var;\n\n    /**\n     * Returns a URI\n     *\n     * @return URI\n     */\n    static public function _factory($stats = array(), $uri = &amp;#39;http&amp;#39;)\n    {\n        echo __METHOD__;\n        $uri = explode(&amp;#39;:&amp;#39;, $uri, 0b10);\n        $schemeSpecific = isset($uri[1]) ? $uri[1] : &amp;#39;&amp;#39;;\n        $desc = &amp;#39;Multi\nline description&amp;#39;;\n\n        // Security check\n        if (!ctype_alnum($scheme)) {\n            throw new Zend_Uri_Exception(&amp;#39;Illegal scheme&amp;#39;);\n        }\n\n        $this-&amp;gt;var = 0 - self::$st;\n        $this-&amp;gt;list = list(Array(&amp;quot;1&amp;quot;=&amp;gt; 2, 2=&amp;gt;self::ME));\n\n        return [\n            &amp;#39;uri&amp;#39;   =&amp;gt; $uri,\n            &amp;#39;value&amp;#39; =&amp;gt; null,\n        ];\n    }\n}\n\necho URI::ME . URI::$st1;\n\n__halt_compiler () ; datahere\ndatahere\ndatahere */\ndatahere&lt;/pre&gt;\n\n&lt;p&gt;Sql Snippets&lt;/p&gt;\n\n&lt;pre class=&quot;code&quot;&gt;\nBEGIN;\nCREATE TABLE &amp;quot;topic&amp;quot; (\n    -- This is the greatest table of all time\n    &amp;quot;id&amp;quot; serial NOT NULL PRIMARY KEY,\n    &amp;quot;forum_id&amp;quot; integer NOT NULL,\n    &amp;quot;subject&amp;quot; varchar(255) NOT NULL -- Because nobody likes an empty subject\n);\nALTER TABLE &amp;quot;topic&amp;quot; ADD CONSTRAINT forum_id FOREIGN KEY (&amp;quot;forum_id&amp;quot;) REFERENCES &amp;quot;forum&amp;quot; (&amp;quot;id&amp;quot;);\n\n-- Initials\ninsert into &amp;quot;topic&amp;quot; (&amp;quot;forum_id&amp;quot;, &amp;quot;subject&amp;quot;) values (2, &amp;#39;D&amp;#39;&amp;#39;artagnian&amp;#39;);\n\nselect /* comment */ count(*) from cicero_forum;\n\n-- this line lacks ; at the end to allow people to be sloppy and omit it in one-liners\n/*\nbut who cares?\n*/\nCOMMIT&lt;/pre&gt;\n\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 7, '2014-12-11 06:37:06', 'publish', 'slider_1.png', '2014-12-10 13:02:14', '2014-12-11 13:37:06', 0),
(3, 'Example Post With Image', 'example-post-with-image', 'post', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;lt;!--more--&amp;gt;&lt;/p&gt;\n\n&lt;p&gt;&lt;img alt=&quot;juventus&quot; src=&quot;http://i60.tinypic.com/dli2pu.jpg&quot; /&gt;&lt;/p&gt;\n\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\n\n&lt;p&gt;&lt;img alt=&quot;angminsoftware&quot; src=&quot;http://imagizer.imageshack.us/v2/640x480q90/540/Y8t1Zr.png&quot; /&gt;&lt;/p&gt;', 7, '2014-12-11 11:34:11', 'draft', '', '2014-12-10 13:12:47', '2014-12-11 18:34:11', 0),
(4, 'Hello World 2', 'hello-world-2', 'hello,world,introduction', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. &amp;lt;!--more--&amp;gt;Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', 7, '2014-12-10 10:32:25', 'publish', 'hello-world.jpg', '2014-12-10 11:16:23', '2014-12-10 17:32:25', 0),
(5, 'Example Code Snippets 2', 'example-code-snippets-2', 'post,snippets', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;lt;!--more--&amp;gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Css Snippets :&lt;br /&gt;\r\n&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;pre class=&quot;code&quot; data-language=&quot;css&quot;&gt;\r\n@media screen and (-webkit-min-device-pixel-ratio: 0) {\r\n  body:first-of-type pre::after {\r\n    content: &amp;#39;highlight: &amp;#39; attr(class);\r\n  }\r\n  body {\r\n    background: linear-gradient(45deg, blue, red);\r\n  }\r\n}\r\n\r\n@import url(&amp;#39;print.css&amp;#39;);\r\n@page:right {\r\n margin: 1cm 2cm 1.3cm 4cm;\r\n}\r\n\r\n@font-face {\r\n  font-family: Chunkfive; src: url(&amp;#39;Chunkfive.otf&amp;#39;);\r\n}\r\n\r\ndiv.text,\r\n#content,\r\nli[lang=ru] {\r\n  font: Tahoma, Chunkfive, sans-serif;\r\n  background: url(&amp;#39;hatch.png&amp;#39;) /* wtf? */;  color: #F0F0F0 !important;\r\n  width: 100%;\r\n}&lt;/pre&gt;\r\n\r\n&lt;p&gt;Javascript Snippets&lt;/p&gt;\r\n\r\n&lt;pre class=&quot;code&quot; data-language=&quot;javascript&quot;&gt;\r\nfunction $initHighlight(block, flags) {\r\n  try {\r\n    if (block.className.search(/\\bno\\-highlight\\b/) != -1)\r\n      return processBlock(block.function, true, 0x0F) + &amp;#39; class=&amp;quot;&amp;quot;&amp;#39;;\r\n  } catch (e) {\r\n    /* handle exception */\r\n    var e4x =\r\n        &amp;lt;div&amp;gt;Example\r\n            &amp;lt;p&amp;gt;1234&amp;lt;/p&amp;gt;&amp;lt;/div&amp;gt;;\r\n  }\r\n  for (var i = 0 / 2; i &amp;lt; classes.length; i++) { // &amp;quot;0 / 2&amp;quot; should not be parsed as regexp\r\n    if (checkCondition(classes[i]) === undefined)\r\n      return /\\d+[\\s/]/g;\r\n  }\r\n  console.log(Array.every(classes, Boolean));\r\n}\r\n&lt;/pre&gt;\r\n\r\n&lt;p&gt;PHP Snippets&lt;/p&gt;\r\n\r\n&lt;pre class=&quot;code&quot; data-language=&quot;php&quot;&gt;\r\n&amp;lt;?php\r\nrequire_once &amp;#39;Zend/Uri/Http.php&amp;#39;;\r\n\r\nnamespace Location\\Web;\r\n\r\ninterface Factory\r\n{\r\n    static function _factory();\r\n}\r\n\r\nabstract class URI extends BaseURI implements Factory\r\n{\r\n    abstract function test();\r\n\r\n    public static $st1 = 1;\r\n    const ME = &amp;quot;Yo&amp;quot;;\r\n    var $list = NULL;\r\n    private $var;\r\n\r\n    /**\r\n     * Returns a URI\r\n     *\r\n     * @return URI\r\n     */\r\n    static public function _factory($stats = array(), $uri = &amp;#39;http&amp;#39;)\r\n    {\r\n        echo __METHOD__;\r\n        $uri = explode(&amp;#39;:&amp;#39;, $uri, 0b10);\r\n        $schemeSpecific = isset($uri[1]) ? $uri[1] : &amp;#39;&amp;#39;;\r\n        $desc = &amp;#39;Multi\r\nline description&amp;#39;;\r\n\r\n        // Security check\r\n        if (!ctype_alnum($scheme)) {\r\n            throw new Zend_Uri_Exception(&amp;#39;Illegal scheme&amp;#39;);\r\n        }\r\n\r\n        $this-&amp;gt;var = 0 - self::$st;\r\n        $this-&amp;gt;list = list(Array(&amp;quot;1&amp;quot;=&amp;gt; 2, 2=&amp;gt;self::ME));\r\n\r\n        return [\r\n            &amp;#39;uri&amp;#39;   =&amp;gt; $uri,\r\n            &amp;#39;value&amp;#39; =&amp;gt; null,\r\n        ];\r\n    }\r\n}\r\n\r\necho URI::ME . URI::$st1;\r\n\r\n__halt_compiler () ; datahere\r\ndatahere\r\ndatahere */\r\ndatahere&lt;/pre&gt;\r\n\r\n&lt;p&gt;Sql Snippets&lt;/p&gt;\r\n\r\n&lt;pre class=&quot;code&quot;&gt;\r\nBEGIN;\r\nCREATE TABLE &amp;quot;topic&amp;quot; (\r\n    -- This is the greatest table of all time\r\n    &amp;quot;id&amp;quot; serial NOT NULL PRIMARY KEY,\r\n    &amp;quot;forum_id&amp;quot; integer NOT NULL,\r\n    &amp;quot;subject&amp;quot; varchar(255) NOT NULL -- Because nobody likes an empty subject\r\n);\r\nALTER TABLE &amp;quot;topic&amp;quot; ADD CONSTRAINT forum_id FOREIGN KEY (&amp;quot;forum_id&amp;quot;) REFERENCES &amp;quot;forum&amp;quot; (&amp;quot;id&amp;quot;);\r\n\r\n-- Initials\r\ninsert into &amp;quot;topic&amp;quot; (&amp;quot;forum_id&amp;quot;, &amp;quot;subject&amp;quot;) values (2, &amp;#39;D&amp;#39;&amp;#39;artagnian&amp;#39;);\r\n\r\nselect /* comment */ count(*) from cicero_forum;\r\n\r\n-- this line lacks ; at the end to allow people to be sloppy and omit it in one-liners\r\n/*\r\nbut who cares?\r\n*/\r\nCOMMIT&lt;/pre&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 7, '2014-12-17 05:27:06', 'publish', 'slider_1.png', '2014-12-10 13:02:14', '2014-12-11 13:37:06', 0),
(6, 'Hello World 3', 'hello-world-3', 'hello,world,introduction', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. &amp;lt;!--more--&amp;gt;Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', 7, '2014-12-17 05:27:06', 'publish', 'hello-world.jpg', '2014-12-10 11:16:23', '2014-12-10 17:32:25', 0),
(7, 'Hello World 4', 'hello-world-4', 'hello,world,introduction', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. &amp;lt;!--more--&amp;gt;Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&amp;nbsp;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&amp;nbsp;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&amp;nbsp;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&amp;nbsp;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&amp;nbsp;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&amp;nbsp;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/p&gt;', 7, '2014-12-17 05:27:06', 'publish', 'hello-world.jpg', '2014-12-10 11:16:23', '2014-12-10 17:32:25', 0),
(8, 'Tes Script', 'tes-script', 'codeigniter', '', 7, '2014-12-18 04:07:29', 'publish', '', '2014-12-18 10:15:29', '2014-12-18 11:07:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE IF NOT EXISTS `blog_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `category_url` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `category_id` (`category_id`),
  KEY `category_url` (`category_url`),
  KEY `deleted` (`deleted`),
  KEY `category_id_2` (`category_id`,`category_url`,`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`category_id`, `category_name`, `category_url`, `description`, `deleted`) VALUES
(1, 'Codeigniter', 'codeigniter', 'Tutorial / Artikel seputar framework php Codeigniter', 0),
(2, 'PHP', 'php', 'Tutorial/Artikel seputar bahasa pemrograman PHP', 0),
(3, 'Uncategorized', 'uncategorized', 'Tidak terkategori', 0);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comments`
--

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `url` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `avatar` varchar(70) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`),
  KEY `article_id` (`article_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category_articles`
--

CREATE TABLE IF NOT EXISTS `category_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`article_id`,`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category_articles`
--

INSERT INTO `category_articles` (`id`, `article_id`, `category_id`) VALUES
(1, 1, 3),
(2, 2, 2),
(3, 2, 3),
(4, 3, 3),
(5, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('0cda28ebedada7dea3f696c795752b54', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1423550274, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"rizqidev";s:8:"username";s:8:"rizqidev";s:5:"email";s:23:"sakukode.team@gmail.com";s:7:"user_id";s:1:"7";s:14:"old_last_login";s:10:"1423462669";}'),
('20b0b1d6841af3e0c1646c1e7ee9d730', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418630183, 'a:1:{s:9:"user_data";s:0:"";}'),
('292ce21c08906061a4b44d5f000de4c0', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1415350936, ''),
('2b1d1778533d8fc11ee72f0f327c858a', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1416211008, 'a:1:{s:9:"user_data";s:0:"";}'),
('2f12a33892184cb5949b942100590055', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414610238, 'a:1:{s:9:"user_data";s:0:"";}'),
('2f8b3c82cd4236dcc193842d33d432aa', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1423462649, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"rizqidev";s:8:"username";s:8:"rizqidev";s:5:"email";s:23:"sakukode.team@gmail.com";s:7:"user_id";s:1:"7";s:14:"old_last_login";s:10:"1421638025";}'),
('33e1d2f1bee19714f3534595ac10e5e6', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418356725, ''),
('35698024d0ab9acee5a5522e43699e63', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418270670, 'a:1:{s:9:"user_data";s:0:"";}'),
('3a7f3707460579682340d10e78bce850', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1423555889, 'a:1:{s:9:"user_data";s:0:"";}'),
('491453a1ea10482c304022011a1c56ea', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418040485, 'a:5:{s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1417953156";}'),
('49d5dc5d205a5cd56c8f0b1a583ea7fd', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418460285, 'a:1:{s:9:"user_data";s:0:"";}'),
('4aa42a36b199b4e21752070b608a712c', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418211023, ''),
('4f168402a3867e6bdd0afd5a026df556', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418114756, ''),
('54d0f5bcbb05d0bf87f39f3599604e35', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1421725968, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1418630195";}'),
('5aa003e5cfa05d5d0e7d04c5705e8631', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1417663535, 'a:1:{s:9:"user_data";s:0:"";}'),
('60f2d4dd37108330b5f290aea4de5155', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418282506, ''),
('62c526e89611079daf789523a31b8531', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1416110841, ''),
('642da12c319b94e66c3d0953e903e18c', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414225217, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"sakukode";s:8:"username";s:8:"sakukode";s:5:"email";s:18:"sakukode@gmail.com";s:7:"user_id";s:1:"4";s:14:"old_last_login";s:10:"1414218110";}'),
('66498a5d285946ce555bddc9ced8a7b2', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414806970, ''),
('66e0a7a7121c74e324702271ca3b074d', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1415177247, ''),
('66e7c75118e48f4287813b837acc6198', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1421727688, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1421725984";}'),
('69db214de172d291dd3c86347ba37003', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414215521, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"sakukode";s:8:"username";s:8:"sakukode";s:5:"email";s:18:"sakukode@gmail.com";s:7:"user_id";s:1:"4";s:14:"old_last_login";s:10:"1414209092";}'),
('7392c2cc94dc5653946fd6d0fe165ea0', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418284162, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1418182456";}'),
('75d264aaec5efb43a6bc666e6f62baff', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418293582, 'a:1:{s:9:"user_data";s:0:"";}'),
('78386f737225a6cfed2dbf17f409b2d4', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414235919, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"sakukode";s:8:"username";s:8:"sakukode";s:5:"email";s:18:"sakukode@gmail.com";s:7:"user_id";s:1:"4";s:14:"old_last_login";s:10:"1414224971";}'),
('78877f065792ab4756089d9320f3abbf', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414394054, ''),
('7c96e3fd88757f1b14b47b2e6190de4e', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1416984805, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1416372200";}'),
('7d173fa75531cb806ab64abe77f00874', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418794033, ''),
('7da8bdb6762558617e78fc38f76ec381', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1415176487, ''),
('7e3592a2ab49c23308a70566ae0678e0', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414236203, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"sakukode";s:8:"username";s:8:"sakukode";s:5:"email";s:18:"sakukode@gmail.com";s:7:"user_id";s:1:"4";s:14:"old_last_login";s:10:"1414225454";}'),
('8641674e45890315e2a1e3f1293f8705', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418090592, 'a:1:{s:9:"user_data";s:0:"";}'),
('8a490b376d09e24c151e8e061d06b21a', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418100376, ''),
('8bc127fd3fc13553cda3536d73eb1e9b', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414382965, ''),
('8e5a98e799d8aafdc5e288e4a6f5af3c', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414314691, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";N;}'),
('905209a3eb912a2e4fd26d94e3351836', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414381259, 'a:1:{s:9:"user_data";s:0:"";}'),
('90812ef88cb4ec7294dc1b1d2c43a842', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418464751, ''),
('9377fc64df56eca3415285619982101a', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418209069, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"rizqidev";s:8:"username";s:8:"rizqidev";s:5:"email";s:23:"sakukode.team@gmail.com";s:7:"user_id";s:1:"7";s:14:"old_last_login";N;}'),
('957d1f1dd3a37aa4743b1c031c479ad0', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414725939, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1414610207";}'),
('9ace4bbe807174b5626716fe772e6e29', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1417951749, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1417925439";}'),
('9afe97ba9ce2aca2757797a1215b0a90', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418456933, 'a:1:{s:9:"user_data";s:0:"";}'),
('9b05d19cf2e0835d71cb98f12c104e07', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1417094799, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1416984814";}'),
('9d114369d25dc08ecc4a620f9774a7c7', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418356725, ''),
('9d742d67756ad172e4ad5b30bec1c8dd', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1415951920, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1415233000";}'),
('a5dadd6177d93f184ec633c9d263751d', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1421729604, ''),
('a994276496989ae6c462436983978184', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418042817, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1418007789";}'),
('aa0036e0e80bcdb607741f9cc3b621d4', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1421640727, ''),
('aabf6aa8cc17b651f0b8c22a2626b308', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1421638003, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"rizqidev";s:8:"username";s:8:"rizqidev";s:5:"email";s:23:"sakukode.team@gmail.com";s:7:"user_id";s:1:"7";s:14:"old_last_login";s:10:"1418872370";}'),
('aac873e04aa80f52ff336813f9205afb', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1417953148, ''),
('ae81c4495f2593db2762f61a683e36f1', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1416109753, ''),
('bfb0618602ee07cf3813c663dd325d2b', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1416381583, ''),
('c041c32d99ab8cee479a625b0ddded49', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1421727672, ''),
('c279988fda34dda9deaca68b324bc330', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414382244, ''),
('cbf977f8e770a6582a504db07c6e9862', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:34.0) Gecko/20100101 Firefox/34.0', 1418456698, ''),
('cc33528084e8c87d5bc3eff245a547f6', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1421726033, ''),
('cc764bf5ec96450826962cef6680e2ac', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1417956271, 'a:2:{s:9:"user_data";s:0:"";s:17:"flash:old:message";s:51:"<p class="text-success">Logged Out Successfully</p>";}'),
('d52ea95d43cf93d4a1db7220c0ebac19', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418637143, 'a:1:{s:9:"user_data";s:0:"";}'),
('d6507830305fab80a549cdbef8701c46', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418281163, 'a:5:{s:8:"identity";s:8:"rizqidev";s:8:"username";s:8:"rizqidev";s:5:"email";s:23:"sakukode.team@gmail.com";s:7:"user_id";s:1:"7";s:14:"old_last_login";s:10:"1418182654";}'),
('d6eb06c48907dcf46a433e3823fb0005', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418098032, ''),
('d8ba6dfcd6e4393e8c7fa50460043f00', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1423463373, ''),
('dbff928fe6ce78d8277543a48d335130', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418354271, 'a:1:{s:21:"flash:old:msg_success";s:35:"Success, Message Sent. Thanks Rizqi";}'),
('de8d89432de19b4a9d3b98f1100b1084', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414477197, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1414466978";}'),
('e073136f7d2384c40e78268a87b00a7d', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1415234068, 'a:1:{s:9:"user_data";s:0:"";}'),
('e2d4051287bc1121a83519c1d3a5bcd5', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414133835, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:15:"admin@admin.com";s:8:"username";s:13:"administrator";s:5:"email";s:15:"admin@admin.com";s:7:"user_id";s:1:"1";s:14:"old_last_login";s:10:"1414133761";}'),
('e5e6eb45fd4a2fef2e0cbe2809727c48', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418882290, 'a:1:{s:9:"user_data";s:0:"";}'),
('eccb82c5833b5444bef313896e60c68c', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414218425, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"sakukode";s:8:"username";s:8:"sakukode";s:5:"email";s:18:"sakukode@gmail.com";s:7:"user_id";s:1:"4";s:14:"old_last_login";s:10:"1414214253";}'),
('f12043c6ad560420c2dc903c097ae0fe', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418630185, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1418464762";}'),
('f22d470c795eb9b9bca7e570dbab542e', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414206306, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:15:"admin@admin.com";s:8:"username";s:13:"administrator";s:5:"email";s:15:"admin@admin.com";s:7:"user_id";s:1:"1";s:14:"old_last_login";s:10:"1414144190";}'),
('f2d92892407de63c8becd2b996cf98a2', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414206534, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:15:"admin@admin.com";s:8:"username";s:13:"administrator";s:5:"email";s:15:"admin@admin.com";s:7:"user_id";s:1:"1";s:14:"old_last_login";s:10:"1414204607";}'),
('f6934fd18b19d9df334ef8f944882804', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1416828439, ''),
('f7ad61db3821e6788e59dfb2e14a5279', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418352594, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"rizqidev";s:8:"username";s:8:"rizqidev";s:5:"email";s:23:"sakukode.team@gmail.com";s:7:"user_id";s:1:"7";s:14:"old_last_login";s:10:"1418293614";}'),
('f88ad448c7d1549ee02e9e9d1a116342', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1416110821, ''),
('feb58633a17d434ffe8858b787ff5451', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/39.0.2171.65 Chrome/39.0.2171.65 Sa', 1418282291, ''),
('ff4e89fe5fa7539c31fe6dd8268f1292', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1416372191, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:10:"angminsoft";s:8:"username";s:10:"angminsoft";s:5:"email";s:23:"info@angminsoftware.com";s:7:"user_id";s:1:"5";s:14:"old_last_login";s:10:"1416209576";}'),
('fff485e374069c92d36fdb8614e6d5d8', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/36.0.1985.125 Chrome/36.0.1985.125 ', 1414239741, 'a:6:{s:9:"user_data";s:0:"";s:8:"identity";s:8:"sakukode";s:8:"username";s:8:"sakukode";s:5:"email";s:18:"sakukode@gmail.com";s:7:"user_id";s:1:"4";s:14:"old_last_login";s:10:"1414236204";}');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `url` varchar(50) NOT NULL,
  `address_1` text NOT NULL,
  `address_2` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`),
  KEY `deleted` (`deleted`),
  KEY `client_id` (`client_id`),
  KEY `client_id_2` (`client_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `tagline` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `url` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `profile` text NOT NULL,
  `date` date NOT NULL,
  `logo` varchar(50) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`company_id`),
  KEY `company_id` (`company_id`,`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `tagline`, `email`, `url`, `address`, `phone`, `hp`, `profile`, `date`, `logo`, `deleted`) VALUES
(1, 'Sakukode', 'Lorem ipsum dolor sit amet', 'info@sakukode.com', 'http://www.sakukode.com', 'Jl. Hos CokroAminoto Kuripan Lor No.11 Gg.11 Pekalongan - Indonesia', '', '085842874104', 'Sakukode.com ini adalah halaman web pribadi saya, Rizqi Maulana. Sakukode sendiri sebenarnya hanyalah nama alias yang\nbiasa saya gunakan. Seperti namanya (Sakukode) , web ini nantinya akan menjadi tempat penyimpanan ataupun dokumentasi saya dalam belajar pemrograman/coding selama ini dan juga portfolio saya, walaupun nantinya kemungkinan akan saya posting beberapa artikel lain juga.\nApabila ada pertanyaan,saran maupun kritik bisa kirim pertanyaan melalui form dibawah halaman web ini atau melalui kontak yang ada di halaman web ini. semoga web ini bermanfaat untuk diri sendiri saya sendiri syukur-syukur bisa bermanfaat juga untuk orang lain yang mengunjungi web ini. terima kasih :) \n\nSalam Kenal..\n\n-- Rizqi Maulana --', '2014-08-06', 'logo.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `email_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `subject` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `file` varchar(50) NOT NULL,
  `status` enum('sent','draft') NOT NULL,
  `email_to` varchar(70) NOT NULL,
  `deleted` int(1) NOT NULL,
  PRIMARY KEY (`email_id`),
  KEY `email_id` (`email_id`,`author_id`,`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`email_id`, `author_id`, `date`, `subject`, `content`, `file`, `status`, `email_to`, `deleted`) VALUES
(1, 4, '2014-08-22 12:11:38', 'testing send email', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'draft', 'sakukode@gmail.com', 0),
(2, 4, '2014-08-22 12:13:29', 'testing send email', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'draft', 'rizqimaulana1512@gmail.com', 0),
(3, 4, '2014-08-24 02:50:14', 'testing email', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'draft', 'rizqimaulana88@yahoo.com', 1),
(4, 4, '2014-08-23 13:57:19', 'testing email', 'hallo all', '', 'draft', 'naruto@gmail.com', 1),
(5, 4, '2014-08-23 13:58:37', 'testing send email', '&lt;div&gt;&lt;b&gt;Hello Sakukode,&lt;/b&gt;&lt;br&gt;&lt;br&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;br&gt;&lt;br&gt;&lt;br&gt;-- &lt;a href=&quot;http://www.sakukode.com&quot; target=&quot;_blank&quot; rel=&quot;nofollow&quot;&gt;Sakukode Inc&lt;/a&gt; --&lt;/div&gt;', '', 'sent', 'sakukode@gmail.com', 1),
(6, 4, '2014-08-23 13:58:19', 'testing send email', '&lt;div&gt;&lt;b&gt;Hello Sakukode,&lt;/b&gt;&lt;br&gt;&lt;br&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;br&gt;&lt;br&gt;&lt;br&gt;-- &lt;a href=&quot;http://www.sakukode.com&quot; target=&quot;_blank&quot; rel=&quot;nofollow&quot;&gt;Sakukode Inc&lt;/a&gt; --&amp;nbsp;&lt;/div&gt;', '', 'sent', 'sakukode@gmail.com', 1),
(7, 4, '2014-08-24 02:50:29', 'testing send email', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'sent', 'sakukode@gmail.com', 1),
(8, 4, '2014-08-23 03:38:41', 'testing', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'draft', 'rizqi0037@rocketmail.com', 0),
(9, 4, '2014-08-23 03:39:41', 'testing', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'draft', 'rizqi0037@rocketmail.com', 0),
(10, 4, '2014-08-23 03:40:39', 'pembuatan web', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'sent', 'sakukode@gmail.com', 0),
(11, 4, '2014-10-27 11:17:25', 'sakukode news', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'sent', 'rizqimaulana88@yahoo.com', 1),
(12, 4, '2014-10-27 11:13:25', 'pembuatan web', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'sent', 'sakukode@gmail.com', 1),
(13, 5, '2014-10-27 11:27:01', 'email testing', '&lt;div&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&lt;/div&gt;&lt;div&gt;tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,&lt;/div&gt;&lt;div&gt;quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo&lt;/div&gt;&lt;div&gt;consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse&lt;/div&gt;&lt;div&gt;cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non&lt;/div&gt;&lt;div&gt;proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;', '', 'draft', 'sakukode@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'operator', 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `path` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT '0',
  `options` enum('not protected','protected') NOT NULL,
  `status` enum('active','not active') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`menu_id`),
  KEY `menu_id` (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `name`, `path`, `parent_id`, `options`, `status`) VALUES
(2, 'PORTFOLIO', 'portfolio', 0, 'not protected', 'active'),
(4, 'ABOUT', '#', 0, 'not protected', 'active'),
(5, 'BLOG', '', 0, 'not protected', 'active'),
(6, 'Dashboard', 'sk-admin/dashboard', 0, 'protected', 'active'),
(7, 'Company', '#', 0, 'protected', 'active'),
(8, 'Service', 'sk-admin/service', 7, 'protected', 'active'),
(9, 'Team', 'sk-admin/team', 7, 'protected', 'active'),
(10, 'Product', 'sk-admin/product', 7, 'protected', 'active'),
(11, 'Partner', 'sk-admin/partner', 7, 'protected', 'active'),
(12, 'Blog', '#', 0, 'protected', 'active'),
(13, 'Post', 'sk-admin/post', 12, 'protected', 'active'),
(14, 'Category', 'sk-admin/category', 12, 'protected', 'active'),
(16, 'Widget', '#', 0, 'protected', 'active'),
(17, 'Social Media', 'sk-admin/socmed', 16, 'protected', 'active'),
(18, 'User', 'sk-admin/user', 0, 'protected', 'active'),
(20, 'database', 'sk-admin/database', 0, 'protected', 'active'),
(21, 'Contact', 'sk-admin/contact', 0, 'protected', 'active'),
(22, 'GET IN TOUCH', '#', 0, 'not protected', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `menu_groups`
--

CREATE TABLE IF NOT EXISTS `menu_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `controller` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`menu_id`,`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `menu_groups`
--

INSERT INTO `menu_groups` (`id`, `menu_id`, `group_id`, `controller`) VALUES
(1, 6, 1, 'dashboard'),
(2, 6, 2, 'dashboard'),
(3, 7, 1, ''),
(4, 8, 1, 'service'),
(5, 9, 1, 'team'),
(6, 10, 1, 'product'),
(7, 11, 1, 'partner'),
(8, 12, 1, ''),
(9, 12, 2, ''),
(10, 13, 1, 'post'),
(11, 13, 2, 'post'),
(12, 14, 1, 'category'),
(13, 14, 2, 'category'),
(14, 16, 1, ''),
(15, 17, 1, 'socmed'),
(16, 18, 1, 'user'),
(17, 20, 1, 'database'),
(18, 21, 1, 'contact'),
(19, 21, 2, 'contact');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`),
  KEY `message_id` (`message_id`,`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `name`, `email`, `subject`, `message`, `date`, `status`, `deleted`) VALUES
(8, 'Rizqi Maulana', 'rizqi0037@rocketmail.com', '', 'Hello all', '2014-08-24 03:32:14', 'unread', 0),
(9, 'Rudi Dharmawan', 'rudidharmawan@gmail.com', '', 'Hello all', '2014-10-23 03:33:29', 'read', 0),
(10, 'Rizqi', 'sakukode@gmail.com', 'Tes pesan', 'hallo angmin software', '2014-10-27 09:28:13', 'unread', 0),
(11, 'Naruto', 'naruto@gmail.com', 'tes pesan 2', 'Hallo Angmin Software', '2014-10-27 11:30:32', 'read', 0),
(12, 'sakura', 'sakura@gmai.com', 'tes pesan 3', 'hallo world angmin software', '2014-10-27 09:37:24', 'read', 0),
(13, 'Hinata', 'hinata@gmail.com', 'tes pesan 4', 'hello angmin software', '2014-10-27 11:32:56', 'read', 1),
(14, 'Rizqi Maulana', 'sakukode.team@gmail.com', 'testing sakukode.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2015-02-09 06:20:57', 'read', 0),
(15, 'naruto', 'sakukode@gmail.com', '', 'hello world', '2014-12-13 08:05:59', 'unread', 0);

-- --------------------------------------------------------

--
-- Table structure for table `portofolios`
--

CREATE TABLE IF NOT EXISTS `portofolios` (
  `portofolio_id` int(11) NOT NULL AUTO_INCREMENT,
  `portofolio_name` varchar(100) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(50) NOT NULL,
  `client` varchar(70) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`portofolio_id`),
  KEY `portofolio_id` (`portofolio_id`),
  KEY `deleted` (`deleted`),
  KEY `portofolio_id_2` (`portofolio_id`,`url`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `related_posts`
--

CREATE TABLE IF NOT EXISTS `related_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`,`parent_id`,`related_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `related_posts`
--

INSERT INTO `related_posts` (`id`, `parent_id`, `related_id`) VALUES
(1, 2, 1),
(2, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(50) NOT NULL,
  `service_slug` varchar(100) NOT NULL,
  `img_icon` varchar(100) NOT NULL,
  `img_header` varchar(100) DEFAULT NULL,
  `short_desc` varchar(70) NOT NULL,
  `description` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service_id`),
  KEY `service_id` (`service_id`,`service_slug`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sf_config`
--

CREATE TABLE IF NOT EXISTS `sf_config` (
  `sf_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `sf_table` varchar(64) NOT NULL DEFAULT '',
  `sf_field` varchar(64) NOT NULL DEFAULT '',
  `sf_type` varchar(16) DEFAULT 'default',
  `sf_related` varchar(100) DEFAULT '',
  `sf_label` varchar(64) DEFAULT '',
  `sf_desc` tinytext,
  `sf_order` int(3) DEFAULT NULL,
  `sf_hidden` int(1) DEFAULT '0',
  PRIMARY KEY (`sf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=136 ;

--
-- Dumping data for table `sf_config`
--

INSERT INTO `sf_config` (`sf_id`, `sf_table`, `sf_field`, `sf_type`, `sf_related`, `sf_label`, `sf_desc`, `sf_order`, `sf_hidden`) VALUES
(1, 'blog_articles', 'article_id', 'default', '', '', NULL, NULL, 0),
(2, 'blog_articles', 'article_title', 'default', '', '', NULL, NULL, 0),
(3, 'blog_articles', 'article_url', 'default', '', '', NULL, NULL, 0),
(4, 'blog_articles', 'keyword', 'default', '', '', NULL, NULL, 0),
(5, 'blog_articles', 'content', 'default', '', '', NULL, NULL, 0),
(6, 'blog_articles', 'author_id', 'default', '', '', NULL, NULL, 0),
(7, 'blog_articles', 'date', 'default', '', '', NULL, NULL, 0),
(8, 'blog_articles', 'status', 'default', '', '', NULL, NULL, 0),
(9, 'blog_articles', 'category_id', 'default', '', '', NULL, NULL, 0),
(10, 'blog_articles', 'picture', 'default', '', '', NULL, NULL, 0),
(11, 'blog_articles', 'deleted', 'default', '', '', NULL, NULL, 0),
(12, 'blog_categories', 'category_id', 'default', '', '', NULL, NULL, 0),
(13, 'blog_categories', 'category_name', 'default', '', '', NULL, NULL, 0),
(14, 'blog_categories', 'category_url', 'default', '', '', NULL, NULL, 0),
(15, 'blog_categories', 'description', 'default', '', '', NULL, NULL, 0),
(16, 'blog_categories', 'deleted', 'default', '', '', NULL, NULL, 0),
(17, 'blog_comments', 'comment_id', 'default', '', '', NULL, NULL, 0),
(18, 'blog_comments', 'article_id', 'default', '', '', NULL, NULL, 0),
(19, 'blog_comments', 'date', 'default', '', '', NULL, NULL, 0),
(20, 'blog_comments', 'name', 'default', '', '', NULL, NULL, 0),
(21, 'blog_comments', 'email', 'default', '', '', NULL, NULL, 0),
(22, 'blog_comments', 'url', 'default', '', '', NULL, NULL, 0),
(23, 'blog_comments', 'content', 'default', '', '', NULL, NULL, 0),
(24, 'blog_comments', 'parent_id', 'default', '', '', NULL, NULL, 0),
(25, 'blog_comments', 'avatar', 'default', '', '', NULL, NULL, 0),
(26, 'blog_comments', 'deleted', 'default', '', '', NULL, NULL, 0),
(27, 'ci_sessions', 'session_id', 'default', '', '', NULL, NULL, 0),
(28, 'ci_sessions', 'ip_address', 'default', '', '', NULL, NULL, 0),
(29, 'ci_sessions', 'user_agent', 'default', '', '', NULL, NULL, 0),
(30, 'ci_sessions', 'last_activity', 'default', '', '', NULL, NULL, 0),
(31, 'ci_sessions', 'user_data', 'default', '', '', NULL, NULL, 0),
(32, 'clients', 'client_id', 'default', '', '', NULL, NULL, 0),
(33, 'clients', 'company', 'default', '', '', NULL, NULL, 0),
(34, 'clients', 'contact_person', 'default', '', '', NULL, NULL, 0),
(35, 'clients', 'email', 'default', '', '', NULL, NULL, 0),
(36, 'clients', 'url', 'default', '', '', NULL, NULL, 0),
(37, 'clients', 'address_1', 'default', '', '', NULL, NULL, 0),
(38, 'clients', 'address_2', 'default', '', '', NULL, NULL, 0),
(39, 'clients', 'phone', 'default', '', '', NULL, NULL, 0),
(40, 'clients', 'hp', 'default', '', '', NULL, NULL, 0),
(41, 'clients', 'picture', 'default', '', '', NULL, NULL, 0),
(42, 'clients', 'deleted', 'default', '', '', NULL, NULL, 0),
(43, 'companies', 'company_id', 'default', '', '', NULL, NULL, 0),
(44, 'companies', 'company_name', 'default', '', '', NULL, NULL, 0),
(45, 'companies', 'tagline', 'default', '', '', NULL, NULL, 0),
(46, 'companies', 'email', 'default', '', '', NULL, NULL, 0),
(47, 'companies', 'url', 'default', '', '', NULL, NULL, 0),
(48, 'companies', 'address', 'default', '', '', NULL, NULL, 0),
(49, 'companies', 'phone', 'default', '', '', NULL, NULL, 0),
(50, 'companies', 'hp', 'default', '', '', NULL, NULL, 0),
(51, 'companies', 'profile', 'default', '', '', NULL, NULL, 0),
(52, 'companies', 'date', 'default', '', '', NULL, NULL, 0),
(53, 'companies', 'logo', 'default', '', '', NULL, NULL, 0),
(54, 'companies', 'deleted', 'default', '', '', NULL, NULL, 0),
(55, 'emails', 'email_id', 'default', '', '', NULL, NULL, 0),
(56, 'emails', 'author_id', 'default', '', '', NULL, NULL, 0),
(57, 'emails', 'date', 'default', '', '', NULL, NULL, 0),
(58, 'emails', 'subject', 'default', '', '', NULL, NULL, 0),
(59, 'emails', 'content', 'default', '', '', NULL, NULL, 0),
(60, 'emails', 'file', 'default', '', '', NULL, NULL, 0),
(61, 'emails', 'status', 'default', '', '', NULL, NULL, 0),
(62, 'emails', 'email_to', 'default', '', '', NULL, NULL, 0),
(63, 'emails', 'deleted', 'default', '', '', NULL, NULL, 0),
(64, 'login_attempts', 'id', 'default', '', '', NULL, NULL, 0),
(65, 'login_attempts', 'ip_address', 'default', '', '', NULL, NULL, 0),
(66, 'login_attempts', 'login', 'default', '', '', NULL, NULL, 0),
(67, 'login_attempts', 'time', 'default', '', '', NULL, NULL, 0),
(68, 'messages', 'message_id', 'default', '', '', NULL, NULL, 0),
(69, 'messages', 'name', 'default', '', '', NULL, NULL, 0),
(70, 'messages', 'email', 'default', '', '', NULL, NULL, 0),
(71, 'messages', 'url', 'default', '', '', NULL, NULL, 0),
(72, 'messages', 'message', 'default', '', '', NULL, NULL, 0),
(73, 'messages', 'date', 'default', '', '', NULL, NULL, 0),
(74, 'messages', 'status', 'default', '', '', NULL, NULL, 0),
(75, 'messages', 'deleted', 'default', '', '', NULL, NULL, 0),
(76, 'portofolios', 'portofolio_id', 'default', '', '', NULL, NULL, 0),
(77, 'portofolios', 'portofolio_name', 'default', '', '', NULL, NULL, 0),
(78, 'portofolios', 'picture', 'default', '', '', NULL, NULL, 0),
(79, 'portofolios', 'description', 'default', '', '', NULL, NULL, 0),
(80, 'portofolios', 'url', 'default', '', '', NULL, NULL, 0),
(81, 'portofolios', 'client', 'default', '', '', NULL, NULL, 0),
(82, 'portofolios', 'deleted', 'default', '', '', NULL, NULL, 0),
(83, 'services', 'service_id', 'default', '', '', NULL, NULL, 0),
(84, 'services', 'service_name', 'default', '', '', NULL, NULL, 0),
(85, 'services', 'icon', 'default', '', '', NULL, NULL, 0),
(86, 'services', 'description', 'default', '', '', NULL, NULL, 0),
(87, 'services', 'deleted', 'default', '', '', NULL, NULL, 0),
(88, 'sliders', 'slide_id', 'default', '', '', NULL, NULL, 0),
(89, 'sliders', 'title', 'default', '', '', NULL, NULL, 0),
(90, 'sliders', 'image', 'default', '', '', NULL, NULL, 0),
(91, 'sliders', 'background', 'default', '', '', NULL, NULL, 0),
(92, 'sliders', 'description', 'default', '', '', NULL, NULL, 0),
(93, 'sliders', 'deleted', 'default', '', '', NULL, NULL, 0),
(94, 'socmeds', 'socmed_id', 'default', '', '', NULL, NULL, 0),
(95, 'socmeds', 'socmed_name', 'default', '', '', NULL, NULL, 0),
(96, 'socmeds', 'icon', 'default', '', '', NULL, NULL, 0),
(97, 'socmeds', 'url', 'default', '', '', NULL, NULL, 0),
(98, 'socmeds', 'deleted', 'default', '', '', NULL, NULL, 0),
(99, 'teams', 'team_id', 'default', '', '', NULL, NULL, 0),
(100, 'teams', 'firstname', 'default', '', '', NULL, NULL, 0),
(101, 'teams', 'lastname', 'default', '', '', NULL, NULL, 0),
(102, 'teams', 'email', 'default', '', '', NULL, NULL, 0),
(103, 'teams', 'job', 'default', '', '', NULL, NULL, 0),
(104, 'teams', 'fb_account', 'default', '', '', NULL, NULL, 0),
(105, 'teams', 'twitter_account', 'default', '', '', NULL, NULL, 0),
(106, 'teams', 'picture', 'default', '', '', NULL, NULL, 0),
(107, 'teams', 'description', 'default', '', '', NULL, NULL, 0),
(108, 'teams', 'deleted', 'default', '', '', NULL, NULL, 0),
(109, 'user_autologin', 'key_id', 'default', '', '', NULL, NULL, 0),
(110, 'user_autologin', 'user_id', 'default', '', '', NULL, NULL, 0),
(111, 'user_autologin', 'user_agent', 'default', '', '', NULL, NULL, 0),
(112, 'user_autologin', 'last_ip', 'default', '', '', NULL, NULL, 0),
(113, 'user_autologin', 'last_login', 'default', '', '', NULL, NULL, 0),
(114, 'user_profiles', 'id', 'default', '', '', NULL, NULL, 0),
(115, 'user_profiles', 'user_id', 'default', '', '', NULL, NULL, 0),
(116, 'user_profiles', 'name', 'default', '', '', NULL, NULL, 0),
(117, 'user_profiles', 'job', 'default', '', '', NULL, NULL, 0),
(118, 'user_profiles', 'country', 'default', '', '', NULL, NULL, 0),
(119, 'user_profiles', 'website', 'default', '', '', NULL, NULL, 0),
(120, 'user_profiles', 'join_date', 'default', '', '', NULL, NULL, 0),
(121, 'users', 'id', 'default', '', '', NULL, NULL, 0),
(122, 'users', 'username', 'default', '', '', NULL, NULL, 0),
(123, 'users', 'password', 'default', '', '', NULL, NULL, 0),
(124, 'users', 'email', 'default', '', '', NULL, NULL, 0),
(125, 'users', 'activated', 'default', '', '', NULL, NULL, 0),
(126, 'users', 'banned', 'default', '', '', NULL, NULL, 0),
(127, 'users', 'ban_reason', 'default', '', '', NULL, NULL, 0),
(128, 'users', 'new_password_key', 'default', '', '', NULL, NULL, 0),
(129, 'users', 'new_password_requested', 'default', '', '', NULL, NULL, 0),
(130, 'users', 'new_email', 'default', '', '', NULL, NULL, 0),
(131, 'users', 'new_email_key', 'default', '', '', NULL, NULL, 0),
(132, 'users', 'last_ip', 'default', '', '', NULL, NULL, 0),
(133, 'users', 'last_login', 'default', '', '', NULL, NULL, 0),
(134, 'users', 'created', 'default', '', '', NULL, NULL, 0),
(135, 'users', 'modified', 'default', '', '', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `slide_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `background` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `socmeds`
--

CREATE TABLE IF NOT EXISTS `socmeds` (
  `socmed_id` int(11) NOT NULL AUTO_INCREMENT,
  `socmed_name` varchar(100) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`socmed_id`),
  KEY `socmed_id` (`socmed_id`,`deleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `socmeds`
--

INSERT INTO `socmeds` (`socmed_id`, `socmed_name`, `icon`, `url`, `deleted`) VALUES
(1, 'Facebook', 'fa fa-facebook', 'https://www.facebook.com/sakukode.team', 0),
(2, 'Github', 'fa fa-github', 'https://github.com/sakukode', 0),
(3, 'Twitter', 'fa fa-twitter', 'https://twitter.com/sakukode', 0),
(4, 'Google Plus', 'fa fa-google-plus', 'https://plus.google.com/114274313764840916246', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(2, 'ajax'),
(7, 'codeigniter'),
(5, 'crud'),
(1, 'form'),
(8, 'hello'),
(10, 'introduction'),
(6, 'login'),
(3, 'post'),
(11, 'snippets'),
(4, 'user management'),
(9, 'world');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `job` varchar(150) NOT NULL,
  `fb_account` varchar(70) NOT NULL,
  `twitter_account` varchar(70) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`team_id`),
  KEY `team_id` (`team_id`,`deleted`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `job` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `job`, `phone`) VALUES
(4, '127.0.0.1', 'sakukode', '$2y$08$WfgtmTVOBbsQn22fRirwWuDB.6kU4palssrMmuuw/alPwKwRbT/Ua', NULL, 'sakukode@gmail.com', NULL, NULL, NULL, 'dJ7k2U/IpJ0JJY5tVQX9eO', 1414208553, 1414401149, 1, 'Sakukode', 'Team', 'Web Developer', '085842874104'),
(5, '127.0.0.1', 'angminsoft', '$2y$08$vEfjrL/DCYDSZaUg0/MdpefFRrbU3qBfGr5kUFkNwxj.TYnut97c2', NULL, 'info@angminsoftware.com', NULL, NULL, NULL, '08CluetQIgcpgnJWXuz1Nu', 1414235586, 1421727688, 1, 'Angmin', 'Admin', 'Founder', ''),
(6, '127.0.0.1', 'operator', '$2y$08$lpqQypt4leerKqNp6GIB9uHS2tLEx1IPwcn98BNeX.YQld3Ryqty2', NULL, 'operator@angminsoft.com', NULL, NULL, NULL, NULL, 1414466201, 1415234057, 1, 'operator', 'angminsoftware', 'Operator', '098357385333'),
(7, '127.0.0.1', 'rizqidev', '$2y$08$BdlhSIHTZGnjfyI2NRkWTuWchl87SApy4vmDtMqW/NVmk8xH580oa', NULL, 'sakukode.team@gmail.com', NULL, NULL, NULL, NULL, 1418182636, 1423548438, 1, 'Rizqi', 'Maulana', 'Web Developer', '085842874104');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(5, 4, 1),
(6, 5, 1),
(7, 6, 2),
(8, 7, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
