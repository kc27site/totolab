<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $j1 = [
            '北海道コンサドーレ札幌',
            '鹿島アントラーズ',
            '浦和レッズ',
            '柏レイソル',
            'ＦＣ東京',
            '東京ヴェルディ',
            'ＦＣ町田ゼルビア',
            '川崎フロンターレ',
            '横浜Ｆ・マリノス',
            '湘南ベルマーレ',
            'アルビレックス新潟',
            'ジュビロ磐田',
            '名古屋グランパス',
            '京都サンガF.C.',
            'ガンバ大阪',
            'セレッソ大阪',
            'ヴィッセル神戸',
            'サンフレッチェ広島',
            'アビスパ福岡',
            'サガン鳥栖',
        ];
        foreach ($j1 as $name) {
            DB::table('teams')->insert([
                'category' => 1,
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $j2 = [
            'ベガルタ仙台',
            'ブラウブリッツ秋田',
            'モンテディオ山形',
            'いわきＦＣ',
            '水戸ホーリーホック',
            '栃木ＳＣ',
            'ザスパ群馬',
            'ジェフユナイテッド千葉',
            '横浜ＦＣ',
            'ヴァンフォーレ甲府',
            '清水エスパルス',
            '藤枝ＭＹＦＣ',
            'ファジアーノ岡山',
            'レノファ山口ＦＣ',
            '徳島ヴォルティス',
            '愛媛ＦＣ',
            'Ｖ・ファーレン長崎',
            'ロアッソ熊本',
            '大分トリニータ',
            '鹿児島ユナイテッドＦＣ',
        ];
        foreach ($j2 as $name2) {
            DB::table('teams')->insert([
                'category' => 2,
                'name' => $name2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $j3 = [
            'ヴァンラーレ八戸',
            'いわてグルージャ盛岡',
            '福島ユナイテッドＦＣ',
            '大宮アルディージャ',
            'Ｙ．Ｓ．Ｃ．Ｃ．横浜',
            'ＳＣ相模原',
            '松本山雅ＦＣ',
            'ＡＣ長野パルセイロ',
            'カターレ富山',
            'ツエーゲン金沢',
            'アスルクラロ沼津',
            'ＦＣ岐阜',
            'ＦＣ大阪',
            '奈良クラブ',
            'ガイナーレ鳥取',
            'カマタマーレ讃岐',
            'ＦＣ今治',
            'ギラヴァンツ北九州',
            'テゲバジャーロ宮崎',
            'ＦＣ琉球',
        ];
        foreach ($j3 as $name3) {
            DB::table('teams')->insert([
                'category' => 3,
                'name' => $name3,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
