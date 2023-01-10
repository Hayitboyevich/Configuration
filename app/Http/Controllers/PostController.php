<?php

namespace App\Http\Controllers;

use App\Models\Management;
use App\Models\News;
use App\Models\NewsFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\ManifestElement;

class PostController extends Controller
{
    public $region_id = 1;
    public $status = 0;
    public $is_main = null;

    public function management()
    {
        $query = DB::table('posts')->select('*')->where('group', 'manage')->get();

        foreach ($query as $item) {
            $image = DB::table('media')->select('*')->where('post_id', $item->id)->first()->url;
            $title = unserialize($item->title);
            $position = unserialize($item->category_title);
            $reception = unserialize($item->content_html);
            if ($item->status == 'active') {
                $this->status = 1;
            }

            $management = new Management();
            $management->name_uz = $title['uz'];
            $management->name_oz = $title['oz'];
            $management->name_ru = $title['ru'];
            $management->name_en = $title['en'];
            $management->email = $item->option_2;
            $management->phone_number = $item->option_3;
            $management->position_uz = $position['uz'];
            $management->position_oz = $position['oz'];
            $management->position_ru = $position['ru'];
            $management->position_en = $position['en'];
            $management->reception_day_uz = $reception['uz'];
            $management->reception_day_oz = $reception['oz'];
            $management->reception_day_ru = $reception['ru'];
            $management->reception_day_en = $reception['en'];
            $management->img = $image ?? null;
            $management->region_id = $this->region_id;
            $management->status = $this->status;
            $management->save();

        }
    }

    public function news()
    {
        $query = DB::table('posts')->select('*')->where('group', 'news')->get();

        foreach ($query as $item) {
            $title = unserialize($item->title);
            $content = unserialize($item->content);
            $image = DB::table('media')->select('*')->where('post_id', $item->id)->where('is_main', 1)->first()->url ?? null;
            $images = DB::table('media')->select('*')->where('post_id', $item->id)->where('is_main', '0')->get();
            if ($image){
                $this->is_main = 1;
            }
            if ($item->status == 'active') {
                $this->status = 1;
            }
            $news = new News();
            $news->title_uz = $title['uz'] ?? null;
            $news->title_oz = $title['oz'] ?? null;
            $news->title_ru = $title['ru'] ?? null;
            $news->title_en = $title['en'] ?? null;
            $news->content_uz = $content['uz'] ?? null;
            $news->content_oz = $content['oz'] ?? null;
            $news->content_ru = $content['ru'] ?? null;
            $news->content_en = $content['en'] ?? null;
            $news->view_count = $item->views;
            $news->date = $item->created_on;
            $news->banner = $image;
            $news->on_main = $this->is_main;
            $news->region_id = $this->region_id;
            $news->status = $this->status;
            if ($news->save())
            {
                foreach ($images as $image) {
                    if ($image->status_m == 'active'){
                        $this->status = 1;
                    }
                    $newsFile = new NewsFile();
                    $newsFile->news_id = $news->id;
                    $newsFile->file = $image->url;
                    $newsFile->status = $this->status;
                    $newsFile->save();
                }
            }


        }
    }
}
