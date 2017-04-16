<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LiveScore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        // Premier League

        /* Country 19 */
        $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&country=19');
        $obj = json_decode($json);

        $livescore_country_19 = array();

        if (count($obj->data->match) >= 1) {
            foreach ($obj->data->match as $key => $value) {
                $buffer = array();
                array_push($buffer, $value->home_name);
                array_push($buffer, $value->away_name);
                array_push($buffer, $value->score);
                array_push($buffer, $value->time);

                array_push($livescore_country_19, $buffer);
            }
        }
        /* End Country 19 */

        /* Country 27 */
        $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&country=27');
        $obj = json_decode($json);

        $livescore_country_27 = array();

        if (count($obj->data->match) >= 1) {
            foreach ($obj->data->match as $key => $value) {
                $buffer = array();
                array_push($buffer, $value->home_name);
                array_push($buffer, $value->away_name);
                array_push($buffer, $value->score);
                array_push($buffer, $value->time);

                array_push($livescore_country_27, $buffer);
            }
        }
        /* End Country 27 */

        // End Premier League

        //$data = array($livescore_country_19, $livescore_country_27);
        $request->session()->forget('livescore_country_19');
        $request->session()->forget('livescore_country_27');
        session([
            'livescore_country_19' => $livescore_country_19,
            'livescore_country_27' => $livescore_country_27
        ]);
    }
}
