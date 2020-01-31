<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
        $this->call(VideosTableSeeder::class);
        $this->call(ContributorTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder{
  public function run()
  {
      $now = new DateTime();
      DB::table('users')->truncate();
      DB::table('users')->insert([
        'name'        => 'administrator',
        'email'       => 'administrator@cilsy.id',
        'password'    => bcrypt('123456'),
        'created_at'  => $now,
        'updated_at'  => $now,
      ]);

  }
}

class CategoriesTableSeeder extends Seeder{
  public function run()
  {
      $now = new DateTime();
      DB::table('categories')->truncate();
      DB::table('categories')->insert([
        'enable'      => 1,
        'title'       => 'Linux',
        'image'       => 'http://dev.cilsy.id/assets/source/category/linux.png',
        'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
        'created_at'  => $now,
        'updated_at'  => $now,
      ]);
      DB::table('categories')->insert([
        'enable'      => 1,
        'title'       => 'Cisco',
        'image'       => 'http://dev.cilsy.id/assets/source/category/cisco.png',
        'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
        'created_at'  => $now,
        'updated_at'  => $now,
      ]);

      DB::table('categories')->insert([
        'enable'      => 1,
        'title'       => 'Mikrotik',
        'image'       => 'http://dev.cilsy.id/assets/source/category/mikrotik.png',
        'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
        'created_at'  => $now,
        'updated_at'  => $now,
      ]);
  }
}

class LessonsTableSeeder extends Seeder{
  public function run()
  {
      $now = new DateTime();
      DB::table('lessons')->truncate();
      for ($i=1; $i <= 3; $i++) {

        DB::table('lessons')->insert([
          'enable'      => 1,
          'title'       => 'Lessons'.$i,
          'category_id' => $i,
          'image'       => 'http://dev.cilsy.id/assets/source/lessons/dummy.jpg',
          'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',
          'created_at'  => $now,
          'updated_at'  => $now,
        ]);

      }

  }
}

class VideosTableSeeder extends Seeder{
  public function run()
  {
      $now = new DateTime();
      DB::table('videos')->truncate();
      DB::table('videos')->insert([
        'enable'      => 1,
        'title'       => 'videos 1',
        'lessons_id'  => 1,
        'image'       => 'http://dev.cilsy.id/assets/source/lessons/lessons-1/video-1/cover.png',
        'video'       => 'http://dev.cilsy.id/assets/source/lessons/lessons-1/video-1/video.mp4',
        'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry.',
        'created_at'  => $now,
        'updated_at'  => $now,
      ]);
      DB::table('videos')->insert([
        'enable'      => 1,
        'title'       => 'videos 2',
        'lessons_id'  => 1,
        'image'       => 'http://dev.cilsy.id/assets/source/lessons/lessons-1/video-2/cover.png',
        'video'       => 'http://dev.cilsy.id/assets/source/lessons/lessons-1/video-2/video.mp4',
        'description' => 'Lorem ipsum is simply dummy text of the printing and typesetting industry.',
        'created_at'  => $now,
        'updated_at'  => $now,
      ]);
  }
}
