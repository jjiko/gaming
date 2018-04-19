<?php
Artisan::command('subscribe multistreamer', function(){

});

Artisan::command('psn activities', function(){
  $user = User::find(2);
  $playstationActivities = Activity::where('category', 'PlaystationFeed')->get();

  $recent = $user->instagram->recent();
  foreach (array_get($recent, 'data') as $i => $photo) {
    // don't add duplicates
    if ($instagramActivities->contains('f_id', array_get($photo, 'id'))) continue;

    $attributes = [
      'f_id' => array_get($photo, 'id'),
      'action' => 'created',
      'category' => 'InstagramPhoto',
      'label' => array_get($photo, 'caption.text', ""),
      'created_at' => array_get($photo, 'created_time'),
    ];
    $attributes['value'] = [
      'attributes' => [
        'comments' => array_get($photo, 'comments.count'),
        'images' => array_get($photo, 'images'),
        'likes' => array_get($photo, 'likes.count'),
        'url' => array_get($photo, 'link'),
        'user' => [
          'user_id' => array_get($photo, 'user.id'),
          'username' => array_get($photo, 'user.username'),
        ],
        'tags' => array_get($photo, 'tags'),
      ]
    ];

    Activity::firstOrCreate(['f_id' => array_get($photo, 'id'), 'category' => 'PlaystationFeed', 'action' => 'created'], $attributes);
  }

  $cache = ApiCache::firstOrCreate([
    'category' => 'API',
    'key' => 'playstation.feed.recent'
  ], [
    'data' => json_encode($recent)
  ]);

  $cache->data = json_encode($recent);
  $cache->save();
});