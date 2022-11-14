<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

if (!function_exists('logError')) {
  function logError(Exception $e, $request = false, $data = [])
  {
    $data[] = ['message' => $e->getMessage()];
    
    if ($request)
      $data[] = ['request' => json_encode($request)];
    
    Log::error('[Route: ' . Route::current()->action['as'] . ']', $data);
  }
}

if (!function_exists('formatDate')) {
  function formatDate($date) {
    return date_format(date_create($date), 'd/m/Y H:i:s');
  }
}