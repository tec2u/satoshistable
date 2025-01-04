<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

   'accepted' => ':attribute должен быть принят.',
'accepted_if' => ':attribute должен быть принят, когда :other равно :value.',
'active_url' => ':attribute не является допустимым URL.',
'after' => ':attribute должен быть датой после :date.',
'after_or_equal' => ':attribute должен быть датой после или равной :date.',
'alpha' => ':attribute должен содержать только буквы.',
'alpha_dash' => ':attribute может содержать только буквы, цифры, дефисы и символы подчеркивания.',
'alpha_num' => ':attribute должен содержать только буквы и цифры.',
'array' => ':attribute должен быть массивом.',
'before' => ':attribute должен быть датой до :date.',
'before_or_equal' => ':attribute должен быть датой до или равной :date.',
'between' => [
    'array' => ':attribute должен содержать от :min до :max элементов.',
    'file' => ':attribute должен быть от :min до :max килобайт.',
    'numeric' => ':attribute должен быть между :min и :max.',
    'string' => ':attribute должен содержать от :min до :max символов.',
],
'boolean' => ':attribute поле должно быть истинным или ложным.',
'confirmed' => 'Подтверждение :attribute не совпадает.',
'current_password' => 'Пароль неверный.',
'date' => ':attribute не является допустимой датой.',
'date_equals' => ':attribute должен быть датой, равной :date.',
'date_format' => ':attribute не соответствует формату :format.',
'declined' => ':attribute должен быть отклонен.',
'declined_if' => ':attribute должен быть отклонен, когда :other равно :value.',
'different' => ':attribute и :other должны быть разными.',
'digits' => ':attribute должен состоять из :digits цифр.',
'digits_between' => ':attribute должен быть между :min и :max цифрами.',
'dimensions' => ':attribute имеет недопустимые размеры изображения.',
'distinct' => ':attribute поле содержит повторяющееся значение.',
'doesnt_end_with' => ':attribute не может заканчиваться одним из следующих значений: :values.',
'doesnt_start_with' => ':attribute не может начинаться с одного из следующих значений: :values.',
'email' => ':attribute должен быть допустимым адресом электронной почты.',
'ends_with' => ':attribute должен заканчиваться одним из следующих значений: :values.',
'enum' => 'Выбранный :attribute недействителен.',
'exists' => 'Выбранный :attribute недействителен.',
'file' => ':attribute должен быть файлом.',
'filled' => ':attribute поле должно иметь значение.',
'gt' => [
    'array' => ':attribute должен содержать больше, чем :value элементов.',
    'file' => ':attribute должен быть больше, чем :value килобайт.',
    'numeric' => ':attribute должен быть больше, чем :value.',
    'string' => ':attribute должен содержать больше, чем :value символов.',
],
'gte' => [
    'array' => ':attribute должен содержать :value элементов или больше.',
    'file' => ':attribute должен быть больше или равен :value килобайт.',
    'numeric' => ':attribute должен быть больше или равен :value.',
    'string' => ':attribute должен содержать :value символов или больше.',
],
'image' => ':attribute должен быть изображением.',
'in' => 'Выбранный :attribute недействителен.',
'in_array' => ':attribute поле не существует в :other.',
'integer' => ':attribute должен быть целым числом.',
'ip' => ':attribute должен быть допустимым IP-адресом.',
'ipv4' => ':attribute должен быть допустимым IPv4-адресом.',
'ipv6' => ':attribute должен быть допустимым IPv6-адресом.',
'json' => ':attribute должен быть допустимой строкой JSON.',
'lt' => [
    'array' => ':attribute должен содержать меньше, чем :value элементов.',
    'file' => ':attribute должен быть меньше, чем :value килобайт.',
    'numeric' => ':attribute должен быть меньше, чем :value.',
    'string' => ':attribute должен содержать меньше, чем :value символов.',
],
'lte' => [
    'array' => ':attribute не должен содержать больше, чем :value элементов.',
    'file' => ':attribute должен быть меньше или равен :value килобайт.',
    'numeric' => ':attribute должен быть меньше или равен :value.',
    'string' => ':attribute должен содержать меньше или равно :value символов.',
],
'mac_address' => ':attribute должен быть допустимым MAC-адресом.',
'max' => [
    'array' => ':attribute не должен содержать более :max элементов.',
    'file' => ':attribute не должен превышать :max килобайт.',
    'numeric' => ':attribute не должен быть больше, чем :max.',
    'string' => ':attribute не должен содержать более :max символов.',
],
'max_digits' => ':attribute не должен содержать более :max цифр.',
'mimes' => ':attribute должен быть файлом одного из следующих типов: :values.',
'mimetypes' => ':attribute должен быть файлом одного из следующих типов: :values.',
'min' => [
    'array' => ':attribute должен содержать как минимум :min элементов.',
    'file' => ':attribute должен быть не менее :min килобайт.',
    'numeric' => ':attribute должен быть не менее :min.',
    'string' => ':attribute должен содержать не менее :min символов.',
],
'min_digits' => ':attribute должен содержать как минимум :min цифр.',
'multiple_of' => ':attribute должен быть кратным :value.',
'not_in' => 'Выбранный :attribute недействителен.',
'not_regex' => ':attribute формат недействителен.',
'numeric' => ':attribute должен быть числом.',
'password' => [
    'letters' => ':attribute должен содержать как минимум одну букву.',
    'mixed' => ':attribute должен содержать как минимум одну заглавную и одну строчную букву.',
    'numbers' => ':attribute должен содержать как минимум одну цифру.',
    'symbols' => ':attribute должен содержать как минимум один символ.',
    'uncompromised' => 'Данный :attribute был найден в утечке данных. Пожалуйста, выберите другой :attribute.',
],
'present' => ':attribute поле должно присутствовать.',
'prohibited' => ':attribute поле запрещено.',
'prohibited_if' => ':attribute поле запрещено, когда :other равно :value.',
'prohibited_unless' => ':attribute поле запрещено, если только :other не входит в :values.',
'prohibits' => ':attribute поле запрещает присутствие :other.',
'regex' => ':attribute формат недействителен.',
'required' => ':attribute поле обязательно для заполнения.',
'required_array_keys' => ':attribute поле должно содержать записи для: :values.',
'required_if' => ':attribute поле обязательно, когда :other равно :value.',
'required_unless' => ':attribute поле обязательно, если :other не входит в :values.',
'required_with' => ':attribute поле обязательно, когда :values присутствует.',
'required_with_all' => ':attribute поле обязательно, когда :values присутствуют.',
'required_without' => ':attribute поле обязательно, когда :values отсутствует.',
'required_without_all' => ':attribute поле обязательно, когда ни одно из :values не присутствует.',
'same' => ':attribute и :other должны совпадать.',
'size' => [
    'array' => ':attribute должен содержать :size элементов.',
    'file' => ':attribute должен быть :size килобайт.',
    'numeric' => ':attribute должен быть равен :size.',
    'string' => ':attribute должен содержать :size символов.',
],
'starts_with' => ':attribute должен начинаться с одного из следующих: :values.',
'string' => ':attribute должен быть строкой.',
'timezone' => ':attribute должен быть допустимым часовым поясом.',
'unique' => ':attribute уже занят.',
'uploaded' => ':attribute не удалось загрузить.',
'url' => ':attribute должен быть допустимым URL.',
'uuid' => ':attribute должен быть допустимым UUID.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
