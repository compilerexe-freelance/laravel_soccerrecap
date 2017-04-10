@php

    // Premier League

    /* League 16 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=16');
    $obj = json_decode($json);

    $livescore_league_16 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_16, $buffer);
    }
    /* End League 16 */

    /* League 18 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=18');
    $obj = json_decode($json);

    $livescore_league_18 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_18, $buffer);
    }
    /* End League 18 */

    /* League 25 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=25');
    $obj = json_decode($json);

    $livescore_league_25 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_25, $buffer);
    }
    /* End League 25 */

    /* League 39 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=39');
    $obj = json_decode($json);

    $livescore_league_39 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_39, $buffer);
    }
    /* End League 39 */

    /* League 40 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=40');
    $obj = json_decode($json);

    $livescore_league_40 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_40, $buffer);
    }
    /* End League 40 */

    /* League 296 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=296');
    $obj = json_decode($json);

    $livescore_league_296 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_296, $buffer);
    }
    /* End League 296 */

    /* League 41 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=41');
    $obj = json_decode($json);

    $livescore_league_41 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_41, $buffer);
    }
    /* End League 41 */

    /* League 43 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=43');
    $obj = json_decode($json);

    $livescore_league_43 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_43, $buffer);
    }
    /* End League 43 */

    /* League 329 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=329');
    $obj = json_decode($json);

    $livescore_league_329 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_329, $buffer);
    }
    /* End League 329 */

    /* League 113 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=113');
    $obj = json_decode($json);

    $livescore_league_113 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_113, $buffer);
    }
    /* End League 113 */

    /* League 131 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=131');
    $obj = json_decode($json);

    $livescore_league_131 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_131, $buffer);
    }
    /* End League 131 */

    /* League 132 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=132');
    $obj = json_decode($json);

    $livescore_league_132 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_132, $buffer);
    }
    /* End League 132 */

    /* League 154 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=154');
    $obj = json_decode($json);

    $livescore_league_154 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_154, $buffer);
    }
    /* End League 154 */

    /* League 249 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=249');
    $obj = json_decode($json);

    $livescore_league_249 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_249, $buffer);
    }
    /* End League 249 */

    /* League 138 */
    $json = file_get_contents('http://livescore-api.com/api-client/scores/live.json?key=AY8vF3sV6lmqtdTu&secret=4klaDfvjDzWRgCwQAFlfJNbQ8yhCMa6R&league=138');
    $obj = json_decode($json);

    $livescore_league_138 = array();

    foreach ($obj->data->match as $key => $value) {
        $buffer = array();
        array_push($buffer, $value->home_name);
        array_push($buffer, $value->away_name);
        array_push($buffer, $value->score);
        array_push($buffer, $value->time);

        array_push($livescore_league_138, $buffer);
    }
    /* End League 138 */

// End Premier League

@endphp

