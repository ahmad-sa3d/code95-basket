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

    'accepted'             => ':attribute يجب أن يتم قبوله.', //'The :attribute must be accepted.',
    'active_url'           => ':attribute ليس عنوان ويب صحيح.', //'The :attribute is not a valid URL.',
    'after'                => ':attribute يجب أن يكون تاريخ بعد :date.', //'The :attribute must be a date after :date.',
    'alpha'                => ':attribute يجب ان يكون حروف فقط.', //'The :attribute may only contain letters.',
    'alpha_dash'           => ':attribute يجب أن يحتوى على حروف , أرقام و شرط.', //'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => ':attribute يجب أن يحتوى على حروف وأرقام فقط.', //'The :attribute may only contain letters and numbers.',
    'array'                => ':attribute يجب ان يكون مصفوفة.', //'The :attribute must be an array.',
    'before'               => ':attribute يجب أن يكون تاريخ قبل :date.', //'The :attribute must be a date before :date.',
    'between'              => [
        'numeric' => ':attribute يجب أن يكون رقم بين :min و :max.', //'The :attribute must be between :min and :max.',
        'file'    => ':attribute يجب أن يكون حجم الملف بين :min و :max كيلوبايت.', //'The :attribute must be between :min and :max kilobytes.',
        'string'  => ':attribute يجب أن يكون عدد الحروف بين :min و :max.', //'The :attribute must be between :min and :max characters.',
        'array'   => ':attribute يجب أن تكون المصفوفة بين :min و :max.', //'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => ':attribute يجب أن يكون قيمة منطقية.', //'The :attribute field must be true or false',
    'confirmed'            => ':attribute وتأكيدها لا يتطابقان.', //'The :attribute confirmation does not match.',
    'date'                 => ':attribute ليس تاريخ صحيح.', //'The :attribute is not a valid date.',
    'date_format'          => ':attribute لا يطابق نظام التاريخ :formate.', //'The :attribute does not match the format :format.',
    'different'            => ':attribute و :other يجب أن يكونوا مختلفين.', //'The :attribute and :other must be different.',
    'digits'               => ':attribute يجب أن يكون :digits رقم.', //'The :attribute must be :digits digits.',
    'digits_between'       => ':attribute يجب أن يكون عدد أرقام بين :min و :max.', //'The :attribute must be between :min and :max digits.',
    'distinct'             => ':attribute يوجد له قيمة مماثلة.',//'The :attribute field has a duplicate value.',
    'email'                => ':attribute يجب أن يكون بريد الترونى صحيح.', //'The :attribute must be a valid email address.',
    'exists'               => ':attribute غير صحيح.', //'The selected :attribute is invalid.',
    'filled'               => ':attribute حقل مطلوب ويجب ان يحتوى على قيمة غير خالية.', //'The :attribute field is required.',
    'image'                => ':attribute يجب أن يكون صورة.', //'The :attribute must be an image.',
    'in'                   => ':attribute غير صحيح.', //'The selected :attribute is invalid.',
    'in_array'             => ':attribute غير موجود ضمن :other.', // 'The :attribute field does not exist in :other.',
    'integer'              => ':attribute يجب أن يكون عدد صحيح.', //'The :attribute must be an integer.',
    'ip'                   => ':attribute يجب ان يكون أى بى صحيح.', //'The :attribute must be a valid IP address.',
    'json'                 => ':attribute يجب أن يكون json string', // 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ':attribute يجب أن لا يكون عدد اكبر من :max.', //'The :attribute may not be greater than :max.',
        'file'    => ':attribute يجب أن لا يزيد حجم الملف عن :max كيلوبايت.', //'The :attribute may not be greater than :max kilobytes.',
        'string'  => ':attribute يجب ان لا يزيد عدد الحروف عن :max.', //'The :attribute may not be greater than :max characters.',
        'array'   => ':attribute يجب أن لا يزيد حجم المصفوفة عن :max.', //'The :attribute may not have more than :max items.',
    ],
    'mimes'                => ':attribute يجب أن يكون ملف من الأنواع :values.', //'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => ':attribute يجب أن لا يكون عدد أقل من :min.', //'The :attribute must be at least :min.',
        'file'    => ':attribute يجب أن لا يقل حجم الملف عن :min كيلوبايت.', //'The :attribute must be at least :min kilobytes.',
        'string'  => ':attribute يجب ان لا يقل عدد الحروف عن :min.', //'The :attribute must be at least :min characters.',
        'array'   => ':attribute يجب أن لا يقل حجم المصفوفة عن :min.', //'The :attribute must have at least :min items.',
    ],
    'not_in'               => ':attribute غير صحيح.', //'The selected :attribute is invalid.',
    'numeric'              => ':attribute يجب ان يكون قيمة عددية.', //'The :attribute must be a number.',
    'present'              => ':attribute يجب أن يكون موجود.',// 'The :attribute field must be present.',
    'regex'                => ':attribute صيغة غير صحيحة.', //'The :attribute format is invalid.',
    'required'             => ':attribute حقل مطلوب.', //'The :attribute field is required.',
    'required_if'          => ':attribute حقل مطلوب عندما يكون :other قيمته :value.', //'The :attribute field is required when :other is :value.',
    'required_unless'      => ':attribute حقل مطلوب مالم :other تتواجد فى :value ', // 'The :attribute field is required unless :other is in :values.',
    'required_with'        => ':attribute حقل مطلوب عندما يكون :value موجود - ( موجودين على الأقل أحدهم).', //'The :attribute field is required when :values is present.',
    'required_with_all'    => ':attribute حقل مطلوب عندما يكون :value موجود - ( موجودين جميعهم).', //'The :attribute field is required when :values is present.',
    'required_without'     => ':attribute حقل مطلوب عندما يكون :value غير موجود - ( غير موجودين على الأقل أحدهم).', //'The :attribute field is required when :values is not present.',
    'required_without_all' => ':attribute حقل مطلوب عندما يكون :value غير موجود - ( غير موجودين جميعهم).', //'The :attribute field is required when none of :values are present.',
    'same'                 => ':attribute يجب أن يطابق :other.', //'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => ':attribute يجب ان يكون العدد :size', //'The :attribute must be :size.',
        'file'    => ':attribute يجب ان يكون حجم الملف :size كيلوبايت.', //'The :attribute must be :size kilobytes.',
        'string'  => ':attribute يجب أن يكون عدد الحروف :size.', //'The :attribute must be :size characters.',
        'array'   => ':attribute يجب ان يكون حجم المصفوفة :size.', //'The :attribute must contain :size items.',
    ],
    'string'               => ':attribute يجب ان يكون سلسلة حرفية.', // 'The :attribute must be a string.',
    'timezone'             => ':attribute يجب أن يكون منطقة توقيت صحيحة.', //'The :attribute must be a valid zone.',
    'unique'               => ':attribute موجود مسبقا برجاء إدخال قيمة أخرى.', //'The :attribute has already been taken.',
    'url'                  => ':attribute لا يطابق صيغة عنوان ويب.', //'The :attribute format is invalid.',
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of 'email'. This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'الإسم',
        'email' => 'البريد الإلكترونى',
        'password' => 'كلمة المرور',
        'image' => 'الصورة',
        'categories' => 'التصنيفات',
    ],

];
