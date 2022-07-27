<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductMeta;
use App\Models\Service;
use App\Models\ServiceMeta;
use App\Models\UserMeta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(100)->create();
        \App\Models\Taxonomy::factory(10)->create();
        \App\Models\Post::factory(10)->create();
        \App\Models\Term::factory(10)->create();
        // \App\Models\Product::factory(10)->create();


        $this->userDefault();
        $this->taxonomyDefault();
        $this->productDefault();
        $this->serviceDefault();
    }

    /**
     * Create User Defaul
     * \App\Models\User::factory(10)->create();
     */

    public function userDefault()
    {
        \App\Models\User::insert([
            [
                'name' => "Admin",
                'short_name' => 'admin',
                'phone' => "0942389598",
                'email' => "admin@hachinet.com",
                'roles' => "admin",
                'email_verified_at' => now(),
                'status' => 'active',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'created_at' => now()
            ],
            [
                'name' => "Công ty A",
                'short_name' => 'Công ty A',
                'phone' => "0942389599",
                'email' => "company_a@hachinet.com",
                'roles' => "company",
                'email_verified_at' => now(),
                'status' => 'active',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'created_at' => now()
            ],
            [
                'name' => "Công ty B",
                'short_name' => 'Công ty B',
                'phone' => "0942389333",
                'email' => "company_b@hachinet.com",
                'name' => "Công ty B",
                'phone' => "0942389511",
                'roles' => "company",
                'email_verified_at' => now(),
                'status' => 'active',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'created_at' => now()
            ],
            [
                'name' => "Công ty C",
                'short_name' => 'Công ty C',
                'phone' => "0942325333",
                'email' => "company_c@hachinet.com",
                'roles' => "company",
                'email_verified_at' => now(),
                'status' => 'active',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'created_at' => now()
            ],
            [
                'name' => "Công ty D",
                'short_name' => 'Công ty D',
                'phone' => "0523611885",
                'email' => "company_d@hachinet.com",
                'roles' => "company",
                'email_verified_at' => now(),
                'status' => 'active',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'created_at' => now()
            ],
            [
                'name' => "Công ty E",
                'short_name' => 'Công ty E',
                'phone' => "0523990885",
                'email' => "company_e@hachinet.com",
                'roles' => "company",
                'email_verified_at' => now(),
                'status' => 'active',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'created_at' => now()
            ],
            [
                'name' => "Công ty F",
                'short_name' => 'Công ty F',
                'phone' => "0523020885",
                'email' => "company_f@hachinet.com",
                'roles' => "company",
                'email_verified_at' => now(),
                'status' => 'active',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'created_at' => now()
            ],
            [
                'name' => "Công ty G",
                'short_name' => 'Công ty G',
                'phone' => "0983611885",
                'email' => "company_G@hachinet.com",
                'roles' => "company",
                'email_verified_at' => now(),
                'status' => 'active',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'created_at' => now()
            ],
            [
                'name' => "Công ty H",
                'short_name' => 'Công ty H',
                'phone' => "0876611885",
                'email' => "company_h@hachinet.com",
                'roles' => "company",
                'email_verified_at' => now(),
                'status' => 'active',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'created_at' => now()
            ],

        ]);

        UserMeta::insert([
            [
                'meta_key' => '_address',
                'meta_value' => 'Hà Nội',
                'user_id' => 1,
            ],
            [
                'meta_key' => '_address',
                'meta_value' => 'Phạm Văn Đồng',
                'user_id' => 2,
            ],
            [
                'meta_key' => '_address',
                'meta_value' => 'Đông Anh',
                'user_id' => 3,
            ],
            [
                'meta_key' => '_address',
                'meta_value' => 'Hà Nội',
                'user_id' => 4,
            ],
            [
                'meta_key' => '_address',
                'meta_value' => 'Hà Nội',
                'user_id' => 5,
            ],
            [
                'meta_key' => '_address',
                'meta_value' => 'Hà Nội',
                'user_id' => 6,
            ],
            [
                'meta_key' => '_address',
                'meta_value' => 'Hà Nội',
                'user_id' => 7,
            ],
            [
                'meta_key' => '_address',
                'meta_value' => 'Hà Nội',
                'user_id' => 8,
            ],
            [
                'meta_key' => '_address',
                'meta_value' => 'Hà Nội',
                'user_id' => 9,
            ],

        ]);
    }

    public function taxonomyDefault()
    {
        \App\Models\Taxonomy::insert([
            [
                'id' => '11',
                'title' => "Danh mục mặc định",
                'description' => "Danh mục mặc định",
                'content' => "Danh mục mặc định",
                'slug' => "danh muc mac dinh",
                'parent' => "-1",
                'user_id' => '1',
                'type' => 'post'
            ],
        ]);
    }

    public function productDefault()
    {
        Product::insert([
            [
                'title' => 'Thực Tập Sinh Java',
                'description' => 'Các bạn sinh viên mới ra trường, các bạn là sinh viên năm cuối các trường Đại học, Cao đẳng thuộc khoa CNTT.',
                'content' => 'Tham gia các dự án thực tế phát triển phần mềm của Công ty trong quá trình được đào tạo.',
                'slug' => 'thuc-tap-sinh-java',
                'status' => 'wait',
                'price_sale' => 2000000,
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'title' => 'Lập Trình Viên Front-End - Frontend',
                'description' => 'Thành thạo HTML5/CSS3, Java Script/JQuery, Bootstrap.',
                'content' => 'Xây dựng front-end framework, base-components để chuẩn hóa và dễ tái sử dụng.',
                'slug' => 'lap-trinh-vien-front-end-frontend-developer',
                'status' => 'wait',
                'price_sale' => 5000000,
                'user_id' => 1,
                'created_at' => now()

            ],
            [
                'title' => 'Thực Tập Sinh PHP',
                'description' => 'Có kiến thức về lập trình web: HTML, CSS, Javascript, JQuery, …',
                'content' => 'Tham gia các dự án nước ngoài theo hình thức training on-job dưới sự hướng dẫn trực tiếp của Leader',
                'slug' => 'thuc-tap-sinh-php',
                'status' => 'wait',
                'price_sale' => 3000000,
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'title' => 'Java Developer',
                'description' => 'Kinh nghiệm: Ít nhất 2 năm về phát triển phần mềm',
                'content' => 'Tham gia trực tiếp coding các dự án quản lý của công ty',
                'slug' => 'java-developer',
                'status' => 'wait',
                'price_sale' => 40000000,
                'user_id' => 1,
                'created_at' => now()
            ],
            [
                'title' => 'Thực Tập Sinh Javascript',
                'description' => 'Ưu tiên các bạn đã có kinh nghiệm làm web bằng ngôn ngữ Javascript',
                'content' => 'Tham gia phát triển ứng dụng, website trên nền tảng Javascript.',
                'slug' => 'thuc-tap-sinh-javascript',
                'status' => 'wait',
                'price_sale' => 2000000,
                'user_id' => 1,
                'created_at' => now()
            ],
        ]);
        ProductMeta::insert([
            // 1
            [
                'meta_key' => '_address',
                'meta_value' => 25,
                'product_id' => 1,
            ],
            [
                'meta_key' => '_number_Level',
                'meta_value' => 102,
                'product_id' => 1,
            ],
            [
                'meta_key' => '_dateline',
                'meta_value' => '"19\/07\/2022"',
                'product_id' => 1,
            ],
            [
                'meta_key' => '_timeline',
                'meta_value' =>'"30\/09\/2022"',
                'product_id' => 1,
            ],
            [
                'meta_key' => '_rank',
                'meta_value' => 115,
                'product_id' => 1,
            ],
            [
                'meta_key' => '_education_Level',
                'meta_value' => 113,
                'product_id' => 1,
            ],
            [
                'meta_key' => '_type_work',
                'meta_value' => 120,
                'product_id' => 1,
            ],
            [
                'meta_key' => '_skill',
                'meta_value' => 15,
                'product_id' => 1,
            ],
            //2
            [
                'meta_key' => '_address',
                'meta_value' => 25,
                'product_id' => 2,
            ],
            [
                'meta_key' => '_number_Level',
                'meta_value' => 102,
                'product_id' => 2,
            ],
            [
                'meta_key' => '_dateline',
                'meta_value' => '"19\/07\/2022"',
                'product_id' => 2,
            ],
            [
                'meta_key' => '_timeline',
                'meta_value' =>'"30\/09\/2022"',
                'product_id' => 2,
            ],
            [
                'meta_key' => '_rank',
                'meta_value' => 115,
                'product_id' => 2,
            ],
            [
                'meta_key' => '_education_Level',
                'meta_value' => 113,
                'product_id' => 2,
            ],
            [
                'meta_key' => '_type_work',
                'meta_value' => 120,
                'product_id' => 2,
            ],
            [
                'meta_key' => '_skill',
                'meta_value' => 15,
                'product_id' => 2,
            ],
            //3
            [
                'meta_key' => '_address',
                'meta_value' => 25,
                'product_id' => 3,
            ],
            [
                'meta_key' => '_number_Level',
                'meta_value' => 102,
                'product_id' => 3,
            ],
            [
                'meta_key' => '_dateline',
                'meta_value' => '"19\/07\/2022"',
                'product_id' => 3,
            ],
            [
                'meta_key' => '_timeline',
                'meta_value' =>'"30\/09\/2022"',
                'product_id' => 3,
            ],
            [
                'meta_key' => '_rank',
                'meta_value' => 115,
                'product_id' => 3,
            ],
            [
                'meta_key' => '_education_Level',
                'meta_value' => 113,
                'product_id' => 3,
            ],
            [
                'meta_key' => '_type_work',
                'meta_value' => 120,
                'product_id' => 3,
            ],
            [
                'meta_key' => '_skill',
                'meta_value' => 17,
                'product_id' => 3,
            ],
            // 4
            [
                'meta_key' => '_address',
                'meta_value' => 25,
                'product_id' => 4,
            ],
            [
                'meta_key' => '_number_Level',
                'meta_value' => 102,
                'product_id' => 4,
            ],
            [
                'meta_key' => '_dateline',
                'meta_value' => '"19\/07\/2022"',
                'product_id' => 4,
            ],
            [
                'meta_key' => '_timeline',
                'meta_value' =>'"30\/09\/2022"',
                'product_id' => 4,
            ],
            [
                'meta_key' => '_rank',
                'meta_value' => 115,
                'product_id' => 4,
            ],
            [
                'meta_key' => '_education_Level',
                'meta_value' => 113,
                'product_id' => 4,
            ],
            [
                'meta_key' => '_type_work',
                'meta_value' => 120,
                'product_id' => 4,
            ],
            [
                'meta_key' => '_skill',
                'meta_value' => 15,
                'product_id' => 4,
            ],
            // 5
            [
                'meta_key' => '_address',
                'meta_value' => 25,
                'product_id' => 5,
            ],
            [
                'meta_key' => '_number_Level',
                'meta_value' => 102,
                'product_id' => 5,
            ],
            [
                'meta_key' => '_dateline',
                'meta_value' => '"19\/07\/2022"',
                'product_id' => 5,
            ],
            [
                'meta_key' => '_timeline',
                'meta_value' =>'"30\/09\/2022"',
                'product_id' => 5,
            ],
            [
                'meta_key' => '_rank',
                'meta_value' => 115,
                'product_id' => 5,
            ],
            [
                'meta_key' => '_education_Level',
                'meta_value' => 113,
                'product_id' => 5,
            ],
            [
                'meta_key' => '_type_work',
                'meta_value' => 120,
                'product_id' => 5,
            ],
            [
                'meta_key' => '_skill',
                'meta_value' => 25,
                'product_id' => 5,
            ],
        ]);
    }

    public function serviceDefault()
    {
        Service::insert([
            [
                'title' => 'Free',
                'description' => 'Miễn phí',
                'status' => 'active',
                'service_start' => '2022-07-06',
                'service_end' => '2022-12-31',
                'price_base' => 5000000,
                'price_sale' => 4499000,
                'user_id' => 1,
            ],
            [
                'title' => 'Premium',
                'description' => 'Nâng cao',
                'status' => 'active',
                'service_start' => '2022-07-06',
                'service_end' => '2022-12-31',
                'price_base' => 8000000,
                'price_sale' => 71990000,
                'user_id' => 1,
            ],
            [
                'title' => 'Vip',
                'description' => 'Cao cấp',
                'status' => 'active',
                'service_start' => '2022-07-06',
                'service_end' => '2022-12-31',
                'price_base' => 20000000,
                'price_sale' => 15000000,
                'user_id' => 1,
            ],
        ]);
        ServiceMeta::insert([
            //1
            [
                'meta_key' => 1,
                'meta_value' => '+ 1',
                'service_id' => 1,
            ],
            [
                'meta_key' => 0,
                'meta_value' => '+ 2',
                'service_id' => 1,
            ],
            [
                'meta_key' => 0,
                'meta_value' => '+ 3',
                'service_id' => 1,
            ],
            [
                'meta_key' => 0,
                'meta_value' => '+ 4',
                'service_id' => 1,
            ],
            //2
            [
                'meta_key' => 1,
                'meta_value' => '+ 1',
                'service_id' => 2,
            ],
            [
                'meta_key' => 1,
                'meta_value' => '+ 2',
                'service_id' => 2,
            ],
            [
                'meta_key' => 0,
                'meta_value' => '+ 3',
                'service_id' => 2,
            ],
            [
                'meta_key' => 0,
                'meta_value' => '+ 4',
                'service_id' => 2,
            ],
            //3
            [
                'meta_key' => 1,
                'meta_value' => '+ 1',
                'service_id' => 3,
            ],
            [
                'meta_key' => 1,
                'meta_value' => '+ 2',
                'service_id' => 3,
            ],
            [
                'meta_key' => 1,
                'meta_value' => '+ 3',
                'service_id' => 3,
            ],
            [
                'meta_key' => 0,
                'meta_value' => '+ 4',
                'service_id' => 3,
            ],
        ]);
    }
}
