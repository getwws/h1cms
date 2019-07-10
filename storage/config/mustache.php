<?php
// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@getw.com>
// +----------------------------------------------------------------------

return array(
    'extension' => '.mustache',
    // The class prefix for compiled templates. Defaults to '__Mustache_'.
    'template_class_prefix' => '__H1CMS_',

    // A Mustache cache instance or a cache directory string for compiled templates.
    // Mustache will not cache templates unless this is set.
    'cache' => STORAGE_PATH.'/cache/mustache',

    // Override default permissions for cache files. Defaults to using the system-defined umask. It is
    // *strongly* recommended that you configure your umask properly rather than overriding permissions here.
    'cache_file_mode' => 0666,

    // Optionally, enable caching for lambda section templates. This is generally not recommended, as lambda
    // sections are often too dynamic to benefit from caching.
    'cache_lambda_templates' => true,

    // Customize the tag delimiters used by this engine instance. Note that overriding here changes the
    // delimiters used to parse all templates and partials loaded by this instance. To override just for a
    // single template, use an inline "change delimiters" tag at the start of the template file:
    //
    //     {{=<% %>=}}
    //
    //    'delimiters' => '<% %>',

    // A Mustache template loader instance. Uses a StringLoader if not specified.
    'loader' => new \Mustache_Loader_FilesystemLoader(THEME_PATH),

    // A Mustache loader instance for partials.
    'partials_loader' => new \Mustache_Loader_FilesystemLoader(THEME_PATH),

    // An array of Mustache partials. Useful for quick-and-dirty string template loading, but not as
    // efficient or lazy as a Filesystem (or database) loader.
    //    'partials' => array('foo' => file_get_contents(THEME_PATH.'/partials/foo.mustache')),

    // An array of 'helpers'. Helpers can be global variables or objects, closures (e.g. for higher order
    // sections), or any other valid Mustache context value. They will be prepended to the context stack,
    // so they will be available in any template loaded by this Mustache instance.
    'helpers' => array('t' => function ($message, $args = [], $options = []) {
        return t($message, $args, $options);
    }),

    // An 'escape' callback, responsible for escaping double-mustache variables.
    'escape' => function ($value) {
        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
    },

    // Type argument for `htmlspecialchars`.  Defaults to ENT_COMPAT.  You may prefer ENT_QUOTES.
    'entity_flags' => ENT_QUOTES,

    // Character set for `htmlspecialchars`. Defaults to 'UTF-8'. Use 'UTF-8'.
    'charset' => 'UTF-8',

    // A Mustache Logger instance. No logging will occur unless this is set. Using a PSR-3 compatible
    // logging library -- such as Monolog -- is highly recommended. A simple stream logger implementation is
    // available as well:
    'logger' => new \Mustache_Logger_StreamLogger('php://stderr'),

    // Only treat Closure instances and invokable classes as callable. If true, values like
    // `array('ClassName', 'methodName')` and `array($classInstance, 'methodName')`, which are traditionally
    // "callable" in PHP, are not called to resolve variables for interpolation or section contexts. This
    // helps protect against arbitrary code execution when user input is passed directly into the template.
    // This currently defaults to false, but will default to true in v3.0.
    'strict_callables' => true,

    // Enable pragmas across all templates, regardless of the presence of pragma tags in the individual
    // templates.
    'pragmas' => [\Mustache_Engine::PRAGMA_FILTERS],
);
