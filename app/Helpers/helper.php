<?php

if (!function_exists('contains_filtered_words')) {
    function contains_filtered_words($text)
    {
        $filteredWords = [
            'တပ်မတော်', 'စစ်တပ်', 'ရဲ', 'မူးယစ်', 'အာဏာသိမ်း', 'လွှတ်တော်', 'မြန်မာ့တပ်မတော်',
            'Junta', 'Military', 'Army', 'Police', 'Commander-in-Chief', 'Regime', 'Martial Law',
            'ပြည်တွင်းစစ်', 'တိုက်ပွဲ', 'မိုင်း', 'ဗုံး', 'စစ်ဘက်', 'လက်နက်',
            'မုဒိမ်း', 'ကျည်ဆံ', 'Firefight', 'Attack', 'War', 'Civil War', 'Strike', 'Terrorist',
            'Guerrilla', 'Genocide', 'ပြောက်ကျားတပ်ဖွဲ့', 'တော်လှန်ရေး', 'တော်လှန်', 'တိုက်ခိုက်',
            'PDF','pdf', 'pdfတွေ၀င်လာပြီ', 'အမေစု', 'ဒေါ်အောင်ဆန်းစုကြည်', 'အောင်ဆန်းစုကြည်','မြို့သိမ်းတိုက်ပွဲ', 'တိုက်ပွဲ',
            'မြို့သိမ်း','ပျူစောထိီး','ထောက်ပို့','အုပ်ကြီး', 'ရွေးကောက်ပွဲ','ဒီမိုကရေစီ', 'Air Strike', 'Drone','ဒရုန်း', 'အဲစထရိုက်',
            'ငါလိုးမသား', 'မအေလိုး', 'ကိုမေကိုလိုး', 'ကမကလ', 'ဖရဲသီး','နီပိန်း','ကြံ့ဖွတ်', 'ကြံ့ခိုင်ရေးပါတီ', 'Bomb',
            'KIA', 'ကေအိုင်အေ', 'ကေအန်ယူ', 'KNU','TNLA','သပိတ်', 'ပစ်ခတ်', 'ဆန္ဒပြ', 'Democracy',
            'Protest', 'Resistance', 'Rebel', 'Revolution','သတ်ဖြတ်', 'လူသတ်',
            'ဖမ်းဆီး', 'အဓမ္မဖမ်းဆီး', 'လူ့အခွင့်အရေး', 'Political Prisoner','Execution', 'Torture', 'Massacre'
        ];

        foreach ($filteredWords as $word) {
            if (stripos($text, $word) !== false) {
                return true; // Found a banned word
            }
        }

        return false; // No banned words found
    }
}
