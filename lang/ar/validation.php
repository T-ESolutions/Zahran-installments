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

    'accepted' => 'يجب قبول الحقل :attribute',
    'accepted_if' => 'الحقل :attribute مقبول في حال ما إذا كان :other يساوي :value.',
    'active_url' => 'الحقل :attribute لا يُمثّل رابطًا صحيحًا',
    'after' => 'يجب على الحقل :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => 'الحقل :attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي الحقل :attribute سوى على حروف',
    'alpha_dash' => 'يجب أن لا يحتوي الحقل :attribute على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط',
    'array' => 'يجب أن يكون الحقل :attribute ًمصفوفة',
    'before' => 'يجب على الحقل :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => 'الحقل :attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date',
    'between' => [
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max',
    ],
    'boolean' => 'يجب أن تكون قيمة الحقل :attribute إما true أو false ',
    'confirmed' => 'حقل التأكيد غير مُطابق للحقل :attribute',
    'current_password' => 'كلمة المرور غير صحيحة',
    'date' => 'الحقل :attribute ليس تاريخًا صحيحًا',
    'date_equals' => 'لا يساوي الحقل :attribute مع :date.',
    'date_format' => 'لا يتوافق الحقل :attribute مع الشكل :format.',
    'declined' => 'يجب رفض الحقل :attribute',
    'declined_if' => 'الحقل :attribute مرفوض في حال ما إذا كان :other يساوي :value.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفان',
    'digits' => 'يجب أن يحتوي الحقل :attribute على :digits رقمًا/أرقام',
    'digits_between' => 'يجب أن يحتوي الحقل :attribute بين :min و :max رقمًا/أرقام',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'doesnt_end_with' => 'الحقل :attribute يجب ألا ينتهي بواحدة من القيم التالية: :values.',
    'doesnt_start_with' => 'الحقل :attribute يجب ألا يبدأ بواحدة من القيم التالية: :values.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية',
    'ends_with' => 'الـ :attribute يجب ان ينتهي بأحد القيم التالية :value.',
    'enum' => 'الحقل :attribute غير صحيح',
    'exists' => 'الحقل :attribute غير موجودٍ',
    'file' => 'الـ :attribute يجب أن يكون من ملفا.',
    'filled' => 'الحقل :attribute إجباري',
    'gt' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي اكثر من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب ان يكون اكبر من :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اكبر من :value.',
        'string' => 'الـ :attribute يجب ان يكون اكبر من :value حروفٍ/حرفًا.',
    ],
    'gte' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي :value عناصر/عنصر او اكثر.',
        'file' => 'الـ :attribute يجب ان يكون اكبر من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اكبر من او يساوي :value.',
        'string' => 'الـ :attribute يجب ان يكون اكبر من او يساوي :value حروفٍ/حرفًا.',
    ],
    'image' => 'يجب أن يكون الحقل :attribute صورةً',
    'in' => 'الحقل :attribute غير موجودٍ',
    'in_array' => 'الحقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون الحقل :attribute عددًا صحيحًا',
    'ip' => 'يجب أن يكون الحقل :attribute عنوان IP ذا بُنية صحيحة',
    'ipv4' => 'يجب أن يكون الحقل :attribute عنوان IPv4 ذا بنية صحيحة.',
    'ipv6' => 'يجب أن يكون الحقل :attribute عنوان IPv6 ذا بنية صحيحة.',
    'json' => 'يجب أن يكون الحقل :attribute نصا من نوع JSON.',
    'lowercase' => 'الحقل :attribute يجب ان يتكون من حروف صغيرة',
    'lt' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي اقل من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب ان يكون اقل من :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اقل من :value.',
        'string' => 'الـ :attribute يجب ان يكون اقل من :value حروفٍ/حرفًا.',
    ],
    'lte' => [
        'array' => 'الـ :attribute يجب ان يحتوي علي اكثر من :value عناصر/عنصر.',
        'file' => 'الـ :attribute يجب ان يكون اقل من او يساوي :value كيلو بايت.',
        'numeric' => 'الـ :attribute يجب ان يكون اقل من او يساوي :value.',
        'string' => 'الـ :attribute يجب ان يكون اقل من او يساوي :value حروفٍ/حرفًا.',
    ],
    'mac_address' => 'يجب أن يكون الحقل :attribute عنوان MAC ذا بنية صحيحة.',
    'max' => [
        'array' => 'يجب أن لا يحتوي الحقل :attribute على أكثر من :max عناصر/عنصر.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أصغر لـ :max.',
        'string' => 'يجب أن لا يتجاوز طول نص :attribute :max حروفٍ/حرفًا',
    ],
    'max_digits' => 'الحقل :attribute يجب ألا يحتوي أكثر من :max أرقام.',
    'mimes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون الحقل ملفًا من نوع : :values.',
    'min' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على الأقل على :min عُنصرًا/عناصر',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية أو أكبر لـ :min.',
        'string' => 'يجب أن يكون طول نص :attribute على الأقل :min حروفٍ/حرفًا',
    ],
    'min_digits' => 'الحقل :attribute يجب أن يحتوي :min أرقام على الأقل.',
    'multiple_of' => 'الحقل :attribute يجب أن يكون من مضاعفات :value.',
    'not_in' => 'الحقل :attribute غير موجودٍ',
    'not_regex' => 'الحقل :attribute نوعه غير موجودٍ',
    'numeric' => 'يجب على الحقل :attribute أن يكون رقمًا',
    'password' => [
        'letters' => 'يجب ان يشمل حقل :attribute على حرف واحد على الاقل.',
        'mixed' => 'يجب ان يشمل حقل :attribute على حرف واحد بصيغة كبيرة على الاقل وحرف اخر بصيغة صغيرة.',
        'numbers' => 'يجب ان يشمل حقل :attribute على رقم واحد على الاقل.',
        'symbols' => 'يجب ان يشمل حقل :attribute على رمز واحد على الاقل.',
        'uncompromised' => 'حقل :attribute تبدو غير آمنة. الرجاء اختيار قيمة اخرى.',
    ],
    'present' => 'يجب تقديم الحقل :attribute',
    'prohibited' => 'الحقل :attribute محظور',
    'prohibited_if' => 'الحقل :attribute محظور في حال ما إذا كان :other يساوي :value.',
    'prohibited_unless' => 'الحقل :attribute محظور في حال ما لم يكون :other يساوي :value.',
    'prohibits' => 'الحقل :attribute يحظر :other من اي يكون موجود',
    'regex' => 'صيغة الحقل :attribute .غير صحيحة',
    'required' => 'الحقل :attribute مطلوب.',
    'required_array_keys' => 'الحقل :attribute يجب ان يحتوي علي مدخلات للقيم التالية :values.',
    'required_if' => 'الحقل :attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'الحقل :attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with' => 'الحقل :attribute إذا توفّر :values.',
    'required_with_all' => 'الحقل :attribute إذا توفّر :values.',
    'required_without' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'required_without_all' => 'الحقل :attribute إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق الحقل :attribute مع :other',
    'size' => [
        'array' => 'يجب أن يحتوي الحقل :attribute على :size عنصرٍ/عناصر بالظبط',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت',
        'numeric' => 'يجب أن تكون قيمة الحقل :attribute مساوية لـ :size',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالظبط',
    ],
    'starts_with' => 'الحقل :attribute يجب ان يبدأ بأحد القيم التالية: :values.',
    'string' => 'يجب أن يكون الحقل :attribute نصآ.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا',
    'unique' => 'قيمة الحقل :attribute مُستخدمة من قبل',
    'uploaded' => 'فشل في تحميل الـ :attribute',
    'uppercase' => 'The :attribute must be uppercase.',
    'url' => 'صيغة الرابط :attribute غير صحيحة',
    'uuid' => 'الحقل :attribute يجب ان ايكون رقم UUID صحيح.',

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
        'name' => [
            'regex' => 'يجب ان يحتوي الاسم علي الاقل حرف واحد',
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

    'attributes' => [
        'discount' => 'تخفيض',
        'rate' => 'التقيم',
        'post_category_id' => 'قسم المقال',
        'url' => 'الرابط',
        'approval ' => 'الموافقه',
        'status ' => 'الحاله',
        'role_id' => 'الدور',
        'customer_id' => 'العملاء',
        'price' => 'السعر',
        'phone' => 'رقم الهاتف',
        'description_ar' => 'الوصف بالعربيه',
        'description_en' => 'الوصف بالانجليزيه',
        'category_ids' => 'الاقسام',
        'category_id' => 'القسم',
        'parent_id' => 'القسم الفرعي',
        'image' => 'الصوره',
        'customer_name' => 'اسم العميل',
        'images' => 'الصور الإسلايدر',
        'classification_id' => 'التصنيف',
        'brand_ids' => 'العلامات التجاريه',
        'duration' => 'المده',
        'email' => 'البريد الالكتروني',
        'amount' => 'الكميه',
        'name' => 'الاسم',
        'offer_id' => 'العرض',
        'confirmation' => 'موافقه الشروط',
        'doctors_ids' => 'الاطباء',
        'permissions' => 'الصلاحيات',

        'type' => 'النوع',
        'name_ar' => 'الاسم بالعربيه',
        'name_en' => 'الاسم بالانجليزيه',
        'title_ar' => 'الاسم بالعربيه',
        'title_en' => 'الاسم بالانجليزيه',
        'roles' => 'الصلاحيه',
        'password' => 'كلمه المرور',
        'default_refill_duration' => ' الفتره الافتراضية',
        'id_number' => 'رقم هويه الشركه',
        'first_name_ar' => 'الاسم الاول بالعربيه',
        'first_name_en' => 'الاسم الاول بالانجليزيه',
        'second_name_ar' => 'الاسم الاول بالعربيه',
        'second_name_en' => 'الاسم الاول بالانجليزيه',
        'items_ids' => 'العناصر',
        'classification_ids' => 'التصنيفات',
        'sub_classification_ids' => 'التصنيفات الفرعيه',
        'insurance_customer' => 'نوع تامين العميل',
        'new_password' => 'كلمه المرور الجديده',
        'current_password' => 'كلمه المرور الحاليه',
        'item_type' => 'نوع المهمه',
        'soDateFrom' => 'تاريخ المبيعات من',
        'soDateTo' => 'تاريخ المبيعات الي',
        'callDateFrom' => 'تاريخ الاتصال من',
        'callDateTo' => 'تاريخ الاتصال الي',
        'refileDateFrom' => 'تاريخ اعاده الملئ من',
        'refileDateTo' => 'تاريخ اعادة الملئ الي',
        "agents_number"=>"عدد المساعدين",
        "brands_ids"=>"العلامات التجاريه",
        "categories_ids"=>"الفئات",
        "grade"=>"المرتبة",
        "to"=>"الي",
        "from"=>"من",
        "types"=>"الانواع",
        "customer_duration"=>"مده العميل",
        "customer_min_price"=>"الحد الادني للسعر للعميل",
        "date"=>"اليوم",
        "percentage"=>"النسبه",
        "hour"=>"الساعه",
        "factor"=>"المعامل",
        'specialization_id' => 'التخصص',
        'password_confirmation' => 'تأكيد كلمه المرور',
        'add_tax'=>'إضافة ضريبة',
        'module_type'=>'نوع المنتج',
        'products_ids' => 'المنتجات',
        'answers_id' => 'الاجابات',
        'data' => 'بيانات الخطه',
        'title' => 'العنوان',
        'text' => 'المحتوي',

        'address' => 'العنوان',
        'address_id' => 'العنوان بالبطاقه',
        'phone2' => 'الهاتف 2',
        'phone3' => 'الهاتف 3',
        'governorate' => 'المحافظه',
        'center' => 'المركز',
        'note' => 'ملاحظات',
        'id_image_front' => 'صوره البطاقه الاماميه',
        'id_image_back' => 'صوره البطاقه الخلفيه',

    ],
];
