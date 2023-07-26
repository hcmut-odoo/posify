<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRoleGroups = [
            [
                'id' => 1,
                'user_group_id' => 1,
                'action_id' => 1
            ],
            [
                'id' => 2,
                'user_group_id' => 1,
                'action_id' => 2
            ],
            [
                'id' => 3,
                'user_group_id' => 1,
                'action_id' => 3
            ],
            [
                'id' => 4,
                'user_group_id' => 1,
                'action_id' => 4
            ],
            [
                'id' => 5,
                'user_group_id' => 1,
                'action_id' => 5
            ],
            [
                'id' => 6,
                'user_group_id' => 1,
                'action_id' => 6
            ],
            [
                'id' => 7,
                'user_group_id' => 1,
                'action_id' => 7
            ],
            [
                'id' => 8,
                'user_group_id' => 1,
                'action_id' => 8
            ],
            [
                'id' => 9,
                'user_group_id' => 1,
                'action_id' => 9
            ],
            [
                'id' => 10,
                'user_group_id' => 1,
                'action_id' => 10
            ],
            [
                'id' => 11,
                'user_group_id' => 1,
                'action_id' => 11
            ],
            [
                'id' => 12,
                'user_group_id' => 1,
                'action_id' => 12
            ],
            [
                'id' => 13,
                'user_group_id' => 1,
                'action_id' => 13
            ],
            [
                'id' => 14,
                'user_group_id' => 1,
                'action_id' => 14
            ],
            [
                'id' => 15,
                'user_group_id' => 1,
                'action_id' => 15
            ],
            [
                'id' => 16,
                'user_group_id' => 1,
                'action_id' => 16
            ],
            [
                'id' => 17,
                'user_group_id' => 1,
                'action_id' => 17
            ],
            [
                'id' => 18,
                'user_group_id' => 1,
                'action_id' => 18
            ],
            [
                'id' => 19,
                'user_group_id' => 1,
                'action_id' => 19
            ],
            [
                'id' => 20,
                'user_group_id' => 1,
                'action_id' => 20
            ],
            [
                'id' => 21,
                'user_group_id' => 1,
                'action_id' => 21
            ],
            [
                'id' => 22,
                'user_group_id' => 1,
                'action_id' => 22
            ],
            [
                'id' => 23,
                'user_group_id' => 1,
                'action_id' => 23
            ],
            [
                'id' => 24,
                'user_group_id' => 1,
                'action_id' => 24
            ],
            [
                'id' => 25,
                'user_group_id' => 1,
                'action_id' => 25
            ],
            [
                'id' => 26,
                'user_group_id' => 1,
                'action_id' => 26
            ],
            [
                'id' => 27,
                'user_group_id' => 1,
                'action_id' => 27
            ],
            [
                'id' => 28,
                'user_group_id' => 1,
                'action_id' => 28
            ],
            [
                'id' => 29,
                'user_group_id' => 1,
                'action_id' => 29
            ],
            [
                'id' => 30,
                'user_group_id' => 1,
                'action_id' => 30
            ],
            [
                'id' => 31,
                'user_group_id' => 1,
                'action_id' => 31
            ],
            [
                'id' => 32,
                'user_group_id' => 1,
                'action_id' => 32
            ],
            [
                'id' => 33,
                'user_group_id' => 1,
                'action_id' => 33
            ],
            [
                'id' => 34,
                'user_group_id' => 1,
                'action_id' => 34
            ],
            [
                'id' => 35,
                'user_group_id' => 1,
                'action_id' => 35
            ],
            [
                'id' => 36,
                'user_group_id' => 1,
                'action_id' => 36
            ],
            [
                'id' => 37,
                'user_group_id' => 1,
                'action_id' => 37
            ],
            [
                'id' => 38,
                'user_group_id' => 1,
                'action_id' => 38
            ],
            [
                'id' => 39,
                'user_group_id' => 1,
                'action_id' => 39
            ],
            [
                'id' => 40,
                'user_group_id' => 1,
                'action_id' => 40
            ],
            [
                'id' => 41,
                'user_group_id' => 1,
                'action_id' => 41
            ],
            [
                'id' => 42,
                'user_group_id' => 1,
                'action_id' => 42
            ],
            [
                'id' => 43,
                'user_group_id' => 1,
                'action_id' => 43
            ],
            [
                'id' => 44,
                'user_group_id' => 1,
                'action_id' => 44
            ],
            [
                'id' => 45,
                'user_group_id' => 1,
                'action_id' => 45
            ],
            [
                'id' => 46,
                'user_group_id' => 1,
                'action_id' => 46
            ],
            [
                'id' => 47,
                'user_group_id' => 1,
                'action_id' => 47
            ],
            [
                'id' => 48,
                'user_group_id' => 1,
                'action_id' => 48
            ],
            [
                'id' => 49,
                'user_group_id' => 1,
                'action_id' => 49
            ],
            [
                'id' => 50,
                'user_group_id' => 1,
                'action_id' => 50
            ],
            [
                'id' => 51,
                'user_group_id' => 1,
                'action_id' => 51
            ],
            [
                'id' => 52,
                'user_group_id' => 1,
                'action_id' => 52
            ],
            [
                'id' => 53,
                'user_group_id' => 1,
                'action_id' => 53
            ],
            [
                'id' => 54,
                'user_group_id' => 1,
                'action_id' => 54
            ],
            [
                'id' => 55,
                'user_group_id' => 1,
                'action_id' => 55
            ],
            [
                'id' => 56,
                'user_group_id' => 1,
                'action_id' => 56
            ],
            [
                'id' => 57,
                'user_group_id' => 1,
                'action_id' => 57
            ],
            [
                'id' => 58,
                'user_group_id' => 1,
                'action_id' => 58
            ],
            [
                'id' => 59,
                'user_group_id' => 1,
                'action_id' => 59
            ],
            [
                'id' => 60,
                'user_group_id' => 1,
                'action_id' => 60
            ],
            [
                'id' => 61,
                'user_group_id' => 1,
                'action_id' => 61
            ],
            [
                'id' => 62,
                'user_group_id' => 1,
                'action_id' => 62
            ],
            [
                'id' => 63,
                'user_group_id' => 1,
                'action_id' => 63
            ],
            [
                'id' => 64,
                'user_group_id' => 1,
                'action_id' => 64
            ],
            [
                'id' => 65,
                'user_group_id' => 1,
                'action_id' => 65
            ],
            [
                'id' => 66,
                'user_group_id' => 1,
                'action_id' => 66
            ],
            [
                'id' => 67,
                'user_group_id' => 1,
                'action_id' => 67
            ],
            [
                'id' => 68,
                'user_group_id' => 1,
                'action_id' => 68
            ],
            [
                'id' => 69,
                'user_group_id' => 1,
                'action_id' => 69
            ],
            [
                'id' => 70,
                'user_group_id' => 1,
                'action_id' => 70
            ],
            [
                'id' => 71,
                'user_group_id' => 1,
                'action_id' => 71
            ],
            [
                'id' => 72,
                'user_group_id' => 1,
                'action_id' => 72
            ],
            [
                'id' => 73,
                'user_group_id' => 1,
                'action_id' => 73
            ],
            [
                'id' => 74,
                'user_group_id' => 1,
                'action_id' => 74
            ],
            [
                'id' => 75,
                'user_group_id' => 1,
                'action_id' => 75
            ],
            [
                'id' => 76,
                'user_group_id' => 1,
                'action_id' => 76
            ],
            [
                'id' => 77,
                'user_group_id' => 1,
                'action_id' => 77
            ],
            [
                'id' => 78,
                'user_group_id' => 1,
                'action_id' => 78
            ],
            [
                'id' => 79,
                'user_group_id' => 1,
                'action_id' => 79
            ],
            [
                'id' => 80,
                'user_group_id' => 1,
                'action_id' => 80
            ],
            [
                'id' => 81,
                'user_group_id' => 1,
                'action_id' => 81
            ],
            [
                'id' => 82,
                'user_group_id' => 1,
                'action_id' => 82
            ],
            [
                'id' => 83,
                'user_group_id' => 1,
                'action_id' => 83
            ],
            [
                'id' => 84,
                'user_group_id' => 1,
                'action_id' => 84
            ],
            [
                'id' => 85,
                'user_group_id' => 1,
                'action_id' => 85
            ]
        ];

        $staffRoleGroups = [
            [
                'id' => 87,
                'user_group_id' => 2,
                'action_id' => 1
            ],
            [
                'id' => 88,
                'user_group_id' => 2,
                'action_id' => 2
            ],
            [
                'id' => 89,
                'user_group_id' => 2,
                'action_id' => 3
            ],
            [
                'id' => 90,
                'user_group_id' => 2,
                'action_id' => 4
            ],
            [
                'id' => 91,
                'user_group_id' => 2,
                'action_id' => 5
            ],
            [
                'id' => 92,
                'user_group_id' => 2,
                'action_id' => 6
            ],
            [
                'id' => 93,
                'user_group_id' => 2,
                'action_id' => 7
            ],
            [
                'id' => 94,
                'user_group_id' => 2,
                'action_id' => 8
            ],
            [
                'id' => 95,
                'user_group_id' => 2,
                'action_id' => 9
            ],
            [
                'id' => 96,
                'user_group_id' => 2,
                'action_id' => 10
            ],
            [
                'id' => 97,
                'user_group_id' => 2,
                'action_id' => 11
            ],
            [
                'id' => 98,
                'user_group_id' => 2,
                'action_id' => 12
            ],
            [
                'id' => 99,
                'user_group_id' => 2,
                'action_id' => 13
            ],
            [
                'id' => 100,
                'user_group_id' => 2,
                'action_id' => 14
            ],
            [
                'id' => 101,
                'user_group_id' => 2,
                'action_id' => 15
            ],
            [
                'id' => 102,
                'user_group_id' => 2,
                'action_id' => 16
            ],
            [
                'id' => 103,
                'user_group_id' => 2,
                'action_id' => 17
            ],
            [
                'id' => 104,
                'user_group_id' => 2,
                'action_id' => 18
            ],
            [
                'id' => 105,
                'user_group_id' => 2,
                'action_id' => 19
            ],
            [
                'id' => 106,
                'user_group_id' => 2,
                'action_id' => 20
            ],
            [
                'id' => 107,
                'user_group_id' => 2,
                'action_id' => 21
            ],
            [
                'id' => 108,
                'user_group_id' => 2,
                'action_id' => 22
            ],
            [
                'id' => 109,
                'user_group_id' => 2,
                'action_id' => 23
            ],
            [
                'id' => 110,
                'user_group_id' => 2,
                'action_id' => 24
            ],
            [
                'id' => 111,
                'user_group_id' => 2,
                'action_id' => 25
            ],
            [
                'id' => 112,
                'user_group_id' => 2,
                'action_id' => 26
            ],
            [
                'id' => 113,
                'user_group_id' => 2,
                'action_id' => 27
            ],
            [
                'id' => 114,
                'user_group_id' => 2,
                'action_id' => 28
            ],
            [
                'id' => 115,
                'user_group_id' => 2,
                'action_id' => 29
            ],
            [
                'id' => 116,
                'user_group_id' => 2,
                'action_id' => 30
            ],
            [
                'id' => 117,
                'user_group_id' => 2,
                'action_id' => 31
            ],
            [
                'id' => 118,
                'user_group_id' => 2,
                'action_id' => 32
            ],
            [
                'id' => 119,
                'user_group_id' => 2,
                'action_id' => 33
            ],
            [
                'id' => 120,
                'user_group_id' => 2,
                'action_id' => 34
            ],
            [
                'id' => 121,
                'user_group_id' => 2,
                'action_id' => 35
            ],
            [
                'id' => 122,
                'user_group_id' => 2,
                'action_id' => 36
            ],
            [
                'id' => 123,
                'user_group_id' => 2,
                'action_id' => 37
            ],
            [
                'id' => 124,
                'user_group_id' => 2,
                'action_id' => 38
            ],
            [
                'id' => 125,
                'user_group_id' => 2,
                'action_id' => 39
            ],
            [
                'id' => 126,
                'user_group_id' => 2,
                'action_id' => 40
            ],
            [
                'id' => 127,
                'user_group_id' => 2,
                'action_id' => 41
            ],
            [
                'id' => 128,
                'user_group_id' => 2,
                'action_id' => 42
            ],
            [
                'id' => 129,
                'user_group_id' => 2,
                'action_id' => 43
            ],
            [
                'id' => 130,
                'user_group_id' => 2,
                'action_id' => 44
            ],
            [
                'id' => 131,
                'user_group_id' => 2,
                'action_id' => 45
            ],
            [
                'id' => 132,
                'user_group_id' => 2,
                'action_id' => 46
            ],
            [
                'id' => 133,
                'user_group_id' => 2,
                'action_id' => 47
            ],
            [
                'id' => 134,
                'user_group_id' => 2,
                'action_id' => 48
            ],
            [
                'id' => 135,
                'user_group_id' => 2,
                'action_id' => 49
            ],
            [
                'id' => 136,
                'user_group_id' => 2,
                'action_id' => 50
            ],
            [
                'id' => 137,
                'user_group_id' => 2,
                'action_id' => 51
            ],
            [
                'id' => 138,
                'user_group_id' => 2,
                'action_id' => 52
            ],
            [
                'id' => 139,
                'user_group_id' => 2,
                'action_id' => 53
            ],
            [
                'id' => 140,
                'user_group_id' => 2,
                'action_id' => 54
            ],
            [
                'id' => 141,
                'user_group_id' => 2,
                'action_id' => 55
            ],
            [
                'id' => 142,
                'user_group_id' => 2,
                'action_id' => 56
            ],
            [
                'id' => 143,
                'user_group_id' => 2,
                'action_id' => 57
            ],
            [
                'id' => 144,
                'user_group_id' => 2,
                'action_id' => 58
            ],
            [
                'id' => 145,
                'user_group_id' => 2,
                'action_id' => 59
            ],
            [
                'id' => 146,
                'user_group_id' => 2,
                'action_id' => 60
            ]
        ];

        DB::table('role_groups')->insert($adminRoleGroups);
        DB::table('role_groups')->insert($staffRoleGroups);
    }
}
