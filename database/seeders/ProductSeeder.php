<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'id' => '5b03966a1acd4d5bbd672373',
                'name' => 'Americano Nóng',
                'price' => '40000',
                'description' => 'Americano được pha chế bằng cách pha thêm nước với tỷ lệ nhất định vào tách cà phê Espresso, từ đó mang lại hương vị nhẹ nhàng và giữ trọn được mùi hương cà phê đặc trưng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cfsua-bacsiu_nong-(1)_139962_400x400.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-11-11 15:09:29',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd672374',
                'name' => 'Americano Đá',
                'price' => '40000',
                'description' => 'Americano được pha chế bằng cách pha thêm nước với tỷ lệ nhất định vào tách cà phê Espresso, từ đó mang lại hương vị nhẹ nhàng và giữ trọn được mùi hương cà phê đặc trưng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/classic-cold-brew_791256.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd672375',
                'name' => 'Sinh Tố Việt Quất',
                'price' => '59000',
                'description' => 'Mứt Việt Quất chua thanh, ngòn ngọt, phối hợp nhịp nhàng với dòng sữa chua bổ dưỡng. Là món sinh tố thơm ngon mà cả đầu lưỡi và làn da đều thích. \n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/sinh-to-viet-quoc_145138.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '5b03966a1acd4d5bbd672377',
                'name' => 'Cappuccino Nóng',
                'price' => '50000',
                'description' => 'Capuchino là thức uống hòa quyện giữa hương thơm của sữa, vị béo của bọt kem cùng vị đậm đà từ cà phê Espresso. Tất cả tạo nên một hương vị đặc biệt, một chút nhẹ nhàng, trầm lắng và tinh tế.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cappuccino_621532.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd672378',
                'name' => 'Cappuccino Đá',
                'price' => '50000',
                'description' => 'Capuchino là thức uống hòa quyện giữa hương thơm của sữa, vị béo của bọt kem cùng vị đậm đà từ cà phê Espresso. Tất cả tạo nên một hương vị đặc biệt, một chút nhẹ nhàng, trầm lắng và tinh tế.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/Capu-da_487470.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd67237a',
                'name' => 'Caramel Macchiato Nóng',
                'price' => '50000',
                'description' => 'Caramel Macchiato sẽ mang đến một sự ngạc nhiên thú vị khi vị thơm béo của bọt sữa, sữa tươi, vị đắng thanh thoát của cà phê Espresso hảo hạng và vị ngọt đậm của sốt caramel được gói gọn trong một tách cà phê.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/caramelmacchiatonong_168039.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd67237b',
                'name' => 'Caramel Macchiato Đá',
                'price' => '50000',
                'description' => 'Caramel Macchiato sẽ mang đến một sự ngạc nhiên thú vị khi vị thơm béo của bọt sữa, sữa tươi, vị đắng thanh thoát của cà phê Espresso hảo hạng và vị ngọt đậm của sốt caramel được gói gọn trong một tách cà phê.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/caramel-macchiato_143623.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd67237c',
                'name' => 'Chocolate Đá Xay',
                'price' => '59000',
                'description' => 'Sữa và kem tươi béo ngọt được “cá tính hoá” bởi vị chocolate\/sô-cô-la đăng đắng. Dành cho các tín đồ hảo ngọt. Lựa chọn hàng đầu nếu bạn đang cần chút năng lượng tinh thần.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/Chocolate-ice-blended_400940.jpg',
                'created_at' => '2021-10-30 02:54:53',
                'updated_at' => '2021-10-30 02:54:53',
                'category_id' => 2
            ],
            [
                'id' => '5b03966a1acd4d5bbd67237e',
                'name' => 'Cookie Đá Xay',
                'price' => '59000',
                'description' => 'Những mẩu bánh cookies giòn rụm kết hợp ăn ý với sữa tươi, kem tươi béo ngọt và đá xay mát lành, đem đến cảm giác lạ miệng gây thích thú và không thể cưỡng lại. Một món uống phá cách dễ thương đầy mê hoặc.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/Chocolate-ice-blended_183602.jpg',
                'created_at' => '2021-10-30 02:54:16',
                'updated_at' => '2021-10-30 02:54:16',
                'category_id' => 2
            ],
            [
                'id' => '5b03966a1acd4d5bbd67237f',
                'name' => 'Espresso Đá',
                'price' => '45000',
                'description' => 'Một tách Espresso nguyên bản được bắt đầu bởi những hạt Arabica chất lượng, phối trộn với tỉ lệ cân đối hạt Robusta, cho ra vị ngọt caramel, vị chua dịu và sánh đặc.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cfdenda-espressoDa_185438.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd672380',
                'name' => 'Espresso Nóng',
                'price' => '40000',
                'description' => 'Một tách Espresso nguyên bản được bắt đầu bởi những hạt Arabica chất lượng, phối trộn với tỉ lệ cân đối hạt Robusta, cho ra vị ngọt caramel, vị chua dịu và sánh đặc.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/espressoNong_612688.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd672390',
                'name' => 'Latte Nóng',
                'price' => '50000',
                'description' => 'Một sự kết hợp tinh tế giữa vị đắng cà phê Espresso nguyên chất hòa quyện cùng vị sữa nóng ngọt ngào, bên trên là một lớp kem mỏng nhẹ tạo nên một tách cà phê hoàn hảo về hương vị lẫn nhãn quan.\n\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/latte_851143.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd672391',
                'name' => 'Latte Đá',
                'price' => '50000',
                'description' => 'Một sự kết hợp tinh tế giữa vị đắng cà phê Espresso nguyên chất hòa quyện cùng vị sữa nóng ngọt ngào, bên trên là một lớp kem mỏng nhẹ tạo nên một tách cà phê hoàn hảo về hương vị lẫn nhãn quan.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/latte-da_438410.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd672393',
                'name' => 'Matcha Đá Xay',
                'price' => '59000',
                'description' => 'Matcha thanh, nhẫn, và đắng nhẹ được nhân đôi sảng khoái khi uống lạnh. Nhấn nhá thêm những nét bùi béo của kem và sữa. Gây thương nhớ vô cùng!',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/matchadaxay_622077.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '5b03966a1acd4d5bbd672394',
                'name' => 'Trà Matcha Latte Nóng',
                'price' => '59000',
                'description' => 'Với màu xanh mát mắt của bột trà Matcha, vị ngọt nhẹ nhàng, pha trộn cùng sữa tươi và lớp foam mềm mịn, Matcha Latte sẽ khiến bạn yêu ngay từ lần đầu tiên.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/matcha-latte-_936022.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '5b03966a1acd4d5bbd672395',
                'name' => 'Trà Matcha Latte Đá',
                'price' => '59000',
                'description' => 'Với màu xanh mát mắt của bột trà Matcha, vị ngọt nhẹ nhàng, pha trộn cùng sữa tươi và lớp foam mềm mịn, Matcha Latte sẽ khiến bạn yêu ngay từ lần đầu tiên.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/matcha-latte-da_083173.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '5b03966a1acd4d5bbd672397',
                'name' => 'Mocha Nóng',
                'price' => '50000',
                'description' => 'Loại cà phê được tạo nên từ sự kết hợp hoàn hảo của vị đắng đậm đà của Espresso và sốt sô-cô-la ngọt ngào mang tới hương vị đầy lôi cuốn, đánh thức mọi giác quan nên đây chính là thức uống ưa thích của phụ nữ và giới trẻ.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/mochanong_433980.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd672398',
                'name' => 'Mocha Đá',
                'price' => '50000',
                'description' => 'Loại cà phê được tạo nên từ sự kết hợp hoàn hảo của vị đắng đậm đà của Espresso và sốt sô-cô-la ngọt ngào mang tới hương vị đầy lôi cuốn, đánh thức mọi giác quan nên đây chính là thức uống ưa thích của phụ nữ và giới trẻ.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/mocha-da_538820.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd67239c',
                'name' => 'Trà Đào Cam Sả - Đá',
                'price' => '45000',
                'description' => 'Vị thanh ngọt của đào, vị chua dịu của Cam Vàng nguyên vỏ, vị chát của trà đen tươi được ủ mới mỗi 4 tiếng, cùng hương thơm nồng đặc trưng của sả chính là điểm sáng làm nên sức hấp dẫn của thức uống này.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/tra-dao-cam-xa_668678.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '5b03966a1acd4d5bbd67239d',
                'name' => 'Chocolate Đá',
                'price' => '59000',
                'description' => 'Bột chocolate nguyên chất hoà cùng sữa tươi béo ngậy. Vị ngọt tự nhiên, không gắt cổ, để lại một chút đắng nhẹ, cay cay trên đầu lưỡi.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/chocolate-da_877186.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '5b03966a1acd4d5bbd67239e',
                'name' => 'Trà Đen Macchiato',
                'price' => '50000',
                'description' => 'Trà đen được ủ mới mỗi ngày, giữ nguyên được vị chát mạnh mẽ đặc trưng của lá trà, phủ bên trên là lớp Macchiato homemade bồng bềnh quyến rũ vị phô mai mặn mặn mà béo béo.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/tra-den-matchiato_430281.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '5b03966a1acd4d5bbd6723a0',
                'name' => 'Cà Phê Đen Nóng',
                'price' => '35000',
                'description' => 'Không ngọt ngào như Bạc sỉu hay Cà phê sữa, Cà phê đen mang trong mình phong vị trầm lắng, thi vị hơn. Người ta thường phải ngồi rất lâu mới cảm nhận được hết hương thơm ngào ngạt, phảng phất mùi cacao và cái đắng mượt mà trôi tuột xuống vòm họng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/caphedenda-moi_684880_400x400.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-11-11 15:09:29',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd6723a1',
                'name' => 'Cà Phê Đen Đá',
                'price' => '32000',
                'description' => 'Không ngọt ngào như Bạc sỉu hay Cà phê sữa, Cà phê đen mang trong mình phong vị trầm lắng, thi vị hơn. Người ta thường phải ngồi rất lâu mới cảm nhận được hết hương thơm ngào ngạt, phảng phất mùi cacao và cái đắng mượt mà trôi tuột xuống vòm họng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/caphedenda-moi_684880_400x400.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-11-11 15:09:29',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd6723a2',
                'name' => 'Cà Phê Sữa Nóng',
                'price' => '35000',
                'description' => 'Cà phê được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà, hài hòa giữa vị ngọt đầu lưỡi và vị đắng thanh thoát nơi hậu vị.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cfsua-bacsiu_nong-(1)_139962_400x400.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-11-11 15:09:29',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd6723a3',
                'name' => 'Cà Phê Sữa Đá',
                'price' => '32000',
                'description' => 'Cà phê được pha phin truyền thống kết hợp với sữa đặc tạo nên hương vị đậm đà, hài hòa giữa vị ngọt đầu lưỡi và vị đắng thanh thoát nơi hậu vị.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/caphesuada-moi_847396_400x400.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-11-11 15:09:29',
                'category_id' => 1
            ],
            [
                'id' => '5b03966a1acd4d5bbd6723a4',
                'name' => 'Bạc Sỉu',
                'price' => '32000',
                'description' => 'Bạc sỉu chính là Ly sữa trắng kèm một chút cà phê. Thức uống này rất phù hợp những ai vừa muốn trải nghiệm chút vị đắng của cà phê vừa muốn thưởng thức vị ngọt béo ngậy từ sữa.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/bacsiu-moi_532206_400x400.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-11-11 15:09:29',
                'category_id' => 1
            ],
            [
                'id' => '5b4c2f58a9d0590cb37cdade',
                'name' => 'Chocolate Nóng',
                'price' => '59000',
                'description' => 'Bột chocolate nguyên chất hoà cùng sữa tươi béo ngậy. Vị ngọt tự nhiên, không gắt cổ, để lại một chút đắng nhẹ, cay cay trên đầu lưỡi.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/chocolatenong_949029.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '5bfb492bacf0d31fd9646728',
                'name' => 'Trà Đào Cam Sả - Nóng',
                'price' => '52000',
                'description' => 'Vị thanh ngọt của đào, vị chua dịu của Cam Vàng nguyên vỏ, vị chát của trà đen tươi được ủ mới mỗi 4 tiếng, cùng hương thơm nồng đặc trưng của sả chính là điểm sáng làm nên sức hấp dẫn của thức uống này.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/tdcs-nong_288997.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '5c3ff3c5acf0d338d22adbaa',
                'name' => 'Trà Hạt Sen - Nóng',
                'price' => '52000',
                'description' => 'Nền trà oolong hảo hạng kết hợp cùng hạt sen tươi, bùi bùi thơm ngon. Trà hạt sen là thức uống thanh mát, nhẹ nhàng phù hợp cho cả buổi sáng và chiều tối.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/tra-sen-nong_025153.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '5c3ff3c5acf0d338d22adbae',
                'name' => 'Trà Hạt Sen - Đá',
                'price' => '45000',
                'description' => 'Nền trà oolong hảo hạng kết hợp cùng hạt sen tươi, bùi bùi và lớp foam cheese béo ngậy. Trà hạt sen là thức uống thanh mát, nhẹ nhàng phù hợp cho cả buổi sáng và chiều tối.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/tra-sen_905594.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '5ca47f92acf0d3492076b299',
                'name' => 'Cold Brew Sữa Tươi',
                'price' => '45000',
                'description' => 'Thanh mát và cân bằng với hương vị cà phê nguyên bản 100% Arabica Cầu Đất cùng sữa tươi thơm béo cho từng ngụm tròn vị, hấp dẫn.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cold-brew-sua-tuoi_379576.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5ca47f92acf0d3492076b29a',
                'name' => 'Cold Brew Truyền Thống',
                'price' => '45000',
                'description' => ' Tại Kaffee store, Cold Brew được ủ và phục vụ mỗi ngày từ 100% hạt Arabica Cầu Đất với hương gỗ thông, hạt dẻ, nốt sô-cô-la đặc trưng, thoang thoảng hương khói nhẹ giúp Cold Brew giữ nguyên vị tươi mới.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/classic-cold-brew_239501.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5cdb677aacf0d33b682b4b73',
                'name' => 'Chanh Sả Đá Xay',
                'price' => '49000',
                'description' => 'Sự kết hợp hài hoà giữa Chanh & sả - những nguyên liệu mộc mạc rất đỗi quen thuộc cho ra đời một thức uống thanh mát, vị chua chua ngọt ngọt giải nhiệt lại tốt cho sức khỏe.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/Chanh-sa-da-xay_170980.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '5cdbd6e8696fb3792a389754',
                'name' => 'Bạc Sỉu Nóng',
                'price' => '35000',
                'description' => 'Bạc sỉu chính là Ly sữa trắng kèm một chút cà phê. Thức uống này rất phù hợp những ai vừa muốn trải nghiệm chút vị đắng của cà phê vừa muốn thưởng thức vị ngọt béo ngậy từ sữa.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cfsua-bacsiu_nong-(1)_190838_400x400.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-11-11 15:09:29',
                'category_id' => 1
            ],
            [
                'id' => '5d2bdfa5acf0d30ba264432b',
                'name' => 'Đào Việt Quất Đá Xay',
                'price' => '59000',
                'description' => 'Vị đào quen thuộc, được khoác lên mình dáng vẻ thanh mát hơn khi kết hợp với mứt berry và lớp kem ngọt béo ngậy, cho hương vị kích thích vị giác đầy lôi cuốn và khoan khoái ngay từ ngụm đầu tiên.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/DaoVietQuat_033985.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '5d43be2e41d3ac39a44bd7a2',
                'name' => 'Trà Phúc Bồn Tử',
                'price' => '50000',
                'description' => 'Quả Phúc Bồn Tử hoàn toàn tự nhiên, được các barista Nhà kết hợp một cách đầy tinh tế cùng trà Oolong và cam vàng tạo ra một dư vị hoàn toàn tươi mới. Mát lạnh ngay từ ngụm đầu tiên, đọng lại cuối cùng là hương vị trà thơm lừng và vị ngọt thanh, chua dịu khó quên của trái phúc bồn tử.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/tra-pbt_728279.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '5d43bf5d073b26002948a362',
                'name' => 'Phúc Bồn Tử Cam Đá Xay',
                'price' => '59000',
                'description' => 'Tê tái ngay đầu lưỡi bởi sự mát lạnh của đá xay. Hòa quyện thêm hương vị chua chua, ngọt ngọt từ cam tươi và phúc bồn tử 100% tự nhiên, cho ra một hương vị thanh mát, kích thích vị giác đầy thú vị ngay từ lần đầu thưởng thức. \n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cam-pbt-da-xay_326000.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '5d43bfed073b26003161b693',
                'name' => 'Cold Brew Phúc Bồn Tử',
                'price' => '50000',
                'description' => 'Vị chua ngọt của trái phúc bồn tử, làm dậy lên hương vị trái cây tự nhiên vốn sẵn có trong hạt cà phê, hòa quyện thêm vị đăng đắng, ngọt dịu nhẹ nhàng của Cold Brew 100% hạt Arabica Cầu Đất để mang đến một cách thưởng thức cà phê hoàn toàn mới, vừa thơm lừng hương cà phê quen thuộc, vừa nhẹ nhàng và thanh mát bởi hương trái cây đầy thú vị.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cold-brew-pbt_130351.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5e4f9e4316bd0a0018d2e24e',
                'name' => 'Cà Phê Đá Xay-Lạnh',
                'price' => '59000',
                'description' => 'Một phiên bản upgrade từ ly cà phê sữa quen thuộc, nhưng lại tỉnh táo và tươi mát hơn bởi lớp đá xay đi kèm. Nhấp 1 ngụm cà phê đá xay là thấy đã, ngụm thứ hai thêm tỉnh táo và cứ thế lôi cuốn bạn đến ngụm cuối cùng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cf-da-xay-(1)_158038.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ],
            [
                'id' => '5e92fd7dc788bc0011abaa06',
                'name' => 'Trà Sữa Mắc Ca Trân Châu',
                'price' => '50000',
                'description' => 'Mỗi ngày với Kaffee store sẽ là điều tươi mới hơn với sữa hạt mắc ca thơm ngon, bổ dưỡng quyện cùng nền trà oolong cho vị cân bằng, ngọt dịu đi kèm cùng Trân châu trắng giòn dai mang lại cảm giác “đã” trong từng ngụm trà sữa.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/tra-sua-mac-ca_377522.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '5eb92ae0ee4dc00012633b2b',
                'name' => 'Ly inox ống hút đen nhám',
                'price' => '280000',
                'description' => 'Màu đen ngày nào cũng được khen- Chiếc ly inbox kèm ống hút mang sắc đen ngầu này sẽ là người bạn đồng hành may mắn mỗi ngày bên bạn, nước ngon hơn, nhiều cảm hứng hơn. \n        Dung tích: 500 ml\n        Chất liệu: Inox, nhựa',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/5eb92ae0ee4dc00012633b2b_Binh-inox-ong-hut-den-nham_338437.jpg',
                'created_at' => '2021-10-30 02:35:48',
                'updated_at' => '2021-10-30 02:35:48',
                'category_id' => 20
            ],
            [
                'id' => '5eb92ae1ee4dc00012633b2c',
                'name' => 'Ly Inox Ống Hút Xanh Biển',
                'price' => '280000',
                'description' => 'Màu xanh chốt gì cũng nhanh - Chiếc ly inbox kèm ống hút mang sắc xanh này sẽ là người bạn đồng hành may mắn mỗi ngày bên bạn, nước ngon hơn, nhiều cảm hứng hơn. \n        Dung tích: 500 ml\n        Chất liệu: Inox, nhựa',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/5eb92ae1ee4dc00012633b2c_Binh-inox-ong-hut-xanh-bien_233565.jpg',
                'created_at' => '2021-10-30 02:35:48',
                'updated_at' => '2021-10-30 02:35:48',
                'category_id' => 20
            ],
            [
                'id' => '5eb92ae1ee4dc00012633b2d',
                'name' => 'Ly Inox Ống Hút Hồng Xanh',
                'price' => '280000',
                'description' => 'Màu hồng xanh may mắn tới nhanh - Chiếc ly inbox kèm ống hút mang sắc xanh này sẽ là người bạn đồng hành may mắn mỗi ngày bên bạn, nước ngon hơn, nhiều cảm hứng hơn. \n        Dung tích: 500 ml \n        Chất liệu: Inox, nhựa',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/5eb92ae1ee4dc00012633b2d_Binh-inox-ong-hut-xanh-hong_584047.jpg',
                'created_at' => '2021-10-30 02:35:48',
                'updated_at' => '2021-10-30 02:35:48',
                'category_id' => 20
            ],
            [
                'id' => '5ee30512e852ce0011e71b07',
                'name' => 'Bình giữ nhiệt Inox Quả Dứa',
                'price' => '300000',
                'description' => 'Xách bình đi khắp thế gian, với thiết kế xịn sò, màu sắc nổi bật, người bạn mới này sẽ nhắc bạn uống nước mỗi ngày ngon hơn, đều đặn hơn nha. \n        Dung tích: 500ml \n        Chất liệu: Inox ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/thum-dua_661718.jpg',
                'created_at' => '2021-10-30 02:35:48',
                'updated_at' => '2021-10-30 02:35:48',
                'category_id' => 20
            ],
            [
                'id' => '5ee30512e852ce0011e71b08',
                'name' => 'Bình giữ nhiệt Inox Con Thuyền',
                'price' => '300000',
                'description' => 'Xách bình đi khắp thế gian, với thiết kế xịn sò, màu sắc nổi bật, người bạn mới này sẽ nhắc bạn uống nước mỗi ngày ngon hơn, đều đặn hơn nha. \n        Dung tích: 500ml \n        Chất liệu: Inox',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/con-thuyen_238139.jpg',
                'created_at' => '2021-10-30 02:35:48',
                'updated_at' => '2021-10-30 02:35:48',
                'category_id' => 20
            ],
            [
                'id' => '5ef00e2b91ab1a0012840421',
                'name' => 'Ly Farm to Cup (Cao)',
                'price' => '150000',
                'description' => 'Lấy cảm hứng từ vùng đất cà phê Việt Nam, ly sứ Farm To Cup sẽ cho bạn trải nghiệm đầy cảm hứng với món yêu thích  tại nhà, tại nơi làm việc mỗi ngày. \n        Dung tích ly: 400ml \n        Thành phần: Cao lanh, đất sét, tráng thạch, men màu.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/5ef00e2b91ab1a0012840421_Ly-Farm-to-cup-cao_858647.jpg',
                'created_at' => '2021-10-30 02:35:48',
                'updated_at' => '2021-10-30 02:35:48',
                'category_id' => 20
            ],
            [
                'id' => '5ef00e2b91ab1a0012840422',
                'name' => 'Ly Farm to Cup (Thấp)',
                'price' => '120000',
                'description' => 'Lấy cảm hứng từ vùng đất cà phê Việt Nam, ly sứ Farm To Cup sẽ cho bạn trải nghiệm đầy cảm hứng với món yêu thích  tại nhà, tại nơi làm việc mỗi ngày. \n        Dung tích ly: 300ml \n        Thành phần: Cao lanh, đất sét, tráng thạch, men màu. ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/5ef00e2b91ab1a0012840422_Ly-Farm-to-cup-thap_258417.jpg',
                'created_at' => '2021-10-30 02:35:48',
                'updated_at' => '2021-10-30 02:35:48',
                'category_id' => 20
            ],
            [
                'id' => '5ffbb2671327f700184f54d4',
                'name' => 'Yogurt Dưa Lưới phát tài',
                'price' => '59000',
                'description' => 'Vị yogurt chua ngọt, mát lạnh tái tê, thêm topping dưa lưới vàng tươi, thơm lừng, vui miệng. Thật khó để không yêu ngay từ ngụm đầu tiên.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/tra-dua-luoi_114296.jpg',
                'created_at' => '2021-10-30 02:56:12',
                'updated_at' => '2021-10-30 02:56:12',
                'category_id' => 2
            ],
            [
                'id' => '6014df0e540c0c001894d83c',
                'name' => 'Hồng Trà Sữa Trân Châu',
                'price' => '55000',
                'description' => 'Thêm chút ngọt ngào cho ngày mới với hồng trà nguyên lá, sữa thơm ngậy được cân chỉnh với tỉ lệ hoàn hảo, cùng trân châu trắng dai giòn có sẵn để bạn tận hưởng từng ngụm trà sữa ngọt ngào thơm ngậy thiệt đã.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/hong-tra-sua-tran-chau_326977.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '6014df0e540c0c001894d83d',
                'name' => 'Hồng Trà Sữa Nóng',
                'price' => '50000',
                'description' => 'Từng ngụm trà chuẩn gu ấm áp, đậm đà beo béo bởi lớp sữa tươi chân ái hoà quyện.\n\n        Trà đen nguyên lá âm ấm dịu nhẹ, quyện cùng lớp sữa thơm béo khó lẫn - hương vị ấm áp chuẩn gu trà, cho từng ngụm nhẹ nhàng, ngọt dịu lưu luyến mãi nơi cuống họng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/hong-tra-sua-nong_941687.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '605da09f717e5d00114a3cdc',
                'name' => 'Hồng Trà Latte Macchiato',
                'price' => '55000',
                'description' => 'Sự kết hợp hoàn hảo bởi hồng trà dịu nhẹ và sữa tươi, nhấn nhá thêm lớp macchiato trứ danh của Kaffee store mang đến cho bạn hương vị trà sữa đúng gu tinh tế và healthy.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/hong-tra-latte_618293.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '60c62c8215234d0011ede49e',
                'name' => 'Cà Phê Sữa Đá Hòa Tan',
                'price' => '44000',
                'description' => 'Thật dễ dàng để bắt đầu ngày mới với tách cà phê sữa đá sóng sánh, thơm ngon như cà phê pha phin.\n        Vị đắng thanh của cà phê hoà quyện với vị ngọt béo của sữa, giúp bạn luôn tỉnh táo và hứng khởi cho ngày làm việc thật hiệu quả.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/cpsd-3in1_971575.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 18
            ],
            [
                'id' => '60c62c8215234d0011ede49f',
                'name' => 'Cà Phê Peak Flavor Hương Thơm Đỉnh Cao (350G)',
                'price' => '90000',
                'description' => 'Được rang dưới nhiệt độ vàng, Cà phê Peak Flavor - Hương thơm đỉnh cao lưu giữ trọn vẹn hương thơm tinh tế đặc trưng của cà phê Robusta Đăk Nông và Arabica Cầu Đất. Với sự hòa trộn nhiều cung bậc giữa hương và vị sẽ mang đến cho bạn một ngày mới tràn đầy cảm hứng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/peak-plavor-nopromo_715372.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 18
            ],
            [
                'id' => '60c62c8215234d0011ede4a0',
                'name' => 'Cà Phê Rich Finish Gu Đậm Tinh Tế (350G)',
                'price' => '90000',
                'description' => 'Kaffee store  hiểu rằng ly cà phê ngon phải đậm đà, rõ vị từ cái chạm đầu tiên đến hậu vị vương vấn. Cà phê Rich Finish mang đến những ly cà phê đậm, thơm, hương vị tinh tế giúp bạn bắt đầu ngày mới đầy năng lượng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/rich-finish-nopromo_485968.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 18
            ],
            [
                'id' => '60c62c8215234d0011ede4a1',
                'name' => 'Trà sữa Oolong Nướng (Nóng)',
                'price' => '50000',
                'description' => 'Đậm đà chuẩn gu và ấm nóng - bởi lớp trà oolong nướng đậm vị hoà cùng lớp sữa thơm béo. Hương vị chân ái đúng gu đậm đà - trà oolong được sao (nướng) lâu hơn cho vị đậm đà, hoà quyện với sữa thơm ngậy. Cho từng ngụm ấm áp, lưu luyến vị trà sữa đậm đà mãi nơi cuống họng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/oolong-nuong-nong_948581.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '60c62c8215234d0011ede4a2',
                'name' => 'Trà sữa Oolong Nướng Trân Châu',
                'price' => '55000',
                'description' => 'Hương vị chân ái đúng gu đậm đà với trà oolong được “sao” (nướng) lâu hơn cho hương vị đậm đà, hòa quyện với sữa thơm béo mang đến cảm giác mát lạnh, lưu luyến vị trà sữa đậm đà nơi vòm họng.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/olong-nuong-tran-chau_017573.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '60dbe43f5775f50018c71ea8',
                'name' => 'Thùng 24 Lon Cà Phê Sữa Đá ',
                'price' => '336000',
                'description' => 'Với thiết kế lon cao trẻ trung, hiện đại và tiện lợi, Cà phê sữa đá lon thơm ngon đậm vị của Kaffee store sẽ đồng hành cùng nhịp sống sôi nổi của tuổi trẻ và giúp bạn có được một ngày làm việc đầy hứng khởi.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/24-lon-cpsd_225680.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 18
            ],
            [
                'id' => '61224f81ef16be001293cccd',
                'name' => 'Combo 3 Hộp Cà Phê Sữa Đá Hòa Tan',
                'price' => '119000',
                'description' => 'Thật dễ dàng để bắt đầu ngày mới với tách cà phê sữa đá sóng sánh, thơm ngon như cà phê pha phin. Vị đắng thanh của cà phê hoà quyện với vị ngọt béo của sữa, giúp bạn luôn tỉnh táo và hứng khởi cho ngày làm việc thật hiệu quả.\n        ',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/combo-3cfsd-nopromo_320619.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 18
            ],
            [
                'id' => '61534bde26ae260012abe218',
                'name' => 'Trà Đào Cam Sả Chai Fresh 500ML',
                'price' => '109000',
                'description' => 'Với phiên bản chai fresh 500ml, thức uống best seller đỉnh cao mang một diện mạo tươi mới, tiện lợi, phù hợp với bình thường mới và vẫn giữ nguyên vị thanh ngọt của đào, vị chua dịu của cam vàng nguyên vỏ và vị trà đen thơm lừng ly Trà đào cam sả nguyên bản.\n        *Sản phẩm dùng ngon nhất trong ngày.\n        *Sản phẩm mặc định mức đường và không đá.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/Bottle_TraDao_836487.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 5
            ],
            [
                'id' => '61534bde26ae260012abe219',
                'name' => 'Cà Phê Sữa Đá Chai Fresh 250ML',
                'price' => '79000',
                'description' => 'Vẫn là hương vị cà phê sữa đậm đà quen thuộc của Kaffee store nhưng khoác lên mình một chiếc áo mới tiện lợi hơn, tiết kiệm hơn phù hợp với bình thường mới, giúp bạn tận hưởng một ngày dài trọn vẹn.\n        *Sản phẩm dùng ngon nhất trong ngày.\n        *Sản phẩm mặc định mức đường và không đá.',
                'image_url' => 'https:\/\/minio.thecoffeehouse.com\/image\/admin\/BottleCFSD_496652.jpg',
                'created_at' => '2021-10-30 02:31:49',
                'updated_at' => '2021-10-30 02:31:49',
                'category_id' => 1
            ]
        ];

        DB::table('products')->insert($products);
    }
}
