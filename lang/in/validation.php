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

   'accepted' => ':attribute को स्वीकार किया जाना चाहिए।',
'accepted_if' => 'जब :other :value हो, तो :attribute को स्वीकार किया जाना चाहिए।',
'active_url' => ':attribute एक मान्य URL नहीं है।',
'after' => ':attribute :date के बाद की तारीख होनी चाहिए।',
'after_or_equal' => ':attribute :date के बाद या उसके बराबर की तारीख होनी चाहिए।',
'alpha' => ':attribute में केवल अक्षर होने चाहिए।',
'alpha_dash' => ':attribute में केवल अक्षर, नंबर, डैश और अंडरस्कोर होने चाहिए।',
'alpha_num' => ':attribute में केवल अक्षर और नंबर होने चाहिए।',
'array' => ':attribute एक सरणी होनी चाहिए।',
'before' => ':attribute :date के पहले की तारीख होनी चाहिए।',
'before_or_equal' => ':attribute :date के पहले या उसके बराबर की तारीख होनी चाहिए।',
'between' => [
    'array' => ':attribute में :min और :max वस्तुओं के बीच होना चाहिए।',
    'file' => ':attribute :min और :max किलोबाइट्स के बीच होना चाहिए।',
    'numeric' => ':attribute :min और :max के बीच होना चाहिए।',
    'string' => ':attribute :min और :max वर्णों के बीच होना चाहिए।',
],
'boolean' => ':attribute फ़ील्ड सही या गलत होना चाहिए।',
'confirmed' => ':attribute पुष्टि मेल नहीं खा रही है।',
'current_password' => 'पासवर्ड गलत है।',
'date' => ':attribute मान्य तारीख नहीं है।',
'date_equals' => ':attribute :date के बराबर तारीख होनी चाहिए।',
'date_format' => ':attribute प्रारूप :format से मेल नहीं खा रहा है।',
'declined' => ':attribute को अस्वीकार किया जाना चाहिए।',
'declined_if' => 'जब :other :value हो, तो :attribute को अस्वीकार किया जाना चाहिए।',
'different' => ':attribute और :other अलग होना चाहिए।',
'digits' => ':attribute :digits अंक का होना चाहिए।',
'digits_between' => ':attribute :min और :max अंकों के बीच होना चाहिए।',
'dimensions' => ':attribute की छवि का आयाम अमान्य है।',
'distinct' => ':attribute फ़ील्ड का डुप्लिकेट मान है।',
'doesnt_end_with' => ':attribute निम्न में से किसी एक से समाप्त नहीं हो सकता: :values।',
'doesnt_start_with' => ':attribute निम्न में से किसी एक से शुरू नहीं हो सकता: :values।',
'email' => ':attribute एक मान्य ईमेल पता होना चाहिए।',
'ends_with' => ':attribute निम्न में से किसी एक के साथ समाप्त होना चाहिए: :values।',
'enum' => 'चयनित :attribute अमान्य है।',
'exists' => 'चयनित :attribute अमान्य है।',
'file' => ':attribute एक फाइल होनी चाहिए।',
'filled' => ':attribute फ़ील्ड में एक मान होना चाहिए।',
'gt' => [
    'array' => ':attribute में :value से अधिक वस्तुएं होनी चाहिए।',
    'file' => ':attribute :value किलोबाइट्स से अधिक होना चाहिए।',
    'numeric' => ':attribute :value से अधिक होना चाहिए।',
    'string' => ':attribute :value वर्णों से अधिक होना चाहिए।',
],
'gte' => [
    'array' => ':attribute में :value या अधिक वस्तुएं होनी चाहिए।',
    'file' => ':attribute :value किलोबाइट्स के बराबर या उससे अधिक होना चाहिए।',
    'numeric' => ':attribute :value के बराबर या उससे अधिक होना चाहिए।',
    'string' => ':attribute :value वर्णों के बराबर या उससे अधिक होना चाहिए।',
],
'image' => ':attribute एक छवि होनी चाहिए।',
'in' => 'चयनित :attribute अमान्य है।',
'in_array' => ':attribute फ़ील्ड :other में मौजूद नहीं है।',
'integer' => ':attribute एक पूर्णांक होना चाहिए।',
'ip' => ':attribute एक मान्य IP पता होना चाहिए।',
'ipv4' => ':attribute एक मान्य IPv4 पता होना चाहिए।',
'ipv6' => ':attribute एक मान्य IPv6 पता होना चाहिए।',
'json' => ':attribute एक मान्य JSON स्ट्रिंग होनी चाहिए।',
'lt' => [
    'array' => ':attribute में :value से कम वस्तुएं होनी चाहिए।',
    'file' => ':attribute :value किलोबाइट्स से कम होना चाहिए।',
    'numeric' => ':attribute :value से कम होना चाहिए।',
    'string' => ':attribute :value वर्णों से कम होना चाहिए।',
],
'lte' => [
    'array' => ':attribute में :value से अधिक वस्तुएं नहीं होनी चाहिए।',
    'file' => ':attribute :value किलोबाइट्स से कम या उसके बराबर होना चाहिए।',
    'numeric' => ':attribute :value से कम या उसके बराबर होना चाहिए।',
    'string' => ':attribute :value वर्णों से कम या उसके बराबर होना चाहिए।',
],
'mac_address' => ':attribute एक मान्य MAC पता होना चाहिए।',
'max' => [
    'array' => ':attribute में :max से अधिक वस्तुएं नहीं होनी चाहिए।',
    'file' => ':attribute :max किलोबाइट्स से अधिक नहीं होना चाहिए।',
    'numeric' => ':attribute :max से अधिक नहीं होना चाहिए।',
    'string' => ':attribute :max वर्णों से अधिक नहीं होना चाहिए।',
],
'max_digits' => ':attribute में :max से अधिक अंक नहीं हो सकते।',
'mimes' => ':attribute फाइल प्रकार का होना चाहिए: :values।',
'mimetypes' => ':attribute फाइल प्रकार का होना चाहिए: :values।',
'min' => [
    'array' => ':attribute में कम से कम :min वस्तुएं होनी चाहिए।',
    'file' => ':attribute कम से कम :min किलोबाइट्स का होना चाहिए।',
    'numeric' => ':attribute कम से कम :min होना चाहिए।',
    'string' => ':attribute कम से कम :min वर्णों का होना चाहिए।',
],
'min_digits' => ':attribute में कम से कम :min अंक होने चाहिए।',
'multiple_of' => ':attribute :value का गुणक होना चाहिए।',
'not_in' => 'चयनित :attribute अमान्य है।',
'not_regex' => ':attribute प्रारूप अमान्य है।',
'numeric' => ':attribute एक संख्या होनी चाहिए।',
'password' => [
    'letters' => ':attribute में कम से कम एक अक्षर होना चाहिए।',
    'mixed' => ':attribute में कम से कम एक बड़ा और एक छोटा अक्षर होना चाहिए।',
    'numbers' => ':attribute में कम से कम एक अंक होना चाहिए।',
    'symbols' => ':attribute में कम से कम एक प्रतीक होना चाहिए।',
    'uncompromised' => 'दिया गया :attribute डेटा लीक में पाया गया है। कृपया एक अलग :attribute चुनें।',
],
'present' => ':attribute फ़ील्ड उपस्थित होना चाहिए।',
'prohibited' => ':attribute फ़ील्ड निषिद्ध है।',
'prohibited_if' => ':attribute फ़ील्ड निषिद्ध है जब :other :value हो।',
'prohibited_unless' => ':attribute फ़ील्ड निषिद्ध है जब तक :other :values में न हो।',
'prohibits' => ':attribute फ़ील्ड :other को उपस्थित होने से रोकता है।',
'regex' => ':attribute प्रारूप अमान्य है।',
'required' => ':attribute फ़ील्ड आवश्यक है।',
'required_array_keys' => ':attribute फ़ील्ड में निम्नलिखित प्रविष्टियाँ होनी चाहिए: :values।',
'required_if' => ':attribute फ़ील्ड आवश्यक है जब :other :value हो।',
'required_unless' => ':attribute फ़ील्ड आवश्यक है जब तक :other :values में न हो।',
'required_with' => ':attribute फ़ील्ड आवश्यक है जब :values उपस्थित हो।',
'required_with_all' => ':attribute फ़ील्ड आवश्यक है जब :values उपस्थित हो।',
'required_without' => ':attribute फ़ील्ड आवश्यक है जब :values उपस्थित न हो।',
'required_without_all' => ':attribute फ़ील्ड आवश्यक है जब :values में से कोई भी उपस्थित न हो।',
'same' => ':attribute और :other मेल खाना चाहिए।',
'size' => [
    'array' => ':attribute में :size वस्तुएं होनी चाहिए।',
    'file' => ':attribute :size किलोबाइट्स का होना चाहिए।',
    'numeric' => ':attribute :size होना चाहिए।',
    'string' => ':attribute :size वर्णों का होना चाहिए।',
],
'starts_with' => ':attribute निम्न में से किसी एक से शुरू होना चाहिए: :values।',
'string' => ':attribute एक स्ट्रिंग होनी चाहिए।',
'timezone' => ':attribute एक मान्य समय क्षेत्र होना चाहिए।',
'unique' => ':attribute पहले ही लिया जा चुका है।',
'uploaded' => ':attribute अपलोड करने में विफल।',
'url' => ':attribute एक मान्य URL होना चाहिए।',
'uuid' => ':attribute एक मान्य UUID होना चाहिए।',


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
