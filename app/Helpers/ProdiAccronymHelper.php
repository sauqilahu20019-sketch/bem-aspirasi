<?php
use Illuminate\Support\Str;

if (!function_exists('getProdiAcronym')) {
    function getProdiAcronym($name)
    {
        return match ($name) {
            'Pendidikan Islam Anak Usia Dini'    => 'PIAUD',
            'Ilmu Al-Quran & Tafsir'            => 'IQT',
            'Tasawuf dan Psikoterapi'           => 'TP',
            'Hukum Keluarga Islam'              => 'HKI',
            'Teknik Sipil'                      => 'TS',
            'Pendidikan Agama Islam'            => 'PAI',
            'Ekonomi Syariah'                   => 'ES',
            'Perbankan Syariah'                 => 'PS',
            'Hukum Ekonomi Syariah'             => 'HES',
            'Pendidikan Bahasa Arab'            => 'PBA',
            'Biologi'                           => 'BIO',
            'Matematika'                        => 'MTK',
            'Kimia'                             => 'KIM',
            'Teknologi Informasi'              => 'TI',
            'Teknologi Hasil Pertanian'         => 'THP',
            'Bisnis Digital'                    => 'BIS',
            'Ilmu Komunikasi'                   => 'ILKOM',
            default                             => Str::limit($name, 10),
        };
    }
}
