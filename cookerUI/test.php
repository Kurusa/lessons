<?php

$array = [
    "name" => "Морквяний салат з кальмарами",
    "cookingTime" => "20",

    'ingredients' => [
        '300гр кальмарів',
        '3 моркви',
        '1 цибуля',
        '2 ст. ложки лимонного соку',
        '2 маринованих огірка',
        '2 яйця',
        '2 ст. ложки майонезу',
        'сіль і перець'
    ],

    'steps' => [
        ['n' => 'Відваріть моркву.', 't' => 20],
        ['n' => 'Очистіть моркву, охолодіть і натріть на терці.', 't' => 0],
        ['n' => 'Зваріть яйця і наріжте їх кубиками.', 't' => 0],
        ['n' => 'Огірки також наріжте дрібними кубиками.', 't' => 0],
        ['n' => 'Дрібно поріжте цибулю.', 't' => 0],
        ['n' => 'Змішайте моркву, яйця, огірки і цибулю.', 't' => 0],
        ['n' => 'Кальмари відваріть в солоній воді і наріжте полосками.', 't' => 2],
        ['n' => 'Додайте кальмари в салат.', 't' => 0],
        ['n' => 'Додайте лимонний сік, посоліть, заправте майонезом.', 't' => 0],
    ]
];

?>

<script>

    var array = [
        ings = [
            {
                'name': 'a',
                't': 0
            }
        ]
    ];

    for (var q = 0; q < array.ings.length; q++) {
        q.push('abc');
    }

    console.log(array);

</script>