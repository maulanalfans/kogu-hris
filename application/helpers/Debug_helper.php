<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * dd(...)
 * Dump variables (human readable) and die.
 * Accepts multiple arguments like Laravel dd.
 *
 * NOTE: by default will do nothing in 'production' environment.
 *
 * Usage:
 *   dd($var);
 *   dd($var1, $var2);
 */
if (!function_exists('dd')) {
  function dd(...$vars)
  {
    // don't leak data in production
    if (defined('ENVIRONMENT') && ENVIRONMENT === 'production') {
      // in production return silently or you can throw an exception
      return;
    }

    // pretty wrapper
    echo '<div style="font-family:Menlo,Monaco,monospace;line-height:1.4;">';
    foreach ($vars as $i => $v) {
      echo '<div style="background:#f6f8fa;border:1px solid #e1e4e8;border-radius:6px;padding:12px;margin:10px 0;">';
      echo '<strong style="display:block;margin-bottom:8px;">Dump #' . ($i + 1) . ' (' . gettype($v) . ')</strong>';
      // prefer var_export for clean output, but var_dump provides types
      // we'll use a safe approach: capture var_dump to string
      ob_start();
      var_dump($v);
      $dump = ob_get_clean();
      // escape HTML (but keep line breaks)
      echo '<pre style="white-space:pre-wrap;margin:0;">' . htmlspecialchars($dump, ENT_QUOTES, 'UTF-8') . '</pre>';
      echo '</div>';
    }

    // show simple backtrace to help debugging
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    echo '<div style="font-size:12px;color:#666;margin-top:6px;">';
    echo '<strong>Backtrace:</strong><br>';
    // skip first frame (this dd function)
    for ($i = 1; $i < min(6, count($trace)); $i++) {
      $t = $trace[$i];
      $file = isset($t['file']) ? $t['file'] : '[internal]';
      $line = isset($t['line']) ? $t['line'] : '';
      $function = isset($t['function']) ? $t['function'] : '';
      echo htmlspecialchars("{$file}:{$line} — {$function}", ENT_QUOTES, 'UTF-8') . '<br>';
    }
    echo '</div>';

    echo '</div>';

    // stop execution
    exit(1);
  }
}
