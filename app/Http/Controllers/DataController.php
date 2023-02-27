<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataController extends Controller
{
    public function store(Request $request)
    {
        $start_time = microtime(true);
        $start_memory = memory_get_usage();

        $option = $request->input('option');
        $user_id = Auth::id(); // Get the authenticated user's ID

        switch ($option) {
            case 'JSON':
                $json = $request->input('json');

                $id = DB::table('data')->insertGetId([
                    'user_id' => $user_id,
                    'json' => $json,
                ]);

                $this->logExecutionTimeAndMemoryUsage("Data saved with ID {$id} for user ID {$user_id}.", $start_time, $start_memory);

                return response()->json(['id' => $id]);

            case 'instruction':
                $id = $request->input('id');
                $instruction = $request->input('instruction');

                $json = DB::table('data')
                    ->where('id', $id)
                    ->value('json');
                $data = json_decode($json);

                // Apply the instructions to the data object
                eval($instruction);

                DB::table('data')
                    ->where('id', $id)
                    ->update(['json' => json_encode($data)]);

                $this->logExecutionTimeAndMemoryUsage("Data updated with ID {$id} for user ID {$user_id}.", $start_time, $start_memory);

                return response()->json(['success' => true]);

            default:
                return response()->json(['error' => 'Invalid option parameter']);
        }
    }

    private function logExecutionTimeAndMemoryUsage($message, $start_time, $start_memory)
    {
        $end_time = microtime(true);
        $end_memory = memory_get_usage();

        $time_elapsed = round(($end_time - $start_time) * 1000, 2);
        $memory_used = round(($end_memory - $start_memory) / 1024, 2);

        Log::info("$message Time elapsed: {$time_elapsed} ms. Memory used: {$memory_used} KB.");
    }
}
