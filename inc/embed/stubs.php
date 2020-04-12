<?php
/**
 * This file is part of AutoEmbed.
 * http://autoembed.com
 *
 * $Id: stubs.php 227 2010-07-29 14:52:36Z phpuser $
 *
 * Some regular expressions found in this file were borrowed
 * from Karl Benson & Rene-Gilles Deberdt.
 *
 * AutoEmbed is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * AutoEmbed is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with AutoEmbed.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
  Example:
  array(
    'title'        =>  Source the embeded media comes from
    'website'      =>  URI of the media source
    'url-match'    =>  Regexp for matching the submitted url to a stub
    'embed-src'    =>  The source of the media to embed.  Replace $2, $3, etc with matches from the url-match or fetch-match regexp ($1 is the entire matched url)
    'embed-width'  =>  The default width of the embeded object
    'embed-height' =>  The default width of the embeded object
    'fetch-match'  => (optional) if set, html will be fetched and this regexp will be used to pull the media id or the source of the video
    'flashvars'    => (optional) if set, will be passed in the embed tag.  Replace $2, $3, etc with matches from url-match or fetch-match
  ),
*/
$SPAutoEmbed_stubs = array(
  array(
    'title' => 'YouTube',
    'code' => 'yt',
    'website' => 'https://www.youtube.com',
    'url-match' => 'http://(?:video\.google\.(?:com|com\.au|co\.uk|de|es|fr|it|nl|pl|ca|cn)/(?:[^"]*?))?(?:(?:www|au|br|ca|es|fr|de|hk|ie|in|il|it|jp|kr|mx|nl|nz|pl|ru|tw|uk)\.)?youtube\.com(?:[^"]*?)?(?:&|&amp;|/|\?|;|\%3F|\%2F)(?:video_id=|v(?:/|=|\%3D|\%2F))([0-9a-z-_]{11})',
    'embed-src' => 'https://www.youtube.com/v/$2&rel=0&fs=1&hd=1',
    'embed-width' => '480',
    'embed-height' => '295',
    'image-src' => 'https://img.youtube.com/vi/$2/0.jpg',
    'iframe-player' => 'https://www.youtube.com/embed/$2?rel=0&fs=1&showinfo=0',
  ),
  array(
    'title' => 'YouTube (Secured)',
    'code' => 'yt',
    'website' => 'https://www.youtube.com',
    'url-match' => 'https://(?:video\.google\.(?:com|com\.au|co\.uk|de|es|fr|it|nl|pl|ca|cn)/(?:[^"]*?))?(?:(?:www|au|br|ca|es|fr|de|hk|ie|in|il|it|jp|kr|mx|nl|nz|pl|ru|tw|uk)\.)?youtube\.com(?:[^"]*?)?(?:&|&amp;|/|\?|;|\%3F|\%2F)(?:video_id=|v(?:/|=|\%3D|\%2F))([0-9a-z-_]{11})',
    'embed-src' => 'https://www.youtube.com/embed/$2&rel=0&fs=1&hd=1',
    'embed-width' => '480',
    'embed-height' => '295',
    'image-src' => 'https://img.youtube.com/vi/$2/0.jpg',
    'iframe-player' => 'https://www.youtube.com/embed/$2?rel=0&fs=1&showinfo=0',
  ),
  array(
    'title' => 'YouTube Alt (Secured)',
    'code' => 'yt',
    'website' => 'https://www.youtube.com',
    'url-match' => 'https://(?:video\.google\.(?:com|com\.au|co\.uk|de|es|fr|it|nl|pl|ca|cn)/(?:[^"]*?))?(?:(?:www|au|br|ca|es|fr|de|hk|ie|in|il|it|jp|kr|mx|nl|nz|pl|ru|tw|uk)\.)?youtube\.com/watch(?:[^"]*?)?(?:&|&amp;|/|\?|;|\%3F|\%2F)(?:video_id=|v(?:/|=|\%3D|\%2F))([0-9a-z-_]{11})',
    'embed-src' => 'https://www.youtube.com/embed/$2&rel=0&fs=1&hd=1',
    'embed-width' => '480',
    'embed-height' => '295',
    'image-src' => 'https://img.youtube.com/vi/$2/0.jpg',
    'iframe-player' => 'https://www.youtube.com/embed/$2?rel=0&fs=1&showinfo=0',
  ),
  array(
    'title' => 'YouTube (Playlists)',
    'code' => 'yt',
    'website' => 'https://www.youtube.com',
    'url-match' => 'https://(?:(?:www|au|br|ca|es|fr|de|hk|ie|in|il|it|jp|kr|mx|nl|nz|pl|ru|tw|uk)\.)?youtube\.com(?:[^"]*?)?(?:&|&amp;|/|\?|;)(?:id=|p=|p/)([0-9a-f]{16})',
    'embed-src' => 'https://www.youtube.com/p/$2&rel=0&fs=1&showinfo=0',
    'embed-width' => '480',
    'embed-height' => '385',
    'iframe-player' => 'https://www.youtube.com/embed/$2?rel=0&fs=1&showinfo=0',
  ),
  array(
    'title' => 'Vimeo',
    'website' => 'http://www.vimeo.com',
    'url-match' => 'http://(?:www\.)?vimeo\.com/([0-9]{1,12})',
    'embed-src' => 'http://vimeo.com/moogaloop.swf?clip_id=$2&server=vimeo.com&fullscreen=1&show_title=1&show_byline=1&show_portrait=0&color=01AAEA',
    'embed-width' => '400',
    'embed-height' => '302',
    'iframe-player' => 'http://player.vimeo.com/video/$2',
  ),
  array(
    'title' => 'Vimeo (Secured)',
    'website' => 'https://www.vimeo.com',
    'url-match' => 'https://(?:www\.)?vimeo\.com/([0-9]{1,12})',
    'embed-src' => 'https://vimeo.com/moogaloop.swf?clip_id=$2&server=vimeo.com&fullscreen=1&show_title=1&show_byline=1&show_portrait=0&color=01AAEA',
    'embed-width' => '400',
    'embed-height' => '302',
    'iframe-player' => 'https://player.vimeo.com/video/$2',
  ),
);
?>
