<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
* @param  integer $type    Constant like INPUT_XXX.
* @param  array   $default Default structure of the specified super global var.
*                          Following bitmasks are available:
*  + FILTER_STRUCT_FORCE_ARRAY - Force 1 dimensional array.
*  + FILTER_STRUCT_TRIM        - Trim by ASCII control chars.
*  + FILTER_STRUCT_FULL_TRIM   - Trim by ASCII control chars,
*                                full-width and no-break space.
* @return array            The value of the filtered super global var.
*/
define('FILTER_STRUCT_FORCE_ARRAY', 1);
define('FILTER_STRUCT_TRIM', 2);
define('FILTER_STRUCT_FULL_TRIM', 4);
function filter_struct_utf8($type, array $default) {
    static $func = __FUNCTION__;
    static $trim = "[\\x0-\x20\x7f]";
    static $ftrim = "[\\x0-\x20\x7f\xc2\xa0\xe3\x80\x80]";
    static $recursive_static = false;
    if (!$recursive = $recursive_static) {
        $types = array(
            INPUT_GET => $_GET,
            INPUT_POST => $_POST,
            INPUT_COOKIE => $_COOKIE,
            INPUT_REQUEST => $_REQUEST,
        );
        if (!isset($types[(int)$type])) {
            throw new LogicException('unknown super global var type');
        }
        $var = $types[(int)$type];
        $recursive_static = true;
    } else {
        $var = $type;
    }
    $ret = array();
    foreach ($default as $key => $value) {
        if ($is_int = is_int($value)) {
            if (!($value | (
                FILTER_STRUCT_FORCE_ARRAY |
                FILTER_STRUCT_FULL_TRIM |
                FILTER_STRUCT_TRIM
            ))) {
                $recursive_static = false;
                throw new LogicException('unknown bitmask');
            }
            if ($value & FILTER_STRUCT_FORCE_ARRAY) {
                $tmp = array();
                if (isset($var[$key])) {
                    foreach ((array)$var[$key] as $k => $v) {
                        if (!preg_match('//u', $k)){
                            continue;
                        }
                        $value &= FILTER_STRUCT_FULL_TRIM | FILTER_STRUCT_TRIM;
                        $tmp += array($k => $value ? $value : '');
                    }
                }
                $value = $tmp;
            }
        }
        if ($isset = isset($var[$key]) and is_array($value)) {
            $ret[$key] = $func($var[$key], $value);
        } elseif (!$isset || is_array($var[$key])) {
            $ret[$key] = null;
        } elseif ($is_int && $value & FILTER_STRUCT_FULL_TRIM) {
            $ret[$key] = preg_replace("/\A{$ftrim}++|{$ftrim}++\z/u", '', $var[$key]);
        } elseif ($is_int && $value & FILTER_STRUCT_TRIM) {
            $ret[$key] = preg_replace("/\A{$trim}++|{$trim}++\z/u", '', $var[$key]);
        } else {
            $ret[$key] = preg_replace('//u', '', $var[$key]);
        }
        if ($ret[$key] === null) {
            $ret[$key] = $is_int ? '' : $value;
        }
    }
    if (!$recursive) {
        $recursive_static = false;
    }
    return $ret;
}

