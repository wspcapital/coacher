<?php

use Illuminate\Database\Seeder,
    App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $array = [
            [//id=1
                'title'       => 'Virtual Coach Videos',
                'description' => 'Virtual Coach Videos',
                'type'        => 'Order',
                'blocked'     => '0',
            ],
            [//id=2
                'title'       => 'Workshop Videos',
                'description' => 'Workshop Videos',
                'type'        => 'User',
                'blocked'     => '0',
            ],
            [//id=3
                'title'       => 'Video Learning Module',
                'description' => 'Video Learning Module',
                'type'        => 'User',
                'blocked'     => '0',
            ],
            [//id=4
                'title'       => 'Webinar Recordings',
                'description' => 'Webinar Recordings',
                'type'        => 'User',
                'blocked'     => '0',
            ],
            [//id=5
                'title'       => 'Vpr',
                'description' => 'Pdf file',
                'type'        => 'Order',
                'blocked'     => '0',
            ],
            [//id=6
                'title'       => 'Index',
                'description' => 'Posts for Guest Pages',
                'type'        => 'CMS',
                'blocked'     => '0',
            ],
            [//id=7
                'title'       => 'Vcoach',
                'description' => 'Posts for vcoach Pages',
                'type'        => 'CMS',
                'blocked'     => '0',
            ],
            [//id=8
                'title'       => 'Corporate Library',
                'description' => 'Corporate Library',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [//id=9
                'title'       => 'Workbook Library',
                'description' => 'Workbook Library',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [//id=10
                'title'       => 'Trainers Toolbox',
                'description' => 'Trainers Toolbox',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [//id=11
                'title'       => 'Sales Toolbox',
                'description' => 'Sales Toolbox',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [//id=12
                'title'       => 'Marketing Toolbox',
                'description' => 'Marketing Toolbox',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            //Child Categories
            [
                'title'       => 'General Material',
                'description' => 'General Material',
                'parent_id'   => '8',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Tips & Tools',
                'description' => 'Tips & Tools',
                'parent_id'   => '8',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Guides',
                'description' => 'Guides',
                'parent_id'   => '8',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Exercises',
                'description' => 'Exercises',
                'parent_id'   => '8',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Articles',
                'description' => 'Articles',
                'parent_id'   => '8',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Trainer Bios',
                'description' => 'Trainer Bios',
                'parent_id'   => '8',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Policies And Procedures',
                'description' => 'Policies And Procedures',
                'parent_id'   => '8',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Individual Modules - 2014',
                'description' => 'Individual Modules - 2014',
                'parent_id'   => '8',
                'type'        => 'Library',
                'blocked'     => '1',
            ],
            [
                'title'       => 'Individual Modules',
                'description' => 'Individual Modules',
                'parent_id'   => '9',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Workbooks',
                'description' => 'Workbooks',
                'parent_id'   => '9',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Trainers Toolbox',
                'description' => 'Trainers Toolbox',
                'parent_id'   => '10',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Trainer Guides And Protocol',
                'description' => 'Trainer Guides And Protocol',
                'parent_id'   => '10',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Templates',
                'description' => 'Templates',
                'parent_id'   => '10',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Meeting Recordings',
                'description' => 'Meeting Recordings',
                'parent_id'   => '10',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Trainer Monthly Message',
                'description' => 'Trainer Monthly Message',
                'parent_id'   => '10',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Exercise Training Videos',
                'description' => 'Exercise Training Videos',
                'parent_id'   => '10',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Module Training Videos',
                'description' => 'Module Training Videos',
                'parent_id'   => '10',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Sample Delivery Videos',
                'description' => 'Sample Delivery Videos',
                'parent_id'   => '10',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Trainer Training Videos',
                'description' => 'Trainer Training Videos',
                'parent_id'   => '10',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Sales Manual Individual Chapters',
                'description' => 'Sales Manual Individual Chapters',
                'parent_id'   => '11',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Sales Manual Compiled',
                'description' => 'Sales Manual Compiled',
                'parent_id'   => '11',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Sales Templates',
                'description' => 'Sales Templates',
                'parent_id'   => '11',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Sales Tools',
                'description' => 'Sales Tools',
                'parent_id'   => '11',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Meeting Recordings',
                'description' => 'Meeting Recordings',
                'parent_id'   => '11',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Marketing Assets',
                'description' => 'Marketing Assets',
                'parent_id'   => '12',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Video Tips',
                'description' => 'Video Tips',
                'type'        => 'Library',
                'blocked'     => '1',
            ],
            [
                'title'       => 'Portal Library',
                'description' => 'Portal Library',
                'type'        => 'Library',
                'blocked'     => '1',
            ],
            [
                'title'       => 'General Material',
                'description' => 'General Material',
                'parent_id'   => '39',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Tips & Tools',
                'description' => 'Tips & Tools',
                'parent_id'   => '39',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Guides',
                'description' => 'Guides',
                'parent_id'   => '39',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Exercises',
                'description' => 'Exercises',
                'parent_id'   => '39',
                'type'        => 'Library',
                'blocked'     => '0',
            ],
            [
                'title'       => 'Reference Materials',
                'description' => 'Reference Materials',
                'parent_id'   => '39',
                'type'        => 'Library',
                'blocked'     => '0',
            ]
        ];
        foreach ($array as $one) {
            Category::create($one);
        }
    }
}
