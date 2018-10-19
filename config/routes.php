<?php

use NoahBuscher\Macaw\Macaw;

Macaw::get('', 'HomeController@home');
Macaw::get('testMail', 'HomeController@testMail');
Macaw::get('test','TestMail@sendAction');
Macaw::get('fuck', function () {
    echo "成功！";
});

Macaw::get('(:all)', function ($fu) {
    echo '未匹配到路由<br>' . $fu;
});

Macaw::dispatch();

