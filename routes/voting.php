<?php
Route::group([
    'prefix' => '/voting',
    'namespace' => 'Voting',
    'as' => 'voting.',
], function () {
    Route::get('/{activity}', 'Index@index')->where('activity', '[0-9]+')->name('index');
    Route::get('/{activity}/number/{number}', 'Index@player')->name('player.content');
    Route::get('/count', 'Index@count')->name('count');
    Route::get('/players', 'Player@index')->name('players');
    Route::get('/votes', 'Player@votes')->name('votes');
    Route::get('/query', 'Player@query')->name('query');
    Route::get('/ranks', 'Player@ranks')->name('ranks');
    Route::post('/vote', 'Vote@handle')->name('vote');
    Route::get('/{activity}/rank', 'Index@rank')->name('rank');
    Route::get('/{activity}/detail', 'Index@detail')->name('detail');

    // 临时
    Route::get('/share_count/{type}', function($type){
        if (!\Storage::exists('share_count')) {
            $count = [
              'share_1' => 0,
                'share_2' => 0
            ];
            \Storage::put('share_count', serialize($count));
        }
        $count = unserialize(\Storage::get('share_count'));
        if ($type === '1') {
            $count['share_1'] ++;
        } elseif ($type === '2') {
            $count['share_2'] ++;
        } else {

        }
        \Storage::put('share_count', serialize($count));
    });
    Route::get('/get_share_count', function (){
        $count = unserialize(\Storage::get('share_count'));
        return $count;
    });

});
Route::get('/share/count/{type}', 'Voting\Index@sc');
Route::get('tp/images/{width}/{stamp}/{id}.{ext}', 'Voting\Images@handle')->name('tp.images');