<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Lesson;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/carapesan'))
            ->add(Url::create('/petunjuk'))
            ->add(Url::create('/member/package'))
            ->add(Url::create('/kontak'));

        Lesson::all()->each(function (Lesson $lessons) use ($sitemap) {
            $sitemap->add(Url::create("/lessons/{$lessons->slug}"));
        });

        Category::all()->each(function (Category $categories) use ($sitemap) {
            $sitemap->add(Url::create("/lessons/category/{$categories->title}"));
        });

        $sitemap->writeToFile(storage_path('sitemap.xml'));
    }
}
