<?php

/**
 * Adds registred libs
 *
 * @author Ton Sharp <Forma-PRO@66ton99.org.ua>
 *
 * @param array $args
 * @param bool false
 *
 * @throws Exception
 */
function js_add($args, $isFirst = false) {
  if (!is_array($args)) {
    $args = array($args);
  }

  /*
   * When adding the capability to use a new lib you must update config/app.yml file
   *
   * Example:
   * js: # all "min" versions must have original version!!!
   *  debug: true
   *  libs:
   *    jquery:
   *      main: 'jquery-1.7.1.min.js'
   *    ko:
   *      main: 'knockout-2.1.0.min.js'
   *    simple: 'simple.js'
   */
  $libs = sfConfig::get('app_js_libs', array());
  if (!sfConfig::get('app_js_local_only', false)) {
    $libs = arrayMergeRecursive($libs, sfConfig::get('app_js_remote_libs', array()));
  }
  foreach ($args as $name) {
    $nameArr = explode('-', $name);
    if (empty($libs[$nameArr[0]]) && (empty($nameArr[1]) || empty($libs[$nameArr[0]][$nameArr[1]]))) {
      throw new sfException("'{$name}' is unknown JS lib");
    }

    $path = 'vendor/';

    $filename = $libs[$nameArr[0]];

    if (is_array($filename)) {
      if (0 === strpos($filename[$nameArr[1]], 'http')) {
        $path = '';
        $filename = $libs[$nameArr[0]][$nameArr[1]];
      } else {
        $filename = $nameArr[0] . '/' . $libs[$nameArr[0]][$nameArr[1]];
      }
    } else {
      if (0 === strpos($filename, 'http')) {
        $path = '';
      }
    }

    if (sfConfig::get('app_js_debug')) {
      $filename = str_replace('.min.js', '.js', $filename);
    }
    sfContext::getInstance()->getResponse()->addJavascript($path . $filename, $isFirst?'first':'');
  }
}
