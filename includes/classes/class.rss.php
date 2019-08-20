<?php
/*=======================================================================
 Nuke-Evolution   :   Enhanced Web Portal System
 ========================================================================

 Nuke-Evo Base          :   #$#BASE
 Nuke-Evo Version       :   #$#VER
 Nuke-Evo Build         :   #$#BUILD
 Nuke-Evo Patch         :   #$#PATCH
 Nuke-Evo Filename      :   #$#FILENAME
 Nuke-Evo Date          :   #$#DATE

 Copyright (c) 2010 by The Nuke Evolution Development Team
 ========================================================================

 LICENSE INFORMATIONS COULD BE FOUND IN COPYRIGHTS.PHP WHICH MUST BE
 DISTRIBUTED WITHIN THIS MODULEPACKAGE OR WITHIN FILES WHICH ARE
 USED FROM WITHIN THIS PACKAGE.
 IT IS "NOT" ALLOWED TO DISTRIBUTE THIS MODULE WITHOUT THE ORIGINAL
 COPYRIGHT-FILE.
 ALL INFORMATIONS ABOVE THIS SECTION ARE "NOT" ALLOWED TO BE REMOVED.
 THEY HAVE TO STAY AS THEY ARE.
 IT IS ALLOWED AND SHOULD BE DONE TO ADD ADDITIONAL INFORMATIONS IN
 THE SECTIONS BELOW IF YOU CHANGE OR MODIFY THIS FILE.

/*****[CHANGES]**********************************************************
-=[Base]=-
-=[Mod]=-
 ************************************************************************/

if(!defined('NUKE_EVO')) { die('It\'s not allowed to access this file directly'); }

class RSS {

    function get_tag($tagname, &$string) {
        preg_match("#<$tagname.*?>(.*?)</$tagname>#si", $string, $tag);
        if (!isset($tag[1])) {
            return false;
        }
        $tag = strtr($tag[1], array('<![CDATA['=>'', ']]>'=>''));
        return trim($tag);
    }

    function read($url, $items_limit=10) {
        $channeltags = array ('title', 'link', 'description', 'language', 'generator', 'copyright', 'category', 'pubDate', 'managingEditor', 'webMaster', 'lastBuildDate', 'rating', 'docs', 'ttl');
        $itemtags = array('title', 'link', 'description', 'author', 'category', 'comments', 'enclosure', 'guid', 'pubDate', 'source');
        if (!($data = RSS::get_fileinfo($url))) {
           return false;
        }
        preg_match("'<channel.*?>(.*?)</channel>'si", $data['data'], $channel);
        $channel = str_replace('&apos;', '&#039;', $channel[1]);
        foreach($channeltags as $channeltag) {
            $tag = RSS::get_tag($channeltag, $channel);
            if (!empty($tag)) { $rss[$channeltag] = $tag; }
        }
        $rss['title'] = strip_tags(urldecode($rss['title']));
        $rss['link'] = strip_tags($rss['link']);
        $rss['desc'] =& $rss['description'];
        if (isset($rss['ttl'])) {
            $rss['ttl'] = intval($rss['ttl']);
        }
        preg_match_all('#<item(| .*?)>(.*?)</item>#si', $data['data'], $items);
        $items = $items[2];
        for ($i=0;$i<$items_limit;$i++) {
            if (isset($items[$i]) && !empty($items[$i])) {
                $item = array();
                foreach($itemtags as $itemtag) {
                    $tag = RSS::get_tag($itemtag, $items[$i]);
                    if (!empty($tag)) { $item[$itemtag] = $tag; }
                }
                if (!empty($item)) {
                    $item['title'] = strip_tags(urldecode($item['title']));
                    $item['link'] = isset($item['link']) ? strip_tags($item['link']) : '';
                    $item['desc'] =& $item['description'];
                    $rss['items'][] = $item;
                }
            }
        }
        return $rss;
    }

    function get_fileinfo($url)
    {
        $rdf = parse_url($url);
        if (!isset($rdf['host'])) return false;
        if (!isset($rdf['path'])) $rdf['path'] = '/';
        if (!isset($rdf['port'])) $rdf['port'] = 80;
        if (!isset($rdf['query'])) $rdf['query'] = '';
        elseif ($rdf['query'] != '') $rdf['query'] = '?'.$rdf['query'];
        $file = array('size'=>0, 'type'=>'', 'date'=>0, 'animation'=>false, 'modified'=>true);
        if ($fp = fsockopen($rdf['host'], $rdf['port'], $errno, $errstr, 15)) {
            fputs($fp, 'GET '.$rdf['path'].$rdf['query']." HTTP/1.0\r\n");
            fputs($fp, 'User-Agent: Nuke-Evolution RSS Reader\r\n');
           if (GZIPSUPPORT) fputs($fp, "Accept-Encoding: gzip;q=0.9\r\n");
            fputs($fp, "HOST: $rdf[host]\r\n\r\n");
            $data = rtrim(fgets($fp, 300));
            preg_match('#.* ([0-9]+) (.*)#i', $data, $head);
            if (($head[1] >= 301 && $head[1] <= 303) || $head[1] == 307) {
                while (!empty($data)) {
                    $data = rtrim(fgets($fp, 300)); // read lines
                    if (stristr($data, 'Location: ')) {
                        $new_location = trim(str_replace('Location: ', '', $data));
                        break;
                    }
                }
                $head[2] .= ($head[1]==302) ? ' at' : ' to';
                fputs($fp,"Connection: close\r\n\r\n"); fclose($fp);
                DisplayError("$url $head[2] <strong>$new_location</strong>", 1);
                return RSS::get_fileinfo($new_location);
            } elseif ($head[1] != 200) {
                fputs($fp,"Connection: close\r\n\r\n"); fclose($fp);
                DisplayError($url."<br />$data", 1);
                return false;
            }
            $GZIP = false;
            while (!empty($data)) {
                $data = rtrim(fgets($fp, 300));
                if (strstr($data, 'Content-Length: ')) {
                    $file['size'] = trim(str_replace('Content-Length: ', '', $data));
                }
                elseif (strstr($data, 'Content-Type: ')) {
                    $file['type'] = trim(str_replace('Content-Type: ', '', $data));
                }
                elseif (strstr($data, 'Last-Modified: ')) {
                    $file['date'] = trim(str_replace('Last-Modified: ', '', $data));
                }
                if (stristr($data, 'Content-Encoding: gzip') || stristr($data, 'Content-Encoding: x-gzip')) { $GZIP = true; }
            }
            $data = '';
            while(!feof($fp)) {
                $data .= fread($fp, 1024); // read binary
            }
            if ($GZIP) { $data = gzinflate(substr($data,10,-4)); }
            $file['data'] = $data;
            fputs($fp,"Connection: close\r\n\r\n");
            fclose($fp);
        } else {
            DisplayError($errstr, 1);
            return false;
        }
        return $file;
    }

}

?>