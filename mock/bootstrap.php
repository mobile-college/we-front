<?php

define('ROOT_DIR', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('SMARTY_DIR', ROOT_DIR . 'mock' . DIRECTORY_SEPARATOR . 'smarty' . DIRECTORY_SEPARATOR);
define('VIEW_DIR', ROOT_DIR . 'view' . DIRECTORY_SEPARATOR);
define('CACHE_DIR', ROOT_DIR . 'cache' . DIRECTORY_SEPARATOR);

date_default_timezone_set('America/Los_Angeles');


/**
 * 递归创建目录，如果目录不存在的话，则创建之
 *
 * @param $dir 要创建的目录
 * @return bool
 */
function mkdir_if_no_exist($dir) {
    if (is_dir($dir)) {
        return true;
    }
    if (!mkdir_if_no_exist(dirname($dir))) {
        return false;
    }
    return mkdir($dir);
}

/**
 * 删除目录
 *
 * @param $dir
 */
function rrmdir($dir) {
    if (is_dir($dir)) {

        $dir = rtrim($dir, DIRECTORY_SEPARATOR . ' ') . DIRECTORY_SEPARATOR;
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                rrmdir($dir . $file);
            }
        }

        rmdir($dir);
    }
    else if (file_exists($dir)) {
        unlink($dir);
    }
}

function getSmarty($data) {

    require_once(SMARTY_DIR . 'Smarty.class.php');

    $smarty = new Smarty();

    $smarty->setTemplateDir(VIEW_DIR);
    $smarty->setCompileDir(CACHE_DIR);

    $smarty->left_delimiter = '{{ ';
    $smarty->right_delimiter = ' }}';

    $smarty->assign('user_data', array(

        "avatar" => "http://test.img.genshuixue.com/headpic_woman.png",
        "user_type" => 0,
        "user_id" => 1,
        "user_number" => "1212312312",
        "user_name" => "沈佳宜沈佳宜沈佳宜",
        "user_name_cut" => "沈佳宜...",
        "mobile" => "13523145687"
    ));

    foreach ($data as $key => $value) {
        $smarty->assign($key, $value);
    }

    $smarty->assign('site_config', array(
        "baseUri" => "http://" . $_SERVER['HTTP_HOST'],
        "staticBaseUri" => "http://" . $_SERVER['HTTP_HOST'] . '/'
    ));

    $smarty->assign('ts', time());

    return $smarty;
}

/**
 * 渲染模板
 *
 * @param {String} $tpl 模板路径，相对 view/
 * @param {Array} $data
 */
function render($tpl, $data) {
    $smarty = getSmarty($data);
    $smarty->display($tpl . '.html');
};


/**
 * 渲染模板
 *
 * @param {String} $tpl 模板路径，相对 view/
 * @param {Array} $data
 * @return {String}
 */
function fetch($tpl, $data) {
    $smarty = getSmarty($data);
    return $smarty->fetch($tpl . '.html');
};
